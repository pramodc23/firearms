<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('list_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Firearms Admin : Dashboard';

        $data['user_count'] = $this->user_model->userListingCount();
        $data['list_count'] = $this->list_model->userListingCount();
        $data['sold_item_count'] = $this->list_model->soldListingCount();
        $data['in_auction_item_count'] = $this->list_model->item_in_auction_ListingCount();
        
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
            //echo $this->db->last_query();
            
            
            $this->global['pageTitle'] = 'Firearms Admin : User Listing';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

     /**
     * This function is used to load the user bids
     */
    function user_bids($user_id)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userBidsCount($searchText, $user_id);

            $returns = $this->paginationCompress ( "user_bids/".$user_id, $count, 10 );
            
            $data['userRecords'] = $this->user_model->userBids($searchText, $returns["page"], $returns["segment"], $user_id);
            //echo $this->db->last_query();
            
            //print_r($data);die;
            $this->global['pageTitle'] = 'Firearms Admin : User Bids';
            
            $this->loadViews("bids", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the user list
     */
    function userListings($user_id)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListsCount($searchText,$user_id);

            $returns = $this->paginationCompress ( "userListings/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->userLists($searchText, $returns["page"], $returns["segment"],$user_id);
            
            $this->global['pageTitle'] = 'Firearms Admin : User Listing';
            
            $this->loadViews("list", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            $data['roles'] = '';//$this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'Firearms Admin : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $fname = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $lname = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));

                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->input->post('password');
                $phone = $this->security->xss_clean($this->input->post('mobile'));
                $business_phone = $this->security->xss_clean($this->input->post('business_phone'));
                $address = $this->security->xss_clean($this->input->post('address'));
                $zipcode = $this->security->xss_clean($this->input->post('zipcode'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $state = $this->security->xss_clean($this->input->post('state'));
                $country = $this->security->xss_clean($this->input->post('country'));
                $company_name = $this->security->xss_clean($this->input->post('company_name'));
                $FFL_LGD = $this->security->xss_clean($this->input->post('FFL_LGD'));
                $prefered_contact = $this->security->xss_clean($this->input->post('prefered_contact'));
                $is_verified = $this->security->xss_clean($this->input->post('is_verified'));
                $is_active = $this->security->xss_clean($this->input->post('is_active'));


                $userInfo = array( 
                    'password'=>getHashedPassword($password), 
                    'user_type'=>'user', 
                    'first_name'=> $fname,
                    'last_name'=> $lname,
                    'email_id'=> $email,
                    'phone'=> $phone,
                    'business_phone'=> $business_phone,
                    'address'=> $address,
                    'zipcode'=> $zipcode,
                    'city'=> $city,
                    'state'=> $state,
                    'country'=> $country,
                    'company_name'=> $company_name,
                    'FFL_LGD'=> $FFL_LGD,
                    'prefered_contact'=>$prefered_contact, 
                    'is_verified'=>$is_verified, 
                    'is_active'=>$is_active, 
                    'created_on'=>date('Y-m-d H:i:s'));
                
                
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully.');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed.');
                }
                
                redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
           // $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'Firearms Admin : Edit User';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            //$this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            //$this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            //$this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $first_name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $last_name = ucwords(strtolower($this->security->xss_clean($this->input->post('lname'))));
                $email_id = $this->security->xss_clean($this->input->post('email'));
                $phone = $this->security->xss_clean($this->input->post('mobile'));
                $business_phone = $this->security->xss_clean($this->input->post('business_phone'));
                $address = $this->security->xss_clean($this->input->post('address'));
                $zipcode = $this->security->xss_clean($this->input->post('zipcode'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $state = $this->security->xss_clean($this->input->post('state'));
                $company_name = $this->security->xss_clean($this->input->post('company_name'));
                $FFL_LGD = $this->security->xss_clean($this->input->post('FFL_LGD'));
                //$password = $this->input->post('password');
                $prefered_contact = $this->input->post('prefered_contact');
                $is_verified = $this->security->xss_clean($this->input->post('is_verified'));
                $is_active = $this->security->xss_clean($this->input->post('is_active'));
                
                $userInfo = array();

                $userInfo = array( 
                    'first_name'=> $first_name,
                    'last_name'=> $last_name,
                    'email_id'=> $email_id,
                    'phone'=> $phone,
                    'business_phone'=> $business_phone,
                    'address'=> $address,
                    'zipcode'=> $zipcode,
                    'city'=> $city,
                    'state'=> $state,
                    'company_name'=> $company_name,
                    'FFL_LGD'=> $FFL_LGD,
                    'prefered_contact'=>$prefered_contact, 
                    'is_verified'=>$is_verified, 
                    'is_active'=>$is_active 
                    );
                //print_r($userInfo);
                
                $result = $this->user_model->editUser($userInfo, $userId);
                //print_r($result);die;
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully.');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed.');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('is_active'=>0,'is_admin_deleted'=>1);
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    function deleteList()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $listId = $this->input->post('listId');
            $listInfo = array('is_active'=>0,'is_admin_deleted'=>1);
            
            $result = $this->user_model->deleteList($listId, $listInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    function deleteBid()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $bidId = $this->input->post('bidId');
            $bidInfo = array('is_deleted'=>1);
            
            $result = $this->user_model->deleteuserBid($bidId, $bidInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Firearms Admin : Change Password';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');  
            $newPassword = $this->input->post('newPassword');
        
          
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            


            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct.');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>$newPassword);
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful.'); }
                else { $this->session->set_flashdata('error', 'Password updation failed.'); }
                
                redirect('loadChangePass');
            }
        }
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Firearms Admin : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? $this->session->userdata("userId") : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 5, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Firearms Admin : User Login History';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
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

    public function Category($id=''){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($id==''){
                $data['categories']=$this->list_model->select_data('id,name','categories');
                $this->global['pageTitle'] = 'Firearms Admin : Add Category'; 
            }else{
                $data['categories']=$this->list_model->select_data('id,name','categories',array('id!='=>$id,'parent_id!='=>$id));
                $data['subcat_info']=$this->list_model->select_data('*','categories',array('id'=>$id));
                $this->global['pageTitle'] = 'Firearms Admin : Update Category';
            }
            $this->loadViews("add_category", $this->global, $data, NULL);
        }
    }

    public function add_category(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {    
            if(isset($_POST)){
                $name_slug = $this->slugify(trim($_POST['subcat_name']));
                $cat_info=array(
                                'name'=>$_POST['subcat_name'],
                                'slug'=>$name_slug,
                                'parent_id'=>$_POST['parent_cat'],
                                'status'=>$_POST['subcat_status']
                               );
                echo $this->list_model->insert_data('categories',$cat_info);
                $this->session->set_flashdata('success','Category Added Successfully.');
            }else{
                echo 0;
            }
        }
    }

    public function allmanufacturers(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->list_model->manufacturercount($searchText);
            $returns = $this->paginationCompress ( "allmanufacturers/" , $count, 10 );
            
            $data['userRecords'] = $this->list_model->manufacturerListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Firearms Admin : Manufacturers ';
            
            $this->loadViews("manufacturer", $this->global, $data, NULL);
        }
    }

    public function addmanufacturer($id=''){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($id==''){
                $data['categories']=$this->list_model->select_data('id,name','categories',array('parent_id'=>'0'),'',array('name','ASC'));
                $this->global['pageTitle'] = 'Firearms Admin : Add Category'; 
            }else{
                $data['categories']=$this->list_model->select_data('id,name','categories',array('id!='=>$id,'parent_id!='=>$id));
                $data['subcat_info']=$this->list_model->select_data('*','categories',array('id'=>$id));
                $this->global['pageTitle'] = 'Firearms Admin : Update Category';
            }
            $this->loadViews("add_manufacturer", $this->global, $data, NULL);
        }
    }

    public function get_subcate(){
        error_reporting(0);
        $base_url=$_POST['base_url'];
        $parent_cat=$_POST['parent_cat'];
        $data['first_parent']=$_POST['first_parent'];
        $data['mange_sub_id']=$_POST['mange_sub_id'];
        $data['subcat']=$this->list_model->select_data('id,name','categories',array('parent_id'=>$parent_cat),'',array('name','ASC'));
        $result1 =$this->load->view('subcategory', $data,true);      
        $result = array($result1); 
        echo json_encode($result); 
    }

    public function submit_manufacturer(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {    
            if(isset($_POST)){
                $manufacturer_name=$_POST['manufacturer_name'];
                $subcat_status=$_POST['subcat_status'];
                $sub_cat=$_POST['sub_cat'];

                $name_slug = $this->slugify(trim($manufacturer_name));
                $cat_info= $_POST['sub_cat'];

                $cat_info=array(
                                'category_id'=>$sub_cat,
                                'name'=>$manufacturer_name,
                                'slug'=>$name_slug,                                
                                'status'=>$subcat_status
                               );
              
                $this->list_model->insert_data('manufacturer',$cat_info);
                $last_id=  $this->db->insert_id();            
                $qry=$this->list_model->select_data('slug','manufacturer',array('id'=>$last_id),'','');
                $slug=$qry[0]['slug']."-".$last_id;

                $manu_info=array('slug'=>$slug);
                $this->list_model->update_data('manufacturer',$manu_info,array('id'=>$last_id));
               
                $this->session->set_flashdata('success','Manufacturer Added Successfully.');
                echo 1 ; 
            }else{
                echo 0;
            }
        }
    }

    public function  manufacturer_entry(){

        $qry=$this->db->query("SELECT * FROM manufacturer ")->result();
         echo "<br>";
        // print_r($qry);
         foreach ($qry as $value) {
           
            $id=$value->id;
             $name=trim($value->name);
             $name_slug = $this->slugify(trim($name));
             $name_new_slug =$name_slug."-".$id;
       
         $cat_info=array('name'=>$name,
                                'slug'=>$name_new_slug
                               );
                echo $this->list_model->update_data('manufacturer',$cat_info,array('id'=>$id));

         }

       

        echo "pramod";
       }

    public function edit_category(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if(isset($_POST)){
                $name_slug = $this->slugify(trim($_POST['subcat_name']));
                $cat_info=array(
                                'name'=>$_POST['subcat_name'],
                                'slug'=>$name_slug,
                                'parent_id'=>$_POST['parent_cat'],
                                'status'=>$_POST['subcat_status']
                               );
                echo $this->list_model->update_data('categories',$cat_info,array('id'=>$_POST['subcat_id']));
                $this->session->set_flashdata('success','Category Updated Successfully.');
            }else{
                echo 0;
            }
        }
    }

    public function delete_category(){
        error_reporting(0);
        $chk_lists=$this->list_model->select_data('id','lists',array('categories'=>$_POST['cat_id']));
        if(!empty($chk_lists)){
            echo 1;
        }else{
            $chk_subcate=$this->list_model->select_data('id','categories',array('parent_id'=>$_POST['cat_id']));
            if(!empty($chk_subcate)){
                $chk_subcate_listing=$this->list_model->select_data('id','lists',array('categories'=>$_POST['cat_id']));
                if(!empty($chk_subcate_listing)){
                    echo 2;
                }else{
                   echo 3; 
                }
            }else{
                $this->list_model->delete_data('categories',array('id'=>$_POST['cat_id']));
                echo 4;
            }
        }
    }

    public function delete_manufacturer(){
        error_reporting(0);
        $chk_lists=$this->list_model->select_data('id','lists',array('manufacturer'=>$_POST['manufacturer_id']));
        if(!empty($chk_lists)){
            echo 1;
        }else{
                $this->list_model->delete_data('manufacturer',array('id'=>$_POST['manufacturer_id']));
                echo 2;
        }
    }

    public function subcate_not_listing(){
        error_reporting(0);
        $cat_parent=$this->list_model->select_data('parent_id','categories',array('id'=>$_POST['cat_id']));
        $update_parent['parent_id']=$cat_parent[0]['parent_id'];
        $this->list_model->update_data('categories',$update_parent,array('parent_id'=>$_POST['cat_id']));
        echo $this->list_model->delete_data('categories',array('id'=>$_POST['cat_id']));
        $this->session->set_flashdata('success', 'Category deleted successfully.');
    }

    public function block_status(){
        error_reporting(0);
        $block_status['is_blocked']=$_POST['block_value'];
         echo $this->list_model->update_data('user',$block_status,array('id'=>$_POST['user_id']));
        
    }

    public function list_settings(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['list_settings']=$this->list_model->select_data('*','list_settings',array('id'=>1));

            $data['commission']=$this->list_model->select_data('*','commission','');

            $this->global['pageTitle'] = 'Firearms Admin : List Settings';
            $this->loadViews("list_settings", $this->global, $data, NULL);
        }
    }

    public function list_settings_update(){

        $total_commission= count($_POST['commission_from']);

        $this->db->empty_table('commission');


        for ($i=0; $i < $total_commission; $i++) { 

            if ($_POST['commission_to'][$i]=='1000+') {
                $commission_to='1000000';
            }else{
                $commission_to=$_POST['commission_to'][$i];
            }

            $commission=array(  'commission_from'=>$_POST['commission_from'][$i],
                                'commission_to'=>$commission_to,
                                'commission_percent'=>$_POST['commission_per'][$i],
                                'commission_min'=>$_POST['min_commission'][$i]
                               );
            $this->list_model->insert_data('commission',$commission);        
        }

        $update_list_settings = array(
                            'commision_percentage'=>'',
                            'discount_percentage'=>$_POST['discount_percentage'],
                            'min_commision_fee'=>$_POST['min_commision_fee'],
                            'min_fee_after_discount'=>'',
                            'amount_for_seller_login'=>$_POST['amount_for_seller_login'],
                            'min_list_for_discount'=>$_POST['min_list_for_discount'],
                            'turn_off_registration_fee'=>$_POST['amount_required']
                            );

        
        $this->list_model->update_data('list_settings',$update_list_settings,array('id'=>1));


        $this->session->set_flashdata('success', 'Details updated successfully.');
        redirect(base_url('list-settings'));
    }

    public function user_export_in_csv(){    
        $userslist='users_'.rand(10000,100000000);     
        $result = $this->user_model->user_export_in_csv();
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"$userslist".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        $header = array("id","Name","Type","Email","Mobile","Prefered Contact","Bids count","Lists count");         
        fputcsv($handle, $header);
        foreach ($result as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }

    public function user_export_in_excel(){ 

        $userslist='users_'.rand(10000,100000000);   
     
        $result = $this->user_model->user_export_in_csv();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$userslist".".xls\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        $header = array("id","Name","Type","Email","Mobile","Prefered Contact","Bids count","Lists count");         
        fputcsv($handle, $header);
        foreach ($result as $data) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }


     function allcontacts($id=''){

       if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            
            
            $this->load->library('pagination');
            
            $count = $this->user_model->contactcount($searchText);
           

            $returns = $this->paginationCompress ( "allcontacts/" , $count, 10 );

           
      
            $data['userRecords'] = $this->user_model->contactListing($searchText, $returns["page"], $returns["segment"]);

             // echo $this->db->last_query();
              // die();
            
            $this->global['pageTitle'] = 'CodeInsect : contact ';
            
            $this->loadViews("contact", $this->global, $data, NULL);
        }
    }

       public function viewContact($id=''){


        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {            
            $data['contact_us_details']=$this->list_model->select_data('*','contact_us',array('id'=>$id));
            
            $this->loadViews("viewContact", $this->global, $data, NULL);
        }
    }


}

?>