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

// Delete User
if (isset($_GET['delete_user'])) {
    $email = urldecode($_GET['delete_user']); // Decode email from URL
    $email = $conn->real_escape_string($email); // Prevent SQL injection

    $query = "DELETE FROM user_logindata WHERE email='$email'";
    $res = $conn->query($query);

    if ($res) {
        echo "<script>alert('User deleted successfully!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "');</script>";
    }
}


// Upload Template
// Upload Template
if (isset($_POST['upload_template'])) {
    $file = $_FILES['template_file'];
    $filename = basename($file["name"]);
    $target_dir = "uploads/"; // Directory where files will be stored

    
    if (!is_dir($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            echo "<script>alert('Failed to create upload directory. Check permissions.');</script>";
            exit();
        }
    }

    $target_file = $target_dir . $filename;

    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $conn->query("INSERT INTO templates (filename, filepath) VALUES ('$filename', '$target_file')");
        echo "<script>alert('File uploaded successfully!'); window.location = 'admin.php';</script>";
    } else {
        echo "<script>alert('File upload failed! Check folder permissions.');</script>";
    }
}


// Delete Template
if (isset($_GET['delete_template'])) {
    $id = $_GET['delete_template'];

    // Check if the template exists before deleting
    $result = $conn->query("SELECT filepath FROM templates WHERE id='$id'");
    
    if ($result->num_rows > 0) { // Ensure there is at least one row
        $row = $result->fetch_assoc();
        if (!empty($row['filepath']) && file_exists($row['filepath'])) {
            unlink($row['filepath']); // Delete file from server
        }
        $conn->query("DELETE FROM templates WHERE id='$id'");
        echo "<script>alert('Template deleted successfully!'); window.location = 'admin.php';</script>";
    } else {
        echo "<script>alert('Error: Template not found!');</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <!-- Header Section -->
    <header class="header">
        <div class="title">TemplateCraft - Admin's Panel</div>
        <div class="admin-info">
            
            <button class="logout-btn" onclick="window.location.href='index.php'">Logout</button>
           
        </div>
    </header>

    <!-- Navigation Menu -->

    <nav class="navbar">
    <ul>
        <li><a href="#" data-section="home">Home</a></li>
        <li><a href="#" data-section="add-user">Add User</a></li>
        <li><a href="#" data-section="manage-user">Manage User</a></li>
        <li><a href="#" data-section="add-template">Add Template</a></li>
        <li><a href="#" data-section="manage-template">Manage Template</a></li>
    </ul>
    </nav>



    <div id="home" class="section">
    <h2>Welcome to the Admin Panel</h2>
    <p>Select an option from the navigation bar.</p>
    </div>
    
    

    <!-- Add User -->
    <div id="add-user" class="section">
    <h3>Add User</h3>
    <form method="POST" class="form-container">
        <input type="text" name="name" placeholder="Name" class="input-field"  required>
        <input type="email" name="email" placeholder="Email" class="input-field"  required>
        <input type="password" name="password" placeholder="Password" class="input-field"  required>
        <button type="submit" name="add_user" class="custom-btn">Add User</button>
    </form>
    </div>

    <!-- Manage Users -->
    <div id="manage-user" class="section">
    <h3>Manage Users</h3>
    <table class="modern-table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
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
                <td>
                <a href='admin.php?delete_user={$row['email']}' onclick='return confirm(\"Delete this user?\")'>Delete</a>
                </td>

          </tr>";
          $serial++; 
        }
        ?>
    </table>
    </div>

    <!-- Add Template -->
    <div id="add-template" class="section">
    <h3>Add Template</h3>
    <form method="POST" enctype="multipart/form-data" class="form-container">
        <input type="file" name="template_file" accept=".docx" class="input-field" required>
        <button type="submit" name="upload_template" class="upload-btn">Upload Template</button>
    </form>
    </div>

    <!-- Manage Templates -->
    <div id="manage-template" class="section">
    <h3>Manage Templates</h3>
    <table class="modern-table">
        <tr>
            <th>ID</th>
            <th>Filename</th>
            <th>Action</th>
        </tr>
        <?php
        $serial = 1;
        $templates = $conn->query("SELECT * FROM templates"); 
            while ($row = $templates->fetch_assoc()) {
                $fileUrl = $row['filepath'];
                echo "<tr>
                        <td>{$serial}</td>
                        <td><a href='{$row['filepath']}' target='_blank'>{$row['filename']}</a></td>
                        <td><a href='admin.php?delete_template={$row['id']}' onclick='return confirm(\"Delete this template?\")'>Delete</a></td>
                    </tr>";
                    $serial++; 
            }           
        ?>

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
