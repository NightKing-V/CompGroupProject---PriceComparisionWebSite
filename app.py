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
import datetime


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

# store server started time
initiateTime = datetime.datetime.now().isoformat()
print("now =", initiateTime)

reqCount = 0
def addReq():
    global reqCount
    reqCount += 1

@app.route('/', methods=['GET'])
def get_home():
    activeCount = taskManager.getActiveTaskCount()
    allCount = taskManager.getTaskCount()
    serverStatus = "Running"
    data = {
        "allTasks":allCount,
        "activeTasks":activeCount,
        "status":serverStatus,
        "req":reqCount
    }
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
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title":p["title"]}, {"$set":ele}, upsert=False)
    print(f"Singer {category.capitalize()} Scraped !")

def get_abans_data(url,category):
    addReq()
    data = getAbansData(url,category)
    collection = db[category]
    for ele in data:
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title":p["title"]}, {"$set":ele}, upsert=False)
    print(f"Abans {category.capitalize()} Scraped !")

def get_damro_data(url,category):
    addReq()
    data = getDamroData(url,category)
    collection = db[category]
    for ele in data:
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title":p["title"]}, {"$set":ele}, upsert=False)
    print(f"Damro {category.capitalize()} Scraped !")

def get_softlogic_data(url,category):
    addReq()
    data = getSoftlogicData(url,category)
    collection = db[category]
    for ele in data:
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title":p["title"]}, {"$set":ele}, upsert=False)
    print(f"Softlogic {category.capitalize()} Scraped !")

def get_singhagiri_data(url,category):
    addReq()
    data = getSinghagiriData(url,category)
    collection = db[category]
    for ele in data:
        p = collection.find_one({"title":ele["title"]})
        if p is None:
            id = collection.insert_one(ele).inserted_id
        else:
            q = collection.update_one({"title":p["title"]}, {"$set":ele}, upsert=False)
    print(f"Singhagiri {category.capitalize()} Scraped !")

# Reload tasks Route
@app.route('/reloadTasks',methods=['GET'])
def reload():
    scheduler.remove_all_jobs()
    tasks= taskManager.getActiveTasks()
    print(tasks)
    for task in tasks:
        if task[2] == "singer":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_singer_data(url,category), trigger='interval', hours=task[4], max_instances=1)
        elif task[2] == "abans":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_abans_data(url,category), trigger='interval', hours=task[4], max_instances=1)
        elif task[2] == "damro":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_damro_data(url,category), trigger='interval', hours=task[4], max_instances=1)
        elif task[2] == "singhagiri":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_singhagiri_data(url,category), trigger='interval', hours=task[4], max_instances=1)
        elif task[2] == "softlogic":
            job_id = f"ScheduledScraping_{task[0]}"
            scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_softlogic_data(url,category), trigger='interval', hours=task[4], max_instances=1)
        else:
            pass
    return jsonify({'message':'reloaded'}),201

# Run task Scheduler on server startup
tasks= taskManager.getActiveTasks()
print(tasks)
for task in tasks:
    if task[2] == "singer":
        job_id = f"ScheduledScraping_{task[0]}"
        scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_singer_data(url,category), trigger='interval', hours=task[4], max_instances=1)
    elif task[2] == "abans":
        job_id = f"ScheduledScraping_{task[0]}"
        scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_abans_data(url,category), trigger='interval', hours=task[4], max_instances=1)
    elif task[2] == "damro":
        job_id = f"ScheduledScraping_{task[0]}"
        scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_damro_data(url,category), trigger='interval', hours=task[4], max_instances=1)
    elif task[2] == "singhagiri":
        job_id = f"ScheduledScraping_{task[0]}"
        scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_singhagiri_data(url,category), trigger='interval', hours=task[4], max_instances=1)
    elif task[2] == "softlogic":
        job_id = f"ScheduledScraping_{task[0]}"
        scheduler.add_job(id=job_id, func=lambda url=task[1], category=task[3]: get_softlogic_data(url,category), trigger='interval', hours=task[4], max_instances=1)
    else:
        pass

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
    
