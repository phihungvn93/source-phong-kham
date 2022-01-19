<?php
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idDH = $_GET['idCH'];
	settype($idDH,'int');
	$donhang = $qt->ChiTietCauHoi($idDH);
	$row_donhang = mysql_fetch_assoc($donhang);
    if (isset($_POST['btnUpdate'])==true)
	{
		$qt->CapNhatCauHoi($idDH);
		header("location:main.php?p=ch_xem");
	}
?>
<?php $chungloai= $qt ->DanhMuc(-1, 0); ?>
<style>
    #form1 td{
        border-bottom: dashed 1px #000;
        padding: 5px;
    }
    #form1 td.title{
        border-right:  dashed 1px #000;
        border-left: dashed 1px #000;
    }
    #form1 td.title_top{
        border-top: dashed 1px #000;
    }
    #form1 td.content{
        border-right: dashed 1px #000;
    }
    #form1 input[type='text']{
        width: 600px;
        margin:0;
    }
    #form1 input[type='submit']{
        width: 80px;
        margin:0;
    }
    #form1 textarea{
        width:600px;
        height:200px;
        padding:5px;
    }
</style>
<form id="form1" name="form1" method="post" action="">
    <table id="thongtin_nguoinhan" width="800">
        <tr>
            <th colspan="2">Thông Tin Câu Hỏi</th>
        </tr>
        <tr>
            <td class="title title_top" width="97">Họ Tên: </td>
            <td class="content title_top" width="391"><?php echo $row_donhang['HoTen']; ?></td>
            
        </tr>
        <tr>
            <td class="title">Điện Thoại:</td>
            <td class="content"><?php echo $row_donhang['DienThoai']; ?></td>
        </tr>
        <tr>
            <td class="title">Email:</td>
            <td class="content"><?php echo $row_donhang['Email']; ?></td>
        </tr>
        <tr>
            <td class="title">Loại:</td>
            <td class="content">
                <select id="idCL" name="idCL"> 
                <option value="0">Chọn Thể Loại</option>
                <?php while ($row = mysql_fetch_assoc($chungloai)) { ?>                
    				<option <?php if ($row_donhang['idCL'] == $row['idLoai']) echo "selected='selected'"; ?> value="<?php echo $row['idLoai'];?>"> <?php echo $row['TieuDe'];?> </option>
    			<?php } ?>
        </select>
            </td>
        </tr>
        
        
        <tr>
            <td class="title">Tiêu đề:</td>
            <td class="content"><input type="text" name="TieuDeCH" id="TieuDeCH" value="<?=$row_donhang['TieuDeCH'];?>" /></td>
        </tr>
        <tr>
            <td class="title">Keyword:</td>
            <td class="content"><textarea name="KeywordCH" id="KeywordCH" cols="45" rows="5"><?=$row_donhang['KeywordCH'];?></textarea></td>
        </tr>
        <tr>
            <td class="title">Nội dung:</td>
     <td class="content">
        <label>
       <textarea name="NoiDungCH" id="NoiDungCH" cols="45" rows="5"><?php echo $row_donhang['NoiDungCH'];?></textarea>
   </label>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'NoiDungCH',{
  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

  toolbar:[
  { name: 'basicstyles', items : [ 'Bold','Italic','Underline' , 'Image', 'Format'] },
  ]
});
</script>
     </td>
        </tr>
            
        
        <tr>
            <td class="title">Ẩn hiện:</td>
            <td class="content">
                <input <?php if ($row_donhang['AnHien'] == 0 ) echo "checked='checked'"; ?> type="radio" name="AnHien" id="AnHien" value="0" /><span>Ẩn</span>
                <input <?php if ($row_donhang['AnHien'] == 1 ) echo "checked='checked'"; ?> type="radio" name="AnHien" id="AnHien" value="1" /><span>Hiện</span>
            </td>
        </tr>
        <tr>
            
            <td colspan="2">
                 <input type="submit" name="btnUpdate" id="btnUpdate" value="Update" />
            </td>
           
        </tr>
    </table>
</form>
<div style="clear: both; height: 10px; width:100%;"></div>
<p id="xemtrloi" idCH="<?php echo $idDH; ?>" style="cursor: pointer; color:#3E78FD;">Xem Trả Lời</p>
<script type="text/javascript">

    /*$(document).ready(function() {
        $("#xemtrloi").click(function(){
            var bien = 'idCH='+$(this).attr('idCH');            
            $("#hientrloi").load('tl_xem.php',bien);
        })
    
    });*/
        
</script>
<div id="hientrloi">
    <?php require "tl_xem.php"; ?>
</div>
    

