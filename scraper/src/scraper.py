# Script Name: scraper.py
# Version: 1.1
# Author: Sandor Szabo
# Created: 2018.06.12
# Description: This is the main entry point

#!/usr/bin/env python3

# Dependencies 
import json
from urllib.request import urlopen
from lib.ApiProcess import ApiProcess
from lib.DatabaseObj import DatabaseObj
from lib.Models import *
from lib.DbFunctions import DbFunctions

# just for test porposuses
import time
start_time = time.time()

# Get all information from API and convert it to JSON
# TODO: Error handling if API is not reachable 
url = 'https://api.tippmix.hu/tippmix/search'
data = urlopen(url).read().decode('utf8')
obj = json.loads(data)

# select important data from all data 
events = obj['data']['events']

# instantiate object for API processing
apiProc = ApiProcess(events)

# get all sport category from API data (distinct)
filteredCategories = apiProc.filterCategories()

# get all important data about events from API data
filteredEvents = apiProc.filterEvents()

# instantiate object for DB functions
dbFunctions = DbFunctions()

# get all sport ID from the DB
dbCategories = dbFunctions.getAllSportID(SportCategories)

# filter out the new categories and push them in the DB
newCategoryNumber = dbFunctions.saveNewCategories(SportCategories, filteredCategories, dbCategories)
print(newCategoryNumber, "db új kategória került az adatbázisba!")

# get all event ID from the DB
dbEventIDs = dbFunctions.getAllEventID(MainEvents)

saveResults = dbFunctions.saveNewEvents(MainEvents, filteredEvents, dbEventIDs)
newEventsNumber = saveResults[0]
alreadySavedEvents = saveResults[1]

changesResult = dbFunctions.saveChanges(ChangedOdds, MainEvents, alreadySavedEvents)
changesNumber = changesResult[0]
newChangesNumber = changesResult[1]
print(newEventsNumber, "db új esemény került az adatbázisba!")
print(changesNumber, "db odds módosulás lett felvéve az adatbázisba!")
print(newChangesNumber, "db új odds módosulás lett felvéve az adatbázisba!")

print("\n--- %s seconds --- \n" % (time.time() - start_time))
