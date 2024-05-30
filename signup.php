<?php
header("Access-Control-Allow-Origin:http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include "partials/_dbconnect.php";
$showAlert=false;
$showError=false;


//The above 2 variables are just used to show Alert or Error when it becomes true default is false 
if ($_SERVER["REQUEST_METHOD"]=="POST"){//This line checks if the HTTP request method used to access the current script is POST. In web development, POST is commonly used when submitting forms.
   // This condition ensures that the code block inside is executed only when the form is submitted via POST method.
  //This line includes the contents of another file named "_dbconnect.php" into the current script. This file likely contains the code to establish a connection to the database.
   $userdetail=$_POST["username"];
   

   $password=$_POST["password"];
   $cpassword=$_POST["cpassword"];                                                                                                                                                                                                                          
   /**
    * These lines retrieve the values submitted through a form using the POST method.
    * The values are stored in variables $uerdetail, $password, and $cpassword, respectively. 
    *These variables likely correspond to the username, password, and confirm password fields in a form.
    */
   $existSql="Select * from users WHERE username ='$userdetail'";
   $result = mysqli_query($conn,$existSql);
   $numExistRows = mysqli_num_rows($result);
   if($numExistRows>0){
      $usernameexist="Username Already Exists";
      echo "<script type='text/javascript'>alert('$usernameexist');
      window.location.href = 'http://127.0.0.1:5500/loginsystem/signup.html';
      </script>"; 
   }
   else{
   if ($password==$cpassword) {
      $hash=password_hash($password,PASSWORD_DEFAULT);   
      $sql="INSERT INTO `users` (`username`, `password`, `dt`) VALUES ( '$userdetail', '$hash', current_timestamp())";
      //This line constructs an SQL query to insert data into a table named "users". 
      //It inserts the submitted username, password, and the current timestamp into the respective columns of the table.
      $result=mysqli_query($conn,$sql);
      //The mysqli_query() function executes/performs the given query on the database.
      //mysqli_query($con, query)
      // Takes mainly 2 important parameter 
      //con(Mandatory) This is an object representing a connection to MySQL Server.
      //query(Mandatory) This is a string value representing the query to be executed.
      if($result){
         $showAlert=true;//If the SQL query is executed successfully (i.e., `$result` is true), the variable `$showAlert` is set to `true`, indicating that an alert message should be displayed to the user.
      }
   }
   else{
      $showError=true;//If the SQL query fails for any reason, the variable `$showError` is set to `true`, indicating that an error message should be displayed to the user.
   } 
}  
}
/**
 * The include and require statements in PHP serve a similar purpose, 
 * which is to include the contents of another file into the current script.
 *However, there are some differences between them:
*1.Behavior on Failure:
*include: If the file specified in the include statement cannot be found or there's an error 
*during inclusion, PHP generates a warning but continues executing the script.
*require: If the file specified in the require statement cannot be
 *found or there's an error during inclusion, PHP generates a fatal error and
  *halts script execution immediately.
 */
?>
 <?php
   if ($showAlert) {
      $message = "Success! Your account is created and you can login";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href = 'http://127.0.0.1:5500/index.html';
      </script>"; //We can dynamically generate javascript code like this in PHP
      
   }
   if($showError){
      $message = "Error! Password Mismatched";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href = 'http://127.0.0.1:5500/loginsystem/signup.html';
      </script>"; //...
   
   }


   ?>

