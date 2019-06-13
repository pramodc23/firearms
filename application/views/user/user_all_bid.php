<?php 
  $list_id=$this->uri->segment(2);
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
    <?php if($list_details ){
      $list_id= $list_details[0]['id'];
      $title= $list_details[0]['title'];  

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
        <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>" style="border-radius: inherit;"> <span class="profile-details01"> </span> <span class="caption-new">   <span id="list_title_id"> <?php echo $title; ?></span>  </span>
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
                <p>Show Bids List  &nbsp;&nbsp;</p>
              </div>
              <div class="col-md-4 pull-right"></div>
            </div>
          </div>
          <input type="hidden" name="page_limit" id="page_limit" value="0">
          <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
            <thead class="text-muted">
              <tr>             
                <th scope="col" width="10%">Item Name</th>
                <th scope="col"  width="10%">Bid Amount</th>
                <th scope="col"   width="10%" >Status</th>               
                <th scope="col"   width="10%">Date</th>
              </tr>
            </thead>
            <tbody id="sold_item_list_table">          
            </tbody>           
          </table>            
          <div class="container">
              <div class="col-sm-12">
                <ul id="pagination" class="pagination pagination-sm" style="float: right;"></ul>
              </div>
          </div>
      <?php }else{ ?>
          <div style="text-align: center;margin: 10%">
            <h2>Bid List Not Available</h2>
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
            url: "<?php echo base_url();?>user_action/show_user_all_bid_list",
            method: "POST",
            data: { list_id : list_id, page : page},
            success: function(result){
                $('#sold_item_list_table').html(result);
            }
        });
        $.ajax({
            url: "<?php echo base_url();?>user_action/user_all_bid_count",
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
            url: "<?php echo base_url();?>user_action/user_all_bid_count",
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
            url: "<?php echo base_url();?>user_action/show_user_all_bid_list",
            method: "POST",
            data: { list_id : list_id, page : page},
            success: function(result){          
                $('#sold_item_list_table').html(result);
                $('#pagination').show(); 
            },
            error: function (request, status, error) {
            },
            async:   true
        });
    });

 
</script>




