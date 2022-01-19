<?php 
if($p == 'trangchitiet') {
$TieuDeKD = $_GET['TieuDeKD'];
if($idTT<=0) {
        $idPa = $ql_pa->LayID($TieuDeKD); 
        $content = $ql_pa->Pages($idPa);
        $row = mysql_fetch_assoc($content);

}
else{
    $content = $qly_tin->TinTuc($idTT);
    $row = mysql_fetch_assoc($content);
}
?>


<meta property="og:url"  content="<?php echo $actual_link; ?>" />
<meta property="og:type"  content="article" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $des; ?>" />
<meta property="og:image"  content="<?php echo $row['UrlHinh']; ?>" />
<?php } ?>