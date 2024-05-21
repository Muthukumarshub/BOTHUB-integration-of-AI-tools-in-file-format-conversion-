from flask import Flask, render_template, request, send_file, jsonify
import os
import fitz  # PyMuPDF

app = Flask(__name__)

def convert_pdf_to_images(pdf_file_path):
    try:
        pdf_document = fitz.open(pdf_file_path)
        image_paths = []
        for page_num in range(len(pdf_document)):
            page = pdf_document.load_page(page_num)
            image_matrix = fitz.Matrix(2, 2)  # Zoom factor
            pix = page.get_pixmap(matrix=image_matrix)
            image_path = f"uploads/page_{page_num}.png"
            pix.save(image_path)
            image_paths.append(image_path)
        return image_paths, None
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
        image_paths, error = convert_pdf_to_images(pdf_file_path)
        if error:
            return jsonify({'error': error}), 500
        download_links = [f'/download/{os.path.basename(path)}' for path in image_paths]
        return jsonify({'download_links': download_links})
    else:
        return jsonify({'error': 'Please upload a PDF file'}), 400

@app.route('/download/<filename>')
def download(filename):
    image_file_path = os.path.join('uploads', filename)
    return send_file(image_file_path, as_attachment=True)

if __name__ == '__main__':
    if not os.path.exists('uploads'):
        os.makedirs('uploads')
    app.run(debug=True, port=5008)
