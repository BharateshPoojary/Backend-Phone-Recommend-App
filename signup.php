<?php
$showAlert=false;
$showError=false;
//The above 2 variables are just used to show Alert or Error when it becomes true default is false 
if ($_SERVER["REQUEST_METHOD"]=="POST"){//This line checks if the HTTP request method used to access the current script is POST. In web development, POST is commonly used when submitting forms.
   // This condition ensures that the code block inside is executed only when the form is submitted via POST method.
   include "partials/_dbconnect.php";//This line includes the contents of another file named "_dbconnect.php" into the current script. This file likely contains the code to establish a connection to the database.
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
      echo "<script type='text/javascript'>alert('$usernameexist');</script>"; 
   }
   else{
   if ($password==$cpassword) {
      $hash=password_hash($password);   
      $sql="INSERT INTO `users` (`username`, `password`, `dt`) VALUES ( '$userdetail', '$password', current_timestamp())";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <style>
        .formcontainer{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-right:2%;
         }
       
         input{
            height:30px;
            width: 350px;
            border-color:rgb(178, 178, 197);
            border-radius:5px;
            font-size:17px;
         }
         input:focus{
            border-color:black;
         }
         label{
            font-size: 1.5rem;
            color: #1a202c;
         }
         span{
           font-family:Calibri;
         }
         .Signupform{
           display:flex;
           justify-content:center;
           align-items:center;
           font-family:Calibri;
           font-size:30px;
           font-weight:bold;
           color:rgb(44, 44, 44);
           margin-right:10px;
           margin-bottom:20px;
         }
         .signupbutton{
            border-radius:5px;
            margin-top:5px;
            height:35px;
            width:360px;
            background-color:black;
            color:white;
         }
         .signupbutton:hover{
            background-color:rgb(79, 79, 79);
         }
         .maincontainer{
            margin-top:7%;
         }
         .loginredirect{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:10px;
            color:rgb(79, 79, 79);
            font-size:1.5rem;
            font-family:Calibri;
         }
         span{
            color:rgb(79, 79, 79);
         }
         #login{
            color:black;
            font-weight:bold;
            text-decoration:none;
         }
         #login:hover{
            color:rgb(79, 79, 79);
         }
    </style>
</head>
<body>
   <?php
   if ($showAlert) {
      $message = "Success! Your account is created and you can login";
      echo "<script type='text/javascript'>alert('$message');</script>"; //We can dynamically generate javascript code like this in PHP
   }
   if($showError){
      $message = "Error! Password Mismatched";
      echo "<script type='text/javascript'>alert('$message');</script>"; //...
   
   }
   
   ?>
    <div class="maincontainer">
    <div class="Signupform">Signup to our website</div>
    <div class="formcontainer">
     <form action="/MYPROJECTLOGINPAGE/signup.php" method="post" ><!--The action attribute in an HTML <form> element specifies the URL where the form data should be submitted when the form is submitted by the user. It defines the endpoint where the browser sends the data for processing,
         typically a server-side script or a web application here post method is used in order to send login credentials to the server so that it can be stored in database  -->
        <label for="username"><span>User Name</span></label><br>
        <input type="text" id="username" maxlength="11" name="username" required><br>
        <label for="password"><span>Password</span></label><br>
        <input type="password" id="password"  maxlength="11" name="password" required><br>
        <label for="cpassword"><span>Confirm Password</span></label><br>
        <input type="password" id="cpassword"  maxlength="11" name="cpassword" required><br>
        <span>Make sure to type the same password</span><br>
        <button class="signupbutton">Sign Up</button>
        <div class="loginredirect">Already a member? <a href="/MYPROJECTLOGINPAGE/login.php" id="login">Log In</a></div>
    </form>
    </div>
    </div>
</body>
</html>
