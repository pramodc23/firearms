<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 */
class Listings extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('list_model');
        $this->load->library('Pagination');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */

    function allFixed($type_search = 'all',$user_id=0,$page_ofset = 0)
    {
        $per_page = $row_count = 10;
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {      
            $searchText = "";  
            if(isset($_GET['searchText']))
            {
                $searchText = $this->security->xss_clean($_GET['searchText']);
            }
            $data['searchText'] = $searchText;
            

            if($type_search == 'sold')
            {
                $count = $this->list_model->soldListingfixCount($searchText,$user_id); 
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {
                        $param = ($per_page / $row_count) + 1;
                    }
                    if ($param > 0) {
                        $data['offset'] = ($param - 1) * $data['row_count'];
                    } else {
                        $data['offset'] = $param * $data['row_count'];
                    }

                $p_config['base_url'] = site_url('listings/allFixed/sold/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();

                $data['userRecords'] = $this->list_model->soldListingfix($searchText, $per_page, $page_ofset,$user_id);

            }else if($type_search == 'in_auction')
            {
                $count = $this->list_model->item_in_auction_fix_ListingCount($searchText,$user_id);

                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {$param = ($per_page / $row_count) + 1;}
                    if ($param > 0) {$data['offset'] = ($param - 1) * $data['row_count'];} 
                    else {$data['offset'] = $param * $data['row_count']; }

                $p_config['base_url'] = site_url('listings/allFixed/in_auction/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                
                $data['userRecords'] = $this->list_model->in_auctionfixListing($searchText, $per_page, $page_ofset,$user_id);

          

            }else if($type_search == 'expired')
            {
                $count = $this->list_model->item_expired_fix_ListingCount($searchText,$user_id);
                // echo  $this->db->last_query();
                // echo '<br>';
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {$param = ($per_page / $row_count) + 1;}
                    if ($param > 0) {$data['offset'] = ($param - 1) * $data['row_count'];} 
                    else {$data['offset'] = $param * $data['row_count']; }

                $p_config['base_url'] = site_url('listings/allFixed/expired/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                
                $data['userRecords'] = $this->list_model->expiredfixListing($searchText, $per_page , $page_ofset,$user_id);
                 //echo  $this->db->last_query();
            
            }
            else{
                $count = $this->list_model->userListingfixCount($searchText,$user_id);
                $param = (int) $this->uri->segment(5, 0);
                    $data['row_count'] = $row_count;
                    if ($per_page) {
                        $param = ($per_page / $row_count) + 1;
                    }
                    if ($param > 0) {
                        $data['offset'] = ($param - 1) * $data['row_count'];
                    } else {
                        $data['offset'] = $param * $data['row_count'];
                    }

                $p_config['base_url'] = site_url('listings/allFixed/all/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];
                    //$p_config['page_query_string'] = TRUE;
                    // Init pagination
                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                //echo "u_id ->".$user_id;
                $data['userRecords'] = $this->list_model->userListingfix($searchText,  $per_page,$page_ofset,$user_id);
                
            }
            //echo $this->db->last_query();
            //die;
            
            $data['user_id'] =$user_id;
            $data['type_search'] =$type_search;
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("fixlist", $this->global, $data, NULL);
        }
    }


    function allListings($type_search = 'all',$user_id=0,$page_ofset = 0)
    {

       
        
        $per_page = $row_count = 10;
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {      
            $searchText = "";  
            if(isset($_GET['searchText']))
            {
                $searchText = $this->security->xss_clean($_GET['searchText']);
            }
            $data['searchText'] = $searchText;
            

            if($type_search == 'sold')
            {
                $count = $this->list_model->soldListingCount($searchText,$user_id); 
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {
                        $param = ($per_page / $row_count) + 1;
                    }
                    if ($param > 0) {
                        $data['offset'] = ($param - 1) * $data['row_count'];
                    } else {
                        $data['offset'] = $param * $data['row_count'];
                    }

                $p_config['base_url'] = site_url('listings/allListings/sold/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();

                $data['userRecords'] = $this->list_model->soldListing($searchText, $per_page, $page_ofset,$user_id);

            }else if($type_search == 'in_auction')
            {
                $count = $this->list_model->item_in_auction_ListingCount($searchText,$user_id);

                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {$param = ($per_page / $row_count) + 1;}
                    if ($param > 0) {$data['offset'] = ($param - 1) * $data['row_count'];} 
                    else {$data['offset'] = $param * $data['row_count']; }

                $p_config['base_url'] = site_url('listings/allListings/in_auction/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                
                $data['userRecords'] = $this->list_model->in_auctionListing($searchText, $per_page, $page_ofset,$user_id);

          

            }else if($type_search == 'expired')
            {
                $count = $this->list_model->item_expired_ListingCount($searchText,$user_id);
                // echo  $this->db->last_query();
                // echo '<br>';
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {$param = ($per_page / $row_count) + 1;}
                    if ($param > 0) {$data['offset'] = ($param - 1) * $data['row_count'];} 
                    else {$data['offset'] = $param * $data['row_count']; }

                $p_config['base_url'] = site_url('listings/allListings/expired/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                
                $data['userRecords'] = $this->list_model->expiredListing($searchText, $per_page , $page_ofset,$user_id);
                 //echo  $this->db->last_query();
            
            }else if($type_search == 'reserve_met')
            {
                $count = $this->list_model->item_reserve_met_ListingCount($searchText,$user_id);
                    
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {$param = ($per_page / $row_count) + 1;}
                    if ($param > 0) {$data['offset'] = ($param - 1) * $data['row_count'];} 
                    else {$data['offset'] = $param * $data['row_count']; }

                $p_config['base_url'] = site_url('listings/allListings/reserve_met/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                
                $data['userRecords'] = $this->list_model->reserve_metListing($searchText, $per_page, $page_ofset,$user_id );
           
            }else if($type_search == 'reserve_not_met')
            {
                $count = $this->list_model->item_reserve_not_met_ListingCount($searchText,$user_id);        
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {$param = ($per_page / $row_count) + 1;}
                    if ($param > 0) {$data['offset'] = ($param - 1) * $data['row_count'];} 
                    else {$data['offset'] = $param * $data['row_count']; }

                $p_config['base_url'] = site_url('listings/allListings/reserve_not_met/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                
                $data['userRecords'] = $this->list_model->reserve_not_metListing($searchText, $per_page , $page_ofset,$user_id);

            }
            else{
                $count = $this->list_model->userListingCount($searchText,$user_id);
                $param = (int) $this->uri->segment(5, 0);
                    $data['row_count'] = $row_count;
                    if ($per_page) {
                        $param = ($per_page / $row_count) + 1;
                    }
                    if ($param > 0) {
                        $data['offset'] = ($param - 1) * $data['row_count'];
                    } else {
                        $data['offset'] = $param * $data['row_count'];
                    }

                $p_config['base_url'] = site_url('listings/allListings/all/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];
                    //$p_config['page_query_string'] = TRUE;
                    // Init pagination
                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();
                //echo "u_id ->".$user_id;
                $data['userRecords'] = $this->list_model->userListing($searchText,  $per_page,$page_ofset,$user_id);
                
            }
            //echo $this->db->last_query();
            //die;
            
            $data['user_id'] =$user_id;
            $data['type_search'] =$type_search;
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("list", $this->global, $data, NULL);
        }
    }

      function userallListings($type_search='all')
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

            if($type_search == 'sold')
            {
                $count = $this->list_model->soldListingCount($searchText);
                $returns = $this->paginationCompress ( "listings/allListings/sold/", $count, 10 );
                
                $data['userRecords'] = $this->list_model->soldListing($searchText, $returns["page"], $returns["segment"]);
            }else if($type_search == 'in_auction')
            {
                $count = $this->list_model->item_in_auction_ListingCount($searchText);
                $returns = $this->paginationCompress ( "listings/allListings/in_auction/", $count, 10 );
                
                $data['userRecords'] = $this->list_model->in_auctionListing($searchText, $returns["page"], $returns["segment"]);
            }else if($type_search == 'expired')
            {
                $count = $this->list_model->item_expired_ListingCount($searchText);
                $returns = $this->paginationCompress ( "listings/allListings/expired/", $count, 10 );
                
                $data['userRecords'] = $this->list_model->expiredListing($searchText, $returns["page"], $returns["segment"]);
            
            }else if($type_search == 'reserve_met')
            {
                $count = $this->list_model->item_reserve_met_ListingCount($searchText);
                $returns = $this->paginationCompress ( "listings/allListings/reserve_met/", $count, 10 );
                
                $data['userRecords'] = $this->list_model->reserve_metListing($searchText, $returns["page"], $returns["segment"]);
            }else if($type_search == 'reserve_not_met')
            {
                $count = $this->list_model->item_reserve_not_met_ListingCount($searchText);
                $returns = $this->paginationCompress ( "listings/allListings/reserve_not_met/", $count, 10 );
                
                $data['userRecords'] = $this->list_model->reserve_not_metListing($searchText, $returns["page"], $returns["segment"]);
            }
            else{
                $count = $this->list_model->singleuserListingCount($searchText);
                // echo $this->db->last_query();
                // echo "<br>";

                $returns = $this->paginationCompress ( "listings/userallListings/all/", $count, 10 );
                //  echo print_r($returns);
                // echo "<br>";    
                $data['userRecords'] = $this->list_model->singleuserListing($searchText, $returns["page"], $returns["segment"]);
                //  echo $this->db->last_query();
                // echo "<br>";
            }
            
            $data['type_search'] =$type_search;
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("userlist", $this->global, $data, NULL);
        }
    }

   // function view_buyer_listing($user_id,$page_ofset = 0)
     function view_buyer_listing($type_search = 'all',$user_id=0,$page_ofset = 0){

        $per_page = $row_count = 10;

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');

            if(false)
            {
            }
            else{
                // $count = $this->list_model->viewbuyerCount($searchText,$user_id);
                 
                // $returns = $this->paginationCompress ( "listings/view_buyer_listing/".$user_id, $count, 10 );
                $data['buyer_id'] =$user_id;
                $data['user_details'] = $this->list_model->select_data('id,first_name','user',array('id'=>$user_id));
                
                // $data['listrecords'] = $this->list_model->viewbuyerlisting($searchText, $returns["page"], $returns["segment"],$user_id);


                $count = $this->list_model->viewbuyerCount($searchText,$user_id); 
                $param = (int) $this->uri->segment(5, 0);
            
                    $data['row_count'] = $row_count;
                    if ($per_page) {
                        $param = ($per_page / $row_count) + 1;
                    }
                    if ($param > 0) {
                        $data['offset'] = ($param - 1) * $data['row_count'];
                    } else {
                        $data['offset'] = $param * $data['row_count'];
                    }

                $p_config['base_url'] = site_url('listings/view_buyer_listing/all/'.$user_id.'/');
                    $p_config['uri_segment'] = 5;
                    $p_config['num_links'] = 5;
                    $p_config['total_rows'] = $count;
                    $p_config['per_page'] = $data['row_count'];

                    $this->pagination->initialize($p_config);

                    // Create pagination links
                    $data['pagination'] = $this->pagination->create_links();

                $data['listrecords'] = $this->list_model->viewbuyerlisting($searchText, $per_page, $page_ofset,$user_id);
                //echo $this->db->last_query();

                            
            }            
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("buyer_list", $this->global, $data, NULL);
        }
    }

    function viewuserbid($listid,$buyerid){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {              
            $data = array();            
            $this->global['pageTitle'] = 'CodeInsect : List Details';            
            $this->loadViews("viewuserbid", $this->global, $data, NULL);
        }
    }

    function allBids()
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
            
            $count = $this->list_model->BidsCount($searchText);

            $returns = $this->paginationCompress ( "allBids/", $count, 10 );
            
            $data['userRecords'] = $this->list_model->bidsListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Bids';
            
            $this->loadViews("bids", $this->global, $data, NULL);
        }
    }

    function manageCategories(){
       if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->list_model->categoryCount($searchText);
            $returns = $this->paginationCompress ( "manageCategories/" , $count, 10 );
            
            $data['userRecords'] = $this->list_model->categoryListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : Categories ';
            
            $this->loadViews("categories", $this->global, $data, NULL);
        }
    }


    function viewfixedListings($id){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $list_info = $this->list_model->select_data('lists.*,categories.name','lists',array('lists.id'=>$id),'','','',array('categories','lists.categories=categories.id'));


            $data['list_details']=$list_info;
            $data['list_photos'] = $this->list_model->select_data('url,type','list_attachments',array('list_id'=>$id,'type'=>'photo'));
            $data['user_details'] = $this->list_model->select_data('id,first_name','user',array('id'=>$list_info[0]['user_id']));

             $data['maxbid_amount'] = $this->list_model->select_data('max(bid_amount) as maxbid_amount','bid',array('list_id'=>$id,'is_deleted'=>0));

            $data['list_media'] = $this->list_model->select_data('url,type','list_attachments',array('list_id'=>$id,'type'=>'video_url'),6);
            $data['count_records'] = $this->list_model->aggregate_data('list_attachments','id','COUNT',array('type'=>'video_url','list_id'=>$id));
            
            $this->global['pageTitle'] = 'CodeInsect : List Details ';
            
            $this->loadViews("viewfixedListing", $this->global, $data, NULL);
        }
    }

    function viewListings($id){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $list_info = $this->list_model->select_data('lists.*,categories.name','lists',array('lists.id'=>$id),'','','',array('categories','lists.categories=categories.id'));


            $data['list_details']=$list_info;
            $data['list_photos'] = $this->list_model->select_data('url,type','list_attachments',array('list_id'=>$id,'type'=>'photo'));
            $data['user_details'] = $this->list_model->select_data('id,first_name','user',array('id'=>$list_info[0]['user_id']));

             $data['maxbid_amount'] = $this->list_model->select_data('max(bid_amount) as maxbid_amount','bid',array('list_id'=>$id,'is_deleted'=>0));

            $data['list_media'] = $this->list_model->select_data('url,type','list_attachments',array('list_id'=>$id,'type'=>'video_url'),6);
            $data['count_records'] = $this->list_model->aggregate_data('list_attachments','id','COUNT',array('type'=>'video_url','list_id'=>$id));
            
            $this->global['pageTitle'] = 'CodeInsect : List Details ';
            
            $this->loadViews("viewListing", $this->global, $data, NULL);
        }
    }

    function viewUser($id){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
            $data['user_details'] = $this->list_model->select_data('*','user',array('id'=>$id));
            $data['user_card_details'] = $this->list_model->select_data('*','user_card_details',array('user_id'=>$id));
            $data['list_bids'] = $this->list_model->select_data('list_id,bid_amount,is_won,is_sold','bid',array('user_id'=>$id,'is_deleted'=>0),'',array('id','DESC'));
            
            $this->global['pageTitle'] = 'CodeInsect : User Details ';
            
            $this->loadViews("userDetails", $this->global, $data, NULL);
        }
    }


    function list_update(){
        error_reporting(0);

        if(isset($_POST)){
            $list_status=$_POST['list_status'];
            $relist_list=$_POST['relist_list'];
            $duration_days=$_POST['duration_days'];
            $list_end_auction=$_POST['list_end_auction'];

            if ($relist_list=='yes') {
                $end_auction=date("Y-m-d H:i:s", strtotime($list_end_auction. ' + '.$duration_days.' days'));
            }else{
                $end_auction=$list_end_auction;    
            }
               
            $list_id=  $_POST['list_id'];      
            $update_user = array('is_active'=>$list_status,'end_auction'=>$end_auction);

            $result=$this->list_model->update_data('lists',$update_user,array('id'=>$list_id));
           
            if ($result) {
                $this->session->set_flashdata('success','List updated successfully.');
                redirect('viewListings/'.$list_id);
                

            }else{
                $this->session->set_flashdata('error','List update failed.');
                 redirect('viewListings/'.$list_id);
            }
       
        }
      
    }

    function bypass_r_fee(){
        error_reporting(0);

        if(isset($_POST)){
            $bypass_r_fee=$_POST['bypass_r_fee'];
            $user_status=$_POST['user_status'];
            $block_value= $_POST['block_value'];        
            $user_id=  $_POST['user_id'];      
            $update_user = array('is_blocked'=>$block_value,
                                'is_active'=>$user_status,
                                'fee_bypass_by_admin'=>$bypass_r_fee);

            $result=$this->list_model->update_data('user',$update_user,array('id'=>$user_id));

           
            if ($result) {
                $this->session->set_flashdata('success','User profile updated successfully.');
                redirect('viewUser/'.$user_id);
                

            }else{
                $this->session->set_flashdata('error','User profile update failed.');
                 redirect('viewUser/'.$user_id);
            }
       
        }
      
    }

    function delete_b_list(){
        error_reporting(0);
        $vv=json_decode($_POST['list_id']);
        foreach($vv as $v){
        	$delete_status['is_admin_deleted']=1;
            $this->list_model->update_data('lists',$delete_status,array('id'=>$v));
        }
        $this->session->set_flashdata('success','List(s) deleted successfully.');
 		echo 1;
    }

    function delete_all_bid(){
        error_reporting(0);
        $bids=json_decode($_POST['bid_id']);
        foreach($bids as $v){
            $this->list_model->deleteuserBid($v);
        } 
        $this->session->set_flashdata('success','bid(s) deleted successfully.');
        echo 1;
    }


    function relist_b_list(){
    	
    	$all_list=json_decode($_POST['list_id']);
    	foreach($all_list as $list){
            $prev_details=$this->list_model->select_data('*','lists',array('id'=>$list));
    		$update_relist = array(
        						'is_expired_post'=>0,
        						'is_relist'=>1,
                                'end_auction'=>date("Y-m-d H:i:s", strtotime($prev_details[0]['end_auction']. ' + '.$prev_details[0]['duration_days'].' days'))
        					  );
            
            $relist_log=array(
                          'user_id'=>0,
                          'ip_address'=>$_SERVER['REMOTE_ADDR'],
                          'action'=>'relist',
                          'previous_data'=>json_encode($prev_details[0])  
                         );
            $this->list_model->insert_data('list_log',$relist_log);
    		$this->list_model->update_data('lists',$update_relist,array('id'=>$list));
    	}
    	$this->session->set_flashdata('success','List(s) relisted successfully.');
    	echo 1;
    }
  
    function testrelist(){


    }

    function relist(){
        error_reporting(0);
        if(isset($_POST)){
        $id=$_POST['listId'];
        $prev_details=$this->list_model->select_data('*','lists',array('id'=>$id));
        
        $status=  $prev_details[0]['status'];

            if ($status=='sold') {

                $result=$this->list_model->create_list_for_sold($id);
                if ($result) {
                  
                    $this->session->set_flashdata('success','List relisted successfully.'); 
                }else{
                   echo 0;
                }
                      
            }else{

                $end_auction=  $prev_details[0]['end_auction'];
                $today=date("Y-m-d H:i:s");
                if($end_auction > $today ){
                    $end_auction=date("Y-m-d H:i:s", strtotime($prev_details[0]['end_auction']. ' + '.$prev_details[0]['duration_days'].' days'));
                }else{

                    $end_auction=  date("Y-m-d H:i:s", strtotime($today. ' + '.$prev_details[0]['duration_days'].' days'));
                }

                $update_relist = array(
                                        'is_expired_post'=>0,
                                        'is_relist'=>1,
                                        'end_auction'=>$end_auction
                                      );
                $relist_log=array(
                                  'user_id'=>0,
                                  'ip_address'=>$_SERVER['REMOTE_ADDR'],
                                  'action'=>'relist',
                                  'previous_data'=>json_encode($prev_details[0])  
                                 );
                $this->list_model->insert_data('list_log',$relist_log);
                echo $this->list_model->update_data('lists',$update_relist,array('id'=>$id));
                $this->session->set_flashdata('success','List relisted successfully.'); 
            }

        }else{
            echo 0;
        }
    }

    function load_more_videos(){
        error_reporting(0);
        $limit=6;
        $total_records= $this->list_model->aggregate_data('list_attachments','id','COUNT',array('type'=>'video_url'));
        $total_pages = ceil($total_records / $limit);
        $id=$_POST['id'];
        $btn_no=$id+1;
        $offset=($id-1)*$limit;
        $list_media = $this->list_model->select_data('url','list_attachments',array('type'=>'video_url'),array($limit,$offset));
        	$data=array();
	        $html = '';
	        foreach($list_media as $media){
	            $html .= '<div class="col-md-4 col-sm-4 media_div">
	              <iframe src="'.$media['url'].'"></iframe>
	            </div>'; 
	      }
	      $data['html']=$html;
	      if($id<$total_pages){
		      $html_btn = '';
		      $html_btn = '<button class="btn btn-primary" onclick="more_video('.$btn_no.')">Load More</button>';
		      
		      $data['html_btn']=$html_btn;
		  }    
	      echo json_encode($data);
    }

    /*function new_hh(){
        error_reporting(0);
        $this->load->view('testt');
    }*/
    
    function jj($list_id){
    	error_reporting(0);
    	$bid_info = $this->list_model->select_data('id,user_id,bid_amount,is_won,is_sold','bid',array('list_id'=>$list_id,'is_deleted'=>0),'',array('id','DESC'));
    	$bid_info_new=array();
    	$i=1;
    	foreach($bid_info as $bid){
            $bid_id=$bid['id'];
    		$bid['s_no']=$i;
    		if($bid['is_won']==1){
    			$bid['is_won']='Yes';
                 $bid['delete']='';
    		}else{
    			$bid['is_won']='No';
                $bid['delete']="<a class='btn btn-sm btn-danger deletebid_admin' href='#' data-id='$bid_id' title='Delete'><i class='fa fa-trash'></i></a>";
    		}

    		if($bid['is_sold']==1){
    			$bid['is_sold']='Yes';
    		}else{
    			$bid['is_sold']='No';
    		}

            // if($bid['is_won']==1){
            //     $bid['delete']='';
            // }else{
            //     $bid['delete']='<a class="btn btn-sm btn-danger deleteList" href="#" data-id="" title="Delete"><i class="fa fa-trash"></i></a>';
            // }

    		$user_name = $this->list_model->select_data('first_name','user',array('id'=>$bid['user_id']));
    		$bid['user_id']=$user_name[0]['first_name'];
    		$bid_info_new[]=$bid;
    		$i++;
       	}
    
    	$f_bid_info = json_encode($bid_info_new);
    	echo '{
  "data": '.$f_bid_info.'
}
';
    }

    function kk($user_id){
        error_reporting(0);
        $bid_info = $this->list_model->select_data('list_id,bid_amount,is_won,is_sold','bid',array('user_id'=>$user_id,'is_deleted'=>0),'',array('id','DESC'));
        $bid_info_new=array();
        $i=1;
        foreach($bid_info as $bid){
            $bid['s_no']=$i;
            if($bid['is_won']==1){
                $bid['is_won']='Yes';
            }else{
                $bid['is_won']='No';
            }

            if($bid['is_sold']==1){
                $bid['is_sold']='Yes';
            }else{
                $bid['is_sold']='No';
            }

            $list_name = $this->list_model->select_data('title','lists',array('id'=>$bid['list_id']));
            $bid['list_id']=$list_name[0]['title'];
            $bid_info_new[]=$bid;
            $i++;
        }
    
        $f_bid_info = json_encode($bid_info_new);
        echo '{
  "data": '.$f_bid_info.'
}
';
    }

    function deletebid_admin()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $bidid = $this->input->post('bidid');

            $prev_details=$this->list_model->select_data('*','bid',array('id'=>$bidid));

            $bid_log=array(
                          'user_id'=>1,
                          'ip_address'=>$_SERVER['REMOTE_ADDR'],
                          'action'=>'bid_delete_by_admin',
                          'previuos_data'=>json_encode($prev_details[0])  
                         );
            $this->list_model->insert_data('bid_log',$bid_log);

            // $update_bid = array('is_deleted'=>1);
            // $result= $this->list_model->update_data('bid',$update_bid,array('id'=>$bidid));

            $this->db->where('id', $bidid);
        $result=$this->db->delete('bid');


            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    


}

?>