<? 
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idDH = $_GET['idLH'];
	settype($idDH,'int');
	$donhang = $qt->ChiTietDangKy($idDH);
	$row_donhang = mysql_fetch_assoc($donhang);
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
</style>
<table id="thongtin_nguoinhan" width="500">
    <tr>
        <th colspan="2">Thông Tin Liên Hệ</th>
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
        <td class="title">Triệu Chứng:</td>
        <td class="content"><?php echo $row_donhang['NoiDung']; ?></td>
    </tr>
</table>
    

