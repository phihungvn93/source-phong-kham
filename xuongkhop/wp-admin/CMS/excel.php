<?php
//ob_start();
session_start();
require_once ('phpexcel/Classes/PHPExcel.php');
require_once "checklogin.php";
if($_SESSION['quyen']['col_xuat']==0) header("location:main.php?p=dh_xem"); 
//require_once "class_quantri.php";
//$qt = new quantri;
require_once "dbcon.php";
$NgayGioDenKham = $_GET['NgayGioDenKham'];
$NgayGioDenKham = date("Y-m-d",strtotime($NgayGioDenKham));
$tungay = $_GET['tungay'];
$tungay = date("Y-m-d",strtotime($tungay));
$denngay = $_GET['denngay'];
$denngay = date("Y-m-d",strtotime($denngay));
$GioiTinh = $_GET['GioiTinh'];
$loaingay = $_GET['loaingay'];
$mydate = explode('-', $NgayGioDenKham);
$objPHPExcel = new PHPExcel();
 
		if ($NgayGioDenKham != "" && $NgayGioDenKham != "1970-01-01"){
			$ngay_title = "- NGÀY {$mydate[2]} THÁNG {$mydate[1]}</strong><strong> NĂM {$mydate[0]}";
		} else {
			$ngay_title = "- TỪ NGÀY ".date('d-m-Y',strtotime($tungay))." - ĐẾN NGÀY - ".date('d-m-Y',strtotime($denngay));
		}
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('30');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth('20');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth('20');
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth('20');
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth('10');
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth('20');
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth('20');
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth('30');
	$objPHPExcel->setActiveSheetIndex(0)
				->mergeCells('A1:Q1')
				->setCellValue('A1',"BẢNG DỮ LIỆU KHÁCH HÀNG {$ngay_title}")
				->setCellValue('A2',"STT")
				->setCellValue('B2',"MÃ SỐ ĐẶT HẸN")
				->setCellValue('C2',"")
				->setCellValue('D2',"HỌ VÀ TÊN")
				->setCellValue('E2',"GIỚI TÍNH")
				->setCellValue('F2',"TUỔI")
				->setCellValue('G2',"SỐ ĐIỆN THOẠI")
				->setCellValue('H2',"LOẠI BỆNH TƯ VẤN")
				->setCellValue('I2',"NGÀY ĐẶT HẸN")
				->setCellValue('J2',"THỜI GIAN")
				->setCellValue('K2',"Chat/DT")
				->setCellValue('L2',"BÁC SỸ")
				->setCellValue('M2',"ĐẾN")
				->setCellValue('N2',"Thành phố")
				->setCellValue('O2',"Quận")
				->setCellValue('P2',"Ghi chú");

if ($NgayGioDenKham != "" && $NgayGioDenKham != "1970-01-01"){
	  $Where.= " and (Date(`NgayGioDenKham`) = '$NgayGioDenKham') and TinhTrang=0  " ;		
}
if ($GioiTinh != ""){
	  $Where.= " and (GioiTinh = $GioiTinh OR  $GioiTinh = -1 )" ;		
}
if($tungay != "" && $denngay !=""){
	if($loaingay == -1)	$Where.= " and ((Date(NgayGioDenKham) between '$tungay' and '$denngay') OR (Date(NgayGioDatHen) between '$tungay' and '$denngay') )";
	else if($loaingay == 0) $Where.= " and (Date(NgayGioDatHen) between '$tungay' and '$denngay')";
	else if($loaingay == 1) $Where.= " and (Date(NgayGioDenKham) between '$tungay' and '$denngay')";
}


function ListDH($id, $pageNum, $pageSize, $Where ){
			$startRow = ($pageNum-1)*$pageSize;
				$sql="SELECT * 
				FROM  dathen ,bstv
				WHERE dathen.IDBacSiTuVan = bstv.ID_BacSi and (IDBacSiTuVan =$id Or $id=-1) and TinhTrang = 0 $Where 
				ORDER BY ID_DatHen DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				
			return $kq;
		}

$dskh = ListDH(-1,1,20000, $Where);  
$i=2;  
while ($row_loaisp = mysql_fetch_assoc($dskh) ) {  $i++;
if($_SESSION['quyen']['col_phone'] == 0)	$row_loaisp['SoDT'] = '';
switch($row_loaisp['GioiTinh']){
	case 0:$GioiTinh_="Nữ";
	break;
	case 1:$GioiTinh_="Nam";
	break;
	case 2:$GioiTinh_="Gay";
	break;
}

$NgayGioDenKham_= date("d-m-Y H:i",strtotime($row_loaisp['NgayGioDenKham']));
$NgayGioDatHen_= date("d-m-Y H:i",strtotime($row_loaisp['NgayGioDatHen']));

if(date("d-m-Y",strtotime($row_loaisp['NgayGioDenKham']))=="01-01-1970"){
	$NgayGioDenKham_ = "Không ngày hẹn";
}
if(date("d-m-Y",strtotime($row_loaisp['NgayGioDatHen']))=="01-01-1970"){
	$NgayGioDatHen_ = "Không ngày hẹn";
}
switch($row_loaisp['Nguon']){
	case 'chat':$Nguon_="Chat";
	break;
	case 'dienthoai':$Nguon_="Đ.thoại";
	break;
	case 'dt2':$Nguon_="ĐT2";
	break;
	case 'mang':$Nguon_="Mạng";
	break;
	case 'khac':$Nguon_="Khác";
	break;
}

$thanhpho = mysql_query("select title from provinces where id = {$row_loaisp['idTP']}");
$row_tp = mysql_fetch_row($thanhpho);
$TenTP = $row_tp[0];

$quan = mysql_query("select title from wards where id = {$row_loaisp['idQuan']}");
$row_q = mysql_fetch_row($quan);
$TenQ = $row_q[0];

if($row_loaisp['BSKham']!='') $BSKham = $row_loaisp['BSKham'];
else{
	$sql = "select TenBS from bstv where ID_BacSi = {$row_loaisp['ID_BacSiDT']}";
	$kq = mysql_query($sql);
	$row_bsdt = mysql_fetch_assoc($kq);
	$BSKham = $row_bsdt['TenBS'];
}

if($row_loaisp['TenBenhNhan'] == '' || $row_loaisp['TenBenhNhan'] == null){
	$TenBenhNhan = 'NoName';
}
else $TenBenhNhan = $row_loaisp['TenBenhNhan'];
$TenBenhNhan = str_replace("=","",$TenBenhNhan);
//echo ($TenBenhNhan)."<br/>";
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i,$i-2)
				->setCellValue('B'.$i,$row_loaisp['KyTuBacSi']." ".$row_loaisp['MaDatHen']." ".$row_loaisp['DaDen'])
				->setCellValue('C'.$i,$row_loaisp['BenhThucTe'])
				->setCellValue('D'.$i,$TenBenhNhan)
				->setCellValue('E'.$i,$GioiTinh_)
				->setCellValue('F'.$i,$row_loaisp['Tuoi'])
				->setCellValue('G'.$i," ".$row_loaisp['SoDT'])
				->setCellValue('H'.$i,$row_loaisp['LoaiBenh'])
				->setCellValue('I'.$i,$NgayGioDatHen_)
				->setCellValue('J'.$i,$NgayGioDenKham_)
				->setCellValue('K'.$i,$Nguon_)
				->setCellValue('L'.$i,$BSKham)
				->setCellValue('M'.$i,$row_loaisp['DaDen'])
				->setCellValue('N'.$i,$TenTP)
				->setCellValue('O'.$i,$TenQ)
				->setCellValue('P'.$i,$row_loaisp['GhiChu']);

}

		$objPHPExcel->setActiveSheetIndex(0);
		
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="report_congno.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
?>