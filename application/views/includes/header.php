<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$segment1= $this->uri->segment(1);
$segment2= $this->uri->segment(2);
if(isset($segment1) && isset($segment2) && $segment1=='list-details'){
	$list_details=get_lists_details($segment2);
	$lists_photo_details=get_lists_photo_details($list_details->id);
	$imginitialurl=base_url('assets/img/listing_photos');
	
	echo '<meta property="og:title" content="'.$list_details->title.'" />';
	echo '<meta property="og:description" content="'.$list_details->description.'" />';
	if(!empty($lists_photo_details->url))
	echo '<meta property="og:image" content="'.$imginitialurl.'/'.$lists_photo_details->url.'" />';
	//echo '<pre>';
	//print_r($lists_photo_details);
	//die();
}

?>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/ms-icon-310x310.png" type="image/x-icon"/>
<link href="https://fonts.googleapis.com/css?family=Lato|Varela+Round" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


<link href="<?php echo base_url(); ?>assets/css/bootstrap.css?v=5" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css?v=6" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<link href="<?php echo base_url(); ?>assets/css/owl.carousel.css?v=4" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/break-point.css?v=6" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/outer.css?v=4" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/slick.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!--<script src="<?php //echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>-->
<!-- <script src="<?php //echo base_url(); ?>assets/js/jquery-1.11.1.min.js" type="text/javascript"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js'></script>  
<script src='https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.js'></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.js" type="text/javascript"></script> 
<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script> -->
</head>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/f9e32bda9f.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js?v=<?php echo time(); ?>"></script>
<title>Firearms development : Online Gun Auction - Buy Guns at Firearms.network</title>
</head>
<input type="hidden" value="<?php echo base_url();?>" id="base_url">
<style type="text/css">
	select {cursor: pointer;}
	a {cursor: pointer;}
</style>
