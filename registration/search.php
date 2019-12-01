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

  $ISBN = $_POST['ISBN'];
  if (empty($ISBN)) { echo "Is empty"; }
  else{
  $con = mysqli_connect("localhost", "root", "root", "BookFinder");
  $results = mysqli_query($con, "SELECT * FROM books WHERE ISBN = '$ISBN'");
  if ($con)
  {
    $ISBN=$_POST['ISBN'];

    // $result=mysqli_query($con, $sql);
      while ($row = $results->fetch_assoc())
      {
        echo "<tr><td>" . $row['ISBN'] . "</td></tr>"; //print row with image
          echo "<tr>";
          echo "<td>";?> <img src="images/<?php echo $row['picture']; ?>" height="100" width="100"> <?php echo "</td>";
          echo "<br>";


      }
            exit();
  }
}
}

?>
</body>
</html>
