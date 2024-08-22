<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $PhoneName=$_POST["PhoneName"];
    $PhoneImageUrl=$_POST["PhoneImageUrl"];
    $Price=$_POST["Price"];
    $Ram=$_POST["Ram"];
    $Processor=$_POST["Processor"];
    $RearCamera=$_POST["RearCamera"];
    $FrontCamera=$_POST["FrontCamera"];
    $Battery=$_POST["Battery"];
    $Display=$_POST["Display"];
    $OS=$_POST['OS'];
    $Storage=$_POST['Storage'];
    $Level =$_POST['Level'];


    $existSql = "Select * from phoneinfo WHERE PhoneName='$PhoneName'";
    $result = mysqli_query($conn,$existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows>0){
       $phonenameexist="Phone Already Exists";
       echo "<script type='text/javascript'>alert('$phonenameexist');
       window.location.href = 'http://127.0.0.1:5500/phonespecsinsert/phonespecs.html';
       </script>"; 
    }
    else{
        $insertsql="INSERT INTO `phoneinfo` ( `PhoneName`, `PhoneImageUrl`, `Price`, `Ram`, `Processor`, `RearCamera`, `FrontCamera`, `Battery`, `Display`,`OS`,`Storage`,`Level`) VALUES ( '$PhoneName', '$PhoneImageUrl', '$Price', '$Ram', '$Processor', '$RearCamera', '$FrontCamera','$Battery', '$Display','$OS','$Storage','$Level')";
        $result=mysqli_query($conn,$insertsql);
        if($result){
            $insertedsuccessfully="Phone data inserted successfully";
            echo "<script type='text/javascript'>alert('$insertedsuccessfully');
                  window.location.href = 'http://127.0.0.1:5500/index.html';
                  </script>";  
        }
        else{ 
            $Errorwhileinserting="Phone data not inserted";
            echo "<script type='text/javascript'>alert('$Errorwhileinserting');
                  window.location.href = 'http://127.0.0.1:5500/phonespecsinsert/phonespecs.html';
                  </script>"; 
        }    
    }
}

/**We initialize an empty array called $phonesArray before entering the loop.
Inside the loop, each fetched row ($phonesavailableintable) is appended to the $phonesArray using the [] syntax, effectively adding each row as an element of the array.
After the loop completes, the entire array containing all the fetched rows is encoded as JSON using json_encode(), and then it is echoed out to be the response*/

?>