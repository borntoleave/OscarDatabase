import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class ConnectMe {
   public static void main( String[] args ){
      Connection conn = null;
      try {
	         Class.forName("com.mysql.jdbc.Driver").newInstance();
	         conn = DriverManager.getConnection("jdbc:mysql://10.104.251.10/Chinook?" +
			                                    "user=scott&password=tiger");
			 System.out.println("Connected");
	  } catch (Exception ex) {
	     System.out.println("Help me. Something is wrong.");
		 // handle any errors
		 System.out.println(ex);
	  }
   }
}
