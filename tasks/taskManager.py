import sqlite3

def getTasks():
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        rows = cursor.execute("SELECT * FROM tasks").fetchall()
        return rows
    
def getActiveTasks():
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        rows = cursor.execute("SELECT * FROM tasks WHERE status = 'active'").fetchall()
        return rows
    
def getTaskByID(id):
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        row = cursor.execute("SELECT * FROM tasks WHERE id = ? ",(id,)).fetchone()
        return row
    
def addTask(url,platform,category,interval):
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        try:
            cursor.execute("INSERT INTO tasks (url, platform, category, interval, status) VALUES (?, ?, ?, ?, ?)",(url,platform,category,interval, "active"))
            conn.commit()
            return True
        except:
            return False

def editTask(id,url,platform,category,interval, status):
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        cursor.execute("UPDATE tasks SET url = ?, platform = ?, category = ?, interval = ?, status = ? WHERE id = ?",(url,platform,category,interval,status, id))
        conn.commit()
        if cursor.rowcount > 0:
            return True
        else:
            return False
        
def deleteTask(id):
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        cursor.execute("DELETE from tasks WHERE id = ?",(id,))
        conn.commit()
        if cursor.rowcount > 0:
            return True
        else:
            return False
        
def setState(id,state):
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        cursor.execute("UPDATE tasks SET status = ? WHERE id = ?",(state,id))
        conn.commit()
        if cursor.rowcount > 0:
            return True
        else:
            return False
        
def getActiveTaskCount():
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        cursor.execute("SELECT COUNT(*) FROM tasks WHERE status = 'active'")
        row = cursor.fetchone()
        if row:
            return row[0]
        else:
            return 0 
        
def getTaskCount():
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        cursor.execute("SELECT COUNT(*) FROM tasks")
        row = cursor.fetchone()
        if row:
            return row[0]
        else:
            return 0