<?php
require_once "class_quantri.php";
  $qt =  new quantri;
   if($_SESSION['tg_login_level']==0)
	  {
  $mangketqua = $qt->ThongKeNguoiDenKham($_SESSION['tg_login_id']);
	  }else
  		{
	   $mangketqua = $qt->ThongKeNguoiDenKham(-1);
		}
  
    // Set current date
	$date = date("Y-m-d");
	// Parse into a Unix timestamp
	$ts = strtotime($date);
	// Find the year and the current week
	$year = date('o', $ts);
	$week = date('W', $ts);
	
	for($i = 1; $i <= 7; $i++) { 
	$ts = strtotime($year.'W'.$week.$i); 
	$mangdathen[date("Y-m-d",$ts)]=0;
	$mangdenkham[date("Y-m-d",$ts)]=0; 
	
	if($i==1) $from= date("Y-m-d",$ts); 
	if($i==7) $to= date("Y-m-d",$ts);
	} 
	
	$mang3 = $mang4 = $mang5 = array();
	  if($_SESSION['tg_login_level']==0)
	  {
		$qt->ThongKe_Mang_NgayThangVaDatHen($_SESSION['tg_login_id'],$mangdathen,$from,$to);
	  	$qt->ThongKe_Mang_NgayThangVaNguoiKham($_SESSION['tg_login_id'],$mangdenkham,$from,$to);
		$qt->ThongKe_Mang_BenhDatHen($_SESSION['tg_login_id'],$mang3,$from,$to);
		$qt->ThongKe_Mang_GioiTinh($_SESSION['tg_login_id'],$mang4,$from,$to);
		$qt->ThongKe_Mang_Nguon($_SESSION['tg_login_id'],$mang5,$from,$to);
	  }
	  else
	  {
		  	$qt->ThongKe_Mang_NgayThangVaDatHen(-1,$mangdathen,$from,$to);
	  		$qt->ThongKe_Mang_NgayThangVaNguoiKham(-1,$mangdenkham,$from,$to);
			$qt->ThongKe_Mang_BenhDatHen(-1,$mang3,$from,$to);
			$qt->ThongKe_Mang_GioiTinh(-1,$mang4,$from,$to);
			$qt->ThongKe_Mang_Nguon(-1,$mang5,$from,$to);			
	  }
?>

<center>
  <h2><a href="main.php?p=dh_xem" style="color:#008ECE">BẢNG DỮ LIỆU KHÁCH HÀNG</a> / <a style="color:coral" href="main.php">THỐNG KÊ</a></h2>
</center>
<!--Load the AJAX API--> 
<!--<script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
<script type="text/javascript" src="js/jsapi"></script>
<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart); google.setOnLoadCallback(drawChart2);
	  google.setOnLoadCallback(drawChart3); google.setOnLoadCallback(drawChart4);
	  google.setOnLoadCallback(drawChart5);
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Đến Khám', <?php echo $mangketqua['denkham']; ?>],
          ['Chưa Đến', <?php echo $mangketqua['chuaden']; ?>]
        ]);

        // Set chart options
        var options = {'title':'Tỷ Lệ Người Đến Khám',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	  function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Ngày', 'Đặt Hẹn', 'Đến Khám'],
		<?php
		foreach($mangdenkham as $key=>$val){
			echo "['".date("d-m",strtotime($key))."',".$mangdathen[$key].",".$val."],";
		}
		?>
        ]);

        var options = {
          title: 'Người đến khám trong tuần',
          hAxis: {title: 'Ngày',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
	  function drawChart3() {
      var data = google.visualization.arrayToDataTable([
        ["Bệnh", "Số người", { role: "style" } ],
		<?php
		foreach($mang3 as $key=>$val){
			echo "['$key',$val,'green'],";
		}
		?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Số người đặt hẹn theo bệnh",
        width: 1200,
        height: 1200,
        bar: {groupWidth: "80%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  function drawChart4() {
      var data = google.visualization.arrayToDataTable([
        ["Bệnh", "Số người", { role: "style" } ],
		
		<?php
		foreach($mang4 as $key=>$val){
			echo "['$key',$val,'#3871CF'],";
		}
		?>	
		["Cột mốc", 1, '#3871CF'],	
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Phân theo giới tính",
        width: 600,
        height: 200,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values1"));
      chart.draw(view, options);
  }
  function drawChart5() {
      var data = google.visualization.arrayToDataTable([
        ["Nguồn", "Số người", { role: "style" } ],
		
		<?php
		foreach($mang5 as $key=>$val){
			echo "['$key',$val,'orange'],";
		}
		?>	
		["Cột mốc", 1, 'orange'],	
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Đặt hẹn đến từ nguồn",
        width: 600,
        height: 200,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values2"));
      chart.draw(view, options);
  }
  </script>
<table style="margin:auto">
  <tr>
    <td><div id="chart_div"></div></td>
    <td><div id="chart_div2" style="width: 600px; height: 300px;"></div></td>    
  </tr>
  <tr>
  <td colspan="2"><div id="barchart_values" style="width: 1200px;"></div></td>
  
  </tr>
  <tr>
  <td><div id="barchart_values1" ></div></td>
  <td><div id="barchart_values2" ></div></td>
  </tr>
</table>
<!--Div that will hold the pie chart--> 

