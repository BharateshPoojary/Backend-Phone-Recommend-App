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

$selectbestphoneinAndroidinfoSql = "Select * from phoneinfo WHERE sno BETWEEN 2 AND 21" ;
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

$Under10kavailableinfoSql = "Select * from phoneinfo WHERE  Price <= 10000" ;
$result = mysqli_query($phoneinfoconn,$Under10kavailableinfoSql);

while($Under10kavailableintable=mysqli_fetch_assoc($result)){
    $Under10kavailableArray[]=$Under10kavailableintable;  
   
}
$MainArray[]= $Under10kavailableArray;

$Under20kavailableinfoSql = "Select * from phoneinfo WHERE  Price BETWEEN 10001 AND 20000" ;
$result = mysqli_query($phoneinfoconn,$Under20kavailableinfoSql);

while($Under20kavailableintable=mysqli_fetch_assoc($result)){
    $Under20kavailableArray[]=$Under20kavailableintable;  
   
}
$MainArray[]= $Under20kavailableArray;


$Under40kavailableinfoSql = "Select * from phoneinfo WHERE  Price BETWEEN 20001 AND 40000" ;
$result = mysqli_query($phoneinfoconn,$Under40kavailableinfoSql);

while($Under40kavailableintable=mysqli_fetch_assoc($result)){
    $Under40kavailableArray[]=$Under40kavailableintable;  
   
}
$MainArray[]= $Under40kavailableArray;

$Under70kavailableinfoSql = "Select * from phoneinfo WHERE  Price BETWEEN 40001 AND 70000" ;
$result = mysqli_query($phoneinfoconn,$Under70kavailableinfoSql);

while($Under70kavailableintable=mysqli_fetch_assoc($result)){
    $Under70kavailableArray[]=$Under70kavailableintable;  
   
}
$MainArray[]= $Under70kavailableArray;

$Above80kavailableinfoSql = "Select * from phoneinfo WHERE  Price >=80000" ;
$result = mysqli_query($phoneinfoconn,$Above80kavailableinfoSql);

while($Above80kavailableintable=mysqli_fetch_assoc($result)){
    $Above80kavailableArray[]=$Above80kavailableintable;  
   
}
$MainArray[]= $Above80kavailableArray;
echo json_encode($MainArray); 
mysqli_close($phoneinfoconn);
}else {
    echo "Error: " . mysqli_error($phoneinfoconn);   
}

?>