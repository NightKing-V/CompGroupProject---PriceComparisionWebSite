from flask import Flask, jsonify, request
from scrapers.singer import getSingerData
from scrapers.abans import getAbansData
from scrapers.damro import getDamroData
from scrapers.singhagiri import getSinghagiriData
from scrapers.softlogic import getSoftlogicData

app = Flask(__name__)


@app.route('/', methods=['GET'])
def get_home():
    return "Server Running!"


@app.route('/singer', methods=['GET'])
async def get_singer_data():
    # Get the 'url' query parameter, default to None if not provided
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getSingerData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/abans', methods=['GET'])
async def get_abans_data():
    # Get the 'url' query parameter, default to None if not provided
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getAbansData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/damro', methods=['GET'])
async def get_damro_data():
    # Get the 'url' query parameter, default to None if not provided
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getDamroData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/singhagiri', methods=['GET'])
async def get_singhagiri_data():
    # Get the 'url' query parameter, default to None if not provided
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getSinghagiriData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/softlogic', methods=['GET'])
async def get_softlogic_data():
    # Get the 'url' query parameter, default to None if not provided
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getSoftlogicData(url_param)
        return data
    else:
        return "No URL parameter received."


if __name__ == '__main__':
    app.run(port=5000, debug=True)
