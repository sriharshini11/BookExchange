<?php include_once("header.html"); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="homestyle2.css">
</head>
<body>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php include('errors.php'); ?>
  <input type="text" class="search" name="ISBN" placeholder="ISBN"><br>
  <input type="submit" class="search" name="ISBNsearch" value="Search">
</form>



<?php
if(isset($_POST['ISBN']))
{

  $like = $_POST['ISBN'];
  if (empty($like)) { echo "Is empty"; }
  else{
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
}

?>
</body>
</html>
