<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
     $(document).ready(function(){
        $("#list_btn").click(function(){
			$("#list").removeClass("hide");
			$("#list").addClass("show");
            $("#grid").addClass("hide");
        });

        $("#grid_btn").click(function(){
			$("#grid").removeClass("hide")
           $("#grid").addClass("show");
           $("#list").addClass("hide");
        });
     });
  </script>-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
<section id="category_section">
<div class="container">
  <div class="row">
  <div class="list-d-inner col-md-12">
      <div class="breadcrumb_section">
        <div class="bread-left-sec col-md-6"> <a href="#"><< Home &nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Firearms&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">Rifle</a> </div>
        <div class="bread-right_sec col-md-6">
          <div class="swicher_btn pull-right">
            <ul>
              <li><a class="switch_inactive" href="#">BUYER</a></li>
              <li><a class="switch_active"  href="#">SELLER</a></li>
            </ul>
          </div>
        </div>
      </div>
          </div>
  </div>
  </div>
      <section class="filter_main">
      <div class="container">
      <div class="row">
      <div class="filter_inner col-md-12">
      <div class="col-md-3 filter_lable"><label>SELECT CATEGORY</label><br/><select class="filter_select" style="-webkit-appearance: none;">
      <option>Air Gun</option>
      <option>Pistol</option>
      <option>Ammunition</option>
      <option>Gun Buds</option>
      </select>
      </div>
      <div class="col-md-3 filter_lable"><label>PRICE RANGE</label><br/>
      <input type="text" id="amount" readonly style="border:0;">
      <div id="range-slider">
      <div id="slider-range"></div>
</div>
      </div>
      <div class="col-md-3 filter_lable"><label>LISTING DETAIL</label><br/><select class="filter_select" style="-webkit-appearance: none;">
      <option>No Reserve</option>
      <option>Reserve</option>
      <option>Bid</option>
      </select>
      </div>
      <div class="col-md-3 filter_lable"><label>ITEM CONDITION</label><br/><select class="filter_select" style="-webkit-appearance: none;">
      <option>New Condition</option>
      <option>Old Condition</option>
      </select>
      </div>
      </div>
      </div>
      </div>
      <div class="container-fluid second_filter_main">
      <div class="container">
      <div class="row">
      <div class="sec_filter_inner col-md-12">
      <div class="col-md-2 filter_ic">
      <ul>
      <li class="grid_pre grid_btn"><a class="grid-button"><i class="fa fa-th" aria-hidden="true"></i></a><!--</li>-->
     <li class="grid_pre list_btn"><a class="list-button"><i class="fa fa-list" aria-hidden="true"></i></a><!--</li>-->
      </ul>
      </div>
      <div class="col-md-7 result-head"><span class="search_head">Result for ammunition</span>|<span class="result_des">Narrow your search. Over 10000 Items Found</span>
      </div>
      <div class="col-md-3 filter_lable sort_by"><select class="filter_select" style="-webkit-appearance: none;">
      <option>New Condition</option>
      <option>Old Condition</option>
      </select>
      </div>
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--section filter end-->
      <!--section grid view start-->
      <section id="grid_main">
      <div class="container">
      <div class="row">
      <div class="col-md-12 grid_inner">
      <div class="grid_content">
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/01.png" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/02.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">500 Rounds Fiocchi 40GR TMJ .22 MAG Magnum 22 WMR</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/03.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">1000 Rounds PMC X-TAC .223 5.56 FMJ 62GR GREEN TIP</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">600 Federal Green Tip 62gr 5.56 .223 ammo</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/05.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">600 Federal Green Tip 62gr 5.56 .223 ammo</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="clear"></div>
      <div class="col-md-2 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/06.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">Winchester Blind Side 12GA 3.5" 1-5/8oz #1 250Rd</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/07.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">Fiocchi Steel Golden 12GA 3.5" 1-5/8oz #1 250Rd</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/08.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">1000 Rounds PMC X-TAC .223 5.56 FMJ 62GR GREEN TIP</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/09.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">WWII Pre-War Nazi DSM-34 .22 Erma Mauser Trainer</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/03.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">NIB MINT Colt Single Action Cowboy - 45 - 5-1/2"</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="clear"></div>
      <div class="col-md-2 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/01.png" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/02.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">500 Rounds Fiocchi 40GR TMJ .22 MAG Magnum 22 WMR</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/03.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">1000 Rounds PMC X-TAC .223 5.56 FMJ 62GR GREEN TIP</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">600 Federal Green Tip 62gr 5.56 .223 ammo</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="col-md-2 col-sm-4 grid_col">
      <div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/05.jpg" id="display_primary"/></div>
      <div class="grid_pro_head"><a href="#">600 Federal Green Tip 62gr 5.56 .223 ammo</a></div>
      <div class="grid_pro_price"><span class="price_left pull-left"><b>Starting Bid</b><br/>$50.00</span><span class="bid_status pull-right">< 20m | 0 Bids</span></div>
      <div class="bottom_reserve"><span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span><span class="buy_btn_now pull-right"><a href="#">Buy Now !</a></span></div>
      </div>
      <div class="clear"></div>
      </div>
      <div class="spacer"></div>
      </div>
      </div>
      </div>
      </section>
      <!--section grid view End-->
      <section id="list_table">
      <div class="container">
      <div class="row">
      <div class="col-md-12 list_inner_item table-hover hide">
      <table class="Responsive-table" width="100%" border="1">
  <tr>
    <th scope="col">Image</th>
    <th scope="col">Title</th>
    <th scope="col">Starting Bid</th>
    <th scope="col">Bid Count</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
  <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/05.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">600 Federal Green Tip 62gr 5.56 .223 ammo</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/01.png" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/02.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">1000 Rounds PMC X-TAC .223 5.56 FMJ 62GR GREEN TIP</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/03.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">Winchester Blind Side 12GA 3.5" 1-5/8oz #1 250Rd</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">Fiocchi Steel Golden 12GA 3.5" 1-5/8oz #1 250Rd</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/07.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">WWII Pre-War Nazi DSM-34 .22 Erma Mauser Trainer</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/08.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/09.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/05.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/06.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">WWII Pre-War Nazi DSM-34 .22 Erma Mauser Trainer</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/02.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/01.png" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
   <tr>
    <td><div class="grid_img"><img class="display_section" src="<?php echo base_url(); ?>assets/img/09.jpg" id="display_primary"/></div></td>
    <td><div class="grid_pro_head"><a href="#">27mm Mauser BK-27 Cannon Ammo 5 ROUND BELT shell</a></div></td>
    <td><span class="price_left">$50.00</span></td>
    <td><div class="grid_pro_price"><span class="bid_status">< 20m | 0 Bids</span></div></td>
    <td><span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span></td>
    <td><span class="buy_btn_now"><a href="#">Buy Now !</a></span></td>
  </tr>
</table>
</div>
</div>
</div>
      </section>
	
</section>
<script>
// Range slider - gravity forms
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 1500,
      max: 10000,
      step: 100,
      values: [ 3000, 6000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );

</script>
<script>
$(document).ready(function(){
   $("#amount").click(function(){
       $("#range-slider").toggle();
   });
});
</script>
<script>
$(document).ready(function()
{
    $("body").mouseup(function(e)
    {
        var subject = $("#range-slider"); 

        if(e.target.id != subject.attr('id'))
        {
            subject.fadeOut();
        }
    });
});
</script>
<script>
$(".grid-button").click(function(){
    $(".grid_inner").removeClass("hide");
    $(".table-hover").addClass("show");
    $(".grid-button").addClass("current");
    $(".list-button").removeClass("current");
});

$(".list-button").click(function(){
    $(".table-hover").removeClass("show");
    $(".grid_inner").addClass("hide");
  $(".grid-button").removeClass("current");
    $(".list-button").addClass("current");
});

</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('.grid-button').click(function () {
                $('.table-hover').css('display', 'none');
            });
			$('.list-button').click(function () {
                $('.table-hover').css('display', 'block');
            });
        });
		
    </script>
