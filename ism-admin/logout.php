<?php
session_start(); // Start the session



session_destroy();

// Redirect to a different page after destroying the session (optional)
header("Location: index.php");
exit();
?>
