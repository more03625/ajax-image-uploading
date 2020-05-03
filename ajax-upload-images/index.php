<!DOCTYPE html>
<html>
<head>
	<title>Ajax Image Uploading</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row mt-2">
			<div class="col-md-6 mx-auto">
				<div id="content">
					<form id="submit_form">
					  <div class="custom-file mb-2">
					    <input type="file" class="custom-file-input mb-1" name="file" id="upload_file">
					    <label class="custom-file-label" for="upload_file">Choose file</label>
					    <small class="form-text text-info">Only jpg, png, jpeg & gif allowed</small>
					  </div>
					  <button type="submit" class="btn btn-primary mx-auto mt-3" name="upload_button" id="upload_btn">Submit</button>
					</form>
				</div>
				<div id="preview" class="mt-3">
					<h4>image preview</h4>
					<div id="image_preview"></div>
				</div>
			</div>
		</div>

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

 <!-- Add the following code if you want the name of the file appear on select -->
<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<!-- Ajax -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#submit_form").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this); // new way to send files to php file or db you
			$.ajax({
				url : "upload.php",
				type : "POST",
				data : formData,
// This for sending files
				contentType : false,
				processData : false, // now we are not sending data in String or object format that why false
				success: function(data){
					$("#preview").show();
					$("#image_preview").html(data);
					$("#upload_btn").val('');
				}
			});
		});
// Delete Image
		$(document).on("click", "#delete_btn", function(){
			if (confirm("are you sure you want to delete this?")) {
				var path = $("#delete_btn").data("path");
				$.ajax({
					url: "delete.php",
					type : "POST",
					data : {path : path},
					success : function(data){
						if (data !== '') {
							$("#preview").hide();
							$("#image_preview").html('');
						}else{
							alert("Unable to delete image");
						}
					}
				});
			}
		});
	});
</script>
</body>
</html>
