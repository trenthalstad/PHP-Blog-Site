<?php
require "Common.php";
print_r($_POST);

<<<<<<< HEAD
if (isset($_POST['UserName'])) {
    $pwd = $_POST['Password'];
=======
if (isset($_POST['username'])) {
    $pwd = $_POST['password'];
>>>>>>> origin/master


    
    //create sql statement
<<<<<<< HEAD
    $sql_stmt = "INSERT INTO userinfo_tbl "
=======
    $sql_stmt = "INSERT INTO tbl_user "
>>>>>>> origin/master
            . "(UserName, "
            . "FirstName, "
            . "LastName, "
            . "Address, "
            . "City, "
            . "State, "
            . "Zip, "
<<<<<<< HEAD
            . "Email, "
=======
            . "Eamil, "
>>>>>>> origin/master
            . "Password) "
            . "VALUES "
            . "(:UserName, "
            . ":FirstName, "
            . ":LastName, "
            . ":Address, "
            . ":City, "
            . ":State, "
            . ":Zip, "
<<<<<<< HEAD
            . ":Email, "
=======
            . ":Eamil, "
>>>>>>> origin/master
            . ":Password)";

    //prepare the sql statement
    $sqlh = $pdo->prepare($sql_stmt);

    //sanitize the input
<<<<<<< HEAD
    $in_username = filter_var($_POST['UserName'], FILTER_SANITIZE_STRING);
    $in_firstname = filter_var($_POST['FirstName'], FILTER_SANITIZE_STRING);
    $in_lastname = filter_var($_POST['LastName'], FILTER_SANITIZE_STRING);
    $in_address = filter_var($_POST['Address'], FILTER_SANITIZE_STRING);
    $in_city = filter_var($_POST['City'], FILTER_SANITIZE_STRING);
    $in_state = filter_var($_POST['State'], FILTER_SANITIZE_STRING);
    $in_zip = filter_var($_POST['Zip'], FILTER_SANITIZE_STRING);
    $in_email = filter_var($_POST['Email'], FILTER_SANITIZE_STRING);
=======
    $in_username = filter_var($_POST['Username'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['Firstname'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['Lastname'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['Address'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['City'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['State'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['Zip'], FILTER_SANITIZE_STRING);
    $in_username = filter_var($_POST['Eamil'], FILTER_SANITIZE_STRING);
>>>>>>> origin/master
    $in_password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);

    //hash the password
    $in_password = password_hash($in_password, PASSWORD_DEFAULT);

    //bind the parameters
<<<<<<< HEAD
    $sqlh->bindparam(":UserName", $in_username);
    $sqlh->bindparam(":FirstName", $in_firstname);
    $sqlh->bindparam(":LastName", $in_lastname);
=======
    $sqlh->bindparam(":Username", $in_username);
    $sqlh->bindparam(":Firstname", $in_firstname);
    $sqlh->bindparam(":Lastname", $in_lastname);
>>>>>>> origin/master
    $sqlh->bindparam(":Address", $in_address);
    $sqlh->bindparam(":City", $in_city);
    $sqlh->bindparam(":State", $in_state);
    $sqlh->bindparam(":Zip", $in_zip);
<<<<<<< HEAD
    $sqlh->bindparam(":Email", $in_email);
=======
    $sqlh->bindparam(":Email", $in_eamil);
>>>>>>> origin/master
    $sqlh->bindparam(":Password", $in_password);

    //excecute the sqlstatement
    $sqlh->execute();

    echo '<div id="newuserstatus">
        <p>User Was Successfully entered</p>
        </div>';
    
    
}
 else {
    

    echo "        <div id='newuser' >
<<<<<<< HEAD
            <form method='POST' action='BlogCityReg.php'>
=======
            <form method='POST' action='NewUserRegistration.php'>
>>>>>>> origin/master
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


<html>
    <head>
        <title></title>



    </head>
    <body>
     
                <br><a href="index.php">home</a>
    </body>
</html>