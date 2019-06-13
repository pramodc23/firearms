<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');

$first_name='';$email_id='';$profile_image='';$phone='';$business_phone='';$address1='';
$address2='';$zipcode='';$city='';$state='';$country='';$company_name='';$FFL_LGD='';$prefered_contact='';$aoi='';

if ($user_detail) {
  $first_name=$user_detail->first_name;
  $email_id=$user_detail->email_id;
  $phone=$user_detail->phone;
  $business_phone=$user_detail->business_phone;
  $address1=$user_detail->address1;
  $address2=$user_detail->address2;
  $zipcode=$user_detail->zipcode;
  $city=$user_detail->city;
  $state=$user_detail->state;
  $country=$user_detail->country;
  $company_name=$user_detail->company_name;
  $FFL_LGD=$user_detail->FFL_LGD;
  $prefered_contact=$user_detail->prefered_contact;
  $aoi=$user_detail->aoi;




  if ($user_detail->profile_image !='') {
    $profile_image=$user_detail->profile_image;
  }else{
    $profile_image='user_profile.png';
  }
}
?>

<?php if(!$this->session->flashdata('msg')==''){ 
      $response_message=$this->session->flashdata('msg'); 
   
  if($response_message=='Favouritesuccess'){ ?>
    <script type="text/javascript">
        sweetalertsuccess();
        function sweetalertsuccess(){ 
          swal("Success!", "Favourite seller removed successfully", "success");

        }
      </script>
    <?php }?>
<?php } ?>

<style type="text/css">
  .c_error{
    color:red;
    margin-top:5px;
    display:block;
  }

  .close_img{
    color: white;
    background: red;
    font-weight: bold;
    width: 30px;
    height: 30px;
    display: block;
    text-align: center;
    line-height: 32px;
    border-radius: 250px;
    position: absolute;
    top: -15px;
    right:0px;
  }
  .loader {
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 9999;
    top: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6588235294117647);
     display: none; 
}
.loader_img {
    display: block;
    margin: 0 auto;
    width: 70px;
    margin-top: 20%;
}
button#image_upload {
    background: #ef6b06;
    border: 2px solid #bd5100;
    border-radius: 250px;
    width: 100%;
    margin-top: 10px;   
    font-family: lato !important;
    transition: all cubic-bezier(0.4, 0, 1, 1);
}
#ImageBrowse {
    visibility: hidden;
    position: absolute;
}
.image_box{
  display: none;
}
</style>

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto+Slab:700' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('mouseenter', '.image_div', function () {    
            $('.image_box').show();
         }).on('mouseleave', '.image_div', function () {
            $('.image_box').hide();
    });
  });
</script>
<div class="loader">
    <img src="<?php echo base_url(); ?>assets/img/loader.gif" class="loader_img">
 </div>
<section id="list-detail">

<div class="container">
  <div class="row">
    <div class="list-d-inner col-md-12">
      <div class="breadcrumb_section">
        <div class="bread-left-sec col-md-6"><a href="<?php echo base_url(); ?>">HOME&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="<?php echo base_url(); ?>profile" style="color:#ff6d00;">PROFILE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="bread-right_sec col-md-6">
          <div class="swicher_btn pull-right">
            <ul>
            <?php if ($UserType=='buyer') { ?>
              <li><a class="switch_active" href="#">BUYER</a></li>
            <?php  }else{?>
              <li><a class="switch_active" href="#">SELLER</a></li>
            <?php  }?> 
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main-box05">
    <div class="row">
      <div class="col-md-3">
        <div class="left-sec-08">
         

        <form name="photo" id="imageUploadForm" enctype="multipart/form-data"  method="post">
          <div class="image_div">
            <img id='img-upload' src="<?php echo base_url(); ?>assets/img/profile_image/<?php echo $profile_image;?>" class="change-profile" style="object-fit: unset;">
            <div class="image_box">
            <button type="button" class="btn btn-info center-block" id="image_upload">Browse</button>

            <input type="file" id="ImageBrowse" name="image" accept=".png,.PNG,.jpg,.JPG,.jpeg,.JPEG" multiple="false"/>
            </div> 
          </div>  
        </form>

          <div class="whole-box">
            <div class="tab">
              <h5>Account information</h5>
              <a class="tablinks" onclick="openCity(event, 'Dashboard')" style="display: none;"> <img src="<?php echo base_url(); ?>assets/img/dashboard-png.png"> Dashboard</a>
              <a class="tablinks" onclick="openCity(event, 'my_profile')" id="defaultOpen"> <img src="<?php echo base_url(); ?>assets/img/my-profile.png"> My Profile</a>
              <a class="tablinks" style="display: none;"> <img src="<?php echo base_url(); ?>assets/img/Account-info.png" > Account Info</a>
              <a class="tablinks"  onclick="openCity(event, 'my_favorites')"> <i class="fa fa-heart" id="seller_fav" aria-hidden="true" style="padding-right: 20px;color: #f96c04;"></i> My Favorites</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div id="Dashboard" class="tabcontent">
          <div class="row dashboard-boxes">
            <div class="col-md-6 another-box">
              <span>Welcome Back, Romain!</span>
              <h4>Dashboard</h4>
            </div>
            <div class="col-md-6 ">
              <div class="box-05">
                <span class="span-box">06 <p>Favorites</p></span>
                <span>0 <p>Follow</p></span>
              </div>
            </div>
          </div>
            <div class="row starting-row">
              <div class="col-md-6 pad-01">
                <div class="Other-left">
                  <div class="heading-inner01">
                    <h4>My Favorites item</h4>
                  </div>
                  <div class="new-02">
                    <p>Kimber Pro-Carry Stainless</p>
                    <p>Black Rain Ordnance M4 American </p>
                    <p>Black Rain Ordnance M4 American </p>
                    <p>BLASER K95 , BLACK EDITION, LEFT HAND, 308</p>
                    <p>FFL License Guide - FFL123.com</p>
                    <p>Saiga AK style rifle</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 pad-0">
                <div class="Other-right">
                 <div class="heading-inner01">
                  <h4>Follow</h4>
                </div>
                <div class="new-02">
                  <p style="border-bottom: none;">No Followed contacts are associated with this profile.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="my_profile" class="tabcontent">
          <div class="my-account-start">
            <div class="row">
             <div class="col-md-12">
             <form id="update_profile">
              <div class="Other-left">
                <div class="heading-inner01">
                  <h4>My Profile</h4>
                </div>
                <div class="new-03">
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01" placeholder="Romain">Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Name" value="<?php echo $first_name;?>">
                        <span class="c_error" id="f_name_valid"></span>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control input-sm" placeholder="Company Name" value="<?php echo $company_name;?>" >
                        <span class="c_error" id="company_name_valid"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Address 1</label>
                        <input type="text" name="address1" id="address1" class="form-control input-sm" placeholder="Address 1" value="<?php echo $address1;?>">
                        <span class="c_error" id="address_valid"></span>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Address 2</label>
                        <input type="text" name="address2" id="address2" class="form-control input-sm" placeholder="Address 2" value="<?php echo $address2;?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Country</label>
                        <input type="text" name="country" id="country" class="form-control input-sm" placeholder="Country" value="<?php echo $country;?>">
                         <span class="c_error" id="country_valid"></span>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">State</label>
                        <input type="text" name="state" id="state" class="form-control input-sm" placeholder="State" value="<?php echo $state;?>">
                        <span class="c_error" id="state_valid"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">City</label>
                        <input type="text" name="city" id="city" class="form-control input-sm" placeholder="City" value="<?php echo $city;?>">
                        <span class="c_error" id="city_valid"></span>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Zip Code</label>
                        <input type="text" name="zipcode" id="zipcode" class="form-control input-sm" placeholder="Zip Code" value="<?php echo $zipcode;?>">
                        <span class="c_error" id="zip_valid"></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Cell Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Cell Phone" value="<?php echo $phone;?>">
                        <span class="c_error" id="phone_valid"></span>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01">Business Phone</label>
                        <input type="text" name="business_phone" id="business_phone" class="form-control input-sm" placeholder="Business Phone" value="<?php echo $business_phone;?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01" style="width: 100%">I am a FFL Holder/ Licensed Gun Dealer</label>

                        <label><input type="radio" class="radio-inline" name="ffl_licenced" value="yes" <?php if ($FFL_LGD=='yes') { echo "checked"; } ?> ><span class="outside"><span class="inside"></span></span>Yes</label>

                        <label><input type="radio" class="radio-inline" name="ffl_licenced" value="no" <?php if ($FFL_LGD=='no') { echo "checked"; } ?>><span class="outside"><span class="inside"></span></span>No</label>
                       
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="control-label side-by01" style="width: 100%">Preferred contact and notification method</label>
                       
                          <label><input type="radio" class="radio-inline" name="prefered_contact" value="email" <?php if ($prefered_contact=='email') { echo "checked"; } ?>><span class="outside"><span class="inside"></span></span>Email</label>

                          <label><input type="radio" class="radio-inline" name="prefered_contact" value="text" <?php if ($prefered_contact=='text') { echo "checked"; } ?>><span class="outside"><span class="inside"></span></span>Text</label>

                          <label><input type="radio" class="radio-inline" name="prefered_contact" value="both"  <?php if ($prefered_contact=='both') { echo "checked"; } ?>><span class="outside"><span class="inside"></span></span>Both</label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                    <label>Area of Interest</label>
                      <br><select class="form-control" style="" name="aoi">
                          <option></option>
                          <option <?php if ($aoi=='pistol') { echo "selected"; } ?> value="pistol">Pistol</option>
                          <option <?php if ($aoi=='ammunition') { echo "selected"; } ?> value="ammunition">Ammunition</option>
                          <option <?php if ($aoi=='gun_buds') { echo "selected"; } ?>  value="gun_buds">Gun Buds</option>
                          </select>
                    </div>
                  </div>  
                 <!--  <div class="form-group">
                    <label class="control-label side-by01">About Me/ Extra Details</label>
                    <textarea class="form-control" type="textarea" id="message" maxlength="140" rows="7"></textarea>
                  </div> -->

                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <button type="button" class="btn btn-warning pull-right" style="margin-top: 15px;border-radius: 5px;" onclick="return profile_update();">Update</button>
                    </div>
                  </div>                    
                </div>
               </div>
              </form>
              <div class="Other-left" style="display: none;">
                <div class="heading-inner01">
                  <h4>My Account</h4>
                </div>
                <div class="new-03">
                  <div class="one-row-01" style="margin-bottom: 55px;">
                   <div class="heading-inner02">
                    <label class="control-label side-by01">Select Your Card </label> 
                    <span><img src="<?php echo base_url(); ?>assets/img/arrow-going.png"></span>  
                    <span><img src="<?php echo base_url(); ?>assets/img/card-images.png"></span>
                  </div>
                  <div class="another-view">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="control-label side-by01">Card Number</label>
                          <input type="text" name="" id="" class="form-control input-sm">
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                          <label class="control-label side-by01" style="display: block;">Expires</label>
                          <input type="text" class="form-control exipres01" id="" placeholder="MM" required  />

                          <input type="text" class="form-control exipres01" id="" placeholder="YY" required / style="margin-left: -4px;"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="control-label side-by01">Name on Card</label>
                            <input type="text" name="first_name" id="" class="form-control input-sm" placeholder="Romain D’souza">
                          </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                            <label class="control-label side-by01">CVV Code</label>
                            <input type="text" name="last_name" id="" class="form-control input-sm small-size">
                          </div>
                        </div>
                        <button type="button" class="btn btn-warning pull-left">Add Card</button>
                      </div>
                    </div>                  
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>
      </div>

        <div id="my_favorites" class="tabcontent">
          <div class="row dashboard-boxes">
            <div class="col-md-6 another-box">
             <!--  <span>Welcome Back, my fav!</span> -->
              <h4>FAVORITES</h4>
            </div>
            <div class="col-md-6 ">
              <div class="box-05">
                <span class="span-box"> <?php 
                  $fav= get_favorites($user_id); 
                  echo $fav->total_fav;
                   ?><p>Favorites</p></span>
                <span><?php 
                  $follow= get_follow($user_id); 
                  echo $follow->total_follow;
                   ?><p>Follow</p></span>
              </div>
            </div>
          </div>
            <div class="row starting-row">


      <?php
          if (!empty($favourite)) { 
              foreach ($favourite as $value) {
                
                if ($value->profile_image !='') {
                  $profile_image=$value->profile_image;
                }else{
                  $profile_image='user_profile.png';
                }
             
            ?>
              <div class="col-md-3 col-sm-4 grid_col">
                <div class="grid_img">    
               <a href="<?php echo base_url(); ?>user/favourite_remove/<?php echo $value->id; ?>"><span class="close_img">X</span></a>          
                    <img class="display_section" src="<?php echo base_url()?>assets/img/profile_image/<?php echo $profile_image;?>" style="height:200px;width: 200px; ">
                </div>
             
                <div class="grid_pro_head">
                    <?php  echo $value->first_name;?>
                    <a href="<?php echo base_url(); ?>message"><i class="fa fa-envelope" aria-hidden="true" style="color: #ff6d00 !important;"></i></a>
                  
                </div>
               
                  <div class="bottom_reserve">
                    <a href="<?php echo base_url(); ?>buy/seller_<?php echo $value->id; ?>">
                      <span class="reserve_status pull-left" style="color: #FFF;">View listing</span>
                    </a>
                  </div>
              </div>
        <?php  } }   ?>

            
          
            <!-- sss -->

          </div>
        </div>

<!-- <div id="Tokyo" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div> -->

          </div>
        </div>


        </div>
      
</div>
</section>

<script type="text/javascript">
  $(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {
      $(".loader").show();
        e.preventDefault();
        var formData = new FormData(this);
        var base_url = $('#base_url').val(); 
        $.ajax({
            type:'POST',
            url: base_url+'user/change_profile_image',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
              $(".loader").hide();
                swal("Success!", "Image update successfully.", "success");
            },
            error: function(data){
               swal("Success!", "Something went wrong.", "success");
            }
        });
    }));

    $("#ImageBrowse").on("change", function() {     
        $("#imageUploadForm").submit();
    });
});
</script>

<script>
function openCity(evt, cityName) {

    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script>
  $(document).ready(function(){
    $("#image_upload").click(function(){
      $("#ImageBrowse").trigger( "click" );
    });
  });
</script>
<script>
  $(document).ready( function() {      
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#ImageBrowse").change(function(){
        readURL(this);
    });    
  });
</script>