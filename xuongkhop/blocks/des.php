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
                $des = $ql_pa->LayDes($idPa);
            }    
            else{
                $idTT = $qly_tin->LayID($TieuDeKD);
                $des = $qly_tin->LayDes($idTT);                
            }
            break;

        case "thietbi":
            if ($pageNum < 2)
                $des = "Với thiết bị hiện đại phục vụ quá trình khám chữa bệnh giúp tăng hiệu quả và thời gian điều trị cho bệnh nhân.";
            else
                $des = "Với thiết bị hiện đại phục vụ quá trình khám chữa bệnh giúp tăng hiệu quả và thời gian điều trị cho bệnh nhân ".$pageNum;
            break;

        case "dangky":
            $des = "Đăng ký khám bệnh trực tuyến để được ưu tiên khám chữa bệnh không cần phải đơi. Hotline (08) 39 233 666";
            break;

        case "cauhoi":
            if ($pageNum < 2)
                $des = "Bạn có thắc mắc khó nói về bệnh án của mình. Cần bác sĩ tư vấn hãy đến với chuyên mục hỏi đáp.";
            else
                $des = "Bạn có thắc mắc khó nói về bệnh án của mình. Cần bác sĩ tư vấn hãy đến với chuyên mục hỏi đáp ".$pageNum;
            break;

		case "trangloai":
            $TieuDeKD = $_GET['TieuDeKD'];
            $TieuDeKD = $qly_loai->XoaDinhDang ($TieuDeKD);
            $idLoai = $qly_loai->LayID($TieuDeKD);
			$des = $qly_loai->LayDes($idLoai);
            break;

    }
    if ($des != "")
        echo $des;
    else
        echo "phòng khám đông y uy tín tại tphcm , Tư vấn khám chữa bệnh bằng đông y cổ truyền.";
?>