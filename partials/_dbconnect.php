<?php

//users login database connection
$server="localhost";
// This line creates a variable called `$server` and sets its value to "localhost". This usually means that the database server is running on the same machine as the PHP script.
$username="root";//It represents the username used to connect to the database.
$password="";// This line initializes a variable called `$password` and sets it to an empty string. In this context, it usually means that no password is required to connect to the database. However, in a real-world scenario, you should never leave your password empty for security reasons.
$database="phonerecommendapp";
//This line assigns the name of the database you want to connect to the variable $database. 
//In this case, it's set to "users", which is the name of the database you want to access.
$conn=mysqli_connect($server,$username,$password,$database);
//This line establishes a connection to the MySQL database using the `mysqli_connect()` function. 
//It takes four parameters: the server name, the username, the password, and the name of the database. 
//It returns a connection object if successful, which is stored in the variable `$userconn`.
if(!$conn){
//     echo "succcess";
// }
// else{
    die("Error". mysqli_connect_error());
}
/**
 *This block of code checks if the connection was successful. 
 *If $userconn evaluates to true (meaning the connection was successful), it echoes "success".
 * Otherwise, it terminates the script and outputs an error message using mysqli_connect_error().
 *The die() function in PHP is used to terminate the execution of a script immediately
 * and display a message to the user. It's often used to handle critical errors or 
 * * situations where the script cannot continue execution.
 */

//phone info database connection
// $server="localhost";
// $username="root";
// $password="";
// $database="phonerecommendapp";

// $phoneinfoconn=mysqli_connect($server,$username,$password,$database);
// if(!$phoneinfoconn){
//     die("Error".mysqli_connect_error());
// }
?>