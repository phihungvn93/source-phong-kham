<?php
	require_once "lib/class_tintuc.php";
    if(isset($qly_tin) == false) $qly_tin = new qly_tin;
    require_once "lib/class_loai.php";
    if(isset($qly_loai)==false) $qly_loai = new qly_loai;
    require_once "lib/class_pages.php";
    if(isset($ql_pa)==false) $ql_pa = new qly_pa;
	switch ($p)
    {
		case "trangchitiet":
            $TieuDeKD = $_GET['TieuDeKD'];
            $TieuDeKD = $ql_pa->XoaDinhDang ($TieuDeKD);
            $idPa = $ql_pa->LayID($TieuDeKD);
            if ( $idPa > 0){
                $title = $ql_pa->LayTitle($idPa);
            }    
            else{
                $idTT = $qly_tin->LayID($TieuDeKD);
                $title = $qly_tin->LayTitle($idTT);                
            }
            break;

        case "thietbi":
            if ($pageNum < 2)
                $title = "Thiết bị phòng khám hiện đại";
            else
                $title = "Thiết bị phòng khám hiện đại ".$pageNum;
            break;

        case "dangky":
            $title = "Đăng ký khám bệnh trực tuyến.";
            break;

        case "cauhoi":
            if ($pageNum < 2)
                $title = "Hỏi đáp bệnh án nhanh chóng nhất";
            else
                $title = "Hỏi đáp bệnh án nhanh chóng nhất ".$pageNum;
            break;

		case "trangloai":
            $TieuDeKD = $_GET['TieuDeKD'];
            $TieuDeKD = $qly_loai->XoaDinhDang ($TieuDeKD);
            $idLoai = $qly_loai->LayID($TieuDeKD);
			$title = $qly_loai->LayTitle($idLoai);
            break;

    }
    if ($title != "")
        echo $title;
    else
        echo "Phòng khám đa khoa 555";
?>