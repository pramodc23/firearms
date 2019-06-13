<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
     $(document).ready(function(){
        $("#list_btn").click(function(){
      $("#list").removeClass("hide");
      $("#list").addClass("show");
            $("#grid").addClass("hide");
        });

        $("#grid_btn").click(function(){
      $("#grid").removeClass("hide")
           $("#grid").addClass("show");
           $("#list").addClass("hide");
        });
     });
  </script>-->
  <style>
  .display_section{
        max-height: 150px;
  }
  .grid_pro_head{
    min-height: 220px;
  }
  </style>
<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');

if (isset($categories_selected)) { ?>
  <script type="text/javascript">
    $(document).ready(function () {   
    var categories_selected='<?php echo $categories_selected;?>'; 
      $('#l_category').val(categories_selected);
    });
    
  </script>
<?php }else{
 
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--   <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
<section id="category_section">
  <div class="container">
    <div class="row">
      <div class="list-d-inner col-md-12">
        <div class="breadcrumb_section">
          <div class="bread-right_sec">
            <div class="swicher_btn pull-right">
              <ul>          
                <?php if ($UserType=='buyer') {?>
                <li><a class="switch_active" href="javascript:void()">BUYER</a></li>
                <?php  }else{?>
                <li><a class="switch_active"  href="javascript:void()">SELLER</a></li>
                <?php  } ?>             
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="filter_main">
      <form method="post" action="<?php echo base_url('buy');?>" id="search_form">
      <div class="container">
      <div class="row">
      <div class="filter_inner col-md-12">
      <div class="col-md-3 filter_lable"><label>SELECT CATEGORY</label><br/><select class="filter_select" style="-webkit-appearance: none;" name="s_category" id="l_category">
      <option value="">Select</option>
      <?php foreach($categories as $cate){?>
      <option value="<?php echo $cate['id'];?>" <?php if(isset($_POST['s_category']) && $_POST['s_category']==$cate['id']){echo 'selected';}?>><?php echo $cate['name'];?></option>
      <?php $subcat = $this->user_model->select_data('id,name,slug','categories',array('parent_id'=>$cate['id']));
        if(!empty($subcat)){
        foreach($subcat as $s_cate){
      ?>
      <option value="<?php echo $s_cate['id'];?>" <?php if(isset($_POST['s_category']) && $_POST['s_category']==$s_cate['id']){echo 'selected';}?>><?php echo $s_cate['name'];?></option>
      <?php } } }?>
      </select>
      </div>
      <div class="col-md-3 filter_lable"><label>PRICE RANGE</label><br/>
      <input type="text" id="amount" readonly style="border:0;" name="s_price">
      <div id="range-slider">
      <div id="slider-range"></div>
</div>
      </div>
      <div class="col-md-3 filter_lable"><label>LISTING DETAIL</label><br/><select class="filter_select" style="-webkit-appearance: none;" name="s_details">
      <option value="">Select</option>
      <option value="Reserve">Reserve</option>
      <option value="No Reserve">No Reserve</option>
      <option value="Fixed Price">Fixed Price</option>
      </select>
      </div>
      <div class="col-md-3 filter_lable"><label>ITEM CONDITION</label><br/><select class="filter_select" style="-webkit-appearance: none;" name="s_item_condition">
      <option value="">Select</option>
      <option value="new" <?php if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']=='new'){echo 'selected';}?>>New</option>
      <option value="old" <?php if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']=='old'){echo 'selected';}?>>Old Stock</option>
      <option value="pre_owned" <?php if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']=='pre_owned'){echo 'selected';}?>>Pre-Owned</option>
      </select>
      </div>
      <div class="join_btn pull-right"><a id="firearms_search" style="cursor:pointer; color:white;">SEARCH</a></div>
      </div>
      </div>
      </div>
    </form>
      <div class="container-fluid second_filter_main">
      <div class="container">
      <div class="row">
      <div class="sec_filter_inner col-md-12">
      <div class="col-md-2 filter_ic">
      <ul>
      <li class="grid_pre grid_btn"><a class="grid-button"><i class="fa fa-th" aria-hidden="true"></i></a><!--</li>-->
     <li class="grid_pre list_btn"><a class="list-button"><i class="fa fa-list" aria-hidden="true"></i></a><!--</li>-->
      </ul>
      </div>
      <div class="col-md-7 result-head"><span class="search_head">Result for ammunition</span>|<span class="result_des">Narrow your search. Over 10000 Items Found</span>
      </div>
      <!-- <div class="col-md-3 filter_lable sort_by"><select class="filter_select" style="-webkit-appearance: none;">
      <option>New Condition</option>
      <option>Old Condition</option>
      </select>
      </div> -->
      </div>
      </div>
      </div>
      </div>
      </section>
      <!--section filter end-->
<input type="text" id="offset" value="0">
      <!--section grid view start-->
  <section id="grid_main">
    <div class="container">
      <div class="row">
      
  <div class="col-md-12 grid_inner"  id="buy_grid_view">
    <div class="grid_content">

      <?php
      if (!empty($listings)) {
        # code...
   
       foreach($listings as $list){?>
      <div class="col-md-2 col-sm-4 grid_col">
        <div class="grid_img">
          <a href="<?php echo base_url('list-details/'.$list['slug']);?>">
            <?php if($list['primary_picture']!=''){?>
              <img class="display_section" src="<?php echo base_url('assets/img/listing_photos/thumb/'.$list['primary_picture']); ?>" id="display_primary"/>
            <?php }else{ ?>
              <img class="display_section" src="<?php echo base_url('assets/img/listing_photos/thumb/blank.jpg'); ?>" id="display_primary"/>
            <?php } ?>
          </a>
        </div>
        <div class="like_section">
          <div class="like_ic"><a <?php if($isLoggedIn){echo 'class="like_list"'; }else{ echo 'href="'.base_url('sign-in/buy').'"'; } ?> id="<?php echo $list['id'];?>" style="cursor:pointer;" ><i class="fa fa-heart-o icon" aria-hidden="true" <?php if($isLoggedIn && $list['like_status']==1){echo 'style="color:red;"';}?>></i></a></div>
        </div>
        <div class="grid_pro_head">
          <a href="<?php echo base_url('list-details/'.$list['slug']);?>"><?php 
            $str_length = strlen($list['title']);
            if($str_length > 50)
            {
              echo $string2 = substr($list['title'], 0, 50)."...";
            }else{
              echo $list['title'];
            }
            
          ?></a>
        </div>
        <div class="grid_pro_price">
        <?php 
        $start_amount=$list['starting_bid'];
        foreach ($firearms_commission as  $firearms_commission_value) {       
          if ($firearms_commission_value['commission_to']=='1000+') {
            if ($firearms_commission_value['commission_from'] <= $start_amount) {
              $commission_percent=$firearms_commission_value['commission_percent'];
            }
          }else{
            if ($firearms_commission_value['commission_from'] <= $start_amount && $firearms_commission_value['commission_to'] >= $start_amount  ) {
              $commission_percent=$firearms_commission_value['commission_percent'];
            }
          }          
        }
        
        $amount=get_final_amount($start_amount,$commission_percent);
        ?>
          <span class="price_left pull-left"><b>Starting Bid</b><br/>$<?php echo $amount;?></span>
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
          <span class="reserve_status pull-left"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span>
          <span class="buy_btn_now pull-right">
            <?php if($isLoggedIn && $UserType=='buyer'){ ?>
              <a href="<?php echo base_url('list-details/'.$list['slug']);?>">Bid Now !</a>
            <?php }else if($isLoggedIn && $UserType=='seller'){

              } else{ ?>
              <a href="<?php echo base_url('sign-in/buy');?>">Bid Now !</a>
            <?php } ?>
          </span>
        </div>
      </div>
      <?php }  
        }else{ ?>
      <div style="margin: 5% 37%;">
        <h2>No list item available</h2>
      </div>  
      <?php   } ?>
  </div>

      <div class="spacer"></div>
   
        </div>
      
      </div>
    </div>
  </section>
      <!--section grid view End-->

  <!--section list view start-->    
  <section id="list_table">
    <div class="container">
      <div class="row">
        <div class="col-md-12 list_inner_item table-hover hide" id="buy_list_view">

        <?php   if (!empty($listings)) { ?>
        <table class="Responsive-table" width="100%" border="1">
        <tr>
          <th scope="col">Image</th>
          <th scope="col">Title</th>
          <th scope="col">Starting Bid</th>
          <th scope="col">Bid Count</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
  <?php
  foreach($listings as $list){?>
  <tr>
    <td>
      <div class="grid_img">
        <a href="<?php echo base_url().$list['slug'];?>">
          <?php if($list['primary_picture']!=''){?>
          <img class="display_section" src="<?php echo base_url('assets/img/listing_photos/thumb/'.$list['primary_picture']); ?>" id="display_primary"/>
          <?php }else{ ?>
          <img class="display_section" src="<?php echo base_url('assets/img/listing_photos/thumb/blank.jpg'); ?>" id="display_primary"/>
          <?php } ?>
        </a>
      </div>
    </td>
    <td><div class="grid_pro_head"><a href="<?php echo base_url().$list['slug'];?>"><?php echo $list['title'];?></a></div></td>
    <td><span class="price_left">$<?php echo $list['starting_bid'];?></span></td>
    <?php $bids_count=$this->user_model->aggregate_data('bid','id','COUNT',array('list_id'=>$list['id']));?>
    <td><div class="grid_pro_price"><span class="bid_status">
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
      | <?php echo $bids_count;?> Bids</span></div>
    </td>
    <td>
      <span class="reserve_status"><i class="fa fa-unlock-alt" aria-hidden="true"></i>No reserve</span>
    </td>
    <td>
      <span class="buy_btn_now">
      <?php if($isLoggedIn){ ?>
        <a href="<?php echo base_url('list-details/'.$list['slug']);?>">Bid Now !</a>
      <?php }else{ ?>
        <a href="<?php echo base_url('sign-in/buy');?>">Bid Now !</a>
      <?php } ?>
      </span>
    </td>
  </tr>
  <?php } ?>
            </table>

  <?php }else{ ?>
  <div style="margin: 5% 37%;"><h2>No list item available</h2></div> 
  <?php   } ?>
        </div>
      </div>
    </div>
  </section>
  <!--section list view End-->

  
</section>
<?php

if(isset($_POST['s_price'])){
    $price=str_replace("$","",$_POST['s_price']);
    $both_prices=explode("-",$price);
    $min_price=$both_prices[0];
    $max_price = $both_prices[1];
}else{
    $min_price=1;
    $max_price=1000000;
}

?>

<script>
// Range slider - gravity forms
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 1,
      max: 1000000,
      values: [ '<?php echo $min_price; ?>', '<?php echo $max_price; ?>' ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );

</script>
<script>
$(document).ready(function(){
   $("#amount").click(function(){
       $("#range-slider").toggle();
   });
});
</script>
<script>
$(document).ready(function()
{
    $("body").mouseup(function(e)
    {
        var subject = $("#range-slider"); 

        if(e.target.id != subject.attr('id'))
        {
            subject.fadeOut();
        }
    });
});
</script>
<script>
$(".grid-button").click(function(){
    $(".grid_inner").removeClass("hide");
    $(".table-hover").addClass("show");
    $(".grid-button").addClass("current");
    $(".list-button").removeClass("current");
});

$(".list-button").click(function(){
    $(".table-hover").removeClass("show");
    $(".grid_inner").addClass("hide");
    $(".grid-button").removeClass("current");
    $(".list-button").addClass("current");
});

</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('.grid-button').click(function () {
      $('.table-hover').css('display', 'none');
    });
  $('.list-button').click(function () {
      $('.table-hover').css('display', 'block');
    });
  });
</script>

<script type="text/javascript">

    $( document ).ready(function() {
        //show_buy_item();  
    }); 

  function show_buy_item(){
   // $(".loader").show();
    //$("#data_loader").show();
    var view='apend';   
    var limit =8;
    var offset = $("#offset").val(); 

    $.ajax({url: "<?php echo base_url("home/get_buy_list_item");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset},
        success: function(result){           

          $("#buy_grid_view").html('');
          $("#buy_list_view").html('');
            // offset = parseInt(offset)+parseInt(8);
            // $("#offset").val(offset);
            var dataObj = JSON.parse(result);          
          
            $("#buy_grid_view").append(dataObj[0]); 
            $("#buy_list_view").append(dataObj[1]); 

            // if(dataObj[1] == "end"){               
            //   $("#data_loader").hide(); 
            // }         
            // $(".loader").hide();
      }
    }); 
  }

</script>

