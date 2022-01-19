<?php
  require_once "checklogin.php";
  require_once "class_quantri.php";
  $qt = new quantri;
	
  $pageSize = 50;
  $pageNum = 1;
  if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
  if ($pageNum<=0) $pageNum=1; settype($pageNum,"int");  
  $totalRows=0;
  $MaDatHen = $_GET['MaDatHen'];
  $SoDT = $_GET['SoDT'];
  $TenBenhNhan = $_GET['TenBenhNhan'];
  $NgayGioDenKham = $_GET['NgayGioDenKham'];
  $NgayGioDatHen = $_GET['NgayGioDatHen'];
  $ID_BacSi = $_GET['ID_BacSi'];
  $ID_BacSi2 = $_GET['ID_BacSi2'];
  $idTP2 = $_GET['idTP2']; settype($idTP2,"int");
  $idQuan2 = $_GET['idQuan2']; settype($idQuan2,"int");
  $tungay = $_GET['tungay'];
  $denngay = $_GET['denngay'];
  
  if ($NgayGioDenKham != ""){
	  $NgayGioDenKham = date("Y-m-d",strtotime($NgayGioDenKham));
	  $Where.= " And Date(`NgayGioDenKham`) = '$NgayGioDenKham' " ;		
  }
  if ($NgayGioDatHen != ""){
	  $NgayGioDatHen = date("Y-m-d",strtotime($NgayGioDatHen));
	  $Where.= " And Date(`NgayGioDatHen`) = '$NgayGioDatHen' " ;		
  }
  if ($ID_BacSi != ""){
	  $Where.= " And (IDBacSiTuVan = $ID_BacSi OR $ID_BacSi=-1) " ;		
  }
  if ($MaDatHen != ""){
	  $Where.= " And MaDatHen like '%$MaDatHen%' " ;		
  }
  if ($SoDT != ""){
	  $Where.= " And SoDT like '%$SoDT%' " ;		
  }
  if ($TenBenhNhan != ""){
	  $Where.= " And TenBenhNhan like '%$TenBenhNhan%' " ;		
  }
	if($tungay !='' && $denngay !=''){
		$tungay = date("Y-m-d",strtotime($tungay));
		$denngay = date("Y-m-d",strtotime($denngay));
		$Where.= " And ((Date(NgayGioDatHen) between '$tungay' and '$denngay') OR (Date(NgayGioDenKham) between '$tungay' and '$denngay')) and (ID_BacSi = $ID_BacSi2 OR $ID_BacSi2 = -1)";
	}
	if($idTP2>0){
		$Where.= " And (idTP = $idTP2 OR $idTP2 = -1) " ;		
	}
	if($idQuan2>0){
		 $Where.= " And (idQuan = $idQuan2 OR $idQuan2 = -1)" ;		
	}
?>
<?php
  if($_SESSION['tg_login_level']==0)
  {
  	$loaisp = $qt->ListDH($_SESSION["tg_login_id"],$totalRows, $pageNum,$pageSize, $Where);
	$totalRows_DaDen = $qt->ListDH_DaDen($_SESSION["tg_login_id"],1,$Where);
  }
  else
  {
	  $loaisp = $qt->ListDH(-1,$totalRows, $pageNum,$pageSize, $Where);
	  $totalRows_DaDen = $qt->ListDH_DaDen(-1,1,$Where);
  }
  
  $SoDatHen = $qt->LaySoDHMoiNhat($_SESSION['tg_login_id']);
  $_SESSION['SoDatHen'] = $SoDatHen+1;
  if($_SESSION['SoDatHen']<10) $_SESSION['SoDatHen']="00".$_SESSION['SoDatHen'];
  elseif($_SESSION['SoDatHen']>=10&&$_SESSION['SoDatHen']<100) $_SESSION['SoDatHen']="0".$_SESSION['SoDatHen'];  
?>
<script type="text/javascript">
  $(document).ready(function() {
    $(".anhien").click(function() {
		/*if(confirm('Bạn chắc không ?')){*/
			var bien = $(this).attr('AnHien');
			  var ma = $(this).attr('id');
			  $.get('anhien.php?x='+(new Date()).getTime(), bien, function(data) {
				var chuoi = "<img  src=images/ah_"+data+".png>";
				$("#"+ma).html(chuoi);
				location.reload();
			  });
			  return false;
		/*}      */
    });
	$("select[name='idTP']").change(function(){
		idTP = $(this).val();
		$.get("ajax/layquan.php",{idTP:idTP,x:(new Date()).getTime()},function(d){ 
			$("select[name='idQuan']").html(d);
		})
	})
	
	$("select[name='idTP2']").change(function(){
		idTP = $(this).val();
		$.get("ajax/layquan.php",{idTP:idTP,x:(new Date()).getTime()},function(d){ 
			$("select[name='idQuan2']").html(d);
		})
	})
	
  });
  function trichxuat(x){
	  var Ngay = document.getElementById('NgayGioDenKham').value;
	  var tungay = document.getElementById('tungay').value;
	  var denngay = document.getElementById('denngay').value;
	  var loaingay = document.getElementById('LoaiNgay').value;
	  window.location='excel.php?NgayGioDenKham='+Ngay+'&GioiTinh='+x+'&tungay='+tungay+'&denngay='+denngay+"&loaingay="+loaingay;
	  }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center><h2><a style="color:#008ECE" href="main.php?p=dh_xem">BẢNG DỮ LIỆU KHÁCH HÀNG</a> / <a style="color:coral" href="main.php">THỐNG KÊ</a></h2></center>
<br />
<form class="search_bar" style="background:#e8e8e8;padding:10px;color:brown" action="" method="get" name="form2" id="form2">	
  <input type="hidden" name="p" id="p" value="dh_xem" />
  <span class="search_ngaykham">Ngày Đến Khám: <input type="text" id="NgayGioDenKham" name="NgayGioDenKham" value="<?php echo $_GET['NgayGioDenKham'];?>" />
  <script>
  $(function() {
    $( "#NgayGioDenKham" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script>
  </span> - 
  <span class="search_ngayhen">Ngày Đặt Hẹn: <input type="text" id="NgayGioDatHen" name="NgayGioDatHen" value="<?php echo $_GET['NgayGioDatHen'];?>" />
  <script>
  $(function() {
    $( "#NgayGioDatHen" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script></span> - 
  <span class="search_mabs">Mã: <select name="ID_BacSi">
  <option value="-1">All</option>
  <?php
  $listbs = $qt->ListBSTV(-1,1,100, $Where);
  while($bs = mysql_fetch_assoc($listbs)){
  ?>
  <option <?php if($ID_BacSi == $bs["ID_BacSi"]) echo "selected" ?> value="<?php echo $bs["ID_BacSi"]?>"><?php echo $bs["KyTuBacSi"]?></option>
  <?php
  }
  ?>
  </select></span>
  <span class="search_madathen"><input type="text" id="MaDatHen" name="MaDatHen" value="<?php echo $_GET['MaDatHen'] ?>" style="width:68px" /></span> - 
  Họ Tên: <input type="text" id="TenBenhNhan" name="TenBenhNhan" value="<?php echo $_GET['TenBenhNhan'] ?>" /> - 
  SDT: <input type="text" id="SoDT" name="SoDT" value="<?php echo $_GET['SoDT'] ?>" />
  <select name="idTP2">
	<option value="-1">-Chọn TP-</option>
	<?php 
		$tp = $qt->TP_list();
		while($rowtp = mysql_fetch_assoc($tp)){
	?>
	<option value="<?php echo $rowtp['id']?>"><?php echo $rowtp['title']?></option>
	<?php }?>
  </select>
  <select name="idQuan2">
	<option value="">-Chọn Quận-</option>
  </select>
  <input type="submit" value="TÌM" id="btnLocMa" name="btnLocMa" style="cursor:pointer" />
  <input type="button" value="TÌM HẾT" id="btnTimHet" name="btnTimHet" style="cursor:pointer" onclick="window.location='main.php?p=dh_xem'" />
  <select id="LoaiNgay">
	<option value="-1">Tất cả</option>
	<option value="0">Đặt hẹn</option>
	<option value="1">Đến Khám</option>
  </select>
  <span class="trichxuat"><input type="button" value="XUẤT DỮ LIỆU NAM" id="btnTX" name="btnTX" onclick="trichxuat(1);" style="cursor:pointer" /></span>
  <span class="trichxuat"><input type="button" value="XUẤT DỮ LIỆU NỮ" id="btnTX" name="btnTX" onclick="trichxuat(0);" style="cursor:pointer" /></span>
</form>
<br />
<div style="clear: both; height: 10px"></div>
<div class="search_bar" style="float:left">Chọn theo tháng : 
	<span class="search_ngaykham">Từ ngày : <input type="text" id="tungay" name="tungay" value="<?php echo $_GET['tungay'];?>" />
  <script>
  $(function() {
    $( "#tungay" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script>
  </span> - 
  <span class="search_ngayhen">Đến ngày : <input type="text" id="denngay" name="denngay" value="<?php echo $_GET['denngay'];?>" />
  <script>
  $(function() {
    $( "#denngay" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script></span> - 
  <span class="search_mabs">Mã: <select name="ID_BacSi2">
  <option value="-1">All</option>
  <?php
  $listbs = $qt->ListBSTV(-1,1,100, $Where);
  while($bs = mysql_fetch_assoc($listbs)){
  ?>
  <option <?php if($ID_BacSi2 == $bs["ID_BacSi"]) echo "selected" ?> value="<?php echo $bs["ID_BacSi"]?>"><?php echo $bs["KyTuBacSi"]?></option>
  <?php
  }
  ?>
  </select></span>
	<button type="button" class="timtheothang">Tìm</button>
	<script>
		$(function(){
			$(".timtheothang").click(function(){
				var tungay = $("#tungay").val();
				var denngay = $("#denngay").val();
				var ID_BacSi2 = $("select[name='ID_BacSi2']").val();
				window.location.href="main.php?p=dh_xem&tungay="+tungay+"&denngay="+denngay+"&ID_BacSi2="+ID_BacSi2;
			});
		})
	</script>
</div>
<div style="float:right"> Kết Quả : Có <span style="color:red;font-size:20px;font-weight:bold"><?=$totalRows?></span> dòng | Đã đến : <span style="color:red;font-size:20px;font-weight:bold"><?php echo $totalRows_DaDen?></span> | Chưa đến : <span style="color:red;font-size:20px;font-weight:bold"><?php echo ($totalRows - $totalRows_DaDen)?></span>
(Đã lược bỏ những dòng hủy)
</div>
<div style="clear: both; height: 10px"></div>
<div style="min-height:179px;">
<table class="bang" id="dsloaitin" border="1" cellpadding="4" cellspacing="0" width="100%" align="center" />

<tr>
    <th class="col_mahen" width="80">Mã Hẹn</th>
    <th class="col_hoten" width="180">Họ Tên</th>
    <th class="col_tuoi" width="50">Tuổi</th>
    <th class="col_sex" width="50">Sex</th>
    <th class="col_phone" width="120">Phone</th>
    <th class="col_diachi" width="200">Địa Chỉ</th>
    <th width="110">TP</th>
    <th width="110">Quận</th>
    <th class="col_ngaydathen" width="110">Ngày Đặt Hẹn</th>
    <th class="col_ngayden" width="120">Ngày Đến</th>
    <th class="col_benh" width="60">Bệnh</th>
    <th class="col_nguon" width="68">Nguồn</th>
    <th class="col_bskham" width="80">BS Khám</th>
    <th class="col_thongtinthem">Thông Tin Thêm</th>
    <th class="col_den" width="40">Đến</th>
    <th class="col_dieutri" width="40">Đ.Trị</th>    
    <th class="col_thaotac" width="85">Thao Tác</th>
</tr>
<form action="dh_them.php" method="post">
<tr>
	<td class="col_mahen" style="color:#F66;font-size:18px;font-weight:bold" ><?php echo $_SESSION['tg_login_kytu']?> <input style="color:#F66;font-size:18px;font-weight:bold;width:50%" type="textbox" value="<?php echo $_SESSION['SoDatHen']; ?>" name="MaDatHen"  /></td>
    <td class="col_hoten" ><input type="textbox" value="" name="TenBenhNhan" autofocus /></td>
    <td class="col_tuoi" ><input type="textbox" value="" name="Tuoi" style="width:40px;"  /></td>
    <td class="col_sex" ><select name="GioiTinh"><option value="1">Nam</option><option value="0">Nữ</option></select></td>
    <td class="col_phone" ><input type="textbox" value="" name="SoDT" /></td>
    <td class="col_diachi" ><input type="textbox" value="" name="DiaChi" /></td>
    <td>
		<select name="idTP">
			<option value="-1">-Chọn TP-</option>			
			<?php 
				$tp1 = $qt->TP_list();
				while($rowtp1 = mysql_fetch_assoc($tp1)){
			?>
				<option value="<?php echo $rowtp1['id']?>"><?php echo $rowtp1['title']?></option>
			<?php }?>
			
		</select>
	</td>
	<td>
		<select name="idQuan">
			<option value="-1">-Chọn Quân-</option>
		</select>
	</td>
    <td class="col_ngaydathen" ><?=date("d-m-Y H:i:s") ?><input type="hidden" value="<?=date("d-m-Y H:i:s") ?>" name="NgayGioDatHen"/></td>
    <td class="col_ngayden" ><input type="textbox" value="" id="NgayDenKham_Nhap" name="NgayDenKham" style="width:68px;" maxlength="5"/>
    <script>
  $(function() {
    $( "#NgayDenKham_Nhap" ).datepicker({ dateFormat: 'dd-mm' });
  });
  </script>
    <select name="GioDenKham" style="width:40px;">
	<option value="0">0
    </option>
    <?php
	for($chay=8;$chay<=20;$chay++){
	?>
    <option value="<?php echo $chay; ?>"><?php echo $chay;?>
    </option>
    <?php
	}
	?>
    </select>g </td>
    <td class="col_benh" ><input type="textbox" value="" name="LoaiBenh" style="width:50px;" /></td>
    <td class="col_nguon" ><select name="Nguon"> 
    <option value="chat"> Chat
    </option>
    <option value="dienthoai"> Đ.Thoại
    </option>
        <option value="mang"> Mạng
    </option>
        <option value="khac"> Khác
    </option>
     
    </select></td>
    <td class="col_bskham" ><input type="textbox" value="" name="BSKham" /></td>
    <td class="col_thongtinthem" ><input type="textbox" value="" name="GhiChu" /></td>    
    <td class="col_den" >Chưa</td>
    <td class="col_dieutri" >Chưa</td>
	<td align="center"><input type="submit" name="btnOK" value="Thêm" /></td>
</tr>
</form>
<?php $stt=0; while ($row_loaisp = mysql_fetch_assoc($loaisp) ) {
	$stt+=1;
	 ?>
<?php ob_start(); ?>
<tr class="tinhtrang_{TinhTrang} <?php if($stt%2==1) echo "dongle"; else echo "dongchan"; ?>">    
<td class="col_mahen DaDen{DaDen}" width="88" >{KyTuBacSi}{MaDatHen}</td>
<td class="col_hoten">{TenBenhNhan}</td>
<td class="col_tuoi">{Tuoi}</td>
<td class="col_sex">{GioiTinh}</td>
<td class="col_phone">{SoDT}</td>
<td class="col_diachi">{DiaChi}</td>
<td>{TenTP}</td>
<td>{TenQuan}</td>
<td class="col_ngaydathen" >{NgayGioDatHen}</td>
<td class="col_ngayden" bb="{TinhTrang}" id="{id}">{NgayGioDenKham}</td>
<td class="col_benh" style="text-transform:uppercase">{LoaiBenh}</td>
<td class="col_nguon">{Nguon}</td>
<td class="col_bskham" style="text-transform:uppercase">BS.{BSKham}</td>
<td class="col_thongtinthem" title="{GhiChu}">{GhiChu}</td>
<td class="col_den anhien" data="{DaDen}">
<?php
if($row_loaisp['TinhTrang']=="0" || $row_loaisp['TinhTrang'] == '3'){
?><a class="smallButton anhien" id="ma_DaDen_{id}"  AnHien="bang=dathen&cot=DaDen&ma=ID_DatHen&id={id}" href="#"><img  src="images/ah_{DaDen}.png"></a>
<?php
}else
{
	?>
    Hủy
    <?php
}
?>
</td>
<td class="col_dieutri anhien">
<?php
if($row_loaisp['TinhTrang']=="0" || $row_loaisp['TinhTrang'] == '3'){
?><a class="smallButton anhien" id="ma_DieuTri_{id}"  AnHien="bang=dathen&cot=DieuTri&ma=ID_DatHen&id={id}" href="#"><img  src="images/ah_{DieuTri}.png"></a>
<?php
}else
{
	?>
    Hủy
    <?php
}
?>
</td>
<td align="center">
<?php
if($row_loaisp['TinhTrang']=="0" || $row_loaisp['TinhTrang'] == '3'){
?>
            <a class="smallButton" href="main.php?p=dh_chinh&id={id}"><img  src="images/pencil.png" title="Sửa Tin"></a>
            <a class="smallButton" href="dh_xoa.php?id={id}" onclick="return confirm('Bạn có muốn xóa !!! ');"><img src="images/close.png" title="Xóa Tin"></a>
<?php
}else
{
	?>
    Đã Hủy
    <?php
}
?>            
      </td>
</tr>
<?php
$str = ob_get_clean();
if($row_loaisp['idTP']==-1) $TenTP = "Chưa biết";
else $TenTP = $qt->TP_detail($row_loaisp['idTP']);
if($row_loaisp['idQuan']==-1) $TenQuan = "Chưa biết";
else $TenQuan = $qt->Quan_detail($row_loaisp['idQuan']);
$str = str_replace("{id}",$row_loaisp['ID_DatHen'],$str);
$str = str_replace("{SoDT}",$row_loaisp['SoDT'],$str);
$str = str_replace("{TenTP}",$TenTP,$str);
$str = str_replace("{TenQuan}",$TenQuan,$str);
$str = str_replace("{MaDatHen}",$row_loaisp['MaDatHen'],$str);
$str = str_replace("{TinhTrang}",$row_loaisp['TinhTrang'],$str);
$str = str_replace("{KyTuBacSi}",$row_loaisp['KyTuBacSi'],$str);
$str = str_replace("{TenBenhNhan}",$row_loaisp['TenBenhNhan'],$str);
$str = str_replace("{Tuoi}",$row_loaisp['Tuoi'],$str);

switch($row_loaisp['GioiTinh']){
	case 0:$GioiTinh_="Nữ";
	break;
	case 1:$GioiTinh_="Nam";
	break;
	case 2:$GioiTinh_="Gay";
	break;
	}
$str = str_replace("{GioiTinh}",$GioiTinh_,$str);


$str = str_replace("{DiaChi}",$row_loaisp['DiaChi'],$str);
$NgayGioDenKham_= date("d-m-Y H:i",strtotime($row_loaisp['NgayGioDenKham']));

if(date("d-m-Y",strtotime($row_loaisp['NgayGioDenKham']))=="01-01-1970"){
	$NgayGioDenKham_ = "Không ngày hẹn";
}

$str = str_replace("{NgayGioDenKham}",$NgayGioDenKham_,$str);
$str = str_replace("{NgayGioDatHen}",date("d-m-Y H:i",strtotime($row_loaisp['NgayGioDatHen'])),$str);
$str = str_replace("{LoaiBenh}",$row_loaisp['LoaiBenh'],$str);
$str = str_replace("{BenhThucTe}",$row_loaisp['BenhThucTe'],$str);
$str = str_replace("{DaDen}",$row_loaisp['DaDen'],$str);
$str = str_replace("{DieuTri}",$row_loaisp['DieuTri'],$str);
$str = str_replace("{BSKham}",$row_loaisp['BSKham'],$str);
switch($row_loaisp['Nguon']){
	case 'chat':$Nguon_="Chat";
	break;
	case 'dienthoai':$Nguon_="Đ.thoại";
	break;
	case 'mang':$Nguon_="Mạng";
	break;
	case 'khac':$Nguon_="Khác";
	break;
	}
$str = str_replace("{Nguon}",$Nguon_,$str);
$str = str_replace("{GhiChu}",$row_loaisp['GhiChu'],$str);
echo $str;
?>
<?php } //while ?>
</table>
</div>
<?php if ($totalRows > $pageSize) { ?>
<p id="thanhphantrang" style="padding:30px;">
  <?=$qt->pagesList($totalRows, $pageNum, $pageSize);?>
  </p>
  <?php
}
  ?>
 <audio id="audiotag1" src="sound.mp3" preload="auto"></audio> 
<script>

 j = 0;
	setInterval(function(){ a(); }, 10000);
	//a(); 
	function a(){ j++; 
		//alert(1); 
		i = 0;
		var d = getISODateTime(new Date());
		//alert(d);

		//document.getElementById('audiotag1').play();
		$(".col_ngayden").each(function(){ i++; $(this).css("color","");
			if(i>2){
				obj = $(this);
				var tinhtrang = obj.attr("bb");
				var id = obj.attr("id");
				if(tinhtrang==0){
					var ngayden = obj.html();
					//alert(ngaydathen);
					ngayden = ngayden.replace("-","/");
					ngayden = ngayden.replace("-","/");
					
					date_future = new Date(d);
					date_now = new Date(ngayden);
					if(date_future - date_now >=0){
					// get total seconds between the times
					var delta = Math.abs(date_future - date_now) / 1000;

					// calculate (and subtract) whole days
					var days = Math.floor(delta / 86400);
					delta -= days * 86400;

					// calculate (and subtract) whole hours
					var hours = delta / 3600 % 24;
					delta -= hours * 3600;

					// calculate (and subtract) whole minutes
					var minutes = Math.floor(delta / 60) % 60;
					delta -= minutes * 60;

					// what's left is seconds
					var seconds = delta % 60;  // in theory the modulus is not required
					 if ( (hours == 1 && days ==0 && minutes == 00)  || (hours < 1 && days == 0) ) {
						//document.getElementById('audiotag1').play();
						obj.css("color","red");
						var str = obj.parent().find(".col_mahen").html();
						if(obj.parent().find(".col_mahen").find("a").length <=0)	obj.parent().find(".col_mahen").append("<a onclick='bao("+id+")' class='bao' id='"+id+"' href='#'> Báo</a>");
					}
					}
				}
			}
		});
	}
	
	function getISODateTime(d){
    // padding function
    var s = function(a,b){return(1e15+a+"").slice(-b)};

    // default date parameter
    if (typeof d === 'undefined'){
        d = new Date();
    };

    // return ISO datetime
    return s(d.getDate(),2) + '/' +
        s(d.getMonth()+1,2) + '/' +
        d.getFullYear() + ' ' +
        s(d.getHours(),2) + ':' +
        s(d.getMinutes(),2);
        //s(d.getSeconds(),2);
}
	function bao(id){
		var sql = "update dathen set TinhTrang = 3 where ID_DatHen = "+id;
		$.get("xuly.php",{sql:sql},function(){
			location.reload();
		});
		
		return false;
	}
</script>  

  