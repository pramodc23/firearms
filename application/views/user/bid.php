<?php 

  $list_id=$this->uri->segment(2);

    $user_type=$this->session->userdata('user_type');

?>
<style type="text/css">
.row.new-white-box {
    border: 1px solid #c6c4c4;
    margin-bottom: 28px !important;
    margin: 0px 15px;
    margin-top: 28px;
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

.main-box05 {
    margin: 0px 30px;
}

/*pramod css*/
ul.pagination a {
    border-radius: 50px !important;
    background: #eeeeee;
    color: #444444 !important;
    font-size: 15px;
    font-family: lato;
    font-weight: 600;
    border: none;
    margin-right: 13px;
        padding: 4px 11px;
}
.pagination>.active>a {
    background: #f96c04;
    color: white !important;
}

select{
  width: 100%;
height: 37px;
border-radius: 5px;
border: 1px solid #ccc;
padding-left: 10px;
color: #444;
font-size: 14px;
font-family: 'lato';
background-repeat: no-repeat !important;
font-style: italic;
background: url(../assets/img/drop_aerrow.png) #fff right;
}
.cancel_btn{
  background: #9e9e98;
    color: white;
    padding: 8px 17px;
    text-transform: uppercase;
    margin-right: 9px;
    font-size: 15px;
    font-family: arial;
}
.accept_btn{
  background: #f96c04;
    color: white;
    padding: 8px 17px;
    text-transform: uppercase;
    margin-right: 9px;
    font-size: 15px;
    font-family: arial;
    border:none;
}
.delete_btn{
  background: #dc3545;
    color: white;
    padding: 8px 17px;
    text-transform: uppercase;
    margin-right: 9px;
    font-size: 15px;
    font-family: arial;
     border:none;
}
.displaynone{
  display: none;
}
/*pramod css end*/
</style>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto+Slab:700' rel='stylesheet' type='text/css'>
<script type="text/javascript">
 
</script>

<section id="list-detail">
  <div class="container">   
    <?php if($bid_details){

      $list_id= $bid_details[0]->list_id;

      $title= $bid_details[0]->title;

      $thumb_image=get_thumb_image($list_id);
       
        if(!empty($thumb_image->url)){ 
          $item_image=$thumb_image->url;       
        }else{ 
          $item_image='image_not_found.png';
        } 

      ?> 

  <section class="second-box-01">
    <div class="row">
      <div class="col-md-12">
        <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>" style="border-radius: inherit;"> <span class="profile-details01"> </span> <span class="caption-new">BID - <span id="list_title_id"> <?php echo $title; ?></span>  </span>
     </div>
   </div>
  </section>
  <div class="main-box05">
    <div class="row">
     
    <div class="col-md-12 pad-01" id="network_result">

      <div class="table-section-08">
    
          <div class="side-by-side">
            <div class="row">
              <div class="col-md-8">
                <p>Show Items Bid  &nbsp;&nbsp;</p>
              </div>
              <div class="col-md-4 pull-right">
               <!--  <span><img src="<?php //echo base_url(); ?>assets/img/Print-ic.png"> Print</span> -->
              </div>
            </div>
          </div>
          <input type="hidden" name="page_limit" id="page_limit" value="0">
          <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
            <thead class="text-muted">
              <tr>

                <?php  
        if ($user_type=='buyer') { }else{ ?>
<th scope="col" class="text-left bidallselect" width="20%">
                  <input name="bid_checked_all" id="bid_checked_all" type="checkbox" value="bid_checked_all">Select All</th>
<?php }    ?>
              
                <th scope="col" class="text-left" width="20%">Username</th>
              
                <th scope="col"  class="text-left" style="text-align:center;" width="10%">Bid Amount</th>
                <th scope="col"  class="text-left" style="text-align:center;" width="10%">Status</th>
            
                <th scope="col"  class="text-right"  width="25%">action</th>
              </tr>
            </thead>
            <tbody id="bid_table">  
      
            </tbody>           
          </table> 

            <button id="delete_all" onclick="delete_all_bid();" class="accept_btn" style="display: none;" >Delete All</button>
            <div class="container">
                <div class="col-sm-12">
                  <ul id="pagination" class="pagination pagination-sm" style="float: right;"></ul>
                </div>
            </div>
    <?php }else{ ?>
    <div style="text-align: center;margin: 10%">
      <h2>Bid Not Available</h2>
    </div>

    
        </div>


    </div>
  </div>

  </div>
<?php } ?>
</div>
</section>

<script type="text/javascript">

    function paging(list_id,page_id)
    {
        var page = page_id;
        var page_limit=$("#page_limit").val(page_id);
        $.ajax({
            url: "<?php echo base_url();?>user_action/show_bid",
            method: "POST",
            data: { list_id : list_id, page : page},
            success: function(result){
                //console.log(result);     

                $('#bid_table').html(result);
              var bid_status_won= $('#bid_status_won').val();  
              if (bid_status_won==1) {
                  $('.bidallselect').addClass('displaynone')
              }      
            }
        });
        $.ajax({
            url: "<?php echo base_url();?>user_action/bid_page_count",
            method: "POST",
            data: { list_id : list_id, page_id : page_id},
            success: function(result){
                $('#pagination').html(result);
            },
            error: function (request, status, error) {
            },
            async:   true
        });
    }

    $(document).ready(function(){
        var list_id =  '<?php echo $list_id; ?>';
    
        page_id = 0;
        $.ajax({
            url: "<?php echo base_url();?>user_action/bid_page_count",
            method: "POST",
            data: { list_id : list_id, page_id : page_id},
            success: function(result){
                $('#pagination').html(result);
            },
            error: function (request, status, error) {
            },
            async:   true
        });
    
        var page = 0;
        $.ajax({
            url: "<?php echo base_url();?>user_action/show_bid",
            method: "POST",
            data: { list_id : list_id, page : page},
            success: function(result){
          
                $('#bid_table').html(result);
                $('#pagination').show();  
               var bid_status_won= $('#bid_status_won').val();  
               if (bid_status_won==1) {
                  $('.bidallselect').addClass('displaynone')
               }

                $('#bid_checked_all').click(function() {
                  if ($(this).is(':checked')) { 
                    $(".chk_bid_id").prop("checked", true);
                    $('#delete_all').show();
                  }else{
                    $(".chk_bid_id").prop("checked", false);   
                    $('#delete_all').hide();   
                  }  
                });

            },
            error: function (request, status, error) {
            },
            async:   true
        });
    });

 
</script>
<script type="text/javascript">
     function delete_request(id){  
 
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.post("<?php echo base_url("user_action/bid_delete"); ?>", {id: id}, function(result){
     
                      if (result=='Success') {
                        swal("Bid Deleted Successfully!", {
                          icon: "success",
                        });
                      }else{
                        swal("Something went wrong!", {
                          icon: "error",
                        });
                      }
                      location.reload();
                });

            } else {
                // swal("Student is safe!");
            }
        });
 
    } 
    function accept_request(id,list_id,bider_id){  

        swal({
          title: "Are you sure?",
          //text: "Once deleted, you will not be able to recover!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.post("<?php echo base_url("user_action/bid_accept"); ?>", {id: id,list_id:list_id,bider_id:bider_id}, function(result){

                      if (result=='Success') {
                        swal("Bid Accepted Successfully!", {
                          icon: "success",
                        });
                      }else{
                        swal("Something went wrong!", {
                          icon: "error",
                        });
                      }
                      location.reload();
                });

            } else {
                // swal("Student is safe!");
            }
        }); 
    } 

     function cancel_request(id,list_id,bider_id){  

        swal({
          title: "Are you sure?",
          //text: "Once deleted, you will not be able to recover!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.post("<?php echo base_url("user_action/bid_cancel"); ?>", {id: id,list_id:list_id,bider_id:bider_id}, function(result){
     
                      if (result=='Success') {
                        swal("Bid Cancel Successfully!", {
                          icon: "success",
                        });
                      }else{
                        swal("Something went wrong!", {
                          icon: "error",
                        });
                      }
                      location.reload();
                });

            } else {
                // swal("Student is safe!");
            }
        }); 
    } 

    function reaccept_request(id,list_id,bider_id,bid_amount){ 
 

        swal({
          //title: "Are you sure? aaa",
          text: "You have already accepted another bid for particular list item please cancel that bid  then accept other bid !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.post("<?php echo base_url("user_action/bid_reaccept"); ?>", {id: id,list_id:list_id,bider_id:bider_id,bid_amount:bid_amount}, function(result){
     
                      if (result=='Success') {
                        swal("Bid Accepted Successfully!", {
                          icon: "success",
                        });
                      }else{
                        swal("Something went wrong!", {
                          icon: "error",
                        });
                      }
                      location.reload();
                });

            } else {
                // swal("Student is safe!");
            }
        }); 
    } 
</script>



<script type="text/javascript">
  function delete_all_bid() {
      

         swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
              var val = [];
              $('.chk_bid_id:checked').each(function(i){
                val[i] = $(this).val();
              }); 
           
                $.post("<?php echo base_url("user_action/all_bid_delete_from_bid"); ?>", {bid_id:val}, function(result){ 
                      if (result=='Success') {
                        swal("Bid Accepted Successfully!", {
                          icon: "success",
                        });
                      }else{
                        swal("Something went wrong!", {
                          icon: "error",
                        });
                      }
                      location.reload();
                });

            } else {
                // swal("Student is safe!");
            }
        });
  }
</script>