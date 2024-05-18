from flask import Flask, render_template, request, send_file, jsonify
from pptx import Presentation
import os

app = Flask(__name__)

def convert_ppt_to_pdf(ppt_file_path):
    try:
        pdf_file_path = ppt_file_path[:-5] + '.pdf'
        presentation = Presentation(ppt_file_path)
        presentation.save(pdf_file_path)
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

    ppt_file = request.files['file']
    if ppt_file.filename == '':
        return jsonify({'error': 'No selected file'}), 400

    if ppt_file.filename.endswith('.ppt') or ppt_file.filename.endswith('.pptx'):
        ppt_file_path = os.path.join('uploads', ppt_file.filename)
        ppt_file.save(ppt_file_path)
        pdf_file_path, error = convert_ppt_to_pdf(ppt_file_path)
        if error:
            return jsonify({'error': error}), 500
        return jsonify({
            'download_link': f'/download/{os.path.basename(pdf_file_path)}'
        })
    else:
        return jsonify({'error': 'Please upload a PPT file'}), 400

@app.route('/download/<filename>')
def download(filename):
    pdf_file_path = os.path.join('uploads', filename)
    return send_file(pdf_file_path, as_attachment=True)

if __name__ == '__main__':
    if not os.path.exists('uploads'):
        os.makedirs('uploads')
    app.run(debug=True, port=5003)
