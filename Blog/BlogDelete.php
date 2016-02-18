<!DOCTYPE html>

<?php

	require "Common.php";  //Database and Session_Start
	
	// Don't allow users to see this page without being logged in
	if(!isset($_SESSION['LoginStatus']))  
		{
		header("Location: index.php");	
		} 
?>

<html>
<head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css"  href="css/styles.css">

        <script type="text/javascript" src="js/modernizr.custom.js"></script>
	<title>Manage Blog</title>
</head>
<body>
   <?php
        include "menu.php";
        ?>
				<div class="container toppad content2">
		<div class="row">
	
		<div class="col-md-12">
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
</div>
</div>
</div>
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/SmoothScroll.js"></script>
        <script type="text/javascript" src="js/jquery.isotope.js"></script>

        <script src="js/owl.carousel.js"></script>

        <!-- Javascripts
        ================================================== -->
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>