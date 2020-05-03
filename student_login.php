<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->


    <!--===============================================================================================-->
    	<link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
  </head>
  <body>
    <div class="navbar">
      <div class="logo">
        <img src="images/Logo.png" alt="mit-logo">
        <h2>Faculty Feedback</h2>

        <div class="sign-form">
  				<form class="login100-form ">
  					<span class="login100-form-title">
  						Sign In With
  					</span>



  					<div class="p-t-15 p-b-9">
  						<span class="txt1">
  							Username
  						</span>
  					</div>
  					<div class="wrap-input100 validate-input" data-validate = "Username is required">
  						<input class="input100" type="text" id="username" onclick="click()" >
  						<span class="focus-input100"></span>
  					</div>

  					<div class="p-t-13 p-b-9">
  						<span class="txt1">
  							Password
  						</span>


  					</div>
  					<div class="wrap-input100 validate-input" data-validate = "Password is required">
  						<input class="input100" type="password" id="pass" >
  						<span class="focus-input100"></span>
  					</div>

  					<div class="container-login100-form-btn m-t-15">
  						<button id="submit" class="login100-form-btn" onClick="validate();">
  							Sign In
  						</button>
  					</div>


  				</form>
  			</div>

      </div>
    </div>

<script>
    function validate(){


                var user_name = $("#username").val();
                var pass = $("#pass").val();
                $.ajax({
                    type: "POST",
                    url: "/feedback_system/login_Validate.php",
                    dataType: "json",
                    data: {username:user_name, password:pass},
                    success : function(data){
                       if(data==0){
                        location.href = "page1.php";
                       }
                       else{
                         $("#username").val()="Please Re-enter Username";
                         $("#pass").val()="Please Re-enter password";
                       }
                    }
                });
       }
    </script>

  </body>

</html>
