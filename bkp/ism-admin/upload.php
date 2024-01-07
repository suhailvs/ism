<?php

 function RandomString() {
           $word = array_merge(range('a', 'z'), range('A', 'Z'));
           shuffle($word);
           return substr(implode($word), 0, $len);
    }

// Function to create a thumbnail with the same aspect ratio
function createThumbnail($sourceFile, $targetFile, $thumbWidth, $thumbHeight){
    list($sourceWidth, $sourceHeight, $sourceType) = getimagesize($sourceFile);
    if ($sourceType == IMAGETYPE_JPEG) {
        $sourceImage = imagecreatefromjpeg($sourceFile);
    } elseif ($sourceType == IMAGETYPE_PNG) {
        $sourceImage = imagecreatefrompng($sourceFile);
    } elseif ($sourceType == IMAGETYPE_GIF) {
        $sourceImage = imagecreatefromgif($sourceFile);
    } else {
        // Unsupported image type
        return false;
    }

    // Calculate thumbnail dimensions while preserving the aspect ratio
    $aspectRatio = $sourceWidth / $sourceHeight;

    if ($thumbWidth / $thumbHeight > $aspectRatio) {
        $thumbWidth = $thumbHeight * $aspectRatio;
    } else {
        $thumbHeight = $thumbWidth / $aspectRatio;
    }

    $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
    imagecopyresampled($thumbImage, $sourceImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $sourceWidth, $sourceHeight);

    // Save the thumbnail as a JPEG image (you can change the format if needed)
    imagejpeg($thumbImage, $targetFile, 100);
    // Free memory
    imagedestroy($sourceImage);
    imagedestroy($thumbImage);
}

function insertDb($fileName) {

// Replace these variables with your actual MySQL database credentials
$servername = "localhost";
$username = "ism";
$password = "ismpassword";
$database = "mydb";
echo 'rrrr';
error_reporting( E_ALL );
// Create a connection to MySQL database
$conn = new mysqli($servername, $username, $password, $database);
echo '1111';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


echo '222'.$fileName;
// Prepare SQL query to insert data into the 'users' table
$sql = "INSERT INTO `ism-image` (name) VALUES (?)";

// Prepare and bind parameters to prevent SQL injection
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $fileName); // 'ss' indicates two string parameters

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New record inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
	echo '333'.$fileName;
    // Close statement
    $stmt->close();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the file input exists and no errors occurred during upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "./../uploads/"; // Directory where uploaded images will be saved

        $path_info = pathinfo($_FILES["image"]["name"]);
       // echo $path_info['extension']; // "bill"
        $nameFile = RandomString().'.'.$path_info['extension'];
        $target_file = $target_dir . $nameFile;
        error_reporting( E_ALL );
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only certain image file formats (you can add more if needed)
        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowed_formats)) {
            // Check if the file already exists
            if (file_exists($target_file)) {
                echo "Sorry, the file already exists.";
            } else {
                // Move the uploaded file to the specified directory
                 echo "The file " . basename($_FILES["image"]["name"]) . " started.";
                 error_reporting( E_ALL );
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                  createThumbnail($target_file, $target_dir."thumb/".$nameFile, 800, 800);
                   createThumbnail($target_file, $target_dir."max/".$nameFile, 1500, 1500);
                    insertDb($nameFile);
                     echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                     header("Location: dashboard.php?success=true");
                     exit();


                } else {
                   // header("Location: dashboard.php?fail=true");
                    echo "Sorry, there was an error uploading your file.";
                     exit();
                }
            }
        } else {
           // header("Location: dashboard.php?fail=true");
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
             exit();
        }
    } else {
       // header("Location: dashboard.php?fail=true");
        echo "Please select an image file to upload.";
         exit();
    }
}
?>
