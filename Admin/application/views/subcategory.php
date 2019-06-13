<?php if(!empty($subcat)){ 
	
	?>
    <div class="form-group delete_row <?php echo $first_parent;?> group_<?php echo $mange_sub_id;?>" >
        <label for="parent_cat">Sub Category </label>
        <select class="form-control require" class="sub_cat" id="sub_cat_<?php echo $mange_sub_id; ?>"  name="sub_cat[]" onchange="get_cat_change(<?php echo $mange_sub_id; ?>);">             
         	<option value="">Select Subcategory</option>                              
         	<?php    foreach ($subcat as $key => $value) {  ?>
            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
       		<?php } ?>
        </select>
    </div>
<?php }else{
	echo null;
	} ?>