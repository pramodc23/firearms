<style>
    .c_error{
        color:red;
    }
</style>

<!--ADD MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--list an item section -->
    <div class="row">
      <fieldset>
    <?php if(isset($success_msg)){?>
<script type="text/javascript">swal("Opps!", "<?php echo $success_msg;?>", "error");</script>
<?php } ?>

<?php  if(!$this->session->flashdata('verify_msg')==''){ 
    $response_message=$this->session->flashdata('verify_msg'); 

    if ($response_message=='verified') { ?>
         <script type="text/javascript">
        sweetalertsuccess();
        function sweetalertsuccess(){   
            swal("Good job!", "Your email account verified successfully", "success");
        }
    </script>
   <?php }else{ ?>
    <script type="text/javascript">
        sweetalertsuccess();
        function sweetalertsuccess(){   
            swal("Good job!", "Your email already verified. plese complete payment process ", "success");
        }
    </script>
   <?php }
  ?>
  
<?php }

?>
     <div class="main-content-tab col-md-12">
<!--         <span style="margin: 0 50%;font-size: 30px;color: #40e222;font-weight: 600;">Verified</span> -->
        <div class="tab-content-head describe_head"> You have to paid $<?php if($list_settings){echo $list_settings->amount_for_seller_login;} ?> for access seller account</div>
            <figure class="tabBlock" style="margin-bottom: 0px;">
                <div class="tab-content-inner main-con">
                  <div class="describe_form">
                    <form action="<?php echo base_url('signing_amount/'.$sellerid);?>" method="post" id="paytrace_payment_for_signing_amount">   
                    <input name="seller_id" id="seller_id" type="hidden"  placeholder="seller id" value="<?php echo $sellerid;?>">     
                    <input class="style1" name="list_amount" type="hidden" value="<?php if($list_settings){echo $list_settings->amount_for_seller_login;} ?>">       
                     <div class="form-area" >
                        <label>Card Holder Name<span style="color:red;">*</span></label>
                        <br>
                        <input name="full_name" id="p_name" type="text" maxlength="255" placeholder="Card Holder Name" value="<?php echo $this->input->post('full_name'); ?>">
                        <span class="c_error" id="p_name_valid"></span>
                     </div>
                     <div class="form-area" >
                        <label>Address<span style="color:red;">*</span></label>
                        <br>
                        <input type="text" name="address" id="p_address" placeholder="Address" value="<?php echo $this->input->post('address'); ?>">
                        <span class="c_error" id="p_address_valid"></span>
                      </div>
                     <div class="form-area" style="">
                        <label>City<span style="color:red;"></span></label>
                        <br>
                        <input name="city" id="p_city" type="text" placeholder="City">
                        <span class="c_error" id="p_city_valid"></span>
                      </div>
                      <div class="form-area" style="">
                        <label>State<span style="color:red;"></span></label>
                        <br>
                        <select name="state" id="p_state">
                            <option value="">--select--
                            </option>
                            <option value="AL">Alabama
                            </option>
                            <option value="AK">Alaska
                            </option>
                            <option value="AZ">Arizona
                            </option>
                            <option value="AR">Arkansas
                            </option>
                            <option value="CA">California
                            </option>
                            <option value="CO">Colorado
                            </option>
                            <option value="CT">Connecticut
                            </option>
                            <option value="DE">Delaware
                            </option>
                            <option value="DC">District of Columbia
                            </option>
                            <option value="FL">Florida
                            </option>
                            <option value="GA">Georgia
                            </option>
                            <option value="HI">Hawaii
                            </option>
                            <option value="ID">Idaho
                            </option>
                            <option value="IL">Illinois
                            </option>
                            <option value="IN">Indiana
                            </option>
                            <option value="IA">Iowa
                            </option>
                            <option value="KS">Kansas
                            </option>
                            <option value="KY">Kentucky
                            </option>
                            <option value="LA">Louisiana
                            </option>
                            <option value="ME">Maine
                            </option>
                            <option value="MD">Maryland
                            </option>
                            <option value="MA">Massachusetts
                            </option>
                            <option value="MI">Michigan
                            </option>
                            <option value="MN">Minnesota
                            </option>
                            <option value="MS">Mississippi
                            </option>
                            <option value="MO">Missouri
                            </option>
                            <option value="MT">Montana
                            </option>
                            <option value="NE">Nebraska
                            </option>
                            <option value="NV">Nevada
                            </option>
                            <option value="NH">New Hampshire
                            </option>
                            <option value="NJ">New Jersey
                            </option>
                            <option value="NM">New Mexico
                            </option>
                            <option value="NY">New York
                            </option>
                            <option value="NC">North Carolina
                            </option>
                            <option value="ND">North Dakota
                            </option>
                            <option value="OH">Ohio
                            </option>
                            <option value="OK">Oklahoma
                            </option>
                            <option value="OR">Oregon
                            </option>
                            <option value="PA">Pennsylvania
                            </option>
                            <option value="PR">Puerto Rico
                            </option>
                            <option value="RI">Rhode Island
                            </option>
                            <option value="SC">South Carolina
                            </option>
                            <option value="SD">South Dakota
                            </option>
                            <option value="TN">Tennesse
                            </option>
                            <option value="TX">Texas
                            </option>
                            <option value="UT">Utah
                            </option>
                            <option value="VT">Vermont
                            </option>
                            <option value="VA">Virginia
                            </option>
                            <option value="VI">Virgin Islands, USA
                            </option>
                            <option value="WA">Washington
                            </option>
                            <option value="WV">West Virginia
                            </option>
                            <option value="WI">Wisconsin
                            </option>
                            <option value="WY">Wyoming
                            </option>
                        </select>
                        <span class="c_error" id="p_state_valid"></span>
                      </div>
                      <div class="form-area" >
                        <label>ZIP Code<span style="color:red;">*</span></label>
                        <br>
                        <input name="zip" class="return_number" id="p_zip" type="text" placeholder="Zip Code" maxlength="10">
                        <span class="c_error" id="p_zip_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Credit Card<span style="color:red;">*</span></label>
                        <br>
                        <input name="credit_card" id="p_credit_card" type="text" maxlength="165" placeholder="Credit Card" value="<?php echo $this->input->post('credit_card'); ?>">
                        <span class="c_error" id="p_credit_card_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Expiration<span style="color:red;">*</span> (Choose from dropdown)</label>
                        <br>
                        <?php  
if ($this->input->post('exp_month')){
    $exp_m=$this->input->post('exp_month');
}else{
    $exp_m='';
}                        ?>

                        <label>Month<span style="color:red;">*</span></label>
                        <select name="exp_month" id="p_exp_month"  style="-webkit-appearance: none;">
                            <option value="">--Month--
                            </option>
                            <?php for($i=1;$i<=12;$i++){?>
                                <option value="<?php echo $i;?>" <?php if ($exp_m==$i) {echo "selected";   } ?>><?php echo $i;?></option>
                            <?php } ?>
                        </select>
                        <span class="c_error" id="p_exp_month_valid"></span>
                      </div>
                         <?php  
if ($this->input->post('exp_year')){
    $exp_y=$this->input->post('exp_year');
}else{
    $exp_y='';
}                        ?>
                      <div class="form-area">
                        <label>Year<span style="color:red;">*</span></label>
                        <br>
                        <select name="exp_year" id="p_exp_year" style="-webkit-appearance: none;">
            <option value="">--Year--</option>
            <option value="18" <?php if ($exp_y=='18') {echo "selected";   } ?>>2018</option>
            <option value="19" <?php if ($exp_y=='19') {echo "selected";   } ?>>2019</option>
            <option value="20" <?php if ($exp_y=='20') {echo "selected";   } ?>>2020</option>
            <option value="21" <?php if ($exp_y=='21') {echo "selected";   } ?>>2021</option>
            <option value="22" <?php if ($exp_y=='22') {echo "selected";   } ?>>2022</option>
            <option value="23" <?php if ($exp_y=='23') {echo "selected";   } ?>>2023</option>
            <option value="24" <?php if ($exp_y=='24') {echo "selected";   } ?>>2024</option>
            <option value="25" <?php if ($exp_y=='25') {echo "selected";   } ?>>2025</option>
            <option value="26" <?php if ($exp_y=='26') {echo "selected";   } ?>>2026</option>
            <option value="27" <?php if ($exp_y=='27') {echo "selected";   } ?>>2027</option>
            <option value="28" <?php if ($exp_y=='28') {echo "selected";   } ?>>2028</option>
            <option value="29" <?php if ($exp_y=='29') {echo "selected";   } ?>>2029</option>
                        </select>
                        <span class="c_error" id="p_exp_year_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Cvv<span style="color:red;">*</span></label>
                        <br>
                        <input name="csc" id="p_csc" type="text" placeholder="Cvv"  value="<?php echo $this->input->post('csc'); ?>">
                        <span class="c_error" id="p_csc_valid"></span>
                      </div>

                        <div class="describe_form shipping_pay_form">
                          <div class="form-area">
                            <label>Terms and Conditions:</label>
                            <br>
                          </div>
                          <div class="form-area ship_form">
                            <input name="term_and_condition" id="term_and_condition"  type="checkbox" value="1">
                            <span class="c_error" id="t_and_c_valid"></span>
                          </div>
                          <br>
                        </div>
                        <div class="join_btn">
                            <a id="signing_amount_form" style="cursor:pointer; color:white;">SUBMIT</a>
                        </div>
                  </form>
                </div>
                </div>
            </figure>
          </div>
      </fieldset>
      <!--sign in form section end-->
    </div>
  </div>
</section>
</form>
<!--ADD LIST PREVIEW MEDIA SECTION END-->