<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class smsfibo{
    function __construct(){
        $this->APP = get_instance();
        $this->sms_user = $this->APP->config->item('user_sms');
        $this->sms_pass = $this->APP->config->item('pass_sms');
        $this->sms_type = $this->APP->config->item('type_sms');
        $this->user_id = $_SESSION['user_id'];
        $this->group_id = $_SESSION['group_id'];
    }
    
    function send1($phone = 0, $message = ""){
        $vdata['user_id'] = $this->user_id;
        $vdata['group_id'] = $this->group_id;
        $vdata['phone'] = $phone;
        $vdata['message'] = $message;
        $vdata['month'] = date('m',time());
        $vdata['year'] = date('Y',time());
        $vdata['date_send'] = time();
        /*
        $completeurl = "http://center.fibosms.com/Service.asmx/SendSMS?clientNo=".$this->sms_user."&clientPass=".$this->sms_pass."&phoneNumber=".$phone."&smsMessage=".$message."&smsGUID=1&serviceType=".$this->sms_type;
        $xml = simplexml_load_file($completeurl);
        $code = doc_tag($xml,'code');
        $sys_msg = doc_tag($xml,'message');*/
        $vdata['status'] = 1;
        $vdata['sys_msg'] = "Sendding...";
        
        if($this->APP->db->insert('logs_sms',$vdata)){
             return true;
        }else{
            return false;
        }


    }
    
    function send($phone = 0, $message = ""){
        $vdata['user_id'] = $this->user_id;
        $vdata['group_id'] = $this->group_id;
        $vdata['phone'] = $phone;
        $vdata['message'] = $message;
        $vdata['month'] = date('m',time());
        $vdata['year'] = date('Y',time());
        $vdata['date_send'] = time();
        $completeurl = "http://center.fibosms.com/Service.asmx/SendSMS?clientNo=".$this->sms_user."&clientPass=".$this->sms_pass."&phoneNumber=".$phone."&smsMessage=".$message."&smsGUID=1&serviceType=".$this->sms_type;
        $xml = simplexml_load_file($completeurl);
        $code = doc_tag($xml,'code');
        $sys_msg = doc_tag($xml,'message');
        $vdata['status'] = ($code == 200)?1:0;
        $vdata['sys_msg'] = $sys_msg;
        if($vdata['status'] == 1){
            
            if($this->APP->db->insert('logs_sms',$vdata)){
                 return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    
    function check_money_fibo(){
        $completeurl = "http://center.fibosms.com/Service.asmx/SendSMS?clientNo=".$this->sms_user."&clientPass=".$this->sms_pass."&phoneNumber=".$phone."&smsMessage=".$message."&smsGUID=1&serviceType=".$this->sms_type;
        $xml = simplexml_load_file($completeurl);
        $code = doc_tag($xml,'code');
    }
    
    function sendpass($phone, $password){
        $message = "Cong ty TNHH Phan Gia Huy. Mat khau duoc gui theo yeu cau cua ban. Mat khau: ".$password;
        $completeurl = "http://center.fibosms.com/Service.asmx/SendSMS?clientNo=".$this->sms_user."&clientPass=".$this->sms_pass."&phoneNumber=".$phone."&smsMessage=".$message."&smsGUID=1&serviceType=".$this->sms_type;
        $xml = simplexml_load_file($completeurl);
        $code = doc_tag($xml,'code');
        $sys_msg = doc_tag($xml,'message');
        $status = ($code == 200)?1:0;
        if($status == 1){
            return true;
        }else{
            return false;
        }

    }
}
