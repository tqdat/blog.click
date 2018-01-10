<?php
class quangcao extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('quangcao_model','quangcao');
    }
}