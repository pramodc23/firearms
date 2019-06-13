<?php
  $user_type = $this->session->userdata('user_type');
  if ($user_details[0]['profile_image']!='') {
    $user_image=$user_details[0]['profile_image'];
  }else{
    $user_image='user_profile.png';  
  }
$user_id_for_chat = $this->uri->segment(2);


?>
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
ul.Left-menus-01 label {
    display: block;
    padding-left: 23px;
    font-family: lato;
}
ul.Left-menus-01 {
    list-style-position: inside;
    padding-left: 0px;
    max-height: 600px;
    border: 1px solid #e9e9e9;
    background: transparent;
}
.main-box05 {
    margin: 0px 15px 40px;
}
.msg_contacts{
  margin: 20px 30px;
}
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  height:500px;
  overflow-x:hidden;

}
.top-bar{
  background: #f96c04 !important;
}
.messages > time {
    color: rgba(77, 77, 77, 0.65);
}
</style>
  <?php 
//  $msg_user_id= $this->uri->segment(2);
// if($msg_user_id){
//   echo "exist";
// }else{
//   echo "not exist";
// }

?>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto+Slab:700' rel='stylesheet' type='text/css'>
<section id="list-detail">
  <div class="container">
    <div class="row new-white-box">
      <div class="col-md-12">
        <div class="content-box">
         <h3>Message!</h3>

         <p>Send your message to seller or buyer <?php /*if ($user_type=='seller') {
          echo "Buyer";}else{ echo "Seller";}*/ ?></p>
        </div>
      </div>
    </div>


  <section class="second-box-01">
    <div class="row">
      <div class="col-md-12">
       <img src="<?php echo base_url(); ?>assets/img/profile_image/<?php echo $user_image;?>" style="float: left;border-radius:5% !important; height: 28px;width: 28px; "> <span class="profile-details01">WELCOME <?php echo strtoupper($user_details[0]['first_name']);?></span> <span class="caption-new">Message
       </span>
     </div>
   </div>
  </section>
<div class="main-box05">
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12 pad-0">
    <ul class="Left-menus-01" > 
    
      <h5 style="margin-top: 20px;">Select User</h5>
        <ul id="menu_list" style="padding-left: 0px;">
          <li class="btn_cls active_cls" style="padding-left:2px;" > 
            <select name="msg_user" id="to_name" class="chosen chat" style="width: 100%;">
              <option value="">Select</option>
                <?php foreach($all_users as $users){?>
                <option value="<?php echo $users['id'];?>"><?php echo $users['first_name'];?></option>
              
                <?php } ?>
            </select>
          </li>      
        </ul>
      <?php if(!empty($chat_users)){?>  
      <h5 style="margin-top: 20px;">Your Contacts</h5>
          <?php  $i=0; foreach($chat_users as $users_data){
          //$username=$this->user_model->select_data('first_name,is_login','user',array('id'=>$users_id));
            $from_user_image = $users_data['profile_image'];
            if ($from_user_image =='') {
              $from_user_image='user_profile.png';
            }
          
        ?>
        <div class="msg_contacts">
          <a data-attr="<?php echo $users_data['id'];?>" class="old_chat" style="cursor:pointer;font-size: 14px;">
            <?php if($users_data['is_login']==1){ ?>
          <i class="fa fa-circle" aria-hidden="true" style="color:green;    margin-right: 8px;"></i>
            <?php }else{?>
          <i class="fa fa-circle" aria-hidden="true" style="color:#CCC;    margin-right: 8px;"></i>
             <?php }?>
            <img height="30px" width="30px" src="<?php echo base_url().'assets/img/profile_image/'.$from_user_image; ?>" class=" img-responsive ">
            <?php echo $users_data['first_name'];?>

          
          
           

          
          </a>

          <?php if ($i==0) { ?>
           <script type="text/javascript">
             get_user_msg_fun();
             function get_user_msg_fun() {
                var id = '<?php echo $users_data['id']; ?>';        
                var base_url = $('#base_url').val();
                $.ajax({
                  method : 'post',
                  url : base_url+'user_action/msg_h',
                  data : {'id' : id}
                }).done(function(resp){
                   $('#chat_box').html(resp);
                   $('#is_chat_open').val('1');
                   //$(".msg_notification_header").hide();
                   var messages = get_messages();
                });

             }
           </script>
         <?php  } ?> 
        </div>
        <?php  $i++;} 
        }?>  

    </ul>
  </div>


  <input type="hidden" value="0" id="is_chat_open">
  <div class="col-lg-9 col-md-8 col-sm-12 pad-01" id="chat_box">
      <!-- front msg box start-->
      <div class="col-xs-12 col-md-12" style="margin-top: 20px;    padding-right: 0;">
        <div class="panel panel-default">
          <div class="panel-heading " style="background: #666 !important;color: white;padding: 10px;position: relative;overflow: hidden;height: 43px;">
              <div class="col-md-8 col-xs-8">
                  <h3 class="panel-title" style="color: #fff;margin-top: 0;margin-bottom: 0;font-size: 16px;"></h3>
              </div>
              <div class="col-md-4 col-xs-4" style="text-align: right;">
                 
              </div>
          </div>       
          <div class="panel-body msg_container_base" style="height: 500px;">
      
          </div>    
          <div class="panel-footer">
            <div class="input-group msg_input">
                <input id="btn-input" type="text" class="form-control input-sm chat_input chat_text" placeholder="Write your message here...">
                <span class="input-group-btn">
                <button class="btn btn-primary btn-sm"  style="border-radius: 0px;height: 100%;">Send</button>
                </span>
            </div>
          </div>
        </div>
      </div>
    
      <!-- end -->
  </div>
</div>

</div>

</div>
</section>

<script type="text/javascript">
    setInterval(function() {
    if($('#is_chat_open').val()==1) {
      get_messages();
    }
  }, 1000);

    //setInterval( get_messages, 1000 );
    function get_messages(){
    var re_id = $('.chat_window').attr('data-attr');

    var base_url = $('#base_url').val();
    $.ajax({
        method : 'post',
        url : base_url+'user_action/get_messages',
        data : {'re_id' : re_id}
      }).done(function(resp){
         $('#chatting').html(resp);
          var check_msg_read=$('#check_msg_read').val();

          if (check_msg_read==0) {
            $("#chatting").stop().animate({ scrollTop: $("#chatting")[0].scrollHeight}, 100);
          }else{

          }
      });
  }

  $(document).ready(function(){
    $('.chat').on('change',function(){
      var id = $(this).parent().parent().find('#to_name').val();
      if (id=='') {
        return false;
      }
      var base_url = $('#base_url').val();
      $.ajax({
        method : 'post',
        url : base_url+'user_action/msg_h',
        data : {'id' : id}
      }).done(function(resp){
         $('#chat_box').html(resp);
         $('#is_chat_open').val('1');
         var messages = get_messages();
      });
    });

    $('.old_chat').on('click',function(){
      var id = $(this).attr('data-attr');

      var base_url = $('#base_url').val();
      $.ajax({
        method : 'post',
        url : base_url+'user_action/msg_h',
        data : {'id' : id}
      }).done(function(resp){
         $('#chat_box').html(resp);
         $('#is_chat_open').val('1');
         var messages = get_messages();
      });
    });

  });

  function custom_func_for_chat_user_selected(id)
  {
      if (id=='') {
        return false;
      }
      var base_url = $('#base_url').val();
      $.ajax({
        method : 'post',
        url : base_url+'user_action/msg_h',
        data : {'id' : id}
      }).done(function(resp){
         $('#chat_box').html(resp);
         $('#is_chat_open').val('1');
         var messages = get_messages();
      });

  }
</script>
<?php if($user_id_for_chat>0 && $user_id_for_chat!="")
{
?>
<script type="text/javascript">
document.getElementById("to_name").value = "<?php echo $user_id_for_chat; ?>";
custom_func_for_chat_user_selected(<?php echo $user_id_for_chat; ?>);
<?php
} 
?>
</script>
<!--ADD LIST PREVIEW MEDIA SECTION END-->