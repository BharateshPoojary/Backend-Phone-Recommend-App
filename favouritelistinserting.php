<?php 
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    header("Content-Type:application/json");
    $data = file_get_contents('php://input');
    $postData = json_decode($data,true);
    $username=$postData["username"];
    $phoneId=$postData['phoneId'];
    $insertsql="INSERT INTO `usersfavouritephonetable` ( `userName`,`PhoneId`) VALUES ( '$username','$phoneId')";
    $result=mysqli_query($conn,$insertsql);
    if($result){
        $JSONmessage = ["message" =>"phoneadded"];
        echo json_encode($JSONmessage);
    }else{
        $JSONmessage = ["message" =>"phonenotadded"];
        echo json_encode($JSONmessage);
    }

}
?>
