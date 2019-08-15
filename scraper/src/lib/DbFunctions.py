from peewee import *
import peewee
import datetime
import sys

class DbFunctions:

    def getAllSportID(self, Model):
        query = Model.select(Model.sportID)
        dbCategories = []
        for category in query:
            dbCategories.append(category.sportID)
        return dbCategories

    def saveNewCategories(self, Model, filteredCategories, dbCategories):
        savedCatCounter = 0
        for sportCategory in filteredCategories:
            if sportCategory['sportID'] not in dbCategories:
                Model.create(sportID = sportCategory['sportID'], sportName = sportCategory['sportName'])
                savedCatCounter += 1
        return savedCatCounter

    def getAllEventID(self, Model):
        query = Model.select(Model.eventID)
        dbEventIDs = []
        for event in query:
            dbEventIDs.append(event.eventID)
        return dbEventIDs

    def saveNewEvents(self, Model, filteredEvents, dbEventIDs):
        savedEventCounter = 0
        alreadySavedEvents = []
        for event in filteredEvents:
            if event.get('eventID') not in dbEventIDs :
                Model.create(
                    eventID = event['eventID'],
                    eventName = event['eventName'],
                    marketNumber = event['marketNumber'],
                    sportID = event['sportID'],
                    leagueName = event['leagueName'],
                    countryName = event['countryName'],
                    eventDate = event['eventDate'],
                    timeZone = event['timeZone'],
                    homeTeamName = event['homeTeamName'],
                    homeOdds = event['homeOdds'],
                    drawOdds = event['drawOdds'],
                    awayTeamName = event['awayTeamName'],
                    awayOdds = event['awayOdds']
                )
                savedEventCounter += 1
            else :
                alreadySavedEvents.append(event)
        counters = [savedEventCounter, alreadySavedEvents]
        return counters
    
    def saveChanges(self, Model, MainModel, filteredEvents):
        now = datetime.datetime.now()
        now = now.strftime("%Y-%m-%d %H:%M:%S")
        changesCounter = 0
        newChangesCounter = 0
        for event in filteredEvents:
            try:
                latestChangedOdds = Model.select().where(Model.eventID == event['eventID']).order_by(Model.ID.desc()).get()
                if latestChangedOdds.homeOdds != event['homeOdds'] or latestChangedOdds.drawOdds != event['drawOdds'] or latestChangedOdds.awayOdds != event['awayOdds']:
                    Model.create(
                        eventID = event['eventID'],
                        homeOdds = event['homeOdds'],
                        drawOdds = event['drawOdds'],
                        awayOdds = event['awayOdds'],
                        updatedTime = now
                    )
                    changesCounter += 1
            except:
                mainTableEvent = MainModel.get(MainModel.eventID == event['eventID'])
                if mainTableEvent.homeOdds != event['homeOdds'] or mainTableEvent.drawOdds != event['drawOdds'] or mainTableEvent.awayOdds != event['awayOdds']:
                    Model.create(
                        eventID = event['eventID'],
                        homeOdds = event['homeOdds'],
                        drawOdds = event['drawOdds'],
                        awayOdds = event['awayOdds'],
                        updatedTime = now
                    )
                    newChangesCounter += 1
        result = [changesCounter, newChangesCounter]
        return result