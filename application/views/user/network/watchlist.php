<div class="table-section-08">
  <div class="side-by-side">
    <div class="row">
      <div class="col-md-8">
        <p>Show Items- Watched  &nbsp;&nbsp;All (<?php echo count($network_info); ?>)  <!-- &nbsp;&nbsp;Active (1)  &nbsp;&nbsp;Ended --></p>
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
        
          $.post("<?php echo base_url("user_action/all_list_delete"); ?>", {list_id:val}, function(result){ 
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
        <!-- <th scope="col" class="text-left" >
          <input id="selling_checked_all" type="checkbox" ></th> -->
        
        <th scope="col" class="text-left">Thumb</th>
        <th scope="col" width="450" class="text-left">Title</th>
           <th scope="col" width="100" class="text-center">status</th>
        <th scope="col" width="140" class="text-center">time left</th>
        <th scope="col" class="text-left">Total Bids </th>
        <th scope="col" width="160" class="text-right">action</th>
      </tr>
    </thead>
    <tbody>
  <?php
$today_date = date("Y-m-d H:i:s");
    $i=0;
    foreach ($network_info as $key => $value) {  
      $list_id=$value->id;
      $status=$value->status;
      $slug=$value->slug;
      $end_auction=$value->end_auction;

      $bid_detail=get_bid_count($list_id);

      $buy_now_price=$value->buy_now_price;         
      $buy_amount=amount_with_commission($buy_now_price); 
      if ($status  =='sold') {
        $status="Sold";
        $show_buy_not="0";
      }else{
        if ($end_auction > $today_date ) {
          $status='In Auction';          
          if($bid_detail){
            if ($bid_detail->total_bid > 0) {
              $show_buy_not="0";
            }else{
              $show_buy_not="1";
            }
          }else{
            $show_buy_not="1";  
          }

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
          <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>"  onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'">
        </td>
        <td> 
          <div class="price-wrap"> 
            <a href="<?php echo base_url('list-details/'.$slug);?>" target="_blank"><p class="text-left"><?php echo $value->title; ?></p> </a>
           
              <span class="Curent-01" style="float: left;border-right: 1px solid #cccccc;    padding-right: 5px;"><?php if($value->type==2){ echo "price".'<span class="price-06">$'.$value->fixed_price;}else{ echo "current bid";} ?><span class="price-06">
              <?php
               if($value->type==1)
               {

                $currentprice= get_current_price1($value->id);
               if (!empty($currentprice)) {
                echo "$".number_format($currentprice->bid_amount,2);
               }else{
                echo "NA";
               }?>
              </span></span> 
              <span class="Curent-01" >Your highest bid <span class="price-06"><?php 
                 $highest_bid=  get_user_highest_bid($value->id,$session_id);

          if (!empty($highest_bid)) {
            echo "$".number_format($highest_bid->bid_amount,2);
          }else{
            echo "NA";
          }
       ?></span></span>
           <?php } ?>
          </div> <!-- price-wrap .// -->
        </td>
        <td class="text-right"><?php if($value->type==2){ echo "NA"; }
        else{ echo $status;}?></td>
        <td class="text-center"> 
         <?php if($status=='Sold'){
          $a_cls="timestatushide";
        }else{
          $a_cls="";
        }
        ?>
          <p id="auction_<?php echo $i; ?>" class="<?php echo $a_cls;?>"></p>
        </td>
     
        <td> <span class="bid_font">
            <?php 
           
              if($bid_detail){ ?>
               <a href="<?php echo base_url();?>user_bid/<?php echo $list_id;?>" target="_blank"><?php if($value->type==2){ echo "NA"; }
        else{ echo $bid_detail->total_bid;}?></a>
               <?php
              }
            ?></span>
        </td>
       <td class="text-right"> 

<!--         <a href="<?php //echo base_url(); ?>message" target="_blank"> <span class="para-table bid-btn">Message</span></a> -->  
        <select class="filter_select" onchange="watch_item(this.value,'<?php echo $value->watchlist_id; ?>','<?php echo $slug;?>','<?php echo $buy_amount;?>','<?php echo $value->user_id; ?>');" style="-webkit-appearance: none;margin-top: 13px;">
            <option value="">Action</option>
             <?php if ($show_buy_not=='1') { ?>
              <option value="buy_now">Buy Now</option> 
           <?php } ?>  
           <?php if($value->type==1){ ?>
            <option value="place_a_bid">Place a Bid</option>
            <?php } ?>
            <option value="message">Message</option>
            <option value="all_user_bids">Your All Bids</option>
          </select>              
       </td>
     </tr>   
     <?php 
if($value->type==1)
{

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
      document.getElementById("auction_"+d_id).innerHTML = days + "d " + hours + 'h +';
    }else if(days<=0 && hours>0 && minutes>0){
      document.getElementById("auction_"+d_id).innerHTML = hours + "h "+ minutes + 'm +';
    }else if(days<=0 && hours<=0 && minutes>0 && seconds>0){
      document.getElementById("auction_"+d_id).innerHTML = minutes + "m "+ seconds + 's +';
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds>0){
      document.getElementById("auction_"+d_id).innerHTML = seconds + "s";
    }else if(days<=0 && hours<=0 && minutes<=0 && seconds<=0){
      clearInterval(x);
      document.getElementById("auction_"+d_id).innerHTML = "EXPIRED";
    }

     }else{
    document.getElementById("auction_"+d_id).innerHTML = "EXPIRED";
  }
//}, 1000);
</script>   
<?php 
}
else
{
  ?>
   <script type="text/javascript">
  document.getElementById("auction_<?php echo $i; ?>").innerHTML = "NA";
  </script>
 <?php
}
$i++;
} ?>

    </tbody>
  </table> 
</div>

<button id="delete_all" onclick="delete_all_list();" style="display: none;margin-left:20px;background-color: #dc3545;padding: 8px 15px;color: white;font-weight: 600;" >Delete All</button>
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
           
             echo " <li><a href='javascript:watch_list_item($prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:watch_list_item($i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:watch_list_item($i)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:watch_list_item($i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:watch_list_item($i)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:watch_list_item($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:watch_list_item($i)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:watch_list_item($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:watch_list_item($i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:watch_list_item($next)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  

}else{
  

        echo '<div style="margin:10%;"><h2 style="text-align:center;">No Results Found.</h2></div>'; 

        
   
    }
     ?>
