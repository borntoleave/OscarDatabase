//http://csc321-ubun64amp.cs.wfu.edu/~groupc/Page2.php

<?php
	session_start();
 // Simple HTML header
?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 		<title>List of database tables</title>
 	</head>

 	<body>

<?php
// Example that connects to a database, lists the tables to choose from, then lists the table content

//******************************************//
//*********Connect to database**************//
//******************************************//
        // $password is in file that can't be accessed from the web 
       // require '../password.php';
	// Set connection variables
	$host     = '10.104.251.10';
	$username = 'groupc';
	$database = 'oscar';
	$password = '19491001'

	// Connect to host
 	$connection = mysql_connect($host, $username, $password)
 		      or die ("Error: could not connect to host ". $host. " " .mysql_error()); 
 	
 	// Select database (note: connection & database will be selected by default for rest of session)
 	$db = mysql_select_db($database, $connection) 
 	      or die ("Error: could not select database " . $database . " " . mysql_error());  			
 			
//******************************************//
//*********Query  database******************//
//******************************************// 		
	// Send query to MySQL and store result reference in a variable
	$r = mysql_query("SHOW TABLES FROM oscar", $connection)
                    or die ("Error: could not query database " . mysql_error());

	// Stop php for a bit to embed some HTML and start a form
	?>

	<h1>Please select a table from the Chinook database</h1> 
	<form action = "Page2.php" method = "post" >
		<input type = "hidden" name = "database" value = "oscar" >
		<select name = "db_table">		
						
	<?php
	// Fetch results row by row as long as there are rows.
	// store in $row and use to make a form element
	while ( $row = mysql_fetch_array($r) ){			
		// Another way to output HTML, while embedding PHP results
		echo "<option> ".$row['Tables_in_'.$database]."</option>";		
	}

	// Stop PHP again to close the form tags
	?>
		</select>
		   <input type = "submit" >
		</form>
	</body>
</html>

<?	
	// Close connection to host - even thought it will be needed in next page.
	mysql_close($connection);

?>

