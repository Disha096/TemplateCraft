<?php
include("config.php");

if(isset($_POST["login_submit"])){
    $usertype = $_POST["logintype"];
    $email = $_POST["username"];
    $password = $_POST["password"];
    
    //echo ($email.$usertype.$password);
if($usertype=="admin"){
    $query = "select * from `admin_logindata` where `email`='$email' and `password`='$password'";
}else{
    $query = "select * from `user_logindata` where `email`='$email' and `password`='$password'";
}
    $res = mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        //echo("login successful".mysqli_num_rows($res));z
        if($usertype=="admin"){
        header("location:admin.php");

    }else{
        header("location:user.php");
    }
        
    }else{
        ?>
<script>
    alert("Invalid Info");
</script>
<?php
}
}

?>
<?php

session_start();

// Assuming you have validated the user and fetched user details from the database
//$user_name = 'name'; // Replace with actual fetched user name
//$user_email = 'email'; // Replace with actual fetched user email

//$_SESSION['user_name'] = $user_name;
//$_SESSION['user_email'] = $user_email;

//header('Location: studentpannel.php');
//exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TemplateCraft</title>
    <link rel="stylesheet" href="loginpage.css">
    <style>
        
        .video-bg {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }
input[type=text],
input[type=password] {
    width: 100%;
    margin: 10px 0;
    border-radius: 5px;
    padding: 15px 18px;
    box-sizing: border-box;
}
    </style>
</head>
<body>
    <video autoplay muted loop class="video-bg">
        <source src="home.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <h1>TemplateCraft</h1>
    <form action="index.php" method="POST">
        <!-- Headings for the form -->
        <div class="headingsContainer">
            <h3>Sign in</h3>
            <p>Sign in with your email and password</p>
        </div>

        <!-- Main container for all inputs -->
        <div class="mainContainer">
            <!-- Select login type -->
            <label for="logintype">Login Type</label>
            <select id="logintype" name="logintype" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <!-- Username -->
            <br>
            <br>
            <label for="username">Your email</label>
            <input type="text" placeholder="Enter email" name="username" required>
            <br>
            <br>
            <!-- Password -->
            <label for="pswrd">Your password</label>
            <input type="password" id="pswrd" placeholder="Enter Password" name="password" required>

            <!-- sub container for the checkbox and forgot password link -->
            <div class="subcontainer">
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <p class="forgotpsd"> <a href="#">Forgot Password?</a></p>
            </div>

            <!-- Submit button -->
            <button type="submit" name="login_submit">Login</button>

            <!-- Sign up link -->
            <!--<p class="register">Not a member?  <a href="sign_up.php">Register here!</a></p>
          <p class="logintype">Not a member?  <a href="admin.php">Register here!</a></p> -->
        
            
            </p>

<!--<section id="notifications">
    <h2>Notification</h2>
    <form id="notification-form">
        <label for="notification-message">Type your notification:</label>
        <textarea id="notification-message" name="notification-message" required></textarea>
        <button type="submit">Send Notification</button>
    </form>
</section> -->
    
        </div>

    </form>
    <!-- Add this script to handle form submission -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('notification-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                var message = document.getElementById('notification-message').value; // Get the message from the input field
                // Redirect to studentpannel.php with the message as a query parameter
                window.location.href = 'studentpannel.php?message=' + encodeURIComponent(message);
            });
        });
    </script>
    
</body>
</html>
