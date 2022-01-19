<?php
$dir ="../cache/";
$arr = scandir($dir);
$dem=0;
foreach($arr as $filename){
    if ($filename=="." || $filename=="..") continue;
    unlink($dir.$filename);   $dem++;
}
echo "Đã xoá $dem file cache";

?>