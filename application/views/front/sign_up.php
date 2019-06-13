<style type="text/css">
	.c_error{
		color:red;
		margin-top:5px;
		display:block;
	}
</style>
<section class="Banner-Start">
    <div class="container">
        <div class="col-md-12">
        <img src="<?php echo base_url(); ?>assets/img/create-your-free-account-now!.png">
       </div>
    </div>
</section>
<div class="container">
	<div class="row" style="    margin-left: 15px;    margin-right: 15px;">
<!--sign in form section -->
<?php $this->load->helper('form'); ?>
<div class="sign_in_section">
	<h1>Sign Up !</h1>
</div>

<section class="content_section sign-in">
<form id="Sign_up_form">
<div class="row">

<div class="col-md-8" style="padding: 0px;">
    <div class="right_register_sec">
<div class="sign_form_inner">
<div class="sign_form regi_01from">

		<div class="col-md-6 form-input">
		<label>Name<span style="color:red;">*</span></label><br>
		<input name="fname" id="fname" class="form-control" type="text">
		<span class="c_error" id="f_name_valid"></span>
		</div>
		<div class="col-md-6 form-input">
		<label>Company Name<span style="color:red;">*</span></label><br>
		<input name="company_name" id="company_name" class="form-control" type="text">
		<span class="c_error" id="company_name_valid"></span>
		</div>

	</div>
	<div class="sign_form regi_01from">

		<div class="col-md-12 form-input">
		<label>Address 1<span style="color:red;">*</span></label><br>
		<input name="address1" id="address1" class="form-control" type="text">
		<span class="c_error" id="address_valid"></span>	
		</div>

	</div>
	<div class="sign_form regi_01from">

		<div class="col-md-6 form-input">
		<label>Address 2</label><br>
		<input name="address2" id="address2" class="form-control" type="text">
		</div>
		<div class="col-md-6 form-input">
		<label>Country<span style="color:red;">*</span></label><br>
		<input name="country" id="country" class="form-control" type="text" />
		<span class="c_error" id="country_valid"></span>	
		</div>

	</div>
		<div class="sign_form regi_01from">

		<div class="col-md-6 form-input">
		<label>State<span style="color:red;">*</span></label><br>
		<input name="state" id="state" class="form-control" type="text">
		<span class="c_error" id="state_valid"></span>	
		</div>
		<div class="col-md-6 form-input">
		<label>City<span style="color:red;">*</span></label><br>
		<input name="city" id="city" class="form-control" type="text">
		<span class="c_error" id="city_valid"></span>	
		</div>

	</div>
	<div class="sign_form regi_01from">

		<div class="col-md-6 form-input">
		<label>Zip Code<span style="color:red;">*</span></label><br>
		<input name="zipcode" id="zipcode" type="text" class="return_number form-control" maxlength="10">
		<span class="c_error" id="zip_valid"></span>	
		</div>
		<div class="col-md-6 form-input">
		<label>Email Address<span style="color:red;">*</span></label><br>
		<input name="email" id="email" class="form-control" type="text" />
		<span class="c_error" id="email_valid"></span>	
		</div>

	</div>
	
	<div class="sign_form regi_01from">

		<div class="col-md-6 form-input">
		<label>Cell Phone<span style="color:red;">*</span></label><br>
		<input name="phone" id="phone" type="text" class="return_number form-control" maxlength="15">
		<span class="c_error" id="phone_valid"></span>	
		</div>
		<div class="col-md-6 form-input">
		<label>Business Phone</label><br>
		<input name="business_phone" id="business_phone" class="return_number form-control" type="text" maxlength="15">
		</div>

	</div>
<div class="sign_form regi_01from">
	<div class="col-md-6 filter_lable form-input"><br>
		<label>Area of Interest<span style="color:red;">*</span></label>
		<select class="filter_select" style="-webkit-appearance: none;" name="aoi">
	      	<option value="ammunition">Ammunition</option>
		    <option value="gun_buds">Gun Buds</option>
		    <option value="pistol">Pistol</option>
      	</select>
     </div>
     <div class="col-md-6 filter_lable form-input"><br>
		<label>User Type<span style="color:red;">*</span></label>
		<select class="filter_select" style="-webkit-appearance: none;" name="user_type">
      		<option value="buyer">Buyer</option>
	      	<option value="seller">Seller</option>
      	</select>
     </div>

  </div>
  <div class="sign_form regi_01from">
  	<p>I am a FFL Holder/ Licensed Gun Dealer<span style="color:red;">*</span></p>

  <label><input type="radio" class="radio-inline" name="ffl_licenced" value="yes"><span class="outside"><span class="inside"></span></span>Yes</label>

    <label><input type="radio" class="radio-inline" name="ffl_licenced" value="no" checked><span class="outside"><span class="inside"></span></span>No</label>
</div>

  <div class="sign_form regi_01from">
  	<p>Preferred contact and notification method</p>
  	
  <label><input type="radio" class="radio-inline" name="prefered_contact" value="email"><span class="outside"><span class="inside"></span></span>Email</label>

  <label><input type="radio" class="radio-inline" name="prefered_contact" value="text"><span class="outside"><span class="inside"></span></span>Text</label>

  <label><input type="radio" class="radio-inline" name="prefered_contact" value="both" checked><span class="outside"><span class="inside"></span></span>Both</label>

</div>
  <div class="sign_form regi_01from">

		<div class="col-md-6 form-input">
		<label>Password <span style="color:red;">(8 characters or more)</span></label><br>
		<input name="password" id="password" class="form-control" type="password">
		<span class="c_error" id="pass_valid"></span>
		</div>
		<div class="col-md-6 form-input">
		<label>Repeat password<span style="color:red;">*</span></label><br>
		<input name="cpassword" id="cpassword" class="form-control" type="password">
		<span class="c_error" id="c_pass_valid"></span>	
		</div>

	</div>
<div class="col-md-12" style="padding-left: 0px; width:100%; float:left;">
	<div class="note ">
		<p><strong>Note:</strong> *You will receive an email (or text) to verify your address and 
authorize your account login</p>
	</div>
	<div class="Submit_btn"><a class="btn_click" onclick="return register_form();">SUBMIT</a></div>
</div>
</div>

</div>
</div>
<div class="col-md-4 img-part">
	<div class="first-ad"><img class="img-fluid" src="<?php echo base_url(); ?>assets/img/sign-up-01.png"></div>
	<div class="first-ad"><img class="img-fluid" src="<?php echo base_url(); ?>assets/img/sign-up-02.png"></div>
</div>
</div>
</form>
</section>
</div>
</div>


<script type="text/javascript">
$("#password").keydown(function (e) {
    if (e.keyCode == 32) { 
       return false;
    }
});
$("#cpassword").keydown(function (e) {
    if (e.keyCode == 32) { 
       return false;
    }
});
</script>

