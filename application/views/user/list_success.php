<?php
$list_id='';
	if (!empty($list_details)) {
		$list_id=$list_details[0]['id'];
	}
?>
<style type="text/css">

</style>
<section id="about_page">
	<div class="top_abt_cont New-text">
		<div class="container">
			<div class="row">
				<div class="col-md-12 top_abt_inner">
					<div class="abt_content">				
						<h1>    <?php if (!empty($response)) {
							if ($response=='update') { ?>
								Listing Successfully  Updated
							<?php }else{  ?>
								Listing Successfully Added 
							<?php  }
						}else{  ?>
								Listing Successfully Added 
							<?php  } ?></h1>
						<div class="img-bdr"><img src="<?php echo base_url();?>assets/img/Border-on-bottom.png"></div>
							<p>Listing successfully added. Please click the below link to view all details of this listing. To add another listing please click on the Add another listing button.</p>

						<div class="button_holder">							
						    <div class="row">
						       	<div class="col-lg-6 col-md-6 col-sm-6">		
							        <a href="<?php echo base_url('list-details/'.$l_slug);?>" class="btn_design">Preview Listing</a>
							    </div>
							    <div class="col-lg-6 col-md-6 col-sm-6">
							         <a href="<?php echo base_url('sell');?>" >List Another Item</a>
								</div>
								<!-- <div class="col-lg-4 col-md-4 col-sm-4">					
									<a href="<?php //echo base_url('upload-video/'.$list_id);?>">Upload Video</a>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>