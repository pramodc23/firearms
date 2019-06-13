<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

	<?php 
phpinfo();
	?>
<form action="<?php echo base_url('user_action/file_test');?>" method="post" id="add_listing" enctype="multipart/form-data">
 <input type="file" class="file_input" id="file1" name="file1" accept=".jpg,.jpeg,.png">
<input type="submit" name="submit" value="submit">
</form>

<script>

</script>
</body>
</html>