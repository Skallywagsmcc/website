<?php
// include

include('adminconnect.php');

//// get value pass from form in portal file
//
//$username = $_POST['user'];
//$password = $_POST['pass'];
//
//// to prevent mysql injection
//
//$username = stripcslashes($username);
//$password = stripcslashes($password);
//$username = mysqli_real_escape_string($connect,$_POST['username']);
//$password = mysqli_real_escape_string($connect,$_POST['password']);
//
//// connect to the server and select database
//
//mysqli_connect("localhost", "root", "");
//mysqli_select_db("admin");
//
//// query the db for user_error
//
////this needs to be mysqli_query($connect,$sql)
//
////try this
//
//$sql = "select * from users where username = '$username' and password = '$password'";
//
//if(mysqli_num_rows($result) == 1)
//{
//
//}
//$result = mysqli_query($connect,$sql);
//if($result)
//
//    //these codes are not
//   $row =  mysqli_fetch_assoc($result);
//   echo $row['username'];
//}
//else
//{
//    die ("Failed to Query database");
//}
?>









<?php
// Create connection to DB


//put your details here
$host = "";
$username = "";
$password = "";
$db_name = "";

//this will check for connection
$connect = mysqli_connect($host,$username,$password,$db_name);
if($connect)
{
    echo "success";
}
else{
    echo "could not connect to server "
}
