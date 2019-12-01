<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'Bookfinder');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: profile.php');
  }
}

// ...


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  header('location: profile.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

if (isset($_POST['ISBNsearch']))
{
  $ISBNsearch=mysqli_real_escape_string($db, $_POST['ISBNsearch']);
  if (empty($ISBNsearch)) {
  	array_push($errors, "ISBN is required");
  }
  $query="select * from inventory where ISBN='".$ISBNsearch."' Limit 1";
  $result=mysqli_query($db, $query);
  if(mysqli_num_rows($results)==1)
  {
    while ($row = $result->fetch_assoc())
    {
      print_r($row);
      exit();
    }
  }
  else
  {
    echo " No book found";
      exit();
  }
}
if (isset($_POST['Post'])) {
  // receive all input values from the form
  $ISBN = mysqli_real_escape_string($db, $_POST['ISBN']);
  $title = mysqli_real_escape_string($db, $_POST['Title']);
  $price = mysqli_real_escape_string($db, $_POST['Price']);
  $course = mysqli_real_escape_string($db, $_POST['CourseCode']);
  $description = mysqli_real_escape_string($db, $_POST['Description']);
  $contact = mysqli_real_escape_string($db, $_POST['Contact']);
  $picture = mysqli_real_escape_string($db, $_POST['image']);
  $image = $_FILES['image']['name'];
  $target = "images/".basename($image);

  // if (empty($ISBN)) { array_push($errors, "ISBN is required"); }
  // if (empty($title)) { array_push($errors, "Title is required"); }
  // if (empty($price)) { array_push($errors, "Price estimate is required. Please specify in description"); }
  // if (empty($course)) { array_push($errors, "Course Code is required"); }

  // $queries = "INSERT INTO books(ISBN, title, price, courseCode, description, contact) Values(
  //   $ISBN, $title, $price, $course, $description, $contact)";
  move_uploaded_file($_FILES['image']['tmp_name'], $target);
  $queries = "INSERT INTO books(ISBN, title, price, courseCode, description, contact, picture) Values(
    '$ISBN', '$title', '$price', '$course', '$description', '$contact', '$picture')";
  if(mysqli_query($db, $queries))
  {
    echo "new record";
  }
  }


  // $result = mysqli_query($db, $query);
  // $sell = mysqli_fetch_assoc($result);

  // Get image name
  $image = $_FILES['image']['name'];
  // Get text
  $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  // image file directory
  $target = "images/".basename($image);

  $sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
  // execute query
  mysqli_query($db, $sql);

  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $msg = "Image uploaded successfully";
  }else{
    $msg = "Failed to upload image";
  }
?>
