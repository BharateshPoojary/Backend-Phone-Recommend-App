<?php
$login=false;
$logindenied=false;
$incorrectpassword=false;

if ($_SERVER["REQUEST_METHOD"]=="POST"){
   include "partials/_dbconnect.php";
   $userdetail=$_POST["username"];
   $password=$_POST["password"];
   $sql="Select * from users where username ='$userdetail' ";
   $result=mysqli_query($conn,$sql);
   $num = mysqli_num_rows($result);
   if($num==1){
      $row=mysqli_fetch_assoc($result);
      $verified=password_verify($password,$row['password']);
      if ($verified){
         $login=true;
         session_start();
         $_SESSION['userdetail']= $userdetail;
         header("location: welcome.php");
      }else{
         $incorrectpassword=true;
        }    
   }else{
      $logindenied=true;
   }  
}
if ($login) {
   $message = "Success! You logged in successfully";
   echo "<script type='text/javascript'>alert('$message');</script>";  }
if($logindenied){
   $errormessage = "Sorry! cant login invalid credentials ";
   echo "<script type='text/javascript'>alert('$errormessage');</script>"; 
}
if($incorrectpassword){
   $errormessage = "Cant login ! Invalid Password ";
   echo "<script type='text/javascript'>alert('$errormessage');</script>"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .formcontainer{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-right:2%;
         }
       
         input{
            height:30px;
            width: 350px;
            border-color:rgb(178, 178, 197);
            border-radius:5px;
            font-size:17px;
         }
         input:focus{
            border-color:black;
         }
         label{
            font-size: 1.5rem;
            color: #1a202c;
         }
         span{
           font-family:Calibri;
         }
         .loginform{
           display:flex;
           justify-content:center;
           align-items:center;
           font-family:Calibri;
           font-size:30px;
           font-weight:bold;
           color:rgb(44, 44, 44);
           margin-right:10px;
           margin-bottom:20px;
         }
         .loginbutton{
            border-radius:5px;
            margin-top:5px;
            height:35px;
            width:360px;
            background-color:black;
            color:white;
         }
         .loginbutton:hover{
            background-color:rgb(79, 79, 79);
         }
         .maincontainer{
            margin-top:7%;
         }
         .signupredirect{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:10px;
            color:rgb(79, 79, 79);
            font-size:1.5rem;
            font-family:Calibri;
         }
         span{
            color:rgb(79, 79, 79);
         }
         #signup{
            color:black;
            font-weight:bold;
            text-decoration:none;
         }
         #signup:hover{
            color:rgb(79, 79, 79);
         }
    </style>
</head>
<body>
   
    <div class="maincontainer">
    <div class="loginform">Login to your account</div>
    <div class="formcontainer">
     <form action="/MYPROJECTLOGINPAGE/login.php" method="post" > 
        <label for="username"><span>User Name</span></label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password"><span>Password</span></label><br>
        <input type="password" id="password" name="password" required><br>
        <button class="loginbutton">Login</button>
        <div class="signupredirect">Not a member? <a href="/MYPROJECTLOGINPAGE/signup.php" id="signup">Sign Up</a></div>
    </form>
    </div>
    </div>
</body>
</html>
