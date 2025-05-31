<?php

include("config.php");

if(isset($_POST["register_submit"])){
    $usertype = $_POST["logintype"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    //$stream = $_POST["stream"];
    $password = $_POST["password"];
    
    //echo ($name.$usertype.$password.$email);
    $query = "INSERT INTO `admin_logindata`(`name`, `email`, `password`, `usertype`)  VALUES (
        '$name','$email','$password','admin')";

    $res = mysqli_query($conn,$query);
    if($res){
        // echo("Registration successful");
        header("location:index.php");
    }else{
        echo("Registration Not successful".mysqli_error($conn));
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TemplateCraft</title>
    <link rel="stylesheet" href="loginpage.css">
</head>
<body>
    <h1>TemplateCraft</h1>
<form action="sign_up.php" method="POST">
        <!-- Headings for the form -->
        <div class="headingsContainer">
            <h3>Sign in</h3>
            <p>Sign in with your username and password</p>
        </div>

        <!-- Main container for all inputs -->
        <div class="mainContainer">
            <!-- Select login type -->
            <!-- <label for="logintype">Login Type</label> -->
            <!-- <select id="logintype" name="logintype" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select> -->

            <!-- Username -->
            <label for="name">Your name</label>
            <input type="text" placeholder="Enter Your Name" name="name" required>
            <br>
            <br>
            <label for="email">Your email</label>
            <input type="text" placeholder="Enter Your Email" name="email" required>
            <br>
            <br>
            <label for="password">Your password</label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br>
            <br>
            <button type="submit" name="register_submit">Register</button>
            <br>
            <br>
           
            <!-- Sign up link -->
            <p class="register">Already a member? <a href="index.php">Login here!</a></p>
            <!--<p class="logintype">Not a member?  <a href="admin.html">Register here!</a></p> -->
        
            
            </p>
        </div>

    </form>
    
</body>
</html>
