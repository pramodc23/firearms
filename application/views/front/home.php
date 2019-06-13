
<style type="text/css">
 .tabBox {
  box-shadow: 0px 0px 22px -20px;
/*   width: 100%; */
  border: 1px solid #cccccc;
  height: 376px;
  overflow-y: scroll;
  overflow-x: hidden;
  }

.hideSeekTab {
  cursor: pointer;
  /*border-bottom: 1px solid #eee;*/
  background-color: white;
  text-align: center;
}

.labelBox {
      height: 45px;
  border-bottom: 4px solid #eee;
      white-space: pre-wrap;
  position: relative;
  display: flex;
  padding: 0 8px 0 16px;
  align-items: center;
  justify-content: space-between;
}

.iconBox {
  position: relative;
  height: 40px;
  transition: transform .4s;
}

.line {
    margin: auto;
    display: block;
    width: 19px;
    height: 2px;
    background: #f96c04;
    position: absolute;
    top: 20px;
}

.left {
      right: 8px;
  transform: rotate(180deg);
}
.iconBox.closed span.line.right {
    display: none;
}
.right {
  right: 9px;
  transform: rotate(90deg);
}

.iconBox.closed {
  transform: rotate(0deg);
}

h3.title {
 margin: 0px;
  text-align: left;
  color: grey;
  font-weight: 200;
  color: #444;
   text-transform: uppercase;
  font-size: 14px;
  font-family: 'lato'
}

p.text {
  font-weight: 200;
  color: #1d1d1b;
  display: none;
  padding: 0 16px;
  text-align: left;
  line-height: 1.5;
  opacity: 0;
  transition: opacity .7s;
}

p.text.open {
   opacity: 1;
    display: block;
    padding-left: 36px;
    font-family: lato;
    font-size: 16px;
    color: #f96c04;

}

.iconBox_hide {
  display: none;
  margin-top: -40px;
}

.fa.fa-heart {
    /* left: 21px; */
    top: 20px;
    /* padding-left: 21px; */
    color: red !important;
}
.fa.fa-heart-o:hover,.fa.fa-heart:hover {
   /* transition: 0.9s; */
   /*transform: rotateY(180deg);*/
    /* font-size: 20px !important; */
    }


    .heart {
  width: 70px;
  height: 70px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  background: url(https://cssanimation.rocks/images/posts/steps/heart.png) no-repeat;
  background-position: 0 0;
  cursor: pointer;
  animation: fave-heart 1s steps(28);
}
.heart:active {
  background-position: -2800px 0;
  transition: background 1s steps(28);
}
@keyframes fave-heart {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -2800px 0;
  }
}

</style>
<?php
 $base_url=base_url();
 $onerrorimage=$base_url."assets/img/listing_photos/thumb/image-not-found.jpg";
?>
<!--header end section-->
<section class="content_section">
<div class="container">
<!--slider section with widget-->
<div class="slider_section">
<!--slider left section category widget-->
<div class="left_cate_widget col-md-3">
<div class="widget_head"><i class="fa fa-list" aria-hidden="true"></i> CATEGORIES</div>
<section class="tabBox">
    <?php 
    foreach($categories as $cate){?>
        <div>
          <?php $sub_cat = $this->user_model->select_data('id,name,slug','categories',array('parent_id'=>$cate['id']),'',array('name','ASC'));?>
          <div class="hideSeekTab" id="hideSeekTab_<?php echo $cate['id']; ?>">
              <div class="labelBox">
                  <h3 class="title"><?php echo $cate['name'];?></h3>
                  <?php if(!empty($sub_cat)){?>
                    <div class="iconBox first_icon">
                      <span class="line left"></span>
                      <span class="line right"></span>
                    </div>
                  <?php } ?>
              </div>
          </div>    
          <?php 
            $others = array();
            $sothers = array();
          if(!empty($sub_cat)){
                 
                  for($i=0;$i<count($sub_cat);$i++)
                  {
                    if (strpos($sub_cat[$i]['name'], 'Other') !== false) {
                      $others = $sub_cat[$i];
                      unset($sub_cat[$i]);
                       }
                  }
                  if(!empty($others))
                  {
                    array_push($sub_cat,$others);
                    unset($others); 
                  }
                  foreach($sub_cat as $s_cate){
                   // print_r($s_cate);
                   
                  $ss_cat= $this->user_model->select_data('id,name,slug','categories',array('parent_id'=>$s_cate['id'],'status' => 1),'',array('name','ASC'));
          ?>
                    <div class="hideSeekTab" id="hideSeekTab_<?php echo $s_cate['id']; ?>" data-attr="<?php echo 'hideSeekTab_'.$cate['id']; ?>">
                      <p class="text hideSeekTab_p <?php echo 'hideSeekTab_'.$cate['id']; ?>"><?php echo $s_cate['name'];?></p>
                      <?php if(!empty($ss_cat)){?>
                      <div class="iconBox iconBox_hide">
                        <span class="line left"></span>
                        <span class="line right"></span>
                      </div>
                    <?php } ?>
                  </div>

                  <?php if(!empty($ss_cat)){

                    for($i=0;$i<count($ss_cat);$i++)
                  {
                    if (strpos($ss_cat[$i]['name'], 'other') !== false || strpos($ss_cat[$i]['name'], 'Other') !== false) {
                      $sothers = $ss_cat[$i];
                      unset($ss_cat[$i]);
                       }
                  }
                  if(!empty($sothers))
                  {
                    array_push($ss_cat,$sothers); 
                    unset($sothers); 
                  }
                    foreach($ss_cat as $sss_cat){
                      
                  ?>
                  <p style="padding-left: 68px;" class="text hideSeekTab_p <?php echo 'hideSeekTab_'.$s_cate['id']; ?>"><?php echo ucfirst($sss_cat['name']);?></p>
                  <?php } }?>
          <?php } }?>
        </div>
    <?php } ?>
</section>
</div>
<!--slider left section category widget end-->
<!--slider right section and content start-->
<div class="right_slider_sec col-md-9">
<div class="slider_inner col-md-8">
<div class="CSSgal">

  <!-- Don't wrap targets in parent -->
  <s id="s1"></s> 
  <s id="s2"></s>
  <s id="s3"></s>
  <s id="s4"></s>

  <div class="slider">
    <div style="background:#5b8;">
      <img src="<?php echo base_url(); ?>assets/img/slide_01.jpg"/>
    </div>
    <div style="background:#85b;">
      <img src="<?php echo base_url(); ?>assets/img/slide_02.png"/>
    </div>
    <div style="background:#e95;">
      <img src="<?php echo base_url(); ?>assets/img/slide_03.png"/>
    </div>
    <div style="background:#e59;">
      <img src="<?php echo base_url(); ?>assets/img/slide_04.png"/>
    </div>
  </div>
  
  <div class="prevNext">
  <div><a href="#s4"><i class="fa fa-angle-left" aria-hidden="true"></i></a><a href="#s2"><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
    <div><a href="#s1"><i class="fa fa-angle-left" aria-hidden="true"></i></a><a href="#s3"><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
    <div><a href="#s2"><i class="fa fa-angle-left" aria-hidden="true"></i></a><a href="#s4"><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
    <div><a href="#s3"><i class="fa fa-angle-left" aria-hidden="true"></i></a><a href="#s1"><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
    
  </div>
</div>
</div>
<div class="col-md-4 slider_content">
<div class="slid_cont_inner">
<div class="slide_head">What is The<br />
<span style="color:#ff6d00;"> Firearms Network?</span></div>
<div class="slide_text">We are your best resource for buying and selling firearms. Our auction site caters to collectors,
shooters, hunters, dealers and manufacturers. You can buy or sell pistols, rifles, shotguns,
antique guns, curio and relics plus Class 3 firearms.<br>
We offer unique features that allow you to create your own profile page to which you can add
videos, instant message sellers and other profiles, share content and purchase guns using a
video checkout. This helps our goal of having a true network for firearm enthusiast.<br>
From the manufacturer to the dealers, to the retail customer for buying and selling firearms, we
have connected every area of the firearms industry in one website.
</div>
<?php if($this->session->userdata('isLoggedIn')){ ?>
<div class="join_btn" style="height: 50px;"></div>
<?php }else{?>
<div class="join_btn"><a href="<?php echo base_url('sign-up');?>">SIGN UP HERE!</a></div>
<?php } ?>
</div>
</div>
</div>
<!--slider right section and content end-->
</div>
<!--slider section with widget end-->
<!--video section start-->
<div class="video section col-md-12">
<div class="col-md-6" style="display: inline-block;padding-left: 0px;">
  <div class="left-video-sec" style="margin-bottom: 20px;">
<div class="video-head">how to buy a gun</div>
<span>Want to buy a gun?</span>
  <p>Learn how to bid on and buy firearms and accessories on Firearms.network in our detailed buyer's tutorial.</p>
<div class="learn_btn"><a href="<?php echo base_url('how-to-buy');?>">LEARN MORE!</a></div>
</div>
  <div class="left-video-sec">
<div class="video-head">how to Sell a gun</div>
<span>Want to sell a gun?</span>
  <p>Learn how to list guns for sale on Firearms.network and start making money today.</p>
<div class="learn_btn"><a href="<?php echo base_url('how-to-sell');?>">LEARN MORE!</a></div>
</div>
</div>
<div class="col-md-6 right-video-sec">
<iframe width="100%" height="auto" src="https://www.youtube.com/embed/r7krlrcGtms" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
</div>
<!--video section end-->


<!--category section start-->
<div class="catergories_section_first col-md-12">
<div class="category_first_inner">
 <?php if(!empty($listings)){?> 
<div class="category_head">
<div class="cat_head">Ending Soon</div>
</div>
<!--carousel start for product-->
<div class="cate_carousel">
<div id="owl-one" class="owl-carousel">
<!--carousel item start-->
<?php 
foreach($listings as $list){

  $thumb_image=get_thumb_image($list['id']);

      if (!empty($thumb_image)) {
        $thumb_list_img = $thumb_image->url;
      }else{
        $thumb_list_img ='image-not-found.jpg';
      }

  ?>
<div class="item">
  <a href="<?php echo base_url('list-details/'.$list['slug']);?>">
 
  <img src="<?php echo base_url('assets/img/listing_photos/thumb/'.$thumb_list_img); ?>" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'">

  </a>
  <div class="like_section">
    <div class="like_ic">
      <a style="cursor:pointer;" <?php if($this->session->userdata('isLoggedIn')){echo 'class="like_list"'; }else{ echo 'href="'.base_url('sign-in/home').'"'; } ?> id="<?php echo $list['id'];?>">

       <?php if($this->session->userdata('isLoggedIn') && in_array($list['id'], $user_liked_data) )
        {
          
              echo '<i class="fa fa-heart icon " aria-hidden="true" style="display: inline-block;    font-size: inherit;"></i>';
          
        }else{ 
           echo '<i class="fa fa-heart-o icon " aria-hidden="true" style="display: inline-block;    font-size: inherit;"></i>';
        } ?>  
       
      </a>
    </div>
  </div>
  <div class="carousel_content">
    <div class="product_head">
      <a href="<?php echo base_url('list-details/'.$list['slug']);?>"><?php echo $list['title'];?></a>
      <p class="pull-left">
        <?php 
        $start_date = date('Y-m-d H:i:s');
        $end_date = $list['end_auction'];
        $start_date_seasonal_price = strtotime($start_date);
        $end_date_seasonal_price = strtotime($end_date);
        $datediff = $end_date_seasonal_price - $start_date_seasonal_price;
        $day_counter = floor($datediff / (60 * 60 * 24));
        $hrs_counter = floor(($datediff % (60 * 60 * 24))/(60*60));
        $minutes_counter = floor(($datediff % (60 * 60))/(60));
        $seconds_counter = floor($datediff % (60 * 60));

          if($day_counter>0){
            echo $day_counter.'D+';
          }else if($day_counter<=0 && $hrs_counter>0){
            echo $hrs_counter.'H+';
          }if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter>0){
            echo $minutes_counter.'M+';
          }if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter<=0 && $seconds_counter>0){
            echo '<'.$seconds_counter.'S';
          }else if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter<=0 && $seconds_counter<=0){
            echo 'Expired';
          }
          ?>
      </p>
      <p class="pull-right">
        <?php $bid_count=$this->user_model->aggregate_data('bid','id','COUNT',array('list_id'=>$list['id']));
        echo $bid_count;?> BIDS 
      </p>
    </div>
    <a href="<?php echo base_url('list-details/'.$list['slug']);?>"><div class="pro_price"><span>$<?php echo $list['buy_now_price'];?></span></div></a>
  </div>
</div>
<?php } ?>
<!--carousel item End-->

</div>
<div class="load_btn"><a href="<?php echo base_url('buy');?>">Load More</a></div>
</div>
<?php } ?>
<!--carousel End for product-->

<div class="ad_banner col-md-12">
<div class="col-md-6 banner_left">
<a href="<?php echo base_url(); ?>buy"><img src="<?php echo base_url(); ?>assets/img/banner_01.jpg" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'"/></a>
</div>
<div class="col-md-6 banner_right">
<a href="<?php echo base_url(); ?>buy"><img src="<?php echo base_url(); ?>assets/img/banner_02.jpg" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'"/></a>
</div>
</div>
</div>
</div>
<!--category section End-->


<!--category bottom started-->
<?php if(!empty($listings)){?>
<div class="catergories_section_first col-md-12">
<div class="category_first_inner">
  <div class="category_head">
  <?php if(count($most_popular) > 0){ ?>
  <div class="cat_head">Most Popular (auctions)</div>
  <?php } ?>
  </div>
<!--carousel start for product-->
<div class="cate_carousel top_brand_sec">
<div id="owl-two" class="owl-carousel home_bottom">

<!--carousel item start-->
  <?php 


  foreach($most_popular as $list){ 

    $thumb_image=get_thumb_image($list['id']);

      if (!empty($thumb_image)) {
        $thumb_list_img = $thumb_image->url;
      }else{
        $thumb_list_img ='image-not-found.jpg';
      }


    ?>
  <div class="item top_brand">
    <a href="<?php echo base_url('list-details/'.$list['slug']);?>">
      <img src="<?php echo base_url('assets/img/listing_photos/thumb/'.$thumb_list_img); ?>" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'">    
    </a>
    <div class="like_section">
      <div class="like_ic">
      <a <?php if($this->session->userdata('isLoggedIn')){echo 'class="like_list"'; }else{ echo 'href="'.base_url('sign-in/home').'"'; } ?> id="<?php echo $list['id'];?>">

       <?php if($this->session->userdata('isLoggedIn') && in_array($list['id'], $user_liked_data) )
        {
          
              echo '<i class="fa fa-heart icon" aria-hidden="true" style="display: inline-block;    font-size: inherit;"></i>';
          
        }else{ 
           echo '<i class="fa fa-heart-o icon" aria-hidden="true" style="display: inline-block;    font-size: inherit;"></i>';
        } ?> 


      </a>
      </div>
    </div> 
    <div class="carousel_content brand_inner_bottom">
      <div class="product_head brand_2">
        <a href="<?php echo base_url('list-details/'.$list['slug']);?>"><?php echo $list['title'];?></a>
        <p class="pull-left">
          <?php 
        $start_date = date('Y-m-d H:i:s');
        $end_date = $list['end_auction'];
        $start_date_seasonal_price = strtotime($start_date);
        $end_date_seasonal_price = strtotime($end_date);
        $datediff = $end_date_seasonal_price - $start_date_seasonal_price;
        $day_counter = floor($datediff / (60 * 60 * 24));
        $hrs_counter = floor(($datediff % (60 * 60 * 24))/(60*60));
        $minutes_counter = floor(($datediff % (60 * 60))/(60));
        $seconds_counter = floor($datediff % (60 * 60));

          if($day_counter>0){
            echo $day_counter.'D+';
          }else if($day_counter<=0 && $hrs_counter>0){
            echo $hrs_counter.'H+';
          }if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter>0){
            echo $minutes_counter.'M+';
          }if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter<=0 && $seconds_counter>0){
            echo '<'.$seconds_counter.'S';
          }else if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter<=0 && $seconds_counter<=0){
            echo 'Expired';
          }
          ?>
        </p>
        <p class="pull-right">
          <?php $bid_count=$this->user_model->aggregate_data('bid','id','COUNT',array('list_id'=>$list['id']));
          echo $bid_count;?> BIDS
        </p>
      </div>
    </div>
  </div>
  <?php } ?>
  <!--carousel item End-->
 
</div>
</div>
<!--carousel End for product-->
</div>
</div>
<?php } ?>
<!--category bottom Ended-->
</div>
</section>

<script type="text/javascript">
$(function() {
  // when a tab is clicked   
  $('.hideSeekTab').on('click', function() {
    // if the one you clicked is open,      
    var id = $(this).attr('id');
    var data_attr = $(this).attr('data-attr');
    if ($('.'+id).hasClass('open')) {
      // then close it.
      $('.hideSeekTab .open').slideToggle().removeClass('open');
      $('.hideSeekTab_p.open').slideToggle().removeClass('open');
      $('.iconBox').removeClass('closed');
      $(this).parent().find('.iconBox_hide').css('display','none');
      // otherwise,
    } else {
      // close all tabs,
      $('.hideSeekTab .open').slideToggle().removeClass('open');
      $('.hideSeekTab_p.open').slideToggle().removeClass('open');
      $('.iconBox_hide').css('display','none');

      // and open the one you clicked
      $('.'+id).slideToggle().addClass('open');
      $('.'+data_attr).slideToggle().addClass('open');
      $('.iconBox').removeClass('closed');
      $(this).parent().find('.first_icon').addClass('closed');
      $(this).find('.iconBox').addClass('closed');
      $(this).parent().find('.iconBox_hide').css('display','block');
    }
  });
});
</script>
<script>
  $('.owl-carousel').owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    autoplaySpeed: 3000,
    loop: true,
    margin: 20,
    responsiveClass: true,
    nav: true,
    loop: true,
    responsive: {
      0: {
        items: 1
      },
      568: {
        items: 2
      },
      600: {
        items: 2
      },
      1000: {
        items: 5
      }
    }
  })
</script>
