<section id="footer">
<div class="footer_top">
<!--footer main start-->
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title" style="float:left; width:100%;">Share Listing</h4>
          <a data-dismiss="modal" style="cursor:pointer" title="close"><b>x</b></a>
        </div>
        <div class="modal-body">
          <div class="modal-body mx-3">
              <span class="share_err single_share_valid" style="color:red;"></span>
              <?php $users=$this->user_model->select_data('id,first_name','user',array('is_active'=>1,'id != ' =>1));?>
              <div class="form-area">
                  <label>Select registered user of firearms.network whom you want to share the post</label>
                  <select name="single_share_user" id="single_share_user" class="filter_select" style="-webkit-appearance: none;">
                          <option value="">Select</option>
                          <?php foreach($users as $user){?>
                          <option value="<?php echo $user['id']?>"><?php echo $user['first_name']?></option>
                          <?php } ?>
                  </select>
              </div>
              <p class="form-area" style="text-align:center;">Or</p>
              <div class="form-area">
                  <label>Enter email address of whom you want to share the post</label>
                  <input type="text" id="defaultForm-email" class="form-control">
                  <input type="hidden" id="share_list_id">
                  <span class="share_err social_email_valid" style="color:red;"></span>
              </div>
              <p class="form-area" style="text-align:center;">Or</p>
              <div class="form-area fbshare-out">
                 <a href="https://www.facebook.com/sharer.php?u=<?php echo base_url('/').$this->uri->uri_string(); ?>
                  " target="_blank" rel="nofollow"><img class="img-responsive" src="<?php echo base_url(); ?>assets/img/facebookshare.jpg"/></a>
              </div>




          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default social_close" data-dismiss="modal">Close</button>
          <button class="btn btn-default social_email">Submit</button>
        </div>
      </div> 
    </div>
  </div>
  <!-- Modal -->


<!-- Modal -->
  <div class="modal fade" id="signing_amount_modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <h4 class="modal-title" style="float:left; width:100%;"></h4>
          <a data-dismiss="modal" style="cursor:pointer" title="close"><b>x</b></a>
        </div>
        <div class="modal-body">
          <div class="modal-body mx-3">
              <div class="form-area">
                  <h3>Please pay signing amount for access your account</h3>    
                  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
                  <input type="hidden" name="user_email" id="user_email">     
                  <input type="hidden" name="user_pass" id="user_pass">                     
              </div>              
          </div>
        </div>
        <div class="modal-footer">        
          <button class="btn btn-default amount_pay">Pay</button>
        </div>
      </div> 
    </div>
  </div>
  <!-- Modal -->



  <!-- Modal -->
  <div class="modal fade" id="ask_question_modal" role="dialog">
    <div class="modal-dialog modal-dialog-askque">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title" style="float:left; width:100%;">Ask Seller a Question</h4>
      
          <button type="button" class="close" data-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
          <div class="modal-body mx-3">
              <div class="form-area">
                  <p>Enter your question or message</p>
                <!-- <img class="user-circal-img" alt="" id="listing_user_image" style="">
                <span id="saller_name" style=""></span> -->
              </div>
              <div class="form-area ask_question_popup" style="margin-top: 20px;">             
                

                  <input type="hidden" id="seller_list_id">
                  <input type="hidden" id="seller_list_email">
                  <input type="hidden" id="buyers_list_email">
                  <input type="hidden" id="seller_list_too">
                  <input type="hidden" id="seller_list_fromo">
                  <input type="hidden" id="seller_list_subjecto">
              
                  <p>
                  <label>From:</label>
                  <span id="seller_list_from"></span>
                  </p>
                   <p>
                      <label>To:</label>
                      <span id="seller_list_to"></span>
                   </p>
                   <!-- <p>
                      <label> Bcc to myself: </label>
                       <input type="checkbox" name="" value="" class="bcc_to_self"> 
                   </p> -->
                    <p>
                      <label>Subject:</label>
                      <span id="seller_list_subject"></span>
                    </p>
                     <p>
                        <label> Item: </label>
                        <span id="title"></span>
                   </p>
                 <div> <label>Message: </label>
                 <!--  <input type="text" id="defaultForm-email" class="form-control"> -->
                <textarea class="form-control" id="seller_que"></textarea></div>
                  <span class="que_err que_valid" style="color:red;"></span>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default social_close" data-dismiss="modal">Close</button>
          <button class="btn btn-default add_list_question">Submit</button>
        </div>
      </div> 
    </div>
  </div>
  <!-- Modal -->


</div>

<div class="footer-main">
<div class="container">
<div class="footer-widget">
<div class="footer-widget-one col-md-4">
<div class="footer_widget_head">HELP</div>
<ul>
<li class="footer-link"><a href="<?php echo base_url('contact-us');?>">Contact Us</a></li>
<li class="footer-link"><a href="<?php echo base_url('faq');?>">FAQ</a></li>
<li class="footer-link"><a href="<?php echo base_url('about-us');?>">About</a></li>
<li class="footer-link"><a href="<?php echo base_url('sign-up');?>">Register</a></li>
<li class="footer-link"><a href="<?php echo base_url('site-map');?>">Site Map</a></li>
<li class="footer-link"><a href="<?php echo base_url('support');?>">My Support Page</a></li>
</ul>
</div>
<div class="footer-widget-one col-md-4">
<div class="footer_widget_head">BUYERS</div>
<ul>
<li class="footer-link"><a href="<?php echo base_url('tools-for-buyers');?>">Tools for Buyers</a></li>
<li class="footer-link"><a href="<?php echo base_url('new-buyers');?>">New Buyers</a></li>
<li class="footer-link"><a href="<?php echo base_url('how-to-buy');?>">How To Buy</a></li>
<li class="footer-link"><a href="<?php echo base_url('buyers-protection');?>">Buyer's Protection</a></li>
<li class="footer-link"><a href="<?php echo base_url('find-an-ffl');?>">Find An FFL</a></li>
<li class="footer-link"><a href="<?php echo base_url('report');?>">Report</a></li>
</ul>
</div>
<div class="footer-widget-one col-md-4"> 
<div class="footer_widget_head">SELLERS</div>
<ul>
<li class="footer-link"><a href="<?php echo base_url('tools-for-sellers');?>">Tools for Sellers</a></li>
<li class="footer-link"><a href="<?php echo base_url('new-sellers');?>">New Sellers</a></li>
<li class="footer-link"><a href="<?php echo base_url('about-us');?>">About</a></li>
<li class="footer-link"><a href="<?php echo base_url('how-to-sell');?>">How To Sell</a></li>
<li class="footer-link"><a href="<?php echo base_url('fees-and-services');?>">Fees & Services</a></li>
<li class="footer-link"><a href="<?php echo base_url('join-our-ffl-network');?>">Join our FFL Network</a></li>
</ul>
</div>
<div class="footer-widget-one col-md-4">
<div class="footer_widget_head">MORE RESOURCES</div>
<ul>
<li class="footer-link"><a target="_blank" href="https://www.atf.gov/">Gun Laws</a></li>
<li class="footer-link"><a target="_blank" href="https://gunsafetyrules.nra.org/">Gun Safety</a></li>
<li class="footer-link"><a target="_blank" href="https://www.libertynation.com/about-us">News</a></li>
<li class="footer-link"><a target="_blank" href="https://www.atf.gov/qa-category/unlicensed-persons">Gun Shipping Do's and Don'ts</a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="footer-copyright">
  <div class="container">
    <div class="copy_left col-md-6">
        <p>Copyright &copy; 2017-<?php echo date('Y');?> Firearms.network All rights reserved worldwide.</p>
    </div>
    <div class="copy_right col-md-6">
      <ul>
        <li class="socail_btn"><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
        <li class="socail_btn"><a href="https://twitter.com" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true" target="_blank"></i></a></li>
        <li class="socail_btn"><a href="https://plus.google.com" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true" target="_blank"></i></a></li>
      </ul>
    </div>
  </div>
</div>
</section>
<script>
// $('#owl-one').owlCarousel({
//   autoplay: true,
//   autoplayHoverPause: true,
//   autoplaySpeed: 3000,
//   responsiveClass: true,
//   nav: true,
//   loop: true,
//   responsive: {
//     0: {
//       items: 1
//     },
// 	420: {
//       items: 1
//     },
//     568: {
//       items: 2
//     },
//     600: {
//       items: 3
//     },
//     1000: {
//       items: 4
//     },
// 	1366: {
//       items: 5
//     },
// 	1920: {
//       items: 5
//     }
//   }
// })
// $('#owl-load_more').owlCarousel({
//   autoplay: false,
//   autoplayHoverPause: true,
//   autoplaySpeed: 2300,
//   responsiveClass: true,
//   nav: true,
//   loop: true,
//   responsive: {
//     0: {
//       items: 1
//     },
//     568: {
//       items: 2
//     },
//     600: {
//       items: 3
//     },
//     1000: {
//       items: 4
//     },
// 	1366: {
//       items: 5
//     },
// 	1920: {
//       items: 5
//     }
//   }
// })
// $('#owl-two').owlCarousel({
//   autoplay: true,
//   autoplayHoverPause: true,
//   autoplaySpeed: 3000,
//   loop: true,
//   responsiveClass: true,
//   nav: true,
//   loop: true,
//   responsive: {
//     0: {
//       items: 1
//     },
//     568: {
//       items: 2
//     },
//     600: {
//       items: 3
//     },
//     1000: {
//       items: 4
//     },
// 	1366: {
//       items: 5
//     },
// 	1920: {
//       items: 5
//     }
//   }
// })
//</script>
<script>
var bringOut = document.getElementById('bringOut');
var takeIn = document.getElementById('takeIn');
var sidebar = document.getElementById('sidebar');
var big = document.getElementById('big');
var bigC = document.getElementById('bigContainer');
var card = document.getElementsByClassName('card');
var image = document.getElementsByClassName('img-fluid');

bringOut.addEventListener('click', out);

takeIn.addEventListener('click', inside);

window.addEventListener('click', outside);

for (i = 0; i < image.length; i++) {
    image[i].addEventListener('click', function() {
        big.style.display = "block";
        bigC.innerHTML = "<img src='" + image.src[i] + "'>";
    });
}

function out() {
    sidebar.style.display = "block";
}

function inside() {
    sidebar.style.display = "none";
}

function outside(e) {
    if (e.target == sidebar) {
        sidebar.style.display = "none";
    }
}
</script>

<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Listing successfully added</h4>
        </div>
        <div class="modal-body">
          <p>Gun listing successfully added. Now it will be display in your home page and user can easily bid on it.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


</body>
</html>