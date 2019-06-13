<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list-ul"></i> Manufacturers
        <small></small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('addmanufacturer'); ?>"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Manufacturers</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url('allmanufacturers');?>" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>S.NO.</th>
                      <th>Manufacturer Name</th>
                      <th>Category Name</th>
                      <th>Parent Category Name</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                   
                    if(!empty($userRecords))
                    {
                      $record_num = end($this->uri->segment_array());
                        if (is_numeric($record_num)) {
                          $i=$record_num;
                        }else{                         
                          $i=0;
                        }

                        foreach($userRecords as $record)
                        {
                          $i++;
                    ?>
                    <tr id="<?php echo $record->id;?>">
                      <td><?php echo $i; ?></td>
                      <td><?php echo $record->manufacturer ?></td>
                      <td><?php echo $record->category_name ?></td>
                      <td><?php
                      if($record->parent_id!=0){ 
                      $p_cat_name = $this->list_model->select_data('name','categories',array('id'=>$record->parent_id));
                      echo $p_cat_name[0]['name']; 
                      }else{
                        echo 'None';
                      }
                      ?></td>
                      <td><?php if($record->status==1){echo 'Active';}else{echo 'In-Active'; }?></td>
                      <td class="text-center">
                         
                          <!-- <a class="btn btn-sm btn-info" href="<?php //echo base_url().'Categories/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a> -->
                          <a class="btn btn-sm btn-danger" href="#" onclick="deleteManufacturer(this)" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }else{

                      echo "<tr> <td>No record found</td></tr>";
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "allmanufacturers/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
