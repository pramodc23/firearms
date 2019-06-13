<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>MT_03</title>
    </head>
<body>
<table width="650px"; border="0";>
  <tbody>
    <tr>
      <td>
        <table width="100%"; style="background-color: #4d4d4d; padding: 15px 0">
          <tbody>
            <tr>
              <td align="center"><a href="#" target="_blank"><img mc:edit="logo3" src="<?php echo base_url('assets/img/logo-new.png');?>" width="100%" height="auto" alt="Firearms Network" style="display:block; width:180px;" border="0" /></a></td>
            </tr>
            <tr>
              <td class="white1" valign="middle" style="font-family:Arial, sans-serif; font-size:14px; color: #d18545;  line-height:normal;text-align: center;" align="left">Online Gun Auction - Buy Guns at Firearms.network</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
    <td>
        <table width="100%"; border="0"; class="wrapper" mc:repeatable mc:variant="Full Banner Image">
        <tbody>
       
        <!--Main Banner-->
        <tr>
        <td align="center" valign="top" style="border: 1px solid #ddd;"><img mc:edit="Main_Banner" class="full_img"  <?php if(true){echo 'src="'.base_url('assets/img/listing_photos/'.$thumb_list_img).'"';}?> width="500" height="250" alt="Main Title Here" style="display:block;border:none;max-width:650px;max-height:345px;padding:10px" /></td>
      </tr>
      </tbody>
      </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; align="center" class="wrapper" mc:repeatable mc:variant="Title + Sub title Section" style="margin: 20px auto; ">
          <tbody>
            <tr>
              <td class="black" mc:edit="Main_Title1" align="center" valign="top" style="text-transform: capitalize; font-size:24px; color:#333333;">
                
                  <p style="text-align:left;font-size:21px;">Hello <?php echo $username;?></p>  

                    <p style="text-align:left;font-size:21px;"><?php  echo $data;?></p>  
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" class="product_info" style="margin: 0 auto; padding: 2px 10px; background: #f2f2f2; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Title</td>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;"><?php echo $list_info[0]['title'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; background-color:#efefef; padding: 2px 10px; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Description</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252;text-align:right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;"><?php echo $list_info[0]['description'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; padding: 2px 10px; background: #f2f2f2; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Item Number</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;">#<?php echo $list_info[0]['item_number'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; background-color:#efefef; padding: 2px 10px; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Purchased Quantity</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;"><?php echo $quantity;?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; background-color:#efefef; padding: 2px 10px; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Per Item Price</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;">$<?php echo $peritemprice;?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; background-color:#efefef; padding: 2px 10px; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Final Price</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;">$<?php echo $commission_amount;?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr style="background:#e0d4d4; ">
      <td colspan="2" style="padding: 20px 15px;font-size: 18px;font-weight: BOLD;">Buyer Details</td>
    </tr>

    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; padding: 2px 10px; background: #f2f2f2; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Name</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;"><?php echo $buyer_info[0]['first_name'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; background-color:#efefef; padding: 2px 10px; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Email</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;"><?php echo $buyer_info[0]['email_id'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; padding: 2px 10px; background: #f2f2f2; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Phone No</td>
               <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="text-decoration:none; color: inherit;"><?php echo $buyer_info[0]['phone'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%"; mc:repeatable mc:variant="Left IMAGE + Right(TITLE + DESC + READ MORE)" style="margin: 0 auto; background-color:#efefef; padding: 2px 10px; text-transform: capitalize;">
          <tbody>
            <tr>
              <td style="text-decoration:none; font-weight: bold; font-size: 16px; color: #000;">Address</td>
              <td style="text-decoration:none; font-size: 16px; color: #525252; text-align: right;" mc:edit="PRODUCT5_Button" class="red"><a href="#" target="_blank" style="color: inherit; text-decoration:none;"><?php echo $buyer_info[0]['address1'];?></a></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td style="padding:10px 0; text-align: center; font-size: 16px; color: #4d4d4d; font-weight: bold;">For more information click on the button :</td>
    </tr>
    <tr><td class="button"  mc:edit="btn_11" style="padding:10px 0; text-align: center;" ><a href="<?php echo base_url();?>" target="_blank" style="text-decoration:none; color: #ffffff; padding: 12px 20px; background: #ff6d00; border-radius: 3px;" class="button" >View Details</a></td></tr>
    <tr>
      <td style="padding: 15px 0 0; text-align: center; font-size: 15px; color: #000;">Thanks and Regards,<br>Firearms Network Team</td>
    </tr>
    <tr>
      <td>
        <table width="100%"; style="background-color: #4d4d4d; margin-top: 20px; color: #d18545; text-align: center; line-height: 20px; padding: 30px 0;">
          <tbody>
            <tr>
              <td>Copyright &copy; 2017-<?php echo date('Y');?> Firearms.network All rights reserved worldwide.</td>
            </tr>
            <tr><td>Our mailing address is: <br><a style="color: #d18545;" href="mailto:demo@firearms.network">demo@firearms.network</a></td></tr>
          </tbody>
        </table>
      </td>
    </tr>
  
  </tbody>
</table>

  
</body>
</html>
