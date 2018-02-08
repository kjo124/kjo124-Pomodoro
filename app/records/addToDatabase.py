#! /usr/bin/env python -Wd

# a script for adding new pomodoros to the database, also updates the JSON file
# for the site when a pomodoro is added
# sample run: python3 addToDatabase.py 2018-01-18 12:25:13 Personal Personal test
import sqlite3
import json
import sys

# connect to database
conn = sqlite3.connect('../pomodoro.db')
debug = False;

# used for producing the JSON file
def json_factory(cursor, row):
    d = {}
    for idx, col in enumerate(cursor.description):
        d[col[0]] = row[idx]
    return d

# all the heavy lifting for adding to the database handled here
def addToDatabase(startDate,startTime,thisClass,thisType,assignment):
    if debug:
        print("startDate: " + startDate + "\n" + "startTime: " + startTime +
        "\n" + "thisClass: " + thisClass + "\n" + "type: " + thisType + "\n" +
        "assignment: " + assignment)

    # the entry to be added
    entry = [(startDate, startTime, thisClass, thisType, assignment)]
    # place it into the row
    # c.executemany("insert into pomodoros values(?, ?, ?, ?, ?)", entry )
    # save the table
    # conn.commit()
    # every time you add a row might as well regenerate the JSON while were connected
    c.execute("select * from pomodoros")
    results = c.fetchall()
    with open('records.json', 'w') as outfile:
        json.dump(results, outfile)

conn.row_factory = json_factory
c = conn.cursor()

# example
# addToDatabase("2018-01-18", "12:25:13", "test", "Personal", "Job")
addToDatabase(str(sys.argv[1]), str(sys.argv[2]), str(sys.argv[3]), str(sys.argv[4]), str(sys.argv[5]))

conn.close()
