<?php
  include_once("header.html");
  include('server.php');
  include('errors.php');
  // session_start();
?>
<?php
if (isset($_POST['Post'])){
  //TODO: add error message if something is not set. If picture not set, verify with customer?
$ISBN = mysqli_real_escape_string($db, $_POST['ISBN']);
$title = mysqli_real_escape_string($db, $_POST['Title']);
$price = mysqli_real_escape_string($db, $_POST['Price']);
$course = mysqli_real_escape_string($db, $_POST['CourseCode']);
$description = mysqli_real_escape_string($db, $_POST['Description']);
$contact = mysqli_real_escape_string($db, $_POST['Contact']);
$user = $_SESSION['username'];
$db = mysqli_connect("localhost", "root", "root", "bookfinder");
// Get image name
$image = $_FILES['image']['name'];
if(file_exists($image))
{
  $target = "images/".basename($image);
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $msg = "Image uploaded successfully";
  }else{
    $msg = "Failed to upload image";
  }
}
else {
  $image = 'NULL';
}
// image file directory

$query = "INSERT INTO books(ISBN, title, price, courseCode, description, contact, picture, poster) Values(
  '$ISBN', '$title', '$price', '$course', '$description', '$contact', '$image', '$user')";
  //TODO: print success message if inserted correctly
if(mysqli_query($db, $query))
{
  echo "recprd";
}
else {
  echo "try again";
}


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
<!-- Work on multi-image -->
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
