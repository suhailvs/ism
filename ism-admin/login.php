<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace this with your actual authentication logic (e.g., database check)
    // For demonstration purposes, let's assume a simple check
    $valid_username = 'ismadmin'; // Replace with your valid username
    $valid_password = '$ha123#'; // Replace with your valid password

    // Check if username and password match
    if ($username === $valid_username && $password === $valid_password) {
        session_start();
        $_SESSION['loginKey'] = 'sha12#';
        // Successful login - Redirect to a dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials - Redirect back to login page with an error message
        header("Location: index.php?error=invalid");
        exit();
    }
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: index.php");
    exit();
}
?>
