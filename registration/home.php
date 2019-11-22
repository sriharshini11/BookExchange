<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="homestyle.css">
</head>
<body>

  <div class="headerhome">
  	<h2>Home Page</h2>
  </div>
  <div class="content">
      <!-- notification message -->
      <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
          <h3>
            <?php
              echo $_SESSION['success'];
              unset($_SESSION['success']);
            ?>
          </h3>
        </div>
      <?php endif ?>

      <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <?php endif ?>

        <button type="submit" class = "mainpage" onclick="location='home.php'" name="home">Home</button>
        <br> </br>
        <button type="submit" class = "mainpage" onclick="location='profile.php'" name="profile">Profile</button>
        <br> </br>
        <button type="submit" class = "mainpage" onclick="location='search.php'" name="search">Search</button>

      <!-- logged in user information -->
        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
  </div>

</body>
</html>
