<div class="table-section-08">
  <div class="side-by-side">
    <div class="row">
      <div class="col-md-8">
        <p>Show Items- Schedule  &nbsp;&nbsp;All (<?php echo count($network_info); ?>) </p>
      </div>
      <div class="col-md-4 pull-right">
      </div>
    </div> 
  </div>

<?php 
  if(!empty($network_info)){
     $base_url=base_url();
 $onerrorimage=$base_url."assets/img/listing_photos/thumb/image-not-found.jpg";
?>
  <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
    <thead class="text-muted">
      <tr>
        <th scope="col" class="text-left"><input id="selling_checked_all" type="checkbox" ></th>       
        <th scope="col" class="text-left">Thumb</th>
        <th scope="col" width="430" class="text-left">title</th>
        <th scope="col" width="140" class="text-center">time left</th>
        <th scope="col" class="text-left">Quantity</th>
        <th scope="col" class="text-left">REMAINING Quantity</th>
        <th scope="col" width="160" class="text-right"></th>
      </tr>
    </thead>
    <tbody>

<?php

    $i=0;
    foreach ($network_info as $key => $value) {  
        $list_id=$value->id;
        $slug=$value->slug;
        $quantity=$value->quantity;
        $status=$value->status;
        $thumb_image=get_thumb_image($list_id);
        $remaining_quantity = $value->remaing_quantity;

        if ($status  !='') {
          $status=$status;
        }else{
          $today_date = date("Y-m-d H:i:s");          
          $end_auction=$value->end_auction;
          if ($end_auction > $today_date) {  
            $status='In Auction';
          }else{            
            $status='EXPIRED';
          }
        }
       
        if(!empty($thumb_image->url)){ 
          $item_image=$thumb_image->url;       
        }else{ 
          $item_image='image-not-found.jpg';
        }  
    $end_date = date('M d, Y H:i:s',strtotime($value->end_auction));
?>
 
  
      <tr>
        <td>  
        </td>       
        <td class="text-left"> 
          <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>" style="height: 81px; object-fit: cover; object-position: top;"  onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'">
        </td>
        <td> 
          <div class="price-wrap"> 
            <a href="<?php echo base_url('list-details/'.$slug);?>" target="_blank"><p class="text-left"><?php echo $value->title; ?></p> </a>           
              <span class="Curent-01" style="float: left;   padding-right: 20px;">Price
                  <span class="price-06"><?php echo $value->fixed_price;?></span>
              </span>    
          </div> <!-- price-wrap .// -->
        </td>
        <td class="text-center"> 
          <p id="auctions_<?php echo $i; ?>"></p>
        </td>
        <td><span class="bid_font"><?php echo $quantity; ?></span></td>
        <td><span class="bid_font"><?php echo $remaining_quantity; ?></span></td>
       <td class="text-right">     

          <select class="filter_select" onchange="selling_item(this.value,'<?php echo $list_id; ?>','<?php echo $slug;?>');" style="-webkit-appearance: none;margin-top: 13px;">
            <option value="">Action</option>           
            <option value="Delete">Delete</option>
            <?php if ($status=='In Auction' && ($quantity == $remaining_quantity)) { ?>
            <option value="Edit">Edit</option>
            <?php   } ?>
            <option value="Sold_list">Sold Item List</option>    
        </select>
 
                        
       </td>
     </tr>
  <?php 
  $current_date = date('M d, Y H:i:s');
  $end_date = date('M d, Y H:i:s',strtotime($value->end_auction));
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
   //console.log(days+"--"+hours+"--"+minutes+"--"+seconds+"--"+distance);
    // Output the result in an element with id="demo"
    if(days>0 && hours>0){
      document.getElementById("auctions_"+d_id).innerHTML = days + "d " + hours + 'h +';
    }else if(days<=0 && hours>0 && minutes>0){   
      document.getElementById("auctions_"+d_id).innerHTML = hours + "h "+ minutes + 'm +';
    }else if(days<=0 && hours<=0 && minutes>0 && seconds>0){  
      document.getElementById("auctions_"+d_id).innerHTML = minutes + "m "+ seconds + 's +';
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds>0){
      document.getElementById("auctions_"+d_id).innerHTML = seconds + "s";
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds<=0){
      clearInterval(x);
      document.getElementById("auctions_"+d_id).innerHTML = "EXPIRED";
    }
      }else{
    document.getElementById("auctions_"+d_id).innerHTML = "EXPIRED";
  }
//}, 1000);
</script>  
     


<?php 



$i++;
} ?>

    </tbody>
  </table>
</div>

<?php 
$count=$pagination->total;
$rem_count=$pagination->total;
 if( $count > 5){

  $per_page = $limit_paggination;
  $page_id =$offset_paggination;
  $foundnum =$count;
        $count = (int)($count/$per_page);
        $rem=($rem_count%$per_page);
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
           
             echo " <li><a href='javascript:selling_schedule_fixed($prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:selling_schedule_fixed($i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:selling_schedule_fixed($i)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:selling_schedule_fixed($i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_schedule_fixed($i)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:selling_schedule_fixed($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_schedule_fixed($i)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:selling_schedule_fixed($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_schedule_fixed($i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:selling_schedule_fixed($next)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  

}else{
  

        echo '<div style="margin:10%;"><h2 style="text-align:center;">No Results Found.</h2></div>'; 

        
   
    }
     ?>
