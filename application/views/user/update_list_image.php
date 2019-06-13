
<style type="text/css">
  iframe{
    height: auto ;
  }
.col-md-3.show_video {
    position: relative;
        display: inline-block;
        margin-bottom:20px;

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
.add_more_pic {
    background: #ff6d00;
    padding: 7px 20px;
    color: #fff !important;
    font-size: 15px;
    font-family: 'lato';
    margin-left: 4%;
}
.c_error{
    color:red;
    margin-top:5px;
    display:block;
  }

</style>

<div class="loader">
    <img src="<?php echo base_url(); ?>assets/img/loader.gif" class="loader_img">
 </div>


<?php  if(!$this->session->flashdata('image_success')==''){ 
    $image_success=$this->session->flashdata('image_success'); 
  ?>
    <script type="text/javascript">
        sweetalertsuccess();
        function sweetalertsuccess(){   
            swal("Good job!", "Image updated successfully", "success");
        }
    </script>
<?php }

?>
<section class="content_section sign-in tab">
  <div class="container">
    <div class="row">
      <fieldset>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
            <div class="tabBlock-content">
                <div class="tab-content-inner main-con" style="padding: 0px;">
                  <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head"> <?php echo $list_details[0]['title']; ?></div>
                      <h4 style="background: #fff;padding: 15px 31px;color: #ff6d00;font-size: 25px;font-family: 'lato';font-weight: bold;letter-spacing: 1px;">Upload Image:</h4>

             <form action="<?php echo base_url('user_action/update_image_for_list/'.$list_details[0]['id']);?>" method="post" id="update_listing" enctype="multipart/form-data">
                  <div class="section_content">  
                    <?php if (!empty($image_details)) {   ?>
                    <div class="row img_upload_main"  style="margin-bottom: 20px;">

                    <?php  $i=0;
                          foreach ($image_details as  $value) {
                            $image_url= $value['url'];
                            $id= $value['id']; 
                            ?>
              <div class="col-md-3 show_video img_row_<?php echo $i;?>"  >    
           
             
                <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $image_url;?>" width="200" height="150" alt="List image">
              </div>
         
                      <?php 
                      $i++;} 
                        ?>
                      </div>
                    <?php } ?>

                       <div id="picture_section">
                            <div class="img_upload_sec">
                              <div class="img_upload_inner">
                                <div class="col-md-2 img_label">Add Picture:</div>
                                <div class="col-md-2 upload_btn">
                                  <a onclick="a_photo(this)">Upload</a>
                                  <input type="file" class="file_input upd_file" name="a_file[]" style="display:none" onchange="a_readURL(this);" accept=".jpg,.jpeg,.png">
                                </div>
                                <div class="col-md-2 img_thumb"><img style="width:100%; height:100px;" class="a_display_section" src="<?php echo base_url(); ?>assets/img/image_not_found.png" id="display_a_pic1"/><a style="display:none;" onclick="a_cancel_img(this);" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                                 <span id="image_not_valid_msg" class="c_error"></span> 
                              </div>

                              <script>
                             //   $(document).ready(function() {
                             //    $('.upd_file').bind('change', function() { 
                             //    var a=(this.files[0].size);
                             //     alert(a);
                             //     if(a > 1000000) {
                             //     alert('large');
                             //    };
                             //  });
                             // }); 

                           </script>


                          
                            </div>
                          </div>
                          <div style="margin: 4% 0px;">
                            <a class="add_more_pic" style="background: #ff6d00; padding: 7px 20px;color: #fff !important;font-size: 15px;font-family: 'lato'; margin-left: 4%;">Add More Picture</a>
                          </div>
                          <div>
                              <div class="join_btn pull-right" style="padding-right: 15px;">
                                
                                <button type="submit"  class="btn_design">Submit</button>





                                <a href="<?php echo base_url(); ?>list-details/<?php echo $list_details[0]['slug']; ?>" class="btn_design" style="
                                height: 40px;">View Listing</a>


                              </div>
                          </div> 
                  </div>    
                </form>

                </div>

              

              </div>
            </div>
          </div>
          </figure>
        </div>   
         </fieldset>
        </div>     
      <!--sign in form section end--> 
    </div>
</section>




<script type="text/javascript">
  function delete_image(image_id,imagename,count){
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            
            $.ajax({url: "<?php echo base_url("user_action/delete_list_image");?>",
                  type:'POST', 
                  data:{image_id:image_id,imagename:imagename},
                  success: function(result){   
                      
                    if (result=='success') {
                          swal({
                              title: "Good job!",
                              text: "Your image deleted successfully",
                              type: "success"
                          }).then(function() {
                               $('.img_row_'+count).html('');
                          });
                    }else{
                      swal({
                              title: "Sorry",
                              text: "Some thing went wrong!",
                              type: "error"
                          }).then(function() {
                               //location.reload();
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