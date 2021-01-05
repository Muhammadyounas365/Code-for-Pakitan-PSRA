<?php
require_once 'db_connect.php';	
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAA_wuywNY:APA91bGpM3iSqC91NYMRjcadTKcUIQ0ABngABtRZ3gfYcrm3N1nNN3K9cJYb9oeW7IGhto_qzUdJHI7-vv_WnrcjSn6q5hOBJT0yP42iPmFRYYE9R1kBMOf0hSeUyky0h_d6mM9fMS4a' );
$ids = array();
$user_id = $_POST['user_id'];  
//  get by pendaftaran
$sql_query = "SELECT token_key FROM users where user_id= $user_id;";  
$result = mysqli_query($con,$sql_query);
if (mysqli_num_rows($result) > 0) {
    
		while ($row = mysqli_fetch_array($result)) {
			if($row["token_key"]!=NULL){
			    $token = $row["token_key"];
			    array_push($ids, $token);
			}
		}
	
}
$registrationIds = $ids;
// prep the bundle
$msg = array
(
    'status' => 2,
	'title' 	=> 'New Question Publish!',
	'message'		=> 'Tap to Rate the Question'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
//echo $result;
?>