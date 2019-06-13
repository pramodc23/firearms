

<style type="text/css">
    .present_right {
        position: relative;
    }
    .present_right span {
        position: absolute;
        right: 0px;
        top: 0;
        width: 30px;
        height: 34px;
        text-align: center;
        display: block;
        padding: 8px 5px;
    }
    .dollar_left {
        position: relative;
    }
    .dollar_left span {
        position: absolute;
        left: : 0px;
        top: 0;
        width: 30px;
        height: 34px;
        text-align: center;
        display: block;
        padding: 8px 5px;
    }
     .dollar_left input {
        padding-left: 40px; 

     }
</style>

<div class="content-wrapper">
    <?php 
        $currency='$';
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-cogs"></i> System Settings
        <!-- <small> List Settings</small> -->
      </h1>
    </section>
   
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" method="post" action="<?php echo base_url('user/list_settings_update');?>" id="list_settings_update">
                        <div class="box-body">
                           <div class="row"> 
                                <div class="col-md-11" style="border: 1px solid #f3ebeb;margin: 9px 30px;background-color: #f1efe9;">
                                    <div class="box-header">
                                        <h3 class="box-title">Discount</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cat_status">Discount percentage</label><br>
                                            <div class="present_right">
                                                <input type="text" class="form-control require return_number" id="discount_percentage" name="discount_percentage" value="<?php echo $list_settings[0]['discount_percentage'];?>">
                                                <span class="input-group-addon">%</span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent_cat">Minimum Commission fee</label>
                                            <div class="dollar_left">
                                                <span class="input-group-addon"><?php echo $currency;?></span>
                                                <input type="text" class="form-control require return_number" id="min_commision_fee" name="min_commision_fee" value="<?php echo $list_settings[0]['min_commision_fee'];?>">
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cat_status">Minimum list required for discount</label><br>
                                            <input type="text" class="form-control require return_number" id="min_list_for_discount" name="min_list_for_discount" value="<?php echo $list_settings[0]['min_list_for_discount'];?>">
                                        </div>
                                    </div> 
                                </div>    

                       <!--      <div class="col-md-11" style="border: 1px solid #f3ebeb;margin:9px 30px;background-color: #f1efe9;">
                                <div class="box-header">
                                    <h3 class="box-title">Login Amount</h3>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">Commission percentage</label>
                                        <div class="present_right">
                                            <input type="text" class="form-control require return_number" id="commision_percentage" name="commision_percentage" value="<?php //echo $list_settings[0]['commision_percentage'];?>">
                                            <span class="input-group-addon">%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat_status">Minimum fee after discount</label><br>
                                        <div class="dollar_left">
                                        <span class="input-group-addon"><?php //echo $currency;?></span>
                                        <input type="text" class="form-control require return_number" id="min_fee_after_discount" name="min_fee_after_discount" value="<?php //echo $list_settings[0]['min_fee_after_discount'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>  -->   

<div class="col-md-11" style="border: 1px solid #f3ebeb;margin:9px 30px;background-color: #f1efe9;">
    <div class="box-header">
        <h3 class="box-title">Commission</h3>
    </div>

    <div class="col-md-12" >
        <div class="col-md-3"><label>From</label></div> 
        <div class="col-md-3"><label>To</label></div>  
        <div class="col-md-2"><label>percent (%)</label></div>  
        <div class="col-md-2"><label>Minimum</label></div>
        <div class="col-md-2"><label>Add more</label></div>
    </div>


    <span id="apend_id">

<?php if(!empty($commission)){ 

 $total_commission= count($commission);
 $total_commission=  $total_commission+1;
    $k=1; ?>
     <input type="hidden" id="check_field_id" value="<?php echo $total_commission;?>"> 
<?php foreach ($commission as  $values) {
    # code...

    ?>
    <div id="append_div_<?php echo $k; ?>" >
        <div class="col-md-3">
            <div class="row" style="margin-right: 15px;">
          <input type="hidden" id="reset_from_<?php echo $k; ?>" value="" />
            <select id="commission_from_id_<?php echo $k;?>" class="form-control multi_commission_from" name="commission_from[]" onchange = "commission_validation_check(<?php echo $k;?>,111);" style="margin-top: 10px;">
                <?php for ($i=1; $i < 1000 ; $i++) { ?>
                    <option value="<?php echo $i;?>" <?php if ($i==$values['commission_from']) {
                       echo "selected"; }?> ><?php echo $i;?></option>
                <?php }  ?>
            </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row" style="margin-right: 15px;">
             <input type="hidden" id="reset_to_<?php echo $k; ?>" value="" />
            <select id="commission_to_id_<?php echo $k;?>" class="form-control multi_commission_to" name="commission_to[]" onchange = "commission_validation_check(<?php echo $k;?>,222);" style="margin-top: 10px;">
                <?php for ($i=1; $i <= 1000 ; $i++) { ?>
                    <option value="<?php echo $i;?>" <?php if ($i==$values['commission_to']) {
                       echo "selected"; }?>><?php echo $i;?></option>
                <?php }  ?>
                <option value="1000+" <?php if ($values['commission_to'] > 1000) {
                       echo "selected"; }?>>1000+</option>
            </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="row" style="margin-right: 15px;">             
            <input type="text" id="commission_per_<?php echo $k;?>" class="form-control" name="commission_per[]" class="multi_commission_percentage" value="<?php echo $values['commission_percent']; ?>" placeholder="%" style="margin-top: 10px;">
             </div>
        </div>

        <div class="col-md-2">
            <div class="row" style="margin-right: 15px;">            
            <input type="text" id="min_commission_<?php echo $k;?>" class="form-control" name="min_commission[]" class="multi_commission_min" value="<?php echo $values['commission_min']; ?>" placeholder="min commission" style="margin-top: 10px;">
            </div>
        </div>
        <div class="col-md-2">
            <?php if ($k==1) { ?>
                <button class="btn btn-success add-new-video" type="button" id="btn1"><i class="fa fa-plus-square"></i> Add More</button> 
            <?php }else{ ?>   
                <button class="btn btn-danger" type="button" onclick="myFunction(<?php echo $k; ?>)" style="margin-top: 10px;">X</button>
            <?php } ?>   
        </div>
    </div>    
<?php $k++; } 
}else{ ?>

        <div class="col-md-3">
            <div class="row" style="margin-right: 15px;">
                <input type="hidden" id="reset_from_1" value="" />
            <select id="commission_from_id_1" class="form-control multi_commission_from" onchange = "commission_validation_check(1,111);" name="commission_from[]">
                <?php for ($i=1; $i < 1000 ; $i++) { ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }  ?>
            </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row" style="margin-right: 15px;">
                <input type="hidden" id="reset_to_1" value="" />
            <select id="commission_to_id_1" onchange = "commission_validation_check(1,222);" class="form-control multi_commission_to" name="commission_to[]">
                <?php for ($i=1; $i <= 1000 ; $i++) { ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }  ?>
                    <option value="1000+">1000+</option>
            </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="row" style="margin-right: 15px;">
            <input type="text" id="commission_per_1" class="form-control multi_commission_percentage" name="commission_per[]" class="" value="" placeholder="%">
             </div>
        </div>

        <div class="col-md-2">
            <div class="row" style="margin-right: 15px;">
            <input type="text" id="min_commission_1" class="form-control" name="min_commission[]" class="multi_commission_min" value="" placeholder="min commission">
            </div>
        </div>
     
        <div class="col-md-2">          
            <div class="row">
            <button class="btn btn-success add-new-video" type="button" id="btn1"><i class="fa fa-plus-square"></i>Add More</button> 
            </div>
        </div>
        <input type="hidden" id="check_field_id" value="2"> 
        <?php } ?>
    </span>
</div>    

 
 
                            <div class="col-md-11" style="border: 1px solid #f3ebeb;margin:9px 30px;background-color: #f1efe9;">
                                <div class="box-header">
                                    <h3 class="box-title">Login Amount</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat_status">Amount to be paid by seller to get login</label><br>
                                        <div class="dollar_left">
                                        <span class="input-group-addon"><?php echo $currency;?></span>
                                        <input type="text" class="form-control require return_number" id="amount_for_seller_login" name="amount_for_seller_login" value="<?php echo $list_settings[0]['amount_for_seller_login'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat_status">Turn off the registration fee</label><br>
                                        <div class="dollar_left">
                                            <input type="radio" name="amount_required" value="1" <?php if ($list_settings[0]['turn_off_registration_fee']=='1') { echo 'Checked';}else{ '';}?>  > Yes     
                                            <input type="radio" name="amount_required" value="0" <?php if ($list_settings[0]['turn_off_registration_fee']=='0') { echo 'Checked';}else{ '';}?> > No  
                                        </div>
                                    </div>
                                </div>
                            </div>
                                  
                            </div>    
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <a class="btn_click" onclick="return check_form('list_settings_update');"><input type="button" class="btn btn-primary" value="Submit" /></a>
                        </div>
                    </form>
                </div>
            </div>    
        </div>    
    </section>
</div>

<script type="text/javascript">
    function myFunction(div_id) {

  $('#append_div_'+div_id).remove();

}
</script>
<script>
$(document).ready(function(){   
    $("#btn1").click(function(){

       


        var total_input_field = $("#check_field_id").val();     

        var increment_check_input_number = parseInt(total_input_field)+parseInt(1);         
        //var decriment_check_input_number = parseInt(total_input_field)-parseInt(1);

        // var lable_field_check = $("#youtube_lable_id_"+decriment_check_input_number).val(); 
        // var file_field_check = $("#youtube_link_id_"+decriment_check_input_number).val();

        // if((lable_field_check =='') || (file_field_check =='')){
            
        //         swal( "Oops" ,  "Please Fill lable and video link first" ,  "error" );
        //         return false;
        //     }else{
        $("#check_field_id").val(increment_check_input_number);

        var commission_from = '<select id="commission_from_id_'+total_input_field+'" name="commission_from[]"  class="form-control multi_commission_from" onchange = "commission_validation_check('+total_input_field+',111);" style="margin-top: 10px;">';
        for (i = 1; i <= 1000; i++) { 
            commission_from += '<option value ='+i+'>'+i+'</option>';
        }
        commission_from +=  '</select>';


        var commission_to= '<select id="commission_to_id_'+total_input_field+'" name="commission_to[]" class="form-control multi_commission_to" onchange = "commission_validation_check('+total_input_field+',222);" style="margin-top: 10px;">';
        for (j = 1; j <= 1000; j++) { 
            commission_to += '<option value ='+j+'>'+j+'</option>';
        }
        commission_to +=  '<option value ="1000+">1000+</option></select>';


    

        $("#apend_id").append('<div id="append_div_'+total_input_field+'" >'+'<div class="col-md-3">'+'<div class="row" style="margin-right: 15px;">'+commission_from+'</div>'+'</div>'+'<div class="col-md-3">'+'<div class="row" style="margin-right: 15px;">'+commission_to+'</div>'+'</div>'+'<div class="col-md-2">'+'<div class="row" style="margin-right: 15px;">'+'<input type="text" id="commission_per_'+total_input_field+'"  class="form-control" name="commission_per[]" placeholder="%" style="margin-top: 10px;">'+'</div>'+'</div>'+'<div class="col-md-2">'+'<div class="row" style="margin-right: 15px;">'+'<input type="text" id="min_commission_'+total_input_field+'"  class="form-control" name="min_commission[]" placeholder="min commission" style="margin-top: 10px;">'+'</div>'+'</div>'+'<div class="col-md-2"><button class="btn btn-danger" type="button" onclick="myFunction('+total_input_field+')" style="margin-top: 10px;">X</button>'+'</div>'+'</div>');  

            //}          
    });
});


function commission_validation_check(check_id,is_value) {

    // New code start
    // alert("check_id "+check_id);
    // alert("is_value "+is_value);
    var from_day_check=parseInt(jQuery("#commission_from_id_"+check_id).val());
    var to_day_check=parseInt(jQuery("#commission_to_id_"+check_id).val());
    var check_max_no=parseInt(jQuery("#check_field_id").val());

  if(check_id >1)
  { 
      
        if(from_day_check > to_day_check)
        { 
          if(is_value=='111'){

            var reset_from_check=  parseInt(jQuery("#reset_from_"+check_id).val());
            //alert("reset_from_check "+reset_from_check);
            if (reset_from_check !='') {
              document.getElementById("commission_from_id_"+check_id).selectedIndex=reset_from_check
            }else{
              document.getElementById("commission_from_id_"+check_id).selectedIndex=0;
            }  
          }else{  
            var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
            if (reset_to_check !='') {
              document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
            }else{
              document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
            }
          }
            return false;         
        }
        var pre_check=check_id - 1;
        var is_all_okk = 1;
        var is_all_ok = 1;
        var count_each_val = 0;
        var total_length = $("#apend_id  select").length;

      $("#apend_id  select").each(function() { 

            var id_last_no = this.id.match(/\d+/)[0];
              var from_day_check_previous=parseInt(jQuery("#commission_from_id_"+id_last_no).val());
              var to_day_check_previous=parseInt(jQuery("#commission_to_id_"+id_last_no).val());
              count_each_val++;
             //alert("form => "+from_day_check_previous+"  to => "+ to_day_check_previous+" last No =>"+ id_last_no+" check_id => "+ check_id+" is_value => "+ is_value); 

            if(is_value=='111'){ 
              
                if(((from_day_check < from_day_check_previous) && (to_day_check > from_day_check_previous)) || ((from_day_check < to_day_check_previous) && (to_day_check > to_day_check_previous)) )
                      {                 
                          is_all_ok = 0;
                        var reset_to_check=parseInt(jQuery("#reset_from_"+check_id).val());
                       
                        if (reset_to_check !='') {
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=0;
                         }
                         return false;
                      }
                if(id_last_no != check_id){
                    if ((from_day_check >= from_day_check_previous )&& (from_day_check <= to_day_check_previous)) {
                               
                        is_all_ok = 0;
                        var reset_to_check=parseInt(jQuery("#reset_from_"+check_id).val());
                        if (reset_to_check !='') {
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=0;
                         }
                         return false;
                        }
                        if((from_day_check == from_day_check_previous) && (isNaN(to_day_check_previous))){
                            is_all_ok = 0;
                        var reset_to_check=parseInt(jQuery("#reset_from_"+check_id).val());
                       
                        if (reset_to_check !='') {
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=0;
                         }
                         return false;
                       }
                    }
                
                     if(is_all_ok == 1 && count_each_val == total_length){
                      
                        document.getElementById("reset_from_"+check_id).value=from_day_check;
                        //document.getElementById("reset_to_"+check_id).value=to_day_check;
                    }
            }
            if(is_value=='222'){ 
            if(!isNaN(from_day_check)){

                if(((from_day_check < from_day_check_previous) && (to_day_check > from_day_check_previous)) || ((from_day_check < to_day_check_previous) && (to_day_check > to_day_check_previous)))
                  {

                     is_all_okk = 0;
                    var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
                    if (reset_to_check !='') {
                    document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
                    }else{
                    document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
                    }
                     return false;
                  }

                  if(id_last_no != check_id){
                    if ((to_day_check >= from_day_check_previous )&& (to_day_check <= to_day_check_previous)) {
                           
                    is_all_okk = 0;
                    var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
                    if (reset_to_check !='') {
                    document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
                    }else{
                    document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
                    }
                     return false;
                    }
                  if((to_day_check == from_day_check_previous) && (isNaN(to_day_check_previous))){
                      // alert("not a number");
                      is_all_okk = 0;
                    var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
                    if (reset_to_check !='') {
                    document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
                    }else{
                    document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
                    }
                     return false;
                    }

                  }
                  if(is_all_okk == 1 && count_each_val == total_length){
                    //document.getElementById("reset_from_"+check_id).value=from_day_check;
                    document.getElementById("reset_to_"+check_id).value=to_day_check;
                  }
              }else{
                 document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
              }    
           }
        });

  }
  else{
        if(from_day_check > to_day_check)
        {
          if(is_value=='111'){
            var reset_to_check=parseInt(jQuery("#reset_from_"+check_id).val());
             /* if (reset_to_check !='') {
              document.getElementById("cancellation_from_select_"+own_id).selectedIndex=reset_to_check;
              }else{
              document.getElementById("cancellation_from_select_"+own_id).selectedIndex=0;
              }*/
              //alert("cancellation_to_select_"+own_id);
              document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
          }else if(is_value=='222'){
           
            var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
              if (reset_to_check !='') {
              document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
              }else{
              document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
              }
          }else{
          }      
        }

        var pre_check=check_id - 1;
        var is_all_okk = 1;
        var is_all_ok = 1;

        var count_each_val1 = 0;
        var total_length1 = $("#apend_id  select").length;

        $("#apend_id  select").each(function() { 
            // alert(this.value);   

              var id_last_no = this.id.match(/\d+/)[0];
              var from_day_check_previous=parseInt(jQuery("#commission_from_id_"+id_last_no).val());
              var to_day_check_previous=parseInt(jQuery("#commission_from_id_"+id_last_no).val());
              count_each_val1++;
            // alert("form => "+from_day_check_previous+"  to => "+ to_day_check_previous+" last No =>"+ id_last_no+" ownid => "+ own_id); 

            if(is_value=='111'){ 
              
                if(((from_day_check < from_day_check_previous) && (to_day_check > from_day_check_previous)) || ((from_day_check < to_day_check_previous) && (to_day_check > to_day_check_previous)) )
                      {       
                               
                          is_all_ok = 0;
                        var reset_to_check=parseInt(jQuery("#reset_from_"+check_id).val());
                       
                        if (reset_to_check !='') {
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=0;
                         }
                         return false;
                      }
                if(id_last_no != check_id){
                        if ((from_day_check >= from_day_check_previous )&& (from_day_check <= to_day_check_previous)) {
                              
                        is_all_ok = 0;
                        var reset_to_check=parseInt(jQuery("#reset_from_"+check_id).val());
                        if (reset_to_check !='') {
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_from_id_"+check_id).selectedIndex=0;
                         }
                         return false;
                        }
                    }
                
                    if(is_all_ok == 1 && count_each_val1 == total_length1){
                      
                        document.getElementById("reset_from_"+check_id).value=from_day_check;
                        //document.getElementById("reset_to_"+check_id).value=to_day_check;
                    }
            }
            if(is_value=='222'){ 

                    if(((from_day_check < from_day_check_previous) && (to_day_check > from_day_check_previous)) || ((from_day_check < to_day_check_previous) && (to_day_check > to_day_check_previous)))
                    {

                        is_all_okk = 0;
                        var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
                        if (reset_to_check !='') {
                        document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
                        }
                         return false;
                    }

                    if(id_last_no != check_id){
                        if ((to_day_check >= from_day_check_previous )&& (to_day_check <= to_day_check_previous)) {
                               
                        is_all_okk = 0;
                        var reset_to_check=parseInt(jQuery("#reset_to_"+check_id).val());
                        if (reset_to_check !='') {
                        document.getElementById("commission_to_id_"+check_id).selectedIndex=reset_to_check;
                        }else{
                        document.getElementById("commission_to_id_"+check_id).selectedIndex=0;
                        }
                         return false;
                        }
                    }
                      // alert(to_day_check+" >= "+ from_day_check_previous+" && "+ to_day_check+" <= "+ to_day_check_previous);
                      if(is_all_okk == 1 && count_each_val1 == total_length1){
                        //document.getElementById("reset_from_"+check_id).value=from_day_check;
                        document.getElementById("reset_to_"+check_id).value=to_day_check;
                      }         
               }
        }); 
    }

    }
</script>
