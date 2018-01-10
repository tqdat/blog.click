<?php
class filemanager extends vnit{
    protected $_templates;
    function __construct(){
        parent::__construct();
    }
    
    function index(){
        //redirect('filemanager');
        $data['title'] = 'Quản lý hình ảnh';
        $this->_templates['page'] = 'index';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function images(){
        $data['title'] = 'Quản lý hình ảnh';
        $this->_templates['page'] = 'images';
        $this->load->templates($this->_templates['page'],$data);         
    }
    
    function filedata(){
        $data['title'] = 'Quản lý File';
        $this->_templates['page'] = 'filedata';
        $this->load->templates($this->_templates['page'],$data);        
    }
    
    function media(){
        $data['title'] = 'Quản lý Media';
        $this->_templates['page'] = 'media';
        $this->load->templates($this->_templates['page'],$data);
    }
}
