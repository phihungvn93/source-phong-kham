<?php
  require_once "checklogin.php";
  if($_SESSION['quyen']['col_chinh']==0) header("location:main.php?p=dh_xem");
  require_once "class_quantri.php";
  $qt =  new quantri;
  $id=$_GET['id']; settype($id,"int");
  $dathen = $qt->ChiTietDH($id);
  $row_dathen = mysql_fetch_assoc($dathen);  
  
  if (isset($_POST['btnOK'])==true){
	  if($_SESSION['quyen']['col_dieutri']==0) $_POST['DieuTri'] = $row_dathen['DieuTri'];
	  if($_SESSION['quyen']['col_phone']==0) $_POST['SoDT'] = $row_dathen['SoDT'];
	  if($_SESSION['quyen']['col_den']==0) $_POST['DaDen'] = $row_dathen['DaDen'];
	  if($_SESSION['quyen']['col_diachi']==0) $_POST['DiaChi'] = $row_dathen['DiaChi'];
	  if($_SESSION['quyen']['col_str']==0) $_POST['BenhThucTe'] = $row_dathen['BenhThucTe']; 
    $qt ->SuaDH($id);
    header("location:main.php?p=dh_xem");
  }
?>
<script>
	$(function(){
		$("select[name='idTP']").change(function(){
			idTP = $(this).val();
			$.get("ajax/layquan.php",{idTP:idTP,x:(new Date()).getTime()},function(d){ 
				$("select[name='idQuan']").html(d);
			})
		})
	})
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="" method="post" name="form1" id="form1">
<table border="1" align="center" cellpadding="4" cellspacing="0" style="  margin: auto;
  background: #e8e8e8;
  padding: 10px;">
<tr> <td colspan="2" align="center"><h2>CẬP NHẬT ĐẶT HẸN</h2></td> </tr>

<tr><td width="150">Họ Tên</td>
  <td><input type="text" name="TenBenhNhan" id="TenBenhNhan" value="<?php echo $row_dathen['TenBenhNhan'] ?>" /></td>
</tr>
<tr><td width="150">Tuổi</td>
  <td><input type="text" name="Tuoi" id="Tuoi" value="<?php echo $row_dathen['Tuoi'] ?>" /></td>
</tr>
<tr><td width="150">Giới Tính</td>
  <td><select name="GioiTinh">
  <option value="1" <?php if($row_dathen['GioiTinh']=='1') echo "selected" ?> >Nam</option>
  <option value="0" <?php if($row_dathen['GioiTinh']=='0') echo "selected" ?> >Nữ</option>
  </select></td>
</tr>
<?php if($_SESSION['quyen']['col_diachi']==1){?>
<tr><td width="150">Địa Chỉ</td>
  <td><input type="text" name="DiaChi" id="DiaChi" value="<?php echo $row_dathen['DiaChi'] ?>" /></td>
</tr>
<?php }?>
<?php if($_SESSION['quyen']['col_phone']==1){?>
<tr class="col_phone"><td width="150">Số Điện Thoại</td>
  <td>
	<input type="text" name="SoDT" id="SoDT" value="<?php echo $row_dathen['SoDT'] ?>" /></td>
</tr>
<?php }?>
<tr>
	<td>Thành phố</td>
	<td>
		<select name="idTP">
		<option value="-1">-Chọn TP-</option>
		<?php 
			$tp = $qt->TP_list();
			while($rowtp = mysql_fetch_assoc($tp)){
		?>
		<option <?php if($row_dathen['idTP'] == $rowtp['id']) echo "selected"?> value="<?php echo $rowtp['id']?>"><?php echo $rowtp['title']?></option>
		<?php }?>
		</select>
	</td>
</tr>
<tr>
	<td>Quận</td>
	<td>
		<select name="idQuan">
			<option value="-1">-Chọn Quận-</option>
			<?php 
			$q = $qt->Quan_list();
			while($rowq = mysql_fetch_assoc($q)){
		?>
		<option <?php if($row_dathen['idQuan'] == $rowq['id']) echo "selected"?> value="<?php echo $rowq['id']?>"><?php echo $rowq['title']?></option>
		<?php }?>
		 </select>
	</td>
</tr>
<tr><td width="150">Ngày Giờ Khám</td>
  <td><input type="text" name="NgayGioDenKham" id="NgayGioDenKham" value="<?php if(date("d-m-Y",strtotime($row_dathen['NgayGioDenKham']))=="01-01-1970"){
	echo "Không ngày hẹn";
}else {  echo date("d-m-Y H:i",strtotime($row_dathen['NgayGioDenKham'])); }  ?>" /></td>
</tr>
<tr><td width="150">Bệnh Khai Lúc Đặt Hẹn</td>
	<?php /*<td><input type="text" name="LoaiBenh" id="LoaiBenh" value="<?php echo $row_dathen['LoaiBenh'] ?>" /></td>*/ ?>
  <td>
	<select name="LoaiBenh">
		<?php
			$benh = array("Gan","XNBXH","SMG","BL","MRSD","GM","VDTN","VBQ","BT","HM","HN","VS","KTSKSS","BQD","VBQD","TTL","XTS","RLXT","XTRM","TH","VTT","TDD","HNDV","YSL","LD","CHDV","RLCD","NK","VN","MCSD","VAD","VTC","VLTCTC","RLKN","VMT","THAD","DVTT","KTT","DCTK","PK","SAB","Noi","RMBT","BN(PF)","BVN(PF)","BG(PF)","BC(PF)","DUD(PF)","VD(PF)","MTC(PF)","BB(PF)","ZN(PF)","MC(PF)");
		?>
			<option <?php if($row_dathen['LoaiBenh']=='') echo "selected"?> value="">Chọn Loại Bệnh</option>
			<?php foreach($benh as $motbenh){?>
				<option <?php if($row_dathen['LoaiBenh'] == $motbenh) echo "selected"; ?> value="<?php echo $motbenh?>" ><?php echo $motbenh?></option>
			<?php }?>
		</select>
  </td>
</tr>
<?php if($_SESSION['quyen']['col_str']==1){?>
<tr class="col_benhthucte"><td width="150">Nguồn quảng cáo</td>
  <td>
	<select id="{id}" class="str" name="BenhThucTe">
		<option <?php if($row_dathen['BenhThucTe']== -1) echo "selected"?> value="-1">Chọn</option>
		<option <?php if($row_dathen['BenhThucTe']=='Facebook') echo "selected"?> value="Facebook">Facebook</option>
		<option <?php if($row_dathen['BenhThucTe']=='SEO') echo "selected"?> value="SEO">SEO</option>
		<option <?php if($row_dathen['BenhThucTe']=='AD') echo "selected"?> value="AD">AD</option>
		<option <?php if($row_dathen['BenhThucTe']=='Unknow') echo "selected"?> value="Unknow">Unknow</option>
		<option <?php if($row_dathen['BenhThucTe']=='Cốc Cốc') echo "selected"?> value="Cốc Cốc">Cốc Cốc</option>
		<option <?php if($row_dathen['BenhThucTe']=='Zalo') echo "selected"?> value="Zalo">Zalo</option>
	</select>
  </td>
</tr>
<?php }?>
<tr><td width="150">Nguồn</td>
  <td>
  <select name="Nguon"> 
    <option value="chat" <?php if($row_dathen['Nguon']=='chat') echo "selected" ?>> Chat
    </option>
    <option value="dienthoai" <?php if($row_dathen['Nguon']=='dienthoai') echo "selected" ?>> Điện Thoại
    </option>
	 <option value="dt2" <?php if($row_dathen['Nguon']=='dt2') echo "selected" ?>> ĐT2
    </option>
        <option value="mang" <?php if($row_dathen['Nguon']=='mang') echo "selected" ?>> Mạng
    </option>
        <option value="khac" <?php if($row_dathen['Nguon']=='khac') echo "selected" ?> > Khác
    </option>
     
    </select>
  </td>
</tr>

<tr><td width="150">Bác Sĩ Khám</td>
  <td>
	<?php if($row_dathen['BSKham']==''){?>
	<select name="ID_BacSiDT">
		<option value="0">Chọn BS</option>
		<?php
			$bsdt = $qt->BacSi_DT_list();
			while($row_bsdt = mysql_fetch_assoc($bsdt)){
		?>	
			<option <?php if($row_dathen['ID_BacSiDT'] == $row_bsdt['ID_BacSi']) echo "selected"?> value="<?php echo $row_bsdt['ID_BacSi']?>"><?php echo $row_bsdt['TenBS']?>(<?php echo $row_bsdt['DT']?>)</option>
		<?php }?>
	</select>
  <?php } else {?>
	<input type="text" name="BSKham" value="<?php echo $row_dathen['BSKham']?>" />
  <?php }?>
  </td>
</tr>
<tr><td width="150">Thông Tin Thêm</td>
  <td><input type="text" name="GhiChu" id="GhiChu" value="<?php echo $row_dathen['GhiChu'] ?>" /></td>
</tr>
<?php if($_SESSION['quyen']['col_den']==1){?>
<tr class="col_den"><td width="150">Đã Đến</td>
  <td>
  <select name="DaDen">
  <option value="0" <?php if($row_dathen['DaDen']==0) echo "selected" ?> > Chưa đến
  </option>
    <option value="1" <?php if($row_dathen['DaDen']==1) echo "selected" ?> > Đã đến
  </option>
  </select>
  </td>
</tr>
<?php }?>
<?php if($_SESSION['quyen']['col_dieutri']==1){?>
<tr class="col_dieutri"><td width="150">Điều Trị</td>
  <td>
  <select name="DieuTri">
  <option value="0" <?php if($row_dathen['DieuTri']==0) echo "selected" ?> > Không Điều Trị
  </option>
    <option value="1" <?php if($row_dathen['DieuTri']==1) echo "selected" ?> > Có Điều Trị
  </option>
  </select>
  </td>
</tr>
<?php }?>
<tr><td colspan="2" align="center">
<span style="
					color: #999;
					font-size: 11px;
					float: right;
					white-space: nowrap;
				">Cập nhật lần cuối bởi BS <?=$row_dathen['ID_Update'];?></span><br />
<input style="  padding: 10px;
  width: 200px;
  background: #008ECE;
  color: white;
  font-size: 20px;" type="submit" name="btnOK" id="btnOK" value="Cập Nhật" />
  
</tr>
</table>
<p>&nbsp;</p>
<p><br />
</p>
</form>
