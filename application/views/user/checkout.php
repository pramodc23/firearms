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
        <div class="list_item checkout-process col-md-12">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Home&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Shipping&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">payment information&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">confirmation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
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
              <div class="Step-box01">
             <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step text-left">
                    <a href="#step-1" class="btn btn-primary btn-circle">1</a>
                    <p>Shipping</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Shipping details</p>
                  </div>
                  <div class="stepwizard-step text-right">
                    <a href="#step-3"  class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>SUBMISSION</p>
                  </div>
                </div>
              </div>
              </div>
              <div class="two-new-section">
                <div class="row">
                  <div class="col-md-5">
                    <div class="left-box01">
                      <div class="row">
                        <div class="col-md-6 col-xs-6 side-by01">
                        <span>ship to:</span>

                      </div>
                    <div class="col-md-6 col-xs-6 side-by01">
                        <span>category:</span>
                      </div>
                       </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="title-border"></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                          <select id="selectbasic01" name="selectbasic" class="form-control">
                      <option value="2">------Select One------</option>
                      <option value="1">1 Needs help of 1 person</option>
                      <option value="0">0 Needs help of 2+ people</option>
                  </select>
                       </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                      <select id="selectbasic01" name="selectbasic" class="form-control">
                      <option value="2">------Select One------</option>
                      <option value="1">1 Needs help of 1 person</option>
                      <option value="0">0 Needs help of 2+ people</option>
                  </select>
                </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-md-6">
                          <label class="side-by01">items retail price</label>
                          <div class="form-group two-divide">
                          <input type="text" name="first_name" id="first_name" class="form-control input-sm">
                          <select id="selectbasic01" name="selectbasic" class="form-control">
                      <option value="2">------Select One------</option>
                      <option value="1">1 Needs help of 1 person</option>
                      <option value="0">0 Needs help of 2+ people</option>
                  </select>
                      </div>
                        </div>
                        <div class="col-md-6">
                           <label class="side-by01">taxes and duties payed by</label>
                           <div class="form-group" style="margin-top: 7px;">
                         <a href="" class="btn-08">Sender</a>
                         <a href="" class="btn-08 active">Reciever</a>
                           </div>
                        </div>
                      </div>
                     <div class="row">
                        <div class="col-md-6">
                          <label class="side-by01 side-05">package dimension</label>
                          <div class="form-group two-divide input-marg">
                          <input type="text" name="first_name" id="first_name" class="form-control input-sm"> <span>x</span>
                          <input type="text" name="first_name" id="first_name" class="form-control input-sm"> <span>x</span>
                          <input type="text" name="first_name" id="first_name" class="form-control input-sm">

                      </div>
                        </div>
                        <div class="col-md-6">
                           <label class="side-by01">package weight</label>
                           <div class="form-group sub-sec">
                            <input type="text" name="first_name" id="first_name" class="form-control input-sm"> <sub>Kg</sub>
                           </div>
                        </div>
                      </div>
                    </div>
                   </div>
                <div class="col-md-7">
                  <div class="right-box01">
                    <h3>Summery</h3>
                    <p>Your address is very important in the registration process. We standardize your address when possible.  Please select the best address and confirm that this is your home address.  Do NOT use a business address as it will cause problems with registration.</p>
                    <div class="row">
                      <div class="col-md-6 left-one">
                        <span>Shipping</span>
                      </div>
                      <div class="col-md-6 right-one">
                          <span>$59.99</span>
                      </div>
                    </div>
                      <div class="row">
                      <div class="col-md-6 left-one">
                        <span>Tax</span>
                      </div>
                      <div class="col-md-6 right-one">
                          <span>$5.00</span>
                      </div>
                    </div>
                  <div class="row">
                      <div class="col-md-6 left-one">
                        <span>Insurance</span>
                      </div>
                      <div class="col-md-6 right-one">
                          <span>$12.00</span>
                      </div>
                    </div>

                    <div class="row total-box">
                      <div class="col-md-6 left-one">
                        <span>Total:</span>
                      </div>
                      <div class="col-md-6 right-one pad-sec">
                          <span>$79.99</span>
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
<!--full-list-form-start-->
<!--second step all section-->
<div class="tab second-full-sec">
<section class="content_section sign-in">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12 checkout-process">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Home&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Shipping&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">payment information&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">confirmation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
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
                              <div class="Step-box01">
             <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step text-left">
                    <a href="#step-1" class="btn btn-default btn-circle">1</a>
                    <p>Shipping</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" class="btn btn-primary btn-circle" disabled="disabled">2</a>
                    <p>Shipping details</p>
                  </div>
                  <div class="stepwizard-step text-right">
                    <a href="#step-3"  class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>SUBMISSION</p>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="left-section01"> 
                    <h3>Delivery Details</h3>
                    <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">name</label>
                      <input type="text" name="first_name" id="first_name" class="form-control input-sm">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">email</label>
                      <input type="text" name="last_name" id="last_name" class="form-control input-sm">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">country</label>
                      <input type="text" name="first_name" id="first_name" class="form-control input-sm">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">state</label>
                      <input type="text" name="last_name" id="last_name" class="form-control input-sm">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">city</label>
                      <input type="text" name="first_name" id="first_name" class="form-control input-sm">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">zip postal code</label>
                      <input type="text" name="last_name" id="last_name" class="form-control input-sm">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">daytime phone</label>
                      <input type="text" name="first_name" id="first_name" class="form-control input-sm">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <label class="side-by01">evening phone</label>
                      <input type="text" name="last_name" id="last_name" class="form-control input-sm">
                    </div>
                  </div>
                </div>
                   <div class="form-group">
                  <label class="side-by01">shipping address</label>
                <input type="text" name="last_name" id="last_name" class="form-control input-sm">

                </div>
                <div style="margin-bottom: 9px;">
                 <label class="side-by01">Shipping option</label>
               </div>
                <div class="form-area ship_form">
                        <input name="shipping_place" type="radio" value="seller_country" checked="">
                        <label>pickup & avoid any shipping charges</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_place" type="radio" value="seller_country" checked="">
                        <label>ship to the above address for as per chanrges.</label>
                      </div>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="right-section01">
                    <h3>Payment Information</h3>
                    <p>Your  card will be charged automatically (On Secure, PCI Compliant server) when the last item in the auction ends ONLY IF you are the winner bidder. You will also have the chance to checkout manually prior to the close of the last auction item. If you don’t win any item, your card will not be charged.</p>
                    <div class="form-group">
                    <label class="control-label">Select a credit card or add a new one</label>
                  <select id="selectbasic" name="selectbasic" class="form-control">
                  <option value="2"></option>
                  <option value="1">1 Needs help of 1 person</option>
                  <option value="0">0 Needs help of 2+ people</option>
                </select>
                 </div>
                <button type="button" class="btn btn-warning pull-left">add new card</button>
                <p style="clear: both;color: #e31e1e;">Note: Only one card can be used for all Items. The card selected for the last item you bid on will be used to process all items. should you win.</p>
                <div class="form-group" style="border-bottom: 1px solid #ededed;">
                 <label class="side-by01">TERMS</label>
               </div>
                <div class="form-area ship_form">
                        <input name="shipping_place" type="checkbox" value="seller_country" checked="">
                        <label style="padding-left: 5px;">I understand a 15% service gratuity will be added to my bid if I win, offsetting the fees to the beneficiary.</label>
                      </div>
                      <div class="form-area ship_form">
                        <input name="shipping_place" type="checkbox" value="seller_country" checked="">
                        <label  style="padding-left: 5px;">I agree to the terms of use and i give firearms.com permission to charge the above credit card for the grand total resulting from my winning bid.</label>
                      </div>
                                   <button type="button" class="btn btn-warning text-center">Place your bid now!</button>
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


<!--FULL LIST FOURTH SECTION END--> 
</div>
<!--second step all section end-->
<!--ADD MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--lsit an item section -->
    <div class="row">
      <fieldset>
        <div class="list_item col-md-12 checkout-process">
          <div class="breadcrumb_section">
            <div class="bread-left-sec col-md-6"> <a href="#">Home&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">Shipping&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#">payment information&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" class="active">confirmation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
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
                                              <div class="Step-box01">
             <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step text-left">
                    <a href="#step-1" class="btn btn-default btn-circle">1</a>
                    <p>Shipping</p>
                  </div>
                  <div class="stepwizard-step">
                    <a href="#step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Shipping details</p>
                  </div>
                  <div class="stepwizard-step text-right">
                    <a href="#step-3"  class="btn btn-primary btn-circle" disabled="disabled">3</a>
                    <p>SUBMISSION</p>
                  </div>
                </div>
              </div>
              </div>
            </figure>
            <h3 class="heading-06"><img src="<?php echo base_url(); ?>assets/img/Lock-img05.png"/">Order recieved</h3>
            <p class="para-08">thank you. your order has been recieved.</p>
            <div class="row five-sections">
              <div class="col-md-2">
                <span>order number:</span>
                <p>562</p>
              </div>
             <div class="col-md-3">
                <span>date:</span>
                <p>november,25,2018</p>
              </div>
              <div class="col-md-3">
                <span>total:</span>
                <p>$300.00</p>
              </div>
              <div class="col-md-3">
              <span>payment method:</span>
              <p>check Payments</p>
              </div>
              <div class="col-md-1">
                <img src="<?php echo base_url(); ?>assets/img/correct-option.png"/">
              </div>
              
            </div>
        <p class="bottom-para">please send a check to stored name, store street, store town, store state/country, store postcode.</p>

<h3 class="heading-06"><img src="<?php echo base_url(); ?>assets/img/Sheet-order.png">Order details</h3>
<table class="table table-hover shopping-cart-wrap table-responsive inner-box05">
<thead class="text-muted">
<tr>
  <th scope="col">product: </th>
  <th scope="col" width="280">shipping</th>
  <th scope="col" width="260" class="text-center">payment method</th>
  <th scope="col" width="260" class="text-center">sub-total</th>
  <th scope="col" width="260" class="text-center">total</th>
</tr>
</thead>
<tbody style="border: 1px solid #cccccc;">
<tr>
  <td>
<figure class="media">
  <figcaption class="media-body">
    <h6 class="title text-truncate">Air gun 2400</h6>
  </figcaption>
</figure> 
  </td>
  <td> 
    <p class="para-table">$24,00</p> 
  </td>
  <td> 
    <div class="price-wrap"> 
      <p class="para-table">check payment</p> 
    </div> <!-- price-wrap .// -->
  </td>
  <td class="text-right"> 
   <p class="para-table">$26,00</p>
  </td>
 <td class="text-right"> 
   <p class="para-table">$26,00</p>
  </td>
</tr>
</tbody>
</table>
          </div>
          
        </div>
      </fieldset>
      <!--sign in form section end-->
    </div>
  </div>
</section>

<!--ADD MEDIA SECTION END--> 
<!--ADD LIST MEDIA SECTION START-->

<!--ADD LIST MEDIA SECTION END--> 
<!--ADD LIST PREVIEW MEDIA SECTION START-->

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
