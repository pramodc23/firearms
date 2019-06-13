<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class List_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '',$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);  
        $this->db->where('is_deleted',0);
        $this->db->where('type',1);      
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function userListingfixCount($searchText = '',$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);  
        $this->db->where('is_deleted',0);
        $this->db->where('type',2);      
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function singleuserListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    function viewbuyerCount($searchText = '',$user_id=0)
    {
        $this->db->select('lists.id,lists.title,lists.reserve_price,lists.is_sold,lists.status,lists.end_auction, MAX(bid.bid_amount) as max_bid');
        $this->db->from('bid');
        $this->db->join('lists', 'lists.id = bid.list_id','left');

        if(!empty($searchText)) {
            $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
                            OR  lists.item_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('bid.user_id', $user_id);
        $this->db->group_by('bid.list_id');
        $query = $this->db->get();        
        return $query->num_rows();
    }
    
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */

    function userListingfix($searchText = '', $page, $segment,$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('type',2);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        }       
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }

    function userListing($searchText = '', $page, $segment,$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('type',1);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        }       
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }
    function singleuserListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }
     function viewbuyerlisting($searchText = '', $page, $segment,$user_id=0)
    {
       
        $this->db->select('lists.id,lists.item_number,lists.title,lists.reserve_price,lists.is_sold,lists.status,lists.end_auction, MAX(bid.bid_amount) as max_bid,bid.is_won,bid.user_id as buyerid');
        $this->db->from('bid');
        $this->db->join('lists', 'lists.id = bid.list_id','left');

        if(!empty($searchText)) {
            $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
                            OR lists.item_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('bid.user_id', $user_id);
        $this->db->group_by('bid.list_id');
        $this->db->order_by('bid.id','desc');
         $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        return $query->result();

        // SELECT lists.id,lists.title,lists.reserve_price,lists.is_sold,lists.status,lists.end_auction, MAX(bid.bid_amount) as max_bid   FROM `bid` LEFT JOIN lists ON bid.list_id    =lists.id WHERE bid.user_id='8' GROUP BY bid.list_id  ORDER BY bid.id DESC

    }
    
     function soldListingfix($searchText = '', $page, $segment,$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',1);
        $this->db->where('type',2);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }

    function soldListing($searchText = '', $page, $segment,$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',1);
        $this->db->where('type',1);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }

    function in_auctionfixListing($searchText = '', $page, $segment,$user_id=0)
    {   $today = date("Y-m-d H:i:s");
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',0);
        $this->db->where('type',2);
        $this->db->where('end_auction > ',$today);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;


    }
    
    function in_auctionListing($searchText = '', $page, $segment,$user_id=0)
    {   $today = date("Y-m-d H:i:s");
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',0);
        $this->db->where('type',1);
        $this->db->where('end_auction > ',$today);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;


    }

    function expiredfixListing($searchText = '', $page, $segment,$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('type',2);
        $date = date("Y-m-d H:i:s");
        $where="end_auction < '$date'";
        $this->db->where($where);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }

        function expiredListing($searchText = '', $page, $segment,$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('type',1);
        $date = date("Y-m-d H:i:s");
        $where="end_auction < '$date'";
        $this->db->where($where);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();       
        return $result;
    }


   function reserve_metListing($searchText = '', $page, $segment,$user_id=0)
    {  
        $this->db->select('max(bid.bid_amount) as max_bid_amount,lists.*');
        $this->db->from('lists');
        $this->db->join('bid', 'lists.id = bid.list_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
                            OR  lists.item_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('lists.is_admin_deleted', 0);
        $this->db->where('lists.is_deleted',0);  
        $this->db->where('lists.is_sold', 0);
        $this->db->where('type',1);
        if ($user_id !=0) {
            $this->db->where('lists.user_id',$user_id);
        } 
        $where=' bid.bid_amount >= lists.reserve_price';
        $this->db->where($where);
        $this->db->group_by('lists.id');
        $this->db->order_by('lists.id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;

        //SELECT max(bid.bid_amount) as max_bid_amount,lists.* FROM `lists` LEFT JOIN bid ON lists.id = bid.list_id WHERE lists.`is_admin_deleted` =0 AND lists.`is_sold` =0  AND lists.`user_id` = '10' AND bid.bid_amount > lists.reserve_price GROUP BY lists.id  ORDER BY lists.`id` DESC LIMIT 10   
    }

  function reserve_not_metListing($searchText = '', $page, $segment,$user_id=0)
    {   
        // $this->db->select('max(bid.bid_amount) as max_bid_amount,lists.*');
        // $this->db->from('lists');
        // $this->db->join('bid', 'lists.id = bid.list_id','left');
        // if(!empty($searchText)) {
        //     $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
        //                     OR  lists.item_number  LIKE '%".$searchText."%')";
        //     $this->db->where($likeCriteria);
        // }
        // $this->db->where('lists.is_admin_deleted', 0);
        // $this->db->where('lists.is_deleted',0);  
        // $this->db->where('lists.is_sold', 0);
        // if ($user_id !=0) {
        //     $this->db->where('lists.user_id',$user_id);
        // } 
        // $where=' bid.bid_amount < lists.reserve_price';
        // $this->db->where($where);
        // $this->db->group_by('lists.id');
        // $this->db->order_by('lists.id','desc');
        // $this->db->limit($page, $segment);
        // $query = $this->db->get();
        
        // $result = $query->result();        
        // return $result;

        if ($segment==0) {
            $segment='';
        }else{
            $segment=", $segment";
        }
        if(!empty($searchText)) {
            $search_text=" AND (`title` LIKE '%".$searchText."%' OR `item_number` LIKE '%".$searchText."%' )";
        }else{
            $search_text='';
        }

        if ($user_id !=0) {
            $u_id=" AND user_id=".$user_id." ";
        }else{
            $u_id=" ";
        } 

        return $this->db->query("SELECT *,(select max(`bid`.`bid_amount`) as maxbid from `bid` where `bid`.`list_id`=`lists`.`id`) as max_bid_amount FROM `lists` where reserve_price > (select max(`bid`.`bid_amount`) as maxbid from `bid` where `bid`.`list_id`=`lists`.`id`) AND  is_admin_deleted=0 AND type=1 AND is_deleted=0 AND is_sold=0 $search_text $u_id ORDER BY id DESC LIMIT $page $segment ")->result();

    }

    function soldListingfixCount($searchText = '',$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',1);
        $this->db->where('type',2);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function soldListingCount($searchText = '',$user_id=0)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',1);
        $this->db->where('type',1);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function item_in_auction_fix_ListingCount($searchText = '',$user_id=0)
    {
        $today = date("Y-m-d H:i:s");
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',0);
        $this->db->where('type',2);
        $this->db->where('end_auction > ',$today);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function item_in_auction_ListingCount($searchText = '',$user_id=0)
    {
        $today = date("Y-m-d H:i:s");
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('is_sold',0);
        $this->db->where('type',1);
        $this->db->where('end_auction > ',$today);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function item_expired_fix_ListingCount($searchText = '',$user_id=0)
    {
            $today = date("Y-m-d H:i:s");
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('type',2);
        $where="end_auction < '$today'";
        $this->db->where($where);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

       function item_expired_ListingCount($searchText = '',$user_id=0)
    {
            $today = date("Y-m-d H:i:s");
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted',0);
        $this->db->where('is_deleted',0);  
        $this->db->where('type',1);
        $where="end_auction < '$today'";
        $this->db->where($where);
        if ($user_id !=0) {
            $this->db->where('user_id',$user_id);
        } 
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

   function item_reserve_met_ListingCount($searchText = '',$user_id=0)
    {
        $this->db->select('max(bid.bid_amount) as max_bid_amount,lists.*');
        $this->db->from('lists');
        $this->db->join('bid', 'lists.id = bid.list_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
                            OR  lists.item_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('lists.is_admin_deleted', 0);
        $this->db->where('lists.is_deleted',0);  
        $this->db->where('lists.is_sold', 0);
        $this->db->where('type',1);
        if ($user_id !=0) {
            $this->db->where('lists.user_id',$user_id);
        } 
        $where=' bid.bid_amount >= lists.reserve_price';
        $this->db->where($where);
        $this->db->group_by('lists.id');
        $this->db->order_by('lists.id','desc');
 
        $query = $this->db->get();        
        return $query->num_rows();
    }



  function item_reserve_not_met_ListingCount($searchText = '',$user_id=0)
    {
        // $this->db->select('max(bid.bid_amount) as max_bid_amount,lists.*');
        // $this->db->from('lists');
        // $this->db->join('bid', 'lists.id = bid.list_id','left');
        // if(!empty($searchText)) {
        //     $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
        //                     OR  lists.item_number  LIKE '%".$searchText."%')";
        //     $this->db->where($likeCriteria);
        // }
        // $this->db->where('lists.is_admin_deleted', 0);
        // $this->db->where('lists.is_deleted',0);  
        // $this->db->where('lists.is_sold', 0);
        // if ($user_id !=0) {
        //     $this->db->where('lists.user_id',$user_id);
        // } 
        // $where=' bid.bid_amount < lists.reserve_price';
        // $this->db->where($where);
        // $this->db->group_by('lists.id');
        // $this->db->order_by('lists.id','desc');
 
        // $query = $this->db->get();        
        // return $query->num_rows();
     
        if(!empty($searchText)) {
            $search_text=" AND (`title` LIKE '%".$searchText."%' OR `item_number` LIKE '%".$searchText."%' )";
        }else{
            $search_text='';
        }

        if ($user_id !=0) {
            $u_id=" AND user_id=".$user_id." ";
        }else{
            $u_id=" ";
        } 

        return $this->db->query("SELECT *,(select max(`bid`.`bid_amount`) as maxbid from `bid` where `bid`.`list_id`=`lists`.`id`) as max_bid_amount FROM `lists` where reserve_price > (select max(`bid`.`bid_amount`) as maxbid from `bid` where `bid`.`list_id`=`lists`.`id`) AND  is_admin_deleted=0 AND type=1 AND is_deleted=0 AND is_sold=0 $search_text $u_id ORDER BY id DESC ")->num_rows();
   

    }
    


    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function BidsCount($searchText = '')
    {
        $this->db->select('lists.title, bidder.first_name, bid.bid_amount, bid.created_on, bid.is_won');
        $this->db->from('bid');
        $this->db->join('lists', 'lists.id = bid.list_id','inner');
        $this->db->join('user as bidder', 'bidder.id = bid.user_id','inner');

        if(!empty($searchText)) {
            $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
                            OR  bidder.first_name  LIKE '%".$searchText."%'
                            OR  bid.bid_amount  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('bid.is_deleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }


    function categoryCount($searchText = '')
    {
        $this->db->select('id,name,parent_id,status');
        $this->db->from('categories');

        if(!empty($searchText)) {
            $likeCriteria = "(name  LIKE '%".$searchText."%'
                            OR  slug  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bidsListing($searchText = '', $page, $segment)
    {
        $this->db->select('bid.id, bid.list_id, lists.title, bidder.id as u_id,bidder.first_name, bid.bid_amount, bid.created_on, bid.is_won');
        $this->db->from('bid');
        $this->db->join('lists', 'lists.id = bid.list_id','inner');
        $this->db->join('user as bidder', 'bidder.id = bid.user_id','inner');

        if(!empty($searchText)) {
            $likeCriteria = "(lists.title  LIKE '%".$searchText."%'
                            OR  bidder.first_name  LIKE '%".$searchText."%'
                            OR  bid.bid_amount  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('bid.is_deleted', 0);
        $this->db->order_by('bid.id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function categoryListing($searchText = '', $page, $segment)
    {
        $this->db->select('id,name,parent_id,status');
        $this->db->from('categories');

        if(!empty($searchText)) {
            $likeCriteria = "(name  LIKE '%".$searchText."%'
                            OR  slug  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    function manufacturerListing($searchText = '', $page, $segment)
    {

        $this->db->select('manufacturer.id,manufacturer.status,manufacturer.name as manufacturer,manufacturer.category_id,categories.parent_id,categories.name as category_name');
        $this->db->from('manufacturer');
        $this->db->join('categories', 'categories.id = manufacturer.category_id','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(manufacturer.name  LIKE '%".$searchText."%'
                            OR  manufacturer.slug  LIKE '%".$searchText."%'
                            OR  categories.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function manufacturercount($searchText = '')
    {

        $this->db->select('manufacturer.id,manufacturer.name as manufacturer,manufacturer.category_id,categories.parent_id,categories.name as category_name');
        $this->db->from('manufacturer');
        $this->db->join('categories', 'categories.id = manufacturer.category_id','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(manufacturer.name  LIKE '%".$searchText."%'
                            OR  manufacturer.slug  LIKE '%".$searchText."%'
                            OR  categories.name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();

    }
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }

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
    
    # function for delete data from database 
    function delete_data($table , $condition){
        return $this->db->delete($table,$condition);
        die();
    }
    
    # function for update data in database 
    function update_data($table , $data , $condition){
        $this->db->where($condition);
        return $this->db->update($table,$data);
        print_r($condition);
        die();
    }


    # function for delete data in database 
    function deleteuserBid($bidid){
        $this->db->where('id', $bidId);
        $this->db->delete('bid');
        
        return $this->db->affected_rows();
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


    function create_list_for_sold($id){
       
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

  