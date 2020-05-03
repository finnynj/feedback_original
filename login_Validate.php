<?php
    include("connection.php");
    $user_name = $_POST['username'];
    $pass = $_POST['password'];
    $login = mysqli_query($con,"select * from dummyuser where dummy_userid = ".$user_name." and dummy_password =".$pass."");
    if(mysqli_num_rows($login)){
        session_start();
        $_SESSION['user']=$user_name;
        echo 0;
    }
    else{
        echo 1;
    }
?>