<?php
  require_once "checklogin.php";
  require_once "class_quantri.php";
  $qt =  new quantri;
  $id=$_GET['id']; settype($id,"int");
  $sanpham = $qt->ChiTietPA($id);
  $row_sanpham = mysql_fetch_assoc($sanpham);
  if (isset($_POST['btnOK'])==true){
    $qt ->SuaPA($id);
    header("location:main.php?p=pa_xem");
  }
?>
<script>
    $(document).ready(function() {
      hienthumb();
    });
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
<tr> <td colspan="2" align="center">SỬA PAGES</td> </tr>

<tr><td width="100">Tiêu Đề</td>
     <td><input type="text" name="TieuDe" id="TieuDe" value="<?php echo $row_sanpham['TieuDe'] ?>" /></td>
</tr>
<tr>
	<td width="100">Thuộc loại bài viết</td>
	<td>
		<select name="idGroup">
			<option <?php if($row_sanpham['idGroup'] == 1) echo "selected"?> value="1">Bài viết đơn</option>
			<option <?php if($row_sanpham['idGroup'] == 0) echo "selected"?> value="0">Tin tức hoạt động</option>
		</select>
	</td>
</tr>
<tr>
	<td>Hình ảnh</td>
	<td>
		<input name="UrlHinh" type=text class="txt" id="UrlHinh" value="<?php echo $row_sanpham['UrlHinh'] ?>" />
		 <input onclick="BrowseServer('hinhanh:/','UrlHinh')"  type="button" name="btnChonFile" id="btnChonFile" value="Chọn File" />
	</td>
</tr>

<tr><td width="100">Tóm tắt</td>
     <td><label>
       <textarea name="TomTat" id="TomTat" cols="45" rows="5"><?php echo $row_sanpham['TomTat'] ?></textarea>
     </label>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'TomTat',{
  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

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
<tr><td width="100">Nội Dung</td>
     <td><label>
       <textarea name="NoiDung" id="NoiDung" cols="45" rows="5"><?php echo $row_sanpham['NoiDung'] ?></textarea>
     </label>
     <script type="text/javascript">
var editor = CKEDITOR.replace( 'NoiDung',{
  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

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
     <td><input type="text" name="Title" id="Title" value="<?php echo $row_sanpham['Title'] ?>" /></td>
</tr>
<tr><td width="100">Description</td>
     <td><textarea name="Des" id="Des" cols="45" rows="5"><?php echo $row_sanpham['Des'] ?></textarea></td>
</tr>
<tr><td width="100">Keyword</td>
     <td><input type="text" name="Keyword" id="Keyword" value="<?php echo $row_sanpham['Keyword'] ?>" /></td>
</tr>

<tr><td colspan="2" align="center"><input type="submit" name="btnOK" id="btnOK" value="Sửa" />

</tr>
</table>
</form>
