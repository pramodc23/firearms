<?php
    $isLoggedIn = $this->session->userdata('isLoggedIn');
    $UserType = $this->session->userdata('user_type');
    foreach ($all_videos as  $value) {

        $buy_now_price=$value->buy_now_price;
        $buy_amount=amount_with_commission($buy_now_price); 
        $end_auction=$value->end_auction;
        $current_date = date('Y-m-d H:i:s');
        $end_auction = strtotime($end_auction);
        $current_date = strtotime($current_date);
        $list_type=$value->list_type;
        $video_type=$value->type; ?>

<div class="col-md-3  col-md-12 video_cal" style="text-align: center;" >   
    <?php  if($video_type=='youtube'){ ?>
        <iframe src="<?php echo $value->url; ?>"  width="100%" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="v_url"></iframe>
    <?php }else{ ?>
        <iframe  src="https://player.vimeo.com/video/<?php echo $value->url;?>?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=133127\" width="100%" height="auto" frameborder="0" title="Untitled" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    <?php }  ?> 
	
    <a href="<?php echo base_url();?>list-details/<?php echo $value->slug;?>" style="text-decoration: none;" target="_blank"><span style="padding: 10px 0px 10px 0px;    display: block;    color: #ff6d00;    font-size: 21px;"><?php echo $value->title;?></span></a>
 
    <?php
       if ($value->is_sold =='1') { ?>
           <div class="row video_btns" style="margin: 1px 33%">
            <button type="button" class="v_btn" style="opacity: 0.6;">Sold</button>
            </div>
    <?php   } else if ($current_date > $end_auction) { ?>
        <div class="row video_btns" style="margin: 1px 33%">
            <button type="button" class="v_btn" style="opacity: 0.6;">Expired</button>
        </div>
       <?php }  else{
        ?>
       <div class="row video_btns" style="margin: 1px 3%">
        <a href="<?php echo base_url();?>list-details/<?php echo $value->slug;?>" target="_blank"><button type="button" class="v_btn" >Buy</button></a>
        <?php 

            $listid= $value->list_id;
            $todat_bid=get_bid_count($listid);
            $todat_bid=$todat_bid->total_bid;

            if($todat_bid <= 0 && $list_type !='2'){
                if($isLoggedIn){
            if ($UserType=="seller") { ?>
               <a style="cursor:pointer;" onclick="seller_login();">
           <?php }else{ ?>
            <a href="<?php echo base_url();?>list-details/<?php echo $value->slug;?>/<?php echo $buy_amount;?>">
         <?php   } ?>
            <?php }else{ ?>       
        <a href="<?php echo base_url('sign-in/')?>">
        <?php } ?>
        <button type="button" class="v_btn" >Buy Now!</button></a>
        <?php } ?>
        </div>
    <?php }   ?>  
    
</div>

<?php } ?>
<div class="col-sm-12">

<?php 
$count=$pagination->total;

if ($count !=0) { ?>
<span class="filter_lable" style=" width: 100px; display:inline-block;">
    <select class="filter_select" style="-webkit-appearance: none;" onchange="show_video(0,this.value)">
        <option value="5" <?php if ($limit_paggination=='5') { echo "Selected";}else{'';} ?>>5</option>
        <option value="10" <?php if ($limit_paggination=='10') { echo "Selected";}else{'';} ?>>10</option>
        <option value="20" <?php if ($limit_paggination=='20') { echo "Selected";}else{'';} ?>>20</option>
        <option value="50" <?php if ($limit_paggination=='50') { echo "Selected";}else{'';} ?>>50</option>
        <option value="100" <?php if ($limit_paggination=='100') { echo "Selected";}else{'';} ?>>100</option>
    </select>
</span>
<?php } ?>
<?php
//pagination start
  
  $count_rem=$pagination->total;

  if( $count > $limit_paggination){ ?>

  <?php

    $per_page = $limit_paggination;
    $page_id =$offset_paggination;
    $foundnum =$count;
    $count = (int)($count/$per_page);
    $rem=($count_rem%$per_page);
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
           
             echo " <li><a href='javascript:show_video($prev,$limit_paggination)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:show_video($i,$limit_paggination)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:show_video($i,$limit_paggination)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:show_video($i,$limit_paggination)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:show_video($i,$limit_paggination)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:show_video($i,$limit_paggination)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:show_video($i,$limit_paggination)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:show_video($i,$limit_paggination)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:show_video($i,$limit_paggination)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:show_video($next,$limit_paggination)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 

  }  


    //pagination end
    ?>


</div>