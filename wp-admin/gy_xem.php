<?php
  require_once "checklogin.php";
  require_once "class_quantri.php";
  $qt = new quantri;
  $pageSize = 200;
  $pageNum = 1;
  if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
  if ($pageNum<=0) $pageNum=1; settype($pageNum,"int");
  $sdt = $_GET['sdt'];
  $sdt = $qt->XoaDinhDang($sdt);
  $IP = $_GET['IP'];
  $IP = $qt->XoaDinhDang($IP);
?>
<?php
  $loaisp = $qt->ListGY($totalRows, $pageNum,$pageSize, $sdt,$IP);
?>
<style>
#thanhphantrang a {text-decoration:none; padding-left:5px; padding-right:5px; margin-left:5px; margin-right:5px;}
#thanhphantrang span {
  padding-left:5px;
  padding-right:5px;
  margin-left:5px;
  margin-right:5px;
  color:#F00;
  font-size: 24px;
  font-weight: bolder;
}
.smallButton{
  border: 1px solid #cdcdcd;
  padding: 5px 5px;
  display: inline-block;
  background: #f6f6f6;
  margin:0 10px 0 0;
}
table { table-layout:fixed; }
table tr { height:1em;  }
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $(".anhien").click(function() {
      var bien = $(this).attr('AnHien');
      var ma = $(this).attr('id');
      $.get('anhien.php', bien, function(data) {
        var chuoi = "<img  src=images/ah_"+data+".png>";
        $("#"+ma).html(chuoi);
      });
      return false;
    });
  });
  function nhapchuot(){
    var dulieu = $("#sdt").val();
    if (dulieu == "Nhập Họ Tên cần tìm")
      $("#sdt").val("");
  }
  function nhapchuot1(){
    var dulieu = $("#IP").val();
    if (dulieu == "Nhập Số điện thoại cần tìm")
      $("#IP").val("");
  }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<form action="" method="get" name="form2" id="form2">
  <input type="hidden" name="p" id="p" value="dk_xem" />
    Số Điện Thoại <input type="text" id="sdt" name="sdt" value="" style="width:300px" />
   IP <input type="text" id="IP" name="IP" value="" style="width:300px" />
  <input type="submit" value="Tìm" id="btnLocMa" name="btnLocMa" />
</form>
<div style="clear: both; height: 10px"></div>

<p>
<a href="http://benhviennamkhoahcm.com/wp-admin/main.php?p=qy_xem"><input type="button" style="width:200px" value="Cập Nhật" /></a>
<a href="http://benhviennamkhoahcm.com/wp-admin/main.php?p=gy_xem&khongcapnhat=1"><input type="button" style="width:200px" value="Dừng Cập Nhật" /></a>
</p>
<br/>
<table id="dsloaitin" border="1" cellpadding="4" cellspacing="0" width="100%" align="center" />

<tr>
    <th width="50">Mã</th>
    <th >Ngày</th>
    <th width="150">Điện Thoại</th>
    <th width="150">Họ Tên</th>
    <th width="150">Nội Dung</th>
    <th width="350">Link web người dùng xem</th>
    <th width="100">IP người dùng</th>
	<!--<th>Thao tác</th>-->
</tr>
<?php while ($row_loaisp = mysql_fetch_assoc($loaisp) ) { ?>
<?php ob_start(); ?>
<tr class="mau">    <td class="anhien">{id}</td>
        <td>{NgayGioDK}</td> 
        <td>{sdt}</td>
        <td>{hoten}</td>
        <td>{noidung}</td>
		<td>{linkweb}</td>
        <td>{IP}</td>        
		<!--<td width="100" align="center">
            <a class="smallButton" href="main.php?p=dk_chinh&id={id}"><img src="images/pencil.png" title="Ghi chú"></a>            
  		</td>-->
</tr>
<?php
$str = ob_get_clean();
$str = str_replace("{id}",$row_loaisp['idGY'],$str);
$str = str_replace("{sdt}",$row_loaisp['SDT'],$str);
$str = str_replace("{linkweb}",$row_loaisp['Link'],$str);
$str = str_replace("{NgayGioDK}",date("H:i:s --- d/m/Y",strtotime($row_loaisp['Ngay'])),$str);
$str = str_replace("{IP}",$row_loaisp['IP'],$str);
$str = str_replace("{noidung}",$row_loaisp['NoiDung'],$str);
$str = str_replace("{hoten}",$row_loaisp['HoTen'],$str);
echo $str;
?>
<?php } //while ?>
<?php if ($totalRows > $pageSize) { ?>
<tr>
  <td colspan="8" align="left">
   <p id=thanhphantrang>
  <?=$qt->pagesList($totalRows, $pageNum, $pageSize);?>
  </p>
    </td>
</tr>
<?php } ?>
</table>
<?php 
if($totalRows > 0){
	?>
<script type="text/javascript">
	window.onload = playSound;
    function playSound(){   
                document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="bing.mp3" type="audio/mpeg" /><embed hidden="true" autostart="true" loop="false" src="bing.mp3" /></audio>';
				setTimeout("refreshPage();", 20000);
    }
</script>
<div id="sound"></div>
    <?php
	}else{
	if($_GET['khongcapnhat']==""){
?>
<script type="text/javascript">    
window.onload = Refresh;
    function Refresh() {
        setTimeout("refreshPage();", 10000);
    }
</script>
<script type="text/javascript">    
    function refreshPage() {
        window.location = location.href;
    }
</script>
<?php
	}
}
?>