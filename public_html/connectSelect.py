# load connector library
import mysql.connector
from mysql.connector import errorcode
      
def doQuery( connection ):  # function definition
    """Runs a query on a connection and reports the result."""
    cursor = connection.cursor()
    
    query = """select Title, sum( UnitPrice ) as cost
               from  Album natural join Track
               group by AlbumId
               order by cost desc"""
    
    cursor.execute( query )
    
    print( "Album titles and cost of tracks" )
    print( "Title\t\t\t\tCost" )
    for (Title, cost) in cursor:
        print( Title, "\t\t\t$", cost )
        
    cursor.close()

# it's always a best practice to utilize exception handling
try:
    # establish a login connection to the database
    connection = mysql.connector.connect(host='10.104.251.10',
                                         user='scott',
                                         password='tiger',
                                         database='Chinook')
    # call a function to run a query and print results
    doQuery( connection )

except mysql.connector.Error as err:    # exception handling
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("Error:  probably in user name or password")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("Database does not exist")
    else:
        print(err)
        
else:  # free up the database connection
    connection.close()