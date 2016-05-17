<?php

/* Define MySQL connection details and database table name */ 
$SETTINGS["hostname"]='10.104.251.10';
$SETTINGS["mysql_user"]='groupc';
$SETTINGS["mysql_pass"]='19491001';
$SETTINGS["mysql_database"]='oscar';
$SETTINGS["data_table1"]='Movie';
$SETTINGS["data_table2"]='Director';
$SETTINGS["data_table3"]='Starring'; 
$SETTINGS["data_table4"]='Genre'; 
$SETTINGS["data_table5"]='Company'; 
$SETTINGS["data_table6"]='Award'; 

/* Connect to MySQL */

if (!isset($install) or $install != '1') {
    $connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
	$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
};
?>
