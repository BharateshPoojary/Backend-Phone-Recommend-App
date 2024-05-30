<?php
header("Access-Control-Allow-Origin:http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";


if ($_SERVER["REQUEST_METHOD"]=="POST"){
   $login=false;
   $logindenied=false;
   $incorrectpassword=false;

   $userdetail=$_POST["username"];
   $password=$_POST["password"];
   $sql="Select * from users where username ='$userdetail' ";
   $result=mysqli_query($conn,$sql);
   $num = mysqli_num_rows($result);
   if($num==1){
      $row=mysqli_fetch_assoc($result);
      $verified=password_verify($password,$row['password']);
      if ($verified){
         // session_start();
         // $_SESSION['userdetail']= $userdetail;
         $loginmessage = "You logged in successfully";
         echo "<script type='text/javascript'>alert('$loginmessage');
               window.location.href = 'http://127.0.0.1:5500/index.html';
         </script>"; 
      }else{
         $incorrectpassword=true;
        }    
   }else{
      $logindenied=true;
   }  
   if($logindenied){
      $errormessage = "Sorry! cant login invalid credentials ";
      echo "<script type='text/javascript'>alert('$errormessage');
            window.location.href = 'http://127.0.0.1:5500/loginsystem/login.html';
      </script>"; 
   }
   if($incorrectpassword){
      $errormessage = "Cant login ! Invalid Password ";
      echo "<script type='text/javascript'>alert('$errormessage');
            window.location.href = 'http://127.0.0.1:5500/loginsystem/login.html';
      </script>"; 
   }
}

?>
