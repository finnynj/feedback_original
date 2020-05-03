<?php
include("connection.php");
$user_name = 1001;
$pass = 1001;
$login = mysqli_query($con,"select * from dummyuser where dummy_userid = '".$user_name."' and dummy_password = '".$pass."'");
    if(mysqli_num_rows($login)){
        session_start();
        $_SESSION['user']=$user_name;
        header("Location: /feedback_system/page1.html");
        echo 0;
    }
?>