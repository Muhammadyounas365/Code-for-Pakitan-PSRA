
<?php  
 $db_name = "psra";  
 $mysql_user = "root";  
 $mysql_pass = "";  
 $server_name = "localhost";  
 $con = mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name); 
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
else{
	//echo"connection successfull";
} 
 ?> 
 