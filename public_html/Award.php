<?php
error_reporting(0);
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Award Search</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style>
BODY, TD {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
</head>
<div class="tableImage" >
<img src="leo.jpg" >
</div>

<body>
<form id="form1" name="form1" method="post" action="Award.php">
<label>AwardTitle:</label>
<input type="text" name="string" id="string" value="<?php echo stripcslashes($_REQUEST["string"]); ?>" />
<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table6"]." ORDER BY Year";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	
?>
<input type="submit" name="button" id="button" value="Filter" />
  </label>
  <a href="Award.php"> 
  reset</a>
</form>
<br /><br />
<table width="400" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td width="40" bgcolor="#CCCCCC"><strong>AwardID</strong></td>
    <td width="250" bgcolor="#CCCCCC"><strong>Title</strong></td>
    <td width="80" bgcolor="#CCCCCC"><strong>Year</strong></td>
    <td width="60" bgcolor="#CCCCCC"><strong>MovieID</strong></td>
  </tr>
  <a href="OscarHome.php"> 
  Go Back To Oscar Home</a>
  <br><br/>
<?php
if ($_REQUEST["string"]<>'') {
	$search_string = " AND (Title LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR Title LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";	
}
if ($_REQUEST["Name"]<>'') {
	$search_Name = " AND Name='".mysql_real_escape_string($_REQUEST["Name"])."'";	
}

else {
	$sql = "SELECT * FROM ".$SETTINGS["data_table6"]." WHERE AwardID>0".$search_string.$search_city;
}

	
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
if (mysql_num_rows($sql_result)>0) {
	while ($row = mysql_fetch_assoc($sql_result)) {
?>
  <tr>
    <td><?php echo $row["AwardID"]; ?></td>
    <td><?php echo $row["Title"]; ?></td>
    <td><?php echo $row["Year"]; ?></td>
    <td><?php echo $row["MovieID"]; ?></td>
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="4">No results found.</td>
<?php	
}
?>
</table>

</body>
</html>
