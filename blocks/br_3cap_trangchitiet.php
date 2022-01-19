<?php 
	require_once "lib/class_pages.php";
	$idTT = 0; $idPa = 0;
	if(!isset($qly_pa))$qly_pa = new qly_pa;
	$TieuDeKD = $_GET['TieuDeKD'];
	$idTT = $qly_tin->LayID($TieuDeKD);
	if($idTT<=0) {
		$idPa = $qly_pa->LayID($TieuDeKD); 
		$content = $qly_pa->Pages($idPa);
		$row = mysql_fetch_assoc($content);

	}
	else{
		$content = $qly_tin->TinTuc($idTT);
		$row = mysql_fetch_assoc($content);
		$TenLoaiOng = $qly_loai->LayTieuDe($row['idCL']);
		$TenLoaiOngKD = $qly_loai->LayTieuDeKD($row['idCL']);
		$TenLoaiCha = $qly_loai->LayTieuDe($row['idLoai']);
		$TenLoaiChaKD = $qly_loai->LayTieuDeKD($row['idLoai']);
		
		$TenLoaiCon = $qly_loai->LayTieuDe($row['idCon']);
		$TenLoaiConKD = $qly_loai->LayTieuDeKD($row['idCon']);
		
		$idOng = $row['idCL'];
		$idCha = $row['idLoai'];
		$idCon = $row['idCon'];
	}	

function vn_str_filter ($str){

       $unicode = array(

           'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

           'd'=>'đ',

           'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

           'i'=>'í|ì|ỉ|ĩ|ị',

           'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

           'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

           'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

           'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

           'D'=>'Đ',

           'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

           'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

           'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

           'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

           'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
           '-' => ' ',

       );

      foreach($unicode as $nonUnicode=>$uni){

           $str = preg_replace("/($uni)/i", $nonUnicode, $str);

      }

       return $str;

}	
function sw_get_current_weekday($weekday) {
    
    $date = strtotime($weekday);
    $weekday = strtolower($weekday);
    $dw = date( "w", $date);
 	
    switch($dw) {
        case 1:
            $weekday = 'Thứ hai';
            break;
        case 2:
            $weekday = 'Thứ ba';
            break;
        case 3:
            $weekday = 'Thứ tư';
            break;
        case 4:
            $weekday = 'Thứ năm';
            break;
        case 5:
            $weekday = 'Thứ sáu';
            break;
        case 6:
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    
    return $weekday.', '.date('d/m/Y H:i',$date);
}
?>
<div class="breadbrum-danh-muc">
	<ul class="breadcrumb breadcrum-nk">
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href="." itemprop="url" class="home-br">
					<span itemprop="title">Trang chủ</span></a>
	</li>
	<?php if($idTT > 0){ ?>

		<?php if($idOng>0){ ?>

			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo $TenLoaiOngKD; ?>/" itemprop="url">
					<span itemprop="title"><?php echo $TenLoaiOng; ?></span></a> 
			</li>
		<?php } ?>
		<?php if($idCha > 0){ ?>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a  href="<?php echo $TenLoaiChaKD; ?>/" itemprop="url">
					<span itemprop="title"><?php echo $TenLoaiCha; ?></span></a> 
			</li>
		<?php } ?>
		<?php if($idCon > 0){ ?>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo $TenLoaiConKD; ?>/" itemprop="url">
					<span itemprop="title"><?php echo $TenLoaiCon; ?></span></a>
			</li>
		<?php } ?>
		
	<?php } ?>
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href="<?=$actual_link;?>" itemprop="url" class="home-br">
					<span itemprop="title"><?=$row['TieuDe']?></span></a>
	</li>
	<?php 
		if($TieuDeKD == 'lien-he-phong-kham-da-khoa-hong-phong'){ ?>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="#" itemprop="url">
					<span>Liên hệ tại phòng khám y học cổ truyền</span></a>
			</li>
		<?php } ?>
</div>
