<?php
	session_start();
		
 // Simple HTML header
?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 		<title>Content of database table</title>
 	</head>

 	<body>
 	<h1>Contents of table
            <i> <?php echo $_POST["db_table"];?> </i> 
               of database 
            <i> <?php echo $_POST["database"];?></i></h1>
 <?php
	
//******************************************//
//*********Connect to database**************//
//******************************************//
        // $password is in file that can't be read from the web 
        require '../password.php';
	// Set connection variables
	$host     = '10.104.251.10';
	$username = 'groupc';
	$database = 'oscar';
	
	// Connect to host
 	$connection = mysql_connect($host, $username, $password)
 				 or die ("Error: could not connect to host ". $host. " " .mysql_error()); 
 	
 	// Select database	(note: connection & database will be selected by default for rest of session)
 	$db = mysql_select_db($database, $connection) 
 			or die ("Error: could not select database " . $database . " " . mysql_error()); 

//******************************************//
//*********Query  database******************//
//******************************************// 
	
 	// Catch variable submitted and use in next query 
	
	$q = "SELECT * FROM ". $_POST['db_table'] ; 
echo $q;
	
	// Send query
	$r = mysql_query($q);
	
	// Get number of columns from query result
	$numbercols = mysql_num_fields($r);
	
	// Start HTML table and header row. Put in some inline formatting because we're too lazy to make a CSS 
	echo " <table border = 1> <tr>" ;
	
	// Make first row of HTML table using column names
	for (	$col = 0; $col < $numbercols ; $col++ ) {
		
		// Get field name at column offset $col, and echo within header tags.
       echo "<th>". mysql_field_name($r, $col) . "</th>";
       
   }
   	// End header row
   	
   	echo "</tr> " ; 
	
	// Loop through results and display. MYSQL_ASSOC is to make sure the output is as an associative array.
	// Otherwise there will be two copies of each column, one indexed numerically and one associatively.
	while ( $row = mysql_fetch_array( $r , MYSQL_ASSOC) ) {
		
		// New row: make a new table row
		echo "<tr>";
		
		// Result row is an associative array, so we could have gotten the column names this way as well
		// Allows to loop through columns without knowing the column names
		foreach ( $row as $key => $value ){
			
			// New cell: make a new table cell
			echo "<td>";
			
			// Display value
			echo $value;
			
			// Close table cell
			echo "</td>";
		}
		
		// End table row
		echo "</tr>";
		
	}
	// Close connection
	mysql_close($connection);
	// Close all tags
	
?>
		</table>
           <BR><BR>
           <form action = "Page1.php" method = "post">
           <button type = "submit" >Back</button>
	</body>
</html>
