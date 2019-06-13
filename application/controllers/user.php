<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('common_model');

    }

    /*public function index()
    {   
        $this->isLoggedIn();
    }*/

    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            return 0;
        }
        else
        {
           return 1;
        }
    }

    public function send_email($email,$subject,$msg){
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $body=$this->load->view('front/email_template',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('mayuri.joshi@webhungers.com', 'FireArms');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function send_email_new($email,$subject,$msg){
        $data['data']=$msg;
        $config['charset'] = 'iso-8859-1';  
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        echo $body=$this->load->view('front/firearms_mail',$data,TRUE);
        $this->email->initialize($config);  
        $this->email->from('mayuri.joshi@webhungers.com', 'FireArms');
        $this->email->to($email); 
        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    public function test_user(){ 

        $selectbasic='1 chosw';
        $message='This is my fist  messge ';
        $contactus_email="abc@gmail.com";
            $subject='Admin, Contact Information';
            $data['heading']='Contact Information ';
            $data['name']='Admin';
            $data['selectbasic']=$selectbasic;
            $data['message']=$message;
            $data['contactus_email']=$contactus_email;
            $data['subject']=$subject;
            

            $msg['data']=$data;

          $email="pramodchoudhary.71@gmail.com";
            //$this->send_email_new($email,$subject,$msg);
            $check_email=$this->common_model->contact_us_mail($email,$subject,$msg);
           

    }

    public function sign_up()
    {
        $check_email=$this->user_model->checkEmailExist($_POST['email']);
        if($check_email==0){
        $code = substr(md5(microtime()) , 0 , 30);

        $password = str_replace(' ', '', $_POST['password']);

        $user_info = array(
                            'user_type'=>trim($_POST['user_type']),
                            'email_id'=>trim($_POST['email']),
                            'first_name'=>trim($_POST['fname']),
                            'company_name'=>trim($_POST['company_name']),
                            'password'=>md5(trim($password)),
                            'address1'=>trim($_POST['address1']),
                            'zipcode'=>trim($_POST['zipcode']),
                            'country'=>trim($_POST['country']),
                            'state'=>trim($_POST['state']),
                            'city'=>trim($_POST['city']),
                            'phone'=>trim($_POST['phone']),
                            'aoi'=>trim($_POST['aoi']),
                            'varification_token'=>$code 
                          );
        if($_POST['address2']!==''){
            $user_info['address2'] = $_POST['address2'];
        }

        if($_POST['business_phone']!==''){
            $user_info['business_phone'] = $_POST['business_phone'];
        }

        if(isset($_POST['ffl_licenced'])){
            $user_info['FFL_LGD'] = $_POST['ffl_licenced'];
        }

        if(isset($_POST['prefered_contact'])){
            $user_info['prefered_contact'] = $_POST['prefered_contact'];
        }


            $subject='Please verify your email address for new account on Firearms-Network';
            $data['heading']='Please Verify Your Email';
            $data['name']=$_POST['fname'];
            $data['message']='Thanks for registering! Please take a moment to confirm your registration. Please click the below link to verify your account.';
             $data['btn_show']='block';
            $data['link']=base_url('user/email_verification/'.$code);
            $data['btn_text']='Verify';

            $data['btn_url']=base_url('user/email_verification/'.$code);
            $msg['data']=$data;

            $email=$_POST['email'];

            $check_email=$this->common_model->send_email_new($email,$subject,$msg);
            echo $this->user_model->insert_data('user',$user_info);
        }else{
            echo 0;    
        }

    }

    public function update_profile(){   
        $session_id=$this->session->userdata('user_id');
        $user_info = array('first_name'=>$_POST['first_name'],
                            'company_name'=>$_POST['company_name'],
                            'address1'=>$_POST['address1'],
                            'address2'=>$_POST['address2'],
                            'zipcode'=>$_POST['zipcode'],
                            'country'=>$_POST['country'],
                            'state'=>$_POST['state'],
                            'city'=>$_POST['city'],
                            'FFL_LGD'=>$_POST['ffl_licenced'],
                            'prefered_contact'=>$_POST['prefered_contact'],
                            'aoi'=>$_POST['aoi'],
                            'business_phone'=>$_POST['business_phone'],
                            'phone'=>$_POST['phone']);       

        $result=$this->user_model->update_data('user',$user_info,array('id'=>$session_id));
        if ($result) {
            $res = $this->user_model->select_data('*', 'user' , array('id' => $session_id));
            $user_log = json_encode($res);

                $profile_log = array(
                                'user_id'=>$session_id,
                                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                'action'=>'update_profile',
                                'previous_data'=>$user_log
                                );
                $this->user_model->insert_data('user_log',$profile_log);

            echo 1;
        }else{
            echo 0;
        }     
    }

    public function email_verification($code){
        $check_code=$this->user_model->select_data('id,user_type,varification_token,is_verified,is_active,is_signing_amount_paid','user',array('varification_token'=>$code));
        $data['categories']=$this->user_model->select_data('name,slug','categories',array('parent_id'=>0));
        if(!empty($check_code)){
            $check_user_verified=$check_code[0]['is_verified'];
            $is_signing_amount_paid=$check_code[0]['is_signing_amount_paid'];
            $update_verification=array(
                                        'is_verified'=>1,
                                        'is_active'=>1
                                      );
            $this->user_model->update_data('user',$update_verification,array('id'=>$check_code[0]['id']));

            if($check_code[0]['user_type']=='seller'){

                $res = $this->user_model->select_data('turn_off_registration_fee', 'list_settings' , array());

                if ($res) {
                    if ($is_signing_amount_paid==1 && $check_user_verified==1) {
                        $data['view_name']    = "front/sign_in";
                        $data['success_msg']    = "Your account already verified.";
                        $this->load->view('template', $data);
                    }elseif ($res[0]['turn_off_registration_fee']=='1') {
                        $data['view_name']    = "front/sign_in";
                        if ($check_user_verified==1) {
                            $data['success_msg']    = "Your account already verified.".$check_user_verified;
                        }else{
                            $data['success_msg']    = "Your account has been successfully verified. You can login now.";
                        }                            
                        $this->load->view('template', $data);
                    }else{
                        if ($check_user_verified==1) {
                            $this->session->set_flashdata('verify_msg', 'already verified');
                        }else{
                            $this->session->set_flashdata('verify_msg', 'verified');
                        } 
                       
                        redirect (base_url('signing_amount/'.$check_code[0]['id']));
                    } 
                }else{
                    $data['view_name']    = "front/sign_in";
                    $data['success_msg']    = "Your account has been successfully verified. You can login now.";
                    $this->load->view('template', $data); 
                }                
            }else{
                $data['view_name']    = "front/sign_in";
                if ($check_user_verified==1) {
                    $data['success_msg']    = "Your account already verified.";
                }else{
                    $data['success_msg']    = "Your account has been successfully verified. You can login now.";
                }
               
                $this->load->view('template', $data); 
            } 
        }else{
            $data['view_name']    = "front/sign_in";
            $data['error_msg']    = "Something went wrong";
            $this->load->view('template', $data);
        }
    }

    public function sign_in()
    {
        if(!empty($_POST)){  
            if(isset($_POST['email']) && isset($_POST['password'])){
                $verify = $this->user_model->select_data('user_type,is_verified,is_active,is_admin_deleted,is_blocked,is_signing_amount_paid,fee_bypass_by_admin', 'user' , array('email_id' =>trim($_POST['email']),'password' => trim(md5($_POST['password']))));
                if(!empty($verify)){
                $check_status = $verify[0]['is_verified'];
                $user_status= $verify[0]['is_active'];
                $is_blocked= $verify[0]['is_blocked'];
                
                
                $turn_off_registration_fee=0;
                $res = $this->user_model->select_data('turn_off_registration_fee', 'list_settings' , array());
                $turn_off_registration_fee=$res[0]['turn_off_registration_fee'];
                $login_checked  = 0;
                if($check_status==1 && $user_status==1){

                    if($is_blocked==1){
                        echo 6;
                    }else{
                            // start
                        if($verify[0]['user_type']=='seller'){

                            if($turn_off_registration_fee==1){
                                //direct login
                                 $login_checked = 1;
                            }else if($verify[0]['is_signing_amount_paid']=='1' || $verify[0]['fee_bypass_by_admin']=='1'){
                                // login
                                 $login_checked = 1;
                            }else{
                                //pay amount
                                echo 5;
                            }

                        }
                        else{
                            $login_checked = 1;
                            }
                           
                            if ($login_checked == 1){
                            $user_detail=$this->user_model->select_data('*' , 'user' , array('email_id' => trim($_POST['email']),'password' => trim(md5($_POST['password']))));
                            
                                $user_logged_in=array('is_login'=>'1');
                                $this->user_model->update_data('user',$user_logged_in,array('id'=>$user_detail['0']['id']));

           
                             if(!empty($user_detail)){
                                    $user_info = array(
                                                        'isLoggedIn' => TRUE,
                                                        'user_type' => $user_detail['0']['user_type'],
                                                        'user_id' => $user_detail['0']['id'],
                                                        'user_email' => $user_detail['0']['email_id']
                                                        );
                                    $this->session->set_userdata($user_info);

                                    if($_POST['remember']==1){
                                        setcookie('email', $_POST['email'], time() + (86400 * 30), "/"); // 86400 = 1 day
                                        setcookie('password', $_POST['password'], time() + (86400 * 30), "/"); // 86400 = 1 day
                                    }else{
                                        setcookie('email', '', time() - (86400 * 30), "/"); // 86400 = 1 day
                                        setcookie('password', '', time() - (86400 * 30), "/"); // 86400 = 1 day
                                    }
                                    $user_log = array(
                                                'user_id'=>$user_detail['0']['id'],
                                                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                                'action'=>'login'
                                               );
                                    $this->user_model->insert_data('user_log',$user_log);
                                    echo true;

                            }   
                        }
                     }

                    }else if($check_status==1 && $user_status==0){
                        //account in inactive
                        echo 4;
                    }else{
                        //email not verify
                        echo 2;
                    } 
                }else{
                echo false;
                }
            }else{
                echo false;
            }
        }else{
            redirect(base_url());
        }   
    }

    public function new_password() {
        if(!empty($_POST)){  
            $session_id=$this->session->userdata('user_id');
            $old_password=$_POST['old_password'];
            $new_password=$_POST['new_password'];
            $c_password=$_POST['c_password'];



            if(isset($old_password) && isset($new_password)){

            $verify = $this->user_model->select_data('*', 'user' , array('id' => $session_id,'password' => trim(md5($old_password))));
                if(!empty($verify)){
                    $user_log = json_encode($verify);
                    $bid_log = array(
                                'user_id'=>$session_id,
                                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                'action'=>'change_password',
                                'previous_data'=>$user_log
                                );

                    $this->user_model->insert_data('user_log',$bid_log);

                    $pass_update=array('password'=>md5($new_password));
                    $this->user_model->update_data('user',$pass_update,array('id'=>$session_id));
                    echo "success";
                }else{
                    echo "not_exist";
                }
            }else{
                echo false;
            }
        }else{
            redirect(base_url());
        }   
    }

    public function forgot_pass(){
        $check_email=$this->user_model->select_data('id,first_name','user',array('email_id'=>$_POST['f_email']));
        if(!empty($check_email)){
            $code = substr(md5(microtime()) , 0 , 30);
            $u_info['p_reset_code']=$code;
            echo $this->user_model->update_data('user',$u_info,array('id'=>$check_email[0]['id']));
            //ddd
            $subject='Forgotten Password Notification';
            $data['heading']=''.$check_email[0]['first_name'].', Reset Your Password';
            $data['name']=$check_email[0]['first_name'];
            $data['message']='At your request, FireArms has sent you the following URL(s) so that you may reset your password. If it was not at your request, then you should be aware that someone has entered your credentials as theirs in the forgotten password section of FireArms.<br>
                To change the password for all accounts associated with the email address '.$_POST['f_email'].' click below:';
            $data['btn_show']='block';
            $data['link']=base_url('reset-password/'.$code);
            $data['btn_text']='Reset Password';

            $data['btn_url']=base_url('reset-password/'.$code);
            $msg['data']=$data;

            $email=$_POST['f_email'];

           $this->common_model->send_email_new($email,$subject,$msg);

            //ss
    
        }else{
            echo 0;
        }
    }

    public function reset_password($p_code){
         $data['categories']=$this->user_model->select_data('name,slug','categories',array('parent_id'=>0));
         $check_p_code=$this->user_model->select_data('id','user',array('p_reset_code'=>$p_code));
         if(!empty($check_p_code)){
            $data['view_name']    = "front/reset_password";
            $data['code']=$p_code;
            $this->load->view('template', $data);
         }else{
            $data['view_name'] = "front/sign_in";
            $data['error_msg'] = "Something went wrong";
            $this->load->view('template', $data);
         }
    }

    public function update_password(){
        $check_p_code=$this->user_model->select_data('id','user',array('p_reset_code'=>$_POST['p_code']));
        if(!empty($check_p_code)){
            $update_pass['password']=md5($_POST['n_pass']);
            $update_pass['p_reset_code']='';
            echo $this->user_model->update_data('user',$update_pass,array('id'=>$check_p_code[0]['id']));
        }else{
           echo 0; 
         }
    }

    public function change_password()
    {    
        $is_login=$this->common_model->check_user_login();
        if($is_login==FALSE){
            redirect(base_url('sign-in'));
        }
        

        $data['view_name']    = "user/change_password";
        $this->load->view('template', $data);
        
    }
    public function logout() { 
        $session_id=$this->session->userdata('user_id');
        $user_logged_in=array('is_login'=>'0');
        $this->user_model->update_data('user',$user_logged_in,array('id'=>$session_id));                       
        $this->session->sess_destroy ();        
        redirect (base_url('sign-in'));
    }

    public function profile(){
        $is_login=$this->common_model->check_user_login();
        if($is_login==FALSE){
            redirect(base_url('sign-in'));
        }

        $session_id = $this->session->userdata('user_id');    
        $data['user_detail']=$this->user_model->select_row('*','user',array('id'=>$session_id));
        $data['favourite']=$this->user_model->get_user_fav($session_id);

        $data['profile']=true;
        $data['view_name']    = "user/profile";
        $this->load->view('template', $data);
    }

    public function favourite_remove($favid){
        $session_id = $this->session->userdata('user_id'); 
        $status=array('status'=>'0');
        $result=$this->user_model->update_data('followers',$status,array('follower_user_id'=>$session_id,'following_user_id'=>$favid));

        $this->session->set_flashdata('msg', 'Favouritesuccess');
        redirect (base_url('profile'));

    }

    public function calculation(){       
        $amount='1000';
        $commission='10';
        //$result=$this->user_model->get_final_amount($amount,$commission);
       // print_r("final amount----->".$result);

         $result=amount_with_commission($amount);
            print_r("final amount----->".$result);
    }

    public function seller_commission(){
        $user_id = '2';     
        $total_list=$this->user_model->get_total_list($user_id);

        print_r("Total list ----->".$total_list);
        echo "<br>";

        $min_list=''; 
        $discount_percentage=''; 
        $list_settings=$this->user_model->select_row('*','list_settings',array('id'=>'1'));
        if ($list_settings->min_list_for_discount) {
               $min_list=$list_settings->min_list_for_discount;
            } 
        if ($list_settings->discount_percentage) {
               $discount_percentage=$list_settings->discount_percentage;
            }    
        // $amount='100';
        // $commission='10';
        // $result=$this->user_model->get_final_amount($amount,$commission,$total_list,$discount_percentage,$min_list);
        // print_r("final amount----->".$result);
    }

    public function uploadFile($filename){
        $config['upload_path'] = './assets/img/profile_image/';
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

    public function change_profile_image(){
        $session_id = $this->session->userdata('user_id');
        if($_FILES['image']['name'] !=''){ 
            $img_result=$this->uploadFile('image'); 
            if ($img_result) {
                $user_detail=$this->user_model->select_data('*','user',array('id'=>$session_id));                    
                $user_log = json_encode($user_detail);

                $img_log = array(
                            'user_id'=>$session_id,
                            'ip_address'=>$_SERVER['REMOTE_ADDR'],
                            'action'=>'change_image',
                            'previous_data'=>$user_log
                            );

                $this->user_model->insert_data('user_log',$img_log);



                if($user_detail[0]['profile_image']){
                    $path = $_SERVER['DOCUMENT_ROOT'].'/firearms-new-dev/assets/img/profile_image/'.$user_detail[0]['profile_image'];                    
                    unlink($path);
                }                

                $update_image=array('profile_image'=>$img_result);
                $this->user_model->update_data('user',$update_image,array('id'=>$session_id));  
                echo 'success';       
            }else{
            echo 'failed';
            }          
        }else{
            echo 'failed';
        }

      
      
    }

      
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */