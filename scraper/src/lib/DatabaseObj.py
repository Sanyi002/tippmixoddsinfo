from peewee import *
import peewee

class DatabaseObj:

    def connect(self, databaseName, host, user, password, port):
        db = MySQLDatabase(databaseName, user=user,  password=password, host=host, port=port )
        return db