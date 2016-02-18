<?php

require "Common.php";

if (!isset ($_session['LoginStatus']))
        {
           
            $_SESSION['LoginStatus'] = false;
            
        }
        else{
          echo("<br> logged in as = ".$_SESSION['liusername']."<br>");  
        }


if (isset($_POST['usrName'])) {
    echo "Login true <br><br>";

    $sql_li_stmt = "Select UserName, Password "
            . "From userinfo_tbl "
            . "where UserName=:usrname";
    $sqlh_li = $pdo->prepare($sql_li_stmt);

    $x_usrName = filter_var($_POST['usrName'], FILTER_SANITIZE_STRING);

    $sqlh_li->bindParam(":usrname", $x_usrName);
    $sqlh_li->execute();


    $li_result = $sqlh_li->fetch();

//    print_r($li_result['Password'] . "<br><br>"); //for testing

    $hash = $li_result['Password'];


    if (password_verify($_POST['usrpwd'], $hash)) {
        echo 'Password is valid!';
		
		$_SESSION['LoginStatus'] = true;
		$_SESSION['liusername'] = $x_usrName;
                echo("<br> logged in as = ".$_SESSION['liusername']."<br>");  

    } else {
        echo 'Invalid password.';
    }

}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <form method="POST" action="LoginB.php">
            <table border="1">
                <thead>
                    <tr>
                        <th colspan="2">Login</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>UserName</td>
                        <td><input type="text" name="usrName" value="" size="25" /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="text" name="usrpwd" value="" size="25" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Enter" name="Enter" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
		<p><a href="index.php">home</a></p>
<?php
// put your code here
?>
    </body>
</html>
