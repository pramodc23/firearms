<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> -->
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style type="text/css">
.row.new-white-box {
    border: 1px solid #c6c4c4;
    margin-bottom: 28px !important;
    margin: 0px 15px;
    margin-top: 28px;
}
.content-box {
    padding-top: 40px;
    padding-bottom: 40px;
    font-family: lato;
    text-align: center;
}
.content-box h3 {
    font-weight: 600;
}
.Step-sections h4 {
    font-family: lato;
    font-size: 18px;
    padding: 140px 0px;
    color: #444444;
    font-weight: 600;
}
.Step-sections p {
    font-family: lato;
    font-size: 17px;
    line-height: 30px;
}
.Step-sections {
    margin: 0px 15px;
    box-shadow: 0px 1px 12px 4px #4d4d4d1a;
    padding: 30px;
}
.Step-sections {
    margin: 0px 15px 50px;
    box-shadow: 0px 1px 12px 4px #4d4d4d1a;
    padding: 30px;
}
.Step-sections .row {
    margin-bottom: 60px;
}
a.link-color {
    color: #f8662e;
}
</style>
<section id="buy_main">
<div class="container">
  <div class="row new-white-box">
              <div class="col-md-12">
                <div class="content-box">
                 <h3>How To Buy Your Item</h3>
                 <p>The Ordering Process Explained</p>
               </div>
              </div>
            </div>
            <div class="Step-sections">
            <div class="row">
              <div class="col-md-6">
                <h4>1. Sign in to your Account. </h4>
              </div>
             <div class="col-md-6">
              <img src="<?php echo base_url(); ?>assets/img/Step-01-Start.png" class="img-fluid">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p>When exploring the website’s <a class="link-color" href="<?php echo base_url('buy');?>">Firearms page</a>, buyers will have the option to search using specific keywords, looking up a particular item itself, or looking up a seller. The page offers an advanced search by category, price range, UPC, no reserve, and condition (pre-owned, factory-new, etc.). You can narrow down your search by item categories and characteristics. Also, sort the listings by title or date. 
                </p>
                  <p>What makes Firearms Network unique is that you can even:</p>
              </div>
            </div>
          <div class="row">
              <div class="col-md-6">
                <h4>2. Search for your preferred firearm and you can also view seller’s home page.</h4>
              </div>
             <div class="col-md-6">
              <img src="<?php echo base_url(); ?>assets/img/Step-02-Start.png" class="img-fluid">
              </div>
            </div>

              <div class="row">
              <div class="col-md-6">
                <h4>3. Ask the seller questions via instant messaging (you can also view the other items the seller has listed)</h4>
              </div>
             <div class="col-md-6">
              <img src="<?php echo base_url(); ?>assets/img/Step-04-Start.png" class="img-fluid">
              </div>
            </div>
            <div class="row" style="margin-bottom: 0px;">
              <div class="col-md-12">
                <p>Click <a href="<?php echo base_url('buy');?>" class="link-color">Buy It Now</a> to immediately purchase or place a bid on the item</p>
              </div>
            </div>
          </div>
</div>
</section>
<script>
 $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
</script>
