
<!DOCTYPE html>

<?php
	require "Common.php";  //Database and Session_Start
	/*)
	// Don't allow users to see this page without being logged in
	if(!isset($_SESSION['LoginStatus']))  
		{
		header("Location: index.php");	// Could be login page also
		} 	
		*/
		$_SESSION['UserID']=1;
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
	<title>Add Blog</title>
</head>
<body>
 <?php
        include "menu.php";
        ?>
		
		<div class="container toppad content">
		<div class="row">
	
		<div class="col-md-12">
	
<?php
// Exit if cancel button selected 
if (isset($_POST['cancelBtn']))
	{
		header("Location: BlogPage.php");
	}
	
// Save article to table on the second pass

if (isset($_POST['saveBtn']))
	{
		//echo ("Saved<br><br>");  // For testing
			
		//Write the sql statement with placehonders
		$sql_insert = "INSERT INTO articles_tbl "
			. "(UserID, Title, Article, DateAdded, "
			. "DateEdited, DateDeleted, Deleted) "
			. "VALUES (:UserID, :Title, :Article, "
			. ":DateAdded, :DateEdited, :DateDeleted, :Deleted)";
			
			// Prepare the sql statement
			$sqlh_input = $pdo->prepare($sql_insert);	
			
			// Sanitize data to prevent hacking
			$UserID = $_SESSION['UserID'];
			$Title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
			$Article = filter_var($_POST['blogText'],FILTER_SANITIZE_STRING);
			$DateAdded = date("Y-m-d");  // Current date
			$DateEdited = "0000-00-00";    // Null Date
			$DateDeleted = "0000-00-00";   // Null Date
			$Deleted = false;
			
			// Bind data to column names 
			$sqlh_input->bindparam(":UserID", $UserID);
			$sqlh_input->bindparam(":Title",$Title);
			$sqlh_input->bindparam(":Article", $Article);
			$sqlh_input->bindparam(":DateAdded",$DateAdded);
			$sqlh_input->bindparam(":DateEdited",$DateEdited);
			$sqlh_input->bindparam(":DateDeleted",$DateDeleted);
			$sqlh_input->bindparam(":Deleted",$Deleted);
			// Insert the data
			$sqlh_input->execute();
			
			// --- Show article as confirmation	---	
			$sql_select = "Select * from articles_tbl "
						 ."Order by ArticleID Desc Limit 1";
		
			//echo ("<br>$sql_select<br>"); //For testing
			
			$result = $pdo->query($sql_select);
			// Display article
			$row = $result->fetch(); 
			echo("<h4>".$row['Title']."</h4>");
			echo("<p>".$row['Article']."</p><br>");
			echo("<b>Article successfully added</b>");
	}
	else
	{
	// Show input screen
	echo ('<h3>Add A Blog Article</h3>');
	echo ('<div class="blogform">');
	echo ('<form method="POST" action="BlogAdd.php" id="editBlog">');
	echo ('<b>Title:</b> <input type="text" name="title">');
	echo ('<br><b>Blog</b><br>'); 
	echo ('<textarea rows="10" cols="75" name="blogText" form="editBlog">');
	echo ('</textarea><br>');
	echo ('&nbsp;&nbsp;&nbsp;');
	echo ('<input type="submit" name="saveBtn" value="Save">');	
	echo ('<input type="submit" name="cancelBtn" value="Cancel">');	
	echo ('</form>');
	echo ('</div> ');
	}
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