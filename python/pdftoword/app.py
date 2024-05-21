from flask import Flask, render_template, request, send_file, jsonify
from pdf2docx import Converter
import os

app = Flask(__name__)

def convert_pdf_to_docx(pdf_file_path):
    try:
        docx_file_path = pdf_file_path[:-4] + '.docx'
        pdf_to_docx_converter = Converter(pdf_file_path)
        pdf_to_docx_converter.convert(docx_file_path)
        pdf_to_docx_converter.close()
        return docx_file_path, None
    except Exception as e:
        return None, str(e)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/convert', methods=['POST'])
def convert():
    if 'file' not in request.files:
        return jsonify({'error': 'No file part'}), 400

    pdf_file = request.files['file']
    if pdf_file.filename == '':
        return jsonify({'error': 'No selected file'}), 400

    if pdf_file.filename.endswith('.pdf'):
        pdf_file_path = os.path.join('uploads', pdf_file.filename)
        pdf_file.save(pdf_file_path)
        docx_file_path, error = convert_pdf_to_docx(pdf_file_path)
        if error:
            return jsonify({'error': error}), 500
        return jsonify({
            'download_link': f'/download/{os.path.basename(docx_file_path)}',
            'view_link': f'/view/{os.path.basename(docx_file_path)}'
        })
    else:
        return jsonify({'error': 'Please upload a PDF file'}), 400

@app.route('/download/<filename>')
def download(filename):
    docx_file_path = os.path.join('uploads', filename)
    return send_file(docx_file_path, as_attachment=True)

@app.route('/view/<filename>')
def view(filename):
    docx_file_path = os.path.join('uploads', filename)
    return send_file(docx_file_path)

if __name__ == '__main__':
    if not os.path.exists('uploads'):
        os.makedirs('uploads')
    app.run(debug=True, port=5001)  # Set the port to 5001