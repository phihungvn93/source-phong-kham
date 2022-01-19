<?php
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idDH = $_GET['idTL'];
	settype($idDH,'int');
	$donhang = $qt->ChiTietTraLoi($idDH);
	$row_donhang = mysql_fetch_assoc($donhang);
    if (isset($_POST['btnUpdate'])==true)
	{
		$qt->CapNhatTraLoi($idDH);
    ?>
		<script>
            window.close();
        </script>
<?php
	}
?>

<style>
    td{
        border-bottom: dashed 1px #000;
        padding: 5px;
    }
    td.title{
        border-right:  dashed 1px #000;
        border-left: dashed 1px #000;
    }
    td.title_top{
        border-top: dashed 1px #000;
    }
    td.content{
        border-right: dashed 1px #000;
    }
    input[type='text']{
        width: 600px;
        margin:0;
    }
    input[type='submit']{
        width: 80px;
        margin:0;
    }
    textarea{
        width:600px;
        height:200px;
        padding:5px;
    }
</style>
<form id="form1" name="form1" method="post" action="">
    <table id="thongtin_nguoinhan" width="800">
        <tr>
            <th colspan="2">Thông Tin Trả Lời</th>
        </tr>
        <tr>
            <td class="title title_top" width="97">Nội dung: </td>
            <td class="content title_top" width="391">
                <textarea name="NoiDungTL" id="NoiDungTL" cols="45" rows="5"><?=$row_donhang['NoiDungTL'];?></textarea>
                <script type="text/javascript">
                    var editor = CKEDITOR.replace( 'NoiDungTL',{
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
                <input <?php if ($row_donhang['AnHien'] == 0 ) echo "checked='checked'"; ?> type="radio" name="AnHien" id="0" value="0" /><span>Ẩn</span>
                <input <?php if ($row_donhang['AnHien'] == 1 ) echo "checked='checked'"; ?> type="radio" name="AnHien" id="1" value="1" /><span>Hiện</span>
            </td>
        </tr>
        <tr>
            
            <td colspan="2">
                 <input type="submit" name="btnUpdate" id="btnUpdate" value="Update" />
            </td>
           
        </tr>
    </table>
</form>


