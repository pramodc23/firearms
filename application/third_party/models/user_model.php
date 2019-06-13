<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('id');
        $this->db->where('email_id', $email);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    function get_user_contacts($user_id)
    {
        $sql_query = $this->db->query("SELECT from_user_id,to_user_id FROM (`message`) WHERE (`from_user_id` = $user_id OR `to_user_id` = $user_id) ORDER BY `created_on` DESC");
        $contact_user_ids = array();
        $user_data = array();
        if($sql_query->num_rows() > 0)
        {
            
            foreach ($sql_query->result_array() as $user_row) {
                $from_user_id = $user_row['from_user_id'];
                $to_user_id = $user_row['to_user_id'];
                $contact_user = $to_user_id;
                if($to_user_id==$user_id)
                {
                   $contact_user = $from_user_id; 
                }

                if(!in_array($contact_user, $contact_user_ids))
                {
                    $user_data_arr = $this->select_data('id,first_name,profile_image,is_login','user',array('id'=>$contact_user));
                    $user_data[] = $user_data_arr[0];
                    $contact_user_ids[] = $contact_user;
                }
                

            }
            return $user_data;
        }else{
            return $user_data;
        }
    }


    # function for select data from database , with condition , limit , order , like and join clause
    function select_data($field , $table , $where = '' , $limit = '' , $order = '' , $like = '' , $join_array = '' , $group = '',$or_where=''){ 
        $this->db->select($field);
        $this->db->from($table);
        if($where != ""){ 
            $this->db->where($where);
        }
        if($or_where != '')
        {
            $this->db->or_where($or_where); 
        }
        // sturcture for multiple join
        //array('multiple' , array(array('TABLE NAME' , 'CONDITION'),array('TABLE NAME' , 'CONDITION')))
        
        if($join_array != ''){
            if(in_array('multiple',$join_array)){
                foreach($join_array['1'] as $joinArray){
                    $this->db->join($joinArray[0], $joinArray[1]);
                }
            }else{
                $this->db->join($join_array[0], $join_array[1]);
            }
        }
        
        if($order != ""){
            $this->db->order_by($order['0'] , $order['1']);
        }
        
        if($group != ""){
            $this->db->group_by($group);
        }
        
        if($limit != ""){
            if(count($limit)>1){
                $this->db->limit($limit['0'] , $limit['1']);
            }else{
                $this->db->limit($limit);
            }
            
        }
        
        /*if($like != ''){
            $this->db->like($like);
        }*/
        if($like != ""){
                    $this->db->like($like[0] , $like[1]);   
        }   
        return $this->db->get()->result_array();
        die();
    }

    # function for insert data in database  
    function insert_data($table , $data){
        $this->db->insert($table , $data);
        return $this->db->insert_id();
        die();
    }

    # function for update data in database 
    function update_data($table , $data , $condition){
        $this->db->where($condition);
        return $this->db->update($table,$data);
        die();
    }

    # function for delete data from database 
    function delete_data($table , $condition){
        return $this->db->delete($table,$condition);
        die();
    }

    function leftjoin_data($fields,$table,$where,$join_array){
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->join($join_array[0], $join_array[1], 'left');
        return $this->db->get()->result_array();
        die();
    }

    # function for group by and count
    function groupby_count($field_name,$table,$group_clm,$limit){ 
        $this->db->select($field_name);
        $this->db->from($table);
        if($group_clm != ''){
            $this->db->group_by($group_clm);
        }
        if($limit != ""){
            if(count($limit)>1){
                $this->db->limit($limit['0'] , $limit['1']);
            }else{
                $this->db->limit($limit);
            }
            
        }
        
        return $this->db->get()->result_array();
        die();
    }
    
    
    # function for call the aggregate function like as 'SUM' , 'COUNT' etc 
    function aggregate_data($table , $field_nm , $function , $where = NULL , $join_array = NULL){
        $this->db->select("$function($field_nm) AS MyFun");
        $this->db->from($table);
        if($where != ''){
             $this->db->where($where);
        }
        
        if($join_array != ''){
            if(in_array('multiple',$join_array)){
                foreach($join_array['1'] as $joinArray){
                    $this->db->join($joinArray[0], $joinArray[1]);
                }
            }else{
                $this->db->join($join_array[0], $join_array[1]);
            }
        }
        
        $query1 = $this->db->get();
        
        if($query1->num_rows() > 0){ 
            $res = $query1->row_array();
            return ($res['MyFun'] == '')?0:$res['MyFun'];                                                   
        }else{
            return 0;
        }  
        die();  
    }


      # function for select data from database , with condition , limit , order , like and join clause
    function select_row($field , $table , $where = '' , $limit = '' , $order = '' , $like = '' , $join_array = '' , $group = ''){ 
        $this->db->select($field);
        $this->db->from($table);
        if($where != ""){ 
            $this->db->where($where);
        }  
        
        if($join_array != ''){
            if(in_array('multiple',$join_array)){
                foreach($join_array['1'] as $joinArray){
                    $this->db->join($joinArray[0], $joinArray[1]);
                }
            }else{
                $this->db->join($join_array[0], $join_array[1]);
            }
        }
        
        if($order != ""){
            $this->db->order_by($order['0'] , $order['1']);
        }
        
        if($group != ""){
            $this->db->group_by($group);
        }
        
        if($limit != ""){
            if(count($limit)>1){
                $this->db->limit($limit['0'] , $limit['1']);
            }else{
                $this->db->limit($limit);
            }
            
        }
        
        /*if($like != ''){
            $this->db->like($like);
        }*/
        if($like != ""){
                    $this->db->like($like[0] , $like[1]);   
        }   
        return $this->db->get()->row();
        die();
    }

    public function get_user_fav($session_id){ 
         $qry = $this->db->query("SELECT GROUP_CONCAT(following_user_id) as fav FROM `followers` WHERE follower_user_id=$session_id AND status =1")->row(); 

        if($qry->fav){
               $favourite= $qry->fav;
                 $query = $this->db->query("SELECT id,first_name,profile_image FROM `user` WHERE  id IN  ($favourite) ");  
                 return $query->result(); 
        }    
      
    }

    public function get_total_list($user_id){ 
      
        $qry = $this->db->query("SELECT count(id) as total_list FROM `lists` WHERE user_id=$user_id")->row(); 
        if ($qry) {
            return $qry->total_list;
        }else{
            return 0;
        }       
    }

    
    public function get_final_amount($amount,$commission){
        $total_commission= ($amount * $commission)/100;
        return $final_amount= $amount + $total_commission;       
        }

    public function get_buy_item($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by,$seller_id,$cat_id,$categories,$amount,$sorting,$item_condition,$search_text){ 

        $date = date("Y-m-d H:i:s");
        $wheres='';
        if (!empty($seller_id)) {
            $wheres=" AND lists.user_id = $seller_id";
        }

        if (!empty($cat_id)) {
            $wheres=" AND lists.categories = $cat_id";
        }

        if (!empty($categories)) {
            //$wheres=" AND lists.categories = $categories";
            $related_cat_id=get_related_category($categories);
            $wheres=" AND lists.categories IN($related_cat_id) ";
        }

        if (!empty($item_condition)) {
            $wheres=" AND lists.item_condition = '$item_condition'";
        }
        
        if (!empty($amount)) {
            $val = explode("-", $amount);          
            $wheres .= " AND lists.starting_bid_with_commission >= '".$val[0]."' AND lists.starting_bid_with_commission <= '".$val[1]."'";
        }

        if (!empty($search_text)) {
            $wheres=" AND (lists.title like '%$search_text%' OR lists.slug like '%$search_text%') ";
        }


        


        if (!empty($sorting)) {
            if($sorting=='price_lowest_to_highest'){                
                $orderby="lists.starting_bid ASC";
            }elseif ($sorting=='price_highest_to_lowest') {
                $orderby="lists.starting_bid DESC";
            }elseif ($sorting=='ending_soon') {
                $orderby="lists.end_auction ASC";
            }elseif ($sorting=='newest_listings') {
                $orderby="lists.id DESC";
            }else{
                $orderby ="$order_by DESC"; 
            }            
        }else{
            $orderby ="$order_by DESC"; 
        }

        $query = $this->db->query("SELECT `lists`.`id`, `lists`.`title`,`lists`.`reserve_price`,  `lists`.`starting_bid`, `lists`.`slug`, `lists`.`buy_now_price`, `lists`.`primary_picture`, `likes`.`like_status`, `lists`.`end_auction` FROM (`lists`) LEFT JOIN `likes` ON `lists`.`id`=`likes`.`list_id` AND `likes`.`user_id` ='$session_id' WHERE `lists`.`is_active` = 1 AND `lists`.`is_sold` = 0 AND `lists`.`is_deleted` = 0 AND `lists`.`is_admin_deleted` = 0 AND `lists`.`end_auction` >='$date'  $wheres GROUP BY `lists`.`id` ORDER BY $orderby LIMIT  $limit OFFSET $offset");   

        //echo $this->db->last_query();
        return $query->result_array(); 
    }   

     public function get_buy_item_pagination($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by,$seller_id,$cat_id,$categories,$amount,$sorting,$item_condition,$search_text){ 
         $date = date("Y-m-d H:i:s");
        $wheres='';
        if (!empty($seller_id)) {
            $wheres=" AND lists.user_id = $seller_id";
        }

        if (!empty($cat_id)) {
            $wheres=" AND lists.categories = $cat_id";
        }

        if (!empty($categories)) {
            //$wheres=" AND lists.categories = $categories";
            $related_cat_id=get_related_category($categories);
            $wheres=" AND lists.categories IN($related_cat_id) ";
        }
        if (!empty($item_condition)) {
            $wheres=" AND lists.item_condition = '$item_condition'";
        }
        if (!empty($amount)) {
            $val = explode("-", $amount);         
            $wheres .= " AND lists.starting_bid_with_commission >= '".$val[0]."' AND lists.starting_bid_with_commission <= '".$val[1]."'";
        }

        if (!empty($search_text)) {
            $wheres=" AND (lists.title like '%$search_text%' OR lists.slug like '%$search_text%') ";
        }

        if (!empty($sorting)) {
            if($sorting=='price_lowest_to_highest'){                
                $orderby="lists.starting_bid ASC";
            }elseif ($sorting=='price_highest_to_lowest') {
                $orderby="lists.starting_bid DESC";
            }elseif ($sorting=='ending_soon') {
                $orderby="lists.end_auction ASC";
            }elseif ($sorting=='newest_listings') {
                $orderby="lists.id DESC";
            }else{
                $orderby ="$order_by DESC"; 
            }            
        }else{
            $orderby ="$order_by DESC"; 
        }


        $query = $this->db->query("SELECT count( DISTINCT  `lists`.`id`) as total  FROM (`lists`) LEFT JOIN `likes` ON `lists`.`id`=`likes`.`list_id`  WHERE `lists`.`is_active` = 1 AND `lists`.`is_sold` = 0 AND `lists`.`is_deleted` = 0 AND `lists`.`is_admin_deleted` = 0 AND `lists`.`end_auction` >='$date'  $wheres  ");   


       //echo $this->db->last_query();
       return $query->row(); 
    }


   

    // public function get_network_details($where= array(), $view,$session_id,$limit,$offset){ 


    //     $query = $this->db->query("SELECT lists.*,list_attachments.url FROM lists LEFT JOIN  list_attachments ON list_attachments.list_id = lists.id WHERE  lists.is_deleted ='0' AND lists.user_id=$session_id  GROUP BY lists.id ORDER BY id ASC LIMIT $limit  OFFSET $offset");   
         
    //    //echo $this->db->last_query();
    //    return $query->result(); 
    // }
    // public function get_pagination_details($where= array(), $view,$session_id,$limit,$offset){ 
    //     $query = $this->db->query("SELECT count(id) as total FROM lists WHERE user_id=$session_id ");   
         
    //    //echo $this->db->last_query();
    //    return $query->row(); 
    // }
    // public function bid_details($list_id){ 
    //     $query = $this->db->query("SELECT bid.bid_amount,bid.is_won,bid.is_sold,bid.is_deleted,lists.title,lists.starting_bid,user.first_name,user.phone,list_attachments.url  FROM `bid` LEFT JOIN lists ON lists.id=bid.list_id LEFT JOIN user ON user.id = bid.user_id  LEFT JOIN list_attachments ON list_attachments.list_id = lists.id  WHERE bid.`list_id` = $list_id GROUP BY bid.id ORDER BY bid.created_on ASC");   
         
    //    //echo $this->db->last_query();
    //    return $query->result(); 
    // }
    
}

?>