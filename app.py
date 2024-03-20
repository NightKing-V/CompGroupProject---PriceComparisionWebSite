import os
import pymongo
from dotenv import load_dotenv
from flask import Flask, jsonify, request, render_template
from scrapers.singer import getSingerData
from scrapers.abans import getAbansData
from scrapers.damro import getDamroData
from scrapers.singhagiri import getSinghagiriData
from scrapers.softlogic import getSoftlogicData
from flask_apscheduler import APScheduler
from pymongo import MongoClient
from tasks import taskManager
from datetime import datetime,timezone


load_dotenv()

client = MongoClient(os.getenv('MONGO_URL'))
db = client['PricePal']

class Config:
    SCHEDULER_API_ENABLED = True

app = Flask(__name__)
app.config.from_object(Config())

scheduler = APScheduler()
scheduler.init_app(app)
scheduler.start()

# categories
categories = ["rice_cooker","refridgerator","fan","tv","washing_machine"]

# store server started time
initiateTime = datetime.now().isoformat()
print("now =", initiateTime)

reqCount = 0
def addReq():
    global reqCount
    reqCount += 1

def get_total_documents():
    total_documents = 0
    for category in categories:
        # Ensure the collection exists before trying to count documents
        if category in db.list_collection_names():
            collection = db[category]
            count = collection.count_documents({})
            print(f"Collection '{category}' has {count} documents.")
            total_documents += count
        else:
            print(f"Collection '{category}' does not exist.")
    return total_documents

def get_document_count():
    doc_count = {}
    for category in categories:
        collection = db[category]
        count = collection.count_documents({})
        doc_count[category] = count
    return doc_count
    

@app.route('/', methods=['GET'])
def get_home():
    activeCount = taskManager.getActiveTaskCount()
    allCount = taskManager.getTaskCount()
    totalDocuments = get_total_documents()
    doc_count = get_document_count()
    serverStatus = "Running"
    data = {
        "allTasks":allCount,
        "activeTasks":activeCount,
        "status":serverStatus,
        "req":reqCount,
        "totalDoc":totalDocuments
    }
    data.update(doc_count)
    return render_template('home.html', initiateTime=initiateTime, data=data)

# Task Manager

@app.route('/listTasks', methods=['GET'])
def list_tasks():
    data = taskManager.getTasks()
    return render_template('listTask.html', data=data)

@app.delete('/listTasks/<int:id>')
def delete_task(id):
    isDeleted = taskManager.deleteTask(id)
    if isDeleted:
        return jsonify({'message':'Task Deleted Successfully'}),200
    else:
        return jsonify({'message':'Task Not Found'}),404
    
@app.route('/addTask', methods=['GET','POST'])
def add_task():
    if request.method == "GET":
        return render_template('addTask.html')
    else:
        data = request.get_json()
        url = data['url']
        platform = data['platform']
        category = data['category']
        interval = data['interval']
        isAdded = taskManager.addTask(url,platform,category,interval)
        if isAdded:
            return jsonify({'message':'Task Added Successfully'}),201
        else:
            return jsonify({'message':'Failed To Add Task'}),500
        
@app.route('/editTask/<int:id>', methods=['GET','POST'])
def edit_task(id):
    if request.method == "GET":
        data = taskManager.getTaskByID(id)
        print(data)
        return render_template('editTask.html', data=data)
    else:
        data = request.get_json()
        url = data['url']
        platform = data['platform']
        category = data['category']
        interval = data['interval']
        status = data['status']
        isAdded = taskManager.editTask(id,url,platform,category,interval,status)
        if isAdded:
            return jsonify({'message':'Task Updated Successfully'}),201
        else:
            return jsonify({'message':'Failed To Update Task'}),500


@app.put('/updateState/<int:id>/<string:state>')
def update_state(id,state):
    isUpdated = taskManager.setState(id,state)
    if isUpdated:
        return jsonify({'message':'State Changed'}),200
    else:
        return jsonify({'message':'Failed to Change State'}),404
    
# API Mode
@app.route('/singer', methods=['GET'])
async def get_singer_data():
    addReq()
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getSingerData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/abans', methods=['GET'])
async def get_abans_data():
    addReq()
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getAbansData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/damro', methods=['GET'])
async def get_damro_data():
    addReq()
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getDamroData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/singhagiri', methods=['GET'])
async def get_singhagiri_data():
    addReq()
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getSinghagiriData(url_param)
        return data
    else:
        return "No URL parameter received."
    
@app.route('/softlogic', methods=['GET'])
async def get_softlogic_data():
    addReq()
    url_param = request.args.get('url', None)
    if url_param is not None:
        data = getSoftlogicData(url_param)
        return data
    else:
        return "No URL parameter received."

# get dataset

def get_singer_data(url,category):
    addReq()
    data = getSingerData(url,category)
    collection = db[category]
    for ele in data:
        current_time = datetime.now(timezone.utc)
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            ele['created_at'] = current_time
            ele['updated_at'] = current_time
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title": p["title"]}, {"$set": {**ele, 'updated_at': current_time}}, upsert=False)
    print(f"Singer {category.capitalize()} Scraped !")

def get_abans_data(url,category):
    addReq()
    data = getAbansData(url,category)
    collection = db[category]
    for ele in data:
        current_time = datetime.now(timezone.utc)
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            ele['created_at'] = current_time
            ele['updated_at'] = current_time
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title": p["title"]}, {"$set": {**ele, 'updated_at': current_time}}, upsert=False)
    print(f"Abans {category.capitalize()} Scraped !")

def get_damro_data(url,category):
    addReq()
    data = getDamroData(url,category)
    collection = db[category]
    for ele in data:
        current_time = datetime.now(timezone.utc)
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            ele['created_at'] = current_time
            ele['updated_at'] = current_time
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title": p["title"]}, {"$set": {**ele, 'updated_at': current_time}}, upsert=False)
    print(f"Damro {category.capitalize()} Scraped !")

def get_softlogic_data(url,category):
    addReq()
    data = getSoftlogicData(url,category)
    collection = db[category]
    for ele in data:
        current_time = datetime.now(timezone.utc)
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            ele['created_at'] = current_time
            ele['updated_at'] = current_time
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title": p["title"]}, {"$set": {**ele, 'updated_at': current_time}}, upsert=False)
    print(f"Softlogic {category.capitalize()} Scraped !")

def get_singhagiri_data(url,category):
    addReq()
    data = getSinghagiriData(url,category)
    collection = db[category]
    for ele in data:
        current_time = datetime.now(timezone.utc)
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            ele['created_at'] = current_time
            ele['updated_at'] = current_time
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title": p["title"]}, {"$set": {**ele, 'updated_at': current_time}}, upsert=False)
    print(f"Singhagiri {category.capitalize()} Scraped !")

def scheduleTasks():
    tasks= taskManager.getActiveTasks()
    for task in tasks:
        if task[2] == "singer":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_singer_data(url,category), trigger='interval', minutes=task[4], max_instances=1)
        elif task[2] == "abans":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_abans_data(url,category), trigger='interval', minutes=task[4], max_instances=1)
        elif task[2] == "damro":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_damro_data(url,category), trigger='interval', minutes=task[4], max_instances=1)
        elif task[2] == "singhagiri":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_singhagiri_data(url,category), trigger='interval', minutes=task[4], max_instances=1)
        elif task[2] == "softlogic":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_softlogic_data(url,category), trigger='interval', minutes=task[4], max_instances=1)
        else:
            pass


# flush data Route
@app.route('/flush',methods=['GET'])
def flush():
    for category in categories:
        db.drop_collection(category)
    scheduler.remove_all_jobs()
    tasks= taskManager.getActiveTasks()
    for task in tasks:
        if task[2] == "singer":
            get_singer_data(task[1],task[3])
        elif task[2] == "abans":
            get_abans_data(task[1],task[3])
        elif task[2] == "damro":
            get_damro_data(task[1],task[3])
        elif task[2] == "singhagiri":
            get_singhagiri_data(task[1],task[3])
        elif task[2] == "softlogic":
            get_softlogic_data(task[1],task[3])
        else:
            pass
    scheduleTasks()
    return jsonify({'message':'flushed'}),201

# Reload tasks Route
@app.route('/reloadTasks',methods=['GET'])
def reload():
    scheduler.remove_all_jobs()
    scheduleTasks()
    return jsonify({'message':'reloaded'}),201

# Run task Scheduler on server startup
scheduleTasks()


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
    
