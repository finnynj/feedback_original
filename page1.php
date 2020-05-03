<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
  <link rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
  <script src="script.js"></script>
</head>

<body class="page1" onload="f1()">
  <div class="p1-navbar">
    <div class="logo-div">
      <img src="images/Logo.png" alt="mit-logo">
    </div>
    <div class="heading-div">
      <h1>MIT School of management</h1>
    </div>
    <div class="side-div">
      <h3 id="showtime"></h3>
    </div>
  </div>
  <!--p1-navbar ends-->



  <div class="body-container"></div>
  <div class="qs-container">
    <?php
    $i=1;
      $question = mysqli_query($con,"select * from questions");
      if(mysqli_num_rows($question)>0){
          while(($questions = mysqli_fetch_assoc($question))){
              echo " <div class='q".$i."'>
              <p>".$i.". ".$questions['question_content']."</p>
                <div class='outer' id='outer".$i."' onmousemove=fillBar('inner',".$i.")><div class='inner' id='inner".$i."' style='background-color: rgb(255,0,0);' ></div></div>
                <div id='score".$i++."' style='margin-left: 318px;'>0</div>
            </div>";
          }
      }
    ?>
    
  </div>
  <div class="detail-container"> </div>
  <div class="d1">
    <div class="space">

      <img src="images/img_avatar.png" alt="Avatar" class="avatar">

    </div>

    <div class="dropdown">
      <select onclick="myFunction()" class="dropbtn" >
      <div id="myDropdown" class="dropdown-content">
      <?php
      $teacher = mysqli_query($con,"select * from teacher");
      if(mysqli_num_rows($teacher)>0){

            while(($teachers = mysqli_fetch_assoc($teacher))){
              echo "<option value=".$teachers['teacher_id'].">".$teachers['teacher_name']."</option>";
            }
        }
       
      ?>
        
      </div>
      </select>
    </div>
   

    <div class="head-d1">
      <p>Course</p>

    </div>
    <div class="body-d1">
        <?php
            $course = mysqli_query($con,"select course_id from test_schedule where"); 
        ?>
      <p>MCA (Management)</p>
    </div>

    <div class="button"> Submit </div>
  </div>

  </div>
  </div>


  <div class="vl"></div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onclick="redirect()">&times;</button>
        </div>
        <div class="modal-body">
          <p>Your Feedback Time is Over .</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal" onclick="redirect()">Submit</button>
        </div>
      </div>
  
    </div>
  </div>


</body>
<script>
  var prevwidth=0;
  function fillBar(id,i){
      var x = event.pageX - $('#outer'+i).offset().left;
      // alert(x);
      var change;
      var color= document.getElementById("inner"+i).style.backgroundColor;
      var match = color.match(/rgba?\((\d{1,3}), ?(\d{1,3}), ?(\d{1,3})\)?(?:, ?(\d(?:\.\d?))\))?/);
      document.getElementById("inner"+i).style.backgroundColor = "lightblue"
      //alert(match[2]);
      width = (x/600)*100;
     /* if(width>prevwidth){
          match[2]++;
          match[1]--;
          document.getElementById("inner").style.backgroundColor="rgb("+match[1]+","+match[2]+",0)";
      } 
      else{
          match[1]++;
          match[2]--;
          document.getElementById("inner").style.backgroundColor="rgb("+match[1]+","+match[2]+",0)";
      }   
    */
      document.getElementById("inner"+i).style.width = Math.floor(width)+"%";
      document.getElementById("score"+i).innerHTML=Math.floor(width);
      width=prevwidth;
  }
  var tim;
       
        var min = 5;
        var sec = 60;
        var f = new Date();
        function f1() {
            f2();
            document.getElementById("starttime").innerHTML = "Your started your Exam at " + f.getHours() + ":" + f.getMinutes();
        }
        function f2() {
            if (parseInt(sec) > 0) {
                sec = parseInt(sec) - 1;
                document.getElementById("showtime").innerHTML = "Time Left "+min+":" + sec+"";
                tim = setTimeout("f2()", 1000);
            }
            else {
                if (parseInt(sec) == 0) {
                    min = parseInt(min) - 1;
                    if (parseInt(min) == 0) {
                        clearTimeout(tim);
                        location.href = "page1.html";
                    }
                    else {
                      $('#myModal').modal('show');
                    }
                }
               
            }
        }
        function redirect(){
          location.href = "student_login.php";
        }
       
</script>
</html>
