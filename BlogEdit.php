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
	<title>Manage Blogs</title>
</head>
<body>
	<h3>Delete A Blog</h3>

<?php
	if (isset($_POST['saveBtn']))
	{
		// echo ("Save<br><br>");  // For testing
		$sql_update =  "UPDATE  articles_tbl "
					. "SET Title = :Title, "
					. "Article = :Article, "
					. "DateEdited = :DateEdited "
					. "WHERE ArticleID = '".$_POST['editID']."'";
		// echo ($sql_update."<br>"); // For testing
		$sqlh_edit = $pdo->prepare($sql_update);
		$Title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
		$Article = filter_var($_POST['blogText'],FILTER_SANITIZE_STRING);
		$DateEdited = date("Y-m-d");
		$sqlh_edit->bindparam(":Title",$Title);
		$sqlh_edit->bindparam(":Article",$Article);
		$sqlh_edit->bindparam(":DateEdited",$DateEdited);
		$sqlh_edit->execute();
	}	
	
	if (isset($_POST['delBtn']))
	{
		// echo ("Delete<br><br>");  // For testing
		$sql_update = "UPDATE  articles_tbl "
					. "SET Deleted = true, "
					. "DateDeleted = ".date("Y-m-d")." "
					. "WHERE ArticleID = '".$_POST['editID']."'";
		//echo ($sql_update."<br>"); // For testing
		$result = $pdo->query($sql_update);
	}
		
	if (!isset($_POST['edit']))
	{
		$sql_select = "Select * from articles_tbl where UserID ='".
		              $_SESSION['UserID']."' and Deleted = false";
		//echo ("<br>$sql_select<br>"); //For testing
		$result = $pdo->query($sql_select);
			
		while ($row = $result->fetch()) 
			{
			echo ('<form method="POST" action="BlogEdit.php">');
			echo ("Title:".$row['Title']."<br>");
			echo ("Date Entered: ".$row['DateEntered']."<br>");
			echo ("Article: ".substr($row['Article'],0,40)."<br>");
			echo ('<input type="hidden" name="editID" value="'.$row['ArticleID'].'">'); 
			echo ('<input type="submit" name="edit" value="Edit">');
			echo ('</form>');
			echo ('<br><br>');
			}
	}
	else
	{
		//echo ('<br>Article ID: '.$_POST['editID'].'<br>');  // For testing
		// Get the article, based on the ArticleID
		$sql_select = "Select * from articles_tbl where ArticleID ='".$_POST['editID']."'";	
		$result = $pdo->query($sql_select);
		$row = $result->fetch();
		
		echo ('<div class="editform">');
			echo ('<form method="POST" action="BlogEdit.php" id="editBlog">');
			echo ('Title: <input type="text" name="title" value="'.$row['Title'].'">');
			echo ('<br>Blog:<br>'); 
			echo ('<textarea rows="10" cols="75" name="blogText" form="editBlog">');
			echo ($row['Article'].'</textarea><br>');
			echo ('<input type="hidden" name="editID" value="'.$row['ArticleID'].'">'); 
			echo ('<input type="submit" name="saveBtn" value="Save">&nbsp;&nbsp;');	
			echo ('<input type="submit" name="delBtn" value="Delete">');	
			echo ('</form>');
		echo ('</div>'); 
	}
?>
    </body>
</html>