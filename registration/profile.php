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
	<link rel="stylesheet" type="text/css" href="homestyle.css">
</head>
<body>
  <?php
  $user = $_SESSION['username'];
  $db = mysqli_connect('localhost', 'root', '', 'Bookfinder');
  $query = "SELECT * FROM books WHERE poster = '$user'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) < 1) {
    echo "No book posted";
  }
  else {
  //   echo "no results";
  // }
   // $result = mysqli_query($db, "SELECT * FROM images");



    while ($row = $result->fetch_assoc())
    // while($row = mysqli_fetch_array($result)
    {
      // echo $row['ISBN'];
		$bookid = $row['book_id'];
		echo "$bookid";
		echo "<br>";
	//	$delete_query = mysqli_query($db,"DELETE FROM books WHERE book_id=$bookid");
      echo "<tr>";
      echo "<td>";?> <img src="images/<?php echo $row['picture']; ?>" height="100" width="100"> <?php echo "</td>";
      ?>
      <div class="input-group">
	  <form action="profile.php" method = "post">
	  <button type="submit" class="btn" name="login_user">Mark as Sold</button>
			<br>
			<button type="submit" class="btn" name="Deleting_post">Delete</button>
	  </form>

    	</div>
		<?php

		if(isset($_POST["Deleting_post"]))
		{
			mysqli_query($db,"DELETE FROM books WHERE book_id=$bookid");
			header("Refresh:0");
		}

		?>


      <?php
      echo "<br>";
      // " . "<img src='images/".$row['picture']."' >" . "</td></tr>";
      //       	// echo "<p>".$row['image_text']."</p>";
          }
      // echo print_r($row);
      // echo "<br>";
      // echo 'img src="data:image/jpeg;base64,'.base64_encode( $result['picture']).'"/>';
      // while ($row2 = mysqli_fetch_array($results))
      // {
      //   echo "<img src='images/png".$row['picture']."' >";
      //   echo "<p>".$row['image_text']."</p>";
      // }
      // echo "<br>";
      // echo "<br>";
      // echo "<tr><td>" . $row['ISBN'] . "</td></tr>"; //print row with image
      // echo "<br>";
        // while ($row2 = mysqli_fetch_array($results))
        // {
        //   echo "<img src='images/".$row2['image']."' >";
        //   echo "<p>".$row2['image_text']."</p>";
        // }
    //
    // }
          // exit();
        }
          ?>
<p> <a href="login.php?logout='1'" style="color: red;">logout</a> </p>
</body>
</html>
