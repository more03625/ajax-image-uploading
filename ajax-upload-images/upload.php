<?php 
	if ($_FILES['file']['name'] !== '') {
		$file_name = $_FILES['file']['name'];

		$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
		$valid_extensions =  array("jpg", "jpeg", "png", "gif");

		if (in_array($extension, $valid_extensions)) {
			$new_name = rand().".".$extension;
			$path = "images/".$new_name;

			if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
				echo '<img class="img-fluid mb-2" src="images/'.$new_name.'" style="border: 1px solid black; padding:8px;">
				<button class="btn btn-danger img-fluid" data-path="'.$path.'" id="delete_btn">Delete</button>';
			}
		}else{
			echo "<script>alert('This file format not supported')</script>";
		}

	}else{
		echo "<script>alert('please select image')</script>";
	}
 ?>