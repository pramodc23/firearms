<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list-ul"></i> Categories
        <small><?php if(isset($subcat_info)){echo 'Edit';}else{echo 'Add';}?>   Category</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('manageCategories'); ?>"><i class="fa fa-list"></i> All Categories</a>
                </div>
            </div> 
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Category Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" method="post" id="m_category">
                        <?php if(isset($subcat_info)){?>
                        <input type="hidden" value="<?php echo $subcat_info[0]['id'];?>" name="subcat_id">
                        <?php } ?>
                        <div class="box-body">
                           <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">Category Name</label>
                                        <input type="text" class="form-control require" id="subcat_name" name="subcat_name" 
                                        <?php if(isset($subcat_info)){?>
                                        value="<?php echo $subcat_info[0]['name'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent_cat">Parent Category</label>
                                        <select class="form-control require" id="parent_cat" name="parent_cat">
                                            <option value="0" <?php if(isset($subcat_info) && $subcat_info['0']['parent_id']==0){echo 'selected';}?>>None</option>
                                            <?php foreach($categories as $cate){?>
                                            <option value="<?php echo $cate['id'];?>" <?php if(isset($subcat_info) && $subcat_info['0']['parent_id']==$cate['id']){echo 'selected';}?>><?php echo $cate['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat_status">Status</label><br>
                                        <input type="radio" name="subcat_status" value="1" <?php if(isset($subcat_info) && $subcat_info['0']['status']==1){echo 'checked';}else{echo 'checked';}?>> Active
                                        <input type="radio" name="subcat_status" value="0" <?php if(isset($subcat_info) && $subcat_info['0']['status']==0){echo 'checked';}?>> In-Active
                                    </div>
                                </div>
                            </div>    
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <a <?php if(isset($subcat_info)){?> onclick="return edit_categories('m_category');"<?php }else{ ?> onclick="return categories('m_category')" <?php } ?>><input type="button" class="btn btn-primary" value="Submit" /></a>
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>    
        </div>    
    </section>
</div>