<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');

?>
<body>
<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script type="text/javascript"> 
  $(document).ready(function(){
    $("#profile_menu").click(function(){    
      $("#menu_toggel").toggle();
    });
  });   
</script>
<style>
.msg-icon sup {
    background: #F3626A none repeat scroll 0 0;
    border-radius: 50%;
    color: #fff;
    font-size: 14px;
    padding: 10px 6px;
    top: 0px;
    position: absolute;
}

#profile_menu:focus {
   outline: none;
}


</style>
	<!--header section start-->
<section class="header-main">
<header>
<!--top header with category-->
<div class="top-header">
<div class="container">
<div class="top-menu col-md-6 profile_container">
  <?php if($isLoggedIn){    
    $user_details=get_loging_user_details($user_id); 
    if ($user_details->profile_image !='') {
      $profile_image=$user_details->profile_image;
    }else{
      $profile_image='user_profile.png';
    }

    $new_notifications = get_user_unread_message_counts($user_id);

  
  ?>
  
  

 <button type="button" class="" id="profile_menu" style="" ><img src="<?php echo base_url(); ?>assets/img/profile_image/<?php echo $profile_image;?>" class="img-responsive" height="35px" width="35px" style="border-radius: 50px;margin: 8px;"> <?php echo $user_details->first_name; ?></button>


  <ul class="sub-menu deatil_user" aria-labelledby="dLabel" id="menu_toggel" style="display: none;z-index:9999;">
    <li class="">
  <?php if ($new_notifications > 0) { ?>
<span class="message-show" style="margin-right: 10px;"><a href="<?php echo base_url('message');?>" class="msg-icon"><i class="fa fa-envelope-o" style="font-size: 20px;    float: none;     padding-right: 0px;
    margin-right: -5px;"></i> 
    <sup id="msg" class="msg_notification_header"><?php echo $new_notifications; ?></sup> 
</a></span>
 <?php } ?>

    <a href="<?php echo base_url('message');?>" >Message</a></li>
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url('profile');?>">Profile</a></li>
    <li><a href="<?php echo base_url('change-password');?>" >Change Password</a></li>
    <li><a href="<?php echo base_url('user/logout');?>" >Logout</a></li>


  </ul>


  <?php }else{?>
  
  <?php }?>
</div>
</div>
</div>
<!--top header with category end-->
<!--header main section-->
<div class="header">
<div class="container">
<!--header left section-->
<div class="head-left-section col-md-4">
<a href="<?php echo base_url(); ?>">
<img src="<?php echo base_url('assets/img/logo-new.png'); ?>"/>
</a>
</div>
<!--header left section end-->
<!--header right section-->
<div class="head-right-section col-md-8">
<form method="get" action="<?php echo base_url('buy');?>" id="header_search_form">
  <div class="search_category">
      <input name="search" placeholder="SEARCH"  type="text" id="search" <?php if(isset($_GET['search'])){echo 'value="'.$_GET['search'].'"';}?> />
        <span class="input-group-btn float-right" <?php if(isset($_GET['search'])){echo 'value="'.$_GET['search'].'"';}?> >
        <a id="header_search" style="cursor:pointer;"><img src="<?php echo base_url(); ?>assets/img/search-ic.png"></a>
      </span>
  </div>
</form>
<div class="float-md-right">
  <?php if(!$isLoggedIn){ ?>
  
  <a href="<?php echo base_url('sign-in');?>"><button type="button" class="btn sign-in">Sign In</button></a>
  <a href="<?php echo base_url('sign-up');?>"><button type="button" class="btn btn-primary register">Register</button></a>
 
<?php } ?>


</div>

</div>
      <i class="fa fa-bars" id="bringOut"></i>
      <div class="sidebar" id="sidebar">
        <div class="sidebar-lists">
          <ul class="lists">
            <li class="sidebar-items"> <i class="fa fa-close" id="takeIn"></i> </li>
            <div class="mb-brand-name"> <a href="<?php echo base_url();?>"> <img src="<?php echo base_url(); ?>assets/img/brand.png" width="144" height="53" alt="brand-name"> </a>
            </div>
            <div class="mb-navigation">
            <ul>
              <li class="mb_nav <?php if(isset($buy)){echo "mob_active";}?>"><a href="<?php echo base_url('buy');?>">BUY</a></li>
              <?php if($isLoggedIn && $UserType=='seller'){ ?>
              <li class="mb_nav <?php if(isset($sell)){echo "mob_active";}?>"><a href="<?php echo base_url('sell');?>">SELL</a></li>
              <?php } ?>
              <?php if($isLoggedIn){ ?>
              <li class="mb_nav <?php if(isset($network)){echo "mob_active";}?>"><a href="<?php echo base_url('network');?>">MY NETWORK</a></li>
              <?php } ?>
              <li class="mb_nav <?php if(isset($videos)){echo "mob_active";}?>"><a href="<?php echo base_url('videos');?>">VIDEOS</a></li>
              <li class="mb_nav <?php if(isset($about_us)){echo "mob_active";}?>"><a href="<?php echo base_url('about-us');?>">ABOUT US</a></li>
              <li class="mb_nav <?php if(isset($how_to_buy)){echo "mob_active";}?>"><a href="<?php echo base_url('how-to-buy');?>">HOW TO BUY</a></li>
              <?php //if($isLoggedIn && $UserType=='seller'){ ?>
             <li class="mb_nav <?php if(isset($how_to_sell)){echo "mob_active";}?>"><a href="<?php echo base_url('how-to-sell');?>">HOW TO SELL</a></li>
             <?php //} ?>
              <?php if($isLoggedIn){ ?>
              <li class="mb_nav <?php if(isset($message)){echo "mob_active";}?>"><a href="<?php echo base_url('message');?>">MESSAGE</a></li>
              <?php } ?>
            </ul>
            </div>
          </ul>
        </div>
      </div>
    </div>
</div>
<!--header right section end-->
</div>
</div>
<!--header main section end-->
</header>
</section>
<section class="category-section">
<div class="container">
    <div class="col-md-12">

        <div class="category-right">
          <ul>
            <li class="top-menu-item">
              <select name="menu_category" class="category_select" id="menu_category">
               <option value="">All category</option>
                <?php 
                $others = array();
                $sothers = array();
                $categories = new_get_categories();
                  foreach($categories as $cate){?>
                    <option value="<?php echo $cate->id;?>" <?php if(isset($menu_categories) && $menu_categories==$cate->id){
                      echo 'Selected'; echo " class='selected_right_btn'";}?>  ><?php echo $cate->name;?></option>
                
                  <?php 
                    $subcat1=$this->user_model->select_data('id,name','categories',array('parent_id'=>$cate->id, 'status' => 1),'',array('name','ASC'));
                     for($l=0;$l<count($subcat1);$l++)
                  {
                    if (strpos($subcat1[$l]['name'], 'Other') !== false) {
                      $others = $subcat1[$l];
                      unset($subcat1[$l]);
                       }
                  }
                  if(!empty($others))
                  {
                    array_push($subcat1,$others); 
                    unset($others);
                  }
                    foreach($subcat1 as $sub1){
                    ?>
                    <option value="<?php echo $sub1['id'];?>" <?php if(isset($menu_categories) && $menu_categories==$sub1['id']){
                      echo 'Selected'; echo " class='selected_right_btn'";}?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sub1['name'];?></option>
                    <?php 
                    $subcat2=$this->user_model->select_data('id,name','categories',array('parent_id'=>$sub1['id'],'status' => 1),'',array('name','ASC'));

                    for($m=0;$m<count($subcat2);$m++)
                  {
                    if (strpos($subcat2[$m]['name'], 'other') !== false || strpos($subcat2[$m]['name'], 'Other') !== false) {
                      $sothers = $subcat2[$m];
                      unset($subcat2[$m]);
                       }
                  }
                  if(!empty($sothers))
                  {
                    array_push($subcat2,$sothers);
                    unset($sothers); 
                  }
                    foreach($subcat2 as $sub2){
                    ?>
                    <option value="<?php echo $sub2['id'];?>" <?php if(isset($menu_categories) && $menu_categories==$sub2['id']){
                      echo 'Selected'; echo " class='selected_right_btn'";  }?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sub2['name']);?></option>
                    <?php } }  } ?>
              </select>
            </li>
          </ul>
        </div> 
    </div>
  </div>
  </section>
<div class="container">
  <nav class="navbar navbar-expand-sm bg-light navbar-light">
    <ul class="navbar-nav">
      
      <li class="menu-item <?php if(isset($buy)){echo "menu-active";}?>"><a  href="<?php echo base_url('buy');?>">BUY</a></li>
      <?php if(!$isLoggedIn || $UserType=='seller') { ?>
      <li class="menu-item <?php if(isset($sell)){echo "menu-active";}?>"><a  href="<?php echo base_url('sell');?>">SELL</a></li>
    <?php } ?>
      <?php  if($isLoggedIn){ ?>
      <li class="menu-item <?php if(isset($network)){echo "menu-active";}?>"><a  href="<?php echo base_url('network');?>">MY NETWORK</a></li>
      <?php } ?>
      <li class="menu-item <?php if(isset($videos)){echo "menu-active";}?>"><a  href="<?php echo base_url('videos');?>">VIDEOS</a></li>
      <li class="menu-item <?php if(isset($about_us)){echo "menu-active";}?>"><a  href="<?php echo base_url('about-us');?>">ABOUT US</a></li>
      <li class="menu-item <?php if(isset($how_to_buy)){echo "menu-active";}?>"><a  href="<?php echo base_url('how-to-buy');?>">HOW TO BUY</a></li>
      <?php //if($isLoggedIn && $UserType=='seller'){
       ?>
      <li class="menu-item <?php if(isset($how_to_sell)){echo "menu-active";}?>"><a  href="<?php echo base_url('how-to-sell');?>">HOW TO SELL</a></li>
      <?php //} ?>
      <?php  if($isLoggedIn){ ?>
      <li class="menu-item <?php if(isset($message)){echo "menu-active";}?>"><a  href="<?php echo base_url('message');?>">MESSAGE</a></li>
      <?php } ?>
    </ul>
  </nav>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('#menu_category').change(function () {
      
     var base_url= $('#base_url').val();  


      $categories_id= $('#menu_category').val();  
      if ($categories_id=='') {
        window.location.href=base_url+"buy";   
      }else{
        window.location.href=base_url+"buy/seller_id/"+$categories_id;   
      }   
      
    });     
  });    
</script>