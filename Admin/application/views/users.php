<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Users
        <!-- <small>View, Delete, Status</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!--<a class="btn btn-primary" href="<?php //echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users List</h3>
                    <button type="button" class="btn btn-primary" id="export_in_csv" style="border: none; height: 34px;">Export in CSV</button> 
                    <button type="button" class="btn btn-primary" id="export_in_xls" style="border: none; height: 34px;">Export in excel</button> 
                    <div class="box-tools">
                             
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
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
                      <th>Name</th>
                      <th>Type</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Prefered Contact</th>
                      <th>Bids count</th>
                      <th>Lists count</th>
                      <th>Blocking Status</th>
                      <th class="text-center" width="18%">Actions</th>
                    </tr>
                    <?php
                    //$i=0;
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
                      <td><?php echo $record->first_name; ?></td>
                       <td><?php echo ucfirst($record->user_type); ?></td>
                      <td><?php echo $record->email_id; ?></td>
                      <td><?php echo $record->phone; ?></td>
                      <td><?php echo $record->prefered_contact; ?></td>
                      <td><a href="<?php  echo base_url().'User/user_bids/'.$record->id; ?>"><?php echo $record->bids_count; ?></a>
                      </td>
                      <td><a href="<?php  echo base_url().'User/userListings/'.$record->id; ?>"><?php echo $record->list_count;?></a>
                      </td>
                      <td>
                        <select onchange="block_status(this);" id="block_value">
                          <option value="1" <?php if($record->is_blocked==1){echo 'selected';}?>>Block</option>
                          <option value="0" <?php if($record->is_blocked==0){echo 'selected';}?>>Unblock</option>
                        </select>
                      </td>
                      <td class="text-center">                                       

                        <?php if ($record->user_type=='seller') { ?> 
                          <a  href="<?php echo base_url('userallListings/all/'.$record->id); ?>"  title="View List"><button class="btn btn-primary">View List</button></a>
                        <?php }else{ ?>
                          <a  href="<?php echo base_url('listings/view_buyer_listing/all/'.$record->id); ?>"  title="View Bid"><button class="btn btn-primary">View Bid</button></a>     
                        <?php } ?>




                        <?php if ($record->user_type=='seller') { ?> 

                       <a class="btn btn-sm btn-primary" href="<?php echo base_url('userallListings/sold/'.$record->id); ?>" title="Calculation" > <i class="fa fa-calculator" aria-hidden="true"></i> </a> 

                       <?php } ?>    

                        <a class="btn btn-sm btn-info" href="<?php echo base_url('viewUser/'.$record->id);?>" title="View"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

<script type="text/javascript">
    $('#export_in_csv').on('click',(function(e) {         
        var base_url = $('#base_url').val();  
        window.location.href = base_url+"User/user_export_in_csv";          
    }));
    $('#export_in_xls').on('click',(function(e) {         
        var base_url = $('#base_url').val();  
        window.location.href = base_url+"User/user_export_in_excel";          
    }));
</script>
