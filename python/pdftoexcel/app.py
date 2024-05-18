from flask import Flask, request, jsonify, send_file, render_template
import os
import pdfplumber
import pandas as pd

app = Flask(__name__)
UPLOAD_FOLDER = 'uploads'
CONVERTED_FOLDER = 'converted'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['CONVERTED_FOLDER'] = CONVERTED_FOLDER

if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)
if not os.path.exists(CONVERTED_FOLDER):
    os.makedirs(CONVERTED_FOLDER)

def convert_pdf_to_excel(pdf_path, excel_path):
    try:
        # Open the PDF file
        with pdfplumber.open(pdf_path) as pdf:
            all_tables = []
            
            # Iterate through each page
            for page in pdf.pages:
                # Extract table data
                tables = page.extract_tables()
                
                # Add tables to the list (if any)
                if tables:
                    all_tables.extend(tables)
        
        if not all_tables:
            return "No table found in PDF"

        # Determine the maximum number of columns in any table
        max_cols = max(len(table[0]) for table in all_tables)

        # Create an empty DataFrame with the maximum number of columns
        df = pd.DataFrame(columns=range(max_cols))

        # Fill in the DataFrame with the table data
        for table in all_tables:
            table_df = pd.DataFrame(table)
            # Pad with NaN values if the table has fewer columns
            table_df = table_df.reindex(columns=range(max_cols))
            df = pd.concat([df, table_df], ignore_index=True)

        # Save the DataFrame to an Excel file
        df.to_excel(excel_path, index=False)
        return None  # No error
    except Exception as e:
        return str(e)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/convert', methods=['POST'])
def convert_file():
    if 'file' not in request.files:
        return jsonify({'error': 'No file part'})

    file = request.files['file']
    if file.filename == '':
        return jsonify({'error': 'No selected file'})

    if file and file.filename.endswith('.pdf'):
        filename = file.filename
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(filepath)

        output_filename = filename.rsplit('.', 1)[0] + '.xlsx'
        output_filepath = os.path.join(app.config['CONVERTED_FOLDER'], output_filename)
        error = convert_pdf_to_excel(filepath, output_filepath)
        if error:
            return jsonify({'error': error})
        
        return jsonify({'download_link': '/' + output_filepath})

    return jsonify({'error': 'Invalid file format'})

@app.route('/converted/<filename>')
def download_file(filename):
    return send_file(os.path.join(app.config['CONVERTED_FOLDER'], filename), as_attachment=True)

if __name__ == '__main__':
    app.run(debug=True, port=5006)
