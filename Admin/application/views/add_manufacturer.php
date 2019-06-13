<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list-ul"></i> Manufacturers
        <small><?php if(isset($subcat_info)){echo 'Update';}else{echo 'Add';}?>  Manufacturer</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                   <a class="btn btn-primary" href="<?php echo base_url('allmanufacturers'); ?>"><i class="fa fa-list"></i> All Manufacturers</a> 
                </div>
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Manufacturer Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    


                    <form role="form" method="post" action="javascript:void(0)" id="manufacturer">
                        <?php //if(isset($subcat_info)){?>
                        <input type="hidden" value="<?php //echo $subcat_info[0]['id'];?>" name="subcat_id">
                        <?php //} ?>
                        <input type="hidden" id="mange_sub_id" name="mange_sub_id" value="1">
                        <div class="box-body">
                           <div class="row"> 
                                <div class="col-md-12" id="append_subcat">
                                    <div class="form-group">
                                        <label for="parent_cat">Parent Category</label>
                                        <select class="form-control require" id="parent_cat" name="parent_cat">                                           
                                            <?php foreach($categories as $cate){?>
                                            <option value="<?php echo $cate['id'];?>" <?php if(isset($subcat_info) && $subcat_info['0']['parent_id']==$cate['id']){echo 'selected';}?>><?php echo $cate['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div> 

                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="manufacturer_name">Manufacturer Name</label>
                                        <input type="text" class="form-control require" id="manufacturer_name" name="manufacturer_name" 
                                        <?php if(isset($subcat_info)){?>
                                        value="<?php echo $subcat_info[0]['name'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat_status">Status</label><br>
                                        <input type="radio" class="subcat_status" name="subcat_status" value="1" <?php if(isset($subcat_info) && $subcat_info['0']['status']==1){echo 'checked';}else{echo 'checked';}?>> Active
                                        <input type="radio" class="subcat_status"  name="subcat_status" value="0" <?php if(isset($subcat_info) && $subcat_info['0']['status']==0){echo 'checked';}?>> In-Active
                                    </div>
                                </div>
                            </div>    
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <a  onclick="return add_manufacturer('manufacturer')" ><input type="button" class="btn btn-primary" value="Submit" /></a>
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>    
        </div>    
    </section>
</div>

<script type="text/javascript">
    $("#parent_cat").change(function(){
        var parent_cat=$('#parent_cat').val();
        var base_url = $('#base_url').val();
        var mange_sub_id = $('#mange_sub_id').val();
        
        if (mange_sub_id > 1) {                   
             $(".delete_row").html('');
             $('#mange_sub_id').val('1');
        }
         var first_parent ='';

        $.ajax({
            method : 'post',
            url : base_url+'user/get_subcate',
             data : {'parent_cat' : parent_cat , 'base_url' : base_url, 'mange_sub_id' : mange_sub_id,'first_parent' : first_parent}
            }).done(function(resp){              
                var dataObj = JSON.parse(resp); 
         
                if (dataObj[0].length > 0) {
                     $("#append_subcat").append(dataObj[0]); 
                    $('#mange_sub_id').val(2);        
                   // $("#parent_cat").prop("disabled", true);
                }else{
                   
                }
               


            });
        });

    function get_cat_change(manage_id) {
       
        var sub_cat_1=$('#sub_cat_'+manage_id).val();      
        var base_url = $('#base_url').val();
        var mange_sub_id = parseInt($('#mange_sub_id').val());
            
         if (manage_id == 1) { 
                if (mange_sub_id > 2) {                  
                    $(".first_parent").html('');
                    $('#mange_sub_id').val('2'); 
                }            
            var first_parent ='first_parent';
        }

        $.ajax({
            method : 'post',
            url : base_url+'user/get_subcate',
             data : {'parent_cat' : sub_cat_1 , 'base_url' : base_url, 'mange_sub_id' : mange_sub_id,'first_parent' : first_parent}
            }).done(function(resp){              
                var dataObj = JSON.parse(resp); 
                
               // console.log(dataObj[0]);
                //alert(dataObj[0]);
                $("#append_subcat").append(dataObj[0]);
                if(dataObj[0].length > 0){
                    mange_sub_id = mange_sub_id+1;                
                    $('#mange_sub_id').val(mange_sub_id);
                }
                                
                //$("#sub_cat_"+manage_id).prop("disabled", true);      
            });
    }
</script>