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

</head>
<body>
   <?php
        include "menu.php";
        ?>
		<div class="container toppad content2">
		<div class="row">
	
		<div class="col-md-12">
<?php



if (isset($_POST['UserName'])) {
    $pwd = $_POST['Password'];


    
    //create sql statement
    $sql_stmt = "INSERT INTO userinfo_tbl "
            . "(UserName, "
            . "FirstName, "
            . "LastName, "
            . "Address, "
            . "City, "
            . "State, "
            . "Zip, "
            . "Email, "
            . "Password) "
            . "VALUES "
            . "(:UserName, "
            . ":FirstName, "
            . ":LastName, "
            . ":Address, "
            . ":City, "
            . ":State, "
            . ":Zip, "
            . ":Email, "
            . ":Password)";

    //prepare the sql statement
    $sqlh = $pdo->prepare($sql_stmt);

    //sanitize the input
    $in_username = filter_var($_POST['UserName'], FILTER_SANITIZE_STRING);
    $in_firstname = filter_var($_POST['FirstName'], FILTER_SANITIZE_STRING);
    $in_lastname = filter_var($_POST['LastName'], FILTER_SANITIZE_STRING);
    $in_address = filter_var($_POST['Address'], FILTER_SANITIZE_STRING);
    $in_city = filter_var($_POST['City'], FILTER_SANITIZE_STRING);
    $in_state = filter_var($_POST['State'], FILTER_SANITIZE_STRING);
    $in_zip = filter_var($_POST['Zip'], FILTER_SANITIZE_STRING);
    $in_email = filter_var($_POST['Email'], FILTER_SANITIZE_STRING);
    $in_password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);

    //hash the password
    $in_password = password_hash($in_password, PASSWORD_DEFAULT);

    //bind the parameters
    $sqlh->bindparam(":UserName", $in_username);
    $sqlh->bindparam(":FirstName", $in_firstname);
    $sqlh->bindparam(":LastName", $in_lastname);
    $sqlh->bindparam(":Address", $in_address);
    $sqlh->bindparam(":City", $in_city);
    $sqlh->bindparam(":State", $in_state);
    $sqlh->bindparam(":Zip", $in_zip);
    $sqlh->bindparam(":Email", $in_email);
    $sqlh->bindparam(":Password", $in_password);

    //excecute the sqlstatement
    $sqlh->execute();

    echo '<div id="newuserstatus">
        <p>User Was Successfully entered</p>
        </div>';
    
    
}
 else {
    

    echo "        <div id='newuser' >
            <form method='POST' action='BlogCityReg.php'>
                <table >
                    <tbody>
                        <tr>
                            <td colspan=2>New User</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input type='text' name='UserName'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>Firstname</td>
                            <td><input type='text' name='FirstName'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>Lastname</td>
                            <td><input type='text' name='LastName'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>Adress</td>
                            <td><input type='text' name='Address'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><input type='text' name='City'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td><input type='text' name='State'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>Zip</td>
                            <td><input type='text' name='Zip'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type='text' name='Email'  size='25' /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type='password' name='Password'  size='25'/></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type='password' name='Password'  size='25' /></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type='submit' value='Enter' name='newuserenter' /></td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>";
        
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
