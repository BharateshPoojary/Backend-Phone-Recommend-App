<?php
header("Access-Control-Allow-Origin:http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";


if($_SERVER['REQUEST_METHOD']=='GET' ){
$selectphoneinfoSql = "Select * from phoneinfo " ;
$result = mysqli_query($phoneinfoconn,$selectphoneinfoSql);
header('Content-Type:application/json');
$phonesArray=array();

while($phonesavailableintable=mysqli_fetch_assoc($result)){
    $phonesArray[]=$phonesavailableintable;  
   
}


$reversedArray[] = array_reverse($phonesArray);
$reversedArray[] = "HI";
echo json_encode($reversedArray); 
mysqli_close($phoneinfoconn);
}else {
    echo "Error: " . mysqli_error($phoneinfoconn);   
}

?>