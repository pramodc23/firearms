<style type="text/css">
  .box-footer a {padding: 10px;}

  .pagination_links>a, .pagination_links>strong{
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
  }


</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> Buyer 
        <?php 
        $buyer_id='';
         if(!empty($user_details[0]['first_name'])){
          echo " - ";
          echo $user_details[0]['first_name'];
             $buyer_id= $user_details[0]['id'];  
          }  ?>
       <!--  <small> Delete</small> -->
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
                 
                
                    <div class="box-tools" style="position:relative;">
                        <form action="<?php echo base_url('view-buyer-listing/'.$buyer_id) ?>" method="POST" id="searchList">
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
                      <!--<th width="5%">
                       <input type="checkbox" onclick="selectall(this);">
                      </th> -->
                      <th width="5%">S.NO.</th>
                      <th width="10%">Item Number</th>
                      <th width="15%">Title</th>                  
                      <th width="10%">User's Highest bid</th> 
                      <th width="10%">List Current Price</th> 
                      <th width="10%">Reserve Price</th>
                      <th width="10%">Total Bid</th>
                      <th width="10%">Bid Status</th>
                      <th width="10%">Item Status</th>  
                      <th width="15%" class="text-center">Actions</th>
                    </tr>
                    <?php
        
                    if(!empty($listrecords))
                    {
                      $i=0;
                        // $record_num = end($this->uri->segment_array());
                        // if (is_numeric($record_num)) {
                        //   $i=$record_num;
                        // }else{                         
                        //   $i=0;
                        // }

                        foreach($listrecords as $record)
                        {
                          $i++;
                    ?>
                    <tr> 
                     <!--  <td>
                      <input type="checkbox" value="<?php //echo $record->id;?>" class="list_idd">
                      </td> -->
                      <td><?php echo $i; ?></td>
                      <td><?php echo "# ".$record->item_number; ?></td>
                      <td><?php echo $record->title; ?></td>                     
                      <td><?php 
                        $max_bid_details=get_max_bid_details($record->id,$buyer_id);
                         if (!empty($max_bid_details)) {
                          echo  $max_bid_details->bid_amount;
                         } ?></td>

                      <td><?php
                      $price_details=get_current_price($record->id);

                          if($price_details){
                            if (!empty($price_details->current_price)) {
                              echo $price_details->current_price;
                            }else{
                            echo "NA";
                            }
                            
                          }?></td> 

                      

                      <td><?php echo $record->reserve_price; ?></td>
                       <td><?php 
                          $bid_detail=get_bid_count($record->id);
                          if($bid_detail){
                            echo $bid_detail->total_bid;
                          }
                        ?></td>
                      <td><?php 

                        if (!empty($max_bid_details)) {
                     
                          if ($max_bid_details->is_won=='1') {
                            echo "WON";
                          }else{
                            echo "DIDN'T WON";
                          }
                        }else{
                            echo "DIDN'T WON";
                          }
                       ?></td>
                      <td><?php 

                      if ($record->status=='sold') {
                          echo "Sold";
                      }else{
                          $todaydate=date("Y-m-d H:i:s");
                         
                          if($todaydate >= $record->end_auction){
                              echo "Expired";
                          }else{
                              echo "In-auction";
                          }
                      }
                     // echo $record->end_auction; ?></td>
                      <td class="text-center">                                  
                     
                          <a class="btn btn-sm btn-info" href="<?php echo base_url('viewuserbid/'.$record->id.'/'.$record->buyerid);?>" data-id="<?php echo $record->id; ?>" title="View"><i class="fa fa-eye"></i></a>                     
                      </td>
                    </tr>
                    <?php } ?>
                  
                    <?php }else{
                      echo "<tr> <td colspan='9' style='text-align:center'>No record found</td></tr>";
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
              <!--   <div class="box-footer clearfix">
                    <?php //echo $this->pagination->create_links(); ?>
                </div> -->
                <div class="box-footer clearfix pagination_links">
                    <?php //echo $this->pagination->create_links(); ?>
                    <?php echo $pagination; ?>
                </div>

              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    //jQuery(document).ready(function(){
     //   jQuery('ul.pagination li a').click(function (e) {
        //    e.preventDefault();            
     //       var link = jQuery(this).get(0).href;            
        //    var value = link.substring(link.lastIndexOf('/') + 1);
            
       //     jQuery("#searchList").attr("action", baseURL + "view-buyer-listing/" + value);
       //     jQuery("#searchList").submit();
      //  });
   // });
</script>
