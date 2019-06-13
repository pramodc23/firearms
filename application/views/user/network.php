<?php
 $user_type = $this->session->userdata('user_type');



   if ($user_details[0]['profile_image'] !='') {
      $profile_image=$user_details[0]['profile_image'];
    }else{
      $profile_image='user_profile.png';
    }



?>
<style type="text/css">
.caption-select-network a.active{background:#f96c04;color:#fff}.timestatushide .fixed_containt{display:none}.row.new-white-box{border:1px solid #c6c4c4;margin-bottom:28px!important;margin:0 15px;margin-top:28px}.content-box{padding-top:40px;padding-bottom:40px;font-family:lato;text-align:center}.content-box h3{font-weight:600}ul.Left-menus-01 label{display:block;padding-left:23px;font-family:lato}ul.Left-menus-01{list-style-position:inside;padding-left:0;padding-bottom:10px;height:auto;border:1px solid #e9e9e9;background:0 0}.main-box05{margin:0 15px 40px}ul.pagination a{border-radius:50px!important;background:#eee;color:#444!important;font-size:15px;font-family:lato;font-weight:600;border:none;margin-right:13px;padding:4px 11px}.pagination>.active>a{background:#f96c04;color:#fff!important}select{width:100%;height:37px;border-radius:5px;border:1px solid #ccc;padding-left:10px;color:#444;font-size:14px;font-family:lato;background-repeat:no-repeat!important;font-style:italic;background:url(../firearms-new-dev/assets/img/drop_aerrow.png) #fff right}.btn_cls{border:none;outline:0;cursor:pointer;font-size:18px}.text-right a{text-decoration:none}.active_cls,.btn_cls:hover{color:#ef6b06!important;font-weight:600}.bid_font a{color:#f96c04;font-weight:600;text-decoration:none}.table-section-08{border-bottom:1px solid #ddd}.loader{width:100%;height:100%;position:fixed;z-index:9999;top:0;bottom:0;background-color:rgba(0,0,0,.6588235294117647);display:none}.loader_img{display:block;margin:0 auto;width:70px;margin-top:20%}#menu_list{padding-left:0}
</style>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto+Slab:700' rel='stylesheet' type='text/css'>

<div class="loader">
    <img src="<?php echo base_url(); ?>assets/img/loader.gif" class="loader_img">
 </div>
<section id="list-detail">
  <div class="container">
    <div class="row new-white-box">
      <div class="col-md-12">
        <div class="content-box">
         <?php if ($user_type=='buyer') { ?>
                <h3>Buying Status!</h3>
        <?php }else{ ?>
                    <h3>Selling Status!</h3>
         <?php } ?>   
         <p>Check the status of your bids by navigating  <?php if ($user_type=='buyer') { ?>
               Buying <?php }else{ ?>Selling <?php } ?> a Firearm &gt; Firearms Network.</p>
        </div>
      </div>
    </div>
  <section class="second-box-01">
    <div class="row">
      <div class="col-md-12">
       <img src="<?php echo base_url(); ?>assets/img/profile_image/<?php echo $profile_image;?>"> <span class="profile-details01">WELCOME <?php echo strtoupper($user_details[0]['first_name']);?></span> <span class="caption-new">          
              <ul class=" caption-select-network">
                <li  class="auction_tab"><a class="active auction_t" href="JavaScript:void(0);">Auction</a></li>
                 <?php if ($user_type=='buyer') { ?>
                <li class="fixed_tab_buyer"><a class="fixed_tab_buyer fibuy" href="JavaScript:void(0); ">Fixed</a></li>
              <?php }else{ ?>
                     <li class="fixed_tab"><a class="fixed_tab fibuys" href="JavaScript:void(0); ">Fixed</a></li>
                <?php } ?>
            </ul>

        <?php if ($user_type=='buyer') { ?>
            Buying
        <?php }else{ ?>
            Selling  
         <?php } ?>
       </span>
     </div>
   </div>
  </section>


<div class="main-box05 auction_containt" >
  <div class="row">
    <div class="col-md-3 pad-0">
    <ul class="Left-menus-01" >
      <h5>Summary</h5>
        <input type="hidden" id="current_selected" value="all">
        <input type="hidden" id="current_selected_buy" value="all">
       
        <input type="hidden" id="shortlist_item" value="id">
        <input type="hidden" id="shortlist_item_buy" value="id">

        <input type="hidden" id="shortlist_orderby_item" value="DESC">
        <input type="hidden" id="shortlist_orderby_item_buy" value="DESC">
      
      <?php if ($user_type=='buyer') { ?>
      <h5>Buying</h5>
        
        <ul id="menu_buyer_auction">
          <li class="btn_cls active_cls" onclick="buying_all(0)" >All</li>
          <li class="btn_cls"  onclick="watch_list_item(0)">Watching</li>
          <li class="btn_cls"  onclick="buying_Won(0)" >Won</li>
          <li class="btn_cls" onclick="buying_notwon(0)" >Didn’t Win</li>
        </ul>
      <h5 style="margin-top: 20px;">List Current Bid</h5>
       <li>Sort list by</li>
        <input type="radio" class="radio-inline short_list_buying" name="radio_buy" value="id" style="display: none;" checked="checked">
        <label><input type="radio" class="radio-inline short_list_buying" name="radio_buy" value="title"><span class="outside"><span class="inside"></span></span>Title</label>
 
        <label><input type="radio" class="radio-inline short_list_buying" name="radio_buy" value="status"><span class="outside"><span class="inside"></span></span>Status</label>
        <label><input type="radio" class="radio-inline short_list_buying" name="radio_buy" 
        value="end_auction"><span class="outside"><span class="inside"></span></span>Time remaining</label> 

      <li>Order By</li>
        <label><input type="radio" class="radio-inline short_list_buying" name="radio_order" value="ASC"  ><span class="outside"><span class="inside" ></span></span>ASC</label>
        <label><input type="radio" class="radio-inline short_list_buying" name="radio_order" 
        value="DESC" checked="checked"><span class="outside"><span class="inside"></span></span>DESC</label>
      <script>
      // Add active class to the current button (highlight it2)
        var header1 = document.getElementById("menu_buyer_auction");
           
        var btns = header1.getElementsByClassName("btn_cls");
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active_cls");
            current[0].className = current[0].className.replace(" active_cls", "");
            this.className += " active_cls";
          });
        }
      </script>
        <?php    }else{ ?>
      <h5 style="margin-top: 20px;">Selling</h5>
        <ul id="menu_sell_auction">
          <li class="btn_cls active_cls" onclick="selling_all(0)" >All</li>
          <li class="btn_cls" onclick="selling_schedule(0)">Schedule</li>
          <li class="btn_cls"  onclick="selling_sold(0)" >Sold</li>
          <li class="btn_cls" onclick="selling_unsold(0)" >Expired</li>
        </ul>

      <h5 style="margin-top: 20px;">List Current Bid</h5>
       <li>Sort list by</li>
        <input type="radio" class="radio-inline short_list" name="radio_bid" value="id" style="display: none;" checked="checked">
        <label><input type="radio" class="radio-inline short_list" name="radio_bid" value="title"><span class="outside"><span class="inside"></span></span>Title</label>
 
        <label><input type="radio" class="radio-inline short_list" name="radio_bid" value="status"><span class="outside"><span class="inside"></span></span>Status</label>
        <label><input type="radio" class="radio-inline short_list" name="radio_bid" 
        value="end_auction"><span class="outside"><span class="inside"></span></span>Time remaining</label>

        <li>Order By</li>

        <label><input type="radio" class="radio-inline short_list" name="radio_order" value="ASC" ><span class="outside"><span class="inside" ></span></span>ASC</label>
        <label><input type="radio" class="radio-inline short_list" name="radio_order" 
        value="DESC" checked="checked"><span class="outside"><span class="inside"></span></span>DESC</label>
          <script>
          // Add active class to the current button (highlight it1)
          var header = document.getElementById("menu_sell_auction");
       
          var btns = header.getElementsByClassName("btn_cls");

          for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
              var current = document.getElementsByClassName("active_cls");

              current[0].className = current[0].className.replace(" active_cls", "");
              this.className += " active_cls";
            });
          }
          </script>
        <?php } ?>
      </ul>
    </div>
    <div class="col-md-9 pad-01" id="network_result">
      <div class="table-section-08" style="margin:20% 30%;">
          <h1>Summary</h1>          
      </div>
    </div>
  </div>
</div>
 
 <!--fixed containt start -->
<div class="main-box05 fixed_containt" >
  <div class="row">
    <div class="col-md-3 pad-0">
    <ul class="Left-menus-01" >
      <h5>Summary</h5>
        <input type="hidden" id="current_selected_fixed" value="all">
        <input type="hidden" id="current_selected_buy_fixed" value="all">
       
        <input type="hidden" id="shortlist_item_fixed" value="id">
        <input type="hidden" id="shortlist_item_buy_fixed" value="id">

        <input type="hidden" id="shortlist_orderby_item_fixed" value="DESC">
        <input type="hidden" id="shortlist_orderby_item_buy_fixed" value="DESC">     

        <?php if ($user_type=='buyer') { ?> 

          <h5>Buying</h5>
        
        <ul id="menu_buyer_fixed">
          <li class="btn_clss active_cls" onclick="buying_all_fixed(0)" >Purchase</li>
        <!--   <li class="btn_clss"  onclick="Purchase(0)">Purchase</li> -->
          <li class="btn_clss"  onclick="watch_list_item_fixed(0)">Watching</li>
        </ul>
      <h5 style="margin-top: 20px;">List Current Bid</h5>
       <li>Sort list by</li>
        <input type="radio" class="radio-inline short_list_buying_fixed" name="radio_buy" value="id" style="display: none;" checked="checked">
        <label><input type="radio" class="radio-inline short_list_buying_fixed" name="radio_buy" value="title"><span class="outside"><span class="inside"></span></span>Title</label>
 
        <label><input type="radio" class="radio-inline short_list_buying_fixed" name="radio_buy" value="status"><span class="outside"><span class="inside"></span></span>Status</label>
        <label><input type="radio" class="radio-inline short_list_buying_fixed" name="radio_buy" 
        value="end_auction"><span class="outside"><span class="inside"></span></span>Time remaining</label> 

      <li>Order By</li>
        <label><input type="radio" class="radio-inline short_list_buying_fixed" name="radio_order" value="ASC"  ><span class="outside"><span class="inside" ></span></span>ASC</label>
        <label><input type="radio" class="radio-inline short_list_buying_fixed" name="radio_order" 
        value="DESC" checked="checked"><span class="outside"><span class="inside"></span></span>DESC</label>
        
        <script>
          // Add active class to the current button (highlight it4)
          var header4 = document.getElementById("menu_buyer_fixed");
          var btns = header4.getElementsByClassName("btn_clss");

          for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
              var current = header4.getElementsByClassName("active_cls");
              console.log(current[0]);
              current[0].className = current[0].className.replace(" active_cls", "");
              this.className += " active_cls";
            });
          }    
        </script>

        <?php    }else{ ?>

        <h5 style="margin-top: 20px;">Selling</h5>
        <ul id="menu_list_fixed">
          <li class="btn_cls active_cls" onclick="selling_all_fixed(0)" >All</li>
          <li class="btn_cls" onclick="selling_schedule_fixed(0)">Schedule</li>
          <li class="btn_cls"  onclick="selling_sold_fixed(0)" >Sold</li>
          <li class="btn_cls" onclick="selling_unsold_fixed(0)" >Expired</li>
        </ul>
        <h5 style="margin-top: 20px;">List Current Bid</h5>
        <li>Sort list by</li>
        <input type="radio" class="radio-inline short_list_fixed_sale" name="radio_bid" value="id" style="display: none;" checked="checked">
        <label><input type="radio" class="radio-inline short_list_fixed_sale" name="radio_bid" value="title"><span class="outside"><span class="inside"></span></span>Title</label>
        <label><input type="radio" class="radio-inline short_list_fixed_sale" name="radio_bid" value="status"><span class="outside"><span class="inside"></span></span>Status</label>
        <label><input type="radio" class="radio-inline short_list_fixed_sale" name="radio_bid" 
        value="end_auction"><span class="outside"><span class="inside"></span></span>Time remaining</label>
        <li>Order By</li>
        <label><input type="radio" class="radio-inline short_list_fixed_sale" name="radio_order" value="ASC" ><span class="outside"><span class="inside" ></span></span>ASC</label>
        <label><input type="radio" class="radio-inline short_list_fixed_sale" name="radio_order" 
        value="DESC" checked="checked"><span class="outside"><span class="inside"></span></span>DESC</label>
      <script>
          // Add active class to the current button (highlight it3)
          var header = document.getElementById("menu_list_fixed");
          var btns = header.getElementsByClassName("btn_cls");

          for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
              var current = header.getElementsByClassName("active_cls");
                 
              current[0].className = current[0].className.replace(" active_cls", "");
              this.className += " active_cls";
            });
          }
      </script>

        <?php    } ?>  
      </ul>  
    </div>  
    <div class="col-md-9 pad-01" id="network_result_fixed">
      <div class="table-section-08" style="margin:20% 30%;">
          <h1>Summary</h1>          
      </div>
    </div>
  </div>
</div>




<!-- fixed containt end -->

</div>
</section>

<script type="text/javascript">

$( document ).ready(function() {
  <?php if ($user_type=='buyer') { ?>
    buying_all(0);
    $('.fixed_containt').hide();
  <?php }else{?>
    $('.fixed_containt').hide();
    selling_all(0);
    selling_all_fixed(0);
  <?php } ?>
});



  function buying_all(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item=   $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
      $('#current_selected_buy').val('all');

    $.ajax({url: "<?php echo base_url("user_action/get_all_buying_list");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }
  
  function watch_list_item(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item = $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
    $('#current_selected_buy').val('watchlist');

    $.ajax({url: "<?php echo base_url("user_action/get_all_watch_list_item");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }


  function buying_Won(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item=   $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
    $('#current_selected_buy').val('won');

    $.ajax({url: "<?php echo base_url("user_action/get_all_buying_won_list");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }
  

  function buying_notwon(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item = $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
    $('#current_selected_buy').val('notwon');

    $.ajax({url: "<?php echo base_url("user_action/get_all_buying_notwon_list");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }
 
 function buying_all_fixed(offset){

    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item=   $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
      $('#current_selected_buy').val('all');

    $.ajax({url: "<?php echo base_url("user_action/get_all_buying_list_fixed");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result_fixed").html(dataObj[0]); 
            }else{
              $("#network_result_fixed").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }

  
  function Purchase(offset){

    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item=   $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
      $('#current_selected_buy').val('all');

    $.ajax({url: "<?php echo base_url("user_action/get_all_buying_list_fixed");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result_fixed").html(dataObj[0]); 
            }else{
              $("#network_result_fixed").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }
   

   function watch_list_item_fixed(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var shortlist_item = $('#shortlist_item_buy').val();
    var order_by=   $('#shortlist_orderby_item_buy').val();
    $('#current_selected_buy').val('watchlist');

    $.ajax({url: "<?php echo base_url("user_action/get_all_watch_list_item_fixed");?>",
        type:'POST', 
        data:{view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result_fixed").html(dataObj[0]); 
            }else{
              $("#network_result_fixed").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }

  function selling_all(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 1;
    var shortlist_item=   $('#shortlist_item').val();
    var order_by=   $('#shortlist_orderby_item').val();

     $('#current_selected').val('all');


    $.ajax({url: "<?php echo base_url("user_action/get_all_selling_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            } 
            $(".loader").hide();
      }
    }); 
  }

  
 function selling_schedule(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 1;
    var shortlist_item=   $('#shortlist_item').val();
    var order_by=   $('#shortlist_orderby_item').val();
    $('#current_selected').val('schedule');

    $.ajax({url: "<?php echo base_url("user_action/get_all_schedule_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            }              
        
          $(".loader").hide();
      }
    }); 
  }

  function selling_sold(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 1;
    var shortlist_item=   $('#shortlist_item').val();
    var order_by=   $('#shortlist_orderby_item').val();
    $('#current_selected').val('sold');

    $.ajax({url: "<?php echo base_url("user_action/get_all_sold_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            }  
          $(".loader").hide();
      }
    }); 
  }
  function selling_unsold(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 1;
    var shortlist_item=   $('#shortlist_item').val();
    var order_by=   $('#shortlist_orderby_item').val();
     $('#current_selected').val('unsold');

    $.ajax({url: "<?php echo base_url("user_action/get_all_unsold_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){  
        
          var dataObj = JSON.parse(result);          
  
            if(view == 'all'){
              $("#network_result").html(dataObj[0]); 
            }else{
              $("#network_result").append(dataObj[0]); 
            }              
         $(".loader").hide();
      }
    }); 
  }

  // fixed section start

  function selling_all_fixed(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 2;
    var shortlist_item=   $('#shortlist_item_fixed').val();
    var order_by=   $('#shortlist_orderby_item_buy_fixed').val();
    $('#current_selected_fixed').val('all');
    $.ajax({url: "<?php echo base_url("message/get_all_fixed_selling_list");?>",
      type:'POST', 
      data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
      success: function(result){        
        var dataObj = JSON.parse(result);  
          if(view == 'all'){
            $("#network_result_fixed").html(dataObj[0]); 
          }else{
            $("#network_result_fixed").append(dataObj[0]); 
          } 
        $(".loader").hide();
      }
    }); 
  }

  function selling_schedule_fixed(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 2;
    var shortlist_item=   $('#shortlist_item_fixed').val();
    var order_by=   $('#shortlist_orderby_item_buy_fixed').val();
    $('#current_selected_fixed').val('schedule');

    $.ajax({url: "<?php echo base_url("message/get_all_fixed_schedule_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result);         
            if(view == 'all'){
              $("#network_result_fixed").html(dataObj[0]); 
            }else{
              $("#network_result_fixed").append(dataObj[0]); 
            } 
          $(".loader").hide();
      }
    }); 
  }

  function selling_sold_fixed(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 2;
    var shortlist_item=   $('#shortlist_item_fixed').val();
    var order_by=   $('#shortlist_orderby_item_buy_fixed').val();
    $('#current_selected_fixed').val('sold');

    $.ajax({url: "<?php echo base_url("message/get_all_fixed_sold_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){        
          var dataObj = JSON.parse(result); 
            if(view == 'all'){
              $("#network_result_fixed").html(dataObj[0]); 
            }else{
              $("#network_result_fixed").append(dataObj[0]); 
            }  
          $(".loader").hide();
      }
    }); 
  }
  function selling_unsold_fixed(offset){
    $(".loader").show();
    var view='all';
    var limit=5;
    var dataType = 2;
    var shortlist_item=   $('#shortlist_item_fixed').val();
    var order_by=   $('#shortlist_orderby_item_buy_fixed').val();
    $('#current_selected_fixed').val('unsold');

    $.ajax({url: "<?php echo base_url("message/get_all_fixed_unsold_list");?>",
        type:'POST', 
        data:{dataType:dataType,view:view,limit:limit,offset:offset,shortlist_item:shortlist_item,order_by:order_by},
        success: function(result){          
          var dataObj = JSON.parse(result);  
            if(view == 'all'){
              $("#network_result_fixed").html(dataObj[0]); 
            }else{
              $("#network_result_fixed").append(dataObj[0]); 
            }              
         $(".loader").hide();
      }
    }); 
  }

  //fixed section end
</script>

<script type="text/javascript">
      function selling_item(value,list_id,slug){   
        $(".loader").show();

        //delete list
        if (value=='Delete') {         
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
              if (willDelete) {
                  $.post("<?php echo base_url("user_action/delete_selling_item"); ?>", {list_id:list_id}, function(result){       
                        if (result=='Success') { swal("list deleted Successfully!", {icon: "success",});
                        }else{ swal("Something went wrong!", {icon: "error",});}
                        location.reload();
                  });
              } else {$('.filter_select').val(''); }
          });
        }

        //show list all bids
        if (value=='user_bids') {         
          var url = "<?php echo base_url();?>user_bid/"+list_id;
          window.open(url,'_blank');
        }

        //edit list
        if (value=='Edit') {         
          var url = "<?php echo base_url();?>sell/"+slug;
          window.open(url,'_blank');
        }

        //relist item  
        if (value=='Relist') {  
            swal({
              text: "Are you sure you want to relist this item.",icon: "warning", buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
              $.ajax({url: "<?php echo base_url("user_action/relist_item");?>",
                  type:'POST', 
                  data:{list_id:list_id},
                  success: function(result){ 
                  if (result=='Success') { swal("Success!", "Relist successfully.", "success");
                    location.reload();
                  }else{swal("Success!", "Something went wrong.", "success"); }
                }
              });    
            }else { $('.filter_select').val('');  }
          });
        }

        if (value=='Sold') {  

            // $.ajax({url: "<?php //echo base_url("user_action/sold_bid");?>",
            //     type:'POST', 
            //     data:{list_id:list_id},
            //     success: function(result){ 
            //     if (result=='Success') {
            //       swal("Success!", "list sold successfully.", "success");
            //     }else{
            //       swal("Success!", "Something went wrong.", "success");
            //     }                                  
            //   }
            // });    
        }

        //show fixed item Sold list
        if (value=='Sold_list') {         
          var url = "<?php echo base_url();?>sold_item_list/"+list_id;
          window.open(url,'_blank');
        }

        $(".loader").hide();
      }


      
      function buying_item(value,list_id,slug,buynow,user_id=""){         
        $(".loader").show();
        if (value=='Delete') {         
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
              if (willDelete) {
                  $.post("<?php echo base_url("user_action/delete_user_bid"); ?>", {list_id:list_id}, function(result){  
                        if (result=='Success') {
                          swal("list deleted Successfully!", {
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
        if (value=='place_a_bid') { 
          window.location.replace("<?php echo base_url();?>list-details/"+slug);
        }
        if (value=='buy_now') { 
          window.location.replace("<?php echo base_url();?>list-details/"+slug+"/"+buynow);
        }
        if (value=='buy_now_for_fixed') { 
          window.location.replace("<?php echo base_url();?>list-details/"+slug);
        }
        if (value=='all_user_bids') {       
          var url = "<?php echo base_url();?>user_all_bid/"+list_id;
          window.open(url,'_blank');
        }  
        if (value=='message') { 
          var url = "<?php echo base_url();?>message/"+user_id;
          window.open(url,'_blank');   
        }


        $(".loader").hide();
      }
  function watch_item(value,list_id,slug,buynow,user_id=""){
    $(".loader").show();
    if (value=='Delete') {         
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
          if (willDelete) {

              $.post("<?php echo base_url("user_action/delete_watchlist_item"); ?>", {watchlist_id:list_id}, function(result){  
                    if (result=='Success') {
                      swal("item removed from watch list successfully!", {
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
    if (value=='buy') { 
      window.location.replace("<?php echo base_url();?>list-details/"+slug);
    }
    if (value=='buy_now') { 
          window.location.replace("<?php echo base_url();?>list-details/"+slug+"/"+buynow);
    }
    if (value=='place_a_bid') { 
      window.location.replace("<?php echo base_url();?>list-details/"+slug);
    }  
    if (value=='all_user_bids') { 
      var url = "<?php echo base_url();?>user_all_bid/"+list_id;
      window.open(url,'_blank');
    } 
    if (value=='message') { 
      var url = "<?php echo base_url();?>message/"+user_id;
      window.open(url,'_blank');
    }
    $(".loader").hide();
  }
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $(".short_list").click(function(){
      $(".loader").show();
      var radio_val=$('input[name=radio_bid]:checked').val();
      var radio_order=$('input[name=radio_order]:checked').val();

      $('#shortlist_item').val(radio_val); 
      $('#shortlist_orderby_item').val(radio_order); 

      $selected_content=$('#current_selected').val();

      if ($selected_content=='all'){
        selling_all(0); 
      }else if($selected_content=='schedule'){
        selling_schedule(0);
      }else if($selected_content=='sold'){
        selling_sold(0);
      }else{
        selling_unsold(0);
      }   
      //$(".loader").hide();
    });
    
    


     $(".short_list_fixed_sale").click(function(){
      $(".loader").show();
      var radio_val=$('input[name=radio_bid]:checked').val();
      var radio_order=$('input[name=radio_order]:checked').val();

      $('#shortlist_item_fixed').val(radio_val); 
      $('#shortlist_orderby_item_buy_fixed').val(radio_order); 

      $selected_content=$('#current_selected').val();

      if ($selected_content=='all'){
        selling_all_fixed(0); 
      }else if($selected_content=='schedule'){
        selling_schedule_fixed(0);
      }else if($selected_content=='sold'){
        selling_sold_fixed(0);
      }else{
        selling_unsold_fixed(0);
      }   
      //$(".loader").hide();
    });

    $(".short_list_buying").click(function(){
      $(".loader").show();
      var radio_val=$('input[name=radio_buy]:checked').val();
      var radio_order=$('input[name=radio_order]:checked').val();

      $('#shortlist_item_buy').val(radio_val); 
      $('#shortlist_orderby_item_buy').val(radio_order); 

      $selected_content=$('#current_selected_buy').val();

      if ($selected_content=='all'){
        buying_all(0); 
      }else if($selected_content=='watchlist'){
        watch_list_item(0);
      }else if($selected_content=='won'){
        buying_Won(0);
      }else{
        buying_notwon(0);
      } 
      //$(".loader").hide();  
    });

    $(".short_list_buying_fixed").click(function(){
      $(".loader").show();
      var radio_val=$('input[name=radio_buy]:checked').val();
      var radio_order=$('input[name=radio_order]:checked').val();

      $('#shortlist_item_buy').val(radio_val); 
      $('#shortlist_orderby_item_buy').val(radio_order); 

      $selected_content=$('#current_selected_buy').val();

      if ($selected_content=='all'){
        buying_all_fixed(0); 
      }else if($selected_content=='watchlist'){
        watch_list_item_fixed(0);
      }else if($selected_content=='won'){
        buying_Won(0);
      }else{
        buying_notwon(0);
      } 
      //$(".loader").hide();  
    });

    $(".auction_tab").click(function(){
      $('.auction_containt').show();
      $('.fixed_containt').hide();
      });

    $(".fixed_tab").click(function(){    
      $('.auction_containt').hide();
      $('.fixed_containt').show();
      selling_all_fixed(0); 
     });


$(".fixed_tab_buyer").click(function(){    
      $('.auction_containt').hide();
      $('.fixed_containt').show();
      buying_all_fixed(0); 
     });

  });

$(".auction_t").click(function(){    
      $(".auction_t").addClass("active");
       $(".fibuy").removeClass("active");
       $(".fibuys").removeClass("active");

     });

$(".fixed_tab_buyer").click(function(){    
      $(".auction_t").removeClass("active");
       $(".fibuy").addClass("active");
       $(".fibuys").removeClass("active");

     });
     

     $(".fixed_tab").click(function(){    
      $(".auction_t").removeClass("active");
       $(".fibuy").removeClass("active");
       $(".fibuys").addClass("active");

     });
</script>