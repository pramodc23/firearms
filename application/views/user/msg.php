<?php
$receiver_id = $_POST['id'];
?>
<style>

.col-md-2, .col-md-10{
    padding:0;
}
.panel{
    margin-bottom: 0px;
}
.panel-title{
  color: #fff;
      margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
}
.chat-window{
    bottom: 0;
    left: 0px;
    right: 0px;
    position: static !important;
    float: left;
    width: 100%;
    margin: 0px !important;
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
  height:500px;
  overflow-x:hidden;

}
.panel-default>.panel-heading {
    color: #333;
    background-color: #f5f5f5;
    border-color: #ddd;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.top-bar {
  background: #666 !important;
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
  background: #f2f2f2;
  border: 1px solid #d4d3d3;
  padding: 10px;
  border-radius: 10px;
  max-width:100%;
  position: relative;
}
.messages.msg_sent {
    background: #f96c0363;
    border: 1px solid #f96c0359
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
    word-break: break-word;
    margin-bottom: 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
    font-size: 10px;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}

.avatar {
    position: relative;
}
.base_receive .avatar img {
    max-width: 55px;
    margin-left: 15px;
}
.base_sent .avatar img {
    max-width: 55px;
    margin-left: 35px;
}
.base_sent .messages {
  margin-left: 15px;
}
.base_receive .messages {
  margin-right: 15px;
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
    text-align: right;
    display: block;
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
.row.msg_container.base_sent {
    margin-left: 15% !important;
    width: 85%;
}
.row.msg_container.base_receive {
    margin-right: 15% !important;
    width: 85%;
}
.old_chat img.img-responsive {
    max-width: 30px;
}
.panel-footer {
  margin-top: 20px;
}

.btn-primary:hover {
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
}

.top-bar{
  background: #f96c04 !important;
}
.messages > time {
    color: rgba(77, 77, 77, 0.65);
}
/*responsive*/
@media(max-width: 992px) {
  .base_receive .messages {margin-left: 15px;}
  .base_receive > .avatar:after {right:-15px;}
  .base_sent .avatar img {margin-left:25px;}
}
@media(max-width: 768px) {
  .base_receive .messages {margin-left: 0;}
  .base_sent .avatar img {margin-left:15px;}
  .base_sent > .avatar:after {left: -15px;}
}
@media(max-width: 575px) {
  .base_receive .avatar img {margin-left: 0;}
  .base_sent .avatar img {    max-width: 40px;}
  .col-sm-2.avatar {width: 30%; float: left;}
  .base_sent .messages {margin-left: 0;}
  .base_receive .col-sm-10, .base_sent .col-sm-10 {width: 70%; float: left;}
}
</style>
<input type="hidden" value="<?php echo $receiver_id;?>" id="receiver_id">
<input type="hidden" id="base_url" value="<?php echo base_url();?>" >
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<!-- Latest compiled JavaScript -->
    <div class="row chat-window chat_window" id="chat_window_1" style="margin-left:10px;" data-attr="<?php echo $user_info[0]['id'];?>">
        <div class="col-xs-12 col-md-12" style="margin-top: 20px;padding-right: 0;">
          <div class="panel panel-default">
            <div class="panel-heading top-bar">
                <div class="col-md-8 col-xs-8">
                    <h3 class="panel-title"><?php echo $user_info[0]['first_name'];?></h3>
                </div>
                <div class="col-md-4 col-xs-4" style="text-align: right;">
                   
                </div>
            </div>
            <div class="panel-body msg_container_base" id="chatting">
      
            </div>
            <div class="panel-footer">
              <div class="input-group msg_input">
                  <input id="btn-input" type="text" class="form-control input-sm chat_input chat_text" placeholder="Write your message here..." />
                  <span class="input-group-btn">
                  <button class="btn btn-primary btn-sm send_chat" id="btn-chat" style="border-radius: 0px;height: 100%;background-color: #f96c04;border-color: #f96c04;">Send</button>
                  </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    
    <!-- <div class="btn-group dropup">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-cog"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#" id="new_chat"><span class="glyphicon glyphicon-plus"></span> Novo</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-list"></span> Ver outras</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-remove"></span> Fechar Tudo</a></li>
            <li class="divider"></li>
            <li><a href="#"><span class="glyphicon glyphicon-eye-close"></span> Invisivel</a></li>
        </ul>
    </div> -->

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
    $('#is_chat_open').val('0');
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
       var  message = $.trim($('.chat_text').val());
    
        if (message !='') {
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
        }else{
          $( "#btn-input" ).focus();
           
        }
       
     
    });
  });

</script>