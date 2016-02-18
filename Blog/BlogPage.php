<!DOCTYPE html>

<?php
	require "Common.php";  //Database and Session_Start
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
		<style>
.bob ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #B6B6B4;
}

.bob li {
    float: left;	
}

.bob li a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.bob li a:hover {
    background-color: #111;
}
</style>

	<title>Blog Page</title>
</head>
<body>
        <?php
        include "menu.php";
        ?>
	        <div class="container content">
            <div class="row">
                <div class="col-md-12">

                    <h2><strong>Blogs</strong></h2><br>
                       
                </div>
            </div>
        </div>
		<div class="container text-center bob">
			<div class="row">
				<div class="col-md-12">
					<nav>
						<ul>
							<li> <a href="BlogAdd.php">Add Blog</a></li> 
							<li> <a href="BlogDelete.php">Delete Blog</a></li> 
						</ul>
					</nav>
				</div>	
			</div>	
		</div>
	
	<div class="container toppad">
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
					
			
			/*
			echo("<article>");
			echo("<div class='post-heading'");
				echo("<h3>Title:".$row['Title']."</h3>"."<br>");
				echo("<h5>Contributor:".substr($row['FirstName'],0,1).$row['LastName']."</h5>"."<br>");
				echo ('<fieldset class = "article">');
				echo("<p>".$row['Article']."</p>");
				echo ('</fieldset><br><br>');
			echo("</div>");
		echo("</article>");
		*/
		}
	
?>
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