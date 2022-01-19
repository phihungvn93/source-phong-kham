<?php 
include("classApi.php");
$db = new db();
if (isset($_POST['json'])){
	
	$json = json_decode($_POST['json']);
	$api = new api($json->user,$json->password,$json->datearrive);
	echo $api->getTheGioi();	
}
else{
	echo "123567";
}
?>