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
   <input type="text" class="search" name="ISBN" placeholder="Search with ISBN" id="ISBNinput"><br>
   <input type="text" class="search" name="Title" placeholder="Search with Title" id="Titleinput"><br>
   <input type="text" class="search" name="Course" placeholder="Search with Course Code" id="Courseinput"><br>
   <input type="submit" class="search" name="ISBNsearch" value="Search">
   <script>
   var input1 = document.getElementById("ISBNinput");
   var input2 = document.getElementById("Titleinput");
   var input3 = document.getElementById("Courseinput");
   input1.oninput = function () {
     input2.disabled = this.value != "";
     input3.disabled = this.value != "";
 };
 input2.oninput = function () {
   input1.disabled = this.value != "";
   input3.disabled = this.value != "";
 };
 input3.oninput = function () {
   input2.disabled = this.value != "";
   input1.disabled = this.value != "";
 };
 </script>
 </form>

 <?php
 //error checking: If nothing is filled, error message;
 if(isset($_POST['ISBN']))
 {
   $ISBN = $_POST['ISBN'];
   $con = mysqli_connect("localhost", "root", "", "BookFinder");
   $results = mysqli_query($con, "SELECT * FROM books WHERE ISBN = '$ISBN'");
   $counting=mysqli_query($con,"SELECT count(*) c FROM books WHERE ISBN = '$ISBN'");
   $data=mysqli_fetch_assoc($counting);
   echo $data['c'];
   echo " Books Found";
   echo "<br>";
   $ISBN=$_POST['ISBN'];
   while ($row = $results->fetch_assoc())
   {
     if($row['picture'] != 'NULL')
     {
       echo "<tr>";
       echo "<td>"; ?> <img src="images/<?php echo $row['picture']; ?>" height="200" width="150"> <?php echo "</td>";
     }
     else
     {
       echo "<tr>";
       echo "<td>"; ?> <img src="images/nophoto.png" height="200" width="150"> <?php echo "</td>";
    }
    echo "<tr><td>" . $row['ISBN'] . "</td></tr>"; //print row with image
    echo "<tr><td> contact: " .$row['contact'] ."</td></tr>";
    echo "<br><tr>";
   }
   exit();
 }
 if(isset($_POST['Title']))
 {
   $title = $_POST['Title'];
   $con = mysqli_connect("localhost", "root", "", "BookFinder");
   $results = mysqli_query($con, "SELECT * FROM books
                           WHERE title like '$title%' OR
                           title like '%$title' OR
                           title like '%$title%' OR
                           title = '$title'");

  $counting=mysqli_query($con,"SELECT count(*) c FROM books WHERE title like '$title%' OR
  title like '%$title' OR
  title like '%$title%' OR
  title = '$title'");
  $data=mysqli_fetch_assoc($counting);
  echo $data['c'];
  echo " Books Found";
  echo "<br>";
 //  $ISBN=$_POST['ISBN'];
   while ($row = $results->fetch_assoc())
   {
     if($row['picture'] != 'NULL')
     {
       echo "<tr>";
       echo "<td>"; ?> <img src="images/<?php echo $row['picture']; ?>" height="200" width="150"> <?php echo "</td>";
     }
     else
     {
       echo "<tr>";
       echo "<td>"; ?> <img src="images/nophoto.png" height="200" width="150"> <?php echo "</td>";
    }
    echo "<tr><td>" . $row['ISBN'] . "</td></tr>"; //print row with image
    echo "<tr><td> contact: " .$row['contact'] ."</td></tr>";
    echo "<br><tr>";
   }
   exit();
 }
 if(isset($_POST['Course']))
 {
   $course = $_POST['Course'];
   $con = mysqli_connect("localhost", "root", "", "BookFinder");
   $results = mysqli_query($con, "SELECT * FROM books WHERE CourseCode = '$course'");
   while ($row = $results->fetch_assoc())
   {
     if($row['picture'] != 'NULL')
     {
       echo "<tr>";
       echo "<td>"; ?> <img src="images/<?php echo $row['picture']; ?>" height="100" width="100"> <?php echo "</td>";
     }
     else
     {
       echo "<tr>";
       echo "<td>"; ?> <img src="images/nophoto.png" height="200" width="150"> <?php echo "</td>";
    }
    echo "<tr><td>" . $row['ISBN'] . "</td></tr>"; //print row with image
    echo "<tr><td> contact: " .$row['contact'] ."</td></tr>";
    echo "<br><tr>";
   }
   exit();
 }
 //if cannot find any results, print error message.
 ?>
 </body>
 </html>
