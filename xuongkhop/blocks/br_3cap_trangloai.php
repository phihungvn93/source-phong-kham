<?php 
	$TieuDeKD = $qly_tin->XoaDinhDang($_GET['TieuDeKD']);
	$idLoai = $qly_loai->LayID($TieuDeKD);
	settype($idLoai,"int");
	$pageSize=10;
	$pageNum = $_GET['pageNum']; settype($pageNum,"int");
	if($pageNum<=0) $pageNum = 1;
	if($idLoai > 0){
		//cap cuoi
		$TenLoai = $qly_loai->LayTieuDe($idLoai);
		$TenLoaiKD = $qly_loai->LayTieuDeKD($idLoai);
		$h1 = $TenLoai;
		$bread = "<a href='".$TenLoaiKD."-".$idLoai."/'>".$TenLoai."</a>";
		$tlkd = $TenLoaiKD."-".$idLoai;
		$TenLoaiCon = $TenLoai;
		$TenLoaiConKD = $TenLoaiKD;
		$idCon = $idLoai;
		// lay loai cha
		$idCha = $qly_loai->LayIDCha($idLoai);
		if($idCha!=0){
			$TenLoai = $qly_loai->LayTieuDe($idCha);
			$TenLoaiKD = $qly_loai->LayTieuDeKD($idCha);		
			$bread = "<a href='".$TenLoaiKD."-".$idCha."/'>".$TenLoai."</a> > ".$bread;
			$TenLoaiCha = $TenLoai;
			$TenLoaiChaKD = $TenLoaiKD;
			
			$idOng = $qly_loai->LayIDCha($idCha);
			if($idOng!=0){
			$TenLoai = $qly_loai->LayTieuDe($idOng);
			$TenLoaiKD = $qly_loai->LayTieuDeKD($idOng);
			$TenLoaiOng = $TenLoai;
			$TenLoaiOngKD = $TenLoaiKD;
			
			$bread = "<a href='".$TenLoaiKD."-".$idOng."/'>".$TenLoai."</a> > ".$bread;
			}
		}
		$tt = $qly_tin->ListTinLoai($idLoai, $totalRows, $pageNum, $pageSize);
	}else {
		$tt = $qly_tin->TimKiem($TieuDeKD, $totalRows, $pageNum, $pageSize);
	}
?>
<div class="breadbrum-danh-muc">
	<ul class="breadcrumb breadcrum-nk">
	<li>
		<a href="." itemprop="url" class="home-br">
					<span itemprop="title">Trang chủ</span></a>
	</li>
	<?php if($idLoai > 0) { ?>
		<?php if($idOng>0){ ?>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo $TenLoaiOngKD; ?>/" itemprop="url">
					<span itemprop="title"><?php echo $TenLoaiOng; ?></span></a>
		<?php } ?>
		<?php if($idCha>0){ ?>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo $TenLoaiChaKD; ?>/" itemprop="url">
					<span itemprop="title"><?php echo $TenLoaiCha; ?></span></a> 
			</li>
		<?php } ?>
		<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="<?php echo $TenLoaiConKD; ?>/" itemprop="url">
				<span itemprop="title"><?php echo $TenLoaiCon; ?></span></a>
		</li>
	<?php }else { ?>
		<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="#" itemprop="url">
				<span itemprop="title">Tìm Kiếm</span></a>
		</li>
		<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="#" itemprop="url">
				<span itemprop="title"><?php echo $_GET['TieuDeKD']; ?></span></a>	
		</li>
	<?php } ?>

</div>