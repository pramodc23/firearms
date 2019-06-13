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
        <div class="form-widget">Reset Password</div>

        <form id="form_reset_pass" method="post" class="sign_in_action">
            <div class="sign_form">
            	<input type="hidden" value="<?php echo $code;?>" id="p_code">
                <div class="col-md-6 form-input">
                    <label>New Password<span style="color:red;">*</span></label><br />
                    <input name="n_pass" id="n_pass" type="password" class="form-control require" />
                    <span class="c_error" id="reset_pass_valid"></span>
                </div>
                <div class="col-md-6 form-input">
                    <label>Confirm Password<span style="color:red;">*</span></label><br />
                    <input name="c_n_pass" id="c_n_pass" type="password" class="form-control require" />
                    <span class="c_error" id="reset_c_pass_valid"></span>
                </div>

            </div>
            <div class="Submit_btn">
            	<a href="javascript:void(0)" class="btn_click" onclick="return reset_password();" >Submit </a>
            </div>
        </form>

    </div>
</div>

<!--Forgot Password form left section category widget end-->
<!--adverd right section and content start-->
<div class="right_adverd_sec col-md-6">
<div class="first-ad"><img src="<?php echo base_url(); ?>assets/img/ad_001.jpg"/></div>
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
<img src="<?php echo base_url(); ?>assets/img/ad_002.jpg"/>
</div>
</div>
<!--adverd right section and content end-->
</div>
<!--Forgot Password form section end-->
</div>
</div>
</section>