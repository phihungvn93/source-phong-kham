<?php
  require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt =  new quantri;
	
	if (isset($_POST['btnPreView'])==true)
	{
		$qt ->Preview();
		echo "<script>
		
			var params = [
			'height='+screen.height,
			'width='+screen.width,
			'fullscreen=yes'
			].join(',');
			
			var popup = window.open('".$_SESSION['base_url']."preview.html', 'popup_window', params); 
			popup.moveTo(0,0);
		
		</script>
        ";
	}
	
	if (isset($_POST['btnOK'])==true)
	{
		$qt ->ThemTT();
		header("location:main.php?p=tt_xem");
	}
?>
<?php $chungloai= $qt ->DanhMuc(-1,0); ?>
<script>

		function BrowseServer( startupPath, functionData ){
			var finder = new CKFinder();
			finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
			finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
			finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
			finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
			finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn
			finder.popup(); // Bật cửa sổ CKFinder
		} //BrowseServer

		function SetFileField( fileUrl, data ){
			document.getElementById( data["selectActionData"] ).value = fileUrl;
			hienthumb();
		}
		function ShowThumbnails( fileUrl, data ){
			var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
			document.getElementById( 'thumbnails' ).innerHTML +=
			'<div class="thumb">' +
			'<img src="' + fileUrl + '" />' +
			'<div class="caption">' +
			'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
			'</div>' +
			'</div>';
			document.getElementById( 'preview' ).style.display = "";
			return false; // nếu là true thì ckfinder sẽ tự đóng lại khi 1 file thumnail được chọn

		}
		function hienthumb(){
			var valu = $('#UrlHinh').val();
			if (valu != "") {
				var bien = "<img src='"+valu+"' width='150' height='150'>";
				$('#thumbnail').html(bien);
			};
		}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table border="1" align="center" cellpadding="4" cellspacing="0">
<tr> <td colspan="2" align="center">THÊM TIN TỨC BỆNH MỚI</td> </tr>

<tr>
     <td width="100">Chọn Loại</td>
     <td>
        <select id="idCL" loai="<?php echo $_POST['idLoai']; ?>" name="idCL">
                <option value="0">Chọn Thể Loại</option>
                <?php while ($row = mysql_fetch_assoc($chungloai)) { ?>
    				<option <?php if ($_POST['idCL'] == $row['idLoai']) echo "selected='selected'"; ?> value="<?php echo $row['idLoai'];?>"> <?php echo $row['TieuDe'];?> </option>
    			<?php } ?>
        </select>

         <script>
		 	$(document).ready(function() {
				$("#idCL").change(function(){
					var idTL = $(this).val(); //lấy idTL khi user chọn
					$('#idLoai').load("tt_layloai.php?idTL="+idTL);
				});
				$("#idLoai").change(function(){
					var idTL = $(this).val(); //lấy idTL khi user chọn
					$('#idCon').load("tt_layloai.php?idTL="+idTL);
				});
                $("#form1").submit(function(){
            		if($("#idCL").val()==0){alert('Chưa chọn thể loại!'); return false;}
            		//if($("#idLoai").val()==0){alert('Chưa chọn loại tin!'); return false;}
            	});
				 var bien = $("#idCL").val();
				 if(bien>0)
                $("#idLoai").load("tt_layloai.php?idTL="+bien,null, GanLoaiTin);
                //$("#idCon").load("tt_layloai.php?idTL="+bien,null, GanLoaiTin);
			});
			function GanLoaiTin() {
                var idLTC = $("#idCL").attr('loai');
                $("#idLoai").val(idLTC);
            }
		 </script>
         <select name="idLoai" id="idLoai">
            <option value="0"> Chọn Loại Tin </option>
          </select>
		  
		  <select name="idCon" id="idCon">
            <option value="0"> Chọn Loại Tin </option>
          </select>
     </td>
</tr>

<tr><td width="100">Tiêu Đề</td>
     <td><input name="TieuDe" type="text" id="TieuDe" value="<?php echo $_POST['TieuDe'] ?>" /></td>
</tr>
<tr><td width="100">Link</td>
     <td><input name="TieuDeKD" type="text" id="TieuDeKD" value="<?php echo $_POST['TieuDeKD'] ?>" /></td>
</tr>
<tr><td>Hình Ảnh</td>
     <td>
     <input name="UrlHinh" type=text class="txt" id="UrlHinh" value="<?php echo $_POST['UrlHinh'] ?>" />
      <label>

        <input onclick="BrowseServer('hinhanh:/','UrlHinh')"  type="button" name="btnChonFile" id="btnChonFile" value="Chọn File" />

      </label>
      <div style="clear: both"></div>
      <div id="thumbnail">

      </div>
    </td>
</tr>
<tr><td width="100">Tóm Tắt</td>
     <td><label>
       <textarea name="TomTat" id="TomTat" cols="45" rows="5"><?php echo $_POST['TomTat'] ?></textarea>
     </label>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'TomTat',{
  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	height: '150px',
  toolbar:[
  { name: 'basicstyles', items : [ 'Bold','Italic','Underline' , 'Image', 'Format'] },
  ]
});
</script>
     </td>
</tr>
<tr><td width="100">Nội Dung</td>
     <td><label>
       <textarea name="NoiDung" id="NoiDung" cols="45" rows="15"><?php echo $_POST['NoiDung'] ?></textarea>
     </label>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'NoiDung',{
  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
	height: '500px',
  toolbar:[
  { name: 'document', items : [ 'Source','-','Templates' ] },
  { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
  { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
  { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
        'HiddenField' ] },
  '/',
  { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
  { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
  '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
  { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
  { name: 'insert', items : [ 'Image','MediaEmbed','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
  '/',
  { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
  { name: 'colors', items : [ 'TextColor','BGColor' ] },
  { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
  ]
});
</script>
     </td>
</tr>

<tr><td width="100">Title</td>
    <td><input name="Title" type="text" id="Title" value="<?php echo $_POST['Title'] ?>" /></td>
</tr>
<tr><td width="100">Description</td>
    <td><textarea name="Des" id="Des" ><?php echo $_POST['Des'] ?></textarea></td>
</tr>
<tr><td width="100">Keyword</td>
    <td><input name="Keyword" type="text" id="Keyword" value="<?php echo $_POST['Keyword'] ?>" /></td>
</tr>
<tr><td width="100">Tags</td>
    <td><input name="Tags" type="text" id="Tags" value="<?php echo $_POST['Tags'] ?>" /></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="btnPreView" id="btnPreView" value="Xem thử" /> <input type="submit" name="btnOK" id="btnOK" value="Thêm" />
  <input type="reset" name="btnxoa" id="btnxoa" value="Làm lại" /></td>
</tr>
</table>
</form>
