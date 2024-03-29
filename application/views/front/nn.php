<style>
    .c_error{
        color:red;
    }
</style>
<style>
  /*body{
    height:400px;
    position: fixed;
    bottom: 0;
}*/
.col-md-2, .col-md-10{
    padding:0;
}
.panel{
    margin-bottom: 0px;
}
.chat-window{
    bottom:0;
    position:absolute;
    float:right;
    margin-left:10px;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.icon_minim{
    padding:2px 10px;
}
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
  height: 500px;
  overflow-y: scroll;
}
.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}
img {
    display: block;
    width: 100%;
}
.avatar {
    position: relative;
}
.base_receive > .avatar:after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border: 5px solid #FFF;
    border-left-color: rgba(0, 0, 0, 0);
    border-bottom-color: rgba(0, 0, 0, 0);
}

.base_sent {
  justify-content: flex-end;
  align-items: flex-end;
}
.base_sent > .avatar:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border: 5px solid white;
    border-right-color: transparent;
    border-top-color: transparent;
    box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
}

.msg_sent > time{
    float: right;
}



.msg_container_base::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

.msg_container_base::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

.btn-group.dropup{
    position:fixed;
    left:0px;
    bottom:0;
}
.active_user{
      width: 75%;
    float: right;
}
.other_user{
      width: 75%;
    float: left;
}
</style>
<script>
  $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
});

$(document).ready(function(){
    $('.msg_input input').keypress(function(event){
      if(event.charCode == 13){
        $(this).parent().parent().find('.send_chat').trigger('click');
      }
    });

    $('.send_chat').on('click',function(){
       var  base_url = $('#base_url').val();
       var  receiver_id = $('#receiver_id').val();
       var  message = $('.chat_text').val();
       $.ajax({
        method : 'post',
        url : base_url+'user_action/ins_msg',
        data : {'receiver_id' : receiver_id , 'message' : message}
      }).done(function(resp){
          if(resp>0){
            $('.chat_text').val('');
         }else{
            alert('Message not sent.');
         }
      });
    });
  });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<input type="hidden" value="<?php echo 12;?>" id="receiver_id">
<input type="hidden" id="base_url" value="<?php echo base_url();?>" >
<!--ADD MEDIA SECTION START-->
<section class="content_section sign-in tab">
  <div class="container"> 
    <!--list an item section -->
    <div class="row">
    <fieldset>
     <div class="main-content-tab col-md-12">
      <div class="row">
            <div class="col-md-3">
              <div class="tab-content-head describe_head">Messages</div>
                  <div class="tab-content-inner main-con">
                    <div class="describe_form">
                       <div class="form-area">
                          <label>Select User<span style="color:red;">*</span></label>
                          <select name="msg_user" id="to_name" class="chosen">
                              <?php foreach($all_users as $users){?>
                              <option value="<?php echo $users['id'];?>"><?php echo $users['first_name'];?></option>
                              <?php } ?>
                          </select>
                          <div>
                            <?php foreach($chat_users as $users){
                              $username=$this->user_model->select_data('first_name','user',array('id'=>$users['to_u_id']));
                            ?>
                              <a data-attr="<?php echo $users['to_u_id'];?>" class="old_chat" style="cursor:pointer;"><?php echo $username[0]['first_name'];?></a><br>
                            <?php } ?>
                        </div>
                        </div>
                        
                   </div>
                  </div>
              
          </div>
          <div class="col-md-9" id="chat_box chat_window" id="chat_window_1" data-attr="<?php echo 1;?>" >

            <div class="col-xs-12 col-md-12">
              <div class="panel-heading top-bar">
               <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span><?php echo 'DEEPIKA';?></h3>
              </div>
               <!-- Message Start  -->

                <div class="panel-body msg_container_base " id="chatting" style="height: 500px;overflow-y: scroll;">
                    <div class="row msg_container base_sent active_user">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p>Hi How's you</p>
                                <time datetime="'.$msg['msg_date'].'">Deepika AUG 2 12 AM</time>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                    </div>
                <div class="row msg_container base_sent other_user">
                      <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p style="text-align: right;">Hi How's you</p>
                                <time style="float:left;" datetime="'.$msg['msg_date'].'">Deepika AUG 2 12 AM</time>
                            </div>
                        </div>
                        
                    </div>
      
               </div>

              <!--  Message End  -->

                <div class="panel-footer">
                  <div class="input-group msg_input">
                      <input id="btn-input" type="text" class="form-control input-sm chat_input chat_text" placeholder="Write your message here..." />
                      <span class="input-group-btn">
                      <button class="btn btn-primary btn-sm send_chat" id="btn-chat">Send</button>
                      </span>
                  </div>
              </div>

            </div>


            <!-- <div class="container">
            <div class="row chat-window col-xs-12 col-md-12 chat_window" id="chat_window_1" style="margin-left:10px;" data-attr="<?php //echo 1;?>">
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading top-bar">
                <div class="col-md-8 col-xs-8">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span><?php //echo 'DEEPIKA';?></h3>
                </div>
                <div class="col-md-4 col-xs-4" style="text-align: right;">
                    <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                </div>
            </div>
            <div class="panel-body msg_container_base" id="chatting">
      
            </div>
            <div class="panel-footer">
              <div class="input-group msg_input">
                  <input id="btn-input" type="text" class="form-control input-sm chat_input chat_text" placeholder="Write your message here..." />
                  <span class="input-group-btn">
                  <button class="btn btn-primary btn-sm send_chat" id="btn-chat">Send</button>
                  </span>
              </div>
            </div>
          </div>
        </div>
    </div>
          </div> -->
      </div>
      </div>

    </div>
    </fieldset>
      <!--sign in form section end-->
    </div>
  </div>
</section>
<script type="text/javascript">
    //setInterval( get_messages, 1000 );
    function get_messages(){
    var re_id = 2;//$('.chat_window').attr('data-attr');
    var base_url = $('#base_url').val();
    $.ajax({
        method : 'post',
        url : base_url+'user_action/get_messages',
        data : {'re_id' : re_id}
      }).done(function(resp){
         $('#chatting').html(resp);
         //$("#chatting").stop().animate({ scrollTop: $("#chatting")[0].scrollHeight}, 1000);
      });
  }

  $(document).ready(function(){
    $('.chat').on('click',function(){
      var id = $(this).parent().parent().find('#to_name').val();
      var base_url = $('#base_url').val();
      $.ajax({
        method : 'post',
        url : base_url+'user_action/msg_h',
        data : {'id' : id}
      }).done(function(resp){
        // $('#chat_box').html(resp);
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
         var messages = get_messages();
      });
    });


  });
</script>

<!--ADD LIST PREVIEW MEDIA SECTION END-->