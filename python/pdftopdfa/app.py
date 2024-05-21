from flask import Flask, render_template, request, send_file, jsonify
import os
import fitz  # PyMuPDF
from reportlab.pdfgen import canvas
from reportlab.lib import colors
from reportlab.lib.pagesizes import A4
from PIL import Image

app = Flask(__name__)

def convert_pdf_to_pdfa(pdf_file_path):
    try:
        pdf_document = fitz.open(pdf_file_path)
        pdfa_file_path = f"uploads/{os.path.splitext(os.path.basename(pdf_file_path))[0]}_pdfa.pdf"
        
        # Create a new PDF/A file using ReportLab
        c = canvas.Canvas(pdfa_file_path, pagesize=A4)
        c.setFillColor(colors.black)
        c.setFont('Helvetica', 12)
        for page_num in range(len(pdf_document)):
            page = pdf_document.load_page(page_num)
            image_matrix = fitz.Matrix(2, 2)  # Zoom factor
            pix = page.get_pixmap(matrix=image_matrix)
            img_path = f"uploads/page_{page_num}.png"
            pix.write_image(img_path)  # Write image data to file
            img = Image.open(img_path)
            c.drawImage(img_path, 0, 0, width=img.width, height=img.height)
            c.showPage()
            os.remove(img_path)  # Clean up temporary image file
        c.save()
        return pdfa_file_path, None
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
        pdfa_file_path, error = convert_pdf_to_pdfa(pdf_file_path)
        if error:
            return jsonify({'error': error}), 500
        return jsonify({'download_link': f'/download/{os.path.basename(pdfa_file_path)}'})
    else:
        return jsonify({'error': 'Please upload a PDF file'}), 400

@app.route('/download/<filename>')
def download(filename):
    file_path = os.path.join('uploads', filename)
    return send_file(file_path, as_attachment=True)

if __name__ == '__main__':
    if not os.path.exists('uploads'):
        os.makedirs('uploads')
    app.run(debug=True, port=5009)
