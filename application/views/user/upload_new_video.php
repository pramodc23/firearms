
<style type="text/css">
	iframe{
		height: auto ;
	}
.col-md-3.show_video {
    position: relative;
        display: inline-block;

}
  .col-md-3.show_video span {
    position: absolute;
    top: 0px;
    right: 36px;
    border-radius: 30px;
    background: #da2222;
    width: 30px;
    height: 30px;
    color: #fff;
    text-align: center;
    line-height: 30px;
    font-weight: 900;
}
.btn_design{
      background-color: #ff6d00;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
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

</style>
<div class="loader">
    <img src="<?php echo base_url(); ?>assets/img/loader.gif" class="loader_img">
 </div>
<?php if(isset($success_msg)){?>
<script type="text/javascript">swal("Congratulations!", "<?php echo $success_msg;?>", "");</script>
<?php } ?>
<?php
$title='';
$item_number='';
$slug='';
if (!empty($listings)) {

  $item_number =$listings[0]['item_number'];
  $title =$listings[0]['title'];
  $slug =$listings[0]['slug'];
}
?>
<section class="content_section sign-in">
  <div class="container">
    <div class="row">
      <fieldset>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
            <div class="tabBlock-content">
                <div class="tab-content-inner main-con" style="padding: 0px;">
                  <div class="add-media second_part">



                    <div class="add_media_inner">
                      <div class="section_head"><?php echo $title; ?> # <?php echo $item_number; ?></div>

                    <h4 style="background: #fff;padding: 15px 31px;color: #ff6d00;font-size: 25px;font-family: 'lato';font-weight: bold;letter-spacing: 1px;">Upload Video:</h4>

            
                      <div class="section_content">

                      	
                      	<?php
                				if (!empty($user_video)) { ?>
                        <div class="row img_upload_main"  style="margin-bottom: 20px;">

                        <?php  $i=0;
                					foreach ($user_video as  $value) {
                						$vimeo_id= $value['url'];
					                  $id= $value['id']; 

    $l_Header = array("Authorization: bearer c71fcd4b6d2390df586bd0f8053b197d","Content-Type: application/json");      
    $l_URL = "https://api.vimeo.com/videos/$vimeo_id";
    $p_ParmList = '';   
      $ch = curl_init($l_URL);                                          
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $l_Header);      

      $result = curl_exec($ch); 
      if (!empty($result) ){
        $result1=json_decode($result, true);
       $video_status= $result1['transcode']['status'];

           if ($video_status=="complete") { ?>
             <div class="col-md-3 show_video" >                     
                            <a onclick="delete_video(<?php echo $vimeo_id;?>,<?php echo $id;?>);"><span >X</span></a>
                            <iframe id="reload_iframe_<?php echo $i;?>" src="https://player.vimeo.com/video/<?php echo $vimeo_id;?>?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=133127\" width="200" height="150" frameborder="0" title="Untitled" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                         </div>
          <?php }else{ ?>
              <div class="col-md-3 show_video" >                     
                <div style="background-color: #8d8375;color: #FFF;font-size: 14px;top: 50%;right: 0;bottom: 0;left: 0;margin: 8% 0%;text-align: center;width: 87%;height: 113px;line-height: 100px;">
                 You can view this video shortly message
             
                </div>
              </div>
         <?php  }  } ?>            				 	   
            				<?php 
                     $i++;} ?>
                     </div>

                  <?php   } ?>
            						


                      
                      

                      	<?php 
                   //  	if (false) {
					if (!empty($space_responce)) {


							if (!empty($space_responce['upload']['upload_link'])) {
								 $upload_link=$space_responce['upload']['upload_link'];
							}else{
								 $upload_link='';
							}
						 ?>
                    <div class="img_upload_main">
                      <div class="img_upload_sec">
                        <div class="img_upload_inner">
                        <div class="row">
                          <div class="col-md-2">Select Video:</div>
                          <form method="POST" action="<?php echo $upload_link; ?>" enctype="multipart/form-data" id="vimeo_form_id">  
                          <div class="row" style="margin: 0;padding: 0;">       
                            <div class="col-md-8">                              
  						                <input type="file"  class="file_input " name="file_data" id="file"   accept="video/*" style="width: 100%" required>
                            </div>
                            <div class="col-md-4">
                            	<input type="submit" name="submit" value="Submit" class="btn_design">
                            </div>
                          </div>
                         </form>
                        </div>

                        </div>
                      </div>
                    </div>    
                            	<?php
						 }else{
							echo "For inital user you are allowed to upload only 3 videos";
						}
					?>      
                      <div>
                        <!-- <div class="join_btn pull-right" style="padding-right: 15px;">
                          <a style="cursor:pointer; color:white;"  href="<?php echo base_url();?>list-details/<?php echo $slug;?>">List View</a>
                        </div> -->
                      </div>
                        
                  </div>

              

              </div>
            </div>
          </div>
        </div>   
        </figure>
        </div>
      </fieldset>
      <!--sign in form section end--> 
    </div>
  </div>
</section>


<script type="text/javascript">
$(document).ready(function() {
   $(".loader").hide(); 
  $("#vimeo_form_id").submit(function() {
    $(".loader").show();
  });

});


</script>
<script type="text/javascript">

  function delete_video(vimeo_id,video_id){

//alert(vimeo_id+"--"+video_id);
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
          
              $.ajax({url: "<?php echo base_url("user_action/delete_vimeo_video");?>",
                  type:'POST', 
                  data:{vimeo_id:vimeo_id,video_id:video_id},
                  success: function(result){           
                    if (result=='success') {
                          swal({
                              title: "Good job!",
                              text: "Your video deleted successfully",
                              type: "success"
                          }).then(function() {
                               location.reload();
                          });
                    }
                }
              }); 
            } else {
                // swal("Student is safe!");
            }
        });



  }

</script>
<script>
$(document).ready(function(){

  
  setTimeout(function(){ 
 
    // $("#reload_iframe_0").attr("src", function(index, attr){ 
    //   return attr;
    // });
  //     $("#reload_iframe_1").attr("src", function(index, attr){ 
  //     return attr;
  //   });

  // $("#reload_iframe_2").attr("src", function(index, attr){ 
  //     return attr;
  //   });

   }, 10000);





});



</script>


<!-- setTimeout( function(){ 
  
   var currSrc = $("#reload_iframe_1").attr("src");
   console.log(currSrc);
   $("#reload_iframe_1").attr("src", currSrc);
  
  },4000 ); -->