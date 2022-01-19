<?php
	include("classApi.php");
	$db = new db();
	$day = gmdate("m/d/Y",time()+7*3600);

	if (isset($_POST['json'])){
			$json = json_decode($_POST['json']);		
		$api = new api($json->user,$json->password,$json->datearrive);	
		$day = date("Y-m-d",strtotime($day));
		$api = new api("hieu","123456",$json->datearrive);
		$arr = $api->ListDH(-1,$day);
		$tc = $api->ListDH_DaDen($day);
		$daden = $api->ListDH_DaDen($day,1);
		$chuaden = $api->ListDH_DaDen($day,0);
		$hoancau = array("phongkham"=> "Thế giới","alias"=>"thegioi","tongcong"=>$tc,"daden"=>$daden,"chuaden" =>$chuaden,"list"=>$arr);
		//print_r($arr);
		echo $api->jsonRemoveUnicodeSequences($hoancau);
	}

else{
	echo "123";
}
?>