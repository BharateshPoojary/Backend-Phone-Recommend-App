<?php
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";


if ($_SERVER['REQUEST_METHOD']=="POST"){
   header("Content-Type:application/json");
   $data = file_get_contents('php://input');
   $postData = json_decode($data,true);
   $username=$postData["username"];
   $password=$postData['password'];
   $sql="Select * from users where username ='$username' ";
   $result=mysqli_query($conn,$sql);
   $num = mysqli_num_rows($result);
   if($num==1){
      $row=mysqli_fetch_assoc($result);
      $verified=password_verify($password,$row['password']);
      if ($verified){
         $verifiedmessage=['login'=>'success'];
         echo json_encode($verifiedmessage);
      }else{
         $notverifiedmessage=['login'=>'failure'];
         echo json_encode($notverifiedmessage);
        }    
   }else{
      $invalidcredentialmessage=['credential'=>'invalid'];
      echo json_encode($invalidcredentialmessage);
   }  
}

?>
