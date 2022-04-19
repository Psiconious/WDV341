<?php
session_start();        //access the current session or start a new session
/*
    If you are already a validUser (signed in) then you should go directly to
    the admin panel
*/
if( isset($_SESSION['validUser'])){
    //already signed on, go to admin panel
    $validUser = true;      //make you a validUser for THIS page

    //get username
    $userName = $_SESSION['userName'];
}
else{
    //NOT a valid user display form or process submitted form

    $userName = "";
    $passWord = "";
    
    $validUser = true;
    $msg = "";

    if( isset($_POST['submit'])){

        //echo "<h1>Form has been submitted!</h1>";
    
        $userName = $_POST['username'];
        $passWord = $_POST['password'];
    
        //connect to the database
    
        require 'connectPDO.php'; 
    
        //$sql = "SELECT * FROM event_user WHERE event_user_name = :user AND event_user_name = :pass";
        $sql = "SELECT count(*) FROM event_user WHERE event_user_name = :user AND event_user_name = :pass";
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    
        $stmt->execute(); 
        
        $rowCount = $stmt->fetchColumn();   //determine if you are in the table
    
        //echo "<h2>We found $rowCount rows for $userName and $passWord</h2>";
    
        //if $rowCount > 0 what do I know?  We found a valid username/password combination
    
        if($rowCount > 0){
            //valid user, display admin options
            $validUser = true;
            //set a validUser SESSION variable to true
            $_SESSION['validUser'] = true; 
            $_SESSION['userName'] = $userName;       //save for future pages/accesses 
        }
        else{
            $validUser = false;     //did not find login on table you are NOT a valid user
            $msg = "Invalid username or password, please try again!";
        }
    
    }
    else{
        //display the login form
        //echo "<h1>Please enter the form data</h1>";
        $validUser = false;     //did not submit the form, you cannot be a valid user
    }
}
//endif for validUser

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 
if(!$validUser){
    //NOT a valid user then display form
    ?>
        <h3>Please Login to access your Admin Functions</h3>
        <p style="color:red"><?php echo $msg;?></p>
        <form method="post" action="#">
            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" placeholder="Username">
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="text" name="password" id="password">
            </p>
            <p>
                <input type="submit" value="Sign On" name="submit" id="submit">
                <input type="reset">
            </p>
        </form>
    <?php
}
else{
        //VALID user display Admin
    ?>
        <!-- display this area for a valid user to show Admin options -->
        <h3>Welcome Back: <?php echo $userName; ?></h3>
        <h3>Administrator Functions</h3> 

        <p>Products</p>
        <ul>
            <li><a href="inputProduct.html">Input Product information</a></li>
            <li><a href="deleteProduct.html">Delete Product from database</a></li>
        </ul>

        <p>Toys</p>
        <p><a href="inputToys.html">Input New Toys</a></p>

        <p><a href="inputEvent.php">Input Event</a></p>

        <p><a href="logout.php">Logout of Admin Panel</a></p>

    <?php   
}
    ?>

<footer>
    <p>FOOTER GOES HERE</p>
</footer>
</body>

</html>