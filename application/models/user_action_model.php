<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_action_model extends CI_Model
{
	# function for select data from database , with condition , limit , order , like and join clause
    function select_data($field , $table , $where = '' , $limit = '' , $order = '' , $like = '' , $join_array = '' , $group = ''){ 
        $this->db->select($field);
        $this->db->from($table);
        if($where != ""){ 
            $this->db->where($where);
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
    public function get_all_buying_details($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT bid.created_on,bid.list_id,max(bid.bid_amount) as max_bid ,bid.is_won,lists.* FROM `lists` LEFT JOIN bid ON lists.id=bid.list_id  WHERE bid.user_id=$session_id AND bid.is_deleted='0' GROUP BY lists.id ORDER BY lists.$shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_all_buying_pagination($where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT COUNT(DISTINCT list_id) AS total FROM `bid` WHERE user_id=$session_id AND is_deleted='0'");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }

    public function get_all_buying_fixed_details($where = array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by)
    {
          
        $query = $this->db->query("SELECT sell_fixed_item.quantity as sell_quantity, lists.* FROM `lists` LEFT JOIN sell_fixed_item ON lists.id = sell_fixed_item.list_id  WHERE sell_fixed_item.buyer_id=$session_id ORDER BY lists.$shortlist_item $order_by LIMIT $limit  OFFSET $offset");
        return $query->result();

    }
    public function get_all_buying_fixed_pagination($where= array(), $view,$session_id,$limit,$offset)
    {
              $query = $this->db->query("SELECT COUNT(list_id) AS total FROM `sell_fixed_item` WHERE buyer_id=$session_id");   
         
       //echo $this->db->last_query();
       return $query->row();
    }

    public function get_all_buying_won_details($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT * FROM `lists`WHERE buyer_id=$session_id AND status='sold'  AND is_admin_deleted='0' AND is_deleted='0' AND type='1' ORDER BY lists.$shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_all_buying_won_pagination($where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT COUNT(DISTINCT id) AS total FROM `lists` WHERE buyer_id=$session_id AND is_deleted='0' AND is_admin_deleted='0' AND  status='sold' AND type='1'");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }

    public function get_all_watchlist($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 

        $query = $this->db->query("SELECT watchlist.id as watchlist_id,lists.*,bid.created_on as bid_created_on,bid.list_id,max(bid.bid_amount) as max_bid ,bid.is_won FROM `watchlist` LEFT JOIN  `lists` ON watchlist.list_id = lists.id LEFT JOIN bid ON lists.id=bid.list_id WHERE watchlist.status=1 AND watchlist.user_id =$session_id AND lists.type = 1 GROUP BY watchlist.id ORDER BY lists.$shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_all_watchlist_pagination($where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT COUNT(DISTINCT watchlist.id) AS total FROM `watchlist` LEFT JOIN  `lists` ON watchlist.list_id = lists.id LEFT JOIN bid ON lists.id=bid.list_id WHERE watchlist.status=1 AND watchlist.user_id =$session_id AND lists.type = 1");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }

    public function get_all_watchlist_fixed($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 

        $query = $this->db->query("SELECT watchlist.id as watchlist_id,lists.* FROM `watchlist` LEFT JOIN  `lists` ON watchlist.list_id = lists.id WHERE watchlist.status=1 AND watchlist.user_id =$session_id AND lists.type = 2 GROUP BY watchlist.id ORDER BY lists.$shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_all_watchlist_fixed_pagination($where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT COUNT(DISTINCT watchlist.id) AS total FROM `watchlist` LEFT JOIN  `lists` ON watchlist.list_id = lists.id  WHERE watchlist.status=1 AND watchlist.user_id =$session_id  AND lists.type = 2");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }

  
    public function get_all_buying_notwon_details($where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT bid.created_on,bid.list_id,max(bid.bid_amount) as max_bid ,bid.is_won,lists.* FROM `lists` LEFT JOIN bid ON lists.id=bid.list_id  WHERE bid.user_id=$session_id AND bid.is_deleted='0' AND bid.is_sold='0' GROUP BY lists.id ORDER BY lists.$shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_all_buying_notwon_pagination($where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT COUNT(DISTINCT list_id) AS total FROM `bid` WHERE user_id=$session_id AND is_deleted='0' AND is_sold='0'");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }

    public function get_all_selling_details($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND user_id=$session_id  GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
        //echo $this->db->last_query();
        return $query->result(); 
    }
    public function get_all_selling_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT count(id) as total FROM lists WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND user_id=$session_id ");   
         
        //echo $this->db->last_query();
        return $query->row(); 
    }
    public function get_schedule_list($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){    
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND is_sold='0' AND  user_id=$session_id  AND end_auction > '$date'  GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");  
       return $query->result(); 
    }
    public function get_schedule_list_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT count(id) as total FROM lists  WHERE type = $dataType AND  is_deleted ='0' AND is_admin_deleted='0' AND is_sold='0' AND  user_id=$session_id  AND end_auction > '$date'");  
       return $query->row(); 
    }

    public function get_sold_list($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_sold ='1' AND is_admin_deleted='0' AND is_deleted ='0' AND status ='sold' AND is_sold='1' AND user_id=$session_id  GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_sold_list_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT count(id) as total FROM lists WHERE type = $dataType AND is_sold ='1' AND is_admin_deleted='0' AND is_deleted ='0' AND status ='sold'  AND is_sold='1' AND user_id=$session_id ");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }

    public function get_unsold_list($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_sold ='0'  AND is_deleted ='0' AND is_admin_deleted='0' AND  user_id=$session_id  AND end_auction < '$date' GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_unsold_list_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT count(id) as total FROM lists WHERE type = $dataType AND  is_sold ='0' AND is_deleted ='0' AND is_admin_deleted='0' AND user_id=$session_id AND end_auction < '$date' ");   
         
       //echo $this->db->last_query();
       return $query->row(); 
    }


    public function get_all_fixed_selling_details($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND user_id=$session_id AND type='2' GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");  
        return $query->result(); 
    }
    public function get_all_fixed_selling_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT count(id) as total FROM lists WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND user_id=$session_id AND type='2' ");   
        return $query->row(); 
    }

    public function get_fixed_schedule_list($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){    
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND is_sold='0' AND  user_id=$session_id AND type='2' AND end_auction > '$date'  GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");  
       return $query->result(); 
    }
    public function get_fixed_schedule_list_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT count(id) as total FROM lists  WHERE type = $dataType AND is_deleted ='0' AND is_admin_deleted='0' AND is_sold='0' AND  user_id=$session_id AND type='2' AND end_auction > '$date'");  
       return $query->row(); 
    }

    public function get_fixed_sold_list($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_admin_deleted='0' AND is_deleted ='0' AND status ='sold' AND is_sold='1' AND user_id=$session_id AND type='2' GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");  
       // echo $this->db->last_query();
       return $query->result(); 
    }
    public function get_fixed_sold_list_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $query = $this->db->query("SELECT count(id) as total FROM lists WHERE type = $dataType AND is_admin_deleted='0' AND is_deleted ='0' AND status ='sold'  AND is_sold='1' AND user_id=$session_id AND type='2' ");   
       return $query->row(); 
    }

    public function get_fixed_unsold_list($dataType,$where= array(), $view,$session_id,$limit,$offset,$shortlist_item,$order_by){ 
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT * FROM lists  WHERE type = $dataType AND is_sold ='0'  AND is_deleted ='0' AND is_admin_deleted='0' AND  user_id=$session_id  AND type='2' AND end_auction < '$date' GROUP BY id ORDER BY $shortlist_item $order_by LIMIT $limit  OFFSET $offset");   
       return $query->result(); 
    }
    public function get_fixed_unsold_list_pagination($dataType,$where= array(), $view,$session_id,$limit,$offset){ 
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query("SELECT count(id) as total FROM lists WHERE type = $dataType AND is_sold ='0' AND is_deleted ='0' AND is_admin_deleted='0' AND user_id=$session_id AND type='2' AND end_auction < '$date' ");   
       return $query->row(); 
    }

    public function get_all_video($where= array(), $view,$session_id,$limit,$offset){           
        $query = $this->db->query("SELECT list_attachments.*,lists.slug,lists.title,lists.buy_now_price,lists.status,lists.is_sold,lists.end_auction FROM list_attachments INNER JOIN lists ON list_attachments.list_id=lists.id WHERE  list_attachments.type ='vimeo_id'   ORDER BY id DESC LIMIT $limit  OFFSET $offset");            
        //echo $this->db->last_query();
       
        return $query->result(); 
    }
    public function get_all_video_pagination($where= array(), $view,$session_id,$limit,$offset){    
        $query = $this->db->query("SELECT COUNT(list_attachments.id) as total  FROM list_attachments INNER JOIN lists ON list_attachments.list_id=lists.id WHERE  list_attachments.type ='vimeo_id'  ");            
        //echo $this->db->last_query();
      
        return $query->row(); 
    }

    public function get_all_my_network_video($where= array(), $view,$session_id,$limit,$offset){           
        $query = $this->db->query("SELECT list_attachments.*,lists.slug,lists.title,lists.buy_now_price,lists.status,lists.is_sold,lists.end_auction FROM list_attachments INNER JOIN lists ON list_attachments.list_id=lists.id WHERE  list_attachments.type IN ('youtube','vimeo_id')   ORDER BY id DESC LIMIT $limit  OFFSET $offset");      
       
        return $query->result(); 
    }
    public function get_all_my_network_video_pagination($where= array(), $view,$session_id,$limit,$offset){    
        $query = $this->db->query("SELECT COUNT(list_attachments.id) as total  FROM list_attachments INNER JOIN lists ON list_attachments.list_id=lists.id WHERE  list_attachments.type IN ('youtube','vimeo_id')  ");            
      
        return $query->row(); 
    }

    public function bid_details($list_id){ 
        $query = $this->db->query("SELECT bid.list_id,bid.bid_amount,bid.is_won,bid.is_sold,bid.is_deleted,lists.title,lists.starting_bid,user.first_name,user.phone  FROM `bid` LEFT JOIN lists ON lists.id=bid.list_id LEFT JOIN user ON user.id = bid.user_id    WHERE bid.`list_id` = $list_id AND bid.is_deleted ='0' GROUP BY bid.id ORDER BY bid.created_on ASC");   
         
       //echo $this->db->last_query();
       return $query->result(); 
    }

    public function create_list_for_sold($id){
       
        $this->db->select('*');
        $this->db->from('lists');       
        $this->db->where('id',$id);
        $list_detail = $this->db->get()->row();  
     
        if (!empty($list_detail)) {
            $item_number=mt_rand(100000,999999);

            $date = date("Y-m-d H:i:s");
            $final_slug=$list_detail->slug.'-'.substr(md5(microtime()) , 0 , 5);
            $list_info=array(
                            'item_number'=>$item_number,
                            'user_id'=>$list_detail->user_id,
                            'title'=>$list_detail->title,
                            'categories'=>$list_detail->categories,
                            'manufacturer'=>$list_detail->manufacturer,
                            'other_manufacturer'=>$list_detail->other_manufacturer,
                            'slug'=>$final_slug,
                            'item_condition'=>$list_detail->item_condition,
                            'item_location'=>$list_detail->item_location,
                            'country'=>$list_detail->country,
                            'FFL'=>$list_detail->FFL,
                            'MFG'=>$list_detail->MFG,
                            'SKU'=>$list_detail->SKU,
                            'serial_number'=>$list_detail->serial_number,
                            'homepage_post'=>$list_detail->homepage_post,
                            'UPC'=>$list_detail->UPC,
                            'description'=>$list_detail->description,
                            'additional_terms_of_sale'=>$list_detail->additional_terms_of_sale,
                            'shipping_method'=>$list_detail->shipping_method,
                            'shipping_class'=>$list_detail->shipping_class,
                            'pays_for_shipping'=>$list_detail->pays_for_shipping,
                            'where_you_will_ship'=>$list_detail->where_you_will_ship,
                            'duration_days'=>$list_detail->duration_days,
                            'relist_options'=>$list_detail->relist_options,
                            'starting_bid'=>$list_detail->starting_bid,
                            'starting_bid_with_commission'=>$list_detail->starting_bid_with_commission,
                            'reserve_price'=>$list_detail->reserve_price,
                            'buy_now_price'=>$list_detail->buy_now_price,
                            'buy_now_price_with_commission'=>$list_detail->buy_now_price_with_commission,
                            'end_auction'=>date("Y-m-d H:i:s", strtotime($date. ' + '.$list_detail->duration_days.' days')),
                            'is_picture'=>$list_detail->is_picture,
                            'is_video'=>$list_detail->is_video,
                            'is_active'=>1
                            );

            $result=$this->db->insert('lists' , $list_info);
            $new_list_id=$this->db->insert_id();

            $this->db->select('*');
            $this->db->from('list_attachments');       
            $this->db->where('list_id',$id);
            $list_image = $this->db->get()->result();
            foreach ($list_image as  $value) {
                $file_info=array(
                            'list_id'=>$new_list_id,
                            'url'=>$value->url,
                            'type'=>$value->type,
                            'is_featured'=>$value->is_featured);
                $this->db->insert('list_attachments' , $file_info);
            } 

            return $result;

        }else{
            return 0;    
        }    
        
    }

}

?>