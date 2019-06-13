<style>
    .c_error{
        color:red;
    }
    .msg_contacts{
         border-bottom: 1px solid #ff6d00;
         padding: 3px 0 8px;
    }
    .msg_contacts img{
      border-radius: 200px;
    }
</style>

<!--ADD MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--list an item section -->
    <div class="row">
    <fieldset>
     <div class="main-content-tab col-md-12">
      <div class="row">
            <div class="col-md-12">
              <div class="tab-content-head describe_head">Messages aa</div>
            </div>
            <div class="col-md-3">
                <figure class="tabBlock" style="margin-bottom: 0px;">
                    <div class="tab-content-inner main-con">
                        <div class="describe_form">
                            <div class="form-area">
                              <label>Select User<span style="color:red;">*</span></label>
                              <br>
                              <select name="msg_user" id="to_name" class="chosen chat">
                                  <?php foreach($all_users as $users){?>
                                  <option value="<?php echo $users['id'];?>"><?php echo $users['first_name'];?></option>
                                  <?php } ?>
                              </select>
                            </div>
                        </div>
                        <br>
                        <div>
                            <?php if(!empty($chat_users)){?>
                            <h6><b>Your Contacts</b></h6>
                            <?php foreach($chat_users as $users){
                              $username=$this->user_model->select_data('first_name','user',array('id'=>$users['to_u_id']));
                            ?>
                            <div class="msg_contacts">
                              <a data-attr="<?php echo $users['to_u_id'];?>" class="old_chat" style="cursor:pointer;font-size: 14px;">
                              <i class="fa fa-circle" aria-hidden="true" style="color:#008000c2;"></i>
                              <img height="40px" width="40px" src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                              <?php echo $username[0]['first_name'];?>
                              </a>
                            </div>
                            <?php } }?>
                        </div>
                    </div>
                </figure>
            </div>
          <input type="hidden" value="0" id="is_chat_open">
          <div class="col-md-9" id="chat_box"></div>
      </div>
    </div>
    </fieldset>
      <!--sign in form section end-->
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
         $("#chatting").stop().animate({ scrollTop: $("#chatting")[0].scrollHeight}, 100);
      });
  }

  $(document).ready(function(){
    $('.chat').on('change',function(){
      var id = $(this).parent().parent().find('#to_name').val();
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
</script>

<!--ADD LIST PREVIEW MEDIA SECTION END-->