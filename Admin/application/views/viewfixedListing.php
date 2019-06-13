<style type="text/css">

  .media_div{
    padding: 0;
  }
  .media_div img {
    padding: 10px;
    border: 1px solid#ccc;
    margin-bottom: 10px;
    margin-left: 0;
    width: 200px;
    height: 200px;
  }
  .media_div iframe {
    padding: 10px;
    border: 1px solid#ccc;
    margin-bottom: 10px;
    margin-left: 0;
    width: 200px;
    height: 200px;
  }
  .nav_tabs_list>li {
    float: left;
    width: 24%;
    text-align: center;
    background-color: rgba(153, 153, 153, 0.46);
  }
  .nav_tabs_list>li a:hover {
    color:#ffffff;
    background-color: #337ab7;
    text-decoration: underline;
  }
  .nav>li.active a{
    text-decoration: underline;
  }
  .c_details th{
    width:30%;
  }
</style>

<?php 
  $currency='$';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> List Details
        <!-- <small>Preview</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('allFixed'); ?>"><i class="fa fa-list"></i> All Listings</a>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <div class="container">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills nav_tabs_list" role="tablist">
                      <li class="nav-item active">
                        <a class="nav-link" data-toggle="pill" href="#home"><b>Basic</b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#menu3"><b>More Details</b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#menu2"><b>Media</b></a>
                      </li>
                      
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                         <table class="table table-hover c_details">
                          <tr>
                            <th>Category</th>
                            <td><?php echo $list_details[0]['name'];?></td>
                          </tr>
                          <tr>
                            <th>Title</th>
                            <td><?php echo $list_details[0]['title'];  ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Seller Name</th>
                            <td>
                            <a href="<?php echo base_url(); ?>viewUser/<?php echo $user_details[0]['id'];?>"><?php if (!empty($user_details)){ echo $user_details[0]['first_name'];}?></a>
                              
                            </td>
                          </tr>
                          <tr>
                            <th>Item Condition</th>
                            <td><?php
                            if ($list_details[0]['item_condition']=='pre_owned') {
                              echo "Pre Owned";
                            }elseif ($list_details[0]['item_condition']=='new') {
                              echo "New";
                            }else{
                              echo "Old";
                            }
                             ?></td>
                           
                          </tr>
                          <tr>
                            <th>Item Location</th>
                            <td><?php 
                            if (!empty($list_details[0]['item_location'])) {
                              echo $list_details[0]['item_location'];
                            }else{
                              echo "NA";
                            }
                            ?></td>
                          </tr>
                          <tr>
                            <th>Country</th>
                            <td><?php 
                             if (!empty($list_details[0]['country'])) {
                              echo $list_details[0]['country'];
                            }else{
                              echo "NA";
                            }
                            ?></td>
                          </tr>
                          <tr>
                            <th>Federal Firearms License (FFL)</th>
                            <td><?php if($list_details[0]['FFL']==1){echo 'Yes';}else{echo 'No';}?></td>
                          </tr>
                          <tr>
                            <th>Mfg Part Number</th>
                            <td><?php
                             if (!empty($list_details[0]['MFG'])) {
                              echo $list_details[0]['MFG'];
                            }else{
                              echo "NA";
                            }
                            ?></td>
                          </tr>
                          <tr>
                            <th>SKU</th>
                            <td><?php 
                            if (!empty($list_details[0]['SKU'])) {
                              echo $list_details[0]['SKU'];
                            }else{
                              echo "NA";
                            }
                           ?></td>
                          </tr>
                          <tr>
                            <th>Serial Number</th>
                            <td><?php
                             if (!empty($list_details[0]['serial_number'])) {
                              echo $list_details[0]['serial_number'];
                            }else{
                              echo "NA";
                            }
                             ?></td>
                          </tr>
                          <tr>
                            <th>UPC</th>
                            <td><?php if (!empty($list_details[0]['UPC'])) {
                              echo $list_details[0]['UPC'];
                            }else{
                              echo "NA";
                            }
                             ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td><?php
                            if (!empty($list_details[0]['description'])) {
                              echo $list_details[0]['description'];
                            }else{
                              echo "NA";
                            }
                             ?></td>
                          </tr>
                          <tr>
                            <th>Reserve price met</th>
                            <td><?php                             
                                  if (!empty($maxbid_amount)) {
                                       $maxbid_amount= $maxbid_amount[0]['maxbid_amount'];
                                       $reserve_price= $list_details[0]['reserve_price'];

                                      if ($reserve_price <= $maxbid_amount) {
                                          echo "Reserve price met";
                                      }else{
                                          echo "Not met";
                                      }  

                                    }

                             ?></td>
                          </tr>

                          <tr>
                            <th>Status</th>
                            <td><?php
                              $today_date = date("Y-m-d H:i:s");
                              $status=$list_details[0]['status'];
                              $end_auction=$list_details[0]['end_auction'];
                                if ($status=='sold') {
                                  echo "Sold";
                                }else{ 
                                  if ($end_auction >= $today_date) {
                                    echo 'In-auction';
                                  }else{
                                    echo 'Expired';
                                  }                       
                                 }
                            
                             ?></td>
                          </tr>

                        <form method="POST" action="<?php echo base_url('listings/list_update');?>">
                          <tr>
                            <th>List Status</th>
                            <td>   
                              <select name="list_status" id="list_status">
                                <option value="1" <?php if($list_details[0]['is_active']==1){echo 'selected';}?>>Active</option>
                                <option value="0" <?php if($list_details[0]['is_active']==0){echo 'selected';}?>>In-active</option>
                              </select>
                              <input type="hidden" name="list_id" value="<?php echo $list_details[0]['id'];?>">
                            </td>
                          </tr>
                          
                          <tr>
                            <th></th>
                            <td>  <input type="submit" name="update" value="Update">    </td>
                          </tr>
                        </form>


                      
                        </table>
                      </div>
                      <div id="menu3" class="container tab-pane fade"><br>
                         <table class="table table-hover c_details">
                          <tr>
                            <th>Additional Terms of Sale</th>
                            <td><?php echo $list_details[0]['additional_terms_of_sale'];?></td>
                          </tr>
                          <tr>
                            <th>Method of Payment</th>
                            <td><?php echo $list_details[0]['shipping_method'];?></td>
                          </tr>
                          <tr>
                            <th>Classes of shipping</th>
                            <td><?php echo $list_details[0]['shipping_class'];?></td>
                          </tr>
                          <tr>
                            <th>Who pays for shipping</th>
                            <td><?php

                            if ($list_details[0]['pays_for_shipping']=='seller_pays') {
                              echo "Seller Pays";
                            }elseif ($list_details[0]['pays_for_shipping']=='buyer_pays') {
                              echo "Buyer Pays";
                            }else{
                              echo $list_details[0]['pays_for_shipping'];
                            }

                            ?></td>
                          </tr>
                          <tr>
                            <th>Where You Will Ship</th>
                            <td><?php
                             if ($list_details[0]['where_you_will_ship']=='seller_country') {
                              echo "Seller Country";
                    }elseif ($list_details[0]['where_you_will_ship']=='internationally') {
                              echo "Internationally";
                            }else{
                              echo $list_details[0]['where_you_will_ship'];
                            }

                            ?></td>
                          </tr>
                          <tr>
                            <th>Duration</th>
                            <td><?php echo $list_details[0]['duration_days'];?> days</td>
                          </tr>
                          
                         
                          
                          
                        </table>
                      </div>

                      <div id="menu2" class="container tab-pane fade"><br>

                          <?php 
                          if(!empty($list_photos) || !empty($list_media)){
                          if(!empty($list_photos)){?>
                          <div id="owl-example" class="owl-carousel">
                            <?php foreach($list_photos as $l_photo){?>
                            <div class="item">
                              <img src="<?php echo front_url();?>assets/img/listing_photos/thumb/<?php echo $l_photo['url'];?>">
                            </div>
                            <?php } ?>
                          </div>
                          <?php } ?>

                        <?php if(!empty($list_media)){?>
                          <div class="col-md-12 col-sm-12">
                            <div class="append_more_content">
                            <?php foreach($list_media as $media){?>
                              <?php if($media['type']=='video_url'){ ?>
                              <div class="col-md-4 col-sm-4 media_div">
                                <iframe src="<?php echo $media['url'];?>"></iframe>
                              </div>
                              <?php } ?>
                            <?php 
                            } ?>
                            </div>
                            <?php if($count_records>6){?>
                            <div class="replace_more_btn">
                              <button class="btn btn-primary" onclick="more_video(2)">Load More</button>
                            </div>
                            <?php } ?>
                          </div>
                        <?php } }else{?>
                          <p>No media Available</p>
                        <?php } ?>
                      </div>

                      <div id="menu4" class="container tab-pane fade"><br>
                        <div class="col-md-12 col-sm-12">
                          <div class="box-body table-responsive no-padding">
                            <table id="example" class="display" style="width:100%">
                              <thead>
                                  <tr>
                                    <th>S.NO.</th>
                                    <th>Bidder Name</th>
                                    <th>Bid Amount</th>
                                    <th>Won Status</th>
                                    <th>Sold Status</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                    <th>S.NO.</th>
                                    <th>Bidder Name</th>
                                    <th>Bid Amount</th>
                                    <th>Won Status</th>
                                    <th>Sold Status</th>
                                  </tr>
                              </tfoot>
                              </table>
                          </div><!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                  </div>
  
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var url = $(location).attr('href'),
    parts = url.split("/"),
    last_part = parts[parts.length-1];
    $('#example').DataTable( {
        "ajax": "<?php echo base_url('listings/jj/');?>"+last_part,
        "columns": [
            { "data": "s_no" },
            { "data": "user_id" },
            { "data": "bid_amount" },
            { "data": "is_won" },
            { "data": "is_sold" }
        ]
    } );

} );
</script>
