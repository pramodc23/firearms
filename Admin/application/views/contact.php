<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-phone"></i> Contacts 
        <!-- <small>Add, Edit, Delete</small> -->
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Contacts</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url('allcontacts');?>" method="POST" id="searchList">
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
                      <th>Selectbasic</th>
                      <th>Email </th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Userfile</th>

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
                      <td><?php echo $record->selectbasic;?></td>
                      <td><?php echo $record->email;?></td>
                      <td><?php echo $record->subject;?></td>
                      <td><?php echo $record->message;?></td>
                      <td><?php echo $record->userfile;?></td>
                      
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'viewContact/'.$record->id; ?>" title="View"><i class="fa fa-eye"></i></a>
                          
                          <a class="btn btn-sm btn-danger" href="#" onclick="deleteCategory(this)" title="Delete"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "allcontacts/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
