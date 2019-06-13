<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
curl -X POST https://api.paytrace.com/oauth/token  \
  -H 'Content-Type application/x-www-form-urlencoded; charset=UTF-8' \
  --data 'grant_type=password&username=demo1&password=demo123'                                                                                   
Authorization:Bearer 4656d6f6132333:4656d6f6132333:2b607b9a44720c9c3ca867653c7e6ef8b3f3802709c17f2a54402820d155f214
*/

class paytraces extends CI_Controller {

  public $user_data1 = array();
  
  function __Construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->data['title'] = 'Paytrace';
    // $this->request_data = array('1');
  }

                                                                                                         
  function index($slug='')
  { 
    if ($this->input->post()) {
      
      $name = $this->input->post('full_name');
      $amount = $this->input->post('list_amount');
      $credit_card = $this->input->post('credit_card'); 
      $exp_month = $this->input->post('exp_month');
      $exp_year = $this->input->post('exp_year');
      $csc = $this->input->post('csc');
      $address = $this->input->post('address');
      //$city = $this->input->post('city');
      //$state = $this->input->post('state');
      //$zip = $this->input->post('zip');

      // $this->user_data1 = array(
      //               "amount" => "2.55",
      //               "credit_card"=> array (
      //                    "number"=> "4111111111111111",
      //                    "expiration_month"=> "12",
      //                    "expiration_year"=> "2020"),
      //               "csc"=> "999",
      //               "billing_address"=> array(
      //                   "name"=> "akshay sharma",
      //                   "street_address"=> "8320 E. West St.",
      //                   "city"=> "Spokane",
      //                   "state"=> "WA",
      //                   "zip"=> "85284")
      //               );

      $this->user_data1 = array(
                      "amount" => $amount,
                      "credit_card"=> array (
                           "number"=> $credit_card,
                           "expiration_month"=> $exp_month,
                           "expiration_year"=> $exp_year),
                      "csc"=> $csc,
                      "billing_address"=> array(
                          "name"=> $name,
                          "street_address"=> $address,
                          "city"=> '',
                          "state"=> '',
                          "zip"=> '')
                     );
   

     include APPPATH . 'third_party/paytraces/KeyedSaleJson.php';
      echo "<br>*******";
      echo "<pre>";

      if($this->user_data1['res']['http_status_code']==200){
        echo "insert";
           print_r($this->user_data1['res']['temp_json_response']);
      }else{
        echo "error message";
      }
     
       print_r($this->user_data1);die;

      //$data['view_name']    = "user/success";
     // $this->load->view('template', $data);
      
    }else{
      $slug='testing-2';
      //$this->load->view('paytrace_form');
      $data['list_info']=$this->user_model->select_data('buy_now_price','lists',array('slug'=>$slug));
      $data['view_name']    = "paytrace_form";
      $this->load->view('template', $data);
    }
  }
    function signing_amount($id='')
    { 
      if ($this->input->post()) {
        
        $name = $this->input->post('full_name');
        $amount = $this->input->post('list_amount');
        $credit_card = $this->input->post('credit_card');
        $exp_month = $this->input->post('exp_month');
        $exp_year = $this->input->post('exp_year');
        $csc = $this->input->post('csc');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $zip = $this->input->post('zip');
        $seller_id = $this->input->post('seller_id');

        $this->user_data1 = array(
                      "amount" => $amount,
                      "credit_card"=> array (
                           "number"=> $credit_card,
                           "expiration_month"=> $exp_month,
                           "expiration_year"=> $exp_year),
                      "csc"=> $csc,
                      "billing_address"=> array(
                          "name"=> $name,
                          "street_address"=> $address,
                          "city"=> $city,
                          "state"=> $state,
                          "zip"=> $zip)
                      );
    $check_user=$this->user_model->select_data('id','user_card_details',array('user_id'=>$seller_id));
    if(!empty($check_user)){

       $user_cc_update = array('user_id'=>$seller_id,'cc_no'=>$credit_card,'expire_month'=>$exp_month,'expire_year'=>$exp_year,'cvv'=>$csc,'card_holder_name'=>$name,'address'=>$address,'city'=>$city,'state'=>$state,'zipcode'=>$zip);
              $this->user_model->update_data('user_card_details',$user_cc_update,array('user_id'=>$seller_id));

    }else{
       $user_cc_insert = array('user_id'=>$seller_id,'cc_no'=>$credit_card,'expire_month'=>$exp_month,'expire_year'=>$exp_year,'cvv'=>$csc,'card_holder_name'=>$name,'address'=>$address,'city'=>$city,'state'=>$state,'zipcode'=>$zip);
            $this->user_model->insert_data('user_card_details',$user_cc_insert);
    }
 
    include APPPATH . 'third_party/paytraces/KeyedSaleJson.php';
    

      if($this->user_data1['res']['http_status_code']==200){
   
          $transaction_details = array(
                        'payment_json'=>$this->user_data1['res']['temp_json_response'],
                        'status'=>'success',
                        'user_id'=>$seller_id,
                        'payment_for'=>'login_amount'                               
                        );
    $card_no='';
      $jsonary=json_decode($this->user_data1['res']['temp_json_response'], true);
          if ($jsonary) {
              if (isset($jsonary['masked_card_number'])) {
                $card_no= $jsonary['masked_card_number'];     
              }
            }

          $this->user_model->insert_data('payment_details',$transaction_details);

          $update_amount=array('is_signing_amount_paid'=>1,'user_card_details'=>$card_no);
          $this->user_model->update_data('user',$update_amount,array('id'=>$seller_id));
          $data['success_msg'] = "Your payment done successfully. Now you can login with your seller account.";
          $data['view_name']    = "front/sign_in";     
        $this->load->view('template', $data); 
      }else{
       
        $transaction_details = array(
                'payment_json'=>$this->user_data1['res']['temp_json_response'],
                'status'=>'failed',
                'user_id'=>$seller_id,
                'payment_for'=>'login_amount'                               
                );
        $this->user_model->insert_data('payment_details',$transaction_details);

        $data['success_msg'] = "Your account information in not valid to make this payment";
        $data['list_settings']=$this->user_model->select_row('amount_for_seller_login','list_settings',array('id'=>1));
        $data['sellerid']=$seller_id;
        $data['view_name']    = "signing_amount";
        $this->load->view('template', $data);
      }       

    }else{

      //$this->load->view('paytrace_form');
      $data['list_settings']=$this->user_model->select_row('amount_for_seller_login','list_settings',array('id'=>1));
      $data['sellerid']=$id;
      $data['view_name']    = "signing_amount";
      $this->load->view('template', $data);
    }
  }

  function settlement()
  {
    include APPPATH . 'third_party/paytraces/Settel_peyment.php';
  } 

  function paytrace_refund(){
    include APPPATH . 'third_party/paytraces/KeyedRefundJson.php';
  }

  function transaction_details(){
    $content = trim(file_get_contents("php://input"));
    $trans_details = json_decode($content,true);
    $transaction_details = array(
                                'payment_details'=>$content,
                                'status'=>$trans_details['success']
                                );
    $this->user_model->insert_data('payment_details',$transaction_details);
  }

}
