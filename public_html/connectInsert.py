# load connector library
import mysql.connector
from mysql.connector import errorcode
      
def doInsert( connection ):  # function definition
    """Insert data into the Artist table."""
    cursor = connection.cursor()
    
    SQL = """INSERT INTO Artist(Name)
             VALUES ('Tom Jones')"""
    
    # Insert new Artist
    cursor.execute(SQL)
    ArtistId = cursor.lastrowid
    print("Added Tom Jones as artist #", ArtistId)
        
    # Make sure data is committed to the database
    connection.commit()
    cursor.close()    

# it's always a best practice to utilize exception handling
try:
    # establish a login connection to the database
    connection = mysql.connector.connect(host='10.104.251.10',
                                         user='scott',
                                         password='tiger',
                                         database='Chinook')
    # call a function to run a query and print results
    doInsert( connection )

except mysql.connector.Error as err:    # exception handling
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("Error:  probably in user name or password")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("Database does not exist")
    else:
        print(err)
        
else:  # free up the database connection
    connection.close()