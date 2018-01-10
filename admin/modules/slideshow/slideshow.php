<?php

class slideshow extends vnit {

    function __construct() {
        parent::__construct();
        $this->load->model('slideshow_model', 'slideshow');
       // $this->vcache->delcache(ROOT . 'site/cache/slider/');
    }

    function ds() {
        $data['title'] = 'Slide home';
        $data['add'] = 'slideshow/add';
        $data['delete'] = true;
        $config['base_url'] = base_url() . 'slideshow/ds/';
        $config['total_rows'] = $this->slideshow->get_num_slideshow();
        $data['num'] = $config['total_rows'];
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['list'] = $this->slideshow->get_all_slideshow($config['per_page'], segment(3, 'int'));
        $data['pagination'] = $this->pagination->create_links();
        $this->_templates['page'] = 'ds';
        $this->load->templates($this->_templates['page'], $data);
    }

    function add() {
        $data['title'] = "Thêm mới ảnh slideshow";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'nganhang/ds';
        $this->form_validation->set_rules('vdata[ten]', 'Tên ảnh', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->pre_message = validation_errors();
        } else {
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['ten']);
            if ($_FILES["userfile"]["size"] > 0) {
                $config['upload_path'] = ROOT . 'data/sl/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['file_name'] = $vdata['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $this->pre_message = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $this->pre_message);
                    redirect(uri_string());
                } else {
                    $result = $this->upload->data();
                    $vdata['images'] = $result['file_name'];
                    $folder_200 = ROOT . 'data/sl/200/' . $result['file_name'];
                    $this->load->helper('vimg');
                    vnit_resize_image(ROOT . 'data/sl/' . $result['file_name'], $folder_200, 200, 200, true);
                }
            }
            if ($this->db->insert('slideshow', $vdata)) {
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message', 'Lưu thành công');
                $option = $_POST['option'];
                if ($option == 'save') {
                    $url = 'slideshow/ds';
                } else {
                    $url = 'slideshow/edit/' . $id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'add';
        $this->load->templates($this->_templates['page'], $data);
    }

    function edit() {
        $data['title'] = "Cập nhật slideshow";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'slideshow/ds';
        $id = segment(3, 'int');
        $data['rs'] = $this->db->row("SELECT * FROM slideshow WHERE id_slide = $id");
        $this->form_validation->set_rules('vdata[ten]', 'Tên ảnh', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->pre_message = validation_errors();
        } else {
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['ten']);
            if ($_FILES["userfile"]["size"] > 0) {
                $config['upload_path'] = ROOT . 'data/sl/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10000';
                $config['file_name'] = $vdata['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $this->pre_message = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $this->pre_message);
                    redirect(uri_string());
                } else {
                    $result = $this->upload->data();
                    $vdata['images'] = $result['file_name'];
                    $folder_200 = ROOT . 'data/sl/200/' . $result['file_name'];
                    $this->load->helper('vimg');
                    vnit_resize_image(ROOT . 'data/sl/' . $result['file_name'], $folder_200, 200, 200, true);
                }
            }
            if ($this->db->update('slideshow', $vdata, array('id_slide' => $id))) {
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message', 'Lưu thành công');
                $option = $_POST['option'];
                if ($option == 'save') {
                    $url = 'slideshow/ds';
                } else {
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'edit';
        $this->load->templates($this->_templates['page'], $data);
    }

    function del() {
        $id = segment(3, 'int');
        if ($this->db->delete('slideshow', array('id_slide' => $id))) {
            $this->session->set_flashdata('message', 'Xóa thành công');
        } else {
            $this->session->set_flashdata('message', 'Xóa không thành công');
        }
        redirect('slideshow/ds');
    }

    function dels() {
        $ar_id = $this->request->post['ar_id'];
        $msg = "";
        for ($i = 0; $i < sizeof($ar_id); $i++) {
            $id = $ar_id[$i];
            if ($this->db->delete('slideshow', array('id' => $id))) {
                $msg .= "<div>Xóa ảnh slide ID: <b>$id</b> thành công </div>";
            } else {
                $msg .= "<div>Xóa ảnh slide ID: <b>$id</b> không thành công </div>";
            }
        }
        $this->session->set_flashdata('message', $msg);
        redirect('slideshow/ds');
    }
    
    function save_order(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $_POST['order_'.$id[$i]];
            $this->db->update('slideshow',$menu,array('id_slide'=>$id[$i]));
        }
    }

}

?>
