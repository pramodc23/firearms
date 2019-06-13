<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

 function get_new_category($table_name, $id_array, $columns,$order_by )
{
        $CI=& get_instance();
        $CI->load->database(); 
    
   if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $CI->db->select($all_columns);
        endif;
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }
        endif;
        if (!empty($order_by)):
            $CI->db->order_by($order_by);
        endif;
        $query = $CI->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
}

function get_result($table_name = '', $id_array = '', $columns = array(),$order_by = array())
    {
        $CI=& get_instance();
        $CI->load->database(); 
    
   if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $CI->db->select($all_columns);
        endif;
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }
        endif;
        if (!empty($order_by)):
            $CI->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $CI->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;

    }
  function get_row($table_name = '', $id_array = '', $columns = array(),$order_by = array())
    {
         $CI=& get_instance();
        $CI->load->database();

        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $CI->db->select($all_columns);
        endif;
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }
        endif;
        if (!empty($order_by)):
            $CI->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $CI->db->get($table_name);
        if ($query->num_rows() > 0) return $query->row();
        else return FALSE;
    }

  

    
    
function get_result_array($table_name = '', $id_array = '', $columns = array(),$order_by = array())
    {
        $CI=& get_instance();
        $CI->load->database(); 
    
   if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $CI->db->select($all_columns);
        endif;
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }
        endif;
        if (!empty($order_by)):
            $CI->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $CI->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result_array();
        else return FALSE;

    }
    
  

function get_result_multiple($table_name = '', $in_value = '', $columns = array(),$order_by = array())
    {
        $CI=& get_instance();
        $CI->load->database(); 

         $where="id IN ($in_value)";
    
   if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $CI->db->select($all_columns);
        endif;
        if (!empty($in_value)):
            //foreach ($id_array as $key => $value) {
                $CI->db->where($where);
            //}
        endif;
        if (!empty($order_by)):
            $CI->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $CI->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;

    }

    if(!function_exists('get_user_unread_message_counts')) {       
        function get_user_unread_message_counts($user_id)
        {
                 $CI = & get_instance();
          
            
            $new_notifications = $CI->db->query("SELECT id FROM (`message`) WHERE `to_user_id` = $user_id and is_read = 0 ")->num_rows();
            
            return $new_notifications;
        }
    }

    if(!function_exists('get_categories')) {
       
        function get_categories()
        {
          
            $CI = & get_instance();

             if($query = get_result('categories',array('parent_id'=>'0'),array('id,name,slug'),array('index','ASC')))
                return $query;
             else
                return false;
        }
    }

    if(!function_exists('new_get_categories')) {
       
        function new_get_categories()
        {
          
            $CI = & get_instance();

             if($query = get_new_category('categories',array('parent_id'=>0,'status'=>1),'id,name,slug','sort_by desc,name'))
                return $query;
             else
                return false;
        }
    }

    if(!function_exists('get_loging_user_details')) {       
        function get_loging_user_details($id)
        {          
            $CI = & get_instance();
            if($query = get_row('user',array('id'=>$id),array('first_name,profile_image,FFL_LGD','email_id'),''))             
                return $query;
             else
                return false;
        }
    }

    if(!function_exists('get_lists_details')) {       
        function get_lists_details($slug)
        {          
            $CI = & get_instance();
            if($query = get_row('lists',array('slug'=>$slug),array('*'),''))             
                return $query;
             else
                return false;
        }
    }
     if(!function_exists('get_lists_photo_details')) {       
        function get_lists_photo_details($list_id)
        {          
            $CI = & get_instance();
            if($query = get_row('list_attachments',array('list_id'=>$list_id),array('*'),''))             
                return $query;
             else
                return false;
        }
    }

    if(!function_exists('get_list_user_details')) {       
        function get_list_user_details($id)
        {          
            $CI = & get_instance();
            $query = get_row('user',array('id'=>$id),array('first_name,profile_image'),'');
            if($query){
                    return $query;
            }else{
                return false;
            }                  
        }
    }

    if(!function_exists('get_thumb_image')) {
       
        function get_thumb_image($list_id)
        {
          
            $CI = & get_instance();
          
            $CI->db->select('url');
         
            $id_array = array('type' =>'photo','list_id' =>$list_id );
         
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }
            $orders="is_featured DESC LIMIT 1";
            $CI->db->order_by($orders);

            $query = $CI->db->get('list_attachments');
            if ($query->num_rows() > 0){
                return $query->row(); 
            }else{
                return FALSE;  
            } 
           
        }
    }

    if(!function_exists('get_bid_count')) {
       
        function get_bid_count($list_id)
        {
          
            $CI = & get_instance();
          
            $CI->db->select('count(id) as total_bid');
         
            $id_array = array('list_id' =>$list_id,'is_deleted' =>'0' );
         
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }
      
            $query = $CI->db->get('bid');
            if ($query->num_rows() > 0) return $query->row();
            else return FALSE;
           
        }
    }

    if(!function_exists('get_favorites')) {       
        function get_favorites($user_id)
        {          
            $CI = & get_instance();          
            $CI->db->select('count(id) as total_fav');         
            $id_array = array('follower_user_id' =>$user_id,'status' =>'1' );         
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }      
            $query = $CI->db->get('followers');
            if ($query->num_rows() > 0) return $query->row();
            else return FALSE;           
        }
    }

    if(!function_exists('get_follow')) {       
        function get_follow($user_id)
        {          
            $CI = & get_instance();          
            $CI->db->select('count(id) as total_follow');         
            $id_array = array('following_user_id' =>$user_id,'status' =>'1' );         
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }      
            $query = $CI->db->get('followers');
            if ($query->num_rows() > 0) return $query->row();
            else return FALSE;           
        }
    }

    if(!function_exists('check_user_login')) {
       
        function check_user_login()
        {
            $CI = & get_instance();
            $isLoggedIn = $CI->session->userdata('isLoggedIn');
           if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
            {
                return FALSE;
            }else {
                return TRUE;
            }
            
        }
    }

    if(!function_exists('get_final_amount')) {       
        function get_final_amount($amount,$commission)
        {
            $total_commission= ($amount * $commission)/100;
            return $final_amount= $amount + $total_commission;                        
        }
    }
    if(!function_exists('amount_with_commission')) {       
        function amount_with_commission($amount)
        {
            $CI = & get_instance();
           
             $qey=$CI->db->query("SELECT commission_percent FROM `commission` WHERE commission_from <= '$amount' AND commission_to >= '$amount'")->row();
            if ($qey) {
                $commission= $qey->commission_percent;   
            }else{
                $commission= '0';
            } 
            
            $total_commission= ($amount * $commission)/100;
            $final_amount= $amount + $total_commission; 
            $commission_amount = round($final_amount, 2);
            return $commission_amount; 
                               
        }
    }

    if(!function_exists('get_bid_with_commission_amount_details')) {       
        function get_bid_with_commission_amount_details($amount)
        {
            $CI = & get_instance();
           
            $qey=$CI->db->query("SELECT commission_percent FROM `commission` WHERE commission_from <= '$amount' AND commission_to >= '$amount'")->row();
            if ($qey) {
                $commission= $qey->commission_percent;   
            }else{
                $commission= '0';
            } 
            
            $total_commission= ($amount * $commission)/100;
            $seller_amount= $amount - $total_commission;   

            $amount_details = array('sold_on_price' =>round($amount, 2),'firearms_commission' =>round($total_commission, 2) ,'seller_earn' =>round($seller_amount, 2),'commission_percentage_at_sold' =>$commission);
            return $amount_details; 
                               
        }
    }

    if(!function_exists('get_buynow_amount_details')) {       
        function get_buynow_amount_details($amount)
        {
            $CI = & get_instance();
           
            $qey=$CI->db->query("SELECT commission_percent FROM `commission` WHERE commission_from <= '$amount' AND commission_to >= '$amount'")->row();
            if ($qey) {
                $commission= $qey->commission_percent;   
            }else{
                $commission= '0';
            } 
            
            $total_commission= ($amount * $commission)/100;
            $total_amount= $amount + $total_commission;   

            $amount_details = array('sold_on_price' =>round($total_amount, 2),'firearms_commission' =>round($total_commission, 2),'seller_earn' =>round($amount, 2),'commission_percentage_at_sold' =>$commission);
            return $amount_details; 
                               
        }
    }

    if(!function_exists('get_current_price')) {       
        function get_current_price($listid='')
        {
             $CI = & get_instance();

    if($query = get_result('bid',array('list_id'=>$listid),array('bid_amount'),array('bid_amount','ASC')))
                return $query;
             else
                return false;                     
        }
    }

    if(!function_exists('get_current_price1')) {       
        function get_current_price1($listid='')
        {
            $CI = & get_instance();
            if($query = get_row('bid',array('list_id'=>$listid,'is_deleted'=>'0'),array('bid_amount'),array('bid_amount','DESC')))             
                return $query;
             else
                return false;
        }
    }

    

    if(!function_exists('get_sold_price')) {       
        function get_sold_price($listid='')
        {
            $CI = & get_instance();
            if($query = get_row('bid',array('list_id'=>$listid,'is_won'=>'1','is_deleted'=>'0'),array('bid_amount'),array('bid_amount','DESC')))             
                return $query;
             else
                return false;
        }
    }
     if(!function_exists('get_bid_won')) {       
        function get_bid_won($listid=''){
            $CI = & get_instance();          
            $CI->db->select('bid_amount');         
            $id_array = array('list_id'=>$listid,'is_won'=>'1','is_deleted'=>'0');         
            foreach ($id_array as $key => $value) {
                $CI->db->where($key, $value);
            }      
            $query = $CI->db->get('bid');
            if ($query->num_rows() > 0){
                return 'won';
            }else{
                return 'notwon';
            }
        }
    }

    if(!function_exists('get_user_highest_bid')) {       
        function get_user_highest_bid($listid='',$buyer_id='')
        {
            $CI = & get_instance();
            if($query = get_row('bid',array('list_id'=>$listid,'user_id'=>$buyer_id,'is_deleted'=>'0'),array('bid_amount'),array('bid_amount','DESC')))             
                return $query;
             else
                return false;
        }
    }

    if(!function_exists('get_related_category')) {       
        function get_related_category($cat_id='')
        {
            $CI = & get_instance();
            $first_query = get_result('categories',array('parent_id'=>$cat_id),array('id'));

            $values='';
            $total_id=array();          
            $total_id[]=$cat_id;
            if (!empty($first_query)) {
                foreach ($first_query as  $first_value) {
                    $child_id= $first_value->id;
                    $total_id[]=$first_value->id;
                    $second_query = get_result('categories',array('parent_id'=>$child_id),array('id'));
                    if (!empty($second_query)) {
                        foreach ($second_query as  $second_value) {
                             $total_id[]= $second_value->id;
                        }
                    }                   
                }
            }
           return $commaList = implode(', ', $total_id);
               

        }
    }

    function _check_user_login() {

        if(check_user_login()=== FALSE){
    
           return "0";
        }else{ return "1";
            
        }
    }


  
