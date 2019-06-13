
<div class="table-section-08">
  <div class="side-by-side">
    <div class="row">
      <div class="col-md-8">
        <p>Show Items- Buying  &nbsp;&nbsp;All (<?php echo count($network_info); ?>)  <!-- &nbsp;&nbsp;Active (1)  &nbsp;&nbsp;Ended --></p>
      </div>
      <div class="col-md-4 pull-right">
       <!--  <span>
       <img src="<?php //echo base_url(); ?>assets/img/Print-ic.png"> Print</span> -->
      </div>
    </div> 
  </div>
<script type="text/javascript">
  $('#selling_checked_all').click(function() {
    if ($(this).is(':checked')) { 
      $(".selling_all_check").prop("checked", true);
      $('#delete_all').show();
    }else{
      $(".selling_all_check").prop("checked", false);   
      $('#delete_all').hide();   
    }  
  });
</script>
<script type="text/javascript">
  function delete_all_list() {     

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
          $('.selling_all_check:checked').each(function(i){
            val[i] = $(this).val();
          }); 
         
        
          $.post("<?php echo base_url("user_action/all_bid_delete"); ?>", {list_id:val}, function(result){ 
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
<?php 
  if(!empty($network_info)){
     $base_url=base_url();
 $onerrorimage=$base_url."assets/img/listing_photos/thumb/image-not-found.jpg";
          $session_id=$this->session->userdata('user_id');
?>
  <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
    <thead class="text-muted">
      <tr>
     <!--    <th scope="col" class="text-left" >
          <input id="selling_checked_all" type="checkbox" ></th> -->
       
        <th scope="col" class="text-left">Thumb</th>
        <th scope="col" width="450" class="text-left">Title</th>
        <th scope="col" width="100" class="text-center">Status</th>
        <th scope="col" width="140" class="text-center">Time left</th>
        <th scope="col" class="text-left">Quantity</th>
        <th scope="col" class="text-left">Remaining Quantity</th>
        <th scope="col" class="text-left">Total Buy</th>
        <th scope="col" width="160" class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
  <?php
$today_date = date("Y-m-d H:i:s");
    $i=0;
    foreach ($network_info as $key => $value) {  
     
      $list_id=$value->id;
      $status=$value->status;
      $end_auction=$value->end_auction;
      $slug=$value->slug;
      $quantity=$value->quantity;
      $sell_quantity=$value->sell_quantity;
      $buy_now_price=$value->fixed_price;       
      $buy_amount=amount_with_commission($buy_now_price); 

      $total_amount= $buy_amount * $sell_quantity;

      if ($status  =='sold') {
        $status="Sold";
        $show_buy_not="0";
      }else{
        if ($end_auction > $today_date ) {
          $status='In Auction';
          $show_buy_not="1";  
          
        }else{
          $status='Expired';
            $show_buy_not="0";
        }        
      }


      $thumb_image=get_thumb_image($list_id);
       
      if(!empty($thumb_image->url)){ 
        $item_image=$thumb_image->url;       
      }else{ 
        $item_image='image-not-found.jpg';
      }   
  ?>
    <tr>
      <!--   <td>
          <figure class="media">
            <input name="selling_all_check" class="selling_all_check" type="checkbox" value="<?php //echo $list_id; ?>" >         
          </figure> 
        </td> -->
        
        <td class="text-left"> 
          <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>" onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'">
        </td>
        <td> 
          <div class="price-wrap"> 
            <a href="<?php echo base_url('list-details/'.$slug);?>" target="_blank"><p class="text-left"><?php echo $value->title; ?></p> </a>
          
              <span class="Curent-01" style="float: left;border-right: 1px solid #cccccc;    padding-right: 5px;">price<span class="price-06"><?php                
               if (!empty($buy_amount)) {
                echo "$".number_format($buy_amount,2);
               }else{
                echo "NA";
               }
                ?></span></span> 

                <span class="Curent-01" style="float: left;    padding-right: 5px;">Total Amount<span class="price-06"><?php                
               if (!empty($buy_amount)) {
             

                echo "$".number_format($total_amount,2);
               }else{
                echo "NA";
               }
                ?></span></span> 
             
       
          </div> <!-- price-wrap .// -->
        </td>
        <td class="text-right"><?php echo $status;?></td>
        <td class="text-center"> 
         <?php if($status=='Sold'){
          $a_cls="timestatushide";
        }else{
          $a_cls="";
        }
        ?>

          <p id="auctionfix_<?php echo $i; ?>" class="<?php echo $a_cls;?>"></p>
        </td>
        <td><?php echo $quantity; ?></td>
        <td><?php echo $value->remaing_quantity; ?></td>
        <td><span class="bid_font"><?php echo $sell_quantity; ?></span></td>
     
       <td class="text-right"> 
      <!--<a href="<?php //echo base_url('list-details/'.$slug);?>
          <?php /*echo base_url(); ?>user_bid/<?php echo $list_id;*/ ?>" target="_blank"> <span class="para-table bid-btn">BID</span></a> -->
          <select class="filter_select" onchange="buying_item(this.value,'<?php echo $list_id; ?>','<?php echo $slug;?>','<?php echo $buy_amount;?>','<?php echo $value->user_id; ?>');" style="-webkit-appearance: none;margin-top: 13px;">
            <option value="">Action</option>   
            <?php if ($show_buy_not=='1') { ?>
              <option value="buy_now_for_fixed">Buy Now</option> 
           <?php } ?>        
            
            <option value="message">Message</option>
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
    
    // Output the result in an element with id="demo"
    if(days>0 && hours>0){
      document.getElementById("auctionfix_"+d_id).innerHTML = days + "d " + hours + 'h +';
    }else if(days<=0 && hours>0 && minutes>0){
      document.getElementById("auctionfix_"+d_id).innerHTML = hours + "h "+ minutes + 'm +';
    }else if(days<=0 && hours<=0 && minutes>0 && seconds>0){
      document.getElementById("auctionfix_"+d_id).innerHTML = minutes + "m "+ seconds + 's +';
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds>0){
      document.getElementById("auctionfix_"+d_id).innerHTML = seconds + "s";
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds<=0){
      clearInterval(x);
      document.getElementById("auctionfix_"+d_id).innerHTML = "EXPIRED";
    }
      }else{
    document.getElementById("auctionfix_"+d_id).innerHTML = "EXPIRED";
  }
//}, 1000);
</script>

<?php 
$i++;
} ?>

    </tbody>
  </table> 
</div>

<button id="delete_all" onclick="delete_all_list();" style="display: none;margin-left:20px;background-color: rgb(249, 108, 4);padding: 8px 15px;color: white;font-weight: 600;" >Delete All</button>
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
           
             echo " <li><a href='javascript:buying_all_fixed($prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:buying_all_fixed($i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:buying_all_fixed($i)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:buying_all_fixed($i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:buying_all_fixed($i)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:buying_all_fixed($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:buying_all_fixed($i)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:buying_all_fixed($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:buying_all_fixed($i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:buying_all_fixed($next)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  

}else{
  

        echo '<div style="margin:10%;"><h2 style="text-align:center;">No Results Found.</h2></div>'; 

        
   
    }
     ?>
