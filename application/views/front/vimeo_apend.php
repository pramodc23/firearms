<?php


	if (!empty($space_responce)) {
		if (!empty($space_responce['upload']['upload_link'])) {
			 $upload_link=$space_responce['upload']['upload_link'];
		}else{
			 $upload_link='';
		}
	 ?>
		
	<form method="POST" action="<?php echo $upload_link; ?>" enctype="multipart/form-data">
	<label for="file">File:</label>
	<input type="file" name="file_data" id="file"><br>
	<input type="submit" name="submit" value="Submit">
	</form>

	<?php }else{
		echo "Some thing went wrong! Please try again after some time. ";
	}
?>