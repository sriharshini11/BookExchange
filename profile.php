<?php
  include_once("header.html");
  include('server.php');
  // session_start();
  // if (isset($_GET['logout'])) {
  // 	session_destroy();
  // 	unset($_SESSION['username']);
  // 	header("location: login.php");
  // }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="homestyle2.css">
</head>
<body>
  <?php
  $user = $_SESSION['username'];
  $db = mysqli_connect('localhost', 'root', 'root', 'Bookfinder');
  $query = "SELECT * FROM books WHERE poster = '$user'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) < 1) {
    echo "No book posted";
  }
  else {
    while ($row = $result->fetch_assoc())
    {
		$bookid = $row['book_id'];
    $name = "btn" . $bookid;

        if($row['picture'] != 'NULL')
        {
          echo "<tr>";
          echo "<td>"; ?> <img src="images/<?php echo $row['picture']; ?>" height="100" width="100"> <?php echo "</td>";
      }
      else {
        echo "<tr>";
        echo "<td>"; ?> <img src="images/nophoto.png" height="100" width="100"> <?php echo "</td>";
      }
      ?>
      <div class="input-group">
	  <form action="profile.php" method = "post">
			<br>
			<button type="submit" class="btn" name="<?php echo($name);?>">Delete</button>
	  </form>

    	</div>
		<?php
		if(isset($_POST[$name]))
		{
			mysqli_query($db,"DELETE FROM books WHERE book_id=$bookid".";");
      header("Refresh:0");
      break;
		}
		?>
      <?php
      echo "<br>";
          }
        }
          ?>
<p> <a href="login.php?logout='1'" style="color: red;">logout</a> </p>
</body>
</html>
