<?php
require_once "../checklogin.php";
require_once "../class_db.php";
$db = new db;
if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
	############ Edit settings ##############
	$UploadDirectory	= '../file/'.$_POST['n']."/"; //specify upload directory ends with / (slash)
	##########################################
	if(file_exists($UploadDirectory)==false) mkdir($UploadDirectory);
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	//Is file size is less than allowed size.
	if ($_FILES["FileInput"]["size"] > 5242880) {
		die("File size is too big!");
	}
	
	//allowed file type Server side check
	switch(strtolower($_FILES['FileInput']['type']))
		{
			//allowed file types
			case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'image/jpg':
			/*case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':*/
			case 'application/msword':
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
				break;
			default:
				die('Không đúng dạng file !! Phải là file word nha'); //output error
	}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName 		= $_POST['n'].'_'.$Random_Number.$File_Ext; //new file name
	$mang = explode("_",$_POST['n']);
	$id_dathen = $mang[1];
	$sql = "select id from file where ID_DatHen = {$id_dathen}";
	$kq = mysql_query($sql);
	if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ) && (mysql_num_rows($kq)<=7))
	   {
		$UploadDirectory_ = str_replace("../","",$UploadDirectory);
		$NewFileName = $UploadDirectory_.$NewFileName;
		
			$sql = "insert into file values(null,{$id_dathen},'{$NewFileName}')";
			mysql_query($sql);
		die('Success! File Uploaded.');
	}else{
		die('Chỉ được upload tối đa 8 file !!');
	}
	
}
else
{
	die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}