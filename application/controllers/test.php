<?php

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        include APPPATH . 'third_party/paytraceapi.php';

        $this->load->library('image_lib'); // load image library
        $this->load->model('user_model');
        $this->load->model('user_action_model');
        $this->load->model('common_model');
        // $this->load->model('test_model');
    }

    public function index() {
        if ($this->input->post()) {
            echo "<pre>";
            print_r($this->input->post());

            $credit_card = $this->input->post('credit_card');
            $exp_month = $this->input->post('exp_month');
            $exp_year = $this->input->post('exp_year');
            $csc = $this->input->post('csc');
            $address = $this->input->post('address');
            $zip = $this->input->post('zip');

            $PayTraceAPI = new PayTraceAPI();
            //set the properties for this request in the class
            $PayTraceAPI->SetUN("mayuri.joshi@webhungers.com");
            $PayTraceAPI->SetPSWD("mayuweb123");
            $PayTraceAPI->SetTERMS("Y");
            $PayTraceAPI->SetMETHOD("ProcessTranx");
            $PayTraceAPI->SetTRANXTYPE("Sale");
            $PayTraceAPI->SetAMOUNT("1.00");

            $PayTraceAPI->SetCC($credit_card); //"4012881888818888"
            $PayTraceAPI->SetEXPMNTH($exp_month); //"01"
            $PayTraceAPI->SetEXPYR($exp_year); //"25"
            $PayTraceAPI->SetCSC($csc); //"999" 
            $PayTraceAPI->SetBADDRESS($address); //"1234 Main"
            $PayTraceAPI->SetBZIP($zip); //"10001"
            //process the request which will format the request, send it to the API, and parse the response
            $PayTraceAPI->ProcessRequest();
            //determine if the transaction was approved
            if ($PayTraceAPI->WasTransactionApproved() == true) {
                //...handle the approved transaction, store the order, send a receipt, etc.
                echo "Transaction was approved!<br>";
                echo "Transaction ID = " . $PayTraceAPI->GetTRANSACTIONID() . "<br>";
                echo "Approval Code = " . $PayTraceAPI->GetAPPCODE() . "<br>";
            } elseif ($PayTraceAPI->DidErrorOccur() == true) {
                //an error was returned from the API, likely invalid data was provided
                echo "Transaction was not processed per this error: " . $PayTraceAPI->GetERROR() . "<br>";
            } else {
                //the transaction was not approved by the issuer. Depending on your product/industry, you may want to display the response or just prompt for another form of payment
                echo "Transaction was not approved per this response: " . $PayTraceAPI->GetAPPMSG() . "<br>";
            }
        } else {
            $this->load->view('paytrace_form');
        }
    }

//public function category(){
//        $data['categories'] = $this->test_model->getCategoriesRows();
//        $this->load->view('front/test_manufacturer', $data);
//    }
    
//    public function getmanufacturer(){
//        $manufacturer = array();
//        $category_id = $this->input->post('category_id');
//        if($category_id){
//            $con['conditions'] = array('category_id'=>$category_id);
//            $manufacturer = $this->test_model->getManufacturerRows($con);
//            var_dump($manufacturer);
//        }
//        echo json_encode($manufacturer);
//    }
//    
   
    public function category() {
      $categories = $this->db->get("categories")->result();
      $this->load->view('front/test_manufacturer', array('categories' => $categories )); 
      
   } 

   public function getmanufacturer($id) { 
       //$where="(category_id='".$id."' AND parent_id='".'0'."')";
       $manufacturer = $this->db->where($where)->get('category_id',$id)->result();
       echo json_encode($manufacturer);
   }


    

}
