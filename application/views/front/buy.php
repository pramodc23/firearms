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
  td {
    padding:5px;
  }
  .display_section{
        max-height: 150px;
  }
  .grid_pro_head{
    min-height: 205px;
  }
  .load_more{
    float: right;margin-right: 12px;margin-top: 50px;background-color: #ef6c03;color: #FFF;
  }
  #pagination{
    clear:both;
  }
ul.pagination a {
    border-radius: 50px !important;
    background: #fff;
    color: #444444 !important;
    /* color: #f96c04; */
    font-size: 15px;
    font-family: lato;
    font-weight: 600;
    border: none;
    margin-right: 13px;
    padding: 12px 17px;
    /* padding: 4px 11px; */
    border: 1px solid #f96c04;
}
.pagination>.active>a {
    background: #f96c04;
    color: white !important;
}
.pagination{
 /* margin-top: 20px;*/ position: absolute;top: 0;bottom: 0;left: 0; right: 0;margin: auto;justify-content: center;

}

  </style>
<?php
$isLoggedIn = $this->session->userdata('isLoggedIn');
$UserType = $this->session->userdata('user_type');

if (isset($seller_id)) { 
   $seller_new_id=$seller_id;
}else{
   $seller_new_id='';
}

if (isset($catid)) { 
   $cat_id=$catid;
}else{
   $cat_id='';
}

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section id="category_section">
  <div class="container" style="display: none;">
    <div class="row">
      <div class="list-d-inner col-md-12">
        <div class="breadcrumb_section">
          <div class="bread-right_sec">
                 
                <?php if ($UserType=='buyer') {?>
            <div class="swicher_btn pull-right">
              <ul>  
                <li><a class="switch_active" href="javascript:void()">BUYER</a></li>
                 </ul>
            </div>
                <?php  }else if ($UserType=='seller'){?>
                  <div class="swicher_btn pull-right">
              <ul> 
                <li><a class="switch_active"  href="javascript:void()">SELLER</a></li>
                 </ul>
            </div>
                <?php  } ?>             
             
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
            <div class="col-md-3 filter_lable"><label>SELECT CATEGORY</label><br/>
              <select class="filter_select" style="-webkit-appearance: none;" name="s_category" id="l_category">
                <option value="">Select</option>
                <?php

                 $others = array();
                 $sothers = array();
                 foreach($categories as $cate){?>
                <option value="<?php echo $cate['id'];?>" <?php if(isset($_POST['s_category']) && $_POST['s_category']==$cate['id']){echo 'selected';}?>><?php echo $cate['name'];?></option>


                <?php $subcat = $this->user_model->select_data('id,name,slug','categories',array('parent_id'=>$cate['id'],'status' => 1),'',array('name','ASC'));
                if(!empty($subcat)){

                   for($l=0;$l<count($subcat);$l++)
                  {
                    if (strpos($subcat[$l]['name'], 'Other') !== false) {
                      $others = $subcat[$l];
                      unset($subcat[$l]);
                       }
                  }
                  if(!empty($others))
                  {
                    array_push($subcat,$others); 
                    unset($others);
                  }

                  foreach($subcat as $s_cate){
                    ?>
                    <option value="<?php echo $s_cate['id'];?>" <?php if(isset($_POST['s_category']) && $_POST['s_category']==$s_cate['id']){echo 'selected';}?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $s_cate['name'];?></option>

                     <?php 
                    $subcat2=$this->user_model->select_data('id,name','categories',array('parent_id'=>$s_cate['id'],'status' => 1),'',array('name','ASC'));

                     for($m=0;$m<count($subcat2);$m++)
                  {
                    if (strpos($subcat2[$m]['name'], 'other') !== false || strpos($subcat2[$m]['name'], 'Other') !== false) {
                      $sothers = $subcat2[$m];
                      unset($subcat2[$m]);
                       }
                  }
                  if(!empty($sothers))
                  {
                    array_push($subcat2,$sothers); 
                    unset($sothers);
                  }
                    foreach($subcat2 as $sub2){
                    ?>
                     <option value="<?php echo $sub2['id'];?>" <?php if(isset($_POST['s_category']) && $_POST['s_category']==$s_cate['id']){
                      echo 'Selected';  }?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucfirst($sub2['name']);?></option>

                    <?php } } } }?>
                </select>
              </div>
              <div class="col-md-2 filter_lable"><label>PRICE RANGE</label><br/>
                <input type="text" id="amount" readonly style="border:0;" name="s_price">
                <div id="range-slider">
                  <div id="slider-range"></div>
                </div>
              </div>
              <div class="col-md-2 filter_lable"><label>SORTING</label><br/>
                <select class="filter_select" style="-webkit-appearance: none;padding-right: 40px;" name="s_sorting" id="s_sorting">
                  <option value="">Select</option>
                  <option value="price_lowest_to_highest">Price Lowest To Highest</option>
                  <option value="price_highest_to_lowest">Price highest to lowest</option>
                  <option value="ending_soon">Ending soon</option>
                  <option value="newest_listings">Newest listings</option>
                </select>
              </div>
              <div class="col-md-2 filter_lable"><label>LISTING DETAIL</label><br/><select class="filter_select" style="-webkit-appearance: none;" name="s_details">
                  <option value="">Select</option>
                  <option value="Reserve">Reserve</option>
                  <option value="No Reserve">No Reserve</option>
                  <option value="Fixed Price">Fixed Price</option>
                </select>
              </div>
              
              <div class="col-md-2 filter_lable"><label>ITEM CONDITION</label><br/>

                <select class="filter_select" style="-webkit-appearance: none;" name="s_item_condition" id="s_item_condition">
                  <option value="">Select</option>
                  <option value="new" <?php if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']=='new'){echo 'selected';}?>>New</option>
                  <option value="old" <?php if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']=='old'){echo 'selected';}?>>Old Stock</option>
                  <option value="pre_owned" <?php if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']=='pre_owned'){echo 'selected';}?>>Pre-Owned</option>
                </select>
              </div>
       <div class="col-md-1 join_btn pull-right search_btn_filter" style="top: 4px;">
              <a onclick="show_buy_item(0,10);" style="cursor:pointer;margin-right:16px; color:white;border-radius: 5px;">SEARCH</a>
            </div>
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
              <li class="grid_pre grid_btn"><a class="grid-button current"><i class="fa fa-th" aria-hidden="true"></i><p style=""> Grid </p>
              </a>
               <li class="grid_pre list_btn"><a class="list-button"><i class="fa fa-list" aria-hidden="true"></i><p style=""> List </p>
               </a>
            </ul>
          </div>
          <div class="col-md-7 result-head"><span class="search_head">Result for <span id="search_lable"></span></span>|<span class="result_des">Total - <span id="total_items"></span></span>
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
<?php
if (isset($_GET['search'])) {
  $search=$_GET['search'];
}else{
  $search='';
}
?>  
<input type="hidden" id="search_text" value="<?php echo $search; ?>">

<input type="hidden" id="offset" value="0">
<input type="hidden" id="seller_id" value="<?php echo $seller_new_id; ?>">
<input type="hidden" id="cat_id" value="<?php echo $cat_id; ?>">

      <!--section grid view start-->
  <section id="grid_main">
    <div class="container">
      <div class="row">      
        <div class="col-md-12 grid_inner"  id="buy_grid_view">
            <!-- grid content  -->
        </div>  
            
      </div>
    </div>
  </section>
      <!--section grid view End-->

  <!--section list view start-->    
  <section id="list_table">
    <div class="container">
      <div class="row">
        <div class="col-md-12 list_inner_item table-hover hide" id="buy_list_view" >         
           <!-- list content  -->
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
    $min_price=0;
    $max_price=1000000;
}

?>

<script>
// Range slider - gravity forms
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
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
function like_list_item(list_id) {

    var base_url = $('#base_url').val();
    var current = $('#like_btn_list_'+list_id);
    //alert(list_id);
    // current.parent().find('.icon').css('display','none');
    // current.parent().find('.like_loader').css('display','block');
    $.ajax({
          method : 'post',
          url : base_url+'user_action/like_list',
          data : {'list_id' : list_id}
        }).done(function(resp){
           // current.parent().find('.like_loader').css('display','none');
           // current.parent().find('.icon').css('display','block');
           if(resp=='remove'){
              
              current.parent().find('.icon').removeClass('fa-heart');
              current.parent().find('.icon').addClass('fa-heart-o');
                   
              swal("Success!", "Listing removed from favourites .", "success");
           }else{
           
            current.parent().find('.icon').removeClass('fa-heart-o');
              current.parent().find('.icon').addClass('fa-heart');
            swal("Success!", "Listing added to favourites .", "success");
           }
        });
  }

    $( document ).ready(function() {
        show_buy_item(0,10);  
    }); 


  function show_buy_item(offset,limit){
    var view='view';   
    //var limit =10;
    var search_text = $("#search_text").val(); 

    var seller_id = $("#seller_id").val(); 
    var cat_id = $("#cat_id").val(); 
    var l_category=$('#l_category').val();

    var amount=$('#amount').val();
    var amount1=amount.replace(/[^-0-9]/g, "");
    var item_condition=$('#s_item_condition').val();
    var s_sorting=$('#s_sorting').val();
    
    if(l_category !=''){
      var dd_text = $("#l_category option:selected").text(); 
  
      var myStr = jQuery.trim(dd_text);
        
      var msg='Category ( '+myStr+' ) ...'; 
      $("#search_lable").text(msg);
    }else if(amount1 !='' && amount1 !='0-1000000'){      
      var msg1='Price ( '+amount1+' ) ...'; 
      $("#search_lable").text(msg1);
    }else if(item_condition !=''){
      var ic_text = $("#s_item_condition option:selected").text();
      var msg2='Item Condition ( '+ic_text+' ) ...'; 
      $("#search_lable").text(msg2);
    }else if(s_sorting !=''){
      var s_sorting_text = $("#s_sorting option:selected").text();
      var msg3='Sorting ( '+s_sorting_text+' ) ...'; 
      $("#search_lable").text(msg3);
    }else if(search_text !=''){
      var msg4=' '+search_text+'  ...'; 
      $("#search_lable").text(msg4);
    }else{
      $("#search_lable").text('All');
    }

    var order_by ='id';
    
    $.ajax({url: "<?php echo base_url("home/get_buy_list_item");?>",
        type:'POST', 
        data:{categories:l_category,amount:amount1,sorting:s_sorting,item_condition:item_condition,seller_id:seller_id,cat_id:cat_id,view:view,limit:limit,offset:offset,order_by:order_by,search_text:search_text},
        success: function(result){    
            // offset = parseInt(offset)+parseInt(10);
            // $("#offset").val(offset);
            var dataObj = JSON.parse(result);         
            // console.log(dataObj[5]);  
            if(view=='view') {
              $("#buy_grid_view").html(dataObj[0]); 
              $("#buy_list_view").html(dataObj[1]); 
            }else{
              $("#buy_grid_view").append(dataObj[0]); 
              $("#buy_list_view").append(dataObj[1]); 
            }            
            $("#total_items").text(dataObj[4]);            
      }
    }); 
  }

</script>

