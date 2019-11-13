<?php
$con = mysqli_connect("localhost", "root", "", "demo");
if ($con)
{
  echo "connect";

    $uname=$_POST['username'];
    $password=$_POST['password'];
    $sql="select * from loginform where User='".$uname."' AND  Pass='".$password."' Limit 1";
    $result=mysqli_query($con, $sql);

    if(mysqli_num_rows($result)==1)
    {
        header("Location: homepage.html");
        exit();
    }
    else
    {
        echo " You Have Entered Incorrect Password";
        exit();
    }
}
else
{
    Echo "Connection unsuccessful";
    echo "\n";
}
?>
