
<?php

class khachhang extends vnit {

    function __construct() {
        parent::__construct();
        $this->load->model('khachhang_model', 'khachhang');
    }

    function index() {
        $data['title'] = "Hình ảnh khách hàng";
        $data['list_img'] = $this->khachhang->get_all_img();
        $this->load->templates('index', $data);
        
    }

    function chitiet() {
        $id = end(explode('-', $this->uri->segment(2)));
        $data['img'] = $this->khachhang->get_khachhang_img($id);
        $data['khachhang'] = $this->khachhang->get_chitiet_khachhang($id);
        $data['title'] = $data['khachhang']->title;
        $data['khachhangother'] = $this->khachhang->get_khachhang($id);
        $this->load->templates('detail', $data);
    }

}
