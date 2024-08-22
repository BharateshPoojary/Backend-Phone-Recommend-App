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
   $cpassword=$postData['cpassword'];
   $existSql="Select * from users WHERE username ='$username'";
   $result = mysqli_query($conn,$existSql);
   $numExistRows = mysqli_num_rows($result);
   if($numExistRows>0){
      $unameexistmessage=['username'=>'exist'];
      echo json_encode($unameexistmessage);
   }else{
      if ($password==$cpassword) {
         $hash=password_hash($password,PASSWORD_DEFAULT);   
         $sql="INSERT INTO `users` (`username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp())";
         //This line constructs an SQL query to insert data into a table named "users". 
         //It inserts the submitted username, password, and the current timestamp into the respective columns of the table.
         $result=mysqli_query($conn,$sql);
         //The mysqli_query() function executes/performs the given query on the database.
         //mysqli_query($con, query)
         // Takes mainly 2 important parameter 
         //con(Mandatory) This is an object representing a connection to MySQL Server.
         //query(Mandatory) This is a string value representing the query to be executed.
         if($result){
            $acmessage=['account'=>'created'];
            echo json_encode($acmessage);
         }
      }else{
         $mismatchmessage = ["password" =>"mismatched"];
         echo json_encode($mismatchmessage);
      }
   }   
}


