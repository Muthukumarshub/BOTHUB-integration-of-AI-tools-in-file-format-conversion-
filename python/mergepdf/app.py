from flask import Flask, request, jsonify, send_file, render_template
import os
from PyPDF2 import PdfMerger
import traceback

app = Flask(__name__)
UPLOAD_FOLDER = 'uploads'
MERGED_FOLDER = 'merged'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['MERGED_FOLDER'] = MERGED_FOLDER

if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)
if not os.path.exists(MERGED_FOLDER):
    os.makedirs(MERGED_FOLDER)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/merge', methods=['POST'])
def merge_files():
    files = request.files.getlist('files')
    if not files:
        return jsonify({'error': 'No files part'})

    pdf_files = []
    for file in files:
        if file and file.filename.endswith('.pdf'):
            filename = file.filename
            filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
            file.save(filepath)
            pdf_files.append(filepath)
        else:
            return jsonify({'error': 'Invalid file format'})

    if pdf_files:
        merger = PdfMerger()
        for pdf in pdf_files:
            merger.append(pdf)

        merged_filename = 'merged_document.pdf'
        merged_filepath = os.path.join(app.config['MERGED_FOLDER'], merged_filename)
        merger.write(merged_filepath)
        merger.close()

        return jsonify({'download_link': f"/merged/{merged_filename}"})

    return jsonify({'error': 'No valid PDF files to merge'})

@app.route('/merged/<filename>')
def download_file(filename):
    return send_file(os.path.join(app.config['MERGED_FOLDER'], filename), as_attachment=True)

if __name__ == '__main__':
    app.run(debug=True, port=5010)
