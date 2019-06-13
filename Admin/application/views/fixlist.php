<script src="https://webhungers.com/firearms-new/assets/js/sweetalert.min.js"></script>
<style type="text/css">
  .box-footer a {padding: 10px;}

  .pagination_links>a, .pagination_links>strong{
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
  }

 .total_counter_td{
      border-top: 1px solid #ddd !important;
    border-bottom: 1px solid #ddd !important;
 }
</style>

<?php 
 $current_Price_show = true;
 $reserve_Price_show = true;
 $buynow_Price_show = true;
 $bid_counts_show = true;
 $timeleft_show = true;
 $status_show = true;
 $buy_on_price_show = false;
 $firearms_commission_show = false;
 $seller_earn_show = false;

  if($type_search == 'sold'){

    $current_Price_show = false;
    $reserve_Price_show = true;
    $buynow_Price_show = false;
    $bid_counts_show = false;
    $timeleft_show = false;
    $status_show = false;
    $buy_on_price_show = true;
    $firearms_commission_show = true;
    $seller_earn_show = true;
  } 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> List
        <!-- <small>View, Delete, Relist</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!--<a class="btn btn-primary" href="<?php //echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>-->
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All List </h3>

                    <select style="margin-left: 10px;padding: 3px;" onchange="window.location.href='<?php echo base_url(); ?>listings/allFixed/'+this.value+'/<?php echo $user_id;?>'">
                      <option value="all" <?php if($type_search == 'all') echo "selected"; ?> >All Listings</option>
                      <option value="sold" <?php if($type_search == 'sold') echo "selected"; ?>>Sold Listings</option>
                      <option value="in_auction" <?php if($type_search == 'in_auction') echo "selected"; ?>>In Auction Listings</option>
                      <option value="expired" <?php if($type_search == 'expired') echo "selected"; ?>>Expired Listings</option>
                      
                    </select>

                    <div class="box-tools" style="position:relative;">
                        <form action="<?php echo base_url('listings/allFixed/'.$type_search) ?>" method="GET" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
  
                <div class="box-body table-responsive no-padding" id="checkboxes">
                  <table class="table table-hover">
                    <tr>
                      <th width="2%"><input type="checkbox" onclick="selectall(this);"></th>
                      <th width="3%">S.NO.</th>
                      <th width="10%">Item Number</th>
                      <th width="15%">Title</th> 
                      <th width="10%">Quantity</th>
                      <th width="10%">Remaining Quantity</th>
                      <?php if($timeleft_show){ ?>
                      <th width="5%">Time Left</th>
                      <?php } if($status_show){ ?>
                      <th width="10%">Status</th>
                      <?php } if($buy_on_price_show){ ?>
                      <th width="10%">Buy On Price</th>
                      <?php } if($firearms_commission_show){ ?>
                      <th width="10%">FireArms Commission</th>
                      <?php } if($seller_earn_show){ ?>
                      <th width="10%">Seller Earn</th>
                      <?php }?>
                      <th width="15%" class="text-center">Actions</th>
                    </tr>
                    <?php
          
                    $total_firearm_commission = 0;
                    $total_sold_on_price = 0;
                    $total_seller_earn = 0;

                    if(!empty($userRecords))
                    {
                      // $record_num = end($this->uri->segment_array());
                     //   echo "<br>";
                     //  echo  $secondLastKey = count($this->uri->segment_array())-1;
                     //  echo "<br>";
                     // echo   "awf".$this->uri->segment($secondLastKey);


                        // if (is_numeric($record_num)) {
                        //   $i=$record_num;
                        // }else{                         
                        //   $i=0;
                        // }
                        
                        $i=0;
                        $today_date = date("Y-m-d H:i:s");
                        foreach($userRecords as $record)
                        {
                          $i++;
                          $firearm_commission = $record->firearms_commission;
                          $sold_on_price = $record->sold_on_price;
                          $seller_earn = $record->seller_earn;
                          $total_firearm_commission+= $firearm_commission;
                          $total_sold_on_price+= $sold_on_price;
                          $total_seller_earn+= $seller_earn*($record->quantity-$record->remaing_quantity);
                    ?>
                    <tr> 
                      <td><input type="checkbox" value="<?php echo $record->id;?>" class="list_idd"></td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo "# ".$record->item_number; ?></td>
                      <td><?php echo  substr($record->title,0,30);?></td>
                      <td><?php echo $record->quantity;?></td>                    
                      <td><?php echo $record->remaing_quantity;?></td>
                       <?php  if($timeleft_show){ ?> 
                      <td> <p id="auction_<?php echo $i; ?>"></p></td>
                      <?php } if($status_show){ ?> 
                      <td>
                      <?php
                      if ($record->status=='sold') {
                        echo "Sold";
                      }else{ 
                        if ($record->end_auction >= $today_date) {
                          echo 'In-auction';
                        }else{
                          echo 'Expired';
                        }                       
                       }
                       ?></td>
                       <?php } if($buy_on_price_show){ ?> 
                       <td><?php echo $sold_on_price; ?></td>
                       <?php } if($firearms_commission_show){ ?>
                       <td><?php echo $firearm_commission; ?></td> 
                       <?php } if($seller_earn_show){ ?> 
                        <?php  if($type_search == 'sold'){ ?>
                        <td><?php echo $seller_earn*($record->quantity-$record->remaing_quantity); ?></td>
                        <?php }else{ ?> 
                       <td><?php echo $seller_earn; ?></td>
                       <?php } ?>
                       <?php }?> 
                      <td class="text-center">
                         
                          <!--<a class="btn btn-sm btn-info" href="<?php //echo base_url().'editOld/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>-->
                         
                          <a class="btn btn-sm btn-info" href="<?php echo base_url('viewfixedListings/'.$record->id);?>" data-id="<?php echo $record->id; ?>" title="View"><i class="fa fa-eye"></i></a>
                          <a class="btn btn-sm btn-danger deleteList" href="#" data-id="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                          
                      </td>
                    </tr>

                     <?php 
if($timeleft_show){
  $current_date = date('M d, Y H:i:s');
  $end_date = date('M d, Y H:i:s',strtotime($record->end_auction));
?>

     <script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $end_date;?>").getTime();

// Update the count down every 1 second
//var x = setInterval(function() {
    var d_id='<?php echo $i;?>';
    // Get todays date and time
    var now = new Date("<?php echo $current_date;?>").getTime();
    if (countDownDate >=now) {
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    if(days>0 && hours>0){
      document.getElementById("auction_"+d_id).innerHTML = days + "d " + hours + 'h +';
    }else if(days<=0 && hours>0 && minutes>0){
      document.getElementById("auction_"+d_id).innerHTML = hours + "h "+ minutes + 'm +';
    }else if(days<=0 && hours<=0 && minutes>0 && seconds>0){
      document.getElementById("auction_"+d_id).innerHTML = minutes + "m "+ seconds + 's +';
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds>0){
      document.getElementById("auction_"+d_id).innerHTML = seconds + "s";
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds<=0){
      //clearInterval(x);
      document.getElementById("auction_"+d_id).innerHTML = "EXPIRED";
    }
      }else{
    document.getElementById("auction_"+d_id).innerHTML = "EXPIRED";
  }
//}, 1000);
</script>
                    <?php }} ?>

                    <?php if($type_search == 'sold'){?>
                     <tr>
                      <td></td>
                      <td class="total_counter_td"><b>Total</b></td>
                      <td class="total_counter_td" colspan="4"></td>
                      <td class="total_counter_td" ><b><?php echo $total_sold_on_price; ?></b></td>
                      <td class="total_counter_td" ><b><?php echo $total_firearm_commission; ?></b></td>
                      <td class="total_counter_td" ><b><?php echo $total_seller_earn; ?></b></td>
                      <td class="total_counter_td"></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td>
                        <button class="btn btn-primary" onclick="delete_lists()">Delete</button>
                      </td>
                      <td>
                      <?php $sold= $this->uri->segment(3)== "sold"?>
                      <?php $in_auction= $this->uri->segment(3)== "in_auction"?>
                      <?php $expired= $this->uri->segment(3)== "expired"?>

                      <?php 

                       if( $sold || $in_auction|| $expired){?>

                        
                      </td>
                      <?php } ?>

                    </tr>
                    <?php }else{
                      echo "<tr> <td colspan='9' style='text-align:center;'>No record found</td></tr>";
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix pagination_links">
                    <?php //echo $this->pagination->create_links(); ?>
                    <?php echo $pagination; ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    // jQuery(document).ready(function(){
    //     jQuery('ul.pagination li a').click(function (e) {
    //         e.preventDefault();            
    //         var link = jQuery(this).get(0).href;            
    //         var value = link.substring(link.lastIndexOf('/') + 1);
    //         jQuery("#searchList").attr("action", baseURL + "listings/allListings/<?php echo $type_search;?>/" + value);
    //         jQuery("#searchList").submit();
    //     });
    // });
</script>
