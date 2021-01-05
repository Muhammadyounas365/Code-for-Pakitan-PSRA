<?php
 $response = array();
 
 if (isset($_GET['user_id'])){
	$user_id =  $_GET['user_id']; 
	require_once 'db_connect.php';	
	$user_login = "SELECT * FROM users WHERE userId ='".$user_id."'";
	$result = mysqli_query($con,$user_login);
	var_dump($result);exit;
	if(mysqli_num_rows($result)>0)  
	{  
		$row = mysqli_fetch_assoc($result);    
		   
		// echo "Login Success..Welcome ".$name;  
		if($row["userStatus"]==1){
			$response["success"] = true;
			$response["user_id"] = $row["userId"];
			
			$response["userTitle"] = $row["userTitle"]; 
			
			echo json_encode($response);
		}
		else{
			$response["success"] = false;
			$response["message"] = "Your registration is not approve yet!";
			echo json_encode($response);
		}
	}  
	else  
	{   
         $response["success"] = false;
		$response["message"] = "Email or Password invalid";
		echo json_encode($response); 
	
	}   	
 }
 else{
	 $response["success"] = false;
    $response["message"] = "Server side error";

    // echoing JSON response
    echo json_encode($response);
}
?>