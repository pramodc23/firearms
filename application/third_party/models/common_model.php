<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{

	function check_user_login(){
        $isLoggedIn = $this->session->userdata('isLoggedIn');
           if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
            {
                return FALSE;
            }else {
                return TRUE;
            }
              }

public function contact_us_mail($email,$subject,$msg)
         {
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/contact_us_email_temp',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'FireArms');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        
    return    $this->email->send();

         }

    function send_email_new($email,$subject,$msg){
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/firearms_mail',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'FireArms');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function send_email_seller($email,$subject,$msg,$data=''){
        //echo "<----call send mail function--->";
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/email_template_seller',$data,TRUE);
        
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'Firearms Network');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }
    public function send_email_buyer($email,$subject,$msg,$data=''){
        //echo "<----call send mail function--->";
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/email_template_buyer',$data,TRUE);
        
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'Firearms Network');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

      public function send_email_to_seller($email,$subject,$msg,$data=''){
        //echo "<----call send mail function--->";
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/email_tem_to_seller',$data,TRUE);
      

        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'Firearms Network');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }
    public function send_email_to_buyer($email,$subject,$msg,$data=''){
        //echo "<----call send mail function--->";
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/email_tem_to_buyer',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('deepika.shaijulkar@webhungers.com', 'Firearms Network');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

}