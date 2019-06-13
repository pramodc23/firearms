<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-hand-o-up"></i> Bids
        <!-- <small>Delete</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!--<a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Bids</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>allBids" method="POST" id="searchList">
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
                      <th width="2%"><input type="checkbox" onclick="selectallbid(this);"></th>
                      <th>S.NO.</th>
                      <th>List Title</th>
                      <th>Bidder name</th>
                      <th>Price</th>
                      <th>Is Won</th>
                      <th>Bid on</th>  
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
                    <tr>
                      <td><input type="checkbox" value="<?php echo $record->id;?>" class="bid_id"></td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo '<a href="'.base_url('viewListings/'.$record->list_id).'">'.$record->title.'</a>' ?></td>
                      <td><?php echo '<a href="'.base_url('viewUser/'.$record->u_id).'">'.$record->first_name.'</a>' ?></td>
                      <td><?php echo $record->bid_amount ?></td>
                      <td><?php if($record->is_won==1){echo 'Yes';}else{echo "No";} ?></td>
                      <td><?php echo $record->created_on ?></td>
                      <td class="text-center">
                         
                          <!--<a class="btn btn-sm btn-info" href="<?php //echo base_url().'editOld/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>-->
                          <a class="btn btn-sm btn-danger deleteBid" href="#" data-id="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        } ?>
                    <tr>
                      <td>
                        <button class="btn btn-primary" onclick="delete_all_bids()">Delete</button>
                      </td>                      
                    </tr>


                    <?php }else{

                      echo "<tr> <td  colspan='9' style='text-align:center;'>No record found</td></tr>";
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
            jQuery("#searchList").attr("action", baseURL + "allBids/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
