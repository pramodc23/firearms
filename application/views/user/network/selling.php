<div class="table-section-08">
  <div class="side-by-side">
    <div class="row">
      <div class="col-md-8">
        <p>Show Items- Selling  &nbsp;&nbsp;All (<?php echo count($network_info); ?>)  <!-- &nbsp;&nbsp;Active (1)  &nbsp;&nbsp;Ended --></p>
      </div>
      <div class="col-md-4 pull-right">
        <!-- <span><img src="<?php //echo base_url(); ?>assets/img/Print-ic.png"> Print</span> -->
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
                        swal("Lists Deleted Successfully!", {
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
?>
  <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
    <thead class="text-muted">
      <tr>
       <!--  <th scope="col" class="text-left" >
        <input id="selling_checked_all" type="checkbox" ></th>   -->     
        <th scope="col" class="text-left">Thumb</th>
        <th scope="col" width="330" class="text-left">title</th>
        <th scope="col" width="100" class="text-center">status</th>
        <th scope="col" width="140" class="text-center">time left</th>
        <th scope="col" class="text-left">Total Bids</th>
        <th scope="col" width="160" class="text-right">action</th>
      </tr>
    </thead>
    <tbody>
<?php

    $i=0;
    foreach ($network_info as $key => $value) {  
        $list_id=$value->id;
        $status=$value->status;
        $slug=$value->slug;

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

        $thumb_image=get_thumb_image($list_id);
       
      if(!empty($thumb_image->url)){ 
        $item_image=$thumb_image->url;       
      }else{ 
        $item_image='image-not-found.jpg';
      }    
     
   
?>
 
  
      <tr>
       <!--  <td>
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
           
              <span class="Curent-01" style="float: left;border-right: 1px solid #cccccc;    padding-right: 20px;"><?php if($value->type==2){ echo "price".'<span class="price-06">$'.$value->fixed_price;}else{ echo "current price";} ?><span class="price-06"><?php

               $currentprice= get_current_price1($value->id);
               if($value->type==1)
               {
               if (!empty($currentprice)) {
                echo "$".$currentprice->bid_amount;
               }else{
                echo "NA";
               }
                ?></span></span> 
              <span class="Curent-01" >Reserved price <span class="price-06">
              $<?php echo $value->reserve_price; ?> 
              </span></span>
              <?php } ?>
            
          </div> <!-- price-wrap .// -->
        </td>
        <td class="text-right"><?php if($value->type==2){ echo "NA"; }
        else{ echo $status;}?></td>
        <td class="text-center"> 
        <?php if($status=='sold'){
          $a_cls="timestatushide";
        }else{
          $a_cls="";
        }
        ?>
          <p id="auction_<?php echo $i; ?>" class="<?php echo $a_cls;?>"></p>
        </td>
        <td> <span class="bid_font">
            <?php 


              $bid_detail=get_bid_count($list_id);
              if($bid_detail){

               if ($status =='In Auction' && $bid_detail->total_bid > 0) {
                  $delete_btn="hide";
                }else{
                  $delete_btn="show";
                }

                 ?>
               <a href="<?php echo base_url();?>user_bid/<?php echo $list_id;?>" target="_blank"><?php if($value->type==2){ echo "NA"; }
        else{ echo $bid_detail->total_bid;}?></a>
               <?php }
            ?></span>
        </td>
        
        <td class="text-right"> 
        <!-- <a href="<?php //echo base_url(); ?>user_bid/<?php //echo $list_id; ?>" target="_blank"> <span class="para-table bid-btn">BID</span></a>  -->
       <!--   <span><img src="<?php //echo base_url(); ?>assets/img/down-arrow-ic.png" style="width:auto;" data-toggle="collapse" data-target="#network_action"></span> -->
          <select class="filter_select" onchange="selling_item(this.value,'<?php echo $list_id; ?>','<?php echo $slug;?>');" style="-webkit-appearance: none;margin-top: 13px;">
            <option value="">Action</option>
            <?php if($delete_btn=='show' || $value->type==2){  ?>
            <option value="Delete">Delete</option>
            <?php } ?>
            <?php if (($status=='In Auction' && $bid_detail->total_bid==0 && $value->type==1) || $value->type==2) { ?>
            <option value="Edit">Edit</option>
          <?php   } ?>
          <?php if($value->type==2){  }
        else{ echo '<option value="Relist">Relist</option>
            <option value="user_bids">All Bids</option>';}?>
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
}else
{
  ?>
  <script type="text/javascript">
  document.getElementById("auction_<?php echo $i; ?>").innerHTML = "NA";
  </script>
  <?php
}
$i++;
}
 ?>

    </tbody>
  </table> 

</div>

<button id="delete_all" onclick="delete_all_list();" style="display: none;margin-left:20px;    background-color: #ef6c03;padding: 8px 15px;color: white;font-weight: 600;" >Delete All</button>
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
           
             echo " <li><a href='javascript:selling_all($prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:selling_all($i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:selling_all($i)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:selling_all($i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_all($i)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:selling_all($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_all($i)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:selling_all($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_all($i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:selling_all($next)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  

}else{
  

        echo '<div style="margin:10%;"><h2 style="text-align:center;">No Results Found.</h2></div>'; 

        
   
    }
     ?>
