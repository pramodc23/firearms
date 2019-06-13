      <!--category bottom started-->
<div class="catergories_section_first col-md-12">
<div class="category_first_inner">
<div class="category_head">
<div class="cat_head">Top Brands</div>
</div>
<!--carousel start for product-->
<div class="cate_carousel top_brand_sec">
<div class="owl-carousel">
<!--carousel item start-->
  <div class="item top_brand">
    <a href="#">
<img src="<?php echo base_url(); ?>assets/img/product_img/01.png"></a>
<div class="carousel_content brand_inner_bottom">
<div class="product_head brand_2">
<a href="<?php echo base_url('home/list_details');?>">AR15 MFT Battlelink Utility 
Stock Comercial Spec</a>
<p class="pull-left">6H+</p>
<p class="pull-right">0 BIDS</p>
</div>
</div>
  </div>
  <!--carousel item End-->
  <!--carousel item start-->
  <div class="item top_brand">
    <a href="#">
<img src="<?php echo base_url(); ?>assets/img/product_img/07.jpg"></a>
<div class="carousel_content brand_inner_bottom">
<div class="product_head brand_2">
<a href="<?php echo base_url('home/list_details');?>">AR15 MFT Battlelink Utility 
Stock Comercial Spec</a>
<p class="pull-left">6H+</p>
<p class="pull-right">0 BIDS</p>
</div>
</div>
  </div>
  <!--carousel item End-->
  <!--carousel item start-->
  <div class="item top_brand">
    <a href="#">
<img src="<?php echo base_url(); ?>assets/img/product_img/08.jpg"></a>
<div class="carousel_content brand_inner_bottom">
<div class="product_head brand_2">
<a href="<?php echo base_url('home/list_details');?>">AR15 MFT Battlelink Utility 
Stock Comercial Spec</a>
<p class="pull-left">6H+</p>
<p class="pull-right">0 BIDS</p>
</div>
</div>
  </div>
  <!--carousel item End-->
  <!--carousel item start-->
  <div class="item top_brand">
    <a href="#">
<img src="<?php echo base_url(); ?>assets/img/product_img/09.jpg"></a>
<div class="carousel_content brand_inner_bottom">
<div class="product_head brand_2">
<a href="<?php echo base_url('home/list_details');?>">AR15 MFT Battlelink Utility 
Stock Comercial Spec</a>
<p class="pull-left">6H+</p>
<p class="pull-right">0 BIDS</p>
</div>
</div>
  </div>
  <!--carousel item End-->
  <!--carousel item start-->
  <div class="item top_brand">
    <a href="#">
<img src="<?php echo base_url(); ?>assets/img/product_img/07.jpg"></a>
<div class="carousel_content brand_inner_bottom">
<div class="product_head brand_2">
<a href="<?php echo base_url('home/list_details');?>">AR15 MFT Battlelink Utility 
Stock Comercial Spec</a>
<p class="pull-left">6H+</p>
<p class="pull-right">0 BIDS</p>
</div>
</div>
  </div>
  <!--carousel item End-->
  <!--carousel item start-->
  <div class="item top_brand">
    <a href="#">
<img src="<?php echo base_url(); ?>assets/img/product_img/09.jpg"></a>
<div class="carousel_content brand_inner_bottom">
<div class="product_head brand_2">
<a href="<?php echo base_url('home/list_details');?>">AR15 MFT Battlelink Utility 
Stock Comercial Spec</a>
<p class="pull-left">6H+</p>
<p class="pull-right">0 BIDS</p>
</div>
</div>
  </div>
  <!--carousel item End-->
</div>
</div>
<!--carousel End for product-->
</div>

</div>
<!--category bottom Ended-->
 <script>
$('.owl-carousel').owlCarousel({
  autoplay: false,
  autoplayHoverPause: true,
  loop: true,
  margin: 20,
  responsiveClass: true,
  nav: true,
  loop: false,
  responsive: {
    0: {
      items: 1
    },
    568: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
})
$(document).ready(function() {
  $('.popup-youtube, .popup-text').magnificPopup({
    disableOn: 320,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: true
  });
});
$(document).ready(function() {
  $('.popup-text').magnificPopup({
    type: 'inline',
    preloader: false,
    focus: '#name',
    callbacks: {
      beforeOpen: function() {
        if ($(window).width() < 700) {
          this.st.focus = false;
        } else {
          this.st.focus = '#name';
        }
      }
    }
  });
});
</script>