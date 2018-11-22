<?php
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

  // Database Variables (edit with your own server information) 

  $host    = "localhost";
  $user    = "*****";
  $pass    = "*****";
  $db_name = "1431396_mondat"; 
 
  // Connect to Database
  $connection = mysqli_connect($host, $user, $pass, $db_name);  
  
  /*  
  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to server/database: " . mysqli_connect_error();
  }
  */


  //test if connection failed
  if(mysqli_connect_errno()){
    die("NOK...Failed to connect to server/database: "
      . mysqli_connect_error()
      . " (" . mysqli_connect_errno()
      . ")");
  }
  

?>
