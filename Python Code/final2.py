import cv2
import numpy as np
import face_recognition
import os
from pandas import read_csv
from datetime import datetime
from csv import writer
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="att"
)
mycursor = mydb.cursor()
print("You're connected to database: ")

print("##### Welcome to AUTO-ATTENDANCE #####\n")
path = 'Training_images'
images = []
classNames = []
myList = os.listdir(path)
print("Loading images from training images...")

for cl in myList:
    curImg = cv2.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])

def findEncodings(images):
    encodeList = []
    print("Encoding images for recognition...")
    for img in images:
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)[0]
        encodeList.append(encode)
    return encodeList

def markAttendance(name, status):
    now = datetime.now()
    dtString = now.strftime('%H:%M:%S')
    dt = now.strftime("%d/%m/%Y")
    val =(name,status,dtString,dt) 

    data = read_csv('Attendance.csv')
    nameList = data['Name'].tolist()
    with open('Attendance.csv', 'a') as f:
        write = writer(f)
        if name not in nameList:
            row = [name, dtString, status]
            write.writerow(row)
            nameList.append(name)
            print(f"Attendance for {name} has been marked as {status}!!")

            q2 = " INSERT INTO attendance  VALUES(%s, %s, %s,%s)  "
            mycursor.execute(q2,val)
            mydb.commit()
            print(mycursor.rowcount, "record inserted.")

encodeListKnown = findEncodings(images)
print('Encoding Complete!!\n')
cap = cv2.VideoCapture(0)

while True:
    success, img = cap.read()
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS,facesCurFrame)
    for encodeFace, faceLoc in zip(encodesCurFrame,facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)
        if matches[matchIndex]:
            name = classNames[matchIndex]
            y1, x2, y2, x1 = faceLoc
            y1, x2, y2, x1 = y1 * 4, x2 * 4, y2 * 4, x1 * 4
            cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
            cv2.rectangle(img, (x1, y2 - 35), (x2, y2), (0, 255, 0), cv2.FILLED)
            cv2.putText(img, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2) 
            markAttendance(name, 'Present')
            cv2.imshow('Webcam', img)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        data = read_csv('Attendance.csv')
        nameList = data['Name'].tolist()
        for name in classNames:
            if name not in nameList:
                markAttendance(name, 'Absent')
        break

cap.release()
cv2.destroyAllWindows()