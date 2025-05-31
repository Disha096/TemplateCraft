<?php
include("config.php");

$query_user = "SELECT * FROM user_logindata";
$res_user = mysqli_query($conn, $query_user);
$total_user = mysqli_num_rows($res_user);

// Add User
if(isset($_POST["add_user"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
   
    
    
    $query = "INSERT INTO `user_logindata`(`name`, `email`, `password`, `usertype`)
     VALUES ('$name','$email','$password','user')";


    $res = mysqli_query($conn, $query);
    if($res){
        ?>
        <script>
            alert("User Data Added");
            window.location = "admin.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("User Data Not Added: Server Error <?php echo mysqli_error($conn); ?>");
        </script>
        <?php
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <!-- Header Section -->
    <header class="header">
        <div class="title">TemplateCraft - User's Panel</div>
        <div class="admin-info">
            
            <button class="logout-btn" onclick="window.location.href='index.php'">Logout</button>
           
        </div>
    </header>

    <!-- Navigation Menu -->

    <nav class="navbar">
    <ul>
        <li><a href="#" data-section="home">Home</a></li>
        <li><a href="#" data-section="manage-user">View User</a></li>
        <li><a href="#" data-section="view-template">Manage Template</a></li>
    </ul>
    </nav>



    <div id="home" class="section">
    <h2>Welcome to the TemplateCraft</h2>
    <p></p>
    </div>
    
    
    <!-- Manage Users -->
    <div id="manage-user" class="section">
    <h3>View Users</h3>
    <table class="modern-table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php
        $users = $conn->query("SELECT * FROM user_logindata");
        $serial = 1;  // Define serial number before the loop

        while ($row = $users->fetch_assoc()) {
           
            $username = isset($row['name']) ? $row['name'] : 'Unknown'; 
            $email = isset($row['email']) ? $row['email'] : 'No Email';

            
            echo "<tr>
                <td>{$serial}</td>
                <td>{$username}</td>
                <td>{$email}</td>
            </tr>";

          $serial++; 

        }
        ?>
    </table>
    </div>


    <!-- Manage Templates -->
    <div id="view-template" class="content-section" style="display: none;">
    <h2>View Templates</h2>
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Template Name</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php
             $serial = 1; 
            include 'config.php';  // Database Connection
            $query = "SELECT * FROM templates";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$serial}</td>
                        <td>{$row['filename']}</td>  <!-- Corrected column name -->
                        <td><a href='{$row['filepath']}' target='_blank'>View</a></td>  <!-- Corrected column name -->
                    </tr>";
                    $serial++; 
            }
            ?>
        </tbody>
    </table>
    </div>

</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get all sections and hide them
    let sections = document.querySelectorAll(".section");
    sections.forEach(section => section.style.display = "none");

    // Function to show selected section
    function showSection(sectionId) {
        sections.forEach(section => section.style.display = "none"); // Hide all sections
        document.getElementById(sectionId).style.display = "block"; // Show the selected section
    }

    // Add event listeners to navbar links
    document.querySelectorAll(".navbar a").forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            let sectionId = this.getAttribute("data-section");
            showSection(sectionId);
        });
    });

    // Show the first section by default (optional)
    showSection("home");
});
</script>

</html>
