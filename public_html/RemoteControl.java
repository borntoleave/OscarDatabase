import java.sql.*;
import java.io.*;
import java.lang.Math;

// Java application illustrating a database query with
// use of the returned metadata.
//
// Stan Thomas 
// 11/20/14

public class RemoteControl {                            

   // this is a Java application
   public static void main(String[] args)
   		throws SQLException, IOException { 
            
      // Attempt to register the JDBC driver for MySQL
      try { 
           Class.forName("com.mysql.jdbc.Driver").newInstance();
      } catch (Exception ex) { 
           System.out.println("Cannot register com.mysql.jdbc.Driver");
      }

      // Attempt to connect to the database and execute an SQL statement
      try {

           // note details of connection process
           Connection conn =
              DriverManager.getConnection("jdbc:mysql://10.104.251.10/Chinook?" +
			                              "user=scott&password=tiger");

           // ---------------------------------------------------------
		   // The details of this application start here
		   System.out.println("Welcome to your personal SQL Remote Control Center\n");
		   System.out.print("SQL> ");
		   Statement stmt = conn.createStatement();
		   do {
                // read query from the keyboard
		   		String query = readQuery();
		   		if( query.equals("exit"))
		   			break;

				// try to execute the query
		   		ResultSet rset;
		   		try {
		   			rset = stmt.executeQuery(query);		   			
		   		} catch (SQLException e) {
		   			System.out.println("Not a well formed query");
		   			continue;
		   		}
		   		
		   		// process the results
		   		// 	start by examining the MetaData
		   		ResultSetMetaData rsetmd = rset.getMetaData();
		   		int nCols = rsetmd.getColumnCount(); // number of columns
		   		int[] printWidths = new int[nCols+1];// to store widths
		   		// Determine amount of space to allocate to each column
		   		for(int i=1; i<=nCols; i++) {
		   			System.out.print(rsetmd.getColumnName(i)+" ");
		   			int dataWidth = rsetmd.getColumnDisplaySize(i)+1;
		   			int nameWidth = rsetmd.getColumnName(i).length()+1;
		   			printWidths[i] = Math.max(dataWidth, nameWidth);
		   			for(int k=0; k<(dataWidth-nameWidth); k++)
		   			   System.out.print(" ");
		   		}
		   		System.out.println("");
		   		
		   		//     now display the actual data, row by row
		   		while(rset.next()) {
		   			for(int i=1; i<=nCols; i++){
		   				String val = rset.getString(i);
		   				int dataWidth;
		   				
		   				if( rset.wasNull() ) {
		   					System.out.print("NULL ");
		   					dataWidth = 5;
		   				} else {		   						   				
		   					System.out.print(val+" ");
		   					dataWidth = val.length()+1;
		   			    }

		   			    for(int k=0; k<(printWidths[i]-dataWidth); k++)
		   					System.out.print(" ");
		   			}
		   			System.out.println("");
		   		}
		   		
		   } while (true);
		   stmt.close();
		   conn.close();
		   System.out.println("Thank you for using the Remote Control Center\n");

       } catch (SQLException ex) {
           // handle any errors 
           System.out.println("SQLException: " + ex.getMessage()); 
           System.out.println("SQLState: " + ex.getSQLState()); 
           System.out.println("VendorError: " + ex.getErrorCode()); 
       } // end catch
    } // end main
    
    //readQuery helper function
    static String readQuery() {
    	try{
    		StringBuffer buffer = new StringBuffer();
    		System.out.flush();
    		int c = System.in.read();
    		while( c != ';' && c != -1){
    			if( c != '\n')
    				buffer.append((char)c);
    			else {
    				buffer.append(" ");
    				System.out.print("SQL> ");
    				System.out.flush();
    			}
    			c = System.in.read();    			
    		}
    		return buffer.toString().trim();    		
    	} catch (IOException e) {
    		return "";
    	}
    }   
} // end RemoteControl
