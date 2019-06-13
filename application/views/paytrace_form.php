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
     <div class="main-content-tab col-md-12">
        <div class="tab-content-head describe_head">Welcome to the  Checkout Page</div>
            <figure class="tabBlock" style="margin-bottom: 0px;">
                <div class="tab-content-inner main-con">
                  <div class="describe_form">
                    <form action="<?php echo base_url('paytraces');?>" method="post" id="paytrace_payment">
                     <input class="style1" name="list_amount" type="hidden" value="<?php echo $list_info[0]['buy_now_price'];?>">
                     <div class="form-area">
                        <label>Full Name<span style="color:red;">*</span></label>
                        <br>
                        <input name="full_name" id="p_name" type="text" maxlength="255" placeholder="Full Name">
                        <span class="c_error" id="p_name_valid"></span>
                     </div>
                     <div class="form-area">
                        <label>Address<span style="color:red;">*</span></label>
                        <br>
                        <input type="text" name="address" id="p_address" placeholder="Address">
                        <span class="c_error" id="p_address_valid"></span>
                      </div> 
                   <!--   <div class="form-area">
                        <label>City<span style="color:red;">*</span></label>
                        <br>
                        <input name="city" id="p_city" type="text" placeholder="City">
                        <span class="c_error" id="p_city_valid"></span>
                      </div> -->
                    <!--   <div class="form-area">
                        <label>State<span style="color:red;">*</span></label>
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
                      </div> -->
                    <!--   <div class="form-area">
                        <label>ZIP Code<span style="color:red;">*</span></label>
                        <br>
                        <input name="zip" id="p_zip" type="text" placeholder="Zip Code">
                        <span class="c_error" id="p_zip_valid"></span>
                      </div> -->
                      <div class="form-area">
                        <label>Credit Card<span style="color:red;">*</span></label>
                        <br>
                        <input name="credit_card" id="p_credit_card" type="text" maxlength="165" placeholder="Credit Card">
                        <span class="c_error" id="p_credit_card_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Expiration<span style="color:red;">*</span> (Choose from dropdown)</label>
                        <br>
                        <label>Month<span style="color:red;">*</span></label>
                        <select name="exp_month" id="p_exp_month">
                            <option value="">--Month--
                            </option>
                            <?php for($i=1;$i<=12;$i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php } ?>
                        </select>
                        <span class="c_error" id="p_exp_month_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Year<span style="color:red;">*</span></label>
                        <br>
                        <select name="exp_year" id="p_exp_year">
                            <option value="">--Year--
                            </option>
                            <option value="18">2018</option>
                            <option value="19">2019</option>
                            <option value="20">2020</option>
                            <option value="21">2021</option>
                            <option value="22">2022</option>
                            <option value="23">2023</option>
                            <option value="24">2024</option>
                            <option value="25">2025</option>
                            <option value="26">2026</option>
                            <option value="27">2027</option>
                            <option value="28">2028</option>
                            <option value="29">2029</option>
                        </select>
                        <span class="c_error" id="p_exp_year_valid"></span>
                      </div>
                      <div class="form-area">
                        <label>Csc<span style="color:red;">*</span></label>
                        <br>
                        <input name="csc" id="p_csc" type="text" placeholder="Csc">
                        <span class="c_error" id="p_csc_valid"></span>
                      </div>

                        <div class="describe_form shipping_pay_form">
                          <div class="form-area">
                            <label>Terms and Conditions:</label>
                            <br>
                          </div>
                          <div class="form-area ship_form">
                            <input name="payment_method" type="checkbox">
                          </div>
                          <br>
                        </div>
                        <div class="join_btn">
                            <a id="payment_form" style="cursor:pointer; color:white;">SUBMIT</a>
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