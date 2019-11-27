

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="searchstyle.css">
</head>
<body>


  <div class="headerhome">
  	<h2>Home Page</h2>
  </div>

  <div class="content">
        <button type="submit" class = "mainpage" onclick="location='home.php'" name="home">Home</button>
        <br> </br>
        <button type="submit" class = "mainpage" onclick="location='profile.php'" name="profile">Profile</button>
        <br> </br>
        <button type="submit" class = "mainpage" onclick="location='search.php'" name="search">Search</button>
  </div>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php include('errors.php'); ?>
  <label>ISBN</label>
  <input type="text" name="ISBN">
  <input type="submit" class="search" name="ISBNsearch" value="Search">
</form>
<?php

if(isset($_POST['ISBNsearch']))
{
  $like = $_POST['ISBNsearch'];
  $con = mysqli_connect("localhost", "root", "root", "BookFinder");
  $results = mysqli_query($con, "SELECT * FROM images WHERE image LIKE '9780134443829%'");
  if ($con)
  {
    $ISBN=$_POST['ISBN'];
    $sql="select * from inventory where ISBN='".$ISBN."' Limit 1";
    $result=mysqli_query($con, $sql);
    if(mysqli_num_rows($result)==1)
    {
      while ($row = $result->fetch_assoc())
      {
        echo "<tr><td>" . $row['ISBN'] . "</td></tr>"; //print row with image
          while ($row2 = mysqli_fetch_array($results))
          {
            echo "<img src='images/".$row2['image']."' >";
            echo "<p>".$row2['image_text']."</p>";
          }

        exit();
      }
    }
    else
    {
      echo " No book found ";
        exit();
    }
  }
}

?>
</body>
</html>
