<style>
.display_err{
    color:red;
}
.disable{
    background: #efe7e7;
}
/* Hide all steps by default: */
.tab {
    display: none;
}
.tabBlock-content {margin: 0px 32px;}
button {
    background-color: #ff6d00;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
}
#regForm {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    width: 100%;
    min-width: 300px;
}

button:hover {
    opacity: 0.8;
}

.add_more_pic{
    background: #ff6d00;
    padding: 7px 20px;
    color: #fff !important;
    font-size: 15px;
    font-family: 'lato';
    margin-left: 4%;
}

#prevBtn {
    background-color: #bbbbbb;
}
.disablebtn{
    pointer-events:none; 
}
/* Make circles that indicate the steps of the form: */
.step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;  
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
}

.step.active {
    opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
    background-color: #4CAF50;
}
.row.new-white-box {
    border: 1px solid #c6c4c4;
    margin-bottom: 5px !important;
}
.content-box {
    padding-top: 40px;
    padding-bottom: 40px;
    font-family: lato;
    text-align: center;
}
.content-box h3 {
    font-weight: 600;
}
.Box-01{
    background: white;
    padding: 15px 30px;
    margin-bottom: 0px;
}
figure.tabBlock.list_deta {
    padding: 15px 30px;
    display: inline-block;
    width: 100%;
}
   /* .tabBlock-content{
        box-shadow: none;
        }*/
        .loader{
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 9999;
            top: 0;
            bottom: 0;
            left:0;
            background-color: rgba(0, 0, 0, 0.6588235294117647);
            display:none;
        }
        .loader_img{
            display: block; 
            margin: 0 auto; 
            width: 100px;   
            margin-top: 20%;
        }

        .iccon{
            color: #fff;    border-radius: inherit;
            background-color: #ff6d00;
            border-color: #ff6d00;
           /* border-radius: 8px 0 0 8px !important;*/
        }
       /* .iccon:hover{
            color: #fff;
            background-color: #ff6d00 !important;
            border-color: #ff6d00 !important;
        }*/
        .row.new-white-box {
            border: 1px solid #c6c4c4;
            margin-bottom: 5px !important;
            margin: 0px 15px;
            margin-top: 25px;
        }

        .image_cross  span{
            position: absolute;
            top: -15px;
            right: -25px;
            border-radius: 30px;
            background: #da2222;
            width: 30px;
            height: 30px;
            color: #fff;
            text-align: center;
            line-height: 30px;
            font-weight: 900;
            margin-bottom: 20px;
        }
        .expand_option>a{    color: #f96d00;text-decoration: none;font-size: 14px;    text-decoration: underline;}

    </style>

    <?php
    $currency_icon = '$';
    if (isset($list_info)) {
        ?>  
        <form action="<?php echo base_url('user_action/update_listing/' . $list_info[0]['id']); ?>" method="post" id="update_listing" enctype="multipart/form-data">
        <?php } else { ?>
            <form action="<?php echo base_url('user_action/add_listing'); ?>" method="post" id="add_listing" enctype="multipart/form-data">
            <?php } ?>

            <div class="container">
                <div class="static_content">
                    <div class="row new-white-box">
                        <div class="col-md-12">
                            <div class="content-box">
                                <h3>Sell a Firearm | Firearms Network</h3>
                                <p>This is our process for Listing and Selling a firearm on our website.  It is fast, simple and legal.</p>
                            </div>
                        </div>
                    </div>
                    <!--lsit an item section -->
                    <fieldset>
                      <div class="loader" >
                        <img src="<?php echo base_url('assets/img/loader.gif'); ?>" class="loader_img">
                      </div>
                    </fieldset>
                </div>
<div> 
    <section class="content_section sign-in tab content_div">
        <div class="container">
            <div class="row">
                          <fieldset>
                            <?php
                            if (isset($list_info) && $list_info[0]['categories'] != '') {
                                ?>
                                <script type="text/javascript">

                                    $(document).ready(function () {
                                        var cat_id = '<?php echo $list_info[0]['categories']; ?>';
                                        var manu_id = '<?php echo $list_info[0]['manufacturer']; ?>';
                                        var base_url = $('#base_url').val();

                                        $.ajax({
                                            method: 'post',
                                            url: base_url + 'home/get_manufacturer',
                                            data: {'cat_id': cat_id}
                                        }).done(function (resp) {

                                            if (resp == 'null') {
                                                    // $('#manufacturer_validate').val(0);
                                                    $(".category_div").hide();
                                                } else {
                                                    // $('#manufacturer_validate').val(1);
                                                    $(".category_div").show();
                                                    var dataObj = JSON.parse(resp);
                                                    $("#manufacturer_list").html('');

                                                    $option = '';

                                                    $option += "<option value=''> Choose Manufacturer</option>";
                                                    for (var i = 0; i < dataObj.length; i++) {

                                                        if (dataObj[i]['id'] == manu_id) {
                                                            var show_select = "selected";
                                                        } else {
                                                            var show_select = "";
                                                        }
                                                        $option += "<option value='" + dataObj[i]['id'] + "' " + show_select + ">" + dataObj[i]['name'] + "</option>";
                                                    }
                                                    $("#manufacturer_list").append($option);
                                                }
                                            });
                                    });
                                </script>

                            <?php } ?>
                            <div class="main-content-tab col-md-12 col-sm-12">


                                <figure class="tabBlock" style="margin-bottom: 0px;">
                                    <div class="tab-content-head describe_head">List an item : Select category</div>
                                    <div class="form-area" style="background: #fff;padding: 15px 30px 15px 30px;">

<!-- category new code start -->
<div class="container_categories col-md-10">
<div class="expand_option">
    <a href="javascript:void(0)" class="collapse_all">Collapse All</a>
    <a href="javascript:void(0)" class="expand_all">Expand All</a>
</div>
<?php
  if (isset($list_info)) {
    $categories_list= $list_info[0]['categories'];
  }else{
    $categories_list='';
  }
?>
<!-- new -->
<div class="col-md-8 span3">

    <div id="left" class="">
        <ul id="menu-group-1" class="nav menu tree">  
            <?php 
            $i=1;
            foreach ($categories as $cate) { ?>
            <li class="item-1 deeper parent">
                <a class="" href="javascript:void(0)">
                    <span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-<?php echo $i;?>" class="sign parentfirst_<?php echo $cate['id']; ?>"><i class="fa fa-plus" aria-hidden="true"></i>
                      <span class="lbl gp_text"><?php echo $cate['name']; ?></span> 
                    </span>
                </a>
                <ul class="children category_expand nav-child unstyled small collapse"  id="sub-item-<?php echo $i;?>">

                    <?php
                    $subcat1 = $this->user_model->select_data('id,name', 'categories', array('parent_id' => $cate['id'], 'status' => 1),'',array('name','ASC'));
                    if(!$subcat1)
                    {
                    ?>
                    <li class="item-9 deeper parent">
                        <a class="" href="javascript:void(0)"> <span class="lbl"><input type="checkbox" data-gptext="<?php echo $cate['name']; ?>" data-ptext="" data-stext="<?php echo $cate['name']; ?>"  class="subcat_cls" id="subcat_cls_<?php echo $cate['id']; ?>" name="category" value="<?php echo $cate['id']; ?>" <?php if($categories_list==$cate['id']){echo "checked";}?>><?php echo $cate['name']; ?></span> 
                        </a>
                        <?php if($categories_list==$cate['id']){ ?>
                               <script type="text/javascript">
                                window.onload = function() {
                                    trigger_selected_field('<?php echo $cate['id']; ?>',''); }      
                               </script>
                            <?php } ?>
                    </li>


                    <?php
                    }
                
                foreach ($subcat1 as $sub1) { $j=1;  ?>
                    
                    <?php
                    $subcat2 = $this->user_model->select_data('id,name', 'categories', array('parent_id' => $sub1['id'], 'status' => 1));

                    if($subcat2){ ?>
                        <li class="item-9 deeper parent third_step">
                            <a class="" href="javascript:void(0)"> 
                                <span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-<?php echo $sub1['id'];?>" class="sign parentsecond_<?php echo $cate['id'];?>_<?php echo $sub1['id'];?> "><i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="lbl p_text"><?php echo $sub1['name']; ?></span></span> 
                            </a>
                            <ul class="children nav-child unstyled small collapse" id="sub-item-<?php echo $sub1['id'];?>">
                            <?php
                            if(!$subcat2)
                            {

                            ?>
                            <li class="item-4">
                                <a class="" href="javascript:void(0)">
                                    <span class="sign"></span>
                                    <span class="lbl">
                                        <input type="checkbox" data-gptext="<?php echo $cate['name']; ?>" data-ptext="<?php echo $sub1['name']; ?>" data-stext="<?php echo $sub1['name']; ?>" class="subcat_cls" id="subcat_cls_<?php echo $sub1['id']; ?>" name="category" value="<?php echo $sub1['id']; ?>" <?php if($categories_list==$sub1['id']){echo "checked";}?>><?php echo $sub1['name']; ?></span> 
                                </a>
                                <?php if($categories_list==$sub1['id']){ ?>
                                   <script type="text/javascript">
                                    window.onload = function() {
                                        trigger_selected_field('<?php echo $cate['id']; ?>','<?php echo $sub1['id']; ?>'); }      
                                   </script>
                                <?php } ?>

                            </li>  
                    <?php 
                                }


                    foreach ($subcat2 as $sub2) { ?>
                            <li class="item-4">
                                <a class="" href="javascript:void(0)">
                                    <span class="sign"></span>
                                    <span class="lbl">
                                        <input type="checkbox" data-gptext="<?php echo $cate['name']; ?>" data-ptext="<?php echo $sub1['name']; ?>" data-stext="<?php echo $sub2['name']; ?>" class="subcat_cls" id="subcat_cls_<?php echo $sub2['id']; ?>" name="category" value="<?php echo $sub2['id']; ?>" <?php if($categories_list==$sub2['id']){echo "checked";}?>><?php echo $sub2['name']; ?></span> 
                                </a>

                                <?php if($categories_list==$sub2['id']){ ?>
                               <script type="text/javascript">
                                window.onload = function() {
                                    trigger_selected_field('<?php echo $cate['id']; ?>','<?php echo $sub1['id']; ?>'); }      
                               </script>
                            <?php } ?>
                            </li>  
                    <?php }  ?>
                            </ul>
                        </li>
                    <?php }else{ ?>
                        <li class="item-9 deeper parent">
                            <a class="" href="javascript:void(0)"> <span class="lbl"><input type="checkbox" data-gptext="<?php echo $cate['name']; ?>" data-ptext="" data-stext="<?php echo $sub1['name']; ?>" class="subcat_cls parentsecond_<?php echo $cate['id'];?>_<?php echo $sub1['id'];?>" id="subcat_cls_<?php echo $sub1['id']; ?>" name="category" value="<?php echo $sub1['id']; ?>" <?php if($categories_list==$sub1['id']){echo "checked";}?>><?php echo $sub1['name']; ?></span> 
                            </a>
                            <?php if($categories_list==$sub1['id']){ ?>
                               <script type="text/javascript">
                                window.onload = function() {
                                    trigger_selected_field('<?php echo $cate['id']; ?>',''); }      
                               </script>
                            <?php } ?>
                        </li>

                    <?php }?>
                    
                 <?php $j++; } ?>               
                </ul>
            </li>  
    <?php $i++; } ?>
        </ul> 
        <span class="display_err" id="manufacturer_valid"></span>         
    </div>

<p class="select_data_value" style="display:none;">You've Selected: <span>All</span>  <span id="parent_text">    </span> <span id="child_text"> </span> <span id="select_text"> </span></p> 
</div>
<input type="hidden" id="manufacturer_validate" value="0">
</div>
<!-- new -->

<!-- Example single danger button -->

<div class="col-sm-12 col-md-10 category_div" style="display:none;">
    <div class="head-details">
        <p>Enter Characteries Specific to your item</p>
    </div>
    <div class="form-area" style="background: #fff;padding: 0px 30px;">
        <label>Manufacturer<span style="color:red;">*</span></label>
        <br>
        <select name="manufacturer_list" class="filter_select characteries_list" style="-webkit-appearance: none;" id="manufacturer_list">
                 
        </select>
        
        <span class="display_err" id="manufacturer_list_valid"></span>
    </div>
    <div class="form-area" style="background: #fff;padding: 0px 30px;">
        <label>Model<span style="color:red;">*</span></label>
        <br>
        <select name="model_list" class="filter_select characteries_list" style="-webkit-appearance: none;" id="model_list">    
            <option value=''> Choose Model</option>    
            <option value='1' <?php if (isset($list_info) && $list_info[0]['model'] == 1) { echo 'selected'; }?>> model1</option>     
            <option value='2' <?php if (isset($list_info) && $list_info[0]['model'] == 2) { echo 'selected'; }?>> model2</option>
            <option value='3' <?php if (isset($list_info) && $list_info[0]['model'] == 3) { echo 'selected'; }?>> model3</option>    
        </select>
        <span class="display_err" id="model_list_valid"></span>
    </div>
    <div class="form-area" style="background: #fff;padding: 0px 30px;">
        <label>Caliber<span style="color:red;">*</span></label>
        <br>
        <select name="caliber_list" class="filter_select characteries_list" style="-webkit-appearance: none;" id="caliber_list">    
            <option value=''> Choose Caliber</option>    
            <option value='6' <?php if (isset($list_info) && $list_info[0]['caliber'] == 6) { echo 'selected'; }?>> 6</option>  
            <option value='9' <?php if (isset($list_info) && $list_info[0]['caliber'] == 9) { echo 'selected'; }?>> 9</option>   
            <option value='12' <?php if (isset($list_info) && $list_info[0]['caliber'] == 12) { echo 'selected'; }?>> 12</option>   
            <option value='30' <?php if (isset($list_info) && $list_info[0]['caliber'] == 30) { echo 'selected'; }?>> 30</option>          
        </select>
        <span class="display_err" id="caliber_list_valid"></span>
    </div>
    <div class="form-area" style="background: #fff;padding: 0px 30px;">
        <label>Barrel Length</label>
        <br>
        <select name="barrel_length_list" class="filter_select characteries_list" style="-webkit-appearance: none;" id="barrel_length_list">    
            <option value=''> Choose Barrel Length</option>    
            <option value='9' <?php if (isset($list_info) && $list_info[0]['barrel_length'] == 9) { echo 'selected'; }?>> 9</option>   
            <option value='10' <?php if (isset($list_info) && $list_info[0]['barrel_length'] == 10) { echo 'selected'; }?>> 10</option>   
            <option value='12' <?php if (isset($list_info) && $list_info[0]['barrel_length'] == 12) { echo 'selected'; }?>> 12</option>   
            <option value='15' <?php if (isset($list_info) && $list_info[0]['barrel_length'] == 15) { echo 'selected'; }?>> 15</option>         
        </select>
    </div>
    <div class="form-area" style="background: #fff;padding: 0px 30px;">
        <label>Capacity</label>
        <br>
        <select name="capacity_list" class="filter_select characteries_list" style="-webkit-appearance: none;" id="capacity_list">    
            <option value=''> Choose Capacity</option> 
            <?php   for ($i=1; $i < 101; $i++) {  ?>   
            <option value='<?php echo $i; ?>' <?php if (isset($list_info) && $list_info[0]['capacity'] == $i) { echo 'selected'; }?>><?php echo $i; ?></option>   
            <?php } ?>      
        </select>             
    </div>
</div>
<!-- new2 -->
<!-- category new code end -->
                                </div>
                            </figure>
                        </div>
                    </fieldset>
                    <!--sign in form section end--> 
                </div>
                <!--sign in form section end--> 
            </div>
        </section>
        <!--full-list-form-start-->
    </div>
    <!--second step all section end-->
    <!--ADD MEDIA SECTION START-->
    <section class="content_section sign-in tab">
        <div class="container"> 
            <!--lsit an item section -->
            <div class="row">
                <div class="tab-content-head describe_head">Listing Detail's</div>
              <!-- auction start -->
             <div class="tabBlock-content">     
                <figure class="tabBlock list_deta">
                <?php 
                    if (isset($list_info)){                 
                        if ($list_info[0]['fixed_price'] == '' || $list_info[0]['fixed_price'] =='0.00'|| $list_info[0]['fixed_price'] =='0') {
                            $auction_value=1;
                            $auction_active_cls="is-active";
                            $fixed_active_cls="";
                            $disablebtna="";
                            $disablebtnf="disablebtn";                            
                        }else{
                            $auction_value=2;
                            $auction_active_cls="";
                            $fixed_active_cls="is-active";
                            $disablebtna="disablebtn";
                            $disablebtnf="";                           
                        }
                 }else{
                    $auction_value=1;
                    $auction_active_cls="is-active";
                    $fixed_active_cls="";                  
                    $disablebtna="";
                    $disablebtnf="";
                 }

                ?>


                  <input type="hidden" id="auction_id" name="auction_id" value="<?php echo $auction_value; ?>">
                  <ul class="tabBlock-tabs">
                    <li class="tabBlock-tab first  <?php echo $disablebtna;?> auctioncls <?php echo 
                    $auction_active_cls;?>"><span>AUCTION</span> 
                    </li>
                    <li class="tabBlock-tab fixedcls second <?php echo $disablebtnf;?> <?php echo $fixed_active_cls;?>"><span>FIXED</span>
                    </li>
                  </ul>
                  <div class="tabBlock-pane list_detail_inner" style="display: block;">
                    <div class="tab-content-inner">
                      <div class="form-area list_detail">
                        <label>Listing Duration: (Determined by seller)<span style="color:red;">*</span></label>
                        <br>
                        <p>The auction should end exactly
                          <select name="duration_days" class="filter_select duration_select" style="-webkit-appearance: none;" id="duration_days">
                            <?php for ($i = 1; $i <= 50; $i++) { ?>
                              <option value="<?php echo $i; ?>" <?php
                              if (isset($list_info) && $list_info[0]['duration_days'] == $i) {
                                echo 'selected';
                              }
                              ?>><?php echo $i; ?></option>
                            <?php } ?>
                            <option value="60" <?php
                            if (isset($list_info) && $list_info[0]['duration_days'] == '60') {
                              echo 'selected';
                            }
                            ?>>60</option>
                            <option value="75" <?php
                            if (isset($list_info) && $list_info[0]['duration_days'] == '75') {
                              echo 'selected';
                            }
                            ?>>75</option>
                            <option value="90" <?php
                            if (isset($list_info) && $list_info[0]['duration_days'] == '90') {
                              echo 'selected';
                            }
                            ?>>90</option>
                          </select>  
                          days after its start date
                          <span class="display_err" id="duration_days_valid"></span>
                        </p>
                      </div>
                      <div class="form-area list_detail input-group">
                        <p><span style="font-weight:bold;float:left;padding-top: 8px;">Starting Bid:</span><span style="color:red;float:left">*</span>
                          <span class="input-group-append" style="float:left;height:37px;margin-left: 34px;">
                            <button style="cursor: none;" class="iccon btn btn-outline-secondary border-right-0 border" type="button">
                              <?php echo $currency_icon; ?>
                            </button>
                          </span>
                          <input name="starting_bid" type="text" id="starting_bid" step="2"  class="return_number  border" <?php
                          if (isset($list_info) && $list_info[0]['starting_bid'] != '') {
                            echo 'value="' . $list_info[0]['starting_bid'] . '"';
                          }
                          ?>>
                        </p>
                      </div>
                      <span class="display_err" id="starting_bid_valid"></span>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;float:left;padding-top: 8px;">Reserve Price:</span>
                          <span class="input-group-append" style="float:left;height:37px;margin-left: 27px;">
                            <button style="cursor: none;" class="iccon btn btn-outline-secondary border-right-0 border" type="button">
                              <?php echo $currency_icon; ?>
                            </button>
                          </span>
                          <input name="reserve_price" type="text" id="reserve_price" class="return_number" <?php
                          if (isset($list_info) && $list_info[0]['reserve_price'] != '') {
                            echo 'value="' . $list_info[0]['reserve_price'] . '"';
                          }
                          ?>>
                          <span class="display_err" id="reserve_price_valid"></span>
                        </p>
                      </div>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;float:left;padding-top: 8px;">Buy Now! price:</span>
                          <span class="input-group-append" style="float:left;height:37px;margin-left: 17px;">
                            <button style="cursor: none;" class="iccon btn btn-outline-secondary border-right-0 border" type="button">
                              <?php echo $currency_icon; ?>
                            </button>
                          </span>
                          <input name="buy_now_price" type="text" id="buy_now_price" class="return_number" <?php
                          if (isset($list_info) && $list_info[0]['buy_now_price'] != '') {
                            echo 'value="' . $list_info[0]['buy_now_price'] . '"';
                          }
                          ?>>
                          <span class="display_err" id="buy_price_valid"></span>
                        </p>
                      </div>
                      <span class="display_err" id="price_compair_valid"></span>


                      <div class="form-area">
                        <label>Relist Options: </label>
                        <br>
                      </div>
                      <div class="form-area ship_form relistoptions">
                        <input name="relist_options" class="relistc" type="radio" value="Auto Relist" <?php
                        if (isset($list_info) && $list_info[0]['relist_options'] == 'Auto Relist') {
                          echo 'checked';
                        } else if (!isset($list_info)) {
                          echo 'checked';
                        }
                        ?>>
                        <label>Auto Relist</label>
                      </div>
                      <div class="form-area ship_form relistoptions">
                        <input name="relist_options" class="relistc" type="radio" value="Relist Until Item Sold" <?php
                        if (isset($list_info) && $list_info[0]['relist_options'] == 'Relist Until Item Sold') {
                          echo 'checked';
                        }
                        ?>>
                        <label>Relist Until Item Sold</label>
                      </div>
                      <div class="form-area ship_form relistoptions">
                        <span style="padding: 5px 0;display: block;">
                          <input name="relist_options" class="relist_cls" type="radio" value="Relist After Sold" <?php
                          if (isset($list_info) && $list_info[0]['relist_options'] == 'Relist After Sold') {
                            echo 'checked';
                          }
                          ?>/>
                          <label>Relist
                            <input style="width: 128px!important;height: 34px!important;margin-top:-6px;" name="relist_time_after_sold" type="text" id="relist_time_after_sold" class="return_number" <?php
                            if (isset($list_info) && $list_info[0]['relist_options'] == 'Relist After Sold') {
                              echo 'value="' . $list_info[0]['relist_time_after_sold'] . '"';
                            }
                            ?> />
                            Times (even if sold) 
                            <span class="display_err" id="relist_time_valid"></span>
                          </label>
                        </span>
                      </div>

                    </div>
                  </div>
                  <div class="tabBlock-pane list_detail_inner" style="display: block;">
                    <div class="tab-content-inner">
                      <p>Fixed Auctions allow the seller to choose how many of the items he or she has.  The listing will automatically relist when an item is sold.</p>
                      <div class="form-area list_detail">
                        <label>Listing Duration: (Determined by seller)<span style="color:red;">*</span></label>
                        <br>
                        <p>The fixed auction should end exactly
                          <select name="duration_days" class="filter_select" style="-webkit-appearance: none;" id="duration_days">
                            <?php for ($i = 1; $i <= 50; $i++) { ?>
                              <option value="<?php echo $i; ?>" <?php
                              if (isset($list_info) && $list_info[0]['duration_days'] == $i) {
                                echo 'selected';
                              }
                              ?>><?php echo $i; ?></option>
                            <?php } ?>
                            <option value="60" <?php
                            if (isset($list_info) && $list_info[0]['duration_days'] == '60') {
                              echo 'selected';
                            }
                            ?>>60</option>
                            <option value="75" <?php
                            if (isset($list_info) && $list_info[0]['duration_days'] == '75') {
                              echo 'selected';
                            }
                            ?>>75</option>
                            <option value="90" <?php
                            if (isset($list_info) && $list_info[0]['duration_days'] == '90') {
                              echo 'selected';
                            }
                            ?>>90</option>
                          </select>  
                          days after its start date
                          <span class="display_err" id="duration_days_valid"></span>
                        </p>
                      </div>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;float:left;padding-top: 8px;">Fixed Price:</span><span style="color:red;float:left">*</span>
                          <span class="input-group-append" style="float:left;height:37px;margin-left: 5px;">
                            <button style="cursor: none;" class="iccon btn btn-outline-secondary border-right-0 border" type="button">
                              <?php echo $currency_icon; ?>
                            </button>
                          </span>
                          <input name="fixed_price" type="text" id="fixed_price" class="return_number" <?php
                          if (isset($list_info) && $list_info[0]['fixed_price'] != '') {
                            echo 'value="' . $list_info[0]['fixed_price'] . '"';
                          }
                          ?>> Per Unit
                          <span class="display_err" id="fixed_price_valid"></span>
                        </p>
                      </div>
                      <div class="form-area list_detail">
                        <p><span style="font-weight:bold;float:left;padding-top: 8px;">Quantity:</span><span style="color:red;float:left">*</span>
                          <span class="input-group-append" style="float:left;height:37px;margin-left: 17px;">

                          </span>
                          <input name="quantity" type="text" id="quantity" class="return_number" <?php
                          if (isset($list_info) && $list_info[0]['quantity'] != '') {
                            echo 'value="' . $list_info[0]['quantity'] . '"';
                          }
                          ?>>
                          <span class="display_err" id="quantity_valid"></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </figure>
            </div>    

              <!-- auction end -->
                <fieldset class="con_fieldset">
                    <div class="tab-content-head describe_head">Listing Description</div>
                    <div class="main-content-tab col-md-12">
                        <figure class="tabBlock" style="margin-bottom: 0px;">
                            <div class="tab-content-inner main-con">
                                <div class="describe_form">
                                    <div class="form-area">
                                        <label>Title<span style="color:red;">*</span>(80 Characters)</label>
                                        <br>
                                        <input placeholder="Title" name="title" id="title" type="text" maxlength="80" <?php
                                        if (isset($list_info) && $list_info[0]['title'] != '') {
                                            echo 'value="' . $list_info[0]['title'] . '"';
                                        }
                                        ?>>
                                        <span class="display_err" id="title_valid"></span>
                                    </div>
                                    <div class="form-area">
                                        <label>Description<span style="color:red;">*</span>
                                            <!--  (html code allowed) -->
                                        </label>
                                        <br>
                                        <textarea placeholder="Description" id="description" name="description" cols="" rows=""><?php
                                        if (isset($list_info) && $list_info[0]['description'] != '') {
                                            echo $list_info[0]['description'];
                                        }
                                        ?></textarea>
                                        <span class="display_err" id="description_valid"></span>
                                    </div>
                                    <div class="form-area">                                     
                                        <label>Additional Terms of Sale</label>
                                        <br>                                   
                                        <select name="terms_of_sale" id="terms_of_sale" class="filter_select" style="-webkit-appearance: none;">
                                            <?php  if(!empty($add_terms_of_sale)){ 
                                                foreach ($add_terms_of_sale as $key => $value) {  ?>
                                            <option value="<?php echo $value['id']; ?>" ><?php echo $value['additional_terms_of_sale']; ?></option>
                                            <?php   }  }else{ ?>
                                            <option value="" >No Standard Text for Additional Terms of Sale Selected</option>
                                            <?php } ?>
                                        </select>                                        
                                        <span class="display_err" id="terms_of_sale_valid"></span>
                                    </div>
                                    <div class="form-area">
                                        <label>Item Condition <span style="color:red;">*</span></label>
                                        <br>
                                        <select name="item_condition" class="filter_select" style="-webkit-appearance: none;">
                                            <option value="new" <?php
                                            if (isset($list_info) && $list_info[0]['item_condition'] == 'new') {
                                                echo 'selected';
                                            }
                                            ?>>New</option>
                                            <option value="old" <?php
                                            if (isset($list_info) && $list_info[0]['item_condition'] == 'old') {
                                                echo 'selected';
                                            }
                                            ?>>New Old Stock</option>
                                            <option value="pre_owned" <?php
                                            if (isset($list_info) && $list_info[0]['item_condition'] == 'pre_owned') {
                                                echo 'selected';
                                            }
                                            ?>>Pre-Owned</option>
                                        </select>
                                    </div>
                                    <div class="form-area">
                                        <label>Item Location</label>
                                        <br>
                                        <input placeholder="(Enter Zip Code Here)" id="item_location" name="item_location" type="text" <?php
                                        if (isset($list_info) && $list_info[0]['item_location'] != '') {
                                            echo 'value="' . $list_info[0]['item_location'] . '"';
                                        }
                                        else
                                        {
                                            echo 'value="'.$userdata->zipcode.'"';

                                        }
                                        ?>>
                                    </div>
                                    <div class="form-area">
                                        <label>Country</label>
                                        <br>
                                        <input placeholder="USA" name="country" id="list_country" type="text" <?php
                                        if (isset($list_info) && $list_info[0]['country'] != '') {
                                            echo 'value="' . $list_info[0]['country'] . '"';
                                        }
                                        else
                                        {
                                            echo 'value="'.$userdata->country.'"';

                                        }
                                        ?>>
                                    </div>
                                    <div class="form-area">
                                        <label>Federal Firearms License (FFL)<span style="color:red;">*</span> (Choose from dropdown)</label>
                                        <br>
                                        <select name="FFL" class="filter_select" style="-webkit-appearance: none;">
                                            <option value="1" <?php
                                            if (isset($list_info) && $list_info[0]['FFL'] == '1') {
                                                echo 'selected';
                                            }
                                            ?>>Yes</option>
                                            <option value="0" <?php
                                            if (isset($list_info) && $list_info[0]['FFL'] == '0') {
                                                echo 'selected';
                                            }
                                            ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="form-area">
                                        <label>Mfg Part Number</label>
                                        <br>
                                        <input placeholder="Mfg Part Number" name="MFG" type="text" <?php
                                        if (isset($list_info) && $list_info[0]['MFG'] != '') {
                                            echo 'value="' . $list_info[0]['MFG'] . '"';
                                        }
                                        ?>>
                                    </div>
                                    <div class="form-area">
                                        <label>Serial Number</label>
                                        <br>
                                        <input placeholder="Serial Number" name="serial_no" type="text" <?php
                                        if (isset($list_info) && $list_info[0]['serial_number'] != '') {
                                            echo 'value="' . $list_info[0]['serial_number'] . '"';
                                        }
                                        ?>>
                                        <span>Not visible on Item Listing.</span>
                                    </div>
                                    <div class="form-area">
                                        <label>SKU</label>
                                        <br>
                                        <input placeholder="SKU" name="SKU" type="text" <?php
                                        if (isset($list_info) && $list_info[0]['SKU'] != '') {
                                            echo 'value="' . $list_info[0]['SKU'] . '"';
                                        }
                                        ?>>
                                    </div>
                                    <div class="form-area">
                                        <label>UPC</label>
                                        <br>
                                        <input placeholder="UPC" name="UPC" type="text" <?php
                                        if (isset($list_info) && $list_info[0]['UPC'] != '') {
                                            echo 'value="' . $list_info[0]['UPC'] . '"';
                                        }
                                        ?>>
                                    </div>
                                    
                                    <div class="form-area">
                                        <label>POST TO USER HOMEPAGE</label>
                                        <br>
                                        <select name="homepage_user" class="filter_select" style="-webkit-appearance: none;">
                                            <option value="1" <?php
                                            if (isset($list_info) && $list_info[0]['homepage_post'] == '1') {
                                                echo 'selected';
                                            }
                                            ?>>Yes</option>
                                            <option value="0" <?php
                                            if (isset($list_info) && $list_info[0]['homepage_post'] == '0') {
                                                echo 'selected';
                                            }
                                            ?>>No</option>
                                        </select>
                                    </div>
                                    <label>Payment Methods: Default Setting </label>
                                    <div class="describe_form shipping_pay_form">
                                        <div class="form-area">
                                            <label>Choose accepted methods of payment:</label>
                                            <br>
                                        </div>   

                                        <div class="form-area ship_form chooseacceptedpayment">                       
                                            <input type="checkbox" name="payment_method[]" value="MasterCard" <?php
                                            if (isset($list_info)) {
                                                $shipping_method = explode(',', $list_info[0]['shipping_method']);
                                                if (in_array('MasterCard', $shipping_method)) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                            <label>MasterCard</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input type="checkbox"  name="payment_method[]" value="Visa" <?php
                                            if (isset($list_info)) {
                                                $shipping_method = explode(',', $list_info[0]['shipping_method']);
                                                if (in_array('Visa', $shipping_method)) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?> >
                                            <label>Visa</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input type="checkbox"  name="payment_method[]" value="Etc" <?php
                                            if (isset($list_info)) {
                                                $shipping_method = explode(',', $list_info[0]['shipping_method']);
                                                if (in_array('Etc', $shipping_method)) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>>
                                            <label>Etc</label>
                                        </div>
                                        <span class="display_err" id="payment_method_valid"></span>


                                        <br>
                                        <div class="form-area">
                                            <label>Classes of shipping: -</label>
                                            <br>
                                        </div>                   

                                        <div class="form-area ship_form">
                                            <input type="checkbox" class="ship_check cos1" name="shipping_class[]" value="Overnight"  <?php
                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('Overnight', $shipping_class)) { echo 'checked'; }
                                            }else{ echo 'checked';}
                                            ?> >
                                            <label>Overnight</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input type="checkbox" class="ship_check cos2" name="shipping_class[]" value="2nd day"  <?php
                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('2nd day', $shipping_class)) {
                                                    echo 'checked';
                                                }
                                            }else{ echo 'checked';}
                                            ?> >
                                            <label>2nd day</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input type="checkbox" class="ship_check cos3" name="shipping_class[]" value="3rd day"  <?php
                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('3rd day', $shipping_class)) {
                                                    echo 'checked';
                                                }
                                            }else{ echo 'checked';}
                                            ?> >
                                            <label>3rd day</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input type="checkbox" class="ship_check cos4" name="shipping_class[]" value="Ground"  <?php
                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('Ground', $shipping_class)) {
                                                    echo 'checked';
                                                }
                                            }else{ echo 'checked';}
                                            ?> >
                                            <label>Ground</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input type="checkbox" class="ship_check cos5" name="shipping_class[]" value="Etc"  <?php
                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('Etc', $shipping_class)) {
                                                    echo 'checked';
                                                }
                                            }else{ echo 'checked';}
                                            ?> >
                                            <label>Etc</label>
                                        </div>
                                        <span class="display_err" id="shipping_class_valid"></span>
                                        <br>
                                        <div class="form-area">
                                            <label>Where You Will Ship?</label>
                                            <br>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input name="shipping_place" type="radio" value="seller_country" <?php
                                            if (isset($list_info) && $list_info[0]['where_you_will_ship'] == 'seller_country') {
                                                echo 'checked';
                                            } else if (!isset($list_info)) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            <label>Seller’s Country Only- Default Setting</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input name="shipping_place" type="radio" value="internationally" <?php
                                            if (isset($list_info) && $list_info[0]['where_you_will_ship'] == 'internationally') {
                                                echo 'checked';
                                            }
                                            ?>>
                                            <label>Internationally</label>
                                        </div>
                                        <div class="form-area">
                                            <label>Who pays for shipping?</label>
                                            <br>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input name="shiping_payer" type="radio" value="1" <?php
                                            if (isset($list_info) && $list_info[0]['pays_for_shipping'] == '1') {
                                                echo 'checked';
                                            } else if (!isset($list_info)) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            <label>Seller Pays For Shipping</label>
                                        </div>
                                        <div class="form-area ship_form">
                                            <input name="shiping_payer" type="radio" value="2" <?php
                                            if (isset($list_info) && $list_info[0]['pays_for_shipping'] == '2') {
                                                echo 'checked';
                                            }
                                            ?>>
                                            <label>Buyer Pays Actual Shipping Cost</label>
                                        </div>

                                        <?php
                                            if (isset($list_info)) {
                                                if ($list_info[0]['pays_for_shipping'] == '3') {
                                                    $buyer_checked='checked';
                                                    $buyer_cls="";
                                                }else{
                                                    $buyer_checked='';
                                                    $buyer_cls="tab";
                                                }
                                            }else{
                                                $buyer_checked='checked';
                                                $buyer_cls="";
                                            }
                                            ?>
                                        <div class="form-area ship_form">
                                            <input name="shiping_payer" type="radio" value="3" <?=$buyer_checked; ?>>
                                            <label>Buyer Pays Fixed Amount:</label>
                                            <?php
                                            $buyer_fixed_amount = array('overnight_fixed' =>'500.00','secondday_fixed' =>'400.00','thirdday_fixed' =>'300.00','ground_fixed' =>'200.00','etc_fixed' =>'100.00');
                                            ?>
                                            <div id="buyer_fixed_section" class="<?=$buyer_cls; ?> ">
                                              <div class="buyerpaysfixedamount">

                                            <?php
                                            if (isset($list_info)) {
                                                $ship_vice = explode(',', $list_info[0]['buyer_pays_amount_shipping_vice']);
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('Overnight', $shipping_class)) {             
                                                    $overnight_amount=array_shift($ship_vice);   
                                                }else{
                                                    $overnight_amount='';      
                                                }
                                            }else{  $overnight_amount=$buyer_fixed_amount['overnight_fixed']; }

                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('2nd day', $shipping_class)) { 
                                                    $secondday_fixed=array_shift($ship_vice);    
                                                }else{
                                                    $secondday_fixed='';      
                                                }   
                                            }else{  $secondday_fixed=$buyer_fixed_amount['secondday_fixed']; }

                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('3rd day', $shipping_class)) { 
                                                    $thirdday_fixed=array_shift($ship_vice);  
                                                }else{
                                                    $thirdday_fixed='';      
                                                }
                                            }else{  $thirdday_fixed=$buyer_fixed_amount['thirdday_fixed']; }

                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('Ground', $shipping_class)) { 
                                                    $ground_fixed=array_shift($ship_vice); 
                                                }else{
                                                    $ground_fixed='';      
                                                }
                                            }else{  $ground_fixed=$buyer_fixed_amount['ground_fixed']; }

                                            if (isset($list_info)) {
                                                $shipping_class = explode(',', $list_info[0]['shipping_class']);
                                                if (in_array('Etc', $shipping_class)) { 
                                                    $etc_fixed=array_shift($ship_vice);   
                                                }else{
                                                    $etc_fixed='';      
                                                }
                                            }else{  $etc_fixed=$buyer_fixed_amount['etc_fixed']; }
                                            ?> 

                                              <div class="buyer-fix-amount"><p> Overnight: </p> <input type="text" name="overnight_fixed" id="overnight_fixed" value="<?php echo $overnight_amount; ?>" ">
                                              </div>
                                                <div class="buyer-fix-amount"><p> 2nd day: </p> 
                                                <input type="text" name="secondday_fixed" id="secondday_fixed" value="<?php echo $secondday_fixed; ?>" > </div>
                                                 <div class="buyer-fix-amount"><p> 3rd day: </p> 
                                                <input type="text" name="thirdday_fixed" id="thirdday_fixed" value="<?php echo $thirdday_fixed; ?>" ></div>
                                                <div class="buyer-fix-amount"><p>  Ground: </p> 
                                                <input type="text" name="ground_fixed" id="ground_fixed" value="<?php echo $ground_fixed; ?>" ></div>
                                                <div class="buyer-fix-amount"><p>  Etc: </p> 
                                                <input type="text" name="etc_fixed" id="etc_fixed" value="<?php echo $etc_fixed; ?>" ></div>
                                            </div>
                                            </div>
                                        </div>
                    


                                        <br>
                                        <div class="form-area">
                                            <label>Inspection Period / Return Policy</label>
                                            <br>
                                            <p>Selecting a return policy is optional. Regardless of any explanation in the auction description to the contrary, you are bound by the return policy/inspection periods for this listing if you decide to select one of the options shown below</p>
                                        <select name="return_policy" id="return_policy" class="filter_select" style="-webkit-appearance: none;">
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 0) { echo 'selected'; }?> value="0">Unspecified</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 1) { echo 'selected'; }?> value="1" >AS IS - No refund or exchange</option>
                                            <option  <?php if (isset($list_info) && $list_info[0]['return_policy'] == 2) { echo 'selected'; }?> value="2">No refund but item can be returned for exchange or store credit within fourteen days</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 3) { echo 'selected'; }?> value="3">No refund but item can be returned for exchange or store credit within thirty days</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 4) { echo 'selected'; }?> value="4">Three Days from the date the item is received</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 5) { echo 'selected'; }?> value="5">Three Days from the date the item is received, including the cost of shipping</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 6) { echo 'selected'; }?> value="6">Five Days from the date the item is received</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 7) { echo 'selected'; }?> value="7">Five Days from the date the item is received, including the cost of shipping</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 8) { echo 'selected'; }?> value="8">Seven Days from the date the item is received</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 9) { echo 'selected'; }?> value="9">Seven Days from the date the item is received, including the cost of shipping</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 10) { echo 'selected'; }?> value="10">Fourteen Days from the date the item is received</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 11) { echo 'selected'; }?> value="11">Fourteen Days from the date the item is received, including the cost of shipping</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 12) { echo 'selected'; }?> value="12">30 day money back guarantee</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 13) { echo 'selected'; }?> value="13">30 day money back guarantee including the cost of shipping</option>
                                            <option <?php if (isset($list_info) && $list_info[0]['return_policy'] == 14) { echo 'selected'; }?> value="14">Factory Warranty</option>
                                        </select>
                                        </div>
                                        <div class="form-area">
                                            <label>Sales Tax</label>
                                            <br>
                                            <p>The seller can choose if he or she has to charge sales tax and how much the rate is for which state.</p>
                                        
                                            <select name="" class="" style="    -webkit-appearance: none;">
                                            <option value="new">Seller must collect sales tax</option>
                                            <option value="old">2</option>
                                            <option value="pre_owned">3</option>
                                        </select>


                                           <p>Select a state and click add to enter the sales tax rate</p>
                                        
                                            <select name="" class="" style="-webkit-appearance: none;">
                                            <option value="new">APO/FPO AE</option>
                                            <option value="old">2</option>
                                            <option value="pre_owned">3</option>
                                        </select>

                                        <a href="#" class="new-add-state-tax">Add<a>
                                        </div>

                                        <div>
                                             <p>Specify the tax rate for each state where you colect taxes.</p>
                                            <div class="tax_rate_div col-md-4">   CO: <input type="text" name="" id="" value=""> % include
                                         </div>
                                             <div class="form-area ship_form col-md-8 form_area_checkbox">
                                            <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Shipping</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Handling</label>
                                            <span>remove</span>
                                            <br>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Insurance</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Misc</label>
                                        </div>

                                         </div>

                                              <div>
                                            <div class="tax_rate_div col-md-4">   FM: <input type="text" name="" id="" value=""> % include
                                         </div>
                                             <div class="form-area ship_form col-md-8 form_area_checkbox">
                                            <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Shipping</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Handling</label>
                                            <span>remove</span>
                                            <br>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Insurance</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Misc</label>
                                        </div>
                                         </div>

                                              <div>
                                            <div class="tax_rate_div col-md-4">   HI: <input type="text" name="" id="" value=""> % include
                                         </div>
                                             <div class="form-area ship_form col-md-8 form_area_checkbox">
                                            <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Shipping</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Handling</label>
                                            <span>remove</span>
                                            <br>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Insurance</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Misc</label>
                                        </div>
                                         </div>

                                              <div>
                                            <div class="tax_rate_div col-md-4">   AE: <input type="text" name="" id="" value=""> % include
                                         </div>
                                             <div class="form-area ship_form col-md-8 form_area_checkbox">
                                            <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Shipping</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Handling</label>
                                            <span>remove</span>
                                            <br>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Insurance</label>
                                             <input type="checkbox" class="" name="" value="Overnight" checked="">
                                            <label>Misc</label>
                                        </div>
                                         </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </div>
                </fieldset>
                <!--sign in form section end-->
            </div>
        </div>
    </section>

    <!--ADD MEDIA SECTION END--> 
    <!--ADD LIST MEDIA SECTION START-->
    <section class="content_section sign-in tab">
        <div class="container">
            <div class="row">
                <fieldset>
                    <div class="tab-content-head describe_head">Listing Image</div>
                    <div class="main-content-tab2 col-md-12">
                        <figure class="tabBlock">
                            <div class="tabBlock-content1">
                                <div class="tab-content-inner main-con" style="padding: 0px;">
                                    <div class="add-media second_part">
                                        <div class="add_media_inner">
                                            <div class="section_head">Upload Pictures:</div>
                                            <div class="section_content">
                                                <div class="img_upload_main">
                                                    <?php if (isset($list_info)) { ?>

                                                        <?php if (!empty($image_info)) { ?>
                                                            <div class="row">
                                                                <?php
                                                                $i = 0;
                                                                foreach ($image_info as $value) {
                                                                    ?>

                                                                    <div class="col-md-3 image_cross" style="border:1px solid #e8e8e8;margin-left:10px;margin-bottom:20px;">
                                                                        <div class="img_row_<?php echo $i; ?>" style="position: relative;">
                                                                            <a onclick="delete_image('<?php echo $value['id']; ?>', '<?php echo $value['url']; ?>', '<?php echo $i; ?>');"><span>X</span></a>

                                                                            <img src="<?php echo base_url('assets/img/listing_photos/thumb/' . $value['url']); ?>" alt="image" style="max-width:100%;">

                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </div>
                                                        <?php } ?>

                                                        <div id="picture_section">
                                                            <div class="img_upload_sec">
                                                                <div class="img_upload_inner">
                                                                    <div class="col-md-2 img_label">Add Picture:</div>
                                                                    <div class="col-md-2 upload_btn">
                                                                        <a onclick="a_photo(this)">Upload</a>
                                                                        <input type="file" class="file_input upd_file" name="a_file[]" style="display:none" onchange="a_readURL(this);" accept=".jpg,.jpeg,.png">
                                                                    </div>
                                                                    <div class="col-md-2 img_thumb"><img style="width:100%; height:100px;" class="a_display_section" src="<?php echo base_url(); ?>assets/img/image_not_found.png" id="display_a_pic1"/><a style="display:none;" onclick="a_cancel_img(this);" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                                                                    <span id="image_not_valid_msg" class="c_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="margin: 4% 0px;">
                                                            <a class="add_more_pic">Add More Picture</a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="img_upload_sec">
                                                            <div class="img_upload_inner">
                                                                <div class="col-md-2 img_label">Primary Picture:</div>
                                                                <div class="col-md-2 upload_btn">
                                                                    <a id="primary_pic">Upload</a>
                                                                    <input type="file" class="file_input" id="file1" name="file1" style="display:none" onchange="readURL(this);" accept=".jpg,.jpeg,.png">
                                                                    <span class="display_err" id="primary_img_valid"></span>
                                                                </div>
                                                                <div class="col-md-2 img_thumb"><img style="width:100%; height:100px;" class="display_section" src="<?php echo base_url(); ?>assets/img/image_not_found.png" id="display_primary"/><a style="display:none;" onclick="cancel_img(this);" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                                                                <span id="image_not_valid_msg" class="c_error"></span>
                                                            </div>
                                                        </div>

                                                        <div class="img_upload_sec">
                                                            <div class="img_upload_inner">
                                                                <div class="col-md-2 img_label">Picture 2:</div>
                                                                <div class="col-md-2 upload_btn">
                                                                    <a id="second_pic">Upload</a>
                                                                    <input type="file" class="file_input" id="file2" name="file2" style="display:none" onchange="readURL(this);" accept=".jpg,.jpeg,.png" />
                                                                    <span class="display_err" id="sec_img_valid"></span>
                                                                </div>
                                                                <div class="col-md-2 img_thumb"><img style="width:100%; height:100px;" class="display_section" src="<?php echo base_url(); ?>assets/img/image_not_found.png" id="display_pic2" /><a style="display:none;" onclick="cancel_img(this);" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                                                            </div>
                                                        </div>

                                                        <div class="img_upload_sec">
                                                            <div class="img_upload_inner">
                                                                <div class="col-md-2 img_label">Picture 3:</div>
                                                                <div class="col-md-2 upload_btn">
                                                                    <a id="third_pic">Upload</a>
                                                                    <input type="file" class="file_input" id="file3" name="file3" style="display:none" onchange="readURL(this);" accept=".jpg,.jpeg,.png" />
                                                                    <span class="display_err" id="third_img_valid"></span>
                                                                </div>
                                                                <div class="col-md-2 img_thumb"><img style="width:100%; height:100px;" class="display_section" src="<?php echo base_url(); ?>assets/img/image_not_found.png" id="display_pic3"/><a style="display:none;" onclick="cancel_img(this);" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a></div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>       
                                            </div>

                                            <div class="video_url_main" style="display: none;">
                                                <p style="color:#444;font-weight:bold;font-family:'lato';">Add Videos by URL</p>
                                                <p style="color:#ff6d00;font-family:'lato';margin-bottom:20px;">If you have one or more video that are hosted on a Web server.</p>
                                                <div class="img_upload_main" >
                                                    <div class="img_upload_sec">
                                                        <div class="img_upload_sec" id="vimeo_video_apend">
                                                            <?php if (isset($list_info)) { ?>
                                                                <div id="video_section">
                                                                    <div class="img_upload_inner">
                                                                        <div class="col-md-2 img_label">Url :</div>
                                                                        <div class="col-md-4 video_input">
                                                                            <input name="a_video_url[]" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />
                                                                        </div>
                                                                        <div class="col-md-2 img_thumb"><a style="display:none" onclick="a_cancel_video(this)" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a><iframe src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="v_url"></iframe></div>
                                                                    </div>
                                                                    <a class="add_more_video">Add More Video</a>
                                                                </div> 
                                                            <?php } else { ?>
                                                                <div class="img_upload_inner row">
                                                                    <div class="col-md-2 img_label">Url 1 :</div>
                                                                    <div class="col-md-4 video_input">
                                                                        <input name="video_url1" id="video_url1" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />
                                                                        <span class="display_err" id="video_url_valid"></span>
                                                                    </div>
                                                                    <div class="col-md-4 img_thumb"><a style="display:none" onclick="cancel_video(this)" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a><iframe src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="v_url"></iframe></div>
                                                                </div>
                                                                <div class="img_upload_inner row">
                                                                    <div class="col-md-2 img_label">Url 2 :</div>
                                                                    <div class="col-md-4 video_input">
                                                                        <input name="video_url2" id="video_url2" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" /> 
                                                                    </div>
                                                                    <div class="col-md-4 img_thumb"><a style="display:none" onclick="cancel_video(this)" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a><iframe src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="v_url"></iframe></div>
                                                                </div>
                                                                <div class="img_upload_inner row">
                                                                    <div class="col-md-2 img_label">Url 3:</div>
                                                                    <div class="col-md-4 video_input">
                                                                        <input name="video_url3" id="video_url3" type="text" class="display_video" onchange="youFunction(this)" onkeyup="youFunction(this)" onpaste="youFunction(this)" oninput="youFunction(this)" />
                                                                    </div>
                                                                    <div class="col-md-4 img_thumb"><a style="display:none" onclick="cancel_video(this)" class="cancel_btn"><img src="<?php echo base_url(); ?>assets/img/cancel_btn.png"/></a><iframe src="https://www.youtube.com/embed/22ljUGis8oE?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="v_url"></iframe></div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </figure>
                    </div>
                </fieldset>
                <!--sign in form section end--> 
            </div>
        </div>
    </section>
</div>
</form>

<!--ADD LIST MEDIA SECTION END--> 
<div class="container">
    <div class="col-md-12 both_btn">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="Prev_button(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="next_button(1)">Next</button>
        </div>
    </div>
    <div style="text-align:center;margin-top:40px;display:none;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</div>
</div>
</div>

<!--ADD LIST PREVIEW MEDIA SECTION END--> 
<!--full-list-form-End--> 
<script>
    $(function () {
        var $sections = $('.form-section');

        function navigateTo(index) {
            // Mark the current section with the class 'current'
            $sections
            .removeClass('current')
            .eq(index)
            .addClass('current');
            // Show only the navigation buttons that make sense for the current section:
            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {
            // Return the current index by looking at which section has the class 'current'
            return $sections.index($sections.filter('.current'));
        }

        // Previous button is easy, just go back
        $('.form-navigation .previous').click(function () {
            navigateTo(curIndex() - 1);
        });

        // Next button goes forward iff current block validates
        $('.form-navigation .next').click(function () {
            $('.demo-form').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function () {
                navigateTo(curIndex() + 1);
            });
        });

        // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
        $sections.each(function (index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        navigateTo(0); // Start at the beginning
    });
</script>
<script type="text/javascript">
    var TabBlock = {
        s: {
            animLen: 200
        },

        init: function () {
            TabBlock.bindUIActions();
            TabBlock.hideInactive();
        },

        bindUIActions: function () {
            $('.tabBlock-tabs').on('click', '.tabBlock-tab', function () {
                TabBlock.switchTab($(this));


            });
        },

        hideInactive: function () {
            var $tabBlocks = $('.tabBlock');

            $tabBlocks.each(function (i) {
                var
                $tabBlock = $($tabBlocks[i]),
                $panes = $tabBlock.find('.tabBlock-pane'),
                $activeTab = $tabBlock.find('.tabBlock-tab.is-active');

                $panes.hide();
                $($panes[$activeTab.index()]).show();
            });
        },

        switchTab: function ($tab) {
            var $context = $tab.closest('.tabBlock');

            if (!$tab.hasClass('is-active')) {
                $tab.siblings().removeClass('is-active');
                $tab.addClass('is-active');

                TabBlock.showPane($tab.index(), $context);
            }
        },

        showPane: function (i, $context) {
            var $panes = $context.find('.tabBlock-pane');

            // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
            $panes.slideUp(TabBlock.s.animLen);
            $($panes[i]).slideDown(TabBlock.s.animLen);
        }
    };

    $(function () {
        TabBlock.init();
    });
    $(document).ready(function () {

//$(".archive_month ul:gt(0)").hide();

$('.archive_month ul').hide();

$('.archive_year > li').click(function () {
    $(this).parent().find('ul').slideToggle();
});

$('.archive_month > li').click(function () {
    $(this).parent().find('ul').slideToggle();
});


});

</script>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the crurrent tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";

        
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {

            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }


    function Prev_button(n) {
        // This function wi ll figure out which tab to display
        var x = document.getElementsByClassName("tab");

        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm())
            return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            //document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function next_button(n) {

        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");

        //alert(auction);
      //console.log(x); 
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm())
            return false;
        // Hide the current tab:
        crntTab = currentTab + n;

        if (crntTab == 1) {

            var step1 = form_first_validation();
            if (step1 == false) {
                return false;
            }
        } else if (crntTab == 2) {

            var step2 = form_second_validation();

            if (step2 == false) {
                return false;
            } else {

                var view = 'all';
                $.ajax({url: "<?php echo base_url("home/request_for_space"); ?>",
                    type: 'POST',
                    data: {view: view},
                    success: function (result) {

                        var dataObj = JSON.parse(result);

                        if (view == 'all') {
                            $("#network_result").html(dataObj[0]);
                        } else {
                            $("#network_result").append(dataObj[0]);
                        }
                        $(".loader").hide();
                    }
                });

            }
        } else if (crntTab == 3) {

            if ($('#file1').length) {
                var step3 = form_third_validation();
                if (step3 == false) {
                    return false;
                } else {
                    $('#add_listing').submit();
                    $('.loader').css('display', 'block');
                }
            } else {
                $(".upd_file").each(function () {
                    if ($(this).val() == '') {
                        $(this).parent().parent().parent().remove();
                    }
                });
                $('#update_listing').submit();
                $('.loader').css('display', 'block');
            }
        }

        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            //document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        // for (i = 0; i < y.length; i++) {
        //   // If a field is empty...
        //   if (y[i].value == "") {
        //     // add an "invalid" class to the field:
        //     y[i].className += " invalid";
        //     // and set the current valid status to false
        //     valid = false;
        //   }
        // }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    $('#relist_time_after_sold').keyup(function () {
        $('.relist_cls').prop('checked', true);
    });

    $('.relistc').click(function () {
        $('#relist_time_after_sold').val('');
    });

</script>
<script type="text/javascript">

    function delete_image(image_id, imagename, count) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({url: "<?php echo base_url("user_action/delete_list_image"); ?>",
                    type: 'POST',
                    data: {image_id: image_id, imagename: imagename},
                    success: function (result) {

                        if (result == 'success') {
                            swal({
                                title: "Good job!",
                                text: "Your image deleted successfully",
                                type: "success"
                            }).then(function () {
                                $('.img_row_' + count).html('');
                            });
                        } else {
                            swal({
                                title: "Sorry",
                                text: "Some thing went wrong!",
                                type: "error"
                            }).then(function () {
                                        //location.reload();
                                    });
                        }
                    }
                });
            } else {
                        // swal("Student is safe!");
                    }
                });



    }

</script>
<script type="text/javascript">

$( document ).ready(function() {  
    $(document).on("click","#left ul.nav li.parent > a > span.sign", function(){
        $(this).find('i:first').toggleClass("fa-minus");      
    });     
    // Open Le current menu  return false;
    $("#left ul.nav li.parent.active > a > span.sign").find('i:first').addClass("fa-minus");
    $("#left ul.nav li.current").parents('ul.children').addClass("in");
    $(document).on("click",".collapse_all", function(){ 
        $('.children').collapse("hide");
    }); 
    $(document).on("click",".expand_all", function(){    
        $('.children').collapse("show"); 
    }); 

    //
    // $( ".parentsecond_9_85" ).trigger( "click" );


});

function trigger_selected_field(parentid='',childid=''){   
    if(parentid){       
        $( ".parentfirst_"+parentid ).trigger( "click" );
    }
    if(childid){
        $(".parentsecond_"+parentid+"_"+childid).trigger( "click" );        
    }  

}


$(".subcat_cls").click(function () {
    var cat_id=$(this).val();
   
    
    var gptext=$(this).data("gptext");
    var ptext=$(this).data("ptext"); 
    var stext=$(this).data("stext"); 


    $('.subcat_cls').not(this).prop('checked', false);  

    if ($(this).is(":checked")) {
       
        if(gptext !=''){
           $('#parent_text').text(" >> "+gptext); 
        }
        if(ptext !=''){
            $('#child_text').text(" >> "+ptext); 
        }else{
            $('#child_text').text("");
        }

        if(stext !=''){
           $('#select_text').text(" >> "+stext); 
        }
        var base_url = $('#base_url').val();

        $.ajax({
                method: 'post',
                url: base_url + 'home/get_manufacturer',
                data: {'cat_id': cat_id}
            }).done(function (resp) {

                if (resp == 'null') {
                    $('#manufacturer_validate').val(0);
                    $(".category_div").hide();
                    $("#manufacturer_list").html('');
                    $("#model_list option[value='']").attr('selected', true);
                    $("#caliber_list option[value='']").attr('selected', true);
                    $("#barrel_length_list option[value='']").attr('selected', true);
                    $("#capacity_list option[value='']").attr('selected', true);

                } else {
                    $('#manufacturer_validate').val(1);
                    $(".category_div").show();
                    var dataObj = JSON.parse(resp);
                     $("#manufacturer_list").html('');
                 
                    $option = '';
                    $option += "<option value=''> Choose Manufacturer</option>";
                    for (var i = 0; i < dataObj.length; i++) {
                        $option += "<option value='" + dataObj[i]['id'] + "'>" + dataObj[i]['name'] + "</option>";
                    }
                    $("#manufacturer_list").append($option);
                }
            });

        $(".select_data_value").show();
    }
    else
    {
        $(".category_div").hide();
        $('#parent_text').text(""); 
        $('#child_text').text("");
        $('#select_text').text("");
        $("#manufacturer_list").html('');
        $(".select_data_value").hide();
    }
});
</script>