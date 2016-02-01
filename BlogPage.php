<!DOCTYPE html>
<!-- 
    Web Programming CSCI-210-02
    Rick Hull 
    January 25, 2016
-->
<?php
	require "Common.php";  //Database and Session_Start
?>

<html>
<head>
    <meta charset="UTF-8">
	<title>Blog Page</title>
</head>
<body>
	<h3>Blog Page</h3>
		
<?php
	// Get articles, plus user names from other table
	$sql_select = 'SELECT userinfo_tbl.FirstName, '
	.'userinfo_tbl.LastName, articles_tbl.* '
	.'FROM articles_tbl INNER JOIN userinfo_tbl '
	.'ON articles_tbl.UserID=userinfo_tbl.UserID ';

	//echo ("<br>$sql_select<br>"); //For testing
	
	$result = $pdo->query($sql_select);

	// Display articles one  by one
	while ($row = $result->fetch()) 
		{
		echo("<b>".$row['Title']."</b><br>");
		echo("<b>Contributor: </b>".substr($row['FirstName'],0,1).$row['LastName']."<br>");
		echo ('<fieldset class = "article">');
		echo("<p>".$row['Article']."</p>");
		echo ('</fieldset><br><br>');
		}
?>
   
    </body>
</html>