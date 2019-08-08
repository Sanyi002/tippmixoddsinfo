from peewee import *
import peewee
from .DatabaseObj import DatabaseObj

dbObj = DatabaseObj()
db = dbObj.connect('tippmix_test', 'tippmixoddsinfo_mysql', 'sanyi', '4l3x4nd3r', 3306)
db.execute_sql("ALTER DATABASE tippmix_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;")

class BaseModel(Model):
    class Meta:
        database = db

# initialization SportCategories table structure 
class SportCategories(BaseModel):
    sportID = peewee.PrimaryKeyField(primary_key=True)
    sportName = CharField()

# create table if is not exist
SportCategories.create_table(True)


class MainEvents(BaseModel):
    eventID = peewee.PrimaryKeyField(primary_key=True)
    eventName = CharField()
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
# if is not exist yet then create
MainEvents.create_table(True)


# ChangedOdds table structure
class ChangedOdds(BaseModel):
    ID = peewee.PrimaryKeyField(primary_key=True)
    eventID = IntegerField()
    homeOdds = FloatField()
    drawOdds = FloatField(null = True)
    awayOdds = FloatField()
    updatedTime = DateTimeField()

# if is not exist yet then create
ChangedOdds.create_table(True)