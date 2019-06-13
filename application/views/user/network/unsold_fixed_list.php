<div class="table-section-08">
  <div class="side-by-side">
    <div class="row">
      <div class="col-md-8">
        <p>Show Items- Expired  &nbsp;&nbsp;All (<?php echo count($network_info); ?>)  <!-- &nbsp;&nbsp;Active (1)  &nbsp;&nbsp;Ended --></p>
      </div>
      <div class="col-md-4 pull-right">
       <!--  <span><img src="<?php //echo base_url(); ?>assets/img/Print-ic.png"> Print</span> -->
      </div>
    </div> 
  </div>
<script type="text/javascript">
  $('#selling_checked_all').click(function() {
    if ($(this).is(':checked')) { 
      $(".selling_all_check").prop("checked", true);
      $('#delete_all').show();$('#relist_all').show();
    }else{
      $(".selling_all_check").prop("checked", false);   
      $('#delete_all').hide();$('#relist_all').hide(); 
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
  
  function relist_all_list() {  
         swal({
          title:"Are you sure?",
          text: "To relist all property!",
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
              
                $.post("<?php echo base_url("user_action/relist_expired_list"); ?>", {list_id:val}, function(result){ 
                      if (result=='Success') {
                        swal("Lists Relist Successfully!", {
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
?>
  <table class="table table-hover shopping-cart-wrap table-responsive deatails-table">
    <thead class="text-muted">
      <tr>
        <th scope="col" class="text-left" >
          <input id="selling_checked_all" type="checkbox" ></th>        
        <th scope="col" class="text-left">Thumb</th>
        <th scope="col" width="430" class="text-left">title</th>
         <th scope="col"  class="text-left">Status</th>
        <th scope="col" class="text-left">Quantity</th>
        <th scope="col" width="160" class="text-right"></th>
      </tr>
    </thead>
    <tbody>
<?php

    $i=0;
    foreach ($network_info as $key => $value) {
     $base_url=base_url();
      $onerrorimage=$base_url."assets/img/listing_photos/thumb/image-not-found.jpg";  

        $list_id=$value->id;
        $slug=$value->slug;
        $quantity=$value->quantity;

        $thumb_image=get_thumb_image($list_id);
       
      if(!empty($thumb_image->url)){ 
        $item_image=$thumb_image->url;       
      }else{ 
        $item_image='image-not-found.jpg';
      }    
     
    $end_date = date('M d, Y H:i:s',strtotime($value->end_auction));
?>
 
  
      <tr>
        <td>
          <?php if($value->type==1){ ?>
          <figure class="media">
            <input name="selling_all_check" class="selling_all_check" type="checkbox" value="<?php echo $list_id; ?>" >
           <!--  <figcaption class="media-body">
              <h6 class="title text-truncate"><?php //echo $list_id; ?></h6>
            </figcaption> -->
          </figure> 
          <?php } ?>
        </td>
       
        <td class="text-left"> 
          <img src="<?php echo base_url(); ?>assets/img/listing_photos/<?php echo $item_image; ?>"  onerror="this.onerror=null;this.src='<?php echo $onerrorimage;?>'">
        </td>
        <td> 
          <div class="price-wrap"> 
            <a href="<?php echo base_url('list-details/'.$slug);?>" target="_blank"><p class="text-left"><?php echo $value->title; ?></p> </a>
            
              <span class="Curent-01" style="float: left;border-right: 1px solid #cccccc;    padding-right: 20px;"><?php if($value->type==2){ echo "price".'<span class="price-06">$'.$value->fixed_price;}else{ echo "Starting Price";} ?>
               <?php if($value->type==1)
               {
               ?>
                <span class="price-06">$<?php
                    $start_amount= $value->starting_bid; 
                echo  number_format($amount=amount_with_commission($start_amount),2); ?></span></span> 
              <span class="Curent-01" >Reserved price <span class="price-06">$<?php echo number_format($value->reserve_price,2); ?></span></span>
              <?php } ?>
          </div> <!-- price-wrap .// -->
        </td>
        <td> <span class="bid_font">
            <?php 
            if($value->type==1){
            $today_date = date("Y-m-d H:i:s");
          
            $end_auction=$value->end_auction;
          if ($end_auction > $today_date) {          
           echo $item_st="In auction";
          }else{            
            echo $item_st="EXPIRED";

          }
        }
        else
        {
          echo "NA";
        }
              
            ?></span>
        </td>
        <td> <span class="bid_font"> <?php echo $quantity;?></span>
        </td>
       <td class="text-right"> 
   
  
        <select class="filter_select" onchange="selling_item(this.value,<?php echo $list_id; ?>);" style="-webkit-appearance: none;margin-top: 13px;">
            <option value="">Action</option>
            <?php if($delete_btn=='show' || $value->type==2){  ?>
            <option value="Delete">Delete</option>
            <?php }?>
            <?php if($value->type==1){ ?>
            <option value="Relist">Relist</option>
            <option value="user_bids">All Bids</option>           
            <?php } ?>
        </select>
 
                
       </td>
     </tr>
 
     


<?php 
$i++;
} ?>

    </tbody>
  </table> 


</div>

<button id="delete_all" onclick="delete_all_list();" style="display: none;margin-left:20px;background-color: #ef6c03;padding: 8px 15px;color: white;font-weight: 600;" >Delete All</button>

<button id="relist_all" onclick="relist_all_list();" style="display: none;margin-left:20px;background-color: #ef6c03;padding: 8px 15px;color: white;font-weight: 600;" >Relist All</button>

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
           
             echo " <li><a href='javascript:selling_unsold($prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:selling_unsold($i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:selling_unsold($i)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:selling_unsold($i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_unsold($i)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:selling_unsold($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_unsold($i)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:selling_unsold($i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:selling_unsold($i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:selling_unsold($next)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  

}else{
  

        echo '<div style="margin:10%;"><h2 style="text-align:center;">No Results Found.</h2></div>'; 

        
   
    }
     ?>
