
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

/*pramod css end*/
</style>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto+Slab:700' rel='stylesheet' type='text/css'>
<section id="list-detail">
  <div class="container">
    
   
  <section class="second-box-01">
    <div class="row">
      <div class="col-md-12">
       <img src="<?php echo base_url(); ?>assets/img/profile-01.png"> <span class="profile-details01">WELCOME <?php echo strtoupper($user_details[0]['first_name']);?></span> <span class="caption-new">BID</span>
     </div>
   </div>
  </section>
<div class="main-box05">
  <div class="row">
   
  <div class="col-md-12 pad-01" id="network_result">

    <div class="table-section-08">
    <?php if($bid_details){?>
        <div class="side-by-side">
          <div class="row">
            <div class="col-md-8">
              <p>Show Items I’m watching  &nbsp;&nbsp;All (1)  &nbsp;&nbsp;Active (1)  &nbsp;&nbsp;Ended</p>
            </div>
            <div class="col-md-4 pull-right">
              <span><img src="<?php echo base_url(); ?>assets/img/Print-ic.png"> Print</span>
            </div>
          </div>
        </div>
        <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
          <thead class="text-muted">
            <tr>
              <th scope="col" class="text-left" width="200"><input name="shipping_place" type="checkbox" value="seller_country"></th>
              <th scope="col" class="text-left">Thumb</th>
              <th scope="col" width="430" class="text-left">title</th>
              <th scope="col" width="430" class="text-left">Phone No</th>
          
              <th scope="col" width="160" class="text-right">action</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach ($bid_details as $key => $value) {
    
        if ($value->url!='') {
          $image= $value->url;
        }else{
          $image= 'image_not_found.png';
        }
          
         ?>  
            <tr>
              <td>
                <figure class="media">
                  <input name="shipping_place" type="checkbox" value="seller_country" >
                  <figcaption class="media-body">
                    <h6 class="title text-truncate"><?php echo $value->bid_amount; ?></h6>
                  </figcaption>
                </figure> 
              </td>
              <td class="text-left"> 
                <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $image; ?>">
              </td>
              <td> 
                <div class="price-wrap"> 
                  <p class="text-left">test gun</p> 
                  <p>
                    <span class="Curent-01" style="float: left;  padding-right: 20px;">Start Bid<span class="price-06">$20.50</span></span> 
                   
                  </p>
                </div> <!-- price-wrap .// -->
              </td>
               <td>
               <?php echo $value->phone; ?>
               </td>
            
             <td class="text-right"> 
               
               <span><img src="<?php echo base_url(); ?>assets/img/down-arrow-ic.png" style="width:auto;"></span>
             </td>
           </tr>
      <?php } ?>

         </tbody>
        </table> 
  <?php }else{ ?>
  <div style="text-align: center;">
    <h2>Bid not available</h2>
  </div>

  <?php } ?>
      </div>


  </div>
</div>

</div>

</div>
</section>


