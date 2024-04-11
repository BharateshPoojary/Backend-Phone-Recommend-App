<?php
header("Access-Control-Allow-Origin:http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";
header('Content-Type: application/json');//It must be there otherwise it will not get formatted as json

if($_SERVER['REQUEST_METHOD']=='GET' ){


$selecttopphoneinfoSql = "Select * from phoneinfo WHERE Level='Top'" ;
$result = mysqli_query($phoneinfoconn,$selecttopphoneinfoSql);

while($topphonesavailableintable=mysqli_fetch_assoc($result)){
    $topphonesArray[]=$topphonesavailableintable;  
   
}

$MainArray[]=$topphonesArray;

$selectbestphoneinAndroidinfoSql = "Select * from phoneinfo WHERE Level='Best' AND OS = 'Android'" ;
$result = mysqli_query($phoneinfoconn,$selectbestphoneinAndroidinfoSql);

while($bestphonesinAndroidavailableintable=mysqli_fetch_assoc($result)){
    $bestphonesinAndroidArray[]=$bestphonesinAndroidavailableintable;  
   
}
$MainArray[]=$bestphonesinAndroidArray;

$selectbestphoneinIOSinfoSql = "Select * from phoneinfo WHERE  OS = 'IOS'" ;
$result = mysqli_query($phoneinfoconn,$selectbestphoneinIOSinfoSql);

while($bestphonesinIOSavailableintable=mysqli_fetch_assoc($result)){
    $bestphonesinIOSArray[]=$bestphonesinIOSavailableintable;  
   
}
$MainArray[]=$bestphonesinIOSArray;
echo json_encode($MainArray); 
mysqli_close($phoneinfoconn);
}else {
    echo "Error: " . mysqli_error($phoneinfoconn);   
}

?>