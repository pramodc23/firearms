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
    width: 24%;
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

<?php 
  $currency='$';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> Bid Details
      <!--   <small>Preview</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                   <!--  <a class="btn btn-primary" href="<?php //echo base_url('allListings'); ?>"><i class="fa fa-list"></i> All Listings</a> -->
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
                        <a class="nav-link" data-toggle="pill" href="#menu4"><b>Bids</b></a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="menu4" class="container tab-pane active"><br>
                        <div class="col-md-12 col-sm-12">
                          <div class="box-body table-responsive no-padding">
                            <table id="example" class="display" style="width:100%">
                              <thead>
                                  <tr>
                                    <th>S.NO.</th>
                                    <th>Bidder Name</th>
                                    <th>Bid Amount</th>
                                    <th>Won Status</th>
                                    <th>Sold Status</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                    <th>S.NO.</th>
                                    <th>Bidder Name</th>
                                    <th>Bid Amount</th>
                                    <th>Won Status</th>
                                    <th>Sold Status</th>
                                     <th>Action</th>
                                  </tr>
                              </tfoot>
                              </table>
                          </div><!-- /.box-body -->
                        </div>
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
    last_part = parts[parts.length-2];

    //alert(last_part);
    $('#example').DataTable( {
        "ajax": "<?php echo base_url('listings/jj/');?>"+last_part,
        "columns": [
            { "data": "s_no" },
            { "data": "user_id" },
            { "data": "bid_amount" },
            { "data": "is_won" },
            { "data": "is_sold" },
            { "data": "delete" }
        ]
    } );

} );
</script>
