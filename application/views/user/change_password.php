<style type="text/css">
.c_error{
        color:red;
        margin-top:5px;
        display:block;
        float: right;
    }
	.row.new-white-box {
    border: 1px solid #c6c4c4;
    margin-bottom: 5px !important;
        margin: 0px 15px;
            margin-top: 25px;
}
.content-box {
    padding-top: 40px;
    padding-bottom: 40px;
    font-family: lato;
    text-align: center;
}
.content-box h3 {
    font-weight: 600;
}
iframe {
    height: 200px;
}
.another-sec01 {
    margin: 30px 15px 40px;
    box-shadow: -1px 1px 9px 0px #ccc;
    padding: 25px;
}
.another-sec01 h4 {
    background: #fff;
    padding: 15px 0;
    color: #ff6d00;
    font-size: 25px;
    font-family: 'lato';
    border-bottom: 3px solid #f0f0f0;
    font-weight: bold;
    letter-spacing: 1px;
}
.col-md-12.sec-05 .row {
    margin-top: 30px;
}
</style>

<div class="container">
    <div class="row new-white-box">
      <div class="col-md-12">
        <div class="content-box">
         <h2>Change Password</h2>
         <p>User can change password here.</p>
       </div>
      </div>
    </div>
    <div class="another-sec01">
        <div class="row">
        	<div class="col-md-6 sec-05" style="margin-left: 27%;">
        		<h4>Change Password</h4>
        		<div class="row" style="margin-top: 0px;">

<div class="sign_form_inner">
    <?php $this->load->helper("form"); ?>
    <form  method="POST" action="<?php echo base_url();?>user/update_password" autocomplete="off" >
        <div class="sign_form">
        
            <div class="col-md-12 form-input">
                <label>Old Password<span style="color:red;">*</span></label><br />
                <input autocomplete="off" name="l_old_password" id="l_old_password" type="password" class="form-control required"  />
                <span class="c_error" id="old_password_valid"></span>
            </div>
            <div class="col-md-12 form-input">
                <label>New Password<span style="color:red;">*</span></label><br/>
                <input name="l_password" id="l_password" type="password" />                  
                <span class="c_error" id="new_password_valid"></span>           
            </div>
            <div class="col-md-12 form-input">
                <label>Confirm Password <span style="color:red;">*</span></label><br/>
                <input name="c_password" id="c_password" type="password" />                  
                <span class="c_error" id="c_password_valid"></span>    
                <span class="c_error" id="match_password_valid"></span>       
            </div>

        </div>
        <div class="Submit_btn">
            <a href="javascript:void(0)"  onclick="return change_password();" >Update</a>
            <script >
                   $("#l_old_password").keydown(function (e) {
                     if (e.keyCode == 32) { 
                         return false;
                    }
            }); 


                    $("#l_password").keydown(function (e) {
                     if (e.keyCode == 32) { 
                         return false;
                    }
            });
                     $("#c_password").keydown(function (e) {
                     if (e.keyCode == 32) { 
                         return false;
                    }
            });

            </script>
        </div>
    </form>
</div>
                   
        		</div>
        	</div>
        </div>
    </div>
</div>
