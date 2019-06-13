<style type="text/css">
iframe{
  height: auto ;
}
.display_err{color:red;display: block;}
.col-md-3.show_video {
  position: relative;
  display: inline-block;

}
.mynetwork_video_cal {
       box-shadow: 0 2px 5px rgba(0,0,0,0.05), 0 2px 5px rgba(0,0,0,0.15);
    padding: 4px 4px;
    /* box-shadow: 1px 2px 8px 1px #f1f0f0; */
 max-width: 19.5%;margin: 5px 3px 5px 2px;
}

.my_network_section {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}
/*
    padding-right: 0;
    margin-bottom: 30px;*/

    .filter_lable{    margin-top: 19px;}
    #pagination{margin-top: 28px;}
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
    #pagination{
      clear:both;
    }
    ul.pagination a {
      border-radius: 50px !important;
      background: #fff;
      color: #444444 !important;
      /* color: #f96c04; */
      font-size: 15px;
      font-family: lato;
      font-weight: 600;
      border: none;
      margin-right: 13px;
      padding: 12px 17px;
      /* padding: 4px 11px; */
      border: 1px solid #f96c04;
    }
    .pagination>.active>a {background: #f96c04;color: white !important;}
    .col-md-8.video_input {display: inline-block;}
    .col-md-8.video_input input {height: 35px;border-radius: 5px;border: 1px solid #ccc;width: 100%;}
    .main-content-tab.col-md-12 ,.tabBlock-content,.section_content{box-shadow: none!important;}
    .add_media_inner {box-shadow: 1px 2px 9px 1px #ccc;}
    .add_more_video{    margin-left: 17px;}
    .video_btns{float: right;}
    .join_btn a { margin-top: 0px; }
  </style>
  <div class="loader">
    <img src="<?php echo base_url(); ?>assets/img/loader.gif" class="loader_img">
  </div>
  <?php
  $title='';
  $item_number='';
  $slug='';
  if (!empty($listings)) {

    $item_number =$listings[0]['item_number'];
    $title =$listings[0]['title'];
    $slug =$listings[0]['slug'];
    $list_id =$listings[0]['id'];
    $mynetwork =$listings[0]['mynetwork'];   

  }
  ?>
  <section class="content_section sign-in hide_video">
    <div class="container">
      <div class="row">
        <fieldset>
          <div class="main-content-tab col-md-12">
            <figure class="tabBlock">
              <div class="tabBlock-content">
                <div class="tab-content-inner main-con">
                  <div class="add-media second_part">
                    <div class="add_media_inner">
                      <div class="section_head"><?php echo $title; ?> # <?php echo $item_number; ?></div>
                      <h4 style="background: #fff;padding: 15px 31px;color: #ff6d00;font-size: 25px;font-family: 'lato';font-weight: bold;letter-spacing: 1px;">Upload Video:</h4>
                      <div class="section_content"> 
                        <!-- Youtube url section -->
                        <div class="video_url_main" >
                          <p style="color:#444;font-weight:bold;font-family:'lato';">Add Videos by URL</p>
                          <p style="color:#ff6d00;font-family:'lato';margin-bottom:20px;">If you have one or more video that are hosted on a Web server.</p>
                          <div class="img_upload_main" >
                            <div class="img_upload_sec">
                              <div class="img_upload_sec" id="vimeo_video_apend">
                                <?php if (isset($youtube_video)) { 
                                  $i=0;
                                  foreach ($youtube_video as  $youtube_value) { ?>
                                    <div class="col-md-3 show_video section_<?php echo $i;?>" >                     
                                      <a onclick="youtube_video_delete(<?php echo $youtube_value['id'];?>,<?php echo $i;?>)"><span >X</span></a>
                                      <iframe src="<?php echo $youtube_value['url']; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="v_url"></iframe>
                                    </div>
                                    <?php  $i++; }
                                    ?>
                                    <form method="POST" action="<?php echo base_url("youtube_video_update").'/'.$list_id; ?>" enctype="multipart/form-data">
                                      <div id="video_section">
                                        <div class="img_upload_inner">
                                          <div class="col-md-2 img_label">Url :</div>
                                          <div class="col-md-4 video_input">
                                            <input name="youtube_video_url[]" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />
                                            <span class="display_err" id="video_url0_valid"></span>
                                          </div>                                                  
                                        </div>                                              
                                      </div> 
                                      <div>
                                        <span class="display_err" id="youtube_video_url_valid"></span>  
                                      </div>  
                                       <div class="col-md-2"></div>
                                      <div class="offset-md-2 col-md-8 ml-15">                                       
                                        <a class="add_more_video" ><span class="btn_design">Add More Video</span></a>
                                        <input type="submit" name="submit" value="Submit" class="btn_design" onclick="return youtube_url_update_validation();">
                                       </div>
                                    </form>
                                  <?php } else { ?>

                                    <form method="POST" action="<?php echo base_url("youtube_video_add").'/'.$list_id; ?>" enctype="multipart/form-data" >  
                                      <div class="img_upload_inner row">
                                        <div class="col-md-2 img_label">Url 1 :</div>
                                        <div class="col-md-4 video_input">
                                          <input name="video_url1" id="video_url1" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />
                                          <span class="display_err" id="video_url1_valid"></span>
                                        </div>                                             
                                      </div>
                                      <div class="img_upload_inner row">
                                        <div class="col-md-2 img_label">Url 2 :</div>
                                        <div class="col-md-4 video_input">
                                          <input name="video_url2" id="video_url2" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" /> 
                                          <span class="display_err" id="video_url2_valid"></span>
                                        </div>                                             
                                      </div>
                                      <div class="img_upload_inner row">
                                        <div class="col-md-2 img_label">Url 3:</div>
                                        <div class="col-md-4 video_input">
                                          <input name="video_url3" id="video_url3" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />
                                          <span class="display_err" id="video_url3_valid"></span>
                                        </div>                                              
                                      </div>
                                      <input type="submit" name="submit" value="Submit" class="btn_design" onclick="return youtube_url_add_validation();">
                                    </form>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr>
                          <?php
                        //show uploaded video
                          if (!empty($user_video)) { ?>
                            <div class="row img_upload_main"  style="margin-bottom: 20px;">

                              <?php  $i=0;
                              foreach ($user_video as  $value) {
                                $vimeo_id= $value['url'];
                                $id= $value['id']; 
                              // check video properly uploaded on vimeo                        
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
                              if ($video_limit==1) { ?>
                                <div class="img_upload_main">
                                  <div class="img_upload_sec">
                                    <div class="img_upload_inner">
                                      <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <form method="POST" action="<?php echo base_url("add_video");?>/<?php echo $list_id;?>" enctype="multipart/form-data" >  
                                          <div class="row" style="margin: 0;padding: 0;"> 
                                            <div class="col-md-10">    
                                              <div>For inital user you are allowed to upload only 3 videos</div>    
                                            </div>
                                            <div class="col-md-2">
                                              <input type="submit" name="submit" value="Submit" class="btn_design" >
                                            </div>
                                          </div>
                                        </form>
                                      </div>

                                    </div>
                                  </div>
                                </div> 
                              <?php }else{ 
                                if (!empty($space_responce)) {
                                  if (!empty($space_responce['upload']['upload_link'])) {
                                    $upload_link=$space_responce['upload']['upload_link'];
                                  }else{
                                    $upload_link= base_url("add_video").'/'.$list_id;
                                  }
                                }else{
                                  $upload_link= base_url("add_video").'/'.$list_id;
                                }
                                ?>
                                <div class="img_upload_main">
                                  <div class="img_upload_sec">
                                    <div class="img_upload_inner">
                                      <div class="row select-video">
                                        <div class="col-md-2">
                                          Select Video:  
                                        </div>
                                        <form method="POST" action="<?php echo $upload_link; ?>" enctype="multipart/form-data" id="vimeo_form_id">  
                                          <div class="row" style="margin: 0;padding: 0;">   
                                            <div class="col-md-10">   
                                             <input type="file"  class="file_input " name="file_data" id="file"   accept="video/*" style="width: 100%" >   
                                           </div>
                                           <div class="col-md-2">
                                            <input type="submit" name="submit" value="Submit" class="btn_design video-sbmt-btn" onclick="return from_validation();">
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>    
                              <?php  
                            }      
                            ?>
                            <hr> 
                            <!-- My network section -->

                            <form method="POST" class="my-network" action="<?php echo base_url("mynetwork_video_update").'/'.$list_id; ?>" >


                              <span class="btn_design my_network">My Network</span>    
                              <div class="my_network_section">   
                              </div>
                              <span class="display_err" id="mynetwork_video_valid"></span>
                              <input type="hidden" name="mynetwork_selected_video" id="mynetwork_selected_video" value="<?php echo $mynetwork;?>">
                              <input type="submit" name="submit" value="Submit" class="btn_design mynetwork_submit" onclick="return mynetwork_validation();">   
                     
                              


                            <div class="img_upload_main video_btns">
                           <!--    <div class="join_btn pull-right" style="padding-right: 15px;">
                                <a style="cursor:pointer; color:white;"  href="<?php //echo base_url();?>list-details/<?php// echo $l_slug;?>">View List</a>
                              </div> -->
                              <div class="join_btn pull-right" style="padding-right: 15px;">
                                <a style="cursor:pointer; color:white;"  href="<?php echo base_url();?>sell/<?php echo $l_slug;?>/step3">Previous</a>
                              </div>                    
                            </div> 
                      </form>                        
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
// $(document).ready(function() {
//    $(".loader").hide(); 
//   $("#vimeo_form_id").submit(function() {
//     $(".loader").show();
//   });

// });








  function youtube_url_update_validation(){ 
    var titles = []; 
    hav_error=0;       
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;    
    $('input[name^=youtube_video_url]').each(function(){
      var youtube_video_url=$(this).val();       
      if(youtube_video_url!=""){  
        if (youtube_video_url != undefined || url != '') {    
          var match = youtube_video_url.match(regExp);
          if (match && match[2].length == 11) {  } else {hav_error=1;
          }    }
        }else{}
      });
    

    if(hav_error==0){  
      $('#youtube_video_url_valid').text(""); 
      return true;
    }else{  
      $('#youtube_video_url_valid').text("Please Enter valid url");       
      return false;
    }
  }



  $( document ).ready(function() {
    show_mynetwork_video(0,10);  
  }); 

  function show_mynetwork_video(offset,limit){
    //$(".loader").show();   
    var video_id=$("#mynetwork_selected_video").val();

    var view='apend';
    $.ajax({url: "<?php echo base_url("user_action/get_mynetwork_video");?>",
      type:'POST', 
      data:{view:view,limit:limit,offset:offset,video_id:video_id},
      success: function(result){ 
        var dataObj = JSON.parse(result);  
        $(".my_network_section").html(dataObj[0]); 
           // $(".loader").hide();
         }
       }); 
  }


  function mynetwork_validation(){  
    var mynetwork_selected_video = $("#mynetwork_selected_video").val();  
    hav_error=0;
  
    if (mynetwork_selected_video=='') {
      $('#mynetwork_video_valid').text("Please select video");
      hav_error=1;
    }else{
      $('#mynetwork_video_valid').text("");
    }

    if(hav_error==0){  
      return true;
    }else{        
      return false;
    }
  }

  function youtube_url_add_validation(){  
    var video_url1 = $("#video_url1").val();
    var video_url2 = $("#video_url2").val();
    var video_url3 = $("#video_url3").val();
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
    hav_error=0;
    if(video_url1!=""){  
      if (video_url1 != undefined || url != '') {    
        var match = video_url1.match(regExp);
        if (match && match[2].length == 11) {        
          $('#video_url1_valid').text(""); } else {
            $('#video_url1_valid').text("Please Enter valid url");  hav_error=1;}}
          }else{  $('#video_url1_valid').text(""); }

        if(video_url2!=""){  
        if (video_url2 != undefined || url != '') {        
        var match = video_url2.match(regExp);
        if (match && match[2].length == 11) {        
        $('#video_url2_valid').text(""); } else {
        $('#video_url2_valid').text("Please Enter valid url");  hav_error=1;}}
        }else{  $('#video_url2_valid').text(""); }

        if(video_url3!=""){  
        if (video_url3 != undefined || url != '') {        
        var match = video_url3.match(regExp);
        if (match && match[2].length == 11) {        
        $('#video_url3_valid').text(""); } else {
          $('#video_url3_valid').text("Please Enter valid url");  hav_error=1;}}
        }else{  $('#video_url3_valid').text(""); }

      if(hav_error==0){  
        return true;
      }else{        
        return false;
      }

  }

  function from_validation(){   

    var file_length=$('#file').length;       
    if (file_length > 0) {
      var file=$('#file').val();
      if (file !='') {

      }else{   
        var form_url= "<?php echo base_url("add_video");?>/<?php echo $list_id;?>";
        $('#vimeo_form_id').attr('action', form_url);
      }            
    }else{   
      var form_url= "<?php echo base_url("add_video");?>/<?php echo $list_id;?>";
      $('#vimeo_form_id').attr('action', form_url);
    }     
    $(".loader").show();
  }




                    function youtube_video_delete(video_id,section_id){
                      swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {

                          $.ajax({url: "<?php echo base_url("user_action/youtube_video_delete");?>",
                            type:'POST', 
                            data:{video_id:video_id},
                            success: function(result){           
                              if (result=='success') {
                                swal({
                                  title: "Good job!",
                                  text: "Your video deleted successfully",
                                  type: "success"
                                }).then(function() {
                                  $(".section_"+section_id).remove();
                                });
                              }
                            }
                          }); 
                        } else {
                // swal("Student is safe!");
              }
            });
                    }
                    function delete_video(vimeo_id,video_id){
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
  // setTimeout(function(){  
  //   $("#reload_iframe_0").attr("src", function(index, attr){ 
  //     return attr;
  //   });
  //   $("#reload_iframe_1").attr("src", function(index, attr){ 
  //     return attr;
  //   });
  //   $("#reload_iframe_2").attr("src", function(index, attr){ 
  //     return attr;
  //   });
  //  }, 10000);
});
</script>