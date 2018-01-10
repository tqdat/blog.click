<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class auth{
    var $user_id = '';
    function __construct(){
        $this->V =& get_instance();
        $this->user_id = $this->V->session->data['user_id'];
    }
    
    function check_user($username){
        $find = array("'","*"," ","#","--");
        $replace = array("","","","","");
        $username = str_replace($find,$replace,$username);
        
        $row = $this->V->db->row("SELECT username FROM user WHERE username = '$username'");
        return $row;
    }
    
    function check_user_password($username, $password){
        $find = array("'","*"," ","#","--");
        $replace = array("","","","","");
        $username = str_replace($find,$replace,$username);
        $password = md5($password);
        return $this->V->db->row("SELECT `username`, `password` FROM `user` WHERE `username` = '$username' AND `password` = '$password'");
   }
   
   function check_customer($username,$password){
        $find = array("'","*"," ","#","--");
        $replace = array("","","","","");
        $username = str_replace($find,$replace,$username);
        $row = $this->V->db->row("SELECT * FROM customer WHERE username = '$username' AND password = '$password'");
        $_SESSION['customer_id'] = $row->customer_id;
        return $row;
   }
   
   function check_num_username($username){
        $row = $this->V->db->num_rows("SELECT username FROM customer WHERE username = '$username'");
        return $row;
    }
    
    function check_num_email($email){
        $row = $this->V->db->num_rows("SELECT email FROM customer WHERE email = '$email'");
        return $row;
    }
    
   function check_oldpassword($username,$password){
        $row = $this->V->db->num_rows("SELECT * FROM customer WHERE username = '$username' AND password = '$password'");
        return $row;
    }
    
   function user_id(){
       return $this->user_id;
   }
   
    function set_auth($username, $password){
        $find = array("'","*"," ","#","--");
        $replace = array("","","","","");
        $username = str_replace($find,$replace,$username);
        $password = md5($password);
        $row = $this->V->db->row("SELECT `user_id`, `group_id`, `fullname`, `username`, `avatar` FROM `user` WHERE `username` = '$username' AND `password` = '$password'");
        $_SESSION['user_id'] = $row->user_id;
        $_SESSION['group_id'] = $row->group_id;
        $_SESSION['fullname'] = $row->fullname;
        $_SESSION['username'] = $row->username;
        $_SESSION['avatar'] = $row->avatar;
    }   
    
    function customer_auth($customer_id){
        $row = $this->V->db->row("SELECT * FROM customer WHERE customer_id = $customer_id");
        $_SESSION['customer_id'] = $row->customer_id;
        return $row;
   }
}
