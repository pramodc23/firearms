<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->library('image_lib'); // load image library
		$this->load->model('user_model');	
		$this->load->model('user_action_model');
		$this->load->model('common_model');			
	}

	

	
    public function msgg(){
		$session_id = $this->session->userdata('user_id');
		$con = 'id != "'.$session_id.'"';
		$con .= ' AND id != 1';
    	$data['all_users']=$this->user_model->select_data('id,first_name','user',$con);
    	$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));
    	$data['chat_users']=$this->user_model->select_data('distinct(to_user_id)','message',array('from_user_id'=>$session_id));
    	$data['view_name']    = "front/nn";
		$this->load->view('template', $data);
    }

    public function msg_h(){
    	$session_id = $this->session->userdata('user_id');
    	$from_user=$_POST['id'];  	
    	$data['user_info']=$this->user_model->select_data('id,first_name','user',array('id'=>$_POST['id']));
        $this->load->view('user/msg',$data);
    }

    public function get_messages(){
    	$base_url=base_url();
      	$session_id = $this->session->userdata('user_id');
      	$from_user=$_POST['re_id'];

        $to_user_image=get_list_user_details($session_id);          
		if ($to_user_image->profile_image !='') {
			$to_user_image=$to_user_image->profile_image;
		}else{
			$to_user_image='user_profile.png';
		}

		$from_user_image=get_list_user_details($from_user);          
		if ($from_user_image->profile_image !='') {
			$from_user_image=$from_user_image->profile_image;
		}else{
			$from_user_image='user_profile.png';
		}


      	$where="(from_user_id='".$from_user."' AND to_user_id='".$session_id."')";
        $prev_sequence=$this->user_model->select_data('is_read','message',$where,1,array('id','DESC'));
        if ($prev_sequence) {
        	$read_msg=$prev_sequence[0]['is_read'];
        }else{
        	$read_msg='0';	
        }		

      	$is_read = array('is_read'=>'1');				
		$this->user_model->update_data('message',$is_read,array('from_user_id'=>$from_user,'to_user_id'=>$session_id));
				

      	$con="(from_user_id='".$session_id."' AND to_user_id='".$_POST['re_id']."') OR (from_user_id='".$_POST['re_id']."' AND to_user_id='".$session_id."')";
        $all_msg=$this->user_model->select_data('*','message',$con);
        echo '<input type="hidden" id="check_msg_read" value="'.$read_msg.'">';
        foreach($all_msg as $msg){
        if($msg['from_user_id']==$_POST['re_id']){  
        			$u_name=$this->user_model->select_data('first_name','user',array('id'=>$_POST['re_id']));
       				echo '<div class="row msg_container base_receive">
                        <!--<div class="col-sm-2 avatar">
                            <img src="'.$base_url.'assets/img/profile_image/'.$from_user_image.'" class=" img-responsive " style="height:50px;width:50px;">
                        </div>-->
                        <div class="col-md-12 col-sm-12">
                            <div class="messages msg_receive">
                                <p>'.$msg['message'].'</p>
                                <time datetime="'.$msg['created_on'].'">'.$u_name[0]['first_name'].' • '.date('M d Y h:i A', strtotime($msg['created_on'])).'</time>
                            </div>
                        </div>
                    </div>';

                        }else{
                          $u_name=$this->user_model->select_data('first_name','user',array('id'=>$session_id));

                    echo ' <div class="row msg_container base_sent">
                        <div class="col-sm-12 ">
                            <div class="messages msg_sent">
                                <p>'.$msg['message'].'</p>
                                <time datetime="'.$msg['created_on'].'">'.$u_name[0]['first_name'].' • '.date('M d Y h:i A', strtotime($msg['created_on'])).'</time>
                            </div>
                        </div>
                        <!--<div class="col-sm-2 avatar">
                            <img src="'.$base_url.'assets/img/profile_image/'.$to_user_image.'" class="img-responsive" style="height:50px;width:50px;">
                        </div>-->
                    </div>';
            }
        }
    }

    public function ins_msg(){
    	$session_id = $this->session->userdata('user_id');
        $msg_data = array(
                        'from_user_id'=>$session_id,
                        'to_user_id'=>$_POST['receiver_id'],
                        'message'=>$_POST['message'],
                        'created_on'=>date("Y-m-d H:i:s")
                        );

        // $con="(from_user_id='".$session_id."' AND to_user_id='".$_POST['receiver_id']."') OR (from_user_id='".$_POST['receiver_id']."' AND to_user_id='".$session_id."')";
        // $prev_sequence=$this->user_model->select_data('sequence','message',$con,1);

        // if(!empty($prev_sequence)){
        //     $msg_data['sequence']=$prev_sequence[0]['sequence']+1;
        // }else{
        //     $msg_data['sequence']=1;
        // }

    	echo $this->user_model->insert_data('message',$msg_data);
    }


    public function network(){
    	$is_login=$this->common_model->check_user_login();
    	if($is_login==FALSE){
    		redirect(base_url('sign-in'));
    	}
    	

		$session_id=$this->session->userdata('user_id');
		$data['user_details']=$this->user_action_model->select_data('first_name','user',array('id'=>$session_id),'','');
		 $data['selling_result']=$this->db->query("SELECT * FROM lists WHERE user_id='$session_id'")->result_array();
		
		$data['network']=true;
		$data['view_name'] = "user/network";
		$this->load->view('template', $data);

	}
	public function get_all_buying_list(){ 
  		$session_id=$this->session->userdata('user_id');
  		
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}  

        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}
      	

        	$data['network_info'] = $this->user_action_model->get_all_buying_details($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_buying_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/buying', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 
 	}
 	public function get_all_buying_won_list(){ 
  		$session_id=$this->session->userdata('user_id');
  		
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}        	

        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}

        	$data['network_info'] = $this->user_action_model->get_all_buying_won_details($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_buying_won_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/won', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 
 	}

 	public function get_all_watch_list_item(){ 
  		$session_id=$this->session->userdata('user_id');
  		
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}  
        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}
        	$data['network_info'] = $this->user_action_model->get_all_watchlist($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_watchlist_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/watchlist', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 
 	}


 	public function get_all_buying_notwon_list(){ 
  		$session_id=$this->session->userdata('user_id');
  		
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}  
        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}
        	$data['network_info'] = $this->user_action_model->get_all_buying_notwon_details($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_buying_notwon_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/notwon', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 
 	}

	public function get_all_selling_list(){ 
  		$session_id=$this->session->userdata('user_id');
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}

        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}
        	

        	$data['network_info'] = $this->user_action_model->get_all_selling_details($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_selling_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');
  			
  			$result1 =$this->load->view('user/network/selling', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}

 	public function get_all_schedule_list(){ 
  		$session_id=$this->session->userdata('user_id');
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}

        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}

        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}

        	$data['network_info'] = $this->user_action_model->get_schedule_list($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_schedule_list_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/schedule_list', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}


 	public function get_all_sold_list(){ 
  		$session_id=$this->session->userdata('user_id');
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}

        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}

        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}

        	$data['network_info'] = $this->user_action_model->get_sold_list($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_sold_list_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/sold_list', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}

 	public function get_all_unsold_list(){ 
  		$session_id=$this->session->userdata('user_id');
  			$data['network']=true;
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	$shortlist_item = 0;
        	if(isset($where['shortlist_item'])){
            	$shortlist_item = $where['shortlist_item'];
            	unset($where['shortlist_item']);
        	}

        	$order_by = 0;
        	if(isset($where['order_by'])){
            	$order_by = $where['order_by'];
            	unset($where['order_by']);
        	}

        	$data['network_info'] = $this->user_action_model->get_unsold_list($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_unsold_list_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/unsold_list', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}

	public function get_all_video(){ 
  		$session_id=$this->session->userdata('user_id');
  		
  			$where = $this->input->post(); 
  			
  			$limit = 0;
	        if(isset($where['limit'])){
	            $limit = $where['limit'];
	            $data['limit_paggination'] =$limit;
	            unset($where['limit']);
	        }

  			$view = '';
        	if(isset($where['view'])){
            	$view = $where['view'];
            	unset($where['view']);
        	}
        	$offset = 0;
        	if(isset($where['offset'])){
            	$offset = $where['offset'];
            	$data['offset_paggination'] =$offset;
            	unset($where['offset']);
        	}
        	
      	

        	$data['all_videos'] = $this->user_action_model->get_all_video($where,$view,$session_id,$limit,$offset); 
        	$data['pagination'] = $this->user_action_model->get_all_video_pagination($where,$view,$session_id,$limit,$offset); 

        	 $count_res = count($data['all_videos']);
	        $result2 = '';

	        if($count_res < $limit){
	            $result2 ="end";
	        }   


	        if($count_res == 0){
	            $result2 ="end";
	        }
	        //echo $result2;
        	//$data['all_videos']=$this->user_model->select_data('url','list_attachments',array('type'=>'video_url'));
     
  			$result1 =$this->load->view('user/network/video', $data,true);

  		$result = array($result1,$result2); 
        echo json_encode($result); 
 	}

 	public function relist_item(){ 
 		$list_id = $this->input->post('list_id'); 
 		$query = $this->user_model->select_data('*','lists',array('id'=>$list_id));
		$prev_data = json_encode($query);

		$end_auction = $query[0]['end_auction'];
		$duration_days = $query[0]['duration_days'];
		$relist_date = date("Y-m-d H:i:s", strtotime($end_auction. ' + '.$duration_days.' days'));
		$end_auctions = array('end_auction'=>$relist_date);			
		$result=$this->user_model->update_data('lists',$end_auctions,array('id'=>$list_id));
		if ($result) {
			$session_id=$this->session->userdata('user_id');
			$user_log = array(
                                    'user_id'=>$session_id,
                                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                    'previous_data'=>$prev_data,
                                    'action'=>'relist'
                                   );
                $this->user_model->insert_data('list_log',$user_log);

			echo "Success";
		}else{
			echo "failed";
		}

 	}

 	public function sold_bid(){ 
 		$list_id = $this->input->post('list_id'); 
 		$query = $this->user_model->select_data('*','lists',array('id'=>$list_id));
		$prev_data = json_encode($query);

	
		$is_sold = array('is_sold'=>'1','status'=>'sold');			
		$result=$this->user_model->update_data('lists',$is_sold,array('id'=>$list_id));
		if ($result) {
			$session_id=$this->session->userdata('user_id');
			$user_log = array(
                                    'user_id'=>$session_id,
                                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                    'previous_data'=>$prev_data,
                                    'action'=>'sold'
                                   );
                $this->user_model->insert_data('list_log',$user_log);

			echo "Success";
		}else{
			echo "failed";
		}

 	}

 	public function delete_selling_item(){ 
 		$list_id = $this->input->post('list_id'); 	
		$delete_update = array('is_deleted'=>'1');			
		$result=$this->user_model->update_data('lists',$delete_update,array('id'=>$list_id));
		if ($result) {
			echo "Success";
		}else{
			echo "error";
		}
 	}

 	public function delete_user_bid(){ 
 		$session_id=$this->session->userdata('user_id');
 		$list_id = $this->input->post('list_id'); 	


		$delete_update = array('is_deleted'=>'1');			
		$result=$this->user_model->update_data('bid',$delete_update,array('user_id'=>$session_id,'list_id'=>$list_id));
		if ($result) {
			echo "Success";
		}else{
			echo "error";
		}
 	}

 	public function delete_watchlist_item(){ 
 		$session_id=$this->session->userdata('user_id');
 		$watchlist_id = $this->input->post('watchlist_id'); 

		$delete_update = array('status'=>'0');			
		$result=$this->user_model->update_data('watchlist',$delete_update,array('id'=>$watchlist_id));
		if ($result) {
			echo "Success";
		}else{
			echo "error";
		}
 	}


	public function all_list_delete(){ 
 		$list_id = $this->input->post('list_id'); 
 		$total=count($list_id);
 		for ($i=0; $i < $total ; $i++) {  		
 			$delete_update = array('is_deleted'=>'1');			
		    $this->user_model->update_data('lists',$delete_update,array('id'=>$list_id[$i]));
 		}		
		echo "Success";		
 	}

	public function buynow_list(){ 
		error_reporting(0);
 		$list_id = $this->input->post('list_id'); 

 		  $thumb_image=get_thumb_image($list_id);

		if (!empty($thumb_image)) {
			$thumb_list_img = $thumb_image->url;
		}else{
			$thumb_list_img ='blank.jpg';
		}


 		$firearms_commission=$this->user_model->select_data('*','commission');
		$query = $this->user_model->select_data('*','lists',array('id'=>$list_id));

		$start_amount=$query[0]['buy_now_price'];
		$title=$query[0]['title'];
		$item_number=$query[0]['item_number'];
		$seller_id=$query[0]['user_id'];
	
	
        $amount=amount_with_commission($start_amount);

        $data['commission_amount'] = array('final_amount' => $amount);    
      	$data['list_details'] = array('list_details' => $query);

      	$prev_data=json_encode($data);
		$session_id=$this->session->userdata('user_id');
			$user_log = array(
                                    'user_id'=>$session_id,
                                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                    'previous_data'=>$prev_data,
                                    'action'=>'Buynow'
                                   );
            $this->user_model->insert_data('list_log',$user_log);
            
       
             //send mail to seller 
            $data['thumb_list_img']=$thumb_list_img;
            $data['commission_amount']=$amount;
           
            $data['list_info']=$this->user_model->select_data('*','lists',array('id'=>$list_id));
            $data['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$session_id));
            $data['seller_info']=$this->user_model->select_data('*','user',array('id'=>$seller_id));

			$subject_s='Congratulations You Sold Item #'.$item_number.'  ';
			$msg_s='Your list item has been sold successfully here is the item details ';

			$data['username']=$data['seller_info'][0]['first_name'];
			$seller_email_id=$data['seller_info'][0]['email_id'];			
			$this->common_model->send_email_seller($seller_email_id,$subject_s,$msg_s,$data);

			//send mail to buyer 
			$buyer_email_id=$data['buyer_info'][0]['email_id'];
			$datab['thumb_list_img']=$thumb_list_img;
            $datab['commission_amount']=$amount;
			$datab['username']=$data['buyer_info'][0]['first_name'];
		
			 $subject_b='Congratulations You Won Item #'.$item_number.'  ';
			
			$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$seller_id));

			$msg_b='You have won a item from firearms network here is the item details';
			$this->common_model->send_email_buyer($buyer_email_id,$subject_b,$msg_b,$datab);
        //mail end    

 		
		$buynow_update = array('is_sold'=>'1','status'=>'sold','buyer_id'=>$session_id,'is_sold_by'=>'buynow');			
		$result=$this->user_model->update_data('lists',$buynow_update,array('id'=>$list_id));
            $result='1';
		if ($result) {
			echo "Success";
		}else{
			echo "failed";
		}
			
 	}

 	public function all_bid_delete_from_bid(){ 
 		$bid_id = $this->input->post('bid_id'); 
 		$total=count($bid_id);
 		for ($i=0; $i < $total ; $i++) {  		
 			$delete_update = array('is_deleted'=>'1');			
		    $this->user_model->update_data('bid',$delete_update,array('id'=>$bid_id[$i]));
 		}		
		echo "Success";		
 	}

 	public function all_bid_delete(){ 
 		$session_id=$this->session->userdata('user_id');
 		$list_id = $this->input->post('list_id'); 
 		$total=count($list_id);
 		for ($i=0; $i < $total ; $i++) {  		
 			$delete_update = array('is_deleted'=>'1');			
		    $this->user_model->update_data('bid',$delete_update,array('list_id'=>$list_id[$i],'user_id'=>$session_id));
 		}		
		echo "Success";		
 	}

 	public function user_bid($list_id=''){
		$session_id=$this->session->userdata('user_id');
		$data['user_details']=$this->user_action_model->select_data('first_name','user',array('id'=>$session_id),'','');	
		$data['bid_details']=$this->user_action_model->bid_details($list_id);	
		$data['view_name'] = "user/bid";
		$this->load->view('template', $data);
	}


    function show_bid()
    {
        $perPage = 10;
        $list_id = $_POST['list_id'];
        $start_index = $_POST['page'];
           
        $query = $this->db->query("SELECT bid.id,bid.user_id,bid.list_id,bid.bid_amount,bid.is_won,bid.is_sold,bid.is_deleted,lists.title,lists.starting_bid,lists.status,lists.is_sold as list_sold,lists.is_sold_by,user.first_name,user.phone FROM `bid` LEFT JOIN lists ON lists.id=bid.list_id LEFT JOIN user ON user.id = bid.user_id    WHERE bid.`list_id` = $list_id AND bid.is_deleted='0' GROUP BY bid.id ORDER BY bid.created_on DESC LIMIT ".$start_index.",".$perPage); 
        //echo  $this->db->last_query();

        $no_of_rows = $query->row_array();
        if($no_of_rows > 0)
        {  
    
            foreach ($query->result() as $row) { 

            	$first_name = $row->first_name;
            	$bid_amount = $row->bid_amount;
            	$list_id = $row->list_id;
            	$status = $row->status;
            	$is_sold = $row->is_sold;
            	$is_won = $row->is_won;
         		$bider_id=$row->user_id;
				$bid_id=$row->id;
				$is_sold_by=$row->is_sold_by;
				

				if ($is_sold=='1') {
					$diplaycls="disabled";
				}else{
					$diplaycls="";
				}

				if ($status=='sold') {

					if ($is_sold_by=='buynow') {
						$disable_cls="disabled";
						$opacity="0.4";
						$accept_btn='<button type="button" class="accept_btn" disabled style="opacity:0.4;">Accept</button>';
						$status_val='Failed';

					}else{
						$disable_cls="disabled";
						$opacity="0.4";
						if ($is_won=='1') {
						$accept_btn='<button type="button" class="cancel_btn"  onclick="cancel_request('.$bid_id.','.$list_id.');" '.$diplaycls.'>Cancel</button>';
						$status_val='Won';
						}else{

							$accept_btn='<button type="button" class="accept_btn"  onclick="reaccept_request('.$bid_id.','.$list_id.','.$bider_id.');" '.$diplaycls.'>Accept</button>';
							$status_val='Failed';						
						}	
					}
				

				}else{
					$accept_btn='<button type="button" class="accept_btn"  onclick="accept_request('.$bid_id.','.$list_id.','.$bider_id.');" '.$diplaycls.'>Accept</button>';
					$status_val='Waiting';
					$disable_cls="";
					$opacity="";
				}


				

          echo '<tr>
                <td>
                  <figure class="media">
                    <input name="chk_bid_id" class="chk_bid_id" type="checkbox" value="'.$bid_id.'" >
                    <figcaption class="media-body">
                      <h6 class="title text-truncate"></h6>
                    </figcaption>
                  </figure> 
                </td>               
                <td> 
                  <div class="price-wrap"> 
                    <p class="text-left">'.$first_name.'</p>                     
                  </div> 
                </td>
                <td>'.$bid_amount.'</td>      
                <td>'.$status_val.'</td>        
                <td class="text-right ">'.$accept_btn.'
                  <button type="button" class="delete_btn" '.$disable_cls.' onclick="delete_request('.$bid_id.');" '.$diplaycls.' style="opacity:'.$opacity.'">Delete</button>

                </td>
             </tr>'; 

         }
        } 
        else
            echo "<tr><td colspan='6'><span class='nodata text-center'>No Records Found</span></td></tr>";               
    }

     public function bid_page_count()
    {       
        $list_id = $_POST['list_id'];
        $page_id = $_POST['page_id'];
                    
        $table = 'bid';
       
        
        $where = " list_id ='$list_id' AND is_deleted='0'";
        $per_page = 10;
        $query ="SELECT count(id) as 'id' FROM  ".$table." where ".$where;
        $query = $this->db->query($query);     
        $row = $query->row_array();     
     
        $foundnum =$row['id'];
        $count = (int)($row['id']/$per_page);
        $rem=($row['id']%$per_page);
        $id =$row['id'];
         
        if($rem>0)
        {   
            $count++;
        }
        $start = $page_id;
        $max_pages = $count;
        $prev = $start - $per_page;
        $next = $start + $per_page;
        $adjacents = 10;
        $last = $max_pages - 1;
        
        if($max_pages > 1)
        {   
            //previous button
            if (!($start<=0)){
             echo " <li><a href='javascript:paging($list_id,$prev)'>Prev</a> </li>";    
            }
            //pages 
            if ($max_pages > 1 )   //not enough pages to bother breaking it up
            {               
                $i = 0;   
                for ($counter = 1; $counter <= $max_pages; $counter++)
                {
                    if ($i == $start)
                    {
                        echo " <li  class='active'><a href='javascript:paging($list_id,$i)'><b>$counter</b></a></li> ";
                    }
                    else
                    {
                        echo " <li><a href='javascript:paging($list_id,$i)'>$counter</a></li> ";
                    }  
                    $i = $i + $per_page;                 
                }
            }
            elseif($max_pages > 10 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if(($start/$per_page) < 1 + ($adjacents * 2))        
                {
                    $i = 0;
                    for ($counter = 1; $counter < 10 + ($adjacents * 2); $counter++)
                    {
                        if ($i == $start)
                        {
                            echo " <li  class='active'><a href='javascript:paging($list_id,$i)'>$counter</a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:paging($list_id,$i)'>$counter</a></li> ";
                        } 
                        $i = $i + $per_page;              
                    }
                }
                //in middle; hide some front and some back
                elseif($max_pages - ($adjacents * 2) > ($start / $per_page) && ($start / $per_page) > ($adjacents * 2))
                {
                    $i = $start;                 
                    for ($counter = ($start/$per_page)+1; $counter < ($start / $per_page) + $adjacents + 2; $counter++)
                    {
                        if ($i == $start)
                        {
                            echo " <li   class='active'><a href='javascript:paging($list_id,$i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:paging($list_id,$i)'>$counter</a></li> ";
                        }   
                        $i = $i + $per_page;                
                    }
                }
                //close to end; only hide early pages
                else
                {
                    $i = $start;                
                    for ($counter = ($start / $per_page) + 1; $counter <= $max_pages; $counter++)
                    {
                        if ($i == $start)
                        {
                            echo " <li class='active'><a href='javascript:paging($list_id,$i)'><b>$counter</b></a></li> ";
                        }
                        else
                        {
                            echo " <li><a href='javascript:paging($list_id,$i)'>$counter</a> </li>";   
                        } 
                        $i = $i + $per_page;              
                    }
                }
            }
            //next button
            if (!($start >=$foundnum-$per_page))
            echo " <li><a href='javascript:paging($list_id,$next)'>Next</a></li> ";    
        }   

    }
    
    public function bid_delete(){  		
		$delete_id = $this->input->post('id'); 	
		$delete_update = array('is_deleted'=>'1');			
		$result=$this->user_model->update_data('bid',$delete_update,array('id'=>$delete_id));
		if ($result) {
			echo "Success";
		}else{
			echo "error";
		}
    }

    public function bid_accept(){  		
		$bid_id = $this->input->post('id'); 	
		$list_id = $this->input->post('list_id'); 
		$bider_id = $this->input->post('bider_id'); 

		$thumb_image=get_thumb_image($list_id);

		if (!empty($thumb_image)) {
			$thumb_list_img = $thumb_image->url;
		}else{
			$thumb_list_img ='blank.jpg';
		}

		$query = $this->user_model->select_data('*','lists',array('id'=>$list_id));
		$item_number=$query[0]['item_number'];
		$prev_data = json_encode($query);


		$bid_qry = $this->user_model->select_data('bid_amount','bid',array('id'=>$bid_id));
		$bid_amount=$bid_qry[0]['bid_amount'];

		$status = array('status'=>'sold','is_sold_by'=>'bid','is_sold'=>1,'buyer_id'=>$bider_id);			
		$this->user_model->update_data('lists',$status,array('id'=>$list_id));

			


		$accept_bid_update = array('is_won'=>'1');			
		$result=$this->user_model->update_data('bid',$accept_bid_update,array('id'=>$bid_id));
		if (true) {
			$session_id=$this->session->userdata('user_id');
			$user_log = array(
                                    'user_id'=>$session_id,
                                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                    'previous_data'=>$prev_data,
                                    'action'=>'bid_accept'
                                   );
                $this->user_model->insert_data('list_log',$user_log);

                //send mail to seller

            $data['thumb_list_img']=$thumb_list_img;
            $data['commission_amount']=$bid_amount;
           
        $data['list_info']=$this->user_model->select_data('*','lists',array('id'=>$list_id));
        $data['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$bider_id));
        $data['seller_info']=$this->user_model->select_data('*','user',array('id'=>$session_id));

			$subject_s='Congratulations You Sold Item #'.$item_number.'  ';
			$msg_s='Your list item has been sold successfully here is the item details ';

			$data['username']=$data['seller_info'][0]['first_name'];
			$seller_email_id=$data['seller_info'][0]['email_id'];			
			$this->common_model->send_email_seller($seller_email_id,$subject_s,$msg_s,$data);


			//send mail to buyer 
			$buyer_email_id=$data['buyer_info'][0]['email_id'];
			$datab['thumb_list_img']=$thumb_list_img;
            $datab['commission_amount']=$bid_amount;
			$datab['username']=$data['buyer_info'][0]['first_name'];
		
			$subject_b='Congratulations You Won Item #'.$item_number.'  ';
			
			$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$session_id));

			$msg_b='You have won a item from firearms network here is the item details';
			$this->common_model->send_email_buyer($buyer_email_id,$subject_b,$msg_b,$datab);

			echo "Success";
		}else{
			echo "error";
		}
    }

    public function bid_cancel(){  		
		$bid_id = $this->input->post('id'); 	
		$list_id = $this->input->post('list_id'); 

		$status = array('status'=>'','buyer_id'=>'','is_sold_by'=>'');			
		$this->user_model->update_data('lists',$status,array('id'=>$list_id));

		$accept_bid_update = array('is_won'=>'0');			
		$result=$this->user_model->update_data('bid',$accept_bid_update,array('id'=>$bid_id));
		if ($result) {
			echo "Success";
		}else{
			echo "error";
		}
    }

    public function bid_reaccept(){  		
		$bid_id = $this->input->post('id'); 	
		$list_id = $this->input->post('list_id'); 
		$bider_id = $this->input->post('bider_id');

		$bider_info = array('buyer_id'=>$bider_id);			
		$this->user_model->update_data('lists',$bider_info,array('id'=>$list_id));

		$status = array('is_won'=>'0');			
		$this->user_model->update_data('bid',$status,array('list_id'=>$list_id));

		$accept_bid_update = array('is_won'=>'1');			
		$result=$this->user_model->update_data('bid',$accept_bid_update,array('id'=>$bid_id));
		if ($result) {
			echo "Success";
		}else{
			echo "error";
		}
    }

    public function msg(){

		$session_id = $this->session->userdata('user_id');
		$con = 'id != "'.$session_id.'"';
		$con .= ' AND id != 1';
    	$data['all_users']=$this->user_model->select_data('id,first_name','user',$con);
    	$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));
    	$data['chat_users']=$this->user_model->select_data('distinct(to_user_id)','message',array('from_user_id'=>$session_id),'',array('id','DESC'));
    	$data['view_name']    = "user/message_demo";
		$this->load->view('template', $data);
    }

    public function message(){

    	$is_login=$this->common_model->check_user_login();
    	if($is_login==FALSE){
    		redirect(base_url('sign-in'));
    	}    	

    	$session_id = $this->session->userdata('user_id');
		$con = 'id != "'.$session_id.'"';
		$con .= ' AND id != 1';
		$data['all_users']=$this->user_model->select_data('id,first_name','user',$con);
		$data['user_details']=$this->user_action_model->select_data('first_name,profile_image','user',array('id'=>$session_id),'','');	
		$data['chat_users']=$this->user_model->get_user_contacts($session_id);

		// echo $this->db->last_query();
		 // echo "<pre>";
		 // print_r($data['chat_users']);die;
	
		$data['message']=true;
		$data['view_name'] = "user/message";
		$this->load->view('template', $data);

	}

  public function get_all_fixed_selling_list(){ 
    $session_id=$this->session->userdata('user_id');
    $data['network']=true;
    $where = $this->input->post(); 
        $dataType = 2;
        if(isset($where['dataType']))
        {
          $dataType = $where['dataType'];
          unset($where['dataType']);
        }

      $limit = 0;
      if(isset($where['limit'])){
          $limit = $where['limit'];
          $data['limit_paggination'] =$limit;
          unset($where['limit']);
      }

      $view = '';
      if(isset($where['view'])){
          $view = $where['view'];
          unset($where['view']);
      }
      $offset = 0;
      if(isset($where['offset'])){
          $offset = $where['offset'];
          $data['offset_paggination'] =$offset;
          unset($where['offset']);
      }
      $shortlist_item = 0;
      if(isset($where['shortlist_item'])){
          $shortlist_item = $where['shortlist_item'];
          unset($where['shortlist_item']);
      }

      $order_by = 0;
      if(isset($where['order_by'])){
          $order_by = $where['order_by'];
          unset($where['order_by']);
      }          

      $data['network_info'] = $this->user_action_model->get_all_fixed_selling_details($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
      $data['pagination'] =$this->user_action_model->get_all_fixed_selling_pagination($dataType,$where,$view,$session_id,$limit,$offset);
      $data['firearms_commission']=$this->user_model->select_data('*','commission');        
      $result1 =$this->load->view('user/network/seller_fixed_all', $data,true);
      $result = array($result1); 
      echo json_encode($result); 
  }
  public function get_all_fixed_schedule_list(){ 
      $session_id=$this->session->userdata('user_id');
        $data['network']=true;
        $where = $this->input->post(); 
        
        $dataType = 2;
        if(isset($where['dataType']))
        {
          $dataType = $where['dataType'];
          unset($where['dataType']);
        }

        $limit = 0;
          if(isset($where['limit'])){
              $limit = $where['limit'];
              $data['limit_paggination'] =$limit;
              unset($where['limit']);
          }

        $view = '';
          if(isset($where['view'])){
              $view = $where['view'];
              unset($where['view']);
          }
          $offset = 0;
          if(isset($where['offset'])){
              $offset = $where['offset'];
              $data['offset_paggination'] =$offset;
              unset($where['offset']);
          }

          $shortlist_item = 0;
          if(isset($where['shortlist_item'])){
              $shortlist_item = $where['shortlist_item'];
              unset($where['shortlist_item']);
          }

          $order_by = 0;
          if(isset($where['order_by'])){
              $order_by = $where['order_by'];
              unset($where['order_by']);
          }

          $data['network_info'] = $this->user_action_model->get_fixed_schedule_list($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
          $data['pagination'] = $this->user_action_model->get_fixed_schedule_list_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
          $data['firearms_commission']=$this->user_model->select_data('*','commission');

        $result1 =$this->load->view('user/network/schedule_fixed_list', $data,true);

      $result = array($result1); 
        echo json_encode($result); 
  }
  public function get_all_fixed_sold_list(){ 
      $session_id=$this->session->userdata('user_id');
        $data['network']=true;
        $where = $this->input->post(); 
        
        $dataType = 2;
        if(isset($where['dataType']))
        {
          $dataType = $where['dataType'];
          unset($where['dataType']);
        }

        $limit = 0;
          if(isset($where['limit'])){
              $limit = $where['limit'];
              $data['limit_paggination'] =$limit;
              unset($where['limit']);
          }

        $view = '';
          if(isset($where['view'])){
              $view = $where['view'];
              unset($where['view']);
          }
          $offset = 0;
          if(isset($where['offset'])){
              $offset = $where['offset'];
              $data['offset_paggination'] =$offset;
              unset($where['offset']);
          }

          $shortlist_item = 0;
          if(isset($where['shortlist_item'])){
              $shortlist_item = $where['shortlist_item'];
              unset($where['shortlist_item']);
          }

          $order_by = 0;
          if(isset($where['order_by'])){
              $order_by = $where['order_by'];
              unset($where['order_by']);
          }

          $data['network_info'] = $this->user_action_model->get_fixed_sold_list($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
          $data['pagination'] = $this->user_action_model->get_fixed_sold_list_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
          $data['firearms_commission']=$this->user_model->select_data('*','commission');

        $result1 =$this->load->view('user/network/sold_fixed_list', $data,true);

      $result = array($result1); 
      echo json_encode($result); 
  }

  public function get_all_fixed_unsold_list(){ 
      $session_id=$this->session->userdata('user_id');
        $data['network']=true;
        $where = $this->input->post(); 
        
        $dataType = 2;
        if(isset($where['dataType']))
        {
          $dataType = $where['dataType'];
          unset($where['dataType']);
        }

        $limit = 0;
          if(isset($where['limit'])){
              $limit = $where['limit'];
              $data['limit_paggination'] =$limit;
              unset($where['limit']);
          }

        $view = '';
          if(isset($where['view'])){
              $view = $where['view'];
              unset($where['view']);
          }
          $offset = 0;
          if(isset($where['offset'])){
              $offset = $where['offset'];
              $data['offset_paggination'] =$offset;
              unset($where['offset']);
          }
          $shortlist_item = 0;
          if(isset($where['shortlist_item'])){
              $shortlist_item = $where['shortlist_item'];
              unset($where['shortlist_item']);
          }

          $order_by = 0;
          if(isset($where['order_by'])){
              $order_by = $where['order_by'];
              unset($where['order_by']);
          }

          $data['network_info'] = $this->user_action_model->get_fixed_unsold_list($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
          $data['pagination'] = $this->user_action_model->get_fixed_unsold_list_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
          $data['firearms_commission']=$this->user_model->select_data('*','commission');

        $result1 =$this->load->view('user/network/unsold_fixed_list', $data,true);

      $result = array($result1); 
        echo json_encode($result); 

  }















    public function test_user(){  

    $list_id='72';
	$data['listings']=$this->user_model->select_data('*','lists',array('id'=>$list_id),'','');
echo "<pre>";
print_r($data);
//     $all_users=$this->user_model->select_data('id,title,end_auction','lists','');

//     echo "<pre>";
//   //  print_r($all_users);

//     foreach ($all_users as $value) {

//     	echo $value['id'];
//     	echo "<br>";
//     	echo $value['title'];
//     	echo "<br>";
//     	echo $end_auction= $value['end_auction'];
//     	echo "<br>";

//     	$add_days="30";
// echo $newdate= date("Y-m-d H:i:s", strtotime($end_auction. ' + '.$add_days.' days'));
//     	echo "<br>";

//     	$step_update = array('end_auction'=>$newdate);			
// 					$qry=$this->user_model->update_data('lists',$step_update,array('id'=>$value['id']));
//     }
// 		die();    	
    }


}