<style type="text/css">

  .media_div{
    padding: 0;
  }
  .media_div img {
    padding: 10px;
    border: 1px solid#ccc;
    margin-bottom: 10px;
    margin-left: 0;
    width: 200px;
    height: 200px;
  }
  .media_div iframe {
    padding: 10px;
    border: 1px solid#ccc;
    margin-bottom: 10px;
    margin-left: 0;
    width: 200px;
    height: 200px;
  }
  .nav_tabs_list>li {
    float: left;
    width: 33%;
    text-align: center;
    background-color: rgba(153, 153, 153, 0.46);
  }
  .nav_tabs_list>li a:hover {
    color:#ffffff;
    background-color: #337ab7;
    text-decoration: underline;
  }
  .nav>li.active a{
    text-decoration: underline;
  }
  .c_details th{
    width:30%;
  }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> User Details
       <!--  <small>Preview</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('userListing'); ?>"><i class="fa fa-users"></i> All Users</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body table-responsive no-padding">
                  <div class="container">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills nav_tabs_list" role="tablist">
                      <li class="nav-item active">
                        <a class="nav-link" data-toggle="pill" href="#basic"><b>Basic</b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#other"><b>More Details</b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#bids"><b>All Bids</b></a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="basic" class="container tab-pane active"><br>
                         <table class="table table-hover c_details">

                          
                          <tr>
                            <th>Name</th>
                            <td><?php echo $user_details[0]['first_name'];?></td>
                          </tr>
                          <tr>
                            <th>Email Id</th>
                            <td><?php echo $user_details[0]['email_id'];?></td>
                          </tr>
                          <tr>
                            <th>Contact No.</th>
                            <td><?php echo $user_details[0]['phone'];?></td>
                          </tr>
                          <tr>
                            <th>Business Phone</th>
                            <td><?php if($user_details[0]['business_phone']!=''){echo $user_details[0]['business_phone'];}else{echo 'Not Available';}?></td>
                          </tr>
                          <tr>
                            <th>Address1</th>
                            <td><?php echo $user_details[0]['address1'];?></td>
                          </tr>
                          <tr>
                            <th>Address2</th>
                            <td><?php if($user_details[0]['address2']!=''){echo $user_details[0]['address2'];}else{echo 'Not Available';}?></td>
                          </tr>
                          <tr>
                            <th>Zip Code</th>
                            <td><?php echo $user_details[0]['zipcode'];?></td>
                          </tr>
                          <tr>
                            <th>City</th>
                            <td><?php echo $user_details[0]['city'];?></td>
                          </tr>
                          <tr>
                            <th>State</th>
                            <td><?php echo $user_details[0]['state'];?></td>
                          </tr>
                          <tr>
                            <th>Country</th>
                            <td><?php echo $user_details[0]['country'];?></td>
                          </tr>
                        <form method="POST" action="<?php echo base_url('listings/bypass_r_fee');?>">
                      <?php if ($user_details[0]['user_type']=='seller') {
                              if ($user_details[0]['is_signing_amount_paid']=='1') {
                                $cls="disabled";
                              }else{
                                $cls="";
                              }
                          ?>
                          <tr>
                            <th>Bypass the Registration Fee </th>
                            <td>
                            <input type="radio" name="bypass_r_fee" class="bypass_r_fee" value="1" <?php if($user_details[0]['fee_bypass_by_admin']=='1'){echo 'Checked';}else{ '';} ?>  <?php echo $cls;?> > Yes
                            <input type="radio" name="bypass_r_fee" class="bypass_r_fee" value="0" <?php if($user_details[0]['fee_bypass_by_admin']=='0'){echo 'Checked';}else{ '';} ?> <?php echo $cls;?> > No
                            </td>
                          </tr>
                             <?php }  ?>
                          <tr>
                            <th>Blocking Status </th>
                            <td>
                              <select name="block_value" id="block_value">
                                <option value="1" <?php if($user_details[0]['is_blocked']==1){echo 'selected';}?>>Block</option>
                                <option value="0" <?php if($user_details[0]['is_blocked']==0){echo 'selected';}?>>Unblock</option>
                              </select>
                              <input type="hidden" name="user_id" value="<?php echo $user_details[0]['id'];?>">
                            </td>
                          </tr>
                          <tr>
                            <th>User Status </th>
                            <td>
                              <select name="user_status" id="user_status">
                                <option value="1" <?php if($user_details[0]['is_active']==1){echo 'selected';}?>>Active</option>
                                <option value="0" <?php if($user_details[0]['is_active']==0){echo 'selected';}?>>In-active</option>
                              </select>
                              <input type="hidden" name="user_id" value="<?php echo $user_details[0]['id'];?>">
                            </td>
                          </tr>
                          <tr>
                            <th></th>
                            <td>  <input type="submit" name="update" value="Update">    </td>
                          </tr>
                        </form>

                       
                        </table>
                      </div>
                      <div id="other" class="container tab-pane fade"><br>
                         <table class="table table-hover c_details">
                          <tr>
                            <th>Company Name</th>
                            <td><?php if($user_details[0]['company_name']!=''){echo $user_details[0]['company_name'];}else{echo 'Not Available';}?></td>
                          </tr>
                          <tr>
                            <th>FFL LGD</th>
                            <td><?php if($user_details[0]['FFL_LGD']!=''){echo $user_details[0]['FFL_LGD'];}else{echo 'Not Available';}?></td>
                          </tr>
                          <tr>
                            <th>Prefered Contact</th>
                            <td><?php if($user_details[0]['prefered_contact']!=''){echo $user_details[0]['prefered_contact'];}else{echo 'Not Available';}?></td>
                          </tr>
                          <tr>
                            <th>Area of Interest</th>
                            <td><?php if($user_details[0]['aoi']!=''){
                          
                                if ($user_details[0]['aoi']=='gun_buds') {
                                  echo "Gun Buds";
                                }elseif ($user_details[0]['aoi']=='pistol') {
                                  echo "Pistol";
                                }else{
                                  echo "Ammunition";
                                }

                              }else{echo 'Not Available';}?></td>
                          </tr>
                          <tr>
                            <th>Credit Card No</th>
                            <td><?php if($user_card_details[0]['cc_no']!=''){
                                $ccNum= $user_card_details[0]['cc_no'];

    echo str_replace(range(0,9), "*", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
                              }else{echo 'NA';}?></td>
                          </tr>
                          <tr>
                            <th>Card Expire </th>
                            <td><?php if($user_card_details[0]['expire_month']!='' && $user_card_details[0]['expire_year']!=''){
                                echo $user_card_details[0]['expire_month']." / 20".$user_card_details[0]['expire_year'];
                              }else{echo 'NA';}?></td>
                          </tr>
                          <tr>
                            <th>CVV</th>
                            <td><?php if($user_card_details[0]['cvv']!=''){
                                echo "****";
                              }else{echo 'NA';}?></td>
                          </tr>
                          <tr>
                            <th>Card Holder Name</th>
                            <td><?php if($user_card_details[0]['card_holder_name']!=''){
                                echo $user_card_details[0]['card_holder_name'];
                              }else{echo 'NA';}?></td>
                          </tr>

                        </table>
                      </div>
                      <div id="bids" class="container tab-pane fade"><br>
                         <div class="col-md-12 col-sm-12">
                          <div class="box-body table-responsive no-padding">
                            <table id="example1" class="display" style="width:100%">
                              <thead>
                                  <tr>
                                    <th>S.NO.</th>
                                    <th>List Name</th>
                                    <th>Bid Amount</th>
                                    <th>Won Status</th>
                                    <th>Sold Status</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                    <th>S.NO.</th>
                                    <th>List Name</th>
                                    <th>Bid Amount</th>
                                    <th>Won Status</th>
                                    <th>Sold Status</th>
                                  </tr>
                              </tfoot>
                              </table>
                            
                          </div><!-- /.box-body -->
                      </div>
                    </div>
                  </div>
  
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var url = $(location).attr('href'),
    parts = url.split("/"),
    user_id = parts[parts.length-1];
    $('#example1').DataTable( {
        "ajax": "<?php echo base_url('listings/kk/');?>"+user_id,
        "columns": [
            { "data": "s_no" },
            { "data": "list_id" },
            { "data": "bid_amount" },
            { "data": "is_won" },
            { "data": "is_sold" }
        ]
    } );

} );
</script>