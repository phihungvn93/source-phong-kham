<?php
    require_once "lib/class_tintuc.php";
    if(isset($qly_tin)==false) $qly_tin = new qly_tin;
    require_once "lib/class_loai.php";
    if(isset($qly_loai)==false) $qly_loai = new qly_loai;
    require_once "lib/class_pages.php";
    if(isset($ql_pa)==false) $ql_pa = new qly_pa;
?>
<?php
	switch ($p)
    {
		case "trangchitiet":
            $TieuDeKD = $_GET['TieuDeKD'];
            $TieuDeKD = $ql_pa->XoaDinhDang ($TieuDeKD);
            $idPa = $ql_pa->LayID($TieuDeKD);
            if ( $idPa > 0){
                $keywords = $ql_pa->LayKeyword($idPa);
            }
            else{
                $idTT = $qly_tin->LayID($TieuDeKD);
                $keywords = $qly_tin->LayKeyword($idTT);
            }
            break;

        case "thietbi":
            $keywords = "thiet bi phong kham, thiết bị phòng khám";
            break;

        case "dangky":
            $keywords = "dang ky kham benh truc tuyen, đăng ký khám bệnh trực tuyến";
            break;

        case "cauhoi":
            $keywords = "hoi dap benh an, hỏi đáp bệnh án";
            break;

		case "trangloai":
            $TieuDeKD = $_GET['TieuDeKD'];
            $TieuDeKD = $qly_loai->XoaDinhDang ($TieuDeKD);
            $idLoai = $qly_loai->LayID($TieuDeKD);
			$keywords = $qly_loai->LayKeyword($idLoai);
            break;

    }
    if ($keywords != "")
        echo $keywords;
    else
        echo "phòng khám nam khoa,phong kham nam khoa tphcm,clinic nam khoa, phòng khám nam khoa";
?>