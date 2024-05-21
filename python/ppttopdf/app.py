from flask import Flask, render_template, request, send_file, jsonify
import os
from pptx import Presentation
from io import BytesIO

app = Flask(__name__)

UPLOAD_FOLDER = 'uploads'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

def convert_ppt_to_pdf(ppt_file_path):
    try:
        ppt = Presentation(ppt_file_path)
        pdf_file_path = ppt_file_path[:-4] + '.pdf'
        prs_stream = BytesIO()
        ppt.save(prs_stream)
        prs_stream.seek(0)
        with open(pdf_file_path, 'wb') as f:
            f.write(prs_stream.read())
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

    if ppt_file and (ppt_file.filename.endswith('.ppt') or ppt_file.filename.endswith('.pptx')):
        filename = secure_filename(ppt_file.filename)
        ppt_file_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        ppt_file.save(ppt_file_path)
        print(f'File saved to {ppt_file_path}')
        if not os.path.exists(ppt_file_path):
            return jsonify({'error': 'Failed to save the file'}), 500

        pdf_file_path, error = convert_ppt_to_pdf(ppt_file_path)
        if error:
            print(f'Conversion error: {error}')
            return jsonify({'error': error}), 500
        return jsonify({
            'download_link': f'/download/{os.path.basename(pdf_file_path)}'
        })
    else:
        return jsonify({'error': 'Please upload a PPT or PPTX file'}), 400

@app.route('/download/<filename>')
def download(filename):
    pdf_file_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
    if not os.path.exists(pdf_file_path):
        return jsonify({'error': 'File not found'}), 404
    return send_file(pdf_file_path, as_attachment=True)

if __name__ == '__main__':
    if not os.path.exists(app.config['UPLOAD_FOLDER']):
        os.makedirs(app.config['UPLOAD_FOLDER'])
    app.run(debug=True, port=5003)
