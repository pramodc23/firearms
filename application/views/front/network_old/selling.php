
<?php
  if(!empty($network_info)){
    $i=0;
  foreach ($network_info as $key => $value) {  
      $list_id=$value->id;
    if($value->url !=''){ 
      $item_image=$value->url;
    }else{ 
      $item_image='image_not_found.png';
    }    

    $end_date = date('M d, Y H:i:s',strtotime($value->end_auction));
?>
<div class="table-section-08">
<?php if($i==0){?>
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
  <?php }else{ ?>
 <hr>
    <?php } ?>
  <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
    <thead class="text-muted">
      <tr>
        <th scope="col" class="text-left" width="200"><input name="shipping_place" type="checkbox" value="seller_country"></th>
        <th scope="col" class="text-left">Thumb</th>
        <th scope="col" width="430" class="text-left">title</th>
        <th scope="col" width="140" class="text-center">time left</th>
        <th scope="col" width="160" class="text-right">action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <figure class="media">
            <input name="shipping_place" type="checkbox" value="seller_country" >
            <figcaption class="media-body">
              <h6 class="title text-truncate"><?php echo $list_id; ?></h6>
            </figcaption>
          </figure> 
        </td>
        <td class="text-left"> 
          <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>">
        </td>
        <td> 
          <div class="price-wrap"> 
            <p class="text-left"><?php echo $value->title; ?></p> 
            <p>
              <span class="Curent-01" style="float: left;border-right: 1px solid #cccccc;    padding-right: 20px;">current price <span class="price-06">$<?php echo $value->starting_bid; ?></span></span> 
              <span class="Curent-01" >shipping cost <span class="price-06">$0.00</span></span>
            </p>
          </div> <!-- price-wrap .// -->
        </td>
        <td class="text-center"> 
         <p id="auction_<?php echo $i; ?>"> </p>
       </td>
       <td class="text-right"> 
        <a href="<?php echo base_url(); ?>bid/<?php echo $list_id; ?>" target="_blank"> <span class="para-table bid-btn">BID</span></a> 
       <!--   <span><img src="<?php //echo base_url(); ?>assets/img/down-arrow-ic.png" style="width:auto;" data-toggle="collapse" data-target="#network_action"></span> -->
          <select >
            <option>Action</option>
            <option>Delete</option>
            <option>Relist</option>
            <option>View Bid</option>
            <option>Sold</option>
        </select>
                
       </td>
     </tr>
   </tbody>
 </table>      
</div>

<script>
var auctionid="<?php echo $i; ?>";
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $end_date;?>").getTime();

// Update the count down every 1 second
//var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    if(days!=0 && hours!=0){
      document.getElementById("auction_"+auctionid).innerHTML = days + "d " + hours + 'h +';
    }else if(days==0 && hours!=0 && minutes!=0){
      document.getElementById("auction_"+auctionid).innerHTML = hours + "h "+ minutes + 'm +';
    }else if(days==0 && hours==0 && minutes!=0 && seconds!=0){
      document.getElementById("auction_"+auctionid).innerHTML = minutes + "m "+ seconds + 's +';
    }else if(days==0 && hours==0 && minutes==0 && seconds!=0){
      document.getElementById("auction_"+auctionid).innerHTML = seconds + "s";
    }
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("auction_"+auctionid).innerHTML = "EXPIRED";
    }
//}, 5000);
</script>
<?php 
$i++;
} ?>
<script type="text/javascript">
 
  $('select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
   // var valueSelected = this.value;
   alert(this.value);
    
});
</script>
<?php 
$count=$pagination->total;

 if( $count > 5){

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
           
             echo " <li><a href='javascript:my_network($prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:my_network($i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:my_network($i)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:my_network($i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:my_network($i)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:my_network($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:my_network($i)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:my_network($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:my_network($i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:my_network($next)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  

}else{
  

        echo '<h2 style="text-align:center;">No Results Found.</h2>'; 

        
   
    }
     ?>
