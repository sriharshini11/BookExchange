<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="homestyle.css">
</head>
<body>

  <div class="headerhome">
  	<h2>Profile</h2>
  </div>
  <div class="content">
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
