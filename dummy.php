<?php
    include("connection.php");
    $class = $_POST['class'];
    $flag = $_POST['flag'];
    if($flag == 1 ){
        $arr=[];
        $count = mysqli_query($con,"select * from dummyuser");
        if(mysqli_num_rows($count)==0){
            for($i=1000;$i<=1050;$i++){
                mysqli_query($con,"insert into dummyuser values('".$i."','".$i."','".$class."')");
            }
        }
        else{
                $sql = mysqli_query($con,"select dummy_userid as max from dummyuser order by dummy_userid desc limit 1");
                $max = mysqli_fetch_assoc($sql);
                $max = $max['max'];
                $max++;
                for($i=1;$i<=50;$i++){
                    mysqli_query($con,"insert into dummyuser values('".$max."','".$max++."','".$class."')");
                }
        }
    }
    if($flag == 2 ){
        mysqli($con,"delete from dummyuser where class='".$class."'");
    }
?>