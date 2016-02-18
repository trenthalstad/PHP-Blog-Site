<!DOCTYPE html>
<!-- 
    Web Programming CSCI-210-02
    Rick Hull 
    January 25, 2016
-->
<?php

	require "Common.php";  //Database and Session_Start
	
	// Don't allow users to see this page without being logged in
	if(!isset($_SESSION['LogInStatus']))  
		{
		header("Location: index.php");	
		} 
?>

<html>
<head>
	<title>Manage Blog</title>
</head>
<body>
	<h3>Manage your blog articles</h3>

<?php
// Do on third pass
If (isset($_POST['deleteOK']))
	{
		//echo("BlogID: ".$_POST['editID']);  // For testing
		
		// Use ArticleID to delete the selected blog
		$sql_delete = "DELETE FROM articles_tbl "
		."WHERE ArticleID ='".$_POST['editID']."'";
		
		//echo ("<br>$sql_delete<br>"); //For testing
		
		$result = $pdo->query($sql_delete);
		
		if ($result->rowCount() > 0)  //If DELETE was successful, display message
		{
			echo ('<fieldset class = "message"');
			echo ('<p>Article was deleted.</p>');
			echo ('</fieldset>');
		}
	} // Now return to list of user's blogs, less the deleted one

// ---- Show user's blogs on first pass. Allow deletion with Delete button
If (!isset($_POST['delete']))
	{
		If (isset($_SESSION['Admin']))   //Allow administrator to view all articles
		{
			$sql_select = "SELECT userinfo_tbl.FirstName, "
						. "userinfo_tbl.LastName, articles_tbl.* "
						. "FROM articles_tbl INNER JOIN userinfo_tbl "
						. "ON articles_tbl.UserID=userinfo_tbl.UserID";
		//echo ("<br>$sql_select<br>"); //For testing
		}
		else  // Allow user only to manage only their own articles 
		{
			$sql_select = "SELECT userinfo_tbl.FirstName, "
						. "userinfo_tbl.LastName, articles_tbl.* "
						. "FROM articles_tbl INNER JOIN userinfo_tbl "
						. "ON articles_tbl.UserID=userinfo_tbl.UserID "
						. "And articles_tbl.UserID='".$_SESSION['UserID']."'";
		}
		//echo ("<br>$sql_select<br>"); //For testing
		$result = $pdo->query($sql_select);
		
		// Check to see if articles were returned
		if ($result->rowCount() > 0)
		{
			while ($row = $result->fetch()) // Display articles in a form
				{
				echo ('<form method="POST" action="BlogDelete.php">');
				echo ('<fieldset class = "article">');
				echo ("<b>Title: </b>".$row['Title']."<br>");
				echo ("<b>Author: </b>".$row['FirstName']." ".$row['FirstName']."<br>");
				echo ("<b>Date Added: </b>".$row['DateAdded']."<br>");
				echo ("<b>Article: </b>".$row['Article']."<br>");
				echo ('</fieldset>');
				// Save articleID as POST so it can be used as key in DELETE statement
				echo ('<input type="hidden" name="editID" value="'.$row['ArticleID'].'">'); 
				echo ('<input type="submit" class="button" name="delete" value="Delete">');
				echo ('</form>');
				echo ('<br><br>');
				}
		} else
			{ 
			echo ('Sorry. No articles found under your user login.<br>');
			}
	}
	else  // --- Display article to be delete and get confirmation (Second Pass) ----
	{
		//echo("BlogID: ".$_POST['editID']);  // For testing
		
		// Find article that was picked for deletion
		$sql_select = "SELECT userinfo_tbl.FirstName, "
					. "userinfo_tbl.LastName, articles_tbl.* "
					. "FROM articles_tbl INNER JOIN userinfo_tbl "
					. "ON articles_tbl.UserID=userinfo_tbl.UserID "
					. "And articles_tbl.ArticleID='".$_POST['editID']."'";
		//echo ("<br>$sql_select<br>"); //For testing
		
		$result = $pdo->query($sql_select);
		// Display the article to be deleted
		while ($row = $result->fetch()) 
			{
			echo ('<form method="POST" action="BlogDelete.php">');
			echo ('<fieldset class = "article">');
			echo ("<b>Title: </b>".$row['Title']."<br>");
			echo ("<b>Author: </b>".$row['FirstName']." ".$row['FirstName']."<br>");
			echo ("<b>Date Added: </b>".$row['DateAdded']."<br>");
			echo ("<b>Article: </b>".$row['Article']."<br>");
			echo ('</fieldset>');
			echo ('<input type="hidden" name="editID" value="'.$row['ArticleID'].'">'); 
			// Show confirm buttons for whether to delete or cancel
			echo ('Are you sure you want to delete? ');
			echo ('<input type="submit" name="deleteOK" value="Okay">');
			echo ('&nbsp;&nbsp;&nbsp;');
			echo ('<input type="submit" class="button" name="cancel" value="Cancel">');
			echo ('</form>');
			echo ('<br><br>');
			}	
	}  // Go to confirmation for deletion (second pass)
?>
    </body>
</html>