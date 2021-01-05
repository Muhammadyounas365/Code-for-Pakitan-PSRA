<?php
 $response = array();
 
 if (isset($_POST['user_id'])){
	$user_id =  $_POST['user_id']; 
	require_once 'db_connect.php';	
	$user_login = "SELECT * FROM users WHERE user_id ='".$user_id."'";
	$result = mysqli_query($con,$user_login);
	if(mysqli_num_rows($result)>0)  
	{  
		$row = mysqli_fetch_assoc($result);    
		   
		// echo "Login Success..Welcome ".$name;  
		if($row["user_status"]==1){
			$response["success"] = true;
			$response["user_id"] = $row["user_id"];
			$response["role_id"] = $row["role_id"];
			$response["user_status"] = $row["user_status"];
			$response["user_title"] = $row["user_title"]; 
			$response["user_email"] = $row["user_email"];
			$response["user_name"] = $row["user_name"];
			$response["user_password"] = $row["user_password"];
			$response["gender"] = $row["gender"];
	    	$response["birth_date"] = $row["birth_date"];
			$response["cnic"] = $row["cnic"];
			$response["education"] = $row["education"];
			$response["designation"] = $row["designation"];
			$response["profile_picture"] = $row["profile_picture"];
			$response["contact_number"] = $row["contact_number"];
			$response["district_id"] = $row["district_id"];
			$response["tehsil_id"] = $row["tehsil_id"];
			$response["vc_id"] = $row["vc_id"];
			$response["nhc_id"] = $row["nhc_id"];
			$response["mohalla_id"] = $row["mohalla_id"];
			$response["message"] = "Welcome ".$row["user_title"];
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