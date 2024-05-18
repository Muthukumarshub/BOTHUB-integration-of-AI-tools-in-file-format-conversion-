from flask import Flask, render_template, request, send_file, jsonify
from docx import Document
import os

app = Flask(__name__)

def convert_docx_to_pdf(docx_file_path):
    try:
        pdf_file_path = docx_file_path[:-5] + '.pdf'
        document = Document(docx_file_path)
        # Here, you would use a library or API that converts DOCX to PDF
        # For example, you could use Aspose.Words for Python or similar tools.
        # The below save method is just a placeholder and does not convert to PDF.
        # Replace it with actual DOCX to PDF conversion logic.
        document.save(pdf_file_path)
        return pdf_file_path, None
    except Exception as e:
        return None, str(e)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/convert', methods=['POST'])
def convert():
    if 'file' not in request.files:
        return jsonify({'error': 'No file part'}), 400

    docx_file = request.files['file']
    if docx_file.filename == '':
        return jsonify({'error': 'No selected file'}), 400

    if docx_file.filename.endswith('.docx'):
        docx_file_path = os.path.join('uploads', docx_file.filename)
        docx_file.save(docx_file_path)
        pdf_file_path, error = convert_docx_to_pdf(docx_file_path)
        if error:
            return jsonify({'error': error}), 500
        return jsonify({
            'download_link': f'/download/{os.path.basename(pdf_file_path)}',
            'view_link': f'/view/{os.path.basename(pdf_file_path)}'
        })
    else:
        return jsonify({'error': 'Please upload a DOCX file'}), 400

@app.route('/download/<filename>')
def download(filename):
    pdf_file_path = os.path.join('uploads', filename)
    return send_file(pdf_file_path, as_attachment=True)

@app.route('/view/<filename>')
def view(filename):
    pdf_file_path = os.path.join('uploads', filename)
    if not os.path.exists(pdf_file_path):
        return jsonify({'error': 'File not found'}), 404
    return send_file(pdf_file_path, mimetype='application/pdf')

if __name__ == '__main__':
    if not os.path.exists('uploads'):
        os.makedirs('uploads')
    app.run(debug=True, port=5002)  # Changed port to 5002
