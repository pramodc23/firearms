<?php

$id = '';
$first_name = '';
$last_name = '';
$email_id = '';
$password = '';
$phone = '';
$business_phone = '';
$address = '';
$zipcode = '';
$city = '';
$state = '';
$country = '';
$company_name = '';
$FFL_LGD = '';
$prefered_contact = '';
$is_verified = '';
$is_active = '';


if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $id = $uf->id;
        $first_name = $uf->first_name;
        $last_name = $uf->last_name;
        $email_id = $uf->email_id;
        $password = $uf->password;
        $phone = $uf->phone;
        $business_phone = $uf->business_phone;
        $address = $uf->address;
        $zipcode = $uf->zipcode;
        $city = $uf->city;
        $state = $uf->state;
        $country = $uf->country;
        $company_name = $uf->company_name;
        $FFL_LGD = $uf->FFL_LGD;
        $prefered_contact = $uf->prefered_contact;
        $is_verified = $uf->is_verified;
        $is_active = $uf->is_active;
        
        
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editUser" method="post" id="editUser" role="form">
                        <div class="box-body">
                             <input type="hidden" value="<?php echo $id; ?>" name="userId" id="userId" />    
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $first_name; ?>" id="fname" name="fname" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $last_name; ?>" id="lname" name="lname" maxlength="128">
                                    </div>
                                    
                                </div>
                                </div>
                               <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo $email_id; ?>" name="email" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo $phone; ?>" name="mobile" maxlength="10">
                                    </div>
                                </div>
                            
                            </div>
                             <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control required" id="password" disabled="true" name="password" value="<?php echo $password; ?>" maxlength="20">
                                    </div>
                                </div>
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" disabled="true" value="<?php echo $password; ?>" name="cpassword" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_phone">Business Phone</label>
                                        <input type="text" class="form-control required business_phone" id="business_phone" value="<?php echo $business_phone; ?>" name="business_phone" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" value="<?php echo $address; ?>" name="address">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zipcode">Zipcode</label>
                                        <input type="text" class="form-control required zipcode" id="zipcode" value="<?php echo $zipcode; ?>" name="zipcode" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control required" id="city" value="<?php echo $city; ?>" name="city">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control required state" id="state" value="<?php echo $state; ?>" name="state" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control required" id="country" value="<?php echo $country; ?>" name="country">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" class="form-control " id="company_name" value="<?php echo $company_name; ?>" name="company_name" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FFL_LGD">FFL/LGD</label>
                                        <input type="text" class="form-control required" id="FFL_LGD" value="<?php echo $FFL_LGD; ?>" name="FFL_LGD">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prefered_contact">Prefered Contact</label>
                                        <input type="text" class="form-control " id="prefered_contact" value="<?php echo $prefered_contact; ?>" name="prefered_contact" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_verified">Is Verified</label>
                                        <input type="text" class="form-control" id="is_verified" value="<?php echo $is_verified; ?>" name="is_verified">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_active">Is Active</label>
                                        <input type="text" class="form-control" id="is_active" value="<?php echo $is_active; ?>" name="is_active">
                                    </div>
                                </div>
                                 
                               
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>