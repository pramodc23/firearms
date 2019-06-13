<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');
    $i=0;
    $video_id_ary=explode(',', $video_id);
    foreach ($all_videos as  $value) { 
        $video_type=$value->type;
        $video_url=$value->url;  
        $list_attachment_id=$value->id;  
       
        
        
        if (in_array($list_attachment_id, $video_id_ary)){
            $chk_val="exist";
            $network_border='network_border';
        }else{
            $chk_val="";
            $network_border='';
        }


        ?>
    <div class="col-md-3  col-md-12 mynetwork_video_cal video_sec_<?php echo $i;?>  <?php echo $network_border;?>">  
        <?php 
        if ($video_type=='vimeo_id') { 

            ?>
            <iframe  src="https://player.vimeo.com/video/<?php echo $video_url;?>?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=133127\" width="100%" height="auto" frameborder="0" title="Untitled" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
       <?php }else{ 
        ?>
            <iframe  src="<?php echo $video_url;?>" width="100%" height="auto" frameborder="0" title="Untitled" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>  
       <?php }   ?>
        <a href="<?php echo base_url();?>list-details/<?php echo $value->slug;?>" style="text-decoration: none;" target="_blank"><span style="padding: 10px 0px 10px 0px;    display: block;    color: #ff6d00;    font-size: 21px;"><?php echo $value->title;?></span></a>  
        <input data-id="<?php echo $i;?>" data-val="<?php echo $value->id;?>"  data-network="mynetwork" type="checkbox" value="<?php echo $value->id;?>"  <?php echo ($chk_val=='exist' ? 'checked' : '');?>>

        
    </div>
<?php $i++; } ?>
<div class="col-sm-12">
<?php 
$count=$pagination->total;
if ($count !=0) { ?>
<span class="filter_lable" style=" width: 100px; display:inline-block;">
    <select class="filter_select" style="-webkit-appearance: none;" onchange="show_mynetwork_video(0,this.value)">
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
           
             echo " <li><a href='javascript:show_mynetwork_video($prev,$limit_paggination)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:show_mynetwork_video($i,$limit_paggination)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:show_mynetwork_video($i,$limit_paggination)'>$counter</a></li> ";
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
                            echo " <li  class='active'><a href='javascript:show_mynetwork_video($i,$limit_paggination)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:show_mynetwork_video($i,$limit_paggination)'>$counter</a></li> ";
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
                            echo " <li   class='active'><a href='javascript:show_mynetwork_video($i,$limit_paggination)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:show_mynetwork_video($i,$limit_paggination)'>$counter</a></li> ";
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
                            echo " <li class='active'><a href='javascript:show_mynetwork_video($i,$limit_paggination)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:show_mynetwork_video($i,$limit_paggination)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page)){
              echo " <li><a href='javascript:show_mynetwork_video($next,$limit_paggination)'>Next</a></li> ";
            }
         
            echo "</ul>";    
        } 
    }  
    //pagination end
    ?>
</div>