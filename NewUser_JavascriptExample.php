<!DOCTYPE html>
<!-- 
    Web Programming CSCI-210-01
    Mock Login Assignment 
    Rick Hull 
    November 5, 2015
	Uses Javascript and PHP for validation
-->
<?php
	require "Common.php";
	//echo ("$dbstatus<br>"); // For testing
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>New User Registration</title>
    </head>
    <body>

<?php
	//print_r($_POST);        // For testing
	//echo ("<br>");

if (isset($_POST['username'])) // Do this once information is entered
   {
	// --- Check if password matches ---
	if ( strcmp($_POST['password'], $_POST['password2']))	
	{
		echo ("<br>Your two password entries do not match<br>"); 
		echo ("Please try again <br>"); 
		unset($_POST['username']);  // Bring up entry form again 
		echo ('<form action="NewUser.php" method="POST" name="submit">
		       <input type="submit" value="Okay">
			   </form> ');
			   die;  // Do not run code below
	}
	
	// --- See if user name is already in table ---
     $username = $_POST['username'];
	 $sql_stmt = "SELECT * FROM tbl_user WHERE username = '".$_POST['username']."'";
	 //echo ("$sql_stmt<br>");  // For testing
	 $sglPdo = $pdo->prepare($sql_stmt);
	 $sglPdo->execute();
      
	 // ------------------------------------------
	 // Save user name if no matching record found
	 if ($sglPdo->rowCount() == 0)  
	   {
		//Create string with sql statement
		$sql_stmt = "INSERT INTO tbl_user "
				. "(firstname, "
				. "lastname, "
				. "username, "
				. "password) "
				. "VALUES "
				. "(:firstname, "
				. ":lastname, "
				. ":username, "
				. ":password)";
		$sglPdo = $pdo->prepare($sql_stmt); //prepare the sql statement

		//Sanitize the input
		$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
		$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		//Hash the password
		$unencryptedPassword = $_POST['password'];
		$password = password_hash($unencryptedPassword, PASSWORD_DEFAULT);

		//Bind the parameters
		$sglPdo->bindparam(":firstname", $firstname);
		$sglPdo->bindparam(":lastname", $lastname);
		$sglPdo->bindparam(":username", $username);
		$sglPdo->bindparam(":password", $password);

		//Excecute the sql statement
		$sglPdo->execute();
		//echo ("<br>Row count");      // For testing
	    //return($sglPdo->rowCount()); // For testing
		$_SESSION['LogInStatus'] = true;    // Grant login credentials
		$_SESSION['UserName'] = $username;  // Save username for display on member pages
		header("location:MemberPage1.php"); // Jump to member page
	    } 
	 // ----------------------------------------------
	 else  // The user name is already in the database
	   {
		echo ("That user name is already taken<br>"); 
		echo ("Please chose a different user name<br><br>"); 
		unset($_POST['username']);  // Bring up entry form again 
		echo ('<form action="NewUser.php" method="POST" name="submit">
		     <input type="submit" value="Okay">
		</form> ');
	    }	 
}
 else { 
    echo '  
	<script>
        function validateFormOnSubmit(theForm)
        {
            var reason = "";
            reason += validateUserName(theForm.username);  
            reason += validatePassword(theForm.password);
            if (reason == "")
                {
                    document.getElementById("pWarn").innerHTML = "";
                    return true;
                }
            else
                {
                    document.getElementById("pWarn").innerHTML = 
                            "These fields need correction: <br><br>" + reason;
                    return false;
                }
        }
        
        function validateUserName(fld)
        {
            var error = "";
            var illegalChars = /\W/;   //allow letters, numbers and underscores
            
            if (fld.value == "")  // Check if name filled in 
            {
                fld.style.background = "Yellow"; // Nothing entered
                error = "You must enter a user name.<br>";
            }
            else if ((fld.value.length < 5) || (fld.value.length > 15))
            {
                fld.style.background = "Yellow"; // Too short
                error = "The username must be between 5 and 15 characters.<br>";
            }
            else if (illegalChars.test(fld.value))
            {
                 fld.style.background = "Yellow"; 
                 error = "The username contains illegal characters.<br>";
            }
            else  //If fixed, restore background to default
            {
                fld.style.background = "White"; 
            }
            return error;
        }
              
        function validatePassword(fld)
         {
            var error = "";
                       
            if (fld.value == "")  // Check if name filled in 
            {
                fld.style.background = "Yellow"; // Nothing entered
                error = "You must enter a password.<br>";
            }
            else if (fld.value.length < 6) 
            {
                fld.style.background = "Yellow"; // Too short
                error = "The password must be at least six characters.<br>";
            }
            else
            {
                fld.style.background = "White"; 
            }
            return error;
        } 
       </script>
	
			<h3> Enter a name and password below</h3>
            <form method="POST" onsubmit = "return validateFormOnSubmit(this)" action="NewUser.php">
                <table >
                    <tbody>
                        <tr>
                            <td>First Name</td>
                            <td><input type="text" name="firstname" value="" size="25" /></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input type="text" name="lastname" value="" size="25" /></td>
                        </tr>
                        <tr>
                            <td>User Name</td>
                            <td><input type="text" name="username" value="" size="25" /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="password" value="" size="25"/></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" name="password2" value="" size="25" /></td>
                        </tr>
						<tr></tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Save" name="newuserenter" /></td>
                        </tr>
                    </tbody>
                </table>
            </form>
			<p id = "pWarn" style = "color:red"></p>';  
 }

?>
        
    <br><a href="index.php">Return to Home Page</a>
    </body>
</html>