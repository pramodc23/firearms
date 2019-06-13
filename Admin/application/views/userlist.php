<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> User List Management
        <!-- <small>View, Delete, Relist</small> -->
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
                    <h3 class="box-title">All List </h3>

                    <select style="margin-left: 10px;padding: 3px;" onchange="window.location.href='<?php echo base_url(); ?>listings/allListings/'+this.value;">
                      <option value="all" <?php if($type_search == 'all') echo "selected"; ?> >All Listings</option>
                      <option value="sold" <?php if($type_search == 'sold') echo "selected"; ?>>Sold Listings</option>
                      <option value="in_auction" <?php if($type_search == 'in_auction') echo "selected"; ?>>In Auction Listings</option>
                      <option value="expired" <?php if($type_search == 'expired') echo "selected"; ?>>Expired Listings</option>
                      <option value="reserve_met" <?php if($type_search == 'reserve_met') echo "selected"; ?>>Reserve Met</option>
                      <option value="reserve_not_met" <?php if($type_search == 'reserve_not_met') echo "selected"; ?>>Reserve Not Met</option>
                    </select>

                    <div class="box-tools" style="position:relative;">
                        <form action="<?php echo base_url('userallListings') ?>" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
  
                <div class="box-body table-responsive no-padding" id="checkboxes">
                  <table class="table table-hover">
                    <tr>
                      <th width="5%"><input type="checkbox" onclick="selectall(this);"></th>
                      <th width="5%">S.NO.</th>
                      <th width="10%">Item Number</th>
                      <th width="15%">Title</th>
                      <th width="10%">Item Condition</th>
                      <th width="10%">Item Location</th>
                    <!--   <th width="10%">Shipping Method</th>   -->
                      <th width="10%">Starting Bid</th>  
                      <th width="10%">Reserve Price</th>
                      <th width="10%">Buy Now Price</th>  
                      <th width="15%" class="text-center">Actions</th>
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
                      <td><input type="checkbox" value="<?php echo $record->id;?>" class="list_idd"></td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo "# ".$record->item_number; ?></td>
                      <td><?php echo $record->title; ?></td>
                      <td><?php   if ($record->item_condition=='new') {
                        echo "New";
                      }elseif ($record->item_condition=='pre_owned') {
                        echo "Pre Owned";
                      }else{
                        echo "Old";
                      } ?></td>
                      <td><?php echo $record->item_location; ?></td>
                    <!--   <td><?php //echo $record->shipping_method; ?></td> -->
                      <td><?php echo $record->starting_bid; ?></td>
                      <td><?php echo $record->reserve_price; ?></td>
                      <td><?php echo $record->buy_now_price; ?></td>
                      <td class="text-center">
                         
                          <!--<a class="btn btn-sm btn-info" href="<?php //echo base_url().'editOld/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>-->
                         
                          <!-- <a class="btn btn-sm btn-info" href="<?php// echo base_url('viewListings/'.$record->id);?>" data-id="<?php //echo $record->id; ?>" title="View"><i class="fa fa-eye"></i></a>
                          <a class="btn btn-sm btn-danger deleteList" href="#" data-id="<?php //echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                          <a class="btn btn-sm btn-primary reList" href="#" data-id="<?php //echo $record->id; ?>" title="Relist"><i class="fa fa-list"></i></a> -->
                      </td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td>
                        <button class="btn btn-primary" onclick="delete_lists()">Delete</button>
                      </td>
                      <td>
                        <button class="btn btn-primary" onclick="relist_lists()">Relist</button>
                      </td>
                    </tr>
                    <?php }else{
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
            jQuery("#searchList").attr("action", baseURL + "userallListings/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
