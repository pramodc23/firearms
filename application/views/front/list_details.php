<!-- get jQuery from the google apis -->

<!-- CSS STYLE-->
<link href="<?php echo base_url(); ?>assets/css/gallery.css" rel="stylesheet" type="text/css">

<!-- XZOOM JQUERY PLUGIN  -->
<script src="<?php echo base_url(); ?>assets/js/gallery.js" type="text/javascript"></script>
<style>

.hide_div{
  visibility: hidden;
}
.disable_buynow{
  opacity: 0.7;
}
.swal-text{
  text-align: center;
}
.swal-footer {
  border-top: 2px solid #ddd;
}
.swal-button--cancel {
  color: #fff;
  background-color: rgba(47, 42, 42, 0.44);
}
.swal-button--danger {
  background-color: #ff6d00;
}

i#seller_fav {
  padding-left: 21px;
  cursor: pointer;
}

.large-image {
  height: 398px;
}
.display_err {
  color: red;
}
#bid_amount_valid{
  float: left;
  width: 100%;
  font-size: 13px;
  font-weight: 500;
}
.buynow_cls{
  color: #fff !important;
  background: #ff6d00;
  padding: 13px 0px;
  display: inline-block;
  border-radius: 5px;
  font-family: 'lato';
  text-align: center;
  width: 100%;
}
.fa-eye{
  left: 21px;
  top: 20px;
  display: block;
  font-size: 22px;
  color: #d4b15d;
  padding-left: 21px;
  cursor: pointer;
}
section #video_sec{
  float: left;
  width: 100%;
  margin-bottom: 20px;

}
iframe {height: auto;}

span.font_color {
  color: #312525;
  font-size: 13px;
}
.fbshare-out {
    text-align: center;
}
.fbshare-out img {
    width: 50%;
}
p.qtyerror {
    color: red;
}
.zoomContainer{z-index: 9999999;}

.slick-slide img {
    max-width: 100%;
    margin: 0 auto;
}
/*.owl-item {width: 380px!important;}*/
</style>
<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');
$session_id=$this->session->userdata('user_id');

$list_user_details=get_list_user_details($list_details[0]['user_id']);
?>
<section id="list-detail">
  <div class="container">
    <div class="row">
      <div class="list-d-inner col-md-12">
        <div class="breadcrumb_section">
          <div class="bread-left-sec col-md-6"><a href="<?php echo base_url();?>"><<<b>Home</b></a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="<?php echo base_url('buy');?>">All Item</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="<?php echo base_url();?>buy/catid_<?php echo $list_details[0]['categories'];?>"><?php echo $list_details[0]['name'];?></a>&nbsp;&nbsp;>&nbsp;&nbsp;<a class="active" href="<?php echo base_url('list-details/'.$list_details[0]['slug']);?>"><?php echo $list_details[0]['title'];?></a> </div>
          <div class="bread-right_sec col-md-6">
           <?php if($isLoggedIn){ ?>
            <div class="swicher_btn pull-right">
              <ul>
                <?php if($UserType=='seller'){ ?>
                  <li><a class="switch_active"  href="#">SELLER</a></li>
                <?php }elseif($UserType=='buyer'){ ?>
                  <li><a class="switch_active" href="#">BUYER</a></li>
                <?php }?> 
              </ul>
            </div>
          <?php }?>
        </div>
      </div>
      <div class="prod-top-sec">
        <div class="col-md-6 col-sm-3">
          <div class="slider_hold_main">
          <div class="slider_hold">
              <ul>
              <?php 
            if(!empty($photos)){
              foreach($photos as $photo){ ?>
              <li><a href="<?php echo base_url('assets/img/listing_photos/'.$photo['url']);?>" class="fanycbox" data-fancybox="images"><img src="<?php echo base_url('assets/img/listing_photos/'.$photo['url']);?>"/></a></li>
             <?php } }else{ ?>
              <li>
             <a href="<?php echo base_url('assets/img/listing_photos/image-not-found.jpg');?>" class="fanycbox" data-fancybox="images"><img src="<?php echo base_url('assets/img/listing_photos/image-not-found.jpg');?>"/></a>
             </li>
            <?php } ?>
              </ul>
          </div>
          <div class="slider_hold_thumb">
              <ul>
                <?php 
            if(!empty($photos)){
              foreach($photos as $photo){ ?>
                  <li><a href="javascript:void(0)"><img src="<?php echo base_url('assets/img/listing_photos/'.$photo['url']);?>"/></a></li>   

          <?php } }else{ ?>
              <li>
            <img src="<?php echo base_url('assets/img/listing_photos/image-not-found.jpg');?>"/>
             </li>
            <?php } ?>             
              </ul></div>

          </div>
          </div>
      
        <input type="hidden" value="<?php echo $list_details[0]['id'];?>" id="list_id">
        <input type="hidden" value="<?php echo $list_details[0]['user_id'];?>" id="list_user_id">
        <div class="col-md-6 col-sm-3"> 
          <div class="row">
            <div class="product-head col-md-12"><?php echo $list_details[0]['title'];?></div>

            <?php
            
            if ($list_user_details) {
              if ($list_user_details->first_name !='') {
                $list_user_name=$list_user_details->first_name;
                ?>
                <div class="product-head-seller col-md-12"><span class="font_color"> Seller Name -</span> <?php echo $list_user_name;?>


                <?php if($list_details[0]['user_id']!=$session_id){ ?>
                <div class="fc_text">
                  <a <?php if($isLoggedIn){echo 'class="fav_seller"';}else{echo 'href="'.base_url('sign-in/'.$list_details[0]['slug']).'"';}?>>
                    <?php if(isset($follower) && !empty($follower) && $follower[0]['status']==1){?>
                      <i class="fa fa-heart" id="seller_fav" aria-hidden="true"></i></a><span id="fav_seller_text">Remove Favorite Seller</span>
                    <?php }else{ ?>
                      <i class="fa fa-heart-o" id="seller_fav" aria-hidden="true"></i></a><span id="fav_seller_text">Add to Favorite Seller</span>
                    <?php }  ?>
                </div>
                <?php } ?>


                
                  <div class="fc_text fc_addtocart"><a href="<?php echo base_url(); ?>buy/seller_<?php echo $list_details[0]['user_id']?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Seller's Other Items</a></div>
                </div> 
              <?php } } ?> 

              <div class="selected" style="margin-top: -31px;">
                <?php   if (!empty($list_video)) { ?>
                  <section id="video_sec">     
                    <span style="float: right;">        
                      <iframe src="https://player.vimeo.com/video/<?php echo $list_video[0]['url'];?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=133127\" width="100%" height="200px" frameborder="0" title="Untitled" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>  
                    </span>     
                  </section>
                <?php } ?>
              </div>
              <div class="spl-txt-ph col-md-12 ">
                <?php if($isLoggedIn && $UserType=='buyer'){   ?>
                  <a class="add_watchlist">
                    <?php if(isset($watchlist) && !empty($watchlist) && $watchlist[0]['status']==1){?>
                      <i class="fa fa-eye" id="watchlist_id" aria-hidden="true"></i></a><span id="watchlist_span_id">Remove from watchlist</span>
                    <?php }else{ ?>
                      <i class="fa fa-eye" id="watchlist_id" aria-hidden="true"></i></a><span id="watchlist_span_id">Add to watchlist</span>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
              <div class="row" style="display: none">

               <?php if($list_details[0]['user_id']!=$session_id){ ?>
                <div class="col-md-6 fc_text" style="display: none">
                  <a <?php if($isLoggedIn){echo 'class="fav_seller"';}else{echo 'href="'.base_url('sign-in/'.$list_details[0]['slug']).'"';}?>>
                    <?php if(isset($follower) && !empty($follower) && $follower[0]['status']==1){?>
                      <i class="fa fa-heart" id="seller_fav" aria-hidden="true"></i></a><span id="fav_seller_text">Remove Favorite Seller</span>
                    <?php }else{ ?>
                      <i class="fa fa-heart-o" id="seller_fav" aria-hidden="true"></i></a><span id="fav_seller_text">Add to Favorite Seller</span>
                    <?php }  ?>
                  </div> 
                <?php } ?>

                <div class="col-md-6 fc_text" style="display: none"><a href="<?php echo base_url('buy/seller_'.$list_details[0]['user_id']);?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Seller's Other Items</a></div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12 con_text"><b><?php if($list_details[0]['item_condition']=='pre_owned'){echo 'Pre Owned';}else if($list_details[0]['item_condition']=='new'){echo 'New';}else{echo 'Old';}?></b> Condition FFL is <?php if($list_details[0]['FFL']==0){echo 'not'; } ?> required</div>
                <?php  if($isLoggedIn){     
                  if($list_details[0]['user_id']!=$session_id){

                    if ($list_user_details) {
                      if ($list_user_details->profile_image !='') {
                        $list_user_image=$list_user_details->profile_image;
                      }else{
                        $list_user_image='user_profile.png';
                      } ?>
                      <?php 
                     
                      $buyerinfo = get_loging_user_details($this->session->userdata['user_id']);
                      $sellersinfo = get_loging_user_details($list_details[0]['user_id']);
                      
                      ?>
                      <div class="col-md-6 col-sm-12 asked_question"> <a style="cursor:pointer;" id="ask_question" data-attr="<?php echo $list_details[0]['user_id'];?>" data-id="<?php echo $list_user_details->first_name;?>" data-prod-id="<?php echo $list_user_image;?>" data-userid="<?php echo $buyerinfo->first_name; ?>" data-useremail="<?php echo $buyerinfo->email_id;?>" data-selleremail="<?php echo $sellersinfo->email_id;?>" data-subject="<?php echo $list_details[0]['item_number'];?>" data-title="<?php echo $list_details[0]['title']; ?>">Ask Seller a Question </a></div>
                    <?php  }    }  }?>
                  </div>

                  <?php
                  $disabled='';
                  $disabled_class='';
                  $disabled_anchor_class='disable_anchor';
                  if(!$isLoggedIn || $UserType=='seller')
                  {
                    $disabled='disabled';
                    $disabled_class='disable_input';
                  	

                  }

                  $total_bid_count='';
                  if(!empty($bids)){ $total_bid_count=count($bids);}
                  if ($list_details[0]['type']=='2') {
                   
                    $buy_now_price= $list_details[0]['fixed_price'];
                    $remaing_quantity = $list_details[0]['remaing_quantity'];
                    $quantity= $list_details[0]['quantity'];
                    $buy_amount=amount_with_commission($buy_now_price);  
                    ?>
                    <!-- fixed price start -->   

                    <div class="col-md-12 pull-right  fixed-price-item">
                      <label class="fixed-price-heading"> Fixed auction checkout</label><br>
                      <div class="row ">   
                        <div class="col-md-6 pull-left bid-left-input">
                          <label>Quantity Available</label><br/>
                          <span id="qty_available_num"><?php  echo $remaing_quantity;?></span>
                        </div>  
                        <div class="col-md-6 pull-right bid-right-input">
                          <input class="<?php echo $disabled_class; ?>" <?php echo $disabled; ?> placeholder="Enter Qty*" name="quantity" id="quantity" type="text" data-quantity="<?php echo $remaing_quantity;?>" data-price="<?php echo $buy_amount;?>" class="floatnumbersOnly"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="qty_validation(this)"/>
                          <p class="qtyerror"></p>
                        </div>
                      </div> 

                      <div class="row ">   
                        <div class="col-md-6 pull-left bid-left-input">
                          <label>Unit Price</label><br/>
                          <span><?php echo number_format($buy_amount,2);?></span>
                        </div>  
                        <div class="col-md-6 pull-right buy_right_sec_out <?php echo $disabled_anchor_class; ?>">
                              <a id="disable_buynow_fixed_btn" <?php 
                     

                      if($isLoggedIn){ 
                        //check ffl
                        $ffl_status=$list_details[0]['FFL'];
                        $userdetails=get_loging_user_details($session_id);
                        $user_ffl=0;
                        $ffl_req='no';
                        
                        if ($userdetails->FFL_LGD=='yes') {
                          $user_ffl=1;
                        }
                        if ($user_ffl==0 && $ffl_status==1) {
                          $ffl_req='yes';
                        }
                        //check ffl end
                        if ($ffl_req=='yes') { ?>
                          onclick="ffl_req_error();" class="buynow_cls"
                        <?php }elseif ($UserType=='seller') { ?>
                          href="javascript:void(0)" onclick="seller_error();" class="buynow_cls"
                        <?php }else{ ?>
                         href="javascript:void(0)" onclick="buynow_list_for_fixed_type('<?php echo $buy_amount;?>','<?php echo $list_details[0]['slug'];?>','<?php echo $list_details[0]['id'];?>');" class="hb1 buynow_cls"
                       <?php  }?>
                     <?php }else{ ?>
                      href="<?php echo base_url('sign-in/'.$list_details[0]['slug']);?>"  class="disable_buynow buynow_cls"   <?php } ?>  >Buy Now</a>
                        </div>
                      </div> 
                    </div>
                    <!-- fixed price end -->                   

                  <?php }else{ ?>
                    <!-- auction start -->
                    <div class="auction_div" style="    ">
                    <div class="row current_div_list">
                      <div class="col-md-12 bid-main">
                       <?php 
                       if(!empty($bids)){
                        $bid_count=count($bids);
                      }
                      ?> 
                      <div class="col-md-4 bid-sec"><span class="bid-head">Current Bid</span><br/><span class="bid-price current_bid"><?php if(!empty($bids)){echo '$'.number_format($bids[$bid_count-1]['bid_amount'],2); }else{echo 'Na';}?></span></div>
                      <div class="col-md-4 bid-sec"><span class="bid-head">Minimum Bid</span><br/><span class="bid-price min_bid"><?php if(!empty($bids)){echo '$'.number_format($bids[0]['bid_amount'],2); }else{echo 'Na';}?></span></div>

                      <?php 
                      $start_amount=$list_details[0]['starting_bid'];
                      $amount=amount_with_commission($start_amount);
                      ?>
                      <div class="col-md-4 bid-sec" style="border:none;"><span class="bid-head">Starting Bid</span><br/><span class="bid-price">$<?php echo number_format($amount,2);?></span></div>
                    </div>
                  </div>
                 <!--  new bidnow -->
                      <div class="row bid_btn_main current_div_list">
                       <div class="col-md-12 bid-main">
                          <div class="input-group">
                     <span class="input-group-addon">$</span>
                      <input class="form-control currency_input number_only" placeholder="Enter Amount" name="bid_amount" id="bid_amount" type="text" >
                       <?php if($isLoggedIn && $UserType=='seller'){?>

                      <button class="btn btn-bid btn-bidnow" type="submit" name="action:Bid" style="cursor:pointer;" onclick="seller_error();">Bid</button>
                      <?php }else{ 
                        if($isLoggedIn){ 
                    //check ffl
                          $ffl_status=$list_details[0]['FFL'];

                          $userdetails=get_loging_user_details($session_id);
                          if ($userdetails->FFL_LGD=='yes') {
                            $user_ffl=1;
                          }else{
                            $user_ffl=0;
                          }
                          if ($user_ffl==0 && $ffl_status==1) {
                            $ffl_req='yes';
                          }else{
                            $ffl_req='no';
                          }
                    //check ffl end

                          if($list_details[0]['is_sold'] == 1){ ?>
                    <button class="btn btn-bid btn-bidnow" type="submit" name="action:Bid" style="cursor:pointer;" onclick="already_sold_error();">Bid</button>
                          <?php  }elseif ($ffl_req=='yes') { ?>
                            <button class="btn btn-bid btn-bidnow" type="submit" name="action:Bid" style="cursor:pointer;" onclick="ffl_req_error();">Bid</button>
                            <?php }else{ ?>
                              <button class="btn btn-bid btn-bidnow" type="submit" name="action:Bid" id="submit_bid" style="cursor:pointer;">Bid</button>
                              <?php } ?>                      
                      <?php  }else{
                        ?>
                        <a class="btn btn-bid btn-bidnow" href="<?php echo base_url('sign-in/')?>/<?php echo $list_details[0]['slug']; ?>">
                          <button class="btn btn-bid btn-bidnow" type="submit" name="action:Bid" style="cursor:pointer;">Bid</button>
                        </a>
                         <?php   }  ?>             
                    <?php }?> 
                      </span>
                      <span class="display_err" id="bid_amount_valid"></span>
                      </div>
                      </div>
                       </div>

                    <input type="hidden" name="list_item_id" id="list_item_id" value="<?php echo $list_details[0]['id'];?>">

                    <?php  if($list_details[0]['is_sold']=='0'){                        
                      if($list_details[0]['buy_now_price']=='0.00'){ 
                      }else{                     
                    ?>    
                    <label id="immediate_lable"> Immediate checkout</label><br/>                   
                    <div class="row buynowborder">
                        <?php
                   
                      $buy_now_price= $list_details[0]['buy_now_price'];
                      $buy_amount=amount_with_commission($buy_now_price);      
                      if ($total_bid_count > 0 ) { ?>

                        <script>
                          $(document).ready(function(){
                            $('#immediate_lable').addClass("hide_div");
                          });
                        </script>
                        <div class="col-xs-6 col-md-6 buy-box ">
                          <div class="label">Buy Now Price</div>
                          <div class="value"><?php echo number_format($buy_amount,2);?></div>
                        </div>
                     
                      <div class="col-xs-6 col-md-6 wrapper_div">
                        <button class="btn btn-buy btn-block buyNowButton disable_buynow" type="submit" name="BuyNow" id="buyNowButton" onclick="buy_start_error();">Buy Now</button>
                      </div>
                    <?php }elseif($isLoggedIn && $UserType=='seller'){          
                        ?>
                        <div class="col-xs-6 col-md-6 buy-box ">
                          <div class="label">Buy Now Price</div>
                          <div class="value"><?php echo number_format($buy_amount,2);?></div>
                          </div>
                        <div class="col-xs-6 col-md-6 wrapper_div">
                       <button class="btn btn-buy btn-block buyNowButton disable_buynow" type="submit" name="BuyNow" id="buyNowButton" onclick="seller_buy_error();">Buy Now</button>
                     </div>
                    <?php }else{ ?>
                      <div class="col-xs-6 col-md-6 buy-box ">
                          <div class="label">Buy Now Price</div>
                          <div class="value"><?php echo number_format($buy_amount,2);?></div>
                          </div>
                      <div class="col-xs-6 col-md-6 wrapper_div">
                      <a <?php if($isLoggedIn){ 

                          if ($ffl_req=='yes') { ?>
                            onclick="ffl_req_error();"
                          <?php }else{ ?>
                           href="javascript:void(0)" onclick="buynow_list('<?php echo $buy_amount;?>','<?php echo $list_details[0]['slug'];?>');" class="hb1"
                         <?php  }?>

                       <?php }else{ ?>
          
                        href="<?php echo base_url('sign-in/'.$list_details[0]['slug']);?>"  class="disable_buynow hb1"  <?php } ?> ><button class="btn btn-buy btn-block buyNowButton " type="submit" name="BuyNow" id="buyNowButton">Buy Now</button></a>
                        </div>
                        <a onclick="buy_start_error();" class="disable_buynow sb1" style="display:none;" ><button class="btn btn-buy btn-block buyNowButton " type="submit" name="BuyNow" id="buyNowButton">Buy Now</button></a>
                      <?php } ?>                   
                    </div>  

                     <?php  } }else{ ?>

                      <div class="row ">
                        <div class="col-xs-12 col-md-12">
                          <button class="btn btn-buy btn-block buyNowButton">Sold</button>
                        </div>
                      </div>  

                    <?php } ?> 


                     <!--  new bidnow -->

                <div class="row bid_history_main">
                  <div class="col-md-6 pull-left res_bid_his">
                    <?php
                    $current_price=0;
                    if(!empty($bids)){
                     $current_price=$bids[$bid_count-1]['bid_amount']; 
                   }
                   $reserve_price=$list_details[0]['reserve_price'];

                   if ($reserve_price==0) {
                    echo "No Reserve";
                  }else{
                    if($current_price < $reserve_price ){
                      ?>
                      <span id="res_no_met">Reserve Not Met</span>
                    <?php }else{ ?>
                     <span id="res_met">Reserve Met</span>
                   <?php  }

                 }
                 ?>

               </div>

               <div class="col-md-6 pull-right res_bid_his"><span class="bid_count"><?php if(!empty($bids)){echo $bid_count;}else{echo 'No';}?> Bids</span><span class="bid_his">Bid History</span></div>
             </div>
             <div class="row time_counter">
              <div class="col-md-6 pull-left res_bid_his"><span class="time_counting">Time Left</span><br/><span class="date_rem" id="demo"></span></div>
              <div class="col-md-6 pull-right res_bid_his"><span class="time_counting">Ending Time</span><br/><span class="date_rem"><?php echo date('d M Y h:i A',strtotime($list_details[0]['end_auction']));?></span></div>
            </div>
            <!-- auction conditon end -->
          <?php } ?>  
        </div>
         </div>
        <?php if(($list_details[0]['user_id']==$session_id) && ($list_details[0]['status'] !='sold') ){          
          if($list_details[0]['type']=='2') {
            //check for fixed item
            $quantity=$list_details[0]['quantity'];
            $remaing_quantity=$list_details[0]['remaing_quantity'];

            if($quantity==$remaing_quantity){
              $show_update_btn="yes";
            }else{
              $show_update_btn="no";
            }

          }else{
            //check for Auction item
            $c_date=strtotime(date('M d, Y H:i:s'));
            $e_auction=strtotime($list_details[0]['end_auction']);
            if ($c_date > $e_auction) {
              $l_status= "expired";
            }else{
              $l_status= "notexpired"; 
            }

            if ($l_status != "expired"  && ($total_bid_count=='' || $total_bid_count=='0') ) {
              $show_update_btn="yes";
            }else{
              $show_update_btn="no";
            }
          }

          


        if ($show_update_btn=="yes") {  ?>
          <div class="join_btn pull-right" style="padding-right: 15px;"><a style="cursor:pointer; color:white;" href="<?php echo base_url(); ?>sell/<?php echo  $list_details[0]['slug'];?>" >Update List</a></div>
        <?php  }else{   ?>
          <div class="join_btn pull-right" style="padding-right: 15px;"><a style="cursor:pointer; color:white;"  href="<?php echo base_url(); ?>user_action/update_list_image/<?php echo  $list_details[0]['id'];?>">Upload Image</a></div>
        <?php } 


      } ?>



      <?php if($isLoggedIn){?>
        <div class="join_btn pull-right" style="padding-right: 15px;"><a style="cursor:pointer; color:white;" id="single_share" data-attr="<?php echo $list_details[0]['id'];?>">SHARE</a></div>
      <?php } ?>
   
      </div>
    <section id="pro_btm_main_sec">
      <div class="container">
        <div class="pro_btm_sec_main">
          <div class="row">
            <div class="col-md-12 pro_btm_des">
              <div class="col-md-6 pro_left_des_sec">
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Item</div>
                  <div class="col-md-8 pro_description"># <?php echo $list_details[0]['item_number'];?></div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Location</div>
                  <div class="col-md-8 pro_description"><?php
                  if($list_details[0]['country'] != ''){
                    echo ucfirst($list_details[0]['country']); 
                    if($list_details[0]['item_location'] !=''){
                      ?> (<?php echo $list_details[0]['item_location'];?>) <?php
                    }

                  }else{
                    echo "Not Available";
                  }

                  ?></div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Shipping</div>
                  <div class="col-md-8 pro_description"><?php echo $list_details[0]['shipping_class'];?></div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Payment</div>
                  <div class="col-md-8 pro_description"><?php echo $list_details[0]['shipping_method'];?></div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Checkout</div>
                  <div class="col-md-8 pro_description">Yes, Immediate</div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Sales Tax</div>
                  <div class="col-md-8 pro_description">Seller does not collect sales tax</div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-4 pro_label">Inspection/ Return Policy</div>
                  <div class="col-md-8 pro_description">Unspecified</div>
                </div>
                <div class="row pro_des_content">
                  <div class="col-md-12 pro_description">The seller of this item assumes all responsibility for this listing. You must contact the seller to resolve any questions or concerns before placing a bid. Payment must be made using U.S. dollars ($). Complete your purchase within the law.</div>
                </div>
              </div>
              <div class="col-md-6 pro_right_add_sec">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/Layer-6.jpg"/>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="row tab_des_section">
      <div class="col-md-12">
        <div id="tab_nav">
         <ul>
          <li><a href="index.html">Videos</a></li>
          <li><a href="index.html">Item Description</a></li>
          <li class="selected"><a href="index.html">Additional Terms of Sale</a></li>
          <li><a href="index.html">Item Characteristics</a></li>
        </ul>
        <div>

          <?php   if (!empty($list_video)) { ?>
            <section id="video_sec">     

              <?php foreach ($list_video as  $value) {  ?> 
                <span style="float: left;">        
                 <iframe src="https://player.vimeo.com/video/<?php echo $value['url'];?>?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=133127\" width="100%" height="200px" frameborder="0" title="Untitled" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>                       
               </span>     
             <?php  } ?>                     
           </section>
         <?php  }else{ ?>
           No video present
         <?php } ?> 

       </div>
       <div>
        <p><?php echo $list_details[0]['description'];?></p>
      </div>

      <div>
        <p><?php
                if($list_details[0]['additional_terms_of_sale'] !=''){
                  echo $list_details[0]['additional_terms_of_sale'];
               }else{
                  echo 'Seller provided no "Additional Terms of Sale"';
                    }
      ?></p>
      </div>
      <div>
        <p>We are your best resource for listing, selling and buying firearms. Our auction site caters to manufacturers, dealers, collectors, shooters and  hunters. You can buy or sell pistols, rifles,shotguns,antique guns and  Class 3 firearms. We offer a unique feature that allows you to add videos to your profile. This helps our goal of having a true network for firearm ownership, selling and buying. Oursiteis safe and secure.</p>
      </div>
    </div>
  </div>
</div>
<!--category bottom started-->
<?php if(!empty($listings)){?>
  <div class="catergories_section_first col-md-12">
    <div class="category_first_inner">
      <div class="pro_cat_head">More Items from <?php echo $list_details[0]['name'];?></div>
      <!--carousel start for product-->
      <div class="cate_carousel top_brand_sec">
        <div class="owl-carousel">
          <?php foreach($listings as $list){
            $thumb_image=get_thumb_image($list['id']);

            if (!empty($thumb_image)) {
              $thumb_list_img = $thumb_image->url;
            }else{
              $thumb_list_img ='image-not-found.jpg';
            }


            ?>
            <!--carousel item start-->
            <div class="item top_brand">
              <a href="<?php echo base_url('list-details/'.$list['slug']);?>">         
                <img src="<?php echo base_url('assets/img/listing_photos/thumb/'.$thumb_list_img); ?>">

              </a>
              <div class="like_section">
                <div class="like_ic"><a <?php if($isLoggedIn){echo 'class="like_list"'; }else{ echo 'href="'.base_url('sign-in/'.$list['slug']).'"'; } ?> id="<?php echo $list['id'];?>"><i class="fa fa-heart-o icon" aria-hidden="true" <?php if($isLoggedIn && $list['like_status']==1){echo 'style="color:red;"';}?>></i></a></div>
              </div>
              <div class="carousel_content brand_inner_bottom">
                <div class="product_head brand_2">
                  <a href="<?php echo base_url('home/list_details/'.$list['slug']);?>"><?php echo $list['title'];?></a>
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
            <!--carousel item End-->
          <?php } ?>
        </div>
      </div>
      <!--carousel End for product-->
    </div>
  </div>
<?php } ?>
<!--category bottom Ended-->
</div>
</div>
</div>

<?php 
$current_date = date('M d, Y H:i:s');
$end_date = date('M d, Y H:i:s',strtotime($list_details[0]['end_auction']));
?>
<script type="text/javascript">
  $(document).ready(function(){

    var qtyvalue = parseInt($('#qty_available_num').text());

    if(qtyvalue == 0)
    {
        $("#disable_buynow_fixed_btn").html("Sold");
        $("#disable_buynow_fixed_btn").attr("disabled", "disabled"); 
        $("#quantity").attr("disabled", "disabled"); 
    }

  });

</script>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $end_date;?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date("<?php echo $current_date;?>").getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    if(days>0 && hours>0){
      document.getElementById("demo").innerHTML = days + "d " + hours + 'h +';
    }else if(days<=0 && hours>0 && minutes>0){
      document.getElementById("demo").innerHTML = hours + "h "+ minutes + 'm +';
    }else if(days<=0 && hours<=0 && minutes>0 && seconds>0){
      document.getElementById("demo").innerHTML = minutes + "m "+ seconds + 's +';
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds>0){
      document.getElementById("demo").innerHTML = seconds + "s";
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds<=0){

      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
      // if($)
      //   $(".disable_buynow").prop("onclick", null);
      // $("#bid_amount").prop('disabled', true);
    }
  }, 1000);
</script>

</section>
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
<script>

  $('.container-gallery').gallery({
   height: '35vw',
   items: 6,
   thumbHeight: '10vw',
   showThumbnails: true,
   singleLine: true,
   0: {
    height: 200,
    items: 2,
    thumbHeight: 50
  },
  320: {
    height: 300,
    items: 3,
    thumbHeight: 70
  },
  480: {
    height: 300,
    thumbHeight: 100,
    items: 3

  },
  600: {
    height: 398,
    items: 4
  },
  768: {

				//showThumbnails: false,
				items: 4
				//height: 300,
				//thumbHeight: 50
			},
			

		});
		/*$('.container-gal').gallery({
			height: '35vw',
			items: 6,
			thumbHeight: 100,
			showThumbnails: true,
			singleLine: true,
			320: {
				items: 1
			},
			480: {
				items: 2,
				//height: 250,
				//thumbHeight: 60
			},
			768: {
				
				items: 4,
				//height: 300,
				//thumbHeight: 90
			},
			600: {
				
				items: 3
			},
			992: {
				
				items: 5,
				//height: 300
			}

		});*/

	</script>
  <script>
    $(document).ready(function(){


	//Select the first tab and div by default	
	$('#tab_nav > ul > li > a').eq(0).addClass( "selected" );
	$('#tab_nav > div').eq(0).addClass( "selected" );


  //EVENT DELEGATION
	//This assigns an onclick event listener to the UL tag.
  //Then it checks what A tag was selected.			
  $('#tab_nav > ul').on('click','a',function(){

    var aElement = $('#tab_nav > ul > li > a');
    var divContent = $('#tab_nav > div');

    /*Handle Tab Nav*/
    aElement.removeClass( "selected");
    $(this).addClass( "selected");

    /*Handle Tab Content*/
    var clicked_index = aElement.index(this);
    divContent.css('display','none');
    divContent.eq(clicked_index).css('display','block');

    $(this).blur();
    return false;

  });


});//end ready
</script>

<script type="text/javascript"> 
  function already_sold_error(){       
    swal( "Oops" ,  "This item already sold !" ,  "error" );
  }
  function ffl_req_error(){       
    swal( "Oops" ,  "FFL licensed required for bid on this item !" ,  "error" );
  }
  
  function seller_error(){       
    swal( "Oops" ,  "You have logged in as a seller account so can't bid on list item!" ,  "error" );
  }
  function seller_buy_error(){       
    swal( "Oops" ,  "You have logged in as a seller account so can't buy on list item!" ,  "error" );
  }
  function buy_start_error(){       
    swal( "Oops" ,  "You cannot buy now because bid already started on this item!" ,  "error" );
  }
</script>
<?php 
$chk_segment=$this->uri->segment(3);
$list_slug=$this->uri->segment(2);

if (!empty($chk_segment) && $list_details[0]['type']==1) { 
  if (preg_match('/^[0-9]+(.[0-9]+)?$/', $chk_segment)){
    ?>
    <script type="text/javascript">
      $(document).ready(function(){
        buynow_list('<?php echo $chk_segment;?>','<?php echo $list_slug; ?>');
      });
    </script>
  <?php } }
  ?>

  <script type="text/javascript">
    function buynow_list($id,$list_slug) {
      var url = $(location).attr('href');
// //var fn = url.split('/').reverse()[0];
var segment_count = url.split("/").length - 1 - (url.indexOf("http://")==-1?0:2);


swal({
  title: "Are you sure?",
  text: "You want to buy this item directly at $"+$id+". \n If you confirm then you will win this item and will have to pay this amount to the seller.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    var list_id = $('#list_item_id').val();
    $.post("<?php echo base_url("user_action/buynow_list"); ?>", {list_id:list_id}, function(result){ 

      if (result=='Success') {
        swal("Item buy Successfully!", {
          icon: "success",
        });
      }else{
        swal("Something went wrong!", {
          icon: "error",
        });
      }
      window.location.replace("<?php echo base_url();?>list-details/"+$list_slug);
    });

  } else {
                // swal("Student is safe!");
              }
            });
}


function buynow_list_for_fixed_type($price,$list_slug,$id)
{
  
  var url = $(location).attr('href');
  // //var fn = url.split('/').reverse()[0];
  var segment_count = url.split("/").length - 1 - (url.indexOf("http://")==-1?0:2);
  var qtyselected=parseInt($('#quantity').val());
  var totalamt=qtyselected*$price;

  swal({
    title: "Are you sure?",
    text: "You want to buy this item directly at $"+totalamt+". \n If you confirm then you will win this item and will have to pay this amount to the seller.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      var list_id = $id;
    // var hidden_fixed_price = $price;
    $.post("<?php echo base_url("user_action/buynow_list_for_fixed_type"); ?>", {list_id:list_id,qtyselected:qtyselected}, function(result){ 
      if (result=='Success') {
        //$("#disable_buynow_fixed_btn").html("Sold");
        //$("#disable_buynow_fixed_btn").attr("disabled", "disabled"); 
        swal("Item Purchased Successfully!", {
          icon: "success",
        });
        $('#quantity').val('');
        setTimeout(function(){ location.reload(); }, 3000);
        
      }else{
        swal("Something went wrong!", {
          icon: "error",
        });
      }
      // window.location.replace("<?php //echo base_url();?>list-details/"+$list_slug);
    });

  } else {
                // swal("Student is safe!");
              }
            });

}


</script>


<script type="text/javascript">
  $( document ).ready(function() { 
    $('.slider_hold ul').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1500,
        arrows:false,
        asNavFor: '.slider_hold_thumb ul'
     })
    $('.slider_hold_thumb ul').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      speed: 1500,
      arrows:false,
      asNavFor: '.slider_hold ul',
      focusOnSelect:true,
    })
    $('.fanycbox').fancybox({
      arrows: true,
      infobar: false,
      loop: true,
      infobar: false,
      afterClose : function(){
        $('.zoomContainer').remove();
      },
      afterShow : function(){
        $('.zoomContainer').remove();
        $('.fancybox-image').elevateZoom({
          zoomType: "inner",
          zoomWindowFadeIn: 500,
          zoomWindowFadeOut: 750
        });
       }
      });      
  });
</script>

