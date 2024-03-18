import sqlite3

conn = sqlite3.connect('task.db')

cursor = conn.cursor()
cursor.execute("CREATE TABLE IF NOT EXISTS tasks (id INTEGER PRIMARY KEY, url TEXT, platform TEXT,category TEXT, interval INTEGER, status TEXT)")
# cursor.execute("INSERT INTO tasks (url,platform,interval) VALUES ('aassaa','bbbssbb',5)")
# conn.commit()
# cursor.execute("DELETE FROM tasks WHERE id=2")
# conn.commit()
# rows = cursor.execute("SELECT * FROM tasks").fetchall()
# print(rows)


def getTasks():
    with sqlite3.connect('task.db') as conn:
        cursor = conn.cursor()
        rows = cursor.execute("SELECT * FROM tasks").fetchall()
        return rows
    

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
        cursor.execute("UPDATE tasks SET url = ?, platform = ?, category = ?, interval = ?, status = ? WHERE id = ?",(url,platform,category,interval,id, status))
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

print(type(getTasks()))
print(getTasks())