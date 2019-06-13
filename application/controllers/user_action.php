<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_action extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->library('image_lib'); // load image library
		$this->load->model('user_model');	
		$this->load->model('user_action_model');
		$this->load->model('common_model');			
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

	public function uploadFiletest($filename){
		$config['upload_path'] = './assets/img/product_img/';
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

	public function resizeImage($filename)
	    {
	      $source_path = './assets/img/listing_photos/'.$filename;
	      $target_path = './assets/img/listing_photos/thumb/';
	      $config_manip = array(
	      	  'image_library' => 'gd2',
	          'source_image' => $source_path,
	          'new_image' => $target_path,
	          'maintain_ratio' => TRUE,
	          'create_thumb' => TRUE,
	          'thumb_marker' => '',
	          'width' => 294,
	          'height' => 145
	      );

	      $this->load->library('image_lib');
 		  $this->image_lib->initialize($config_manip);
	      $this->image_lib->resize();
    	  $this->image_lib->clear();
	    }

	public function uploadMultipleFiles($upl_path , $name , $postFix = NULL){
		$imageId = '';
		$config1['upload_path'] = $upl_path;
		$config1['allowed_types'] = '*';
		$files = $_FILES;
		$cpt = count($_FILES[$name]['name']);
		for($i=0; $i<$cpt; $i++){ 
			$imgProp = array('name','type','tmp_name','error','size');
			foreach($imgProp as $prop){
				$_FILES[$name][$prop]= $files[$name][$prop][$i];
			}
			$this->load->library('upload', $config1);
			if ($this->upload->do_upload($name)){ 
				$uploaddata=$this->upload->data();
				$logo_name = $uploaddata['raw_name'];
				$logo_ext = $uploaddata['file_ext'];
				$randomstr = substr(md5(microtime()), 0, 10);
				$logo_new_name = $randomstr.$postFix.$logo_ext; 
				rename($upl_path.$logo_name.$logo_ext, $upl_path.$logo_new_name);
				$this->image_lib->clear(); //The clear method resets all of the values
				$imageId .= $logo_new_name.' ,';
			}else{ 
				$imageId .= ' ,';//$this->CI->upload->display_errors();
			} 
		}
			
		return $imageId;	
	}

	public function slugify($text=''){
        if($text!=''){
            $text = preg_replace('~[^\pL\d]+~u', '-', $text); // replace non letter or digits by -
            //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // transliterate
            $text = trim(preg_replace('~[^-\w]+~', '', $text), '-'); // remove unwanted characters and trim 
            $text = strtolower(preg_replace('~-+~', '-', $text)); // remove duplicate - and lower case
                if (empty($text)){
                    return 'n-a'; 
                }else{
                     return $text;
                }
        }else{
            redirect(base_url());
        }       
    } # end slugify()

    public function send_email($email_to,$subject,$msg,$data=''){
    	
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/email-tem',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'Firearms Network');
        $this->email->to($email_to); 
        $this->email->subject($subject);
        $this->email->message($body);
       $result = $this->email->send();
       if($result)
       {
       	echo "Success";
       }else{
       	echo "Fail";
       }
       print_r($result);
    }

    public function send_email_new($email,$subject,$msg){
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        echo $body=$this->load->view('front/firearms_mail',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'FireArms');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();

    }
public function demos()
	{
		$this->load->view('user/demo');
	}

	public function file_test()
	{
		if($_FILES['file1']['name'] !=''){
				echo $img_result1=$this->uploadFiletest('file1');
				// $list_photo_info['list_id']=$list_id;	
				// $list_photo_info['url']=$img_result1;
				// $list_photo_info['type']='photo';
				// $list_photo_info['is_featured']='1';
				// $this->user_model->insert_data('list_attachments',$list_photo_info);
				// $this->resizeImage($img_result1);
			}
	}

public function add_listing()
	{
		if(isset($_POST)){

			$date = date("Y-m-d H:i:s");
			$title_slug = $this->slugify(trim($_POST['title']));
			$check_title=$this->user_model->select_data('slug','lists',array('slug'=>$title_slug));
			if(!empty($check_title)){
				$final_slug=$title_slug.'-'.substr(md5(microtime()) , 0 , 5);
			}else{
				$final_slug=$title_slug;
			}
			$other_manufacturer='';
			// if (isset($_POST['manufacturer'])) {
			// 	$manufacturer=$_POST['manufacturer'];

			// 	$check_manufacturer=$this->user_model->select_data('name','manufacturer',array('id'=>$manufacturer));	
			// 	if($check_manufacturer){
			// 		if($check_manufacturer[0]['name']=='Other'){
			// 			$other_manufacturer=$_POST['other_manufacturer_name'];
			// 		}else{

			// 		}
			// 	}else{
				
			// 	}
			// }else{
			// 	$manufacturer='';
			// }


			if (isset($_POST['manufacturer_list'])) {
				$manufacturer=$_POST['manufacturer_list'];
			}else{
				$manufacturer='';
			}
			if (isset($_POST['model_list'])) {
				$model=$_POST['model_list'];
			}else{
				$model='';
			}
			if (isset($_POST['caliber_list'])) {
				$caliber=$_POST['caliber_list'];
			}else{
				$caliber='';
			}
			if (isset($_POST['barrel_length_list'])) {
				$barrel_length=$_POST['barrel_length_list'];
			}else{
				$barrel_length='';
			}
			if (isset($_POST['capacity_list'])) {
				$capacity=$_POST['capacity_list'];
			}else{
				$capacity='';
			}

			$starting_bid_with_commission='';
			if (!empty($_POST['starting_bid'])) {
				$starting_bid_with_commission=amount_with_commission($_POST['starting_bid']);
                               
			}
                        $buy_now_price_with_commission='';
			if (!empty($_POST['buy_now_price'])) {
			     $buy_now_price_with_commission=amount_with_commission($_POST['buy_now_price']); 
			}
                        $fixed_price_with_commission='';
                        if (!empty($_POST['fixed_price'])) {
			     $fixed_price_with_commission=amount_with_commission($_POST['fixed_price']); 
			}


			$payment_method=$_POST['payment_method'];
			$payment_method=implode(',', $payment_method);

			$shipping_class=$_POST['shipping_class'];

			$buyer_pays_amount_shipping_vice = array();
			if (in_array("Overnight", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['overnight_fixed']);
			}
			if (in_array("2nd day", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['secondday_fixed']);
			}
			if (in_array("3rd day", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['thirdday_fixed']);
			}
			if (in_array("Ground", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['ground_fixed']);
			}
			if (in_array("Etc", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['etc_fixed']);
			}
  			$shipping_class=implode(',', $shipping_class);
  			$buyer_pays_amount_shipping_vice=implode(',', $buyer_pays_amount_shipping_vice);
            

           
			$list_info=array(
							'type'=>$_POST['auction_id'],
							'user_id'=>$this->session->userdata('user_id'),
							'title'=>$_POST['title'],
							'categories'=>$_POST['category'],
							'manufacturer'=>$manufacturer,
							'model'=>$model,
							'caliber'=>$caliber,
							'barrel_length'=>$barrel_length,
							'capacity'=>$capacity,
							'other_manufacturer'=>$other_manufacturer,
							'slug'=>$final_slug,
							'item_condition'=>$_POST['item_condition'],
							'item_location'=>$_POST['item_location'],
							'country'=>$_POST['country'],
							'FFL'=>$_POST['FFL'],
							'MFG'=>$_POST['MFG'],
							'SKU'=>$_POST['SKU'],
							'serial_number'=>$_POST['serial_no'],
							'homepage_post'=>$_POST['homepage_user'],
							'UPC'=>$_POST['UPC'],
							'description'=>$_POST['description'],
							'additional_terms_of_sale'=>$_POST['terms_of_sale'],
							'shipping_method'=>$payment_method,
							'shipping_class'=>$shipping_class,
							'buyer_pays_amount_shipping_vice'=>$buyer_pays_amount_shipping_vice,
							'pays_for_shipping'=>$_POST['shiping_payer'],
							'where_you_will_ship'=>$_POST['shipping_place'],
							'return_policy'=>$_POST['return_policy'],				
							'duration_days'=>$_POST['duration_days'],
							'relist_options'=>$_POST['relist_options'],
							'sales_tax'=>$_POST['sales_tax'],
                            'fixed_price'=>$_POST['fixed_price'],
                            'fixed_price_with_commission'=>$fixed_price_with_commission,
                            'quantity'=>$_POST['quantity'],
                            'remaing_quantity'=>$_POST['quantity'],
							'starting_bid'=>$_POST['starting_bid'],
							'starting_bid_with_commission'=>$starting_bid_with_commission,
							'reserve_price'=>$_POST['reserve_price'],
							'buy_now_price'=>$_POST['buy_now_price'],
							'buy_now_price_with_commission'=> $buy_now_price_with_commission,
							'end_auction'=>date("Y-m-d H:i:s", strtotime($date. ' + '.$_POST['duration_days'].' days')),
							'is_active'=>1,
							'is_deleted'=>1
							);
                                                                  

            //var_dump($list_info);die;
			/*if($_POST['manufacturer']!='Other'){
				$list_info['manufacturer']=$_POST['manufacturer'];
			}else{
				$list_info['manufacturer']=$_POST['other_manufacturer_name'];
			}*/
            

            
			if($_POST['relist_options']=='Relist After Sold'){
				$list_info['relist_time_after_sold']=$_POST['relist_time_after_sold'];  
			}

			if(!empty($_FILES)){
				$list_info['is_picture']=1;
			}

			if($_POST['video_url1']!='' || $_POST['video_url2']!='' || $_POST['video_url3']!=''){
				$list_info['is_video']=1;
			}

			$list_info['item_number']=mt_rand(100000,999999);

			$list_id=$this->user_model->insert_data('lists',$list_info);
            
             $co_tax = $_POST['co_tax'];
             if($_POST['sales_tax'] == 1)
             {
             if(!empty($co_tax))
             {
             	 $co_taxes =array(
             	 	'list_id'=>$list_id,
             	 	'tax_type'=>'CO',
             	 	'state'=>'',
             	 	'tax'=>$_POST['co_tax']
              
             );
             	$this->user_model->insert_data('list_sales_tax',$co_taxes);
             }
             $fm_tax  = $_POST['fm_tax'];
             if(!empty($fm_tax))
             {
             	$fm_taxes = array(
             	 	'list_id'=>$list_id,
             	 	'tax_type'=>'FM',
             	 	'state'=>'',
             	 	'tax'=>$_POST['fm_tax']
              
             );
             	$this->user_model->insert_data('list_sales_tax',$fm_taxes);
             }
             $hi_tax = $_POST['hi_tax'];
             if(!empty($hi_tax))
             {
             	$hi_taxes = array(
             	 	'list_id'=>$list_id,
             	 	'tax_type'=>'HI',
             	 	'state'=>'',
             	 	'tax'=>$_POST['hi_tax']
              
             );
             	$this->user_model->insert_data('list_sales_tax',$hi_taxes);
             }
         }

			$state_tax = $_POST['state_tax'];
			
            $codes = $_POST['codes'];
			if(!empty($state_tax))
			{
				for($i=0;$i< count($state_tax); $i++)
    	          {
    	         $dynamic_taxes = array(
             	 	'list_id'=>$list_id,
             	 	'tax_type'=>'',
             	 	'state'=>$codes[$i],
             	 	'tax'=>$state_tax[$i]
              
             );
             	$this->user_model->insert_data('list_sales_tax', $dynamic_taxes);
             	}
			}            

          
    	
    	
    	

			if($_FILES['file1']['name'] !=''){
				$img_result1=$this->uploadFile('file1');
				$list_photo_info['list_id']=$list_id;	
				$list_photo_info['url']=$img_result1;
				$list_photo_info['type']='photo';
				$list_photo_info['is_featured']='1';
				$this->user_model->insert_data('list_attachments',$list_photo_info);
				$this->resizeImage($img_result1);
			}

			if($_FILES['file2']['name'] !=''){
				$chk_f=$this->user_model->select_data('id','list_attachments',array('list_id'=>$list_id,'type'=>'photo','is_featured'=>'1'));
				if(empty($chk_f)){
					$list_photo2_info['is_featured']='1';
				}
				$img_result2=$this->uploadFile('file2');
				$list_photo2_info['list_id']=$list_id;	
				$list_photo2_info['url']=$img_result2;
				$list_photo2_info['type']='photo';
				$this->user_model->insert_data('list_attachments',$list_photo2_info);
				$this->resizeImage($img_result2);
			}

			if($_FILES['file3']['name'] !=''){
				$chk_s=$this->user_model->select_data('id','list_attachments',array('list_id'=>$list_id,'type'=>'photo','is_featured'=>'1'));
				if(empty($chk_s)){
					$list_photo3_info['is_featured']='1';
				}
				$img_result3=$this->uploadFile('file3');
				$list_photo3_info['list_id']=$list_id;	
				$list_photo3_info['url']=$img_result3;
				$list_photo3_info['type']='photo';
				$this->user_model->insert_data('list_attachments',$list_photo3_info);
				$this->resizeImage($img_result3);
			}

			
			redirect(base_url('upload-video/'.$final_slug.'/added'));
			//redirect(base_url('list-success/'.$final_slug.'/added'));
		}
	}

	public function add_video($list_id=''){	
		$data['list_details']=$this->user_model->select_data('id,slug','lists',array('id'=>$list_id));	
       	$step_update = array('is_deleted'=>0);			
		$this->user_model->update_data('lists',$step_update,array('id'=>$list_id));
    	$data['view_name']    = "user/list_success";
    	$data['l_slug'] = $data['list_details'][0]['slug'];
		$this->load->view('template', $data);
	}	


	public function mynetwork_video_update($list_id=''){	
		$data['list_details']=$this->user_model->select_data('id,slug','lists',array('id'=>$list_id));	
		$step_update = array('is_deleted'=>0);			
		$this->user_model->update_data('lists',$step_update,array('id'=>$list_id));
		
		$mynetwork_selected_video=$_POST['mynetwork_selected_video'];
		$step_update = array('mynetwork'=>$mynetwork_selected_video);			
		$this->user_model->update_data('lists',$step_update,array('id'=>$list_id));
		$data['view_name']    = "user/list_success";
    	$data['l_slug'] = $data['list_details'][0]['slug'];
		$this->load->view('template', $data);
	}

	public function youtube_video_update($list_id=''){	
		$v1=array_filter($_POST['youtube_video_url']);
		$v2 = array_values($v1);
		if(!empty($v2)){
			foreach ($v2 as $video_url) {
				if (strpos($video_url, 'watch?v=') == true && strpos($video_url, '&') == true) {
	    			$value = str_replace("watch?v=","embed/",$video_url);
	    			$variable1 = substr($value, 0, strpos($value, "&"));
				}else if (strpos($video_url, 'watch?v=') == true && strpos($video_url, '&') == false) {
	    			$variable1 = str_replace("watch?v=","embed/",$video_url);
				}else if(strpos($video_url, 'youtu.be') == true){
					$variable1 = str_replace("youtu.be","www.youtube.com/embed",$video_url);
				}else{
					$variable1 = $video_url;
				}
				$video_info['list_id']=$list_id;
				$video_info['url']=$variable1;
				$video_info['type']='youtube';
				$this->user_model->insert_data('list_attachments',$video_info);
			}
		}

		$data['list_details']=$this->user_model->select_data('id,slug','lists',array('id'=>$list_id));	
       	$step_update = array('is_deleted'=>0);			
		$this->user_model->update_data('lists',$step_update,array('id'=>$list_id));
    	$data['view_name']    = "user/list_success";
    	$data['l_slug'] = $data['list_details'][0]['slug'];
		$this->load->view('template', $data);
	}	

	public function youtube_video_add($list_id=''){	
		
			if($_POST['video_url1']!=''){
				if (strpos($_POST['video_url1'], 'watch?v=') == true && strpos($_POST['video_url1'], '&') == true) {
	    			$value = str_replace("watch?v=","embed/",$_POST['video_url1']);
	    			$variable1 = substr($value, 0, strpos($value, "&"));
				}else if (strpos($_POST['video_url1'], 'watch?v=') == true && strpos($_POST['video_url1'], '&') == false) {
	    			$variable1 = str_replace("watch?v=","embed/",$_POST['video_url1']);
				}else if(strpos($_POST['video_url1'], 'youtu.be') == true){
					$variable1 = str_replace("youtu.be","www.youtube.com/embed",$_POST['video_url1']);
				}else{
					$variable1 = $_POST['video_url1'];
				}
				$video1_info['list_id']=$list_id;
				$video1_info['url']=$variable1;
				$video1_info['type']='youtube';
				$this->user_model->insert_data('list_attachments',$video1_info);
			}

			if($_POST['video_url2']!=''){
				if (strpos($_POST['video_url2'], 'watch?v=') == true && strpos($_POST['video_url2'], '&') == true) {
	    			$value = str_replace("watch?v=","embed/",$_POST['video_url2']);
	    			$variable2 = substr($value, 0, strpos($value, "&"));
				}else if (strpos($_POST['video_url2'], 'watch?v=') == true && strpos($_POST['video_url2'], '&') == false) {
	    			$variable2 = str_replace("watch?v=","embed/",$_POST['video_url2']);
				}else if(strpos($_POST['video_url2'], 'youtu.be') == true){
					$variable2 = str_replace("youtu.be","www.youtube.com/embed",$_POST['video_url2']);
				}else{
					$variable2 = $_POST['video_url2'];
				}
				$video2_info['list_id']=$list_id;
				$video2_info['url']=$variable2;
				$video2_info['type']='youtube';
				$this->user_model->insert_data('list_attachments',$video2_info);
			}

			if($_POST['video_url3']!=''){
				if (strpos($_POST['video_url3'], 'watch?v=') == true && strpos($_POST['video_url3'], '&') == true) {
	    			$value = str_replace("watch?v=","embed/",$_POST['video_url3']);
	    			$variable3 = substr($value, 0, strpos($value, "&"));
				}else if (strpos($_POST['video_url3'], 'watch?v=') == true && strpos($_POST['video_url3'], '&') == false) {
	    			$variable3 = str_replace("watch?v=","embed/",$_POST['video_url3']);
				}else if(strpos($_POST['video_url3'], 'youtu.be') == true){
					$variable3 = str_replace("youtu.be","www.youtube.com/embed",$_POST['video_url3']);
				}else{
					$variable3 = $_POST['video_url3'];
				}
				$video3_info['list_id']=$list_id;
				$video3_info['url']=$variable3;
				$video3_info['type']='youtube';
				$this->user_model->insert_data('list_attachments',$video3_info);
			}		
	
		$data['list_details']=$this->user_model->select_data('id,slug','lists',array('id'=>$list_id));	
       	$step_update = array('is_deleted'=>0);			
		$this->user_model->update_data('lists',$step_update,array('id'=>$list_id));
    	$data['view_name']    = "user/list_success";
    	$data['l_slug'] = $data['list_details'][0]['slug'];
		$this->load->view('template', $data);

	}	

	public function success_video()
	{	

		$base_url=base_url();
		
		if (isset($_GET['video_uri'])) {

			$video_url=$_GET['video_uri'];
			$video_details=explode("/", $video_url);			
			if (isset($video_details[1])) {
				$file_formate=$video_details[1];
			}
			if (isset($video_details[2])) {
				$video_id=$video_details[2];
			}	

			if (isset($_GET['list_id'])) {
				$data['list_id'] =  $_GET['list_id'];
				$list_id=$_GET['list_id'];
			}

			$vimeo_video = array('list_id'=>$list_id,'url'=>$video_id,'type'=>'vimeo_id');
			$this->user_model->insert_data('list_attachments',$vimeo_video);

		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));
		$data['list_details']=$this->user_model->select_data('id,slug','lists',array('id'=>$list_id));
		       
       	$step_update = array('is_deleted'=>0);			
		$this->user_model->update_data('lists',$step_update,array('id'=>$list_id));


    	$data['view_name']    = "user/list_success";
    	$data['l_slug'] = $data['list_details'][0]['slug'];
		$this->load->view('template', $data);
	}
}

	public function list_success($final_slug,$response=''){
		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));
		$data['list_details']=$this->user_model->select_data('id','lists',array('slug'=>$final_slug));
		$data['response']=$response;
    	$data['view_name']    = "user/list_success";
    	$data['l_slug'] = $final_slug;
		$this->load->view('template', $data);
	}

	

	public function youtube_video_delete($video_id=''){
		$video_id=  $_POST['video_id'];
		$this->user_model->delete_data('list_attachments',array('id' =>$video_id));
		echo "success";
	}


	public function delete_vimeo_video($vimeo_id='',$video_id=''){
		$where = $this->input->post(); 
  			
  			$vimeo_id = 0;
	        if(isset($where['vimeo_id'])){
	            $vimeo_id = $where['vimeo_id'];
	            unset($where['vimeo_id']);
	        }

	          if(isset($where['video_id'])){
	            $video_id = $where['video_id'];
	            unset($where['video_id']);
	        }

		$l_Header = array("Authorization: bearer c71fcd4b6d2390df586bd0f8053b197d","Content-Type: application/json");
      	$l_URL = "https://api.vimeo.com/videos/$vimeo_id";
      	$p_ParmList = '';		
		$ch = curl_init($l_URL);                                               
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');                       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $l_Header);      

		$result = curl_exec($ch);

		$this->user_model->delete_data('list_attachments',array('id' =>$video_id));
		//echo $this->db->last_query();
		
		echo "success";

	}

	public function tests(){
//            $amount='800';
//         echo    amount_with_commission($amount);
//	die();
		$data['user_video']=$this->user_model->select_data('id,url','list_attachments',array('list_id'=>66,'type'=>'vimeo_id'));
			$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));	
		    $data['view_name']    = "user/upload_video";
			$this->load->view('template', $data);	
	}

	public function update_list_image($list_id=''){

		$data['list_details']=$this->user_model->select_data('id,title,slug','lists',array('id'=>$list_id));
		$data['image_details']=$this->user_model->select_data('id,url,is_featured,list_id','list_attachments',array('list_id'=>$list_id,'type'=>'photo'));

	    $data['view_name']    = "user/update_list_image";
		$this->load->view('template', $data);

	}

	public function update_image_for_list($id)
	{
		$check_featured= $this->user_model->select_data('url','list_attachments',array('list_id'=>$id,'is_featured'=>'1'));

		if(!empty($check_featured)){	
			$is_featured_exist='1';		
		}else{
			$is_featured_exist='0';	
		}
		
		if(!empty($_FILES)){
			$all_files = $this->uploadMultipleFiles('./assets/img/listing_photos/','a_file');
			$files = explode(',',$all_files);
			array_pop($files);
			$cnt=1;

			foreach($files as $file){
				$pictures = array(
								  'list_id'=>$id,	
								  'url'=>trim($file),
								  'type'=>'photo'
								 );
				if($cnt==1 && $is_featured_exist==0 ){
					$pictures['is_featured']='1';
				}
				$this->user_model->insert_data('list_attachments',$pictures);
				$this->resizeImage(trim($file));
				$cnt++;
			}
		}

		

		$this->session->set_flashdata('image_success', 'Image updated successfully.');
		//$this->update_list_image($id);


		redirect(base_url('user_action/update_list_image/'.$id));

	}
	public function video_add($final_slug,$response='')
	{

		$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));
		$data['list_details']=$this->user_model->select_data('*','lists',array('slug'=>$final_slug));
		$data['user_video']=$this->user_model->select_data('id,url','list_attachments',array('list_id'=>$data['list_details'][0]['id'],'type'=>'vimeo_id'));
		$data['youtube_video']=$this->user_model->select_data('id,url','list_attachments',array('list_id'=>$data['list_details'][0]['id'],'type'=>'youtube'));

	    $data['listings']=$this->user_model->select_data('item_number,title,id,slug,mynetwork','lists',array('id'=>$data['list_details'][0]['id']),'','');      
		$data['response']=$response;    	
		$data['user_video_count']=$this->user_model->select_data('count(id) as total_video','list_attachments',array('list_id'=>$data['list_details'][0]['id'],'type'=>'vimeo_id'));

		if ($data['user_video_count'][0]['total_video'] >=3) {
			$data['video_limit']  ='1';
		}else{
			$data['video_limit']  ='0';
    	//upload video on vimeo start
        $base_url=base_url();
        $l_Header = array("Authorization: bearer c71fcd4b6d2390df586bd0f8053b197d","Content-Type: application/json");
		      	$l_URL = "https://api.vimeo.com/me/videos";
		      	$p_ParmList = '{"upload" : {
			        "approach" : "post",
			        "redirect_url" : "'.$base_url.'user_action/success_video?list_id='.$data['list_details'][0]['id'].'"
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
						$data['space_responce']=json_decode($result, true);
					}else{		
					}
				}else{
					$data['space_responce']  = array();
				}	
				//print_r($data['space_responce']);
			}	
		$data['view_name']    = "user/video_upload";
    	$data['l_slug'] = $final_slug;
		$this->load->view('template', $data);
	}

	public function redirect_video(){
		if (isset($_GET['video_uri'])) {
			print_r($_GET['video_uri']);
		}
	}

	public function upload_video($list_id=''){
 			 $base_url=base_url();
		
		if (isset($_GET['video_uri'])) {
			$video_url=$_GET['video_uri'];
			$video_details=explode("/", $video_url);			
			if (isset($video_details[1])) {
				$file_formate=$video_details[1];
			}
			if (isset($video_details[2])) {
				$video_id=$video_details[2];
			}	

			if (isset($_GET['list_id'])) {
				$data['list_id'] =  $_GET['list_id'];
				$list_id=$_GET['list_id'];

			$chk_exist = $this->user_model->select_data('api_type,response,id','vimeo_log',array('list_id'=>$list_id,'response'=>$video_url),1,array('id','DESC'));

			
				if ($chk_exist) {					

				}else{
					$vimeo_log = array('list_id'=>$list_id,'api_type'=>'form_upload','ip_address'=>$_SERVER['REMOTE_ADDR'],'response'=>$video_url,'status'=>'Success');
					$this->user_model->insert_data('vimeo_log',$vimeo_log);
					$insert_id = $this->db->insert_id();

					$vimeo_video = array('list_id'=>$list_id,'url'=>$video_id,'type'=>'vimeo_id');
					$this->user_model->insert_data('list_attachments',$vimeo_video);
					$step_update = array('video_step'=>'');			
					$qry=$this->user_model->update_data('vimeo_log',$step_update,array('list_id'=>$list_id));
					if ($qry) {
						$step_add = array('video_step'=>'current_step');			
						$this->user_model->update_data('vimeo_log',$step_add,array('id'=>$insert_id));
					}			
				}
			
			}

		}else{				
			$data['list_id'] = $list_id;				
		}	


	$chk_form_step = $this->user_model->select_data('api_type,response,video_step,id','vimeo_log',array('list_id'=>$list_id,'video_step'=>'current_step'),1,array('id','DESC'));
	if(empty($chk_form_step)){
		$apicall= "yes";
	}elseif ($chk_form_step[0]['api_type']=='form_upload') {
		$apicall= "yes";
	}else{
		$apicall= "no";
	}

		$data['user_video']=$this->user_model->select_data('id,url','list_attachments',array('list_id'=>$list_id,'type'=>'vimeo_id'));

		$data['user_video_count']=$this->user_model->select_data('count(id) as totalid','list_attachments',array('list_id'=>$list_id,'type'=>'vimeo_id'));

		if ($data['user_video_count'][0]['totalid'] >=3) {

			$data['space_responce']  = array();
		}else{

			if ($apicall=='yes') {
				$l_Header = array("Authorization: bearer c71fcd4b6d2390df586bd0f8053b197d","Content-Type: application/json");
		      	$l_URL = "https://api.vimeo.com/me/videos";
		      	$p_ParmList = '{"upload" : {
			        "approach" : "post",
			        "redirect_url" : "'.$base_url.'user_action/upload_video?list_id='.$list_id.'"
			    			}}';

				$ch = curl_init($l_URL);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $l_Header);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $p_ParmList);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);

				if ($result) {
					$trim_responce=str_replace("'","##",$result);
					$data['space_respond']  = json_decode($trim_responce, true);

					if ($data['space_respond']['link'] != null) {

						$data['space_responce']=json_decode($result, true);


						//blank current stet
						$blank_step = array('video_step'=>'');			
						$this->user_model->update_data('vimeo_log',$blank_step,array('list_id'=>$list_id));

						$vimeo_log = array(
								'list_id'=>$list_id,
								'api_type'=>'form_call',
								'ip_address'=>$_SERVER['REMOTE_ADDR'],
								'response'=>$result,
								'status'=>'Success',
								'video_step'=>'current_step'
								);
						$this->user_model->insert_data('vimeo_log',$vimeo_log);



					}else{
						$data['space_responce']=array();
						$vimeo_log = array(
								'list_id'=>$list_id,
								'api_type'=>'form_call',
								'ip_address'=>$_SERVER['REMOTE_ADDR'],
								'response'=>$result,
								'status'=>'failed'
								);
						$this->user_model->insert_data('vimeo_log',$vimeo_log);
					}
			


				}else{
					$data['space_responce']  = array();
				}
				
			}else{
				$result=$chk_form_step[0]['response'];
				$data['space_responce']=json_decode($result, true);
			}		

		}	
	

			
			$data['categories']=$this->user_model->select_data('id,name,slug','categories',array('parent_id'=>0));	
			$data['listings']=$this->user_model->select_data('item_number,title,id,slug','lists',array('id'=>$list_id),'','');
		    $data['view_name']    = "user/upload_video";
			$this->load->view('template', $data);	
	
	}

	public function like_list(){
		$session_id = $this->session->userdata('user_id');
		$prev_like = $this->user_model->select_data('id,like_status','likes',array('list_id'=>$_POST['list_id'],'user_id'=>$session_id));
		if(empty($prev_like)){
			$like_details = array(
								'list_id'=>$_POST['list_id'],
								'user_id'=>$session_id,
								'like_status'=>1,
								'updated_on'=>date('Y-m-d H:i:s')
								);
			echo $this->user_model->insert_data('likes',$like_details);
		}else{
			if($prev_like[0]['like_status']==1)
			{
				$like_details['like_status']=0;
				$like_details['updated_on']=date('Y-m-d H:i:s');
				echo 'remove';			

			}else{
				$like_details['like_status']=1;
				$like_details['updated_on']=date('Y-m-d H:i:s');
				echo 'added';	
			}
			$this->user_model->update_data('likes',$like_details,array('id'=>$prev_like[0]['id']));
		}

	}

	public function bid(){
		$session_id = $this->session->userdata('user_id');
		$chk_starting_bid=$this->user_model->select_data('*','lists',array('id'=>$_POST['list_id']));
		$chk_prev_amount = $this->user_model->select_data('bid_amount','bid',array('list_id'=>$_POST['list_id']),1,array('bid_amount','DESC'));

		$firearms_commission=$this->user_model->select_data('*','commission');
		
		$start_amount=$chk_starting_bid[0]['starting_bid'];
		$reserve_price=$chk_starting_bid[0]['reserve_price'];

        $amount=amount_with_commission($start_amount);

		if($amount<=$_POST['bid_value']){
			if(!empty($chk_prev_amount) && $_POST['bid_value']<=$chk_prev_amount[0]['bid_amount']){
				echo 0;
			}else{
				$bid_info = array(
								  'user_id'=>$session_id,
								  'list_id'=>$_POST['list_id'],
								  'bid_amount'=>$_POST['bid_value']
								 );
				$prev_data = json_encode(array($chk_starting_bid,$bid_info));
				$bid_log = array(
								'user_id'=>$session_id,
								'ip_address'=>$_SERVER['REMOTE_ADDR'],
								'action'=>'add_bid',
								'previous_data'=>$prev_data
								);
				$this->user_model->insert_data('bid',$bid_info);
				$this->user_model->insert_data('user_log',$bid_log);
				$bids=$this->user_model->select_data('bid_amount','bid',array('list_id'=>$_POST['list_id']),1,array('bid_amount','ASC'));
				$bid_count=$this->user_model->aggregate_data('bid','id','COUNT',array('list_id'=>$_POST['list_id']));
				$resp = array(
							  'bid_amount'=>$bids[0]['bid_amount'],
							  'bid_count'=>$bid_count,
							  'reserve_price'=>$reserve_price
							 );
				echo json_encode($resp);
			}
		}else{
			echo "less";
		}
	}

	public function fav_seller(){
		$session_id = $this->session->userdata('user_id');
		$chk_prev = $this->user_model->select_data('id,status','followers',array('follower_user_id'=>$session_id,'following_user_id'=>$_POST['seller_id']));
		if(empty($chk_prev)){
			$fav_seller_info = array(
							  'follower_user_id'=>$session_id,
							  'following_user_id'=>$_POST['seller_id'],
							  'status'=>1,
							  'updated_on'=>date('Y-m-d H:i:s')
							 );
			echo $this->user_model->insert_data('followers',$fav_seller_info);
		}else{
			if($chk_prev[0]['status']==1)
			{
				$update_status['status']=0;
				$update_status['updated_on']=date('Y-m-d H:i:s');
				echo 'remove';
			}else{
				$update_status['status']=1;
				$update_status['updated_on']=date('Y-m-d H:i:s');
				echo 'added';	
			}
			$this->user_model->update_data('followers',$update_status,array('id'=>$chk_prev[0]['id']));
		}
	}

	public function add_watchlist_item(){
		$session_id = $this->session->userdata('user_id');
		$list_user_id	=$_POST['list_user_id'];
		$list_id	=$_POST['list_id'];

		$chk_prev = $this->user_model->select_data('id,status','watchlist',array('user_id'=>$session_id,'list_id'=>$list_id));
		 if(empty($chk_prev)){
			$watchlist_info = array(
							  'user_id'=>$session_id,
							  'list_user_id'=>$list_user_id,
							  'list_id'=>$list_id,
							  'status'=>1,
							  'updated_on'=>date('Y-m-d H:i:s')
							 );
			echo $this->user_model->insert_data('watchlist',$watchlist_info);
		 }else{
		 	if($chk_prev[0]['status']==1)
			{
				$update_status['status']=0;
				$update_status['updated_on']=date('Y-m-d H:i:s');
				echo 'remove';
			}else{
				$update_status['status']=1;
				$update_status['updated_on']=date('Y-m-d H:i:s');
				echo 'added';	
			}
			$this->user_model->update_data('watchlist',$update_status,array('id'=>$chk_prev[0]['id']));
		 }
	}

	public function delete_list_image(){
		error_reporting(0);
		if(isset($_POST)){
			$image_id= $_POST['image_id'];
			$imagename= $_POST['imagename'];
			$result=$this->user_model->delete_data('list_attachments',array('id' =>$image_id));	
			if ($result) {
				$result1=$this->image_delete($imagename);
				if ($result1=='1') {
					$image_unlink="image deleted successfully";
				}else{
					$image_unlink="image not found";
				}
				echo "success";
			}else{
				echo "failed";
			}
		}					
	}

	public function image_delete($image_name='')
	{
		$SCRIPT_NAME = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		$path=$_SERVER['DOCUMENT_ROOT'].$SCRIPT_NAME.'assets/img/listing_photos/'.$image_name;
	
		if (@unlink($path)) {
			return 1;
		}else{
			return 2;
		}
 	}

	public function social_email(){
		if(isset($_POST)){
			$session_id = $this->session->userdata('user_id');
			$share_info=array(
							 'list_id'=>$_POST['list_id'],
							 'share_by'=>$session_id
							 );
			if(is_numeric($_POST['share_to'])){
				$share_info['share_to']=$_POST['share_to'];
				$u_email = $this->user_model->select_data('email_id','user',array('id'=>$_POST['share_to']));
				$email = $u_email[0]['email_id'];
			}else{
				$share_info['share_to_email']=$_POST['share_to'];
				$email = $_POST['share_to'];
			}
			$this->user_model->insert_data('share',$share_info);
			$data['list_info_1']=$this->user_model->select_data('*','lists',array('id'=>$_POST['list_id']));

			$data['list_image']=$this->user_model->select_data('url','list_attachments',array('list_id'=>$_POST['list_id']),1,array('id','ASC'));
			$data['list_info']=array_merge($data['list_info_1'],$data['list_image']);


			$subject='Post shared by the seller of firearms Network';
			$msg='Please view all the details below';
			$this->send_email($email,$subject,$msg,$data);
			echo 1;
		}else{
			echo 0;
		}
	}

	public function test_email(){

		$data['list_info_1']=$this->user_model->select_data('*','lists',array('id'=>49));
		$data['list_image']=$this->user_model->select_data('url','list_attachments',array('list_id'=>4748),1,array('id','ASC'));
		echo "<pre>";
		print_r($data['list_info_1']);
			print_r($data['list_image']);

		$data['list_info']=array_merge($data['list_info_1'],$data['list_image']);

		print_r($data['list_info']);

		die();
		$email="deepika.shaijulkar@webhungers.com";
		$data['list_info']=$this->user_model->select_data('*','lists',array('id'=>'93'));
		$subject='Post shared by the seller of firearms Network';
		$msg='Please view all the details below';
		$result = $this->send_email($email,$subject,$msg,$data);
		print_r($result);
		//echo "mail send";

	}

	public function amount_pay(){
		if(isset($_POST)){		

		  	$user_detail=$this->user_model->select_data('*' , 'user' , array('email_id' => trim($_POST['user_email']),'password' => trim(md5($_POST['user_pass']))));

		  	echo $user_detail['0']['id'];
			
		}else{
			echo 0;
		}
	}

     public function ask_question_mail(){

    	$to = "seller@gmail.com";
    	$subject = "Subject that buyer have to send";
    	$question = "question that is going to ask by buyer";

    	$response = $this->common_model->ask_question_mail_seller($to,$subject,$question);
          if(!$response)
          {
          	echo "mail not send";
          }
          else
          {
          	echo "mail send successfully";
          }
     }
	public function add_question(){
		if(isset($_POST)){
			$session_id = $this->session->userdata('user_id');
			$seller_id = $_POST['seller_id'];
			$seller_que = $_POST['seller_que'];		
			$msg_info=array(
							 'from_user_id'=>$session_id,
							 'to_user_id'=>$seller_id,
							 'message'=>$seller_que
							 );			
			$response = $this->user_model->insert_data('message',$msg_info);			
	        if($response){
	          	$seller_name = $_POST['to'];
				$buyer_name = $_POST['from'];
				$to = $_POST['seller_email'];
		    	$subject = $_POST['subject'];
		    	$from = $_POST['buyers_email'];
		    	$question = $seller_que;
		    	$this->common_model->ask_question_mail_seller($to,$from,$subject,$question,$seller_name,$buyer_name);	          
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function update_listing($id){
		if(isset($_POST)){
			$created_date=$this->user_model->select_data('created_on','lists',array('id'=>$id));
			$date = $created_date[0]['created_on'];
			
			$check_title= $this->user_model->select_data('slug,duration_days,end_auction','lists',array('id'=>$id));

			if(!empty($check_title)){			 		
			 	$final_slug=$check_title[0]['slug'];
			 	$end_auction_update=$check_title[0]['end_auction'];
			 	$old_duration_days=$check_title[0]['duration_days'];
			}else{
				$final_slug='';
			}

			$new_duration_days =$_POST['duration_days'];

			if ($old_duration_days==$new_duration_days) {
				$end_auction=$end_auction_update;
			}else{
				$end_auction=date("Y-m-d H:i:s", strtotime($end_auction_update. ' + '.$new_duration_days.' days'));
			}

			$check_featured= $this->user_model->select_data('url','list_attachments',array('list_id'=>$id,'is_featured'=>'1'));

			if(!empty($check_featured)){	
				$is_featured_exist='1';		
			}else{
				$is_featured_exist='0';	
			}
			
			$other_manufacturer='';
			// if (isset($_POST['manufacturer'])) {
			// 	$manufacturer=$_POST['manufacturer'];

			// 	$check_manufacturer=$this->user_model->select_data('name','manufacturer',array('id'=>$manufacturer));	
			// 	if($check_manufacturer){

			// 		if(strpos($check_manufacturer[0]['name'], 'Other') !== false){
			// 		    $other_manufacturer=$_POST['other_manufacturer_name'];
			// 		}else{

			// 		}
			// 	}else{
				
			// 	}
			// }else{
			// 	$manufacturer='';
			// }

			if (isset($_POST['manufacturer_list'])) {
				$manufacturer=$_POST['manufacturer_list'];
			}else{
				$manufacturer='';
			}
			if (isset($_POST['model_list'])) {
				$model=$_POST['model_list'];
			}else{
				$model='';
			}
			if (isset($_POST['caliber_list'])) {
				$caliber=$_POST['caliber_list'];
			}else{
				$caliber='';
			}
			if (isset($_POST['barrel_length_list'])) {
				$barrel_length=$_POST['barrel_length_list'];
			}else{
				$barrel_length='';
			}
			if (isset($_POST['capacity_list'])) {
				$capacity=$_POST['capacity_list'];
			}else{
				$capacity='';
			}

	        $fixed_price_with_commission='';
	        if (!empty($_POST['fixed_price'])) {
	     		$fixed_price_with_commission=amount_with_commission($_POST['fixed_price']); 
			}
			$payment_method=$_POST['payment_method'];
			$payment_method=implode(',', $payment_method);

			$shipping_class=$_POST['shipping_class'];

			$buyer_pays_amount_shipping_vice = array();
			if (in_array("Overnight", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['overnight_fixed']);
			}
			if (in_array("2nd day", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['secondday_fixed']);
			}
			if (in_array("3rd day", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['thirdday_fixed']);
			}
			if (in_array("Ground", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['ground_fixed']);
			}
			if (in_array("Etc", $shipping_class))
			{
				array_push($buyer_pays_amount_shipping_vice,$_POST['etc_fixed']);
			}
  			$shipping_class=implode(',', $shipping_class);
  			$buyer_pays_amount_shipping_vice=implode(',', $buyer_pays_amount_shipping_vice);
		


			$list_info=array(
							'title'=>$_POST['title'],
							'categories'=>$_POST['category'],
							'slug'=>$final_slug,
							'manufacturer'=>$manufacturer,
							'model'=>$model,
							'caliber'=>$caliber,
							'barrel_length'=>$barrel_length,
							'capacity'=>$capacity,
							'sales_tax'=>$_POST['sales_tax'],
							'other_manufacturer'=>$other_manufacturer,
							'item_condition'=>$_POST['item_condition'],
							'item_location'=>$_POST['item_location'],
							'country'=>$_POST['country'],
							'FFL'=>$_POST['FFL'],
							'MFG'=>$_POST['MFG'],
							'SKU'=>$_POST['SKU'],
							'serial_number'=>$_POST['serial_no'],
							'homepage_post'=>$_POST['homepage_user'],
							'UPC'=>$_POST['UPC'],
							'description'=>$_POST['description'],
							'additional_terms_of_sale'=>$_POST['terms_of_sale'],
							'shipping_method'=>$payment_method,
							'shipping_class'=>$shipping_class,
							'buyer_pays_amount_shipping_vice'=>$buyer_pays_amount_shipping_vice,
							'pays_for_shipping'=>$_POST['shiping_payer'],
							'where_you_will_ship'=>$_POST['shipping_place'],
							'return_policy'=>$_POST['return_policy'],	
							'duration_days'=>$_POST['duration_days'],
							'relist_options'=>$_POST['relist_options'],
                            'fixed_price'=>$_POST['fixed_price'],
                            'fixed_price_with_commission'=>$fixed_price_with_commission,
                            'quantity'=>$_POST['quantity'],
							'starting_bid'=>$_POST['starting_bid'],
							'reserve_price'=>$_POST['reserve_price'],
							'buy_now_price'=>$_POST['buy_now_price'],
							'end_auction'=>$end_auction,
							'is_active'=>1
							);

			/*if($_POST['manufacturer']!='Other'){
				$list_info['manufacturer']=$_POST['manufacturer'];
			}else{
				$list_info['manufacturer']=$_POST['other_manufacturer_name'];
			}*/

			if($_POST['relist_options']=='Relist After Sold'){
				$list_info['relist_time_after_sold']=$_POST['relist_time_after_sold'];  
			}

			$list_id=$this->user_model->update_data('lists',$list_info,array('id'=>$id));
			if($_POST['sales_tax'] = 1)
            {
            	$sales_tax = $_POST['sales_tax'];
            	$co_tax = $_POST['co_tax'];

            	$this->user_model->delete_data('list_sales_tax',array('list_id' =>$id));
             if(!empty($co_tax))
             {
             	 $co_taxes =array(
             	 	'list_id'=>$id,
             	 	'tax_type'=>'CO',
             	 	'state'=>'',
             	 	'tax'=>$_POST['co_tax'],
              
             );
             	$this->user_model->insert_data('list_sales_tax',$co_taxes);
             }
             $fm_tax  = $_POST['fm_tax'];
             if(!empty($fm_tax))
             {
             	$fm_taxes = array(
             	 	'list_id'=>$id,
             	 	'tax_type'=>'FM',
             	 	'state'=>'',
             	 	'tax'=>$_POST['fm_tax']
             	 
              
             );
             	$this->user_model->insert_data('list_sales_tax',$fm_taxes);
             }
             $hi_tax = $_POST['hi_tax'];
             if(!empty($hi_tax))
             {
             	$hi_taxes = array(
             	 	'list_id'=>$id,
             	 	'tax_type'=>'HI',
             	 	'state'=>'',
             	 	'tax'=>$_POST['hi_tax']
              
             );
             	$this->user_model->insert_data('list_sales_tax',$hi_taxes);
             }

             $state_tax = $_POST['state_tax'];
			
            $codes = $_POST['codes'];
			if(!empty($state_tax))
			{
				for($i=0;$i< count($state_tax); $i++)
    	          {
    	         $dynamic_taxes = array(
             	 	'list_id'=>$id,
             	 	'tax_type'=>'',
             	 	'state'=>$codes[$i],
             	 	'tax'=>$state_tax[$i]
              
             );
             	$this->user_model->insert_data('list_sales_tax', $dynamic_taxes);
             	}
			}  
            }
            if($_POST['$sales_tax'] = 0)
            {
                $sales_tax = $_POST['sales_tax'];
            }

			if(!empty($_FILES)){
				$all_files = $this->uploadMultipleFiles('./assets/img/listing_photos/','a_file');
				$files = explode(',',$all_files);
				array_pop($files);
				$cnt=1;

				foreach($files as $file){
					$pictures = array(
									  'list_id'=>$id,	
									  'url'=>trim($file),
									  'type'=>'photo'
									 );
					if($cnt==1 && $is_featured_exist==0 ){
						$pictures['is_featured']='1';
					}
					$this->user_model->insert_data('list_attachments',$pictures);
					$this->resizeImage(trim($file));
					$cnt++;
				}
			}

			$v1=array_filter($_POST['a_video_url']);
			$v2 = array_values($v1);
			if(!empty($v2)){
				foreach ($v2 as $video_url) {
					if (strpos($video_url, 'watch?v=') == true && strpos($video_url, '&') == true) {
		    			$value = str_replace("watch?v=","embed/",$video_url);
		    			$variable1 = substr($value, 0, strpos($value, "&"));
					}else if (strpos($video_url, 'watch?v=') == true && strpos($video_url, '&') == false) {
		    			$variable1 = str_replace("watch?v=","embed/",$video_url);
					}else if(strpos($video_url, 'youtu.be') == true){
						$variable1 = str_replace("youtu.be","www.youtube.com/embed",$video_url);
					}else{
						$variable1 = $video_url;
					}
					$video_info['list_id']=$id;
					$video_info['url']=$variable1;
					$video_info['type']='video_url';
					$this->user_model->insert_data('list_attachments',$video_info);
				}
			}

			     redirect(base_url('upload-video/'.$final_slug.'/update'));
			
				//redirect(base_url('list-success/'.$final_slug.'/update'));
		}
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

 	public function get_all_buying_list_fixed()
 	{
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
      	

        	$data['network_info'] = $this->user_action_model->get_all_buying_fixed_details($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_buying_fixed_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/buying_fixed', $data,true);

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

 	public function get_all_watch_list_item_fixed(){ 
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
        	$data['network_info'] = $this->user_action_model->get_all_watchlist_fixed($where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_watchlist_fixed_pagination($where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/watchlist_fixed', $data,true);

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
        	

        	$data['network_info'] = $this->user_action_model->get_all_selling_details($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_all_selling_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');
  			
  			$result1 =$this->load->view('user/network/selling', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}

 	public function get_all_schedule_list(){ 
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

        	$data['network_info'] = $this->user_action_model->get_schedule_list($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_schedule_list_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/schedule_list', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}


 	public function get_all_sold_list(){ 
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

        	$data['network_info'] = $this->user_action_model->get_sold_list($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_sold_list_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
        	$data['firearms_commission']=$this->user_model->select_data('*','commission');

  			$result1 =$this->load->view('user/network/sold_list', $data,true);

  		$result = array($result1); 
        echo json_encode($result); 

 	}

 	public function get_all_unsold_list(){ 
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

        	$data['network_info'] = $this->user_action_model->get_unsold_list($dataType,$where,$view,$session_id,$limit,$offset,$shortlist_item,$order_by); 
        	$data['pagination'] = $this->user_action_model->get_unsold_list_pagination($dataType,$where,$view,$session_id,$limit,$offset); 
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

 	public function get_mynetwork_video(){ 
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

        	if(isset($where['video_id'])){
            	$video_id = $where['video_id'];
            	$data['video_id'] =$video_id;
            	unset($where['video_id']);
        	}       	
    	

        	     

        	$data['all_videos'] = $this->user_action_model->get_all_my_network_video($where,$view,$session_id,$limit,$offset); 
        	$data['pagination'] = $this->user_action_model->get_all_my_network_video_pagination($where,$view,$session_id,$limit,$offset); 

        	 $count_res = count($data['all_videos']);
	        $result2 = '';

	        if($count_res < $limit){
	            $result2 ="end";
	        }  
	        if($count_res == 0){
	            $result2 ="end";
	        }     
  			$result1 =$this->load->view('user/network/my_network_video', $data,true);

  		$result = array($result1,$result2); 
        echo json_encode($result); 
 	}

 	public function relist_item(){ 
 		$list_id = $this->input->post('list_id'); 
 		$query = $this->user_model->select_data('*','lists',array('id'=>$list_id));
		$prev_data = json_encode($query);

		$status = $query[0]['status'];

		if($status=='sold'){
			$result=$this->user_action_model->create_list_for_sold($list_id);
            if ($result) {
                echo "Success";
            }else{
               	echo "failed";
            }

		}else{
			$end_auction = $query[0]['end_auction'];
			$duration_days = $query[0]['duration_days'];
			$today=date("Y-m-d H:i:s");
	        if($end_auction > $today ){
	            $end_auction = date("Y-m-d H:i:s", strtotime($end_auction. ' + '.$duration_days.' days'));
	        }else{
	            $end_auction=  date("Y-m-d H:i:s", strtotime($today. ' + '.$duration_days.' days'));
	        }
			$end_auctions = array('end_auction'=>$end_auction);			
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
		
 	}

 	public function relist_sold_all(){ 
 		$list_id = $this->input->post('list_id'); 
 		$total=count($list_id);
 		$val='';
 		for ($i=0; $i < $total ; $i++) {  	
 			$query = $this->user_model->select_data('*','lists',array('id'=>$list_id[$i]));
			$prev_data = json_encode($query);
			$status = $query[0]['status'];
			if($status=='sold'){
				$result=$this->user_action_model->create_list_for_sold($list_id[$i]);	
			}
		}
		echo "Success";	

	}	



 	public function relist_expired_list(){ 
 		$list_id = $this->input->post('list_id'); 
 		$total=count($list_id);
 		for ($i=0; $i < $total ; $i++) {  	
 			$query = $this->user_model->select_data('*','lists',array('id'=>$list_id[$i]));
			$prev_data = json_encode($query);

			$status = $query[0]['status'];

			if($status=='sold'){
			}else{
				$end_auction = $query[0]['end_auction'];
				$duration_days = $query[0]['duration_days'];
				$today=date("Y-m-d H:i:s");
		        if($end_auction > $today ){
		            $end_auction = date("Y-m-d H:i:s", strtotime($end_auction. ' + '.$duration_days.' days'));
		        }else{
		            $end_auction=  date("Y-m-d H:i:s", strtotime($today. ' + '.$duration_days.' days'));
		        }
				$end_auctions = array('end_auction'=>$end_auction);			
				$result=$this->user_model->update_data('lists',$end_auctions,array('id'=>$list_id[$i]));
				if ($result) {
					$last_q=$this->db->last_query();
					$session_id=$this->session->userdata('user_id');
					$user_log = array(
	                                    'user_id'=>$session_id,
	                                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
	                                    'previous_data'=>$last_q.$prev_data,
	                                    'action'=>'all_relist'
	                                   );
	                $this->user_model->insert_data('list_log',$user_log);
				
				}else{
				}
			}

 		}		
		echo "Success";		
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

		$start_amount=$query[0]['fixed_price'];
		$title=$query[0]['title'];
		$item_number=$query[0]['item_number'];
		$seller_id=$query[0]['user_id'];
	

		$amount_details=get_buynow_amount_details($start_amount);

		if(!empty($amount_details)){				
			$amount_details_update = array('sold_on_price'=>$amount_details['sold_on_price'],'firearms_commission'=>$amount_details['firearms_commission'],'seller_earn'=>$amount_details['seller_earn'],'commission_percentage_at_sold'=>$amount_details['commission_percentage_at_sold']);			
			$this->user_model->update_data('lists',$amount_details_update,array('id'=>$list_id));
		}

	
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
			$this->common_model->send_email_to_seller($seller_email_id,$subject_s,$msg_s,$data);
		
			//send mail to buyer 
			$buyer_email_id=$data['buyer_info'][0]['email_id'];
			$datab['thumb_list_img']=$thumb_list_img;
            $datab['commission_amount']=$amount;
			$datab['username']=$data['buyer_info'][0]['first_name'];
		
			 $subject_b='Congratulations You Won Item #'.$item_number.'  ';
			
			$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$seller_id));

			$msg_b='You have won a item from firearms network here is the item details';
			$this->common_model->send_email_to_buyer($buyer_email_id,$subject_b,$msg_b,$datab);
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


	public function  buynow_list_for_fixed_type(){

 		$list_id = $this->input->post('list_id');
 		$qtyselected = $this->input->post('qtyselected');

 		if($list_id>0)
 		{
	 		$thumb_image=get_thumb_image($list_id);

			if (!empty($thumb_image)) {
				$thumb_list_img = $thumb_image->url;
			}else{
				$thumb_list_img ='blank.jpg';
			}
		
	 		$firearms_commission=$this->user_model->select_data('*','commission');
			$query = $this->user_model->select_data('*','lists',array('id'=>$list_id));

			$start_amount=$query[0]['fixed_price'];
			$title=$query[0]['title'];
			$item_number=$query[0]['item_number'];
			$seller_id=$query[0]['user_id'];
	        $remaing_quantity = $query[0]['remaing_quantity'];

            if(!empty($qtyselected)){
             	$remaing_quantity = $remaing_quantity - $qtyselected; 
            }

			$amount_details=get_buynow_amount_details($start_amount);


			if(!empty($amount_details)){				
				$amount_details_update = array('sold_on_price'=>$amount_details['sold_on_price'],'firearms_commission'=>$amount_details['firearms_commission'],'seller_earn'=>$amount_details['seller_earn'],'commission_percentage_at_sold'=>$amount_details['commission_percentage_at_sold']);			
				$this->user_model->update_data('lists',$amount_details_update,array('id'=>$list_id));
			}
		
	        $amount=amount_with_commission($start_amount);
	        $data['commission_amount'] = array('final_amount' => $amount);    
	      	$data['list_details'] = array('list_details' => $query);
			$session_id=$this->session->userdata('user_id');
	        $data['commission_amount'] = array('final_amount' => $amount);    
	      	$data['list_details'] = array('list_details' => $query);
	      	$prev_data=json_encode($data);
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
			$this->common_model->send_email_to_seller($seller_email_id,$subject_s,$msg_s,$data);
		
			//send mail to buyer 
			$buyer_email_id=$data['buyer_info'][0]['email_id'];
			$datab['thumb_list_img']=$thumb_list_img;
            $datab['commission_amount']=$amount;
			$datab['username']=$data['buyer_info'][0]['first_name'];
		
			 $subject_b='Congratulations You Won Item #'.$item_number.'  ';
			
			$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$seller_id));

			$msg_b='You have won a item from firearms network here is the item details';
			$this->common_model->send_email_to_buyer($buyer_email_id,$subject_b,$msg_b,$datab);

			$sell_fixed_item = array(
                           'list_id'=>$list_id,
                           'buyer_id'=>$session_id,
                           'quantity'=>$qtyselected,
                           'is_sold'=>'1',
                           'sold_on_price'=>$amount_details['sold_on_price'],
                           'firearms_commission'=>$amount_details['firearms_commission'],
                           'seller_earn'=>$amount_details['seller_earn'],
                           'commission_percentage_at_sold'=>$amount_details['commission_percentage_at_sold']
			);
            if($remaing_quantity == 0)
            {
			$buynow_update = array('remaing_quantity'=>$remaing_quantity,'is_sold'=>'1','status'=>'sold','buyer_id'=>$session_id,'is_sold_by'=>'buynow');			
			$result=$this->user_model->update_data('lists',$buynow_update,array('id'=>$list_id));

			$this->user_model->insert_data('sell_fixed_item',$sell_fixed_item);
	        
	        }else
	        {
	        	$buynow_update = array('remaing_quantity'=>$remaing_quantity,'buyer_id'=>$session_id,'is_sold_by'=>'buynow');			
			$result=$this->user_model->update_data('lists',$buynow_update,array('id'=>$list_id));
			$this->user_model->insert_data('sell_fixed_item',$sell_fixed_item);

	        }
			
			if ($result) {
				echo "Success";
			}else{
				echo "Failed";
			}

        //mail end    
    
	 	}
 	
}


 	public function all_bid_delete_from_bid(){ 
 		$bid_id = $this->input->post('bid_id'); 
 		$total=count($bid_id);
 		for ($i=0; $i < $total ; $i++) {  		
 			// $delete_update = array('is_deleted'=>'1');			
		  //   $this->user_model->update_data('bid',$delete_update,array('id'=>$bid_id[$i]));
		    $this->db->where('id', $bid_id[$i]);
  			$this->db->delete('bid');
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

        $check_won_list=get_bid_won($list_id);

      

        if($no_of_rows > 0)
        {  
    		$i=0;	
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
						$accept_btn='<button type="button" class="cancel_btn"  onclick="cancel_request('.$bid_id.','.$list_id.','.$bider_id.');" '.$diplaycls.'>Cancel</button>';
						$status_val='Won';


						}else{

							$accept_btn='<button type="button" class="accept_btn"  onclick="reaccept_request('.$bid_id.','.$list_id.','.$bider_id.','.$bid_amount.');" '.$diplaycls.'>Accept</button>';
							$status_val='Failed';						
						}	
					}
				

				}else{
					$accept_btn='<button type="button" class="accept_btn"  onclick="accept_request('.$bid_id.','.$list_id.','.$bider_id.');" '.$diplaycls.'>Accept</button>';
					$status_val='Waiting';
					$disable_cls="";
					$opacity="";
				}


		$user_type=$this->session->userdata('user_type');
			
		if ($user_type=='seller') {

			$action_btn=''.$accept_btn.'
                  <button type="button" class="delete_btn" '.$disable_cls.' onclick="delete_request('.$bid_id.');" '.$diplaycls.' style="opacity:'.$opacity.'">Delete</button>';

            $select_all='<td class="bidallselect">
                  <figure class="media ">
                    <input name="chk_bid_id " class="chk_bid_id" type="checkbox" value="'.$bid_id.'" >
                    <figcaption class="media-body">
                      <h6 class="title text-truncate"></h6>
                    </figcaption>
                  </figure> 
                </td>';
						
		}else{ 

			$action_btn='<button type="button" class="delete_btn" disabled  style="opacity:0.4">Delete</button>';
			$select_all='';
		
		}				

		if ($i==0) {
			if ($check_won_list=='won') {
        	$check_won_btn='<input type="hidden" id="bid_status_won" name="bid_status_won" value="1">';
    		}else{
    		$check_won_btn='<input type="hidden" id="bid_status_won" name="bid_status_won" value="0">';		
    		}			
		}

          echo '<tr >'.$select_all.'<td> 
                  <div class="price-wrap"> 
                    <p class="text-left">'.$first_name.' '.$check_won_btn.'</p>                     
                  </div> 
                </td>
                <td>'.number_format($bid_amount,2).'</td>      
                <td>'.$status_val.'</td>        
                <td class="text-right ">'.$action_btn.'
                </td>
             </tr>'; 
            $i++; 
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
		// $delete_update = array('is_deleted'=>'1');			
		// $result=$this->user_model->update_data('bid',$delete_update,array('id'=>$delete_id));

		
		$this->db->where('id', $delete_id);
  		$result=$this->db->delete('bid');

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

		$amount_details=get_bid_with_commission_amount_details($bid_amount);

		if(!empty($amount_details)){

			$amount_details_update = array('sold_on_price'=>$amount_details['sold_on_price'],
				'firearms_commission'=>$amount_details['firearms_commission'],
				'seller_earn'=>$amount_details['seller_earn'],
				'commission_percentage_at_sold'=>$amount_details['commission_percentage_at_sold']);			
			$this->user_model->update_data('lists',$amount_details_update,array('id'=>$list_id));
		}


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
			$this->common_model->send_email_to_seller($seller_email_id,$subject_s,$msg_s,$data);


			//send mail to buyer 

			$buyer_email_id=$data['buyer_info'][0]['email_id'];
			$datab['list_info']= $data['list_info'];
			$datab['thumb_list_img']=$thumb_list_img;
            $datab['commission_amount']=$bid_amount;
			$datab['username']=$data['buyer_info'][0]['first_name'];
		
			$subject_b='Congratulations You Won Item #'.$item_number.'  ';
			
			$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$session_id));

			$msg_b='You have won a item from firearms network here is the item details';
			$this->common_model->send_email_to_buyer($buyer_email_id,$subject_b,$msg_b,$datab);

			echo "Success";
		}else{
			echo "error";
		}
    }

    public function bid_cancel(){  		
		$bid_id = $this->input->post('id'); 	
		$list_id = $this->input->post('list_id'); 
		$bider_id = $this->input->post('bider_id'); 

		$status = array('status'=>'','buyer_id'=>'','is_sold_by'=>'','is_sold'=>'','sold_on_price'=>'','firearms_commission'=>'','seller_earn'=>'','commission_percentage_at_sold'=>'');			
		$this->user_model->update_data('lists',$status,array('id'=>$list_id));

		$accept_bid_update = array('is_won'=>'0');			
		$result=$this->user_model->update_data('bid',$accept_bid_update,array('id'=>$bid_id));
		if ($result) {

			// mail start

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
			
			$session_id=$this->session->userdata('user_id');
			$user_log = array(
                            'user_id'=>$session_id,
                            'ip_address'=>$_SERVER['REMOTE_ADDR'],
                            'previous_data'=>$prev_data,
                            'action'=>'bid_cancel'
                           );
                $this->user_model->insert_data('list_log',$user_log);

                //send mail to seller

            $data['thumb_list_img']=$thumb_list_img;
            $data['commission_amount']=$bid_amount;
           
	        $data['list_info']=$this->user_model->select_data('*','lists',array('id'=>$list_id));
	        $data['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$bider_id));
	        $data['seller_info']=$this->user_model->select_data('*','user',array('id'=>$session_id));

			$subject_s='You Cancelled bid for Item #'.$item_number.'  ';
			$msg_s='You Cancelled bid for this item  here is the item details ';
			$data['username']=$data['seller_info'][0]['first_name'];
			$seller_email_id=$data['seller_info'][0]['email_id'];
			$this->common_model->send_email_to_seller($seller_email_id,$subject_s,$msg_s,$data);


			//send mail to buyer 

			$buyer_email_id=$data['buyer_info'][0]['email_id'];
			$datab['list_info']= $data['list_info'];
			$datab['thumb_list_img']=$thumb_list_img;
            $datab['commission_amount']=$bid_amount;
			$datab['username']=$data['buyer_info'][0]['first_name'];
		
			$subject_b='Sorry your bid cancelled for Item #'.$item_number.'  ';
			
			$datab['buyer_info']=$this->user_model->select_data('*','user',array('id'=>$session_id));

			$msg_b='Your bid cancelled for this  item from firearms network here is the item details';
			$this->common_model->send_email_to_buyer($buyer_email_id,$subject_b,$msg_b,$datab);

			//mail end

			echo "Success";
		}else{
			echo "error";
		}
    }

    public function bid_reaccept(){  		
		$bid_id = $this->input->post('id'); 	
		$list_id = $this->input->post('list_id'); 
		$bider_id = $this->input->post('bider_id');
		$bid_amount = $this->input->post('bid_amount');

		$bider_info = array('buyer_id'=>$bider_id);			
		$this->user_model->update_data('lists',$bider_info,array('id'=>$list_id));

		$status = array('is_won'=>'0');			
		$this->user_model->update_data('bid',$status,array('list_id'=>$list_id));


		$amount_details=get_bid_with_commission_amount_details($bid_amount);
		if(!empty($amount_details)){
			$amount_details_update = array('sold_on_price'=>$amount_details['sold_on_price'],'firearms_commission'=>$amount_details['firearms_commission'],'seller_earn'=>$amount_details['seller_earn'],'commission_percentage_at_sold'=>$amount_details['commission_percentage_at_sold']);			
			$this->user_model->update_data('lists',$amount_details_update,array('id'=>$list_id));
		}

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
		//  echo "<pre>";
		//  print_r($data['chat_users']);die;
	
		$data['message']=true;
		$data['view_name'] = "user/message";

		$this->load->view('template', $data);

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

    public function demo()
    {
    	$this->load->view("front/demo");
    }
    public function add_demo()
    {

    }


}