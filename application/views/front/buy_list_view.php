<style>
  .pagination {
    position: inherit;
  }
</style>

<?php 
$base_url=base_url();
$onerrorimage=$base_url."assets/img/listing_photos/thumb/image-not-found.jpg";
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');
if (!empty($listings)) { ?>

  <!-- new listing code-->
  <div class="listing col-xs-6 col-sm-4 col-md-12 col-lg-12 col-xl-12 ">
    <?php if (!empty($listings)) { ?>

      <?php foreach($listings as $list){

       $thumb_image=get_thumb_image($list['id']);

       if (!empty($thumb_image)) {
        $thumb_list_img = $thumb_image->url;
      }else{
        $thumb_list_img ='blank.jpg';
      } ?>
      <div class="highlighter ng-scope featured">

        <div class="listing-image">
          <a href="<?php echo base_url().'list-details/'.$list['slug'];?>" target="_self">
            <img src="<?php echo base_url('assets/img/listing_photos/thumb/'.$thumb_list_img); ?>" id="display_primary" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'" class="ng-scope"></a>
          </div>
          <div class="listing-text">
            <?php  if ($list['type']=='1') {  ?>
              <?php
              $start_amount=$list['starting_bid'];
              if(!empty($start_amount)){?>
                <p class="ng-scope">Starting Bid</p>
                <a href="<?php echo base_url().'list-details/'.$list['slug'];?>" target="_self" class="buy-now ng-binding ng-scope">$<?php 
                echo number_format($amount=amount_with_commission($start_amount),2); ?></a>
              <?php }}?>
              <?php if(!empty($buy_now_price=$list['buy_now_price']) && $buy_now_price != "0.00"){?>
                <p class="ng-scope">Buy Now</p>
                <a href="<?php echo base_url().'list-details/'.$list['slug'];?>" target="_self" class="buy-now ng-binding ng-scope">$<?php 

                echo number_format($buy_now_price_commission=amount_with_commission($buy_now_price),2);?></a>

              <?php }?>

              <?php if(!empty($fixed_amount=$list['fixed_price']) && $fixed_amount != "0.00"){?>
                <p class="ng-scope">Price</p>
                <a href="<?php echo base_url().'list-details/'.$list['slug'];?>" target="_self" class="buy-now ng-binding ng-scope">$<?php 
                $fixed_amount=$list['fixed_price'];  
                echo number_format($fixed_amount_commission=amount_with_commission($fixed_amount),2);?></a>

              <?php }?>
            </div>
            <div class="listing-text">
              <h4><a href="<?php echo base_url().'list-details/'.$list['slug'];?>" target="_self" class="ng-binding"><?php echo $list['title'];?></a></h4>

            </div>

            <div class="listing-text ">
              <?php if(!empty($list['item_number'])){?>
                <span class="">Item #<?php echo $list['item_number'];?></span>
              <?php }?>
              <?php if(!empty($list['quantity'])){?>
                <span class="">Qty: <?php echo $list['quantity'];?></span>
              <?php }?>
              <?php $bids_count=$this->user_model->aggregate_data('bid','id','COUNT',array('list_id'=>$list['id']));?>
              <?php  if ($list['type']=='1') {  ?>
                <p class="bid_status pull-right">
                  <?php 
                  $start_date = date('Y-m-d H:i:s');
                  $end_date = $list['end_auction'];
                  $start_date_seasonal_price = strtotime($start_date);
                  $end_date_seasonal_price = strtotime($end_date);
                  $datediff = $end_date_seasonal_price - $start_date_seasonal_price;
                  $day_counter = floor($datediff / (60 * 60 * 24));
                  $hrs_counter = floor(($datediff % (60 * 60 * 24))/(60*60));
                  $minutes_counter = floor(($datediff % (60 * 60))/(60));
                  $seconds_counter = floor($datediff % (60 * 60));

                  if($day_counter>0){
                    echo $day_counter.'D+';
                  }else if($day_counter<=0 && $hrs_counter>0){
                    echo $hrs_counter.'H+';
                  }if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter>0){
                    echo $minutes_counter.'M+';
                  }if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter<=0 && $seconds_counter>0){
                    echo '<'.$seconds_counter.'S';
                  }else if($day_counter<=0 && $hrs_counter<=0 && $minutes_counter<=0 && $seconds_counter<=0){
                    echo 'Expired';
                  }
                  ?>
                  |
                  <?php echo $bids_count;?> Bids</p>
                <?php }?>

              </div>

              <div class="listing-text">
                <?php if(!empty($list['quantity']) && $list['quantity'] > 0){?>
                  <p class="bid_status pull-right">Buy Now Available</p>
                <?php }?>


                <?php  if ($list['type']=='1') {  ?>
                  <span class=""><i class="fa fa-unlock-alt" aria-hidden="true"></i>  <?php

                  $total_bids=  get_current_price($list['id']);
                  $current_price=0;
                  if(!empty($total_bids)){
                    $total_count=count($total_bids);

                    $current_price=$total_bids[$total_count-1]->bid_amount;

                  }
                  $reserve_price=$list['reserve_price'];

                  if ($reserve_price==0) {
                    echo "No Reserve";
                  }else{
                    if($current_price < $reserve_price ){
                      echo "Reserve Not Met";
                    }else{
                      echo "Reserve Met";
                    }

                  }

                  ?></span>
                <?php } else { echo "";} ?>


              </div>
                  <div class="listing-text">
                    <span class="buy_btn_now">
                      <a href="<?php echo base_url('list-details/'.$list['slug']);?>">View</a>
                    </span>
                  </div>
                </div>
              <?php }?>
            <?php }?>
          </div>

          <!-- new listing code-->

          <?php
    //pagination  start
          $count=$pagination->total;
          if( $count > $limit_paggination){    ?>
           <div class="col-sm-12 col-md-12 pagination_select">
            <span class="filter_lable" style=" width: 100px; display:inline-block;margin: 0px 15px 15px;">
              <select class="filter_select" style="-webkit-appearance: none;" onchange="show_buy_item(0,this.value)">
                <option value="5" <?php if ($limit_paggination=='5') { echo "Selected";}else{'';} ?>>5</option>
                <option value="10" <?php if ($limit_paggination=='10') { echo "Selected";}else{'';} ?>>10</option>
                <option value="20" <?php if ($limit_paggination=='20') { echo "Selected";}else{'';} ?>>20</option>
                <option value="50" <?php if ($limit_paggination=='50') { echo "Selected";}else{'';} ?>>50</option>
                <option value="100" <?php if ($limit_paggination=='100') { echo "Selected";}else{'';} ?>>100</option>
              </select>
            </span>
          </div>
          <?php  
          $per_page = $limit_paggination;
          $page_id =$offset_paggination;
          $foundnum =$count;
          $count = (int)($count/$per_page);
          $rem=($count%$per_page);
          $id =$count;

          if($rem>0)
          {   
            $count++;
          }
          $start = $page_id;
          $max_pages = $count;
          $prev = $start - $per_page;
          $next = $start + $per_page;
          $adjacents = 5;
          $last = $max_pages - 1;

          if($max_pages > 1)
          {   
           echo "<div class='col-sm-12 col-md-12'><ul id='pagination' class='pagination pagination-sm float-right'>";
            //previous button
           if (!($start<=0)){

             echo " <li><a href='javascript:show_buy_item($prev,$limit_paggination)'>Prev</a> </li>";    
           }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
              $i = 0;   
              for ($counter = 1; $counter <= $max_pages; $counter++)
              {
                if ($i == $start)
                {
                  echo " <li  class='active'><a href='javascript:show_buy_item($i,$limit_paggination)'><b>$counter</b></a></li> ";
                }
                else
                {
                  echo " <li><a href='javascript:show_buy_item($i,$limit_paggination)'>$counter</a></li> ";
                }  
                $i = $i + $per_page;                 
              }
            }
            elseif($max_pages > 10 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
              if(($start/$per_page) < 1 + ($adjacents * 2))        
              {
                $i = 0;
                for ($counter = 1; $counter < 10 + ($adjacents * 2); $counter++)
                {
                  if ($i == $start)
                  {
                    echo " <li  class='active'><a href='javascript:show_buy_item($i,$limit_paggination)'>$counter</a></li> ";
                  }
                  else
                  {
                    echo " <li><a href='javascript:show_buy_item($i,$limit_paggination)'>$counter</a></li> ";
                  } 
                  $i = $i + $per_page;              
                }
              }
                //in middle; hide some front and some back
              elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
              {
                $i = $start;                 
                for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
                {
                  if ($i == $start)
                  {
                    echo " <li   class='active'><a href='javascript:show_buy_item($i,$limit_paggination)'><b>$counter</b></a></li> ";
                  }
                  else
                  {
                    echo " <li><a href='javascript:show_buy_item($i,$limit_paggination)'>$counter</a></li> ";
                  }   
                  $i = $i + $per_page;                
                }
              }
                //close to end; only hide early pages
              else
              {
                $i = $start;                
                for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
                {
                  if ($i == $start)
                  {
                    echo " <li class='active'><a href='javascript:show_buy_item($i,$limit_paggination)'><b>$counter</b></a></li> ";
                  }
                  else
                  {
                    echo " <li><a href='javascript:show_buy_item($i,$limit_paggination)'>$counter</a> </li>";   
                  } 
                  $i = $i + $per_page;              
                }
              }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:show_buy_item($next,$limit_paggination)'>Next</a></li> ";
            }

            echo "</ul></div>";    
          } 
        }  
    //pagination end
      }else{ ?>
        <div style="margin: 5% 37%;" class="col-md-6">
          <h2>No list item available</h2></div>
          <?php   } ?>