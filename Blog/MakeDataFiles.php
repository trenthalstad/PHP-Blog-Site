<!DOCTYPE html>
<!-- 
    Make Mock Data for BlogCity
    Rick Hull 
    Jan. 28, 2016
-->

<html>
    <head>
    <title>Load Data</title>    
    </head>
    <body>
	<h3>Create Mock Data </h3>
	
<?php
 try
	{
	$pdo=new PDO("mysql:host=127.0.0.1;dbname=BlogCity_db",'root','');
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$dbstatus = "Good database connection";
	}
catch (PDOException $e)
	{
	$dbstatus = "Database connection failed <br>".
		$e->getMessage();	
	}
	

// ------------ Load User table -----------	
	//Set up SQL statement
	$sql_input = "INSERT INTO  userinfo_tbl "
                . "(UserName, "
				. "FirstName, "
                . "LastName, "
                . "Address, "
                . "City, "
                . "State, "
                . "Zip, "
                . "Email, "
                . "Password) "
                . "VALUES ("
                . ":UserName, "
                . ":FirstName, "
                . ":LastName, "
                . ":Address, "
                . ":City, "
                . ":State, "
                . ":Zip, "
                . ":Email, "
                . ":Password) ";
				
				echo ($sql_input);  // For testing
				echo ("<br><br>");      // For testing
						

			for ($c=1; $c < 11; $c++) 
			{ 
				$UserName = "UserName".strval($c);
				$FirstName = "FirstName".strval($c);
				$LastName = "LastName".strval($c);
				$Address = "Address".strval($c);
				$City = "City".strval($c);
				$State = "State".strval($c);
				$Zip = "Zip".strval($c);
				$Email = "Email".strval($c);
				$Password = "UserName".strval($c);
				
				// Prepare the sql statement
				$sqlh_input = $pdo->prepare($sql_input);
				// Bind data to column names
				$sqlh_input->bindparam(":UserName",$UserName ); 
				$sqlh_input->bindparam(":FirstName", $FirstName); 
				$sqlh_input->bindparam(":LastName",  $LastName); 
				$sqlh_input->bindparam(":Address", $Address); 
				$sqlh_input->bindparam(":City", $City);  
				$sqlh_input->bindparam(":State", $State); 
				$sqlh_input->bindparam(":Zip", $Zip); 	
				$sqlh_input->bindparam(":Email",$Email); 
				$sqlh_input->bindparam(":Password",$Password); 
				$sqlh_input->execute(); 
			}

	echo ("Data created for userinfo_tbl<br><br>");

	
	// -------- Load second file ---------------
	
	$Blog = " - Pellentesque habitant morbi tristique senectus et netus et 
		malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, 
		ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam 
		egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend 
		leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum 
		erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. 
		Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum 
		orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar 
		facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, 
		tortor neque egestas augue, eu vulputate magna eros eu erat. 
		Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, 
		facilisis luctus, metus";
	
	
	//Set up SQL statement
	$sql_input = "INSERT INTO  articles_tbl "
                . "(UserID, "
                . "Title, "
                . "Article, "
                . "DateAdded, "
                . "DateEdited, "
                . "DateDeleted, "
                . "Deleted) "
                . "VALUES ("
                . ":UserID, "
                . ":Title, "
                . ":Article, "
                . ":DateAdded, "
                . ":DateEdited, "
                . ":DateDeleted, "
                . ":Deleted) ";
				
				echo ($sql_input);  // For testing
				echo ("<br><br>");      // For testing

  
			$num = 15;
			for ($c=1; $c < $num; $c++) 
			{
				if ($c < 4)
				{
					$user = "1";
				}
				if ($c < 8 AND $c >= 4)
				{
					$user = "3";
				}
				if ($c < 11 AND $c >= 8)
				{
					$user = "5";
				}
				if ($c < 12 AND $c >= 11)
				{
					$user = "6";
				}
				if ($c >= 12)
				{
					$user = "7";
				}
				// echo ("User: ".$user."<br>"); //For testing
			
		
				$UserID = $user;
				$Title = "Title".strval($c);
				$Article = "Article".strval($c).$Blog;
				$DateAdded = "DateAdded".strval($c);
				$DateEdited = "DateEdited".strval($c);
				$DateDeleted = "DateDeleted".strval($c);
				$Deleted = "Deleted".strval($c);
				
				// Prepare the sql statement
				$sqlh_input = $pdo->prepare($sql_input);
				// Bind data to column names 
				$sqlh_input->bindparam(":UserID", $UserID); 
				$sqlh_input->bindparam(":Title",  $Title);
				$sqlh_input->bindparam(":Article", $Article); 
				$sqlh_input->bindparam(":DateAdded",$DateAdded); 
				$sqlh_input->bindparam(":DateEdited",$DateEdited); 
				$sqlh_input->bindparam(":DateDeleted",$DateDeleted); 
				$sqlh_input->bindparam(":Deleted",$Deleted); 
				$sqlh_input->execute(); 
			}
		
	echo ("Data successfully added to article table.<br>");

?>
		
    </body>
</html>