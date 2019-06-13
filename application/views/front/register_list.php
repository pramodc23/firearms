<style type="text/css">
    .c_error{
        color:red;
        margin-top:5px;
        display:block;
    }
</style>
<?php if(isset($success_msg)){?>
<script type="text/javascript">swal("Congratulations!", "<?php echo $success_msg;?>", "success");</script>
<?php }else if(isset($error_msg)){?>
<script type="text/javascript">swal("Oops!", "<?php echo $error_msg;?>", "error");</script>
<?php } 
 ?>
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

<h1>Sign In !</h1>
<div class="left_form_sec col-md-6">
<div class="sign_form_inner">

    <form id="form_sign_in" method="POST" action="<?php echo base_url();?>home/formsubmit" class="sign_in_action"  enctype="multipart/form-data" >
        <div class="sign_form">
            
            <div class="col-md-12">

            	<div class="img_upload_inner">
                          <div class="col-md-12 img_label" style="padding-bottom: 20px;">Upload your video here:</div>
                          <div class="col-md-2 upload_btn">
                            <a id="primary_pic">Upload</a>
                            <input type="file" class="file_input" id="file1" name="vimeo_video" style="display:none"  >
                            <span class="display_err" id="primary_img_valid"></span>
                          </div>
                          <div class="col-md-2 img_thumb"></div>
                </div>
               <!--  <label>Upload<span style="color:red;">*</span></label><br/>
                <input name="vimeo_video" id="vimeo_video" type="file"  /> -->           
                
            </div>

        </div>
        <div class="Submit_btn" style="margin-left:50px;margin-top:20px;">
        	<!-- <a href="javascript:void(0)" class="btn_click" onclick="return sign_in();" >LOGIN </a> -->
         <input type="submit" name="submit"  value="submit">
        </div>
    </form>

<!--     <form method="POST" action="https://1512435595.cloud.vimeo.com/upload?ticket_id=172010074&video_file_id=1092816258&signature=ddd6ab9fc2eb9833c33784aa310d0305&v6=1&redirect_url=https%3A%2F%2Fvimeo.com%2Fupload%2Fapi%3Fvideo_file_id%3D1092816258%26app_id%3D133127%26ticket_id%3D172010074%26signature%3D92f1e5e9d0c8b74c9c490d10ec9d8a63eba00b31%26redirect%3Dhttps%253A%252F%252Fwebhungers.com%252Ffirearms-new-dev%252F\" enctype="multipart/form-data">
    <label for="file">File:</label>
    <input type="file" name="file_data" id="file"><br>
    <input type="submit" name="submit" value="Submit">
    </form> -->

<div id="append_video">
  
</div>

</div>
</div>
<button id="btn_id">Hello</button>
<script>
$(document).ready(function(){
    $("#btn_id").click(function(){

        var view='all';
        $.ajax({url: "<?php echo base_url("home/demo_testing");?>",
        type:'POST', 
        data:{view:view},
        success: function(result){  
       
          var dataObj = JSON.parse(result);          
  
           
            $("#append_video").html(dataObj[0]); 
                      
          // $(".loader").hide();
        }
      });

    });
});
</script>

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