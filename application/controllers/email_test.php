<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_test extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->library('image_lib'); // load image library
		$this->load->model('user_model');	
		$this->load->model('user_action_model');
		$this->load->model('common_model');			
	}

	
    public function send_email($email,$subject,$msg,$data=''){
    	//echo "<----call send mail function--->";
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/new_email_template',$data);
        
        $this->email->initialize($config);  
        $this->email->from('mayuri.joshi@webhungers.com', 'Firearms Network');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function test_user(){  
    	$data['list_info']=$this->user_model->select_data('*','lists',array('id'=>2));
			$subject='Post shared by the seller of firearms Network';
			$msg='Please view all the details below';
			$email = "";
			$this->send_email($email,$subject,$msg,$data);
    }


}