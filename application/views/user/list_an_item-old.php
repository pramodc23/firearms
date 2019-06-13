<style>
	.display_err{
		color:red;
	}
	/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #ff6d00;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}
#regForm {
  background-color: #ffffff;
  margin: 0px auto;
  font-family: Raleway;
  width: 100%;
  min-width: 300px;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
	
</style>
<div id="regForm">
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#" class="active">Select a Category &nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Describe Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Add Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Review Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Preview Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a> </div>
            <div class="bread-right_sec col-md-6">
              <div class="swicher_btn pull-right">
                <ul>
                  <li><a class="switch_inactive" href="#">BUYER</a></li>
                  <li><a class="switch_active"  href="#">SELLER</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <ul class="tabBlock-tabs">
                <li class="tabBlock-tab is-active first"><span>BROWSE CATEGORY</span>
                  <p>Lorme Ipsum dollar</p>
                </li>
                <li class="tabBlock-tab second"><span>FIND CATEGORY</span>
                  <p>Lorme Ipsum dollar</p>
                </li>
              </ul>
              <div class="tabBlock-content">
                <div class="tab-content-head">List an Item :: Select a Category</div>
                <div class="tab-content-inner main-con">
                  <p>One of the most important steps for your listing on Firearms.com is to select the single best category for your item. This is the category your item will appear in when people search and browse for items.</p>
                  <p>We offer multiple ways to help you find the right category. Choose your method by selecting the tab below:</p>
                  <ul>
                    <li><span style="color: #ff6d00;font-weight: bold;">Browse</span> – lets you look through the category tree to select a category. The tree can be expanded or collapse to ease your viewing.</li>
                    <li><span style="color: #ff6d00;font-weight: bold;">Find</span> – suggests categories that contain items with keywords similar to what you enter.</li>
                  </ul>
                  <p>Once you select a category the category path will display along with the description of that category to help ensure that you selected the proper category for your item. </p>
                </div>
                <div class="tabBlock-pane">
                  <div class="tab-content-inner">
                    <div class="category_view">
                      <ul class="archive_year checktree">
                        <li id="years">
                          <input id="president" type="checkbox" />
                          <label for="president">Air Gun</label>
                        </li>
                        <ul class="archive_month">
                          <li id="months">
                            <input id="president" type="checkbox" />
                            <label for="president">Air Pistol</label>
                          </li>
                          <ul class="archive_posts">
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Air Rifles</label>
                            </li>
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Airsoft</label>
                            </li>
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Paintball Guns</label>
                            </li>
                          </ul>
                          <li id="months">
                            <input id="president" type="checkbox" />
                            <label for="president">Air Gun Accessories</label>
                          </li>
                          <ul class="archive_posts">
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Air Pistol</label>
                            </li>
                          </ul>
                        </ul>
                      </ul>
                      <ul class="archive_year checktree">
                        <li id="years">
                          <input id="president" type="checkbox" />
                          <label for="president">Ammuniation</label>
                        </li>
                        <ul class="archive_month">
                          <li id="months">
                            <input id="president" type="checkbox" />
                            <label for="president">Rifle Beg</label>
                          </li>
                          <ul class="archive_posts">
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Shotgun</label>
                            </li>
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Bullet</label>
                            </li>
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">.25 Caliber</label>
                            </li>
                          </ul>
                          <li id="months">
                            <input id="president" type="checkbox" />
                            <label for="president">Air Gun Accessories</label>
                          </li>
                          <ul class="archive_posts">
                            <li id="posts">
                              <input id="president" type="checkbox" />
                              <label for="president">Mouser</label>
                            </li>
                          </ul>
                        </ul>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tabBlock-pane">
                  <div class="search_category">
<input name="search" placeholder="SEARCH CATEGORIES" type="text">
</div>
                </div>
              </div>
            </figure>
          </div>
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>
<!--full-list-form-start-->
<!--second step all section-->
<div class="tab second-full-sec">
<section class="content_section sign-in">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Select a Category &nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">Describe Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Add Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Review Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Preview Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a> </div>
            <div class="bread-right_sec col-md-6">
              <div class="swicher_btn pull-right">
                <ul>
                  <li><a class="switch_inactive" href="#">BUYER</a></li>
                  <li><a class="switch_active"  href="#">SELLER</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <div class="tabBlock-content">
                <div class="tab-content-head describe_head">Describe Your Item</div>
                <div class="tab-content-inner main-con">
                  <div class="describe_form">
                    <form action="<?php echo base_url('user_action/add_listing');?>" method="post" id="add_listing" enctype="multipart/form-data">
                      <div class="form-area">
                        <label>Title<span style="color:red;">*</span>(Maximum length 80 Characters)</label>
                        <br/>
                        <input placeholder="Title" name="title" id="title" type="text" maxlength="80" />
                        <span class="display_err" id="title_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Item Condition <span style="color:red;">*</span></label>
                        <br/>
                        <select name="item_condition" class="filter_select" style="-webkit-appearance: none;">
                          <option value="factory_new">Factory New</option>
                          <option value="old">Old</option>
                          <option value="used">Used</option>
                        </select>
                      </div>
                      <div class="form-area">
                        <label>Item Location<span style="color:red;">*</span></label>
                        <br/>
                        <input placeholder="Item Location" id="item_location" name="item_location" type="text" />
                        <span class="display_err" id="item_location_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Country<span style="color:red;">*</span></label>
                        <br/>
                        <input plceholder="Country" name="country" type="text" />
                      </div>
                      <div class="form-area">
                        <label>Federal Firearms License (FFL)<span style="color:red;">*</span></label>
                        <br/>
                        <select name="FFL" class="filter_select" style="-webkit-appearance: none;">
                          <option>Yes</option>
                          <option>No</option>
                        </select>
                      </div>
                      <div class="form-area">
                        <label>Mfg Part Number</label>
                        <br/>
                        <input placeholder="Mfg Part Number" name="MFG" type="text" />
                      </div>
                      <div class="form-area">
                        <label>SKU</label>
                        <br/>
                        <input placeholder="SKU" name="SKU" type="text" />
                      </div>
                      <div class="form-area">
                        <label>Serial Number</label>
                        <br/>
                        <input placeholder="Serial Number" name="serial_no" type="text" />
                      </div>
                      <div class="form-area">
                        <label>UPC</label>
                        <br/>
                        <input placeholder="UPC" name="UPC" type="text" />
                      </div>
                      <div class="form-area">
                        <label>Description<span style="color:red;">*</span>(html code allowed)</label>
                        <br/>
                        <textarea placeholder="Description" id="description" name="description" cols="" rows=""></textarea>
                        <span class="display_err" id="description_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Additional Terms of Sale<span style="color:red;">*</span></label>
                        <br/>
                        <textarea placeholder="Additional Terms of Sale" name="terms_of_sale" cols="" rows="" id="terms_of_sale"></textarea>
                        <span class="display_err" id="terms_of_sale_valid"></span>
                      </div>
                  </div>
                </div>
              </div>
            </figure>
          </div>
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>
<!--full-list-second-form-->
<section class="content_section sign-in">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <div class="tabBlock-content">
                <div class="tab-content-head describe_head">Payment, Shipping, and Taxes</div>
                <div class="tab-content-inner main-con">
                  <div class="describe_form shipping_pay_form">
                      <div class="form-area">
                        <label>Select Method of Payment:-</label>
                        <br/>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="usps_money_order" />
                        <label>USPS Money Order</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="money_order" />
                        <label>Money Order</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="cod" />
                        <label>COD (collect on delivery)</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="certified_check" />
                        <label>Certified Check</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="personal_check" />
                        <label>Personal Check</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="escrow" />
                        <label>Escrow</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="paypal" checked />
                        <label>PayPal</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="discover" />
                        <label>Discover</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="visa/master" />
                        <label>Visa/MasterCard</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="american_express" />
                        <label>American  Express</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="payment_method" type="radio" value="item_desc" />
                        <label>See Item Description</label>
                      </div>
                      <br/>
                      <div class="form-area">
                        <label>Classes of shipping: -</label>
                        <br/>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_class" type="radio" value="overnight" checked />
                        <label>Overnight</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_class" type="radio" value="2nd_day" />
                        <label>2nd day </label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_class" type="radio" value="3rd_day" />
                        <label>3rd day</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_class" type="radio" value="ground" />
                        <label>Ground</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_class" type="radio" value="etc" />
                        <label>Etc. </label>
                      </div>
                      <br/>
                      <div class="form-area">
                        <label>Who pays for shipping?:</label>
                        <br/>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shiping_payer" type="radio" value="seller_pays" />
                        <label>Seller Pays For Shipping</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shiping_payer" type="radio" value="buyer_pays" checked />
                        <label>Buyer Pays Actual Shipping Cost</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shiping_payer" type="radio" value="buyer_fix_amount" />
                        <label>Buyer Pays Fixed Amount:</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shiping_payer" type="radio" value="see_item_desc" />
                        <label>See Item Description</label>
                      </div>
                      <br/>
                      <div class="form-area">
                        <label>Where You Will Ship?</label>
                        <br/>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_place" type="radio" value="seller_country" checked />
                        <label>Seller's Country Only</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_place" type="radio" value="internationally" />
                        <label>Internationally</label>
                      </div>
                      <br/>
                      <div class="form-area">
                        <label>Inspection Period / Return Policy</label>
                        <br/>
                        <p>Selecting a return policy is optional.  Regardless of any explanation in the auction description to the contrary, you are bound by the return policy / inspection periods for this listing if you decide to select one of the options shown below. </p>
                        <br/>
                        <div class="col-md-4 des_select">
                          <select name="return_policy" style="-webkit-appearance: none;">
                            <option value="no_refund">AS IS - No refund or exchange</option>
                            <option value="refundable">Refundable</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-area">
                        <label>Sales Tax<span style="color:red;">*</span></label>
                        <br/>
                        <div class="col-md-4 des_select" >
                          <select name="sales_tax" style="-webkit-appearance: none;">
                            <option value="seller">Seller must collect sales tax</option>
                            <option value="buyer">Buyer must collect sales tax</option>
                          </select>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </figure>
          </div>
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>
<!--full-list-second-form End--> 
<!--FULL LIST THIRD SECTION START-->
<section class="content_section sign-in">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="main-content-tab col-md-12">
            <div class="tab-content-head describe_head">Listing Details</div>
            <div class="tabBlock-content">
              <figure class="tabBlock list_deta">
                <ul class="tabBlock-tabs">
                  <li class="tabBlock-tab is-active first"><span>AUCTION</span>
                    <p>Lorme Ipsum dollar</p>
                  </li>
                  <li class="tabBlock-tab second"><span>FIXED</span>
                    <p>Lorme Ipsum dollar</p>
                  </li>
                </ul>
                <div class="tabBlock-pane list_detail_inner">
                  <div class="tab-content-inner">
                      <div class="form-area list_detail">
                        <label>Duration<span style="color:red">*</span></label>
                        <br />
                        <p>The auction should end exactly
                          <select class="dur_sel" name="duration_period" style="-webkit-appearance: none;">
                            <?php for($i=1;$i<=31;$i++){?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                          <select class="dur_sel" name="duration_type" style="-webkit-appearance: none;">
                            <option value="">Day(s)</option>
                            <option>Month(s)</option>
                            <option>Year(s)</option>
                          </select>
                          after its start date</p>
                      </div>
                      <div class="form-area">
                        <label>Relist Options</label>
                        <br/>
                      </div>
                      <div class="form-area ship_form">
                        <input name="relist_options" type="radio" value="automatically_relist" checked />
                        <label> Automatically relist this item</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="relist_options" type="radio" value="relist_until_sold" />
                        <label>Relist until the item is sold</label>
                      </div>
                      <div class="form-area ship_form list_detail">
                        <input style="width:30px;" name="relist_options" type="radio" value="relist_after_sold" />
                        <label>Relist
                          <select class="dur_sel" name="relist_time_after_sold" style="-webkit-appearance: none;>
                            <?php for($i=1;$i<=31;$i++){?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                          </select>
                          times (even if sold) </label>
                      </div>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;">Starting Bid</span><span style="color:red;">*</span>
                          <input name="starting_bid" type="text" id="starting_bid" class="return_number" />
                          <span style="font-weight:bold;">per item</span>
                          <span class="display_err" id="starting_bid_valid"></span>
                        </p>
                        <p class="sub_txt">(e.g., 2.00 - do not include commas or currency symbols, such as $)<br />
                          This is the least amount that a user will able to bid on an item. You must set this to atleast .01.</p>
                      </div>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;">Reserve Price:</span>
                          <input name="reserve_price" type="text" class="return_number" />
                        </p>
                        <p class="sub_txt">(e.g., 15.00 - do not include commas or currency symbols, such as $)<br />
                          If you do not want a Reserve Price, set it to 0.</p>
                      </div>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;">Buy Now! price:</span>
                          <input name="buy_now_price" type="text" class="return_number" />
                        </p>
                        <p class="sub_txt">(e.g., 15.00 - do not include commas or currency symbols, such as $)<br />
                          If you do not want to use Buy Now!, set it to 0. Your Buy Now! price must be greater than or equal to the Starting Bid and<br />
                          Reserve Price. </p>
                      </div>
                  </div>
                </div>
                <div class="tabBlock-pane list_detail_inner">
                  <ul>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Minima mollitia tenetur nesciunt modi?</li> 
                    <li>Id sint fugit et sapiente.</li>
                    <li>Nam deleniti libero obcaecati pariatur.</li>
                    <li>Nemo optio iste labore similique?</li>
                  </ul>
                </div>
                <div class="extra_field">
                  <p style="font-weight:bold;font-size:14px;">
                    <label>Scheduled Listing?</label>
                    <input class="extra_input" name="scheduled_listing" type="checkbox" value="" checked />
                    <span style="font-weight:normal;">$0.10 charge Listing starts at a date and time in the future.</span></p>
                </div>
              </figure>
            </div>
          </div>
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>
<!--FULL LIST THIRD SECTION END--> 
<!--FULL LIST FOURTH SECTION START-->
<section class="content_section sign-in">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="main-content-tab col-md-12">
            <div class="tab-content-head describe_head">Attract More Attention to Your Listings and Get More Bids</div>
            <div class="tabBlock-content" style="padding-bottom: 20px;">
              <figure class="tabBlock list_deta">
                <ul class="tabBlock-tabs">
                  <li class="tabBlock-tab is-active first"><span>AUCTION</span>
                    <p>Lorme Ipsum dollar</p>
                  </li>
                  <li class="tabBlock-tab second"><span>FIXED</span>
                    <p>Lorme Ipsum dollar</p>
                  </li>
                </ul>
                <div class="tabBlock-pane list_detail_inner">
                  <div class="tab-content-inner">
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>Showcase Listing:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="showcase_listing" type="checkbox" value="showcase_listing" />
                          <span class="price">$4.95 charge </span>Listing is randomly shown on our home page!</p>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>Featured Listing:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="featured_listing" type="checkbox" value="featured_listing" />
                          <span class="price">$2.95 charge </span>Listing is given additional exposure in search results</p>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>Highlight:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="highlight" type="checkbox" value="highlight" />
                          <span class="price">$2.00 charge </span>Listing has highlighted background color in search results</p>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>Boldface Title:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="boldface_title" type="checkbox" value="boldface_title" />
                          <span class="price">$1.00 charge </span>Listing title is boldfaced in search results</p>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>Colored Title:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="colored_title" type="checkbox" value="colored_title" />
                          <span class="price">$1.00 charge </span>Listing title is colored in search results</p>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p></p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <select name="" class="dur_sel" style="-webkit-appearance: none;">
                          <option>Green</option>
                          <option>Red</option>
                          <option>Yellow</option>
                        </select>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>View Counter:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="view_counter" type="checkbox" value="view_counter" />
                          <span class="price">$1.00 charge </span>Listing title is colored in search results</p>
                      </div>
                    </div>
                    <div class="bid_offer_main col-md-12">
                      <div class="left_section_label col-md-3">
                        <p>Thumbnail Image:</p>
                      </div>
                      <div class="right_section_label col-md-9">
                        <p>
                          <input name="thumbnail_image" type="checkbox" value="thumbnail_image" />
                          <span class="price">$1.00 charge </span>Listing title is colored in search results</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabBlock-pane list_detail_inner">
                  <ul>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Minima mollitia tenetur nesciunt modi?</li>
                    <li>Id sint fugit et sapiente.</li>
                    <li>Nam deleniti libero obcaecati pariatur.</li>
                    <li>Nemo optio iste labore similique?</li>
                  </ul>
                </div>
                <!-- <div class="extra_field">
                  <p style="font-weight:bold;font-size:14px;">
                    <label>Scheduled Listing?</label>
                    <input class="extra_input" name="" type="radio" value="" checked />
                    <span style="font-weight:normal;">$0.10 charge   Listing starts at a date and time in the future.</span></p>
                </div> -->
              </figure>
            </div>
          </div>
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>
<!--FULL LIST FOURTH SECTION END--> 
</div>
<!--second step all section end-->
<!--ADD MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Select a Category &nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Describe Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">Add Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Review Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Preview Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a> </div>
            <div class="bread-right_sec col-md-6">
              <div class="swicher_btn pull-right">
                <ul>
                  <li><a class="switch_inactive" href="#">BUYER</a></li>
                  <li><a class="switch_active"  href="#">SELLER</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <div class="tabBlock-content">
                <div class="tab-content-head describe_head">List an Item :: Add Media</div>
                <div class="tab-content-inner main-con">
                  <div class="add-media">
                    <div class="add_media_inner">
                      <div class="section_head">If You Do Not Have Pictures to Add At this Time </div>
                      <div class="section_content">
                      <p>A picture really helps to sell your item. Items with pictures tend to receive more bids and sell for a higher price than items without a picture. You can add pictures later using the Add to Description function located on our Tools for Sellers page. Click Continue to<a href="#" style="color:#ff6d00; font-weight:bold;"> Preview </a>to preview your item listing without adding any pictures.</p>
                      <div class="prev_btn"><a href="#">View Preview</a></div>
                       </div>
                    </div>
                  </div>
                  <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">Add Pictures and video to Your Listing</div>
                      <div class="section_content">
                      <p><span style="color:#444;">Note:</span><span style="color:#ff6d00">The Advanced Picture Uploader is not currently compatible on this page. A fully functional version of the Advanced Picture Uploader is available via Manage Pictures. A link to Manage Pictures will be provided once the item is listed.</span> </p>
                      <p class="spl_txt">If you have pictures that you would like to upload and add to your item listing, select the files below. The Primary Picture is also the picture that will be used for your Thumbnail, if you choose to have one.</p><p>Additional pictures can be added at the end of the List an Item process.</p>
                      <p><span style="color:#ff6d00;font-weight:bold;">Pictures you upload can only be JPEG, JPG, GIF, or PNG formats, any other picture format will be rejected.</span> </p>
                      <p><span style="color:#ff6d00">Uploads greater than 4MB may experience connection errors. If this occurs, please try uploading only one picture and add additional pictures after the item has been listed.</span></p>
                      <div class="img_upload_main">
                      <div class="img_upload_sec">
                      <div class="img_upload_inner">
                      <div class="col-md-2 img_label">Primary Picture:</div>
                      <div class="col-md-2 upload_btn">
                        <a id="primary_pic">Upload</a>
                        <input type="file" id="file1" name="file1" style="display:none" onchange="readURL(this);" accept=".jpg,.jpeg,.png" />
                        <span class="display_err" id="primary_img_valid"></span>
                      </div>
					<div class="col-md-2 img_thumb"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04_00.jpg" id="display_primary"/><a href="#" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                    </div>
                      <div class="img_upload_sec">
                      <div class="img_upload_inner">
                      <div class="col-md-2 img_label">Picture 2:</div>
                      <div class="col-md-2 upload_btn">
                        <a id="second_pic">Upload</a>
                        <input type="file" id="file2" name="file2" style="display:none" onchange="readURL(this);" accept=".jpg,.jpeg,.png" />
                      </div>
					<div class="col-md-2 img_thumb"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04_00.jpg" id="display_pic2" /><a href="#" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                    </div>
                      </div>
                      <div class="img_upload_sec">
                      <div class="img_upload_inner">
                      <div class="col-md-2 img_label">Picture 3:</div>
                      <div class="col-md-2 upload_btn">
                        <a id="third_pic">Upload</a>
                        <input type="file" id="file3" name="file3" style="display:none" onchange="readURL(this);" accept=".jpg,.jpeg,.png" />
                      </div>
					<div class="col-md-2 img_thumb"><img class="display_section" src="<?php echo base_url(); ?>assets/img/04_00.jpg" id="display_pic3"/><a href="#" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                    </div>
                      </div>
                      </div>
                       </div>
                       
                       <div class="img_upload_url_main">
                      <div class="img_upload_url_inner">
                      <p style="color:#444;font-family:'lato';font-weight:bold;">Add Pictures by URL</p><p style="color:#ff6d00;font-family:'lato';">If you have one or more pictures that are hosted on a Web server, you can enter the URL of the image files in the fields below. All image URLs must be secure (https://). </p>
                      <div class="main_img_url_sec">
                      <div class="img_upload_min_sec">
                      <div class="col-md-2 img_label">Url 1:</div>
                      <div class="col-md-4 url_img"><input name="pic_url1" type="text" /></div>
                      </div>
                      <div class="img_upload_min_sec">
                      <div class="col-md-2 img_label">Url 2:</div>
                      <div class="col-md-4 url_img"><input name="pic_url2" type="text" /></div>
                      </div>
                      <div class="img_upload_min_sec">
                      <div class="col-md-2 img_label">Url 3:</div>
                      <div class="col-md-4 url_img"><input name="pic_url3" type="text" /></div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="video_url_main">
                  <p style="color:#444;font-weight:bold;font-family:'lato';">Additional video can be added at the end of the List an Item process.</p>
                  <p style="font-weight:bold;color:#ff6d00;font-family:'lato';">Video you upload can only be MP4, MPGAV, formats, any other video format will be rejected. </p>
                  <p style="color:#ff6d00;font-family:'lato';margin-bottom:20px;">Uploads greater than 25MB may experience connection errors. If this occurs, please try uploading only one video.</p>
                  <div class="img_upload_main">
                      <div class="img_upload_sec">
                      <div class="img_upload_sec">
                      <div class="img_upload_inner">
                      <div class="col-md-2 img_label">Video 1:</div>
                      <div class="col-md-2 upload_btn"><a href="#">Upload</a></div>
					<div class="col-md-2 img_thumb"><img src="<?php //echo base_url(); ?>assets/img/04_00.jpg"/><a href="#" class="cancel_btn"><img src="<?php //echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                    </div>
                      </div>
                      </div>
                       </div>
                       </div> -->
                <div class="video_url_main">
                  <p style="color:#444;font-weight:bold;font-family:'lato';">Add Videos by URL</p>
                  <p style="color:#ff6d00;font-family:'lato';margin-bottom:20px;">If you have one or more video that are hosted on a Web server.</p>
                  <div class="img_upload_main">
                    <div class="img_upload_sec">
                      <div class="img_upload_sec">
                        <div class="img_upload_inner">
                          <div class="col-md-2 img_label">Url 1 :</div>
                         <div class="col-md-4 video_input"><input name="video_url1" type="text" /></div>
                         <div class="col-md-2 img_thumb"><iframe width="45" height="45" src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe><a href="#" class="cancel_btn iframe"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                        </div>
                        <div class="img_upload_inner">
                          <div class="col-md-2 img_label">Url 2 :</div>
                         <div class="col-md-4 video_input"><input name="video_url2" type="text" /></div>
                         <div class="col-md-2 img_thumb"><iframe width="45" height="45" src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe><a href="#" class="cancel_btn iframe"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                        </div>
                        <div class="img_upload_inner">
                          <div class="col-md-2 img_label">Url 3:</div>
                         <div class="col-md-4 video_input"><input name="video_url3" type="text" /></div>
                         <div class="col-md-2 img_thumb"><iframe width="45" height="45" src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe><a href="#" class="cancel_btn iframe"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </figure>
          </div>
          
        </div>
      </fieldset>
      <!--sign in form section end-->
    </div>
  </div>
</section>

<!--ADD MEDIA SECTION END--> 
<!--ADD LIST MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Select a Category &nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Describe Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Add Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">Review Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Preview Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a> </div>
            <div class="bread-right_sec col-md-6">
              <div class="swicher_btn pull-right">
                <ul>
                  <li><a class="switch_inactive" href="#">BUYER</a></li>
                  <li><a class="switch_active"  href="#">SELLER</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <div class="tabBlock-content">
                <div class="tab-content-head describe_head">List an Item :: Review Media</div>
                <div class="tab-content-inner main-con">
                  <div class="add-media">
                    <div class="add_media_inner">
                      <div class="section_head">Review Your Pictures</div>
                      <div class="section_content">
                      <p>Please review the pictures below and make sure they are correct. If they are, click the 'Next' button below to preview your listing. If you would like to remove these or add other pictures before previewing your listing, click the 'Previous' link at the bottom of the page.</p><br />
                      <p><span style="color:#444;font-weight:bold; font-family:'lato';">Image Url: </span><a href="#" class="img_url"><span style="color:#ff6d00;font-family:'lato';">https://pics.firearms.com/GB_Temp/~ah0000000069_2059763316_0000000001.jpg</span></a></p>
                      <div class="img_preview"><img src="<?php echo base_url(); ?>assets/img/img_pre.jpg"/></div>
                      <div class="img_preview"><img src="<?php echo base_url(); ?>assets/img/img_pre.jpg"/></div>
                      <div class="img_preview"><img src="<?php echo base_url(); ?>assets/img/img_pre.jpg"/></div>
                       </div>
                    </div>
                  </div>
                  <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">Review Your Video</div>
                      <div class="section_content">
                      <p>Please review the video below and make sure they are correct. If they are, click the 'Next' button below to preview your listing. If you would like to remove these or add other pictures before previewing your listing, click the 'Previous' link at the bottom of the page.</p>
                      <p><span style="color:#444;font-weight:bold; font-family:'lato';">Image Url: </span><a href="#" class="img_url"><span style="color:#ff6d00;font-family:'lato';">https://pics.firearms.com/GB_Temp/~ah0000000069_2059763316_0000000001.mp4</span></a></p>
                      <div class="video_preview"><iframe width="219" height="187" src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
					            </div>
                </div>
              </div>
              </div>
              </div>
              
            </figure>
          </div>
          
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>
<!--ADD LIST MEDIA SECTION END--> 
<!--ADD LIST PREVIEW MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Select a Category &nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Describe Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Add Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Review Pictures&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">Preview Item&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a> </div>
            <div class="bread-right_sec col-md-6">
              <div class="swicher_btn pull-right">
                <ul>
                  <li><a class="switch_inactive" href="#">BUYER</a></li>
                  <li><a class="switch_active"  href="#">SELLER</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <div class="tabBlock-content">
                <div class="tab-content-head describe_head">List an Item :: Preview Media</div>
                <div class="tab-content-inner main-con">
                  <div class="add-media">
                    <div class="add_media_inner">
                      <div class="section_head">Preview your Listing</div>
                      <div class="section_content">
                      <p>Please review your item listing to make sure that the listing is correct. GunBroker.com cannot resolve problems between a buyer and the seller due to typographical errors in your listing. If any of this information is not correct click the 'Previous' button below or use the left hand navigation to go back and make changes.</p>
                     <div class="divider"></div>
                     <div class="list_main_label">
                      <div class="col-md-2 preview_label">Starting Price:</div>
                      <div class="col-md-10 label_two">$0.01</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Quantity:</div>
                      <div class="col-md-10 label_two">1</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Listing Duration:</div>
                      <div class="col-md-10 label_two">7 days</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Category:</div>
                      <div class="col-md-10 label_two">Air Pistols  </div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Auto Relist:</div>
                      <div class="col-md-10 label_two">no auto relist</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Reserve Price:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Buy Now! Price:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">	Showcase:</div>
                      <div class="col-md-10 label_two">No</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Featured in Category:</div>
                      <div class="col-md-10 label_two">No</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Sponsored Listing:</div>
                      <div class="col-md-10 label_two"></div>
                      </div>
                      
                       </div>
					<a class="preview_breadcrumb" href="#">All > Air Guns > Air Pistols</a>
                    </div>
                  </div>
                  <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">Air Gun Pistol</div>
                      <div class="section_content">
                      <p>Please review your item listing to make sure that the listing is correct. GunBroker.com cannot resolve problems between a buyer and the seller due to typographical errors in your listing. If any of this information is not correct click the 'Previous' button below or use the left hand navigation to go back and make changes.</p>
                     <div class="divider"></div>
                     <div class="list_main_label">
                      <div class="col-md-2 preview_label">Current Bid:</div>
                      <div class="col-md-10 label_two">$0.01</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Quantity:</div>
                      <div class="col-md-10 label_two">1</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Duration:</div>
                      <div class="col-md-10 label_two">7 days</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Start Date:</div>
                      <div class="col-md-10 label_two">4/13/2018 4:31:40 AM ET</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Accept Offer:</div>
                      <div class="col-md-10 label_two">False</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Sales Tax:</div>
                      <div class="col-md-10 label_two">Seller does not collect sales tax</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Auto Accept Price:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Auto Reject Price:</div>
                      <div class="col-md-10 label_two">No</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Ending Date:</div>
                      <div class="col-md-10 label_two">4/20/2018 4:31:40 AM ET </div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Seller:</div>
                      <div class="col-md-10 label_two">allpromedia</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Payment Methods:</div>
                      <div class="col-md-10 label_two">PayPal</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Shipping Terms:</div>
                      <div class="col-md-10 label_two">Buyer pays actual shipping costs for the following option(s):  Overnight
No international shipments</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label"></div>
                      <div class="col-md-10 label_two"><a href="#" style="color:#ff6d00;">See Item Description.</a></div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Inspection Period
/ Return Policy:</div>
                      <div class="col-md-10 label_two"><a href="#" style="color:#ff6d00;">Unspecified</a></div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Item Condition:</div>
                      <div class="col-md-10 label_two"><a href="#" style="color:#ff6d00;">Used</a></div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Requires FFL?:</div>
                      <div class="col-md-10 label_two"><a href="#" style="color:#ff6d00;">Yes</a></div>
                      </div>
                       <div class="list_main_label">
                      <div class="col-md-2 preview_label">Mfg Part Number:</div>
                      <div class="col-md-10 label_two"></div>
                      </div>
                       <div class="list_main_label">
                      <div class="col-md-2 preview_label">Serial Number:</div>
                      <div class="col-md-10 label_two"></div>
                      </div>
                       <div class="list_main_label">
                      <div class="col-md-2 preview_label">SKU:</div>
                      <div class="col-md-10 label_two"></div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">UPC:</div>
                      <div class="col-md-10 label_two"></div>
                      </div>
                      
                       </div>
                </div>
              </div>
              <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">Description for Item</div>
                      <div class="section_content">
                      <p>Please review your item listing to make sure that the listing is correct. GunBroker.com cannot resolve problems between a buyer and the seller due to typographical errors in your listing. If any of this information is not correct click the 'Previous' button below or use the left hand navigation to go back and make changes.</p>
                       </div>
                </div>
              </div>
              <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">Pictures for item</div>
                      <div class="section_content">
                      <div class="img_last_preview">
                      <div class="col-md-4 img_preview_list"><img src="http://webhungers.com/firearms-new/assets/img/img_pre.jpg"/></div>
                      <div class="col-md-4 img_preview_list"><img src="http://webhungers.com/firearms-new/assets/img/img_pre.jpg"/></div>
                      <div class="col-md-4 img_preview_list"><img src="http://webhungers.com/firearms-new/assets/img/img_pre.jpg"/></div>
                      </div>
                       </div>
                </div>
              </div>
              <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">video for item</div>
                      <div class="section_content">
                      <div class="video_preview"><iframe width="219" height="187" src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
                       </div>
                </div>
              </div>
              <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head">Fees Incurred for this Listing </div>
                      <div class="section_content">
                      <p>Depending on the listing services that you selected in the previous screens, you may incur a fee for placing this listing. Fees for the use of the optional services are non-refundable. If your item does not sell, you can relist it without incurring additional fees (see our Fees page for details).</p>
                     <div class="divider"></div>
                     <div class="list_main_label">
                      <div class="col-md-2 preview_label">Insertion Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Scheduling Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Counter Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Featured Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Sponsored Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Highlight Fee:</div>
                      <div class="col-md-10 label_two">$0.00  </div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Boldface Title Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Colored Title Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Counter Fee:</div>
                      <div class="col-md-10 label_two">$0.00</div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">Thumbnail Image Fee:</div>
                      <div class="col-md-10 label_two">$0.00 </div>
                      </div>
                      <div class="list_main_label">
                      <div class="col-md-2 preview_label">QuickLook Fee:</div>
                      <div class="col-md-10 label_two">$0.00 </div>
                      </div>
                      <div class="divider"></div>
                      <div class="list_main_label">
                      <div class="col-md-6 preview_label">Total Fees Due at Listing:   	$0.00</div>
                      <div class="col-md-6"><p>Estimated Final Value Fee:   (If the item sells for $0.01)	$0.00</p></div>
                      </div>
                       </div>
                </div>
              </div>
            
          </div>
        </div>
        </figure>
            </div>
    </div>
      </fieldset>
      <!--sign in form section end--> 
  </div>
  </div>
</section>
<div class="container">
 <div class="col-md-12 both_btn">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="Prev_button(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="next_button(1)">Next</button>
    </div>
  </div>
   <div style="text-align:center;margin-top:40px;display:none;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  </div>
</form>
</div>
</div>
<!--ADD LIST PREVIEW MEDIA SECTION END--> 
<!--full-list-form-End--> 
<script>
$(function () {
  var $sections = $('.form-section');

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $sections
      .removeClass('current')
      .eq(index)
        .addClass('current');
    // Show only the navigation buttons that make sense for the current section:
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $('.form-navigation .next').toggle(!atTheEnd);
    $('.form-navigation [type=submit]').toggle(atTheEnd);
  }

  function curIndex() {
    // Return the current index by looking at which section has the class 'current'
    return $sections.index($sections.filter('.current'));
  }

  // Previous button is easy, just go back
  $('.form-navigation .previous').click(function() {
    navigateTo(curIndex() - 1);
  });

  // Next button goes forward iff current block validates
  $('.form-navigation .next').click(function() {
    $('.demo-form').parsley().whenValidate({
      group: 'block-' + curIndex()
    }).done(function() {
      navigateTo(curIndex() + 1);
    });
  });

  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
  $sections.each(function(index, section) {
    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
  });
  navigateTo(0); // Start at the beginning
});
</script>
<script type="text/javascript">
	var TabBlock = {
  s: {
    animLen: 200
  },
  
  init: function() {
    TabBlock.bindUIActions();
    TabBlock.hideInactive();
  },
  
  bindUIActions: function() {
    $('.tabBlock-tabs').on('click', '.tabBlock-tab', function(){
      TabBlock.switchTab($(this));
    });
  },
  
  hideInactive: function() {
    var $tabBlocks = $('.tabBlock');
    
    $tabBlocks.each(function(i) {
      var 
        $tabBlock = $($tabBlocks[i]),
        $panes = $tabBlock.find('.tabBlock-pane'),
        $activeTab = $tabBlock.find('.tabBlock-tab.is-active');
      
      $panes.hide();
      $($panes[$activeTab.index()]).show();
    });
  },
  
  switchTab: function($tab) {
    var $context = $tab.closest('.tabBlock');
    
    if (!$tab.hasClass('is-active')) {
      $tab.siblings().removeClass('is-active');
      $tab.addClass('is-active');
   
      TabBlock.showPane($tab.index(), $context);
    }
   },
  
  showPane: function(i, $context) {
    var $panes = $context.find('.tabBlock-pane');
   
    // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
    $panes.slideUp(TabBlock.s.animLen);
    $($panes[i]).slideDown(TabBlock.s.animLen);
  }
};

$(function() {
  TabBlock.init();
});
$(document).ready(function() {

//$(".archive_month ul:gt(0)").hide();

$('.archive_month ul').hide();

$('.archive_year > li').click(function() {
    $(this).parent().find('ul').slideToggle();
});

$('.archive_month > li').click(function() {
    $(this).parent().find('ul').slideToggle();
});


});

</script>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  
 

  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function Prev_button(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function next_button(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  //console.log(x); 
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  crntTab = currentTab + n;
  /*if(crntTab == 1){
    var step1=form_first_validation();
    if(step1==false){
      return false;
    }
  }else if(crntTab == 2){
    var step2=form_second_validation();
    if(step2==false){
      return false;
    }
  }else if(crntTab == 3){
    var step3=form_third_validation();
    if(step3==false){
      return false;
    }
  }else if(crntTab == 5){
    $('#add_listing').submit();
  }*/
  if(crntTab == 5){
    var base_url = $('#base_url').val();
    window.location = base_url+'home/list_details';
  }
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  // for (i = 0; i < y.length; i++) {
  //   // If a field is empty...
  //   if (y[i].value == "") {
  //     // add an "invalid" class to the field:
  //     y[i].className += " invalid";
  //     // and set the current valid status to false
  //     valid = false;
  //   }
  // }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
