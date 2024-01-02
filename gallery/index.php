<!doctype html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>ISM Gallery</title>
  <link rel="stylesheet" href="gal.css?c=133">
  <meta name="description" content="">
  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="../uploads/max/<?php echo $row["name"];?>">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <script defer="defer" src="./js/app.js"></script>
</head>

<body>
<div class="row">
  <div class="col s12 m12" style="text-align: center;">
    <a href="https://isminspire.com/"><img class="logo" src="../img-2/logo-2.jpg" alt=""></a>
  </div>
</div>
<div class="masonry-container">

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
if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
?>

<div class="panel">
<a href='./image-det.php?name=<?php echo $row["name"];?>'>
    <div class="panel-wrapper">
      <div class="panel-overlay">
        <div class="panel-text">

        </div>
        <img class="panel-gradient" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/375042/base-gradient.png" alt=""/>
        <img class="panel-vingette" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/375042/darken-gradient.png" alt=""/>
      </div>
      <div class="panel-img" style="background-image: url('../uploads/max/<?php echo $row["name"];?>')";> </div>
    </div>
      </a>
  </div>

        <?php

          }


      }
      // Free result set
      $result->free_result();
  }
  ?>

</div>
<div class="row">
  <div class="col s12 m12">
<footer class="page-footer">
  <div class="container">
  <div class="footer-icons">
    <a href="https://www.youtube.com/@IsmKerala" target="_blank"><img src="../img-2/youtube.png" /></a>
    <a href="https://www.facebook.com/ismkerala1967" target="_blank"><img src="../img-2/facebook.png" /></a>
    <a href="https://www.instagram.com/ism_kerala/" target="_blank"><img src="../img-2/instagram.png" /></a>
    <a href="https://whatsapp.com/channel/0029Va5BLq8K5cD6zMm5ws0x" target="_blank"><img src="../img-2/whatsapp.png" /></a>
        <a href="https://www.youtube.com/@renaitvofficial" target="_blank"><img src="../img-2/renai.png" /></a>

  </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
          <img src="../img-2/ism-inspire-logo.png" alt=""><br />

      @Powered By Team Inspire <br />
      <i style="font-size: 10px">(IT Professional wing of ISM)</i>

    </div>
  </div>
</footer>
  </div>
</div>


</body>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-68E48KZ4G1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-68E48KZ4G1');
</script>
</html>
