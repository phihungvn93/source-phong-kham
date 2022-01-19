<?php 
	$TieuDeKD = $qly_tin->XoaDinhDang($_GET['TieuDeKD']);
	$idLoai = $_GET['idLoai'];
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
		$TenLoaiConKD = $TenLoaiKD."-".$idLoai;
		$idCon = $idLoai;
		// lay loai cha
		$idCha = $qly_loai->LayIDCha($idLoai);
		if($idCha!=0){
			$TenLoai = $qly_loai->LayTieuDe($idCha);
			$TenLoaiKD = $qly_loai->LayTieuDeKD($idCha);		
			$bread = "<a href='".$TenLoaiKD."-".$idCha."/'>".$TenLoai."</a> > ".$bread;
			$TenLoaiCha = $TenLoai;
			$TenLoaiChaKD = $TenLoaiKD."-".$idCha;
			
			$idOng = $qly_loai->LayIDCha($idCha);
			if($idOng!=0){
			$TenLoai = $qly_loai->LayTieuDe($idOng);
			$TenLoaiKD = $qly_loai->LayTieuDeKD($idOng);
			$TenLoaiOng = $TenLoai;
			$TenLoaiOngKD = $TenLoaiKD."-".$idOng;
			
			$bread = "<a href='".$TenLoaiKD."-".$idOng."/'>".$TenLoai."</a> > ".$bread;
			}
		}
		$tt = $qly_tin->ListTinLoai($idLoai, $totalRows, $pageNum, $pageSize);
	}else {
		$tt = $qly_tin->TimKiem($TieuDeKD, $totalRows, $pageNum, $pageSize);
	}
?>

<div class="breadcrum-nk">
	<a class="br-home" href="./"><img src="img/home-br.png"></a>
	<a class="breadcrum-2" href="./"><img src="img/nk-br.png"></a>
</div>