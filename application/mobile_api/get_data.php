<?php

$request=array();

$occ = false;
$edu = false;
$area = false;
require_once('db_connect.php');
$sql_query = "SELECT `id`, `occupation_title` FROM `occupation`;";  
$result= mysqli_query($con,$sql_query);
//------------------------------------
if (mysqli_num_rows($result) > 0 ){
	$response["occ_list"] = array();
	while ($row = mysqli_fetch_array($result)) {
		$rate = array();
		$rate["id"] = $row["id"];
		$rate["occupation_title"] = $row["occupation_title"];
		array_push($response["occ_list"], $rate);
	}
	$occ=true;
}
$sql_query = "SELECT `id`, `qualification_title` FROM `qualification`;";  
$result = mysqli_query($con,$sql_query);
if (mysqli_num_rows($result) > 0) {
	$response["qua_list"] = array();
	while ($row = mysqli_fetch_array($result)) {
		$rate = array();
		$rate["id"] = $row["id"];
		$rate["qualification_title"] = $row["qualification_title"];
		array_push($response["qua_list"], $rate);
	}
	$edu = true;
}
$sql_query = "SELECT *FROM districts ;";  
$result = mysqli_query($con,$sql_query);

if (mysqli_num_rows($result) > 0) {	 
    $area = true;
	$response["districts"] = array();
	while ($row = mysqli_fetch_array($result)) {
		$districts = array();
		$districts["id"] = $row["id"];
		$districts["name"] = $row["districts_title"];	
		array_push($response["districts"], $districts);
	}
	
    $sql_query = "SELECT *FROM tehsils;";  
    $result = mysqli_query($con,$sql_query);
	$response["istehsil"] = false;
	if (mysqli_num_rows($result) > 0) {
		$response["istehsil"] = true;
		$response["tehsils"] = array();
		while ($row = mysqli_fetch_array($result)) {
			$tehsils = array();
			$tehsils["id"] = $row["id"];
			$tehsils["name"] = $row["tehsils_title"];
			$tehsils["district_id"] = $row["district_id"];
			array_push($response["tehsils"], $tehsils);
		}
		$sql_query = "SELECT *FROM vcs;";  
		$result = mysqli_query($con,$sql_query);
		$response["isVcs"] = false;
		if (mysqli_num_rows($result) > 0) {
			$response["isVcs"] = true;
			$response["vcs"] = array();
			while ($row = mysqli_fetch_array($result)) {
				$vcs = array();
				$vcs["id"] = $row["id"];
				$vcs["name"] = $row["vcs_title"];
				$vcs["tehsil_id"] = $row["tehsil_id"];
				array_push($response["vcs"], $vcs);
			}
			$sql_query = "SELECT *FROM nhcs;";  
			$result = mysqli_query($con,$sql_query);
			$response["isNhc"] = false;
			if (mysqli_num_rows($result) > 0) {
			$response["isNhc"] = true;
			$response["nhcs"] = array();
				while ($row = mysqli_fetch_array($result)) {
					$nhcs = array();
					$nhcs["id"] = $row["id"];
					$nhcs["name"] = $row["nhcs_title"];
					$nhcs["vc_id"] = $row["vc_id"];
					array_push($response["nhcs"], $nhcs);
				}
				$sql_query = "SELECT *FROM mohallas;";  
				$result = mysqli_query($con,$sql_query);
				$response["isMohalla"] = false;
				if (mysqli_num_rows($result) > 0) {
					$response["isMohalla"] = true;
					$response["mohallas"] = array();
					while ($row = mysqli_fetch_array($result)) {
						$mohallas = array();
						$mohallas["id"] = $row["id"];
						$mohallas["nhcs_id"] = $row["nhcs_id"];
						$mohallas["name"] = $row["mohallas_title"];
						array_push($response["mohallas"], $mohallas);
					}
				}
			}
		}
	}

}
$response["occ"] = $occ;
$response["edu"] = $edu;
$response["area"] = $area;
echo json_encode($response);
//------------------------------------
 ?>