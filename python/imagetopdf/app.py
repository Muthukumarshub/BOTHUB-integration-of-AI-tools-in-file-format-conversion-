from flask import Flask, request, jsonify, send_file, render_template
from PIL import Image
import os

app = Flask(__name__)
UPLOAD_FOLDER = 'uploads'
CONVERTED_FOLDER = 'converted'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['CONVERTED_FOLDER'] = CONVERTED_FOLDER

if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)
if not os.path.exists(CONVERTED_FOLDER):
    os.makedirs(CONVERTED_FOLDER)

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

    if file and (file.filename.endswith('.png') or file.filename.endswith('.jpg') or file.filename.endswith('.jpeg')):
        filename = file.filename
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(filepath)

        output_filename = filename.rsplit('.', 1)[0] + '.pdf'
        output_filepath = os.path.join(app.config['CONVERTED_FOLDER'], output_filename)

        image = Image.open(filepath)
        image.save(output_filepath, "PDF", resolution=100.0)

        return jsonify({'download_link': '/' + output_filepath})

    return jsonify({'error': 'Invalid file format'})

@app.route('/converted/<filename>')
def download_file(filename):
    return send_file(os.path.join(app.config['CONVERTED_FOLDER'], filename), as_attachment=True)

if __name__ == '__main__':
    app.run(debug=True, port=5007)
