<?php
// cek form
$response = array();
if (isset($_POST['user_id']) && isset($_POST['token_key'])) {
	$token_key = $_POST['token_key'];
	$user_id = $_POST['user_id'];

    // include db connect
    require_once __DIR__ . '/db_connect.php';
	
	$query = "UPDATE `users` SET `token_key`='".$token_key."' WHERE `user_id`=$user_id;";
    // insert ke db
    $result = mysqli_query($con,$query);
	
    // cek data udah masuk belum
    if ($result) {
        // kalo sukses
        $response["success"] = true;
        $response["message"] = "Your Token Key updated";

        // echoing JSON response
        echo json_encode($response);
    } 
    else{
        // kalo sukses
        $response["success"] = false;
        $response["message"] = "Token not updated";

        // echoing JSON response
        echo json_encode($response);
    }
} else {
    $response["success"] = false;
    $response["message"] = "Something went wrong";

    // echoing JSON response
    echo json_encode($response);
}
?>
