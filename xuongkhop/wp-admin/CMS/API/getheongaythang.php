<?php 
include("classApi.php");
$db = new db();
if (isset($_POST['json'])){
$json = json_decode($_POST['json']);
$api = new api($json->user,$json->password,$json->datestart);
echo $api->getTheGioiTheoNgay($json->datestart,$json->dateend);
}
else{echo "123567";}

?>