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
    $deleteSql = "Delete from usersfavouritephonetable WHERE userName='$username' AND PhoneId ='$phoneId'";
    $result = mysqli_query($conn,$deleteSql);
    if ($result) {
        $JSONmessage = ["message" =>"Deleted"];
        echo json_encode($JSONmessage);
    }else{
        $JSONmessage = ["message" =>"Not deleted"];
        echo json_encode($JSONmessage);
    }
}
?>
