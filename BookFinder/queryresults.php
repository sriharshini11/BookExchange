<?php
$con = mysqli_connect("localhost", "root", "root", "BookFinder");
if ($con)
{
    $ISBNsearch=$_POST['ISBN'];

    $sql="select * from inventory where ISBN='".$ISBNsearch."' Limit 1";
    $result=mysqli_query($con, $sql);

    if(mysqli_num_rows($result)==1)
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
else
{
    Echo "Connection unsuccessful";
    echo "\n";
}

?>
