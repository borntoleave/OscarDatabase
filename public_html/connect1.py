# load connector library
import mysql.connector
from mysql.connector import errorcode

# it's always a best practice to utilize exception handling
try:
    # establish a login connection to the database
    connection = mysql.connector.connect(host='10.104.251.10',
                                         user='scott',
                                         password='tiger',
                                         database='Chinook')
    # typically we will now use SQL commands to do something useful here
    print("Connected to Chinook")

except mysql.connector.Error as err:    # exception handling
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("Error:  probably in user name or password")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("Database does not exist")
    else:
        print(err)
        
else:  # free up the database connection
    connection.close()
        
    