<style type="text/css">
    .c_error{
        color:red;
        margin-top:5px;
        display:block;
    }
</style>
<section class="content_section sign-in">
<div class="container">
<!--Forgot Password form section -->
<div class="row">
<div class="sign_in_section col-md-12">
<!--Forgot Password form left section category widget-->
<?php $this->load->helper('form'); ?>
<div class="left_form_sec col-md-6">
    <div class="sign_form_inner">
        <div class="form-widget">Forgot Password</div>
		<div class="forgot_form">
            <div class="sign_form">

                <div class="col-md-12 form-input">
                    <label>Email<span style="color:red;">*</span></label><br />
                    <input name="f_email" id="f_email" type="text" class="form-control require email" />
                    <span class="c_error" id="f_email_valid"></span>
                </div>
			</div>
            </div>
            <div class="Submit_btn">
            	<a href="javascript:void(0)" class="btn_click" onclick="return forgot_password();" >Submit </a>
            </div>

    </div>
</div>

<!--Forgot Password form left section category widget end-->
<!--adverd right section and content start-->
<div class="right_adverd_sec col-md-6">
<div class="first-ad"><img src="<?php echo base_url(); ?>assets/img/slide_01.jpg"/></div>
</div>
<!--adverd right section and content end-->
</div>
<!--Forgot Password form section end-->
</div>
<div class="row">
<!--Forgot Password form section -->
<div class="sign_in_section col-md-12 second_sec">
<!--Forgot Password form left section category widget-->
<div class="left_form_sec col-md-6 second_sec">
<div class="sign_form_inner">
<div class="form-widget">Register</div>
<p class="regi_tag">Not a member? Register and get started today.</p>
<div class="Submit_btn"><a href="<?php echo base_url('sign-up');?>">REGISTER HERE!</a></div>
</div>
</div>
<!--Forgot Password form left section category widget end-->
<!--adverd right section and content start-->
<div class="right_adverd_sec col-md-6">
<div class="first-ad">
<img class="ad_second" src="<?php echo base_url(); ?>assets/img/Layer-6.jpg"/>
</div>
</div>
<!--adverd right section and content end-->
</div>
<!--Forgot Password form section end-->
</div>
</div>
</section>