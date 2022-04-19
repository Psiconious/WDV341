<?php

    //starts session and checks if user is already signed on
    session_start();
    if(isset($_SESSION['validUser'])){
        //if user is signed in redirects user to home page.
        echo "<h1>Session created for " . $_SESSION['username'] . "</h1>";
        header("location: index.php");
    }

    //Setting Variables for form
    if(isset($_POST['username'])){
        $userName = $_POST['username'];
    }
    else{
        $userName = "";
    }
    $firstName = "";
    $lastName = "";
    $email = "";
    $passWord = "";
    $confirmPassword = "";
    $errorMessage = "";
    $message = "";

    //valid user flag
    $validUser = True;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="javascript/form-handler.js"></script>
</head>

<body onload="PageLoad()">
    <?php
        if(isset($_POST['submit'])){
            //setting up the db connection
            require "../dbConnect.php";

                if($_POST['submit'] == "login"){

                    $userName = $_POST['username'];
                    $passWord = $_POST['password'];

                    //prepare statement
                    $sql = "SELECT username, password FROM yugioh_db_users WHERE username = :user AND password = :pass";
                    $stmt = $conn->prepare($sql);

                    try{
                        //bind params
                        $stmt->bindParam(':user', $userName);
                        $stmt->bindParam(':pass', $passWord);

                        //execute statement
                        $stmt->execute();

                        $rowCount = $stmt->fetchColumn();

                        if($rowCount > 0){
                            //valid user, display admin options
                            $validUser = true;
                            //set a validUser SESSION variable to true
                            $_SESSION['validUser'] = true; 
                            $_SESSION['username'] = $userName;//save for future pages/accesses 

                        }
                        else{
                            $validUser = false;     //did not find login on table you are NOT a valid user
                            $errorMessage = "Invalid username or password, please try again!";
                        }
                    }
                    catch(PDOException $e){
                        $validUser = false;
                        $errorMessage = "Unable to connect to database. Please try again later.";
                    }
                }
                else if($_POST['submit'] == "register"){
                    echo "<h1> else if branch " . $_POST['submit'] . "</h1>" ;
                }
                else{
                    echo "<h1> else branch " . $_POST['submit'] . "</h1>" ;
                }
            }
        else{
            $validUser = false;
        }
    ?>
    <section>
        <div class="main">
            <?php
                if(!isset($_SESSION['validUser'])){
            ?>
            <div class="form-tabs">
                <div class="form-tab">
                    <input type="radio" name="signon" id="login" value="login">
                    <label id="login-label" for="login" class="active">Sign On</label>
                </div>
                <div class="form-tab">
                    <input type="radio" name="signon" id="register" value="register" >
                    <label id="register-label" for="register" class="">Sign Up</label>
                </div>
            </div>
            <span class="errormessages"><?=$errorMessage?></span>
            <div class="form-body">
                <form id="login-form" action="signon.php" class="login-register-form" method="post">
                    <h3>Login</h3>
                    <div class="form-group">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" value=<?=$userName?>>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="login" class="form-button">Login</button>
                    </div>
                </form>
                <form id="register-form" action="signon.php" class="login-register-form-hidden" method="post">
                    <h3>Create a New Account</h3>
                    <div class="form-group">
                        <label for="firstname" class="form-label">First Name:</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value=<?=$firstName?>>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="form-label">Last Name:</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value=<?=$lastName?>>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value=<?=$email?>>
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" value=<?=$userName?>>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword" class="form-label">Confirm Password:</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="register" class="form-button">Register</button>
                    </div>
                </form>
            </div>
            <?php
                }
                else{
                    header( "refresh:5;url=index.php" );
                    $message = 'You\'ll be redirected in about 5 secs. If not, click <a href="index.php">here</a>.'; 
            ?>
                <div class="form-body column">
                    <h1>You have successfully logged in</h1>
                    <span class="signon-message"><?=$message?></span>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
</body>

</html>