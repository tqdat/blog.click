<?php
class account extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('account_model','account');
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = 'Danh sách tài khoản';
        $data['delete'] = true;
        $data['add'] = 'account/add';
        $config['base_url'] = base_url().'account/ds/';
        $config['total_rows']   =  $this->account->get_num_account();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->account->get_all_account($config['per_page'],segment(3,'int'));
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = 'Thêm mới tài khoản';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'account/ds';
        $this->form_validation->set_rules('fullname','Tên thành viên','required');
        $this->form_validation->set_rules('username','Tên đăng nhập','required|callback__checkuser_add');
        $this->form_validation->set_rules('email','Email','required|valid_email|callback__checkemail_add');
        $this->form_validation->set_rules('password','Mật khẩu','required');
        $this->form_validation->set_rules('re_password','Mật khẩu nhắc lại','required|matches[password]');
        $this->form_validation->set_rules('address','Địa chỉ','');
        $this->form_validation->set_rules('phone','Điện thoại','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata['group_id'] =  $this->request->post['group_id'];
            $vdata['fullname'] =  $this->request->post['fullname'];
            $vdata['username'] =  $this->request->post['username'];
            $vdata['email'] =  $this->request->post['email'];
            $vdata['password'] =  md5($this->request->post['password']);
            $vdata['address'] =  $this->request->post['address'];
            $vdata['phone'] =  $this->request->post['phone'];
            $vdata['published'] =  $this->request->post['published'];
            if($this->db->insert('user',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $this->request->post['option'];
                if($option == 'save'){
                    $url = 'account/ds';
                }else{
                    $url = 'account/edit/'.$id;
                }
                redirect($url);
            }else{
                $this->pre_message = "Lưu không thành công";
            }
        }
        $data['message'] = $this->pre_message;
        $data['listgroup'] = $this->account->get_list_group();
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $page = segment(4,'int');
        $data['title'] = 'Cập nhật tài khoản tài khoản';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'account/ds/'.$page;
        $id = segment(3,'int');
        $data['rs'] = $this->db->row("SELECT * FROM `user` WHERE `user_id` = $id");
        
        $this->form_validation->set_rules('fullname','Tên thành viên','required');
        $this->form_validation->set_rules('username','Tên đăng nhập','required|callback__checkuser_edit');
        $this->form_validation->set_rules('email','Email','required|valid_email|callback__checkemail_edit');
        $this->form_validation->set_rules('password','Mật khẩu','');
        $this->form_validation->set_rules('re_password','Mật khẩu nhắc lại','matches[password]');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $user_id = $this->request->post['user_id'];
            $vdata['group_id'] =  $this->request->post['group_id'];
            $vdata['fullname'] =  $this->request->post['fullname'];
            $vdata['username'] =  $this->request->post['username'];
            $vdata['email'] =  $this->request->post['email'];
            $vdata['address'] =  $this->request->post['address'];
            $vdata['phone'] =  $this->request->post['phone'];
            if($_POST['password'] != ''){
            $vdata['password'] =  md5($this->request->post['password']);
            }
            $vdata['published'] =  $this->request->post['published'];
            if($this->db->update('user',$vdata,array('user_id'=>$user_id))){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                    $url = 'account/ds/'.$page;
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }else{
                $this->pre_message = "Lưu không thành công";
            }
        }
        $data['message'] = $this->pre_message;
        $data['listgroup'] = $this->account->get_list_group();
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        $page = segment(4,'int');
        if($this->db->delete('user',array('user_id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('error','Xóa không thành công');
        }
        redirect('account/ds/'.$page);
    }
    
    function dels(){
        $msg ='';
        $page = $this->request->post['page'];
        $ar_id = $this->request->post['ar_id'];
        for($i = 0; $i < sizeof($ar_id); $i++){
            $user_id = $ar_id[$i];
            if($this->db->delete('user',array('user_id'=>$user_id))){
                $msg .= "<div>Xóa ID: <b>".$user_id.'</b> thành công</div>';
            }else{
                $msg .= "<div>Xóa ID: <b>".$user_id.'</b> không thành công</div>';
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('account/ds/'.$page);
    }
    
    function _checkuser_add($username){
        $row = $this->db->row("SELECT `username` FROM `user` WHERE `username` = '$username'");
        if($row){
            $this->form_validation->set_message('_checkuser_add', 'Tên đăng nhập đã tồn tại trên hệ thống'); 
            return FALSE;
        }else{
            return true;
        }        
    }
    
    function _checkuser_edit($username){
        $user_id = $_POST['user_id'];
        $row = $this->db->row("SELECT `username` FROM `user` WHERE `username` = '$username' AND `user_id` <> $user_id");
        if($row){
            $this->form_validation->set_message('_checkuser_edit', 'Tên đăng nhập đã tồn tại trên hệ thống'); 
            return FALSE;
        }else{
            return true;
        }        
    }
    
    function _checkemail_add($email){
        $row = $this->db->row("SELECT `email` FROM `user` WHERE `email` = '$email'");
        if($row){
            $this->form_validation->set_message('_checkemail_add', 'Email đã tồn tại trên hệ thống'); 
            return FALSE;
        }else{
            return true;
        }        
    }
    
    function _checkemail_edit($email){
        $user_id = $_POST['user_id'];
        $row = $this->db->row("SELECT `emai` FROM `user` WHERE `emai` = '$emai' AND `user_id` <> $user_id");
        if($row){
            $this->form_validation->set_message('_checkemail_edit', 'Email đã tồn tại trên hệ thống'); 
            return FALSE;
        }else{
            return true;
        }        
    }
}
