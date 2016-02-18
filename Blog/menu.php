<!--     ///////////////////////////////////////////////////////  -->
<nav id="cs-menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">BLOG CITY</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li> <a href="index.php">About</a></li> 
               
				<li> <a href="BlogPage.php">Blogs</a></li> 
				<li> <a href="contact.php">Contact</a></li> 
				<li><a href="LogoutB.php">Logout</a></li>
                <li class="dropdown">

                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
                    <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                        <li>
                   
                            <div class='row'>
                            <div class="col-md-12">
                                <div class='text-center'>
                            <?php
                            require "Common.php";

                            if (!isset($_session['LoginStatus'])) {

                                $_SESSION['LoginStatus'] = false;
                            } else {
                                echo("logged in as " . $_SESSION['liusername'] . "<br>");
                            }
                            ?>
                                </div>
                                <div class="text-center botpad" id='login'>
                                <?php
                                if (isset($_POST['usrName'])) {


                                    $sql_li_stmt = "Select UserName, Password "
                                            . "From userinfo_tbl "
                                            . "where UserName=:usrname";
                                    $sqlh_li = $pdo->prepare($sql_li_stmt);

                                    $x_usrName = filter_var($_POST['usrName'], FILTER_SANITIZE_STRING);

                                    $sqlh_li->bindParam(":usrname", $x_usrName);
                                    $sqlh_li->execute();


                                    $li_result = $sqlh_li->fetch();



                                    $hash = $li_result['Password'];


                                    if (password_verify($_POST['usrpwd'], $hash)) {


                                        $_SESSION['LoginStatus'] = true;
                                        $_SESSION['liusername'] = $x_usrName;
                                        echo("Logged in as " . $_SESSION['liusername'] . "<br>");
                                    } else {
                                        echo 'Invalid Password';
                                    }
                                }
                                ?>
                                </div>
                                <form class="form" role="form" method="POST" action="index.php" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">

                                        <input type="text" class="form-control" name="usrName" placeholder="Username" size="25" required autofocus>
                                    </div>
                                    <div class="form-group">

                                        <input type="password" name="usrpwd" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                    </div>
                                    <div class='text-center'>
                                        <label class='text-center'>
                                            <p class="text-center">Dont have an account?</p>  <a href="BlogCityReg.php" class="text-center new-account">Create account here</a>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </li>
                    </ul>
                </li>				              

            </ul>




            </nav>
