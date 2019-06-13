<style type="text/css">
    .c_error{
        color:red;
        margin-top:5px;
        display:block;
    }
    .swal-text{text-align: center;}

</style>
<?php if(isset($success_msg)){?>
<script type="text/javascript">swal("Congratulations!", "<?php echo $success_msg;?>", "success");</script>
<?php }else if(isset($error_msg)){?>
<script type="text/javascript">swal("Oops!", "<?php echo $error_msg;?>", "error");</script>
<?php } 
if(isset($list_page)){?>
    <input type="hidden" id="list_page" value="<?php echo $list_page;?>">
<?php } 
if(isset($like)){?>
    <input type="hidden" id="home_like" value="1">
<?php }
if(isset($buy_like)){?>
    <input type="hidden" id="buy_like" value="1">
<?php } ?>
<section class="Banner-Start">
    <div class="container">
        <div class="col-md-12">
        <img src="<?php echo base_url(); ?>assets/img/Sign-In-to-Buy-and-Sell--Your-Favourite-Item.png">
       </div>
    </div>
</section>
<section class="content_section">   
<div class="container">
<!--sign in form section -->
<div class="sign_in_section col-md-12">
<!--sign in form left section category widget-->
<?php $this->load->helper('form'); ?>
<h1>Sign In !</h1>
<div class="left_form_sec col-md-6">
<div class="sign_form_inner">
    <?php $this->load->helper("form"); ?>
    <form id="form_sign_in" method="POST" action="<?php echo base_url();?>user/sign_in" class="sign_in_action" >
        <div class="sign_form">
            <div class="col-md-12 form-input">
                <label>Email<span style="color:red;">*</span></label><br />
                <input name="l_email" id="l_email" type="text" class="form-control required email" 
                <?php if(isset($_COOKIE['email'])) {?>
                    value="<?php echo $_COOKIE['email'];?>"
                <?php } else { ?>
                    value="<?php echo set_value('email'); ?>" 
                <?php } ?>
                />
                <span class="c_error" id="l_email_valid"></span>
            </div>
            <div class="col-md-12 form-input">
                <label>Password<span style="color:red;">*</span></label><br/>
                <input name="l_password" id="l_password" type="password" 
                <?php if(isset($_COOKIE['password'])) {?>
                    value="<?php echo $_COOKIE['password'];?>"
                <?php } else { ?>
                    value="<?php echo set_value('password'); ?>"
                <?php } ?>
                />
                  <div class="form-drop"><input name="remember" id="remember" type="checkbox" <?php if(isset($_COOKIE['email']) && ($_COOKIE['password'])){
                        echo 'checked';
                    } ?> /> Remember my log in information</div>
                <span class="c_error" id="l_pass_valid"></span>
                <div class="forget"><a href="<?php echo base_url('forgot-password');?>">Forgot your password?</a></div>
            </div>

        </div>
        <div class="Submit_btn">
        	<!-- <a href="javascript:void(0)" class="btn_click" onclick="return sign_in();" >LOGIN </a> -->
            <a href="javascript:void(0)" class="btn_click" onclick="return sign_in();" >LOGIN </a>
        </div>
    </form>
</div>
</div>

<!--sign in form left section category widget end-->
<!--adverd right section and content start-->
<div class="right_adverd_sec col-md-6">
<div class="first-ad"><img class="img-fluid" src="<?php echo base_url(); ?>assets/img/right-banner-start.png"/></div>
</div>
<!--adverd right section and content end-->
</div>
<!--sign in form section end-->
</div>
</section>