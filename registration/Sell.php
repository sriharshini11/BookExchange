<?php
  include_once("header.html");
  // include('server.php');
  // session_start();
?>
<?php

$db = mysqli_connect("localhost", "root", "root", "bookfinder");
// Get image name
$image = $_FILES['image']['name'];
// Get text
// $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

// image file directory
$target = "images/".basename($image);

$sql = "INSERT INTO books(picture) VALUES ('$image')";
// execute query
mysqli_query($db, $sql);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  $msg = "Image uploaded successfully";
}else{
  $msg = "Failed to upload image";
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="homestyle2.css">
</head>
<body>

  <div>
      <!-- notification message -->
      <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <?php endif ?>

      <form method="post" action="" enctype="multipart/form-data" <?php echo $_SERVER['PHP_SELF']; ?>>
        <?php include('errors.php'); ?>
        <input type="text" class="search" name="ISBN" placeholder="ISBN"><br>
        <input type="text" class="search" name="Title" placeholder="Title"><br>
        <input type="text" class="search" name="Price" placeholder="Price"><br>
        <input type="text" class="search" name="CourseCode" placeholder="Course Code"><br>
        <input type="text" class="search" name="Description" placeholder="Description"><br>
        <input type="text" class="search" name="Contact" placeholder="Contact Details"><br>
        <input type="hidden" name="size" value="1000000">
       	<div>
       	  <input type="file" name="image">
       	</div>
        <input type="submit" class="search" name="Post" value="Post">
      </form>

  </div>
</body>
</html>
