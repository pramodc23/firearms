<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        $this->db->select('id, email_id, first_name,phone');
        $this->db->from('user');
        if(!empty($searchText)) {
            $likeCriteria = "(email_id  LIKE '%".$searchText."%'
                            OR  first_name  LIKE '%".$searchText."%'
                            OR  phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted', 0);
        $this->db->where('user_type !=', 'admin');
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
    function userListing($searchText = '', $page, $segment)
    {
         $this->db->select('user.id, email_id, first_name,user_type,phone,prefered_contact,is_blocked,(select count(bid.id) from bid where bid.user_id=user.id) as bids_count, (select count(lists.id) from lists where lists.user_id=user.id) as list_count');
        $this->db->from('user');
        
        if(!empty($searchText)) {
            $likeCriteria = "(email_id  LIKE '%".$searchText."%'
                            OR  first_name  LIKE '%".$searchText."%'
                            OR  phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('is_admin_deleted', 0);
        $this->db->where('user_type !=', 'admin');
        $this->db->order_by('id', 'desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result();        
        return $result;
    }

    function user_export_in_csv()
    {
         $this->db->select('user.id,first_name,user_type, email_id, phone,prefered_contact,(select count(bid.id) from bid where bid.user_id=user.id) as bids_count,(select count(lists.id) from lists where lists.user_id=user.id) as list_count');
        $this->db->from('user');        
        
        $this->db->where('is_admin_deleted', 0);
        $this->db->where('user_type !=', 'admin');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();        
        return $result;
    }
    
     /**
     * This function is used to get the user Bids count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userBidsCount($searchText = '' , $user_id)
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
        $this->db->where('bid.user_id', $user_id);
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
    function userBids($searchText = '', $page, $segment, $user_id)
    {
        $this->db->select('bid.id, lists.title,lists.id as list_id, bidder.first_name,bidder.id as u_id, bid.bid_amount, bid.created_on, bid.is_won');
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
        $this->db->where('bid.user_id', $user_id);
        $this->db->order_by('bid.id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListsCount($searchText = '',$user_id)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('lists.user_id', $user_id);
        $this->db->order_by('id','desc');
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
    function userLists($searchText = '', $page, $segment, $user_id)
    {
        $this->db->select('*');
        $this->db->from('lists');
        if(!empty($searchText)) {
            $likeCriteria = "(title  LIKE '%".$searchText."%'
                            OR  description  LIKE '%".$searchText."%'
                           )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('lists.user_id', $user_id);
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email_id");
        $this->db->from("user");
        $this->db->where("email_id", $email);   
        if($userId != 0){
            $this->db->where("id !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('user', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_type !=', 'admin');
        $this->db->where('id', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('id', $userId);
        $this->db->update('user', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('user', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */

    function deleteList($listId, $listInfo)
    {
        $this->db->where('id', $listId);
        $this->db->update('lists', $listInfo);
        
        return $this->db->affected_rows();
    }

    function deleteBid($bidId, $bidInfo)
    {
        $this->db->where('id', $bidId);
        $this->db->update('bid', $bidInfo);
        
        return $this->db->affected_rows();
    }
    function deleteuserBid($bidId, $bidInfo)
    {
        $this->db->where('id', $bidId);
        $this->db->delete('bid');
        
        return $this->db->affected_rows();
    }


    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('id, password');
        $this->db->where('id', $userId);        
       // $this->db->where('isDeleted', 0);
        $query = $this->db->get('user');
        
        $user = $query->result();

        if(!empty($user)){
            if($oldPassword==$user[0]->password){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('id', $userId);
       // $this->db->where('isDeleted', 0);
        $this->db->update('user', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }

    function contactcount($searchText = '')
    {
        $this->db->select('id,selectbasic,email,subject,message,userfile');
        $this->db->from('contact_us');

        if(!empty($searchText)) {
            $likeCriteria = "(selectbasic  LIKE '%".$searchText."%'
                            OR  email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    

    function contactListing($searchText = '', $page, $segment)
    {
        $this->db->select('id,selectbasic,email,subject,message,userfile');
        $this->db->from('contact_us');

        if(!empty($searchText)) {
            $likeCriteria = "(selectbasic  LIKE '%".$searchText."%'
                            OR  email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('id','desc');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }






}

  