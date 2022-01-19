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
  $LoaiNgay2 = $_GET['LoaiNgay2']; settype($LoaiNgay2,"int");
  
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
	  $SoDT = preg_replace("/[^0-9]/", "",$SoDT);		
	  $Where.= " And SoDT like '%$SoDT%' " ;		
  }
  if ($TenBenhNhan != ""){
	  $Where.= " And TenBenhNhan like '%$TenBenhNhan%' " ;		
  }
	if($tungay !='' && $denngay !=''){
		$tungay = date("Y-m-d",strtotime($tungay));
		$denngay = date("Y-m-d",strtotime($denngay));
		if($LoaiNgay2 == -1) $Where.= " And ((Date(NgayGioDatHen) between '$tungay' and '$denngay') OR (Date(NgayGioDenKham) between '$tungay' and '$denngay')) and (ID_BacSi = $ID_BacSi2 OR $ID_BacSi2 = -1)";
		else if($LoaiNgay2 == 0) $Where.= " And (Date(NgayGioDatHen) between '$tungay' and '$denngay') and (ID_BacSi = $ID_BacSi2 OR $ID_BacSi2 = -1)";
		else if($LoaiNgay2 == 1) $Where.= " And (Date(NgayGioDenKham) between '$tungay' and '$denngay') and (ID_BacSi = $ID_BacSi2 OR $ID_BacSi2 = -1)";
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
  else if($_SESSION['tg_login_level']==6){
	$loaisp = $qt->ListDH_bacsi($_SESSION["tg_login_id"],$totalRows, $pageNum,$pageSize, $Where);
	$totalRows_DaDen = $qt->ListDH_DaDen_bacsi($_SESSION["tg_login_id"],1,$Where);
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
	
	/*$(".str").keyup(function(){
		var id = $(this).attr("id");
		var str = $(this).val();
		$.get("ajax/capnhat.php",{x:(new Date()),id:id,str:str},function(){});
	});
	*/
	$(".str").change(function(){
		var id = $(this).attr("id");
		var str = $(this).val();
		$.get("ajax/capnhat.php",{x:(new Date()),id:id,str:str},function(){});
	});
	$(".chiendich").keyup(function(){
		var id = $(this).attr("id");
		var str = $(this).val();
		$.get("ajax/capnhat2.php",{x:(new Date()),id:id,str:str},function(){});
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
  <?php if($_SESSION['quyen']['col_xuat']==1){?>
  <span class="trichxuat"><input type="button" value="XUẤT DỮ LIỆU NAM" id="btnTX" name="btnTX" onclick="trichxuat(1);" style="cursor:pointer" /></span>
  <span class="trichxuat"><input type="button" value="XUẤT DỮ LIỆU NỮ" id="btnTX" name="btnTX" onclick="trichxuat(0);" style="cursor:pointer" /></span>
  <span class="trichxuat"><input type="button" value="XUẤT TẤT CẢ" id="btnTX" name="btnTX" onclick="trichxuat(-1);" style="cursor:pointer" /></span>
  <?php }?>
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
  <span>
	<select id="LoaiNgay2" name="LoaiNgay2">
	<option <?php if(!isset($_GET['LoaiNgay2']) || $_GET['LoaiNgay2'] == -1) echo "selected"?> value="-1">Tất cả</option>
	<option <?php if(isset($_GET['LoaiNgay2']) && $_GET['LoaiNgay2'] == 0) echo "selected"?> value="0">Đặt hẹn</option>
	<option <?php if(isset($_GET['LoaiNgay2']) && $_GET['LoaiNgay2'] == 1) echo "selected"?> value="1">Đến Khám</option>
  </select>
  </span>
	<button type="button" class="timtheothang">Tìm</button>
	<script>
		$(function(){
			$(".timtheothang").click(function(){
				var tungay = $("#tungay").val();
				var denngay = $("#denngay").val();
				var ID_BacSi2 = $("select[name='ID_BacSi2']").val();
				var LoaiNgay2 = $("#LoaiNgay2").val();
				window.location.href="main.php?p=dh_xem&tungay="+tungay+"&denngay="+denngay+"&ID_BacSi2="+ID_BacSi2+"&LoaiNgay2="+LoaiNgay2;
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
    <th class="col_chiendich" width="50">Chiến dịch</th>
    <th class="col_str" width="50"></th>
    <th class="col_hoten" width="150">Họ Tên</th>
    <th class="col_tuoi" width="30">Tuổi</th>
    <th class="col_sex" width="30">Sex</th>
    <th class="" width="90">Phone</th>
    <th class="col_diachi" width="200">Địa Chỉ</th>
    <th width="110">TP</th>
    <th width="90">Quận</th>
    <th class="col_ngaydathen" width="110">Ngày Đặt Hẹn</th>
    <th class="col_ngayden" width="120">Ngày Đến</th>
    <th class="col_benh" width="60">Bệnh</th>
    <th class="col_nguon" width="50">Nguồn</th>
    <th class="col_bskham" width="70">BS Khám</th>
    <th class="col_thongtinthem" width="80">Thông Tin Thêm</th>
    <th class="col_den" width="40">Đến</th>
    <th class="col_dieutri" width="40">Đ.Trị</th>    
    <th class="col_thaotac" width="130">Thao Tác</th>
</tr>
<form action="dh_them.php" method="post">
<tr>
	<td class="col_mahen" style="color:#F66;font-size:18px;font-weight:bold" ><?php echo $_SESSION['tg_login_kytu']?> <input style="color:#F66;font-size:18px;font-weight:bold;width:50%" type="textbox" value="<?php echo $_SESSION['SoDatHen']; ?>" name="MaDatHen"  /></td>
	<td class="col_chiendich">&nbsp;</td>
	<td class="col_str">&nbsp;</td>
    <td class="col_hoten" ><input type="textbox" value="" name="TenBenhNhan" autofocus /></td>
    <td class="col_tuoi" ><input type="textbox" value="" name="Tuoi" style="width:40px;"  /></td>
    <td class="col_sex" ><select name="GioiTinh"><option value="1">Nam</option><option value="0">Nữ</option></select></td>
    <td class=""><input type="textbox" value="" name="SoDT" /></td>
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
    $( "#NgayDenKham_Nhap" ).datepicker({ dateFormat: 'dd-mm-yy' });
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
    <td class="col_benh" >
		<select name="LoaiBenh">
		<?php
			$benh = array("Gan","XNBXH","SMG","BL","MRSD","GM","VDTN","VBQ","BT","HM","HN","VS","KTSKSS","BQD","VBQD","TTL","XTS","RLXT","XTRM","TH","VTT","TDD","HNDV","YSL","LD","CHDV","RLCD","NK","VN","MCSD","VAD","VTC","VLTCTC","RLKN","VMT","THAD","DVTT","KTT","DCTK","PK","SAB","Noi","RMBT","BN(PF)","BVN(PF)","BG(PF)","BC(PF)","DUD(PF)","VD(PF)","MTC(PF)","BB(PF)","ZN(PF)","MC(PF)","KTVGB","KTVGC","GXC","UTG","VGDR","GNM","GCT","KTVG","MGC");
		?>
			<option <?php if($row_dathen['LoaiBenh']=='') echo "selected"?> value="">Chọn Loại Bệnh</option>
			<?php foreach($benh as $motbenh){?>
				<option <?php if($row_dathen['LoaiBenh'] == $motbenh) echo "selected"; ?> value="<?php echo $motbenh?>" ><?php echo $motbenh?></option>
			<?php }?>
		</select>
	</td>
    <td class="col_nguon" ><select name="Nguon"> 
    <option value="chat"> Chat
    </option>
    <option value="dienthoai"> Đ.Thoại
    </option>
	<option value="dt2"> ĐT2
    </option>
        <option value="mang"> Mạng
    </option>
        <option value="khac"> Khác
    </option>
     
    </select></td>
    <td class="col_bskham" >
		<select name="ID_BacSiDT">
			<option value="0">Chọn BS</option>
			<?php
				$bsdt = $qt->BacSi_DT_list();
				while($row_bsdt = mysql_fetch_assoc($bsdt)){
			?>
				<option value="<?php echo $row_bsdt['ID_BacSi']?>"><?php echo $row_bsdt['TenBS']?>(<?php echo $row_bsdt['DT']?>)</option>
			<?php }?>
		</select>
	</td>
    <td class="col_thongtinthem" ><input type="textbox" value="" name="GhiChu" /></td>    
    <td class="col_den" >Chưa</td>
    <td class="col_dieutri" >Chưa</td>
	<td class="col_thaotac" align="center">
		<?php if($_SESSION['quyen']['col_them'] == 1){?>
			<input type="submit" name="btnOK" value="Thêm" />
		<?php }?>
	</td>
</tr>
</form>
<?php $stt=0; while ($row_loaisp = mysql_fetch_assoc($loaisp) ) {
	$stt+=1;
	 ?>
<?php ob_start(); ?>
<tr class="tinhtrang_{TinhTrang} <?php if($stt%2==1) echo "dongle"; else echo "dongchan"; ?>">    
<td class="col_mahen DaDen{DaDen}" width="88" >{KyTuBacSi}{MaDatHen}</td>
<!--<td class="col_str"><input type="text" value="{BenhThucTe}" id="{id}" class="str" /></td>-->
<td class="col_chiendich"><input id="{id}" type="text" value="{ChienDich}" class="chiendich" /></td>
<td class="col_str">
	<?php
		if($_SESSION['quyen']['col_str']==1) {
	?>
	<select id="{id}" class="str">
		<option <?php if($row_loaisp['BenhThucTe']== -1) echo "selected" ?> value="-1">Chọn</option>
		<option <?php if($row_loaisp['BenhThucTe']=='Facebook') echo "selected"?> value="Facebook">Facebook</option>
		<option <?php if($row_loaisp['BenhThucTe']=='SEO') echo "selected"?> value="SEO">SEO</option>
		<option <?php if($row_loaisp['BenhThucTe']=='AD') echo "selected"?> value="AD">AD</option>
    <option <?php if($row_loaisp['BenhThucTe']=='ZALO') echo "selected"?> value="ZALO">ZALO</option>
		<option <?php if($row_loaisp['BenhThucTe']=='Unknow') echo "selected"?> value="Unknow">Unknow</option>
		<option <?php if($row_loaisp['BenhThucTe']=='Cốc Cốc') echo "selected"?> value="Cốc Cốc">Cốc Cốc</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Gan_DL') echo "selected"?> value="Gan_DL">Gan_DL</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Gan_CPC') echo "selected"?> value="Gan_CPC">Gan_CPC</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Gan_CPM') echo "selected"?> value="Gan_CPM">Gan_CPM</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Gan_DT') echo "selected"?> value="Gan_DT">Gan_DT</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Nam_DL') echo "selected"?> value="Nam_DL">Nam_DL</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Nam_CPC') echo "selected"?> value="Nam_CPC">Nam_CPC</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Nam_CPM') echo "selected"?> value="Nam_CPM">Nam_CPM</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Nam_DT') echo "selected"?> value="Nam_DT">Nam_DT</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Phu_DL') echo "selected"?> value="Phu_DL">Phu_DL</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Phu_DT') echo "selected"?> value="Phu_DT">Phu_DT</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Phu_CPC') echo "selected"?> value="Phu_CPC">Phu_CPC</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Tri_DL') echo "selected"?> value="Tri_DL">Tri_DL</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Tri_CPC') echo "selected"?> value="Tri_CPC">Tri_CPC</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Tri_CPM') echo "selected"?> value="Tri_CPM">Tri_CPM</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Tri_DT') echo "selected"?> value="Tri_DT">Tri_DT</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Xa_DL') echo "selected"?> value="Xa_DL">Xa_DL</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Xa_CPC') echo "selected"?> value="Xa_CPC">Xa_CPC</option>
    <option <?php if($row_loaisp['BenhThucTe']=='Xa_DT') echo "selected"?> value="Xa_DT">Xa_DT</option>

	</select>
	<?php }?>
</td>
<td class="col_hoten">{TenBenhNhan}</td>
<td class="col_tuoi">{Tuoi}</td>
<td class="col_sex">{GioiTinh}</td>
<td class=""><span class="col_phone">{SoDT}</span></td>
<td class="col_diachi">{DiaChi}</td>
<td>{TenTP}</td>
<td>{TenQuan}</td>
<td class="col_ngaydathen" >{NgayGioDatHen}</td>
<td class="col_ngayden" bb="{TinhTrang}" id="{id}">{NgayGioDenKham}</td>
<td class="col_benh" style="text-transform:uppercase">{LoaiBenh}</td>
<td class="col_nguon">{Nguon}</td>
<td class="col_bskham" >
	<?php if($row_loaisp['BSKham'] != ''){?>
		BS.{BSKham}
	<?php } else {
		$bsdt =	$qt->ChiTietTK($row_loaisp['ID_BacSiDT']);
		if(mysql_num_rows($bsdt)>0){
			$row_bsdt = mysql_fetch_assoc($bsdt);
			$tenbs = $row_bsdt['TenBS']."(".$row_bsdt['DT'].")";
			echo $tenbs;
		}
	}
	?>
</td>
<td class="col_thongtinthem" title="{GhiChu}">{GhiChu}</td>
<td class="col_den anhien" data="{DaDen}">
<?php
if($row_loaisp['TinhTrang']=="0" || $row_loaisp['TinhTrang'] == '3'){
?>
	<?php if($_SESSION['quyen']['col_den']==1){?>
		<a class="smallButton anhien" id="ma_DaDen_{id}"  AnHien="bang=dathen&cot=DaDen&ma=ID_DatHen&id={id}" href="#"><img  src="images/ah_{DaDen}.png"></a>
	<?php }?>	
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
?>
	<?php if($_SESSION['quyen']['col_dieutri']==1){?>
		<a class="smallButton anhien" id="ma_DieuTri_{id}"  AnHien="bang=dathen&cot=DieuTri&ma=ID_DatHen&id={id}" href="#"><img  src="images/ah_{DieuTri}.png"></a>
	<?php }?>
<?php
}else
{
	?>
    Hủy
    <?php
}
?>
</td>
<td class="col_thaotac" align="center">
<?php
if($row_loaisp['TinhTrang']=="0" || $row_loaisp['TinhTrang'] == '3'){
?>
		<?php if($_SESSION['quyen']['col_chinh']==1){?>
            <a class="smallButton col_chinh" href="main.php?p=dh_chinh&id={id}"><img  src="images/pencil.png" title="Sửa Tin"></a>
		<?php }?>
		<?php if($_SESSION['quyen']['col_xoa']==1){?>		
            <a class="smallButton col_xoa" href="dh_xoa.php?id={id}" onclick="return confirm('Bạn có muốn xóa !!! ');"><img src="images/close.png" title="Xóa Tin"></a>
		<?php }?>	
		<?php if($_SESSION['quyen']['col_upload']==1){?>	
				<a class="smallButton upload_icon" id="mes_{id}_{KyTuBacSi}{MaDatHen}" id_dathen="{id}" href="#"><img src="upload-ajax/images/upload.png" title="Upload file"></a>
				<?php 
					$kq = $qt->getFile($row_loaisp['ID_DatHen']);
					$total = mysql_num_rows($kq);
				?>
					<a <?php if($total<=0) echo "style='display:none'";?> class="smallButton file_button" id="{id}" href="#"><img src="upload-ajax/images/file.png" title="File"></a>
			<?php }?>
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
if($_SESSION['quyen']['col_phone']==1) 
	$str = str_replace("{SoDT}",$row_loaisp['SoDT'],$str); 
else 
	$str = str_replace("{SoDT}",'',$str);
$str = str_replace("{TenTP}",$TenTP,$str);
$str = str_replace("{TenQuan}",$TenQuan,$str);
$str = str_replace("{MaDatHen}",$row_loaisp['MaDatHen'],$str);
$str = str_replace("{TinhTrang}",$row_loaisp['TinhTrang'],$str);
$str = str_replace("{KyTuBacSi}",$row_loaisp['KyTuBacSi'],$str);
$str = str_replace("{TenBenhNhan}",$row_loaisp['TenBenhNhan'],$str);
$str = str_replace("{BenhThucTe}",$row_loaisp['BenhThucTe'],$str);
$str = str_replace("{ChienDich}",$row_loaisp['ChienDich'],$str);
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

if($_SESSION['quyen']['col_diachi']==1) 
	$str = str_replace("{DiaChi}",$row_loaisp['DiaChi'],$str);
else
	$str = str_replace("{DiaChi}",'',$str);
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
	case 'dt2':$Nguon_="ĐT2";
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
						//if(obj.parent().find(".col_mahen").find("a").length <=0)	obj.parent().find(".col_mahen").append("<a onclick='bao("+id+")' class='bao' id='"+id+"' href='#'> Báo</a>");
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

  