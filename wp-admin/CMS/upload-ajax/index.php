<script type="text/javascript" src="upload-ajax/js/jquery.form.min.js"></script>
<script type="text/javascript">
$(document).ready(function() { 
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		

//function after succesful file upload (when server response)
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
	var file = $("input[name=n]").val();
	var type = $("input[name=t]").val();
	var id_dathen = $("input[name=id_dathen]").val();
	/*if($("#"+file).parent().find(".file_button").length == 0){
		$("#"+file).parent().append('<a class="smallButton file_button" id="'+id_dathen+'" href="#"><img src="upload-ajax/images/file.png" title="File"></a>')
	}*/
	$("#"+file).parent().find(".file_button").css("display","inline-block");
}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#FileInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'image/jpg':
			/*case 'text/plain':
			case 'text/html':
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':*/
			case 'application/msword':		
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':		
                break;
            default:
                $("#output").html("Không đúng dạng file !! Phải là file word nha");
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>5242880) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> File quá lớn !! Phải nhỏ hơn 5MB");
			return false
		}
				
		/*$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  */
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
	var fname = $('#FileInput')[0].files[0].name;
	var extension = fname.replace(/^.*\./, '');
	$("input[name=t]").val(extension);
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

	$(".upload_icon").click(function(){
		var flag = 1;
		var obj = this;
		/* check total.php */
		var id_dathen = $(this).attr("id_dathen");
		//var id_dathen = $("input[name=id_dathen]").val();
		$.get("upload-ajax/total.php?x="+(new Date()).getTime(),{id_dathen:id_dathen},function(data){
			if(data >7){ 
				alert("Chỉ được upload 8 file");
				return false;		
			}
			else{
				$(".loading").css("display","block").animate({"background-color":"rgba(0,0,0,0.6)"});
				$("#upload-wrapper").css("display","block").animate({"opacity":1},500);
			}
		})
			$("#output").html("");	
			var id = $(this).attr("id");
			var id_dathen = $(this).attr("id_dathen");
			$("input[name=n]").val(id);
			$("input[name=id_dathen]").val(id_dathen);
		return false;
	});
	$(".file_button").on("click",function(){
		$(".loading").css("display","block").animate({"background-color":"rgba(0,0,0,0.6)"});
		var id = $(this).attr("id");
		$(".upload_view").css("display","block").animate({"opacity":1},500,function(){
			$.post("upload-ajax/view.php?x="+(new Date()).getTime(),{id:id},function(data){
				$(".upload_view").html(data);
			})
		});
		return false;
	});
	$(".loading, .close").click(function(){
		$(".loading").animate({"background-color":"rgba(0,0,0,0)"},function(){
			$(this).css("display","none");
		});
		$("#upload-wrapper").animate({"opacity":0},300,function(){
			$(this).css("display","none");
		});
		$(".upload_view").animate({"opacity":0},300,function(){
			$(this).css("display","none");
		});
		return false;
	});

}); 

</script>
<link href="upload-ajax/style/style.css" rel="stylesheet" type="text/css">
<div id="upload-wrapper">
<div align="center">
<form action="upload-ajax/processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
<input name="FileInput" id="FileInput" type="file" />
<input type="submit"  id="submit-btn" value="Upload" />
<input type="hidden" name="n" />
<input type="hidden" name="t" />
<input type="hidden" name="id_dathen" />
<img src="upload-ajax/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
<a class="close" href="#"><img src="upload-ajax/images/close.png" /></a>
</form>
<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
<div id="output"></div>
</div>
</div>

<style>
.loading{width:100%;height:100%;position:fixed;left:0;top:0;right:0;bottom:0;margin:auto;background-color:rgba(0,0,0,0);z-index:30;display:none}
.upload_view{background-color:#fff;position:fixed;top:0;left:0;bottom:0;right:0;margin:auto;width:60%;height:70%;padding:3%;display:none;opacity:0;z-index:31}
</style>
<div class="loading"></div>
<div class="upload_view">
	
</div>