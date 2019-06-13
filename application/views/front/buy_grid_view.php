  <style>
  .table td {
    padding:5px;
  }

</style>

<div class="row grid_content" >

  <?php
  $base_url=base_url();
  $onerrorimage=$base_url."assets/img/listing_photos/thumb/image-not-found.jpg";
  if (!empty($listings)) {
    $isLoggedIn = $this->session->userdata('isLoggedIn');
    $UserType = $this->session->userdata('user_type');

    foreach($listings as $list){ 
      $thumb_image=get_thumb_image($list['id']);

      if (!empty($thumb_image)) {
        $thumb_list_img = $thumb_image->url;
      }else{
        $thumb_list_img ='blank.jpg';
      }

      ?>
      <div class="col-md-2 col-sm-6 grid_col">
        <div class="grid_img">
          <a href="<?php echo base_url('list-details/'.$list['slug']);?>" target="_blank">
           
            <img class="display_section" src="<?php echo base_url('assets/img/listing_photos/thumb/'.$thumb_list_img); ?>" id="display_primary" style="height: 100em;object-fit: cover;" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'"/>
            
          </a>
        </div>
        <div class="like_section">
          <div class="like_ic"><a id = "like_btn_list_<?php echo $list['id'];?>" <?php if($isLoggedIn){echo 'onclick="like_list_item('.$list['id'].')"'; }else{ echo 'href="'.base_url('sign-in/buy').'"'; } ?> id="<?php echo $list['id'];?>" style="cursor:pointer;" ><i class="fa <?php if($isLoggedIn && $list['like_status']==1){echo 'fa-heart';} else echo 'fa-heart-o'?>  icon" aria-hidden="true" ></i></a></div>
        </div>
        <div class="grid_pro_head">
          <a href="<?php echo base_url('list-details/'.$list['slug']);?>" target="_blank"><?php 
          $str_length = strlen($list['title']);
          if($str_length > 40)
          {
            echo $string2 = substr($list['title'], 0, 40)."...";
          }else{
            echo $list['title']; 
          }       
          if($isLoggedIn && $list['like_status']==1){
            echo "1";
          }   
          ?>   </a>
        </div>

        <?php
        if ($list['type']=='1') {
          ?>
          <div class="grid_pro_price">
            <?php 
            $start_amount=$list['starting_bid'];  
            $amount=amount_with_commission($start_amount);        
            ?>
            <span class="price_left pull-left"><b>Starting Bid</b><br/>$<?php echo number_format($amount,2);?></span>
            <?php $bids_count=$this->user_model->aggregate_data('bid','id','COUNT',array('list_id'=>$list['id']));?>
            <span class="bid_status pull-right">
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
              | <?php echo $bids_count;?> Bids</span>
            </div>
            <div class="bottom_reserve">
              <span class="reserve_link pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>

               <?php
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
              ?>
            </span>

              <?php if($isLoggedIn && $UserType=='buyer'){ ?>
                <span class="buy_btn_now text-center reserve_status"><a href="<?php echo base_url('list-details/'.$list['slug']);?>">Bid Now !</a></span>
              <?php }else if($isLoggedIn && $UserType=='seller'){

              } else{ ?>
                <span class="buy_btn_now text-center reserve_status"><a href="<?php echo base_url('sign-in/buy');?>">Bid Now !</a></span>
              <?php } ?>
            
          </div>

          <?php
        }else{  ?>
         <div class="grid_pro_price">
          <?php 
          $fixed_amount=$list['fixed_price'];  
          $fixed_amount_commission=amount_with_commission($fixed_amount);        
          ?>
          <span class="price_left pull-left"><b>Fixed Amount</b><br/>$<?php echo number_format($fixed_amount_commission,2);?></span>
          
        </div>
      <?php }
      ?>


    </div>
  <?php }
    //pagination start


  $count=$pagination->total;

  if ($count !=0) { ?>
   <div class="col-sm-12 col-md-12 pagination_select">
     <span class="filter_lable" style="margin: 15px; width: 100px; display:inline-block;">
      <select class="filter_select" style="-webkit-appearance: none;" onchange="show_buy_item(0,this.value)">
        <option value="5" <?php if ($limit_paggination=='5') { echo "Selected";}else{'';} ?>>5</option>
        <option value="10" <?php if ($limit_paggination=='10') { echo "Selected";}else{'';} ?>>10</option>
        <option value="20" <?php if ($limit_paggination=='20') { echo "Selected";}else{'';} ?>>20</option>
        <option value="50" <?php if ($limit_paggination=='50') { echo "Selected";}else{'';} ?>>50</option>
        <option value="100" <?php if ($limit_paggination=='100') { echo "Selected";}else{'';} ?>>100</option>
      </select>
    </span>
  </div>
<?php } 



if( $count > $limit_paggination){
  ?>
  <div class="col-sm-12 col-md-12">
   
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
     echo "<ul id='pagination' class='pagination pagination-sm float-right'>";
            //previous button
     if (!($start<=0)){
       
       echo " <li>
       <a href='javascript:show_buy_item($prev,$limit_paggination)'>Prev </a> </li>";    
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
            
            echo "</ul>";    
          } ?>
        </div>
      <?php }  


    //pagination end
    }else { ?>
      <div style="margin: 5% 37%;">
        <h2>No list item available</h2>
      </div>  
    <?php   } ?>

  </div>