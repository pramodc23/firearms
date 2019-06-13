	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('user_model');
		$this->load->model('common_model');
		$this->load->library('email');
	}

	public function index()
	{	
		$today_date= date("Y-m-d H:i:s");
		$user_liked_data = array();
		if($this->session->userdata('isLoggedIn')){
			$session_id=$this->session->userdata('user_id');
			$user_liked_data_arr=$this->db->query("SELECT list_id from likes where like_status=1 and user_id = $session_id");
			if($user_liked_data_arr->num_rows() > 0){
				foreach ($user_liked_data_arr->result_array() as $row_data) {
					$user_liked_data[]=$row_data['list_id'];
				}
			}
			
		}
		$data['user_liked_data'] = $user_liked_data;
		//print_r($user_liked_data);

		$data['listings']=$this->db->query("SELECT id,title,slug,buy_now_price,primary_picture,end_auction FROM lists WHERE end_auction > '$today_date' AND status='' AND is_admin_deleted=0 AND is_deleted=0 ORDER BY end_auction ASC LIMIT 12")->result_array();

		$data['most_popular']=$this->db->query("SELECT lists.id,lists.title,lists.slug,lists.buy_now_price,lists.primary_picture,lists.end_auction,bid.bid_amount ,COUNT(bid.bid_amount) as total_bid  FROM lists  JOIN bid ON lists.id=bid.list_id WHERE lists.end_auction > '$today_date' AND  lists.status ='' AND lists.is_admin_deleted=0 AND lists.is_deleted=0 GROUP BY lists.id ORDER BY COUNT(bid.bid_amount) DESC LIMIT 12")->result_array();
		

		$data['categories']=$this->user_model->select_category('id,name,slug','categories',array('parent_id'=>0,'status'=>1),'sort_by desc,name');
		$data['view_name']    = "front/home";
		$this->load->view('template', $data);
	}

	public function sign_up()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
			$data['view_name']    = "front/sign_up";
			$this->load->view('template', $data);
		}
		else{
			redirect(base_url());
		}
	}

	public function sign_in($list='')
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
			if($list!=''){
				if($list=='home'){
					$data['like']=true;
				}else if($list=='buy'){
					$data['buy_like']=true;
				}else{
					$data['list_page']=$list;
				}
			}
			$data['sign_in']=true;
			$data['view_name']    = "front/sign_in";
			$this->load->view('template', $data);
		}
		else{
			redirect(base_url());
		}
	}
	
	public function forgot_password()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
			$data['view_name']    = "front/forgot_password";
			$this->load->view('template', $data);
		}
		else{
			redirect(base_url());
		}
	}

	public function contact_us()
	{
		$data['view_name']    = "front/contact_us";
		$this->load->view('template', $data);
	}


	public function contact_us_submit(){

		
		if($_FILES['userfile1']['name'] !=''){ 
			$img_result=$this->uploadFile('userfile1'); 
		}else{
			$img_result='';
		}


		$contact_info = array(                       
			'selectbasic'=>$_POST['selectbasic'], 
			'email'=>trim($_POST['email']),
			'subject'=>trim($_POST['subject']),
			'message'=>trim($_POST['message']),
			'userfile'=>$img_result
		);
		$result=$this->user_model->insert_data('contact_us',$contact_info);

		
		if ($result) {

			$subject='Admin, Contact Information';
			$data['heading']='Contact Information ';
			$data['name']='Admin';
			$data['selectbasic']=$_POST['selectbasic'];
			$data['message']=trim($_POST['message']);
			$data['contactus_email']=trim($_POST['email']);
			$data['subject']=trim($_POST['subject']);           
			$msg['data']=$data;
			$email=trim($_POST['email']);
            //$this->send_email_new($email,$subject,$msg);
			$check_email=$this->common_model->contact_us_mail($email,$subject,$msg);


			echo 1;

			

		}else{
			echo 0;
		}
		
	}


	
	public function faq()
	{
		$data['view_name']    = "front/faq";
		$this->load->view('template', $data);
	}

	public function about_us()
	{
		$data['about_us']=true;
		$data['view_name']    = "front/about_us";
		$this->load->view('template', $data);
	}

	public function site_map()
	{
		$data['view_name']    = "front/site_map";
		$this->load->view('template', $data);
	}

	public function support()
	{
		$data['view_name']    = "front/support";
		$this->load->view('template', $data);
	}

	// public function network()
	// {
	// 	$session_id=$this->session->userdata('user_id');
	// 	$data['user_details']=$this->user_model->select_data('first_name','user',array('id'=>$session_id),'','');
	// 	 $data['selling_result']=$this->db->query("SELECT * FROM lists WHERE user_id='$session_id'")->result_array();
	
	// 	$data['network']=true;
	// 	$data['view_name'] = "front/network";
	// 	$this->load->view('template', $data);

	// }
	// public function get_network(){ 
 //  		$session_id=$this->session->userdata('user_id');
 //  			$data['network']=true;
 //  			$where = $this->input->post(); 
	
 //  			$limit = 0;
	//         if(isset($where['limit'])){
	//             $limit = $where['limit'];
	//             $data['limit_paggination'] =$limit;
	//             unset($where['limit']);
	//         }

 //  			$view = '';
 //        	if(isset($where['view'])){
 //            	$view = $where['view'];
 //            	unset($where['view']);
 //        	}
 //        	$offset = 0;
 //        	if(isset($where['offset'])){
 //            	$offset = $where['offset'];
 //            	$data['offset_paggination'] =$offset;
 //            	unset($where['offset']);
 //        	}

 //        	$data['network_info'] = $this->user_model->get_network_details($where,$view,$session_id,$limit,$offset); 
 //        	$data['pagination'] = $this->user_model->get_pagination_details($where,$view,$session_id,$limit,$offset); 

 //  			$result1 =$this->load->view('front/network/selling', $data,true);

 //  		$result = array($result1); 
 //        echo json_encode($result); 

 // 	}

 // 	public function bid($list_id='')
	// {

	// 	$session_id=$this->session->userdata('user_id');
	// 	$data['user_details']=$this->user_model->select_data('first_name','user',array('id'=>$session_id),'','');
	
	// 	$data['bid_details']=$this->user_model->bid_details($list_id);

	// 	$data['view_name'] = "front/bid";
	// 	$this->load->view('template', $data);

	// }

	

	public function category()
	{
		$data['view_name']    = "front/category";
		$this->load->view('template', $data);
	}

	public function learn_more()
	{
		$data['view_name']    = "front/learn_more";
		$this->load->view('template', $data);
	}

	public function buy_old($seller_id='',$cat_id='')
	{
		if(isset($_GET['search'])){
			$cate = $this->user_model->select_data('id','categories',"name LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' AND status=1");

			if($this->session->userdata('isLoggedIn')){
				$session_id=$this->session->userdata('user_id');
				if(!empty($cate)){
					$data['listings'] = $this->user_model->leftjoin_data('lists.id,title,slug,starting_bid,primary_picture,end_auction,like_status','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' OR categories=".$cate[0]['id']." AND is_active=1",array('likes','lists.id=likes.list_id'));
				}else{
					$data['listings'] = $this->user_model->leftjoin_data('lists.id,title,slug,starting_bid,like_status,primary_picture,end_auction','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' AND is_active=1",array('likes','lists.id=likes.list_id'));
				}
			}else{
				if(!empty($cate)){
					$data['listings'] = $this->user_model->select_data('id,title,slug,starting_bid,primary_picture,end_auction','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' OR categories=".$cate[0]['id']." AND is_active=1");
				}else{
					$data['listings'] = $this->user_model->select_data('id,title,slug,starting_bid,primary_picture,end_auction','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' AND is_active=1");
				}
			}
		}else{
			$con = array('is_active'=>1);

			if($seller_id==''){

				if(isset($_POST['s_category']) && $_POST['s_category']!=''){
					$con['categories']=$_POST['s_category'];
				}
				if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']!=''){
					$con['item_condition']=$_POST['s_item_condition'];
				}

				if(isset($_POST['s_price'])){
					$price=str_replace("$","",$_POST['s_price']);
					$both_prices=explode("-",$price);
					$con['starting_bid >=']=(int)trim($both_prices[0]);
					$con['starting_bid <='] =(int)trim($both_prices[1]);
				}
			}else{

				if ($cat_id) {
					$con['categories']=$cat_id;		
					$data['categories_selected']=$cat_id;				
				}else{
					$selr_id=explode('_',$seller_id);
					$con['lists.user_id']=$selr_id[1];	
				}	
				
			}

			if($this->session->userdata('isLoggedIn')){
				$session_id=$this->session->userdata('user_id');
				$data['listings']=$this->user_model->leftjoin_data('lists.id,title,starting_bid,slug,buy_now_price,primary_picture,like_status,end_auction','lists',$con,array('likes','lists.id=likes.list_id'));
			}else{
				$data['listings']=$this->user_model->select_data('id,title,slug,starting_bid,primary_picture,end_auction','lists',$con,'',array('id','DESC'));
			}	

		}
		$data['max_bid']=$this->user_model->aggregate_data('lists','starting_bid','Max');
		$data['min_bid']=$this->user_model->aggregate_data('lists','starting_bid','Min');
		$data['buy']=true;
		$data['firearms_commission']=$this->user_model->select_data('*','commission');
		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0),'',array('index','ASC'));
		$data['view_name']    = "front/buy_old";
		$this->load->view('template', $data);
	}


	public function buy($seller_id='',$cat_id='')
	{
		if(isset($_GET['search'])){



			$cate = $this->user_model->select_data('id','categories',"name LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' AND status=1");

			if($this->session->userdata('isLoggedIn')){
				$session_id=$this->session->userdata('user_id');
				if(!empty($cate)){
					$data['listings'] = $this->user_model->leftjoin_data('lists.id,title,slug,starting_bid,primary_picture,end_auction,like_status','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' OR categories=".$cate[0]['id']." AND is_active=1",array('likes','lists.id=likes.list_id'));
				}else{
					$data['listings'] = $this->user_model->leftjoin_data('lists.id,title,slug,starting_bid,like_status,primary_picture,end_auction','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' AND is_active=1",array('likes','lists.id=likes.list_id'));
				}
			}else{
				if(!empty($cate)){
					$data['listings'] = $this->user_model->select_data('id,title,slug,starting_bid,primary_picture,end_auction','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' OR categories=".$cate[0]['id']." AND is_active=1");
				}else{
					$data['listings'] = $this->user_model->select_data('id,title,slug,starting_bid,primary_picture,end_auction','lists',"title LIKE '%".$_GET['search']."%' OR slug  LIKE '%".$_GET['search']."%' AND is_active=1");
				}
			}
		}else{
			$con = array('is_active'=>1);

			if($seller_id==''){

				if(isset($_POST['s_category']) && $_POST['s_category']!=''){
					$con['categories']=$_POST['s_category'];
				}
				if(isset($_POST['s_item_condition']) && $_POST['s_item_condition']!=''){
					$con['item_condition']=$_POST['s_item_condition'];
				}

				if(isset($_POST['s_price'])){
					$price=str_replace("$","",$_POST['s_price']);
					$both_prices=explode("-",$price);
					$con['starting_bid >=']=(int)trim($both_prices[0]);
					$con['starting_bid <='] =(int)trim($both_prices[1]);
				}			

			}else{
				
				if ($cat_id) {
					$con['categories']=$cat_id;		
					$data['categories_selected']=$cat_id;	
					$data['menu_categories']=$cat_id;					
				}else{
					$selr_id=explode('_',$seller_id);
					//print_r($selr_id);
					if ($selr_id[0]=='seller') {
						$data['seller_id']=$selr_id[1];	
					}elseif ($selr_id[0]=='catid') {
						$data['catid']=$selr_id[1];	
					}				
				}					
			}

			if($this->session->userdata('isLoggedIn')){
				$session_id=$this->session->userdata('user_id');
				$data['listings']=$this->user_model->leftjoin_data('lists.id,title,starting_bid,slug,buy_now_price,primary_picture,like_status,end_auction','lists',$con,array('likes','lists.id=likes.list_id'));
			}else{
				$data['listings']=$this->user_model->select_data('id,title,slug,starting_bid,primary_picture,end_auction','lists',$con,'',array('id','DESC'));
			}	

		}
	//echo $this->db->last_query();
		$data['max_bid']=$this->user_model->aggregate_data('lists','starting_bid','Max');
		$data['min_bid']=$this->user_model->aggregate_data('lists','starting_bid','Min');
		$data['buy']=true;
		$data['firearms_commission']=$this->user_model->select_data('*','commission');
		//$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0),'',array('index','ASC'));
		$data['categories'] = $this->user_model->select_category('id,name,slug','categories',array('parent_id'=>0,'status'=>1),'sort_by desc,name');
		$data['view_name']    = "front/buy";
	// print_r($data);exit;				

		$this->load->view('template', $data);

	}

	public function get_buy_list_item(){ 
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
		$seller_id='';
		if(isset($where['seller_id'])){
			$seller_id = $where['seller_id'];
			unset($where['seller_id']);
		}

		$cat_id='';
		if(isset($where['cat_id'])){
			$cat_id = $where['cat_id'];
			unset($where['cat_id']);
		}
		

		$categories='';
		if(isset($where['categories'])){
			$categories = $where['categories'];
			unset($where['categories']);
		}

		$amount='';
		if(isset($where['amount'])){
			$amount = $where['amount'];
			unset($where['amount']);
		}

		$search_text='';
		if(isset($where['search_text'])){
			$search_text = $where['search_text'];
			unset($where['search_text']);
		}

		
		$sorting='';
		if(isset($where['sorting'])){
			$sorting = $where['sorting'];
			unset($where['sorting']);
		}

		$item_condition='';
		if(isset($where['item_condition'])){
			$item_condition = $where['item_condition'];
			unset($where['item_condition']);
		}
		$data['listings'] = $this->user_model->get_buy_item($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by,$seller_id,$cat_id,$categories,$amount,$sorting,$item_condition,$search_text);	
		$result6=	$this->db->last_query();
		$data['pagination'] = $this->user_model->get_buy_item_pagination($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by,$seller_id,$cat_id,$categories,$amount,$sorting,$item_condition,$search_text); 
		$result5 = $data['pagination']->total;
		//$result5=$qry1;
		$count_res = count($data['listings']);
		$result1 =$this->load->view('front/buy_grid_view', $data,true);
		$result2 =$this->load->view('front/buy_list_view', $data,true);
		
		if($count_res == 0){	        	
			$result3 ="end";
		}else{
			$result3 = '';
		}
		$result4='';	       

		$result = array($result1,$result2,$result3,$result4,$result5,$result6); 
		echo json_encode($result); 
	}

	public function resources()
	{
		$data['resources']=true;
		$data['view_name']    = "front/resources";
		$this->load->view('template', $data);
	}

	public function list_details($slug)
	{
		$l_details=$this->user_model->select_data('lists.*,categories.name','lists',array('lists.slug'=>$slug),'','','',array('categories','lists.categories=categories.id'));
		$data['bids']=$this->user_model->select_data('bid_amount','bid',array('list_id'=>$l_details[0]['id']),'',array('bid_amount','ASC'));

		$data['list_video']=$this->user_model->select_data('url','list_attachments',array('list_id'=>$l_details[0]['id'],'type'=>'vimeo_id'),'',array('id','ASC'));

		if($this->session->userdata('isLoggedIn')){
			$session_id=$this->session->userdata('user_id');
			$data['listings']=$this->user_model->leftjoin_data('lists.id,title,slug,buy_now_price,primary_picture,like_status,end_auction','lists',array('categories'=>$l_details[0]['categories'],'lists.id !='=>$l_details[0]['id'],'is_active'=>1),array('likes','lists.id=likes.list_id'));
			// echo $this->db->last_query();
			// die();
		}else{
			$data['listings']=$this->user_model->select_data('id,title,slug,buy_now_price,primary_picture,end_auction','lists',array('categories'=>$l_details[0]['categories'],'id !='=>$l_details[0]['id'],'is_active'=>1),'',array('id','DESC'));
			// 	echo $this->db->last_query();
			// die();
		}
		
		$data['photos']=$this->user_model->select_data('url','list_attachments',array('list_id'=>$l_details[0]['id'],'type'=>'photo'));
		if($this->session->userdata('isLoggedIn')){
			$session_id=$this->session->userdata('user_id');
			$data['follower']=$this->user_model->select_data('status','followers',array('follower_user_id'=>$session_id,'following_user_id'=>$l_details[0]['user_id']));

			$data['watchlist']=$this->user_model->select_data('status','watchlist',array('user_id'=>$session_id,'list_id'=>$l_details[0]['id']));
		}	
		//$data['firearms_commission']=$this->user_model->select_data('*','commission');
		$data['list_details']=$l_details;
		$data['view_name']    = "front/list_details";
		$this->load->view('template', $data);
		
	}

	

	public function cart()
	{
		$data['view_name']    = "user/cart";
		$this->load->view('template', $data);
	}

	public function checkout()
	{
		$data['view_name']    = "user/checkout";
		$this->load->view('template', $data);
	}

	public function list_an_item()
	{
		$data['view_name']    = "user/list_an_item";
		$this->load->view('template', $data);
		
	}

	public function list_item_dev()
	{
		$data['view_name']    = "user/list_item_dev";
		$this->load->view('template', $data);
		
	}

	public function tools_for_buyers()
	{
		$data['view_name']    = "front/tools_for_buyers";
		$this->load->view('template', $data);
		
	}

	public function new_buyers()
	{
		$data['view_name']    = "front/new_buyers";
		$this->load->view('template', $data);
		
	}

	public function how_to_buy()
	{
		$data['how_to_buy']=true;
		$data['view_name']    = "front/how_to_buy";
		$this->load->view('template', $data);
		
	}

	public function buyers_protection()
	{
		$data['view_name']    = "front/buyers_protection";
		$this->load->view('template', $data);
		
	}

	public function find_an_ffl()
	{
		$data['view_name']    = "front/find_an_ffl";
		$this->load->view('template', $data);
		
	}

	public function report()
	{
		$data['view_name']    = "front/report";
		$this->load->view('template', $data);
		
	}

	public function tools_for_sellers()
	{
		$data['view_name']    = "front/tools_for_sellers";
		$this->load->view('template', $data);
		
	}

	public function new_sellers()
	{
		$data['view_name']    = "front/new_sellers";
		$this->load->view('template', $data);
		
	}


	public function get_manufacturer(){	
		
		$cat_id=$_POST['cat_id'];
		$data=$this->user_model->select_data('id,name','manufacturer',array('category_id'=>$cat_id,'status'=>1));
		if (!empty($data)) {		
			echo json_encode($data);
		}else{
			echo "Null";
		}
	}

	public function sell($slug='',$step='')
	{ 
		$is_login=$this->common_model->check_user_login();
		if($is_login==FALSE){
			redirect(base_url('sign-in'));
		} 
		$session_id=$this->session->userdata('user_id');
		$userdata = $this->user_model->select_row('*', 'user' , array('id' => $session_id));
		
		if($slug!=''){
			$data['list_info']=$this->user_model->select_data('*','lists',array('slug'=>$slug));
			$data['image_info']=$this->user_model->select_data('*','list_attachments',array('list_id'=>$data['list_info'][0]['id'],'type'=>'photo'));			
		}
		$data['sell']=true;
		$data['userdata']=$userdata;
		 $data['categories']=$this->user_model->select_category('id,name,slug','categories',array('parent_id'=>0,'status'=>1),'sort_by desc,name');

		$data['add_terms_of_sale']=$this->user_model->select_data('*','additional_terms_of_sale',array('status'=>1),'',array('id','ASC'));
        $data['states'] = $this->user_model->select_data('id,name,code,status','state','','',array('name','ASC'));         
        $data['steps'] = $step;
		$data['view_name']    = "front/sell";
		$this->load->view('template', $data);
		
	}


	public function sell_copy($slug=''){
		$is_login=$this->common_model->check_user_login();
		if($is_login==FALSE){
			redirect(base_url('sign-in'));
		} 
		$session_id=$this->session->userdata('user_id');
		$userdata = $this->user_model->select_row('*', 'user' , array('id' => $session_id));
		
		if($slug!=''){
			$data['list_info']=$this->user_model->select_data('*','lists',array('slug'=>$slug));			

			$data['image_info']=$this->user_model->select_data('*','list_attachments',array('list_id'=>$data['list_info'][0]['id'],'type'=>'photo'));

			
		}
		$data['sell']=true;
		$data['userdata']=$userdata;
		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0,'status'=>1),'',array('index','ASC'));

		$data['add_terms_of_sale']=$this->user_model->select_data('*','additional_terms_of_sale',array('status'=>1),'',array('id','ASC'));


		$data['view_name']    = "front/sell_copy";
		$this->load->view('template', $data);
		
	}

		public function sell_copy1($slug='')
	{
		$is_login=$this->common_model->check_user_login();
		if($is_login==FALSE){
			redirect(base_url('sign-in'));
		}
		
		if($slug!=''){
			$data['list_info']=$this->user_model->select_data('*','lists',array('slug'=>$slug));			

			$data['image_info']=$this->user_model->select_data('*','list_attachments',array('list_id'=>$data['list_info'][0]['id'],'type'=>'photo'));

			
		}
		$data['sell']=true;
		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0,'status'=>1),'',array('index','ASC'));
		$data['view_name']    = "front/sell_copy1";
		$this->load->view('template', $data);
		
	}



	public function how_to_sell($slug='')
	{
		
		// $is_login=$this->common_model->check_user_login();
  //   	if($is_login==FALSE){
  //   		redirect(base_url('sign-in'));
  //   	}
		
		
		$data['how_to_sell']=true;
		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0),'',array('index','ASC'));
		$data['view_name']    = "front/how_to_sell";
		$this->load->view('template', $data);
		
	}

	public function fees_and_services()
	{
		$data['view_name']    = "front/fees_and_services";
		$this->load->view('template', $data);
		
	}

	public function join_our_ffl_network()
	{
		$data['view_name']    = "front/join_our_ffl_network";
		$this->load->view('template', $data);
		
	}

	public function gunbroker_store()
	{
		$data['view_name']    = "front/gunbroker_store";
		$this->load->view('template', $data);
		
	}

	public function gold_membership()
	{
		$data['view_name']    = "front/gold_membership";
		$this->load->view('template', $data);
		
	}

	public function gold_deals()
	{
		$data['view_name']    = "front/gold_deals";
		$this->load->view('template', $data);
		
	}

	public function deals()
	{
		$data['view_name']    = "front/deals";
		$this->load->view('template', $data);
		
	}

	public function firearm_industry_news()
	{
		$data['view_name']    = "front/firearm_industry_news";
		$this->load->view('template', $data);
		
	}

	public function videos()
	{
		
		$data['videos']=true;
		$data['view_name']    = "front/videos";
		$this->load->view('template', $data);
		
	}
	

	public function email_template(){
		$this->load->view('email_template');
	}

	public function search_results(){
		$cate = $this->user_model->select_data('id','categories',"name LIKE '%".$_POST['search_val']."%' OR slug  LIKE '%".$_POST['search_val']."%' AND status=1");

		if(!empty($cate)){
			$data['listings'] = $this->user_model->select_data('id,title,slug,buy_now_price,primary_picture','lists',"title LIKE '%".$_POST['search_val']."%' OR slug  LIKE '%".$_POST['search_val']."%' OR categories=".$cate[0]['id']." AND is_active=1");
		}else{
			$data['listings'] = $this->user_model->select_data('id,title,slug,buy_now_price,primary_picture','lists',"title LIKE '%".$_POST['search_val']."%' OR slug  LIKE '%".$_POST['search_val']."%' AND is_active=1");
		}

		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0),'',array('index','ASC'));
		$data['view_name']    = "front/firearms";
		$this->load->view('template', $data);
	}
	
	public function uploadFile($filename){
		$config['upload_path'] = './assets/img/listing_photos/';
		$config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG';
		$config['max_size']  = '*';
		$config['max_width']  = '*';
		$config['max_height']  = '*';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->do_upload($filename);
		$data = $this->upload->data();
		return $data['file_name'];
	}
	public function vimeo_call_back(){
		if (isset($_GET['video_uri'])) {
			$video_url=$_GET['video_uri'];
			$video_details=explode("/", $video_url);			
			if (isset($video_details[1])) {
				$file_formate=$video_details[1];
			}
			if (isset($video_details[2])) {
				$video_id=$video_details[2];
			}					
		}else{
			echo "else";
		}
		
	}

	public function register_list(){
		$data['demo']=true;
		$data['view_name']    = "front/register_list";
		$this->load->view('template', $data);
	}
	public function formsubmit(){
		echo "<br> line 690 ";
		print_r($_FILES);
		if ($_POST) {


			

	$url = "https://1512435600.cloud.vimeo.com/upload?ticket_id=172022104&video_file_id=1092862309&signature=cac50196062cf002dfe769a9d528bdc1&v6=1&redirect_url=https%3A%2F%2Fvimeo.com%2Fupload%2Fapi%3Fvideo_file_id%3D1092862309%26app_id%3D133127%26ticket_id%3D172022104%26signature%3Dda8c2a19125dd25a2ecd4d1fe70986d1665641db%26redirect%3Dhttps%253A%252F%252Fwebhungers.com%252Ffirearms-new-dev%252Fhome%252Fvimeo_call_back"; // e.g. http://localhost/myuploader/upload.php // request URL
	$filename = $_FILES['vimeo_video']['name'];
	$filedata = $_FILES['vimeo_video']['tmp_name'];
	$filesize = $_FILES['vimeo_video']['size'];
	if ($filedata != '')
	{
		
        $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
        $postfields = array("filedata" => "@$filedata", "filename" => $filename);
        $ch = curl_init();
        $options = array(
        	CURLOPT_URL => $url,
        	CURLOPT_HEADER => true,
        	CURLOPT_POST => 1,
        	CURLOPT_HTTPHEADER => $headers,
        	CURLOPT_POSTFIELDS => $postfields,
        	CURLOPT_INFILESIZE => $filesize,
        	CURLOPT_RETURNTRANSFER => true
        ); // cURL options
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        
        if(!curl_errno($ch))
        { 
        	$info = curl_getinfo($ch);
        	print_r($info);
        	if ($info['http_code'] == 200)
        		echo     $errmsg = "File uploaded successfully";
        }
        else
        {
        	echo "****";
        	echo  $errmsg = curl_error($ch);
        }
        curl_close($ch);
    }
    else
    {
    	echo $errmsg = "Please select the file";
    }

    


    
			// $data['success_msg']    = "your video uploaded successfully.";          
			// $data['view_name']    = "front/register_list";
			// $this->load->view('template', $data);		

}else{
	$data['success_msg']    = "your video upload successfully.";
	
	$data['view_name']    = "front/register_list";
	$this->load->view('template', $data);
}



}

public function request_for_space(){

	$l_Header = array("Authorization: bearer 64ddf2fe23b83a0547ea51d98eb0f9e1","Content-Type: application/json");
	$l_URL = "https://api.vimeo.com/me/videos";
	$p_ParmList = '{"upload" : {
		"approach" : "post",
		"redirect_url" : "https://webhungers.com/firearms-new-dev/home/vimeo_call_back"
	}}';

	$ch = curl_init($l_URL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $l_Header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $p_ParmList);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);

	echo "<pre>";
	echo "******";
	print_r($result);


	$response = json_decode($result, true);
	echo "<hr>";
	echo "&&&&&&&&&";
	print_r($response);
	echo "<hr>";


}

public function cron_for_sold_item_if_end_auction_today(){			
	
	echo $today_date= date("Y-m-d H:i:s");
	echo "<br>";
		//echo $yesterday_date= date('Y-m-d H:i:s', strtotime('-1 day', strtotime($today_date)));
	echo "<br>";
	$today_date='2018-10-13 10:52:51';
	$yesterday_date='2018-10-12 01:52:51';
	
	$data=$this->db->query("SELECT lists.id,lists.user_id,lists.title, MAX(bid.bid_amount) as max_bid_amount  FROM lists JOIN bid ON lists.id=bid.list_id  WHERE  lists.end_auction < '$today_date' AND lists.end_auction > '$yesterday_date' AND lists.is_sold !='1' AND lists.is_sold_by='' AND lists.is_deleted='0' AND lists.is_admin_deleted='0' AND bid.is_deleted='0'   GROUP BY lists.id")->result_array();

	
	echo "<br>";
	echo "<pre>";
	print_r($data);	

	foreach ($data as $value) {
		echo "list id :- ".$list_id=$value['id'];
		echo "<br>";
		echo "seller id :- ".$seller_id=$value['user_id'];
		echo "<br>";
		echo "list Title :- ".$list_title=$value['title'];
		echo "<br>";
		echo "Bid amount :- ".$list_max_bid_amount=$value['max_bid_amount'];
		echo "<br>";

		$amount_details=get_bid_with_commission_amount_details($list_max_bid_amount);

		if(!empty($amount_details)){
			$amount_details_update = array('sold_on_price'=>$amount_details['sold_on_price'],
				'firearms_commission'=>$amount_details['firearms_commission'],
				'seller_earn'=>$amount_details['seller_earn'],
				'commission_percentage_at_sold'=>$amount_details['commission_percentage_at_sold']);			
			$this->user_model->update_data('lists',$amount_details_update,array('id'=>$list_id));
		}
		
		$this->db->query("UPDATE bid SET is_won='1' WHERE bid_amount='$list_max_bid_amount' AND list_id='$list_id' ");
		
		$this->db->query("UPDATE lists SET is_sold='1' , is_sold_by='bid' WHERE id='$list_id'");
		

		$get_user_id=$this->db->query("SELECT user_id FROM bid  WHERE  bid_amount ='$list_max_bid_amount' AND list_id = '$list_id'")->row();
		echo "buyer id :- ".$buyer_id=$get_user_id->user_id;
		echo "<br>";
		$row['list_info']=$this->db->query("SELECT * FROM lists  WHERE  id ='$list_id'")->row_array();
		
		echo "<br>";
		$row['buyer_info']=$this->db->query("SELECT * FROM user WHERE id ='$buyer_id'")->row_array();

		
		
		$first_name='';$buyer_email='';
		if (!empty($row['buyer_info'])) {
			echo	$buyer_name=$row['buyer_info']['first_name'];
			echo	$buyer_email=$row['buyer_info']['email_id'];
		}

		$item_number='';
		if (!empty($row['list_info'])) {
			echo	$item_number=$row['list_info']['item_number'];				
		}

		echo "<br>";

		$thumb_image=get_thumb_image($list_id);

		if (!empty($thumb_image)) {
			$thumb_list_img = $thumb_image->url;
		}else{
			$thumb_list_img ='blank.jpg';
		}

		
			//  send mail to seller 

		$data['thumb_list_img']=$thumb_list_img;
		$data['commission_amount']=$list_max_bid_amount;           
		$data['list_info']=$this->user_model->select_data('*','lists',array('id'=>$list_id));
		$data['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$buyer_id));
		$data['seller_info']=$this->user_model->select_data('*','user',array('id'=>$seller_id));
		$subject_s='Congratulations You Sold Item #'.$item_number.'  ';
		$msg_s='Your list item has been sold successfully here is the item details ';
		$data['username']=$data['seller_info'][0]['first_name'];
		$seller_email_id=$data['seller_info'][0]['email_id'];			
		$this->common_model->send_email_to_seller($seller_email_id,$subject_s,$msg_s,$data);

			//end

			//send mail to buyer 

		$buyer_email_id=$buyer_email;
		$datab['thumb_list_img']=$thumb_list_img;
		$datab['commission_amount']=$list_max_bid_amount;
		$datab['username']=$buyer_name;		
		$subject_b='Congratulations You Won Item #'.$item_number.'  ';			
		$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$seller_id));
		$msg_b='You have won a item from firearms network here is the item details';
		$this->common_model->send_email_to_buyer($buyer_email_id,$subject_b,$msg_b,$datab);

        	//mail end  
	}	
}

// this is demo function	
public function get_space_for_video_in_vimeo(){
	$base_url=base_url();
    $l_Header = array("Authorization: bearer c71fcd4b6d2390df586bd0f8053b197d","Content-Type: application/json");
  	$l_URL = "https://api.vimeo.com/me/videos";
  	$p_ParmList = '{"upload" : {
        "approach" : "post",
        "redirect_url" : "'.$base_url.'user_action/success_video?list_id=123"
    			}}';

	$ch = curl_init($l_URL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $l_Header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $p_ParmList);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	$data['result'] = $result;
	//print_r($result);
	
	if ($result) {
		$trim_responce=str_replace("'","##",$result);
		$data['space_respond']  = json_decode($trim_responce, true);
		if ($data['space_respond']['link'] != null) {
			return json_decode($result, true);
		}else{	
			$this->get_space_for_video_in_vimeo();
		}
	}else{
		$this->get_space_for_video_in_vimeo();
		
	}
}

// this is demo function
public function demo_testing(){


	$result=$this->get_space_for_video_in_vimeo();

	if (!empty($result)) {
		echo "got it**********************";
	}else{
		echo "didnt get &&&&&&&&&&&&&&";
	}
print_r($result);

die();

 		
				print_r($result);

	die();
}


}