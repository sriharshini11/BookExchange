

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="searchstyle.css">
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php include('errors.php'); ?>
  <label>ISBN</label>
  <input type="text" name="ISBN">
  <input type="submit" class="search" name="ISBNsearch" value="Search">
</form>

  <!-- <p class="aligncenter">
      <img src="c++.jpg" alt="centered image" />
  </p> -->
<?php

if(isset($_POST['ISBNsearch']))
{
  $con = mysqli_connect("localhost", "root", "root", "BookFinder");
  if ($con)
  {
    $ISBN=$_POST['ISBN'];
    $sql="select * from inventory where ISBN='".$ISBN."' Limit 1";
    $result=mysqli_query($con, $sql);
    if(mysqli_num_rows($result)==1)
    {
      while ($row = $result->fetch_assoc())
      {
        echo "<tr><td>" . $row['ISBN'] . $row['image'] . "</td></tr>"; //print row with image
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
