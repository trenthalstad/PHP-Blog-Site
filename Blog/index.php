<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <div class="container content">
            <div class="row">
                <div class="col-md-12">

                    <h2>Blog City<br>
                        <h3>The best blog site around!</h3>
                </div>
            </div>
        </div>

        <div class="container center">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <h3>Blog 1</h3>

                    <img src=""  width=150px height=200px>



                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <h3>Blog 2</h3>

                    <img src=""width=150px height=200px>

                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <h3>Blog 3</h3>

                    <img src=""width=150px height=200px>

                </div>

            </div>
        </div>		


        
        //<?php
//        //session_start();
//        require "Common.php";
//        
//        //$_SESSION['LoginStatus'] = false;
//        
//        if (!isset ($_session['LoginStatus']))
//        {
//           
//            $_SESSION['LoginStatus'] = false;
//            
//        }
//        
//        print_r($_SESSION['LoginStatus']);
//
//        if (isset($_POST['UserName'])) {
//            echo "Login true <br><br>";
//
//            $sql_li_stmt = "Select UserName, Password "
//                    . "From userinfo_tbl "
//                    . "where UserName=:usrname";
//            $sqlh_li = $pdo->prepare($sql_li_stmt);
//
//            $x_usrName = filter_var($_POST['usrName'], FILTER_SANITIZE_STRING);
//
//            $sqlh_li->bindParam(":usrname", $x_usrName);
//            $sqlh_li->execute();
//
//
//            $li_result = $sqlh_li->fetch();
//
//            print_r($li_result['Password'] . "<br><br>");
//
//            $hash = $li_result['Password'];
//
//
//            if (password_verify($_POST['usrpwd'], $hash)) {
//                echo 'Password is valid!';
//
//                $_SESSION['LoginStatus'] = true;
//                $_SESSION['liusername'] = $x_usrName;
//                echo("<br> logged in as = " . $_SESSION['liusername'] . "<br>");
//            } else {
//                echo 'Invalid password.';
//            }
//        }
//        ?>





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
