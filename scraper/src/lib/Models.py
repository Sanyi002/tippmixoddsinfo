import os
from peewee import *
import peewee
from .DatabaseObj import DatabaseObj

dbName = os.environ['DB_NAME']
dbHost = os.environ['DB_HOST']
dbUser = os.environ['DB_USER']
dbPassword = os.environ['DB_PASSWORD']
dbPort = os.environ['DB_PORT']

dbObj = DatabaseObj()
db = dbObj.connect(dbName, dbHost, dbUser, dbPassword, int(dbPort))
db.execute_sql("ALTER DATABASE " + dbName + " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;")

class UnsignedIntegerField(IntegerField):
    field_type = 'int unsigned'

class BaseModel(Model):
    class Meta:
        database = db

class SportCategories(BaseModel):
    sportID = peewee.PrimaryKeyField(primary_key=True)
    sportName = CharField()

SportCategories.create_table(True)


class MainEvents(BaseModel):
    eventID = peewee.PrimaryKeyField(primary_key=True)
    eventName = CharField()
    marketNumber = UnsignedIntegerField()
    sportID = IntegerField()
    homeTeamName = CharField()
    homeOdds = FloatField()
    drawOdds = FloatField(null = True)
    awayTeamName = CharField()
    awayOdds = FloatField()
    leagueName = CharField()
    countryName = CharField()
    eventDate = DateTimeField()
    timeZone = TimeField()

MainEvents._meta.auto_increment = False
MainEvents.create_table(True)


class ChangedOdds(BaseModel):
    ID = peewee.PrimaryKeyField(primary_key=True)
    eventID = IntegerField()
    homeOdds = FloatField()
    drawOdds = FloatField(null = True)
    awayOdds = FloatField()
    updatedTime = DateTimeField()

# if is not exist yet then create
ChangedOdds.create_table(True)