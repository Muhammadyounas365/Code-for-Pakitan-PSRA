<?php

$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';
mysqli_query($con,'SET CHARACTER SET utf8');
$sql_query = "SELECT `id`, `rate_value`, `rate_title` FROM `rating`;";  
$result = mysqli_query($con,$sql_query);

if (mysqli_num_rows($result) > 0) {
		
	$response["success"] = true;
	
	$response["rating_list"] = array();
    
	while ($row = mysqli_fetch_array($result)) {
		$rate = array();
		$rate["id"] = $row["id"];
		$rate["rate_value"] = $row["rate_value"];
		$rate["rate_title"] = $row["rate_title"];
		array_push($response["rating_list"], $rate);
	}
	// echo JSON response
	echo json_encode($response);
}
else
{			
	$response["success"] = false;
	$response["message"] = "No Ratings available yet.";

	echo json_encode($response);
}
?>
