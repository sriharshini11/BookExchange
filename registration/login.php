<?php include('server.php')

?>
<?php
if(isset($_POST["login_user"]))
 {
  
   // $query ="
   // INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
   // (1, 'johnsmith', '$2y$10$4REfvTZpxLgkAR/lKG9QiOkSdahOYIR3MeoGJAyiWmRkEFfjH3396'),
   // (2, 'peterParker', '$2y$10$4REfvTZpxLgkAR/lKG9QiOkSdahOYIR3MeoGJAyiWmRkEFfjH3396'),
   // (3, 'davidMoore', '$2y$10$4REfvTZpxLgkAR/lKG9QiOkSdahOYIR3MeoGJAyiWmRkEFfjH3396')";

  $query = "
    SELECT * FROM login
     WHERE username = :username
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
     array(
       ':username' => $_POST["username"]
      )
   );
   $count = $statement->rowCount();
   if($count > 0)
  {
   $result = $statement->fetchAll();
     foreach($result as $row)
     {

       if(password_verify($_POST["password"], $row["password"]))
       {
         $_SESSION['user_id'] = $row['user_id'];
         $_SESSION['username'] = $row['username'];
         $sub_query = "
         INSERT INTO login_details
         (user_id)
         VALUES ('".$row['user_id']."')
         ";
         $statement = $connect->prepare($sub_query);
         $statement->execute();
         $_SESSION['login_details_id'] = $connect->lastInsertId();
         //header("location:chat/index.php");
       }
       else
       {
        $message = "<label>Wrong Password</label>";
       }
     }
  }
  else
  {
   $message = "<label>Wrong Username</labe>";
  }
 }
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <p class="aligncenter">
      <img src="login.png" alt="centered image" />
  </p>
  <div class="header">
  	<h2>Login</h2>
  </div>

  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>
