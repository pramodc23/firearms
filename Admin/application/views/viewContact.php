<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('allcontacts'); ?>"><i class="fa fa-list"></i> All Contacts</a>
                </div>
            </div> 
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">View Contact Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" method="post" id="m_category">
                        <?php if(isset($contact_us_details)){?>
                        <input type="hidden"  value="<?php echo $subcat_info[0]['id'];?>" name="subcat_id">
                        <?php } ?>
                        <div class="box-body">
                           <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">Selectbasic</label>
                                        <input type="text"  readonly class="form-control require" id="subcat_name" name="selectbasic" 
                                        <?php if(isset($contact_us_details)){?>
                                        value="<?php echo $contact_us_details[0]['selectbasic'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">Email</label>
                                        <input type="text" readonly class="form-control require" id="subcat_name" name="email" 
                                        <?php if(isset($contact_us_details)){?>
                                        value="<?php echo $contact_us_details[0]['email'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>
                                
                            </div>    

                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">Subject</label>
                                        <input type="text" readonly class="form-control require" id="subcat_name" name="subject" 
                                        <?php if(isset($contact_us_details)){?>
                                        value="<?php echo $contact_us_details[0]['subject'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">message</label>
                                        <input type="text"  readonly class="form-control require" id="subcat_name" name="message" 
                                        <?php if(isset($contact_us_details)){?>
                                        value="<?php echo $contact_us_details[0]['message'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>

                           
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat_name">Userfile</label>
                                        <input type="text" readonly class="form-control require" id="subcat_name" name="userfile" 
                                        <?php if(isset($contact_us_details)){?>
                                        value="<?php echo $contact_us_details[0]['userfile'];?>" <?php } ?>
                                        >
                                    </div>
                                </div>
  
                                
                            </div>   
                        </div><!-- /.box-body -->
    
                        
                    </form>
                </div>
            </div>    
        </div>    
    </section>
</div>