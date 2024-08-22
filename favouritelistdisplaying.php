<?php 
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    header("Content-Type:application/json");
    $data = file_get_contents('php://input');
    $postData = json_decode($data,true);
    $username = $postData['username'];
    $accessing_phoneId="Select PhoneId from  usersfavouritephonetable WHERE userName='$username'";
   $IdResult = mysqli_query($conn,$accessing_phoneId);
    if (mysqli_num_rows($IdResult)>0) {
        while ($phoneIdsavailable=mysqli_fetch_assoc($IdResult)) {
            $phoneId= $phoneIdsavailable["PhoneId"];
            $accessing_phonedata="Select * from phoneinfo WHERE PhoneId='$phoneId'";
            $phoneResult=mysqli_query($conn,$accessing_phonedata);
            while ($phoneDataavailable =mysqli_fetch_assoc($phoneResult)) {
               $phonedataArray[]=  $phoneDataavailable;
            }
        }
        echo json_encode($phonedataArray);
    }else{
        $JSONmessage = ["message" =>"There is nothing in your Wish list"];
        echo json_encode($JSONmessage);
    }
}