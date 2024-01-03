<?php
session_start();

// Check if the username session variable is set
if (!isset($_SESSION['loginKey']) && $_SESSION['loginKey'] !== 'sha12#') {
    // If the session variable is not set, redirect the user back to the login page
    header("Location: index.php");
    exit();
}

// If the session variable is set, the user is logged in
// Display the dashboard content or do further processing here
?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the file input exists and no errors occurred during upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Directory where uploaded images will be saved
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only certain image file formats (you can add more if needed)
        $allowed_formats = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_formats)) {
            // Check if the file already exists
            if (file_exists($target_file)) {
                echo "Sorry, the file already exists.";
            } else {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Please select an image file to upload.";
    }
}




?>
<?php
// Replace these variables with your actual MySQL database credentials
$servername = "localhost";
$username = "ism";
$password = "ismpassword";
$database = "mydb";

// Create a connection to MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Sample SELECT query
$sql = "SELECT * FROM `ism-image` ORDER BY `ism-image`.`id` DESC";

// Execute the query
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Image Upload</title>
  <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        height: 100vh;
      }
      .wrap-head {
        display: flex;
        border: 1px solid black;
        padding: 16px 32px;
        width: 800px;
        justify-content: space-between;
        align-items: center;
      }


      .wrap-body {
              display: flex;
              border: 1px solid black;
              padding: 16px 32px;
            }
		button  {
		background: red;
		}
    </style>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
<div class="outer-wrap">
<div class="wrap-head">
<h3>Welcome to the Dashboard, Admin</h3>
<!-- You can display other dashboard content here -->

<a href="logout.php">Logout</a> <!-- Add a logout link -->
</div>
<br />
<div class="wrap-body" style="max-width: 80vw;">
<form method="post" enctype="multipart/form-data" action="upload.php">
<div class="row">
  <div class="col-sm-6"><input type="file" name="image" accept="image/*" required></div>
  <div class="col-sm-6"><button type="submit" class="btn btn-danger">Upload Image</button></div>
</div>
<h2>list</h2>
<div class="row">
<?php
if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
        ?>

         <div class="col-md-4">
             <div class="thumbnail">
                 <img src="../uploads/thumb/<?php echo $row['name']?>" alt="Lights" style="width:100%">


			</div>
            </div>
              <?php

        }


    } else {
        echo "No records found";
    }
    // Free result set
    $result->free_result();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>


<?php
// Close database connection
$conn->close();
?>
</form>
</div>
</div>

</body>
</html>

