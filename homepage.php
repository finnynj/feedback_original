<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
        <head>
        <meta charset="utf-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
                
        <link rel="stylesheet" href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
        <script src="script.js"></script>
        <style>

        .side_bar{
                background-color: #fbfbfb;
                border-radius: 10px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.18);
                width: 360px;
                height: 531px;
                margin-top: 7px;
                margin-left: 9px;
                position: sticky;
                padding: 2px;
                float : left;
            }
            .main{
                background-color: #fbfbfb;
                border-radius: 10px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.18);
                width: 970px;
                height: 531px;
                margin-top: 7px;
                margin-left: 9px;  
                padding: 2px;
                float : left;
            }
            .content{
                padding: 2px;
            }
            .options{
                text-align: center;
                font-size: 20px;
                padding-top:15px;
                padding-bottom: 15px;
                border-bottom: 1px solid black;
                border-radius: 10px;
            }
            .options:hover{
                background-color: cornflowerblue;
            }
            .box{
                position : absolute;
                width : 900px;
                margin-left: 40px;
                padding-left:10px;
                padding-right: 10px;
                margin-top : 10px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.18);
                border-radius: 15px;
            }
            .parameter{
                border-radius: 5px; 
                margin-left: 30px;
                margin-right: 30px;
                padding-left: 10px;
                padding-right: 10px;
                height : 40px;
            }
        </style>
        <script>
            function setexam(){
                $("#setexam").show(); 
                $("#feedbackstatus").hide();  
            }
            function feedbackstatus(){
                $("#setexam").hide();
                $("#feedbackstatus").show();
            }
            function date(){
                    var dtToday = new Date();
                    
                    var month = dtToday.getMonth() + 1;
                    var day = dtToday.getDate();
                    var year = dtToday.getFullYear();
                    if(month < 10)
                        month = '0' + month.toString();
                    if(day < 10)
                        day = '0' + day.toString();
                    
                    var maxDate = year + '-' + month + '-' + day;
                    alert(maxDate);
                    $('#txtDate').attr('min', maxDate);
            }
            function timeFROM(){
                var time = $("#timefrom").val();
                time++;
	            document.getElementById("timeto").options.length = 0;
                var x = document.getElementById("timeto");
                for(var i = time;i<=16;i++){
                    var option = document.createElement("option");
                    option.text = i+":00";
                    option.value=i;
                    x.add(option);

                }
            }
            var question = [];
            function movequestion(id){
                $('#'+id).detach().appendTo('#selectedQuestion');
                question.push("id");
            }
        </script>
        </head>
        <body>
            <div class="p1-navbar">
                <div class="logo-div">
                  <img src="images/Logo.png" alt="mit-logo">
                </div>
                <div class="heading-div">
                  <h1>MIT School of management</h1>
                </div>
              </div>
              <div class="content">
                    <div class="side_bar">
                        <div class="options" onclick="setexam()">Set Feedback</div>
                        <div class="options" onclick="feedbackstatus();">Feedback Status</div>
                        <div class="options">Analysis</div>
                        <div class="options">Change Questions</div>
                    </div>
                    <div class="main">
                        <div id="setexam" style="display:none;">
                        <h2>Set Exam : </h2><br>
                            <input class="parameter" type="date" id="txtDate" />
                            <select class="parameter" id="timefrom" onclick="timeFROM()">

                                <?php
                                    for($i=8;$i<=15;$i++){
                                        echo "<option value=".$i.">".$i.":00</option>";
                                    }
                                ?>
                            </select>
                            <select class="parameter" id="timeto">
                                <option id="9">9:00</option>
                            </select>
                            <?php
                                $course = mysqli_query($con,"select * from course");
                                echo "<select class='parameter' id='course_id'>";
                                if(mysqli_num_rows($course)>0){
                                    while(($row = mysqli_fetch_assoc($course))){
                                        echo "<option value=".$row['course_id'].">".$row['course_name']."</option>";
                                    }
                                }
                                echo "</select>";
                            ?>
                            <select class="parameter" id="class">
                                <option value ="Comp-LAB1">Comp-LAB1</option>
                                <option value ="Comp-LAB2">Comp-LAB2</option>
                                <option value ="Comp-LAB3">Comp-LAB3</option>
                                
                            </select>
                            <hr>
                            <div class = "question">
                                <div class = "selectQuestion"><h2>Select Question : </h2><br>
                                <?php
                                $q=1;
                                        $questions = mysqli_query($con,"SELECT * from questions;");
                                        if(mysqli_num_rows($questions)>0){
                                                while(($question=mysqli_fetch_assoc($questions))){
                                                echo "<div class='box'  id='".$question['question_id']."' style='position:relative;margin-top:15px;' onclick='movequestion(".$question['question_id'].");'>".$q++.". ".$question['question_content']."</div>";
                                                }
                                        }
                                    ?>
                                </div>
                                
                                <div class = "selectedQuestion" id="selectedQuestion"><h2>Selected Questions : <br></h2></div>
                            </div>
                            <hr style="height:5px; opacity:.9">
                            <button class="btn" style="align:center;">Submit</button> 
                        </div>
                        <div id="feedbackstatus" style="display:none;" >
                        <?php
                            $test_schedule = mysqli_query($con,"SELECT ts_id, ts_date , ts_time_FROM,ts_time_TO,ts_status,ts_class,course_name from test_schedule , course where test_schedule.course_id=course.course_id;");
                            if(mysqli_num_rows($test_schedule)>0){
                                while(($row=mysqli_fetch_assoc($test_schedule))){

                                    echo "<div class='box' id ='box".$row['ts_id']."'>
                                        <div class='row'>
                                            <div class='col-sm'>
                                            Date : <br>
                                            ".$row['ts_date']."
                                            </div>
                                            <div class='col-sm'>
                                            Start time : <br>
                                            ".$row['ts_time_FROM']."
                                            </div>
                                            <div class='col-sm'>
                                            End Time : <br>
                                            ".$row['ts_time_TO']."
                                            </div>
                                            <div class='col-sm'>
                                            Course : <br>
                                            ".$row['course_name']."
                                            </div>
                                            <div class='col-sm'>
                                            Conducted at :<br>
                                            ".$row['ts_class']."
                                            </div>
                                            <div class='col-sm'>
                                            Status : <br>
                                            ".$row['ts_status']."
                                            </div>
                                        </div> 
                                    </div>";
                                }
                            }
                        ?>
                        </div>
                    </div>
              </div>
        </body>
</html>