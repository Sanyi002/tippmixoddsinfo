class ApiProcess:

    def __init__(self, data):
        self.data = data

    def filterCategories(self):
        filteredCategories = []
        categoriesTmpList = []

        for category in self.data:
            if category['sportId'] not in categoriesTmpList:
                categoriesTmpList.append(category['sportId'])
                filteredCategory = {
                    "sportID" : category['sportId'],
                    "sportName" : category['sportName']
                }
                filteredCategories.append(filteredCategory)
        return filteredCategories

    def filterEvents(self):
        filteredEvents = []
        filteredEvent = {}

        for event in self.data:
            if event['isLive'] == 0 and event['markets'] != [] :
                if event['markets'][0]['outcomeCount'] <= 3 :
                    filteredEvent = {
                        "eventID" : event['eventId'],
                        "eventName" : event['eventName'],
                        "marketNumber": event['markets'][0]['marketRealNo'],
                        "sportID" : event['sportId'],
                        "leagueName" : event['competitionName'],
                        "countryName": event['competitionGroupName'],
                        "eventDate": event['eventDate'].replace("T", " ")[:-6],
                        "timeZone": event['eventDate'][-5:],
                        "homeTeamName": event['markets'][0]['outcomes'][0]['outcomeName'],
                        "homeOdds": event['markets'][0]['outcomes'][0]['fixedOdds']
                    }

                    if event['markets'][0]['outcomeCount'] == 3 :
                        filteredEvent.update({"drawOdds": event['markets'][0]['outcomes'][1]['fixedOdds'],
                        "awayTeamName": event['markets'][0]['outcomes'][2]['outcomeName'],
                        "awayOdds": event['markets'][0]['outcomes'][2]['fixedOdds']})
                    else :
                        filteredEvent.update({"drawOdds": None,
                        "awayTeamName": event['markets'][0]['outcomes'][1]['outcomeName'],
                        "awayOdds": event['markets'][0]['outcomes'][1]['fixedOdds']})
                    
                    filteredEvents.append(filteredEvent)
                    filteredEvent = {}
        return filteredEvents
