<style type="text/css">
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
    height: 175PX;
    background: #000;
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
    /*margin-top: 30px;*/
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
    font-size: 15px;
    font-family: lato;
    font-weight: 600;
    border: none;
    margin-right: 13px;
    padding: 12px 17px;
    border: 1px solid #f96c04;
}
.pagination>.active>a {
    background: #f96c04;
    color: white !important;
}
.v_btn{
        border-radius: 5px;
    background-color: #ff6d00;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
    margin-right:5px;
}
</style>

<input type="hidden" id="loading" value="0">
<input type="hidden" id="offset" value="0">
<div class="loader">
    <img src="<?php echo base_url(); ?>assets/img/loader.gif" class="loader_img">
 </div>
<div class="container">
    <div class="row new-white-box">
      <div class="col-md-12">
        <div class="content-box">
         <h3>View and Upload Your Videos</h3>
         <p>Our profiles allow for users to upload videos of listed items to better demonstrate what they are selling and what you’ll be buying.</p>
       </div>
      </div>
    </div>
    <div class="another-sec01">
        <div class="row">
            <div class="col-md-12 sec-05">
                <h4>Most Recently Uploaded Videos</h4>
                <div class="row" style="margin-top: 0px;" id="video_result">
                   
                </div>         

            
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $( document ).ready(function() {
        show_video(0,10);  
    }); 




  function show_video(offset,limit){
    $(".loader").show();
   
    var view='apend';   
    //var limit =4;
    // var offset = $("#offset").val(); 

    $.ajax({url: "<?php echo base_url("user_action/get_all_video");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset},
        success: function(result){ 
            var dataObj = JSON.parse(result);  
            $("#video_result").html(dataObj[0]); 
            $(".loader").hide();
      }
    }); 
  }

</script>
<script type="text/javascript"> 
  function seller_login(){       
    swal( "Oops" ,  "You can't buy this item with seller account !" ,  "error" );
  }

  </script>