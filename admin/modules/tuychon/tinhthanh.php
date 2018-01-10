<?php
class tinhthanh extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('tinhthanh_model','tinhthanh');
        $this->load->model('tuychon_model','tuychon');
        $this->ip = $this->config->item('ip_webservice');
    }
    
    function index(){
        $chauluc = $this->tuychon->get_all_chauluc();
        $id = $chauluc[0]->id;
        redirect('tuychon/quocgia/ds/?ct='.$id);
    }
    
    function ds(){
        $co = (int)$this->request->get['co'];
        $ct = $this->request->get['ct'];
        $edit = (int)$this->request->get['edit'];
        if($edit > 0){
            $id = $edit;
            $data['r'] = $this->db->row("SELECT * FROM city WHERE city_id = $id");
        }
        $data['co'] = $co;
        $data['ct'] = $ct;
        $data['dsquocgia'] = $this->tuychon->get_all_quocgia($co);
        $data['edit'] = $edit;
        $data['chauluc'] = $this->tuychon->get_all_chauluc();
        $data['title'] = "Danh sách tỉnh thành phố";
        //$data['add'] = 'tuychon/quocgia/add';
        $config['base_url'] = base_url().'tuychon/tinhthanh/ds';
        $config['total_rows']   =  $this->tinhthanh->get_num_tinhthanh();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   100; 
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->tinhthanh->get_all_tinhthanh($config['per_page'],segment(4,'int'));
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('tinhthanh/ds',$data);
    }
    
    function save(){
        $city_id = $this->request->post['city_id'];
        $city_name = $this->request->post['city_name'];
        $ordering = $this->request->post['ordering'];
        $order = ($ordering == '')?$this->tinhthanh->get_max_order()+1:$ordering;
 
        
        $vdata['city_name'] = $city_name;
        $vdata['parentid'] = 0;
        $vdata['ordering']  = $order;
        if($city_id == 0){
            if($this->db->insert('city',$vdata)){
                $id = $this->db->insert_id();
                $data['error'] = 0;
                $data['msg'] = "Mã quốc gia đã tồn tại";
            }else{
                $data['error'] = 1;
                $data['msg'] = "Mã quốc gia đã tồn tại"; 
            }
        }else{                                                         
            if($this->db->update('city',$vdata,array('city_id'=>$city_id))){
                $data['error'] = 0;
            }
        }
        echo json_encode($data);
    }
    
    function save_order(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $_POST['order_'.$id[$i]];
            $this->db->update('city',$menu,array('city_id'=>$id[$i]));
        }
    }
    
    function del(){
        $id = segment(4);
        $rs = $this->tinhthanh->get_tinhthanh($id);
        $st_name = $rs->city_name;
        $total = $this->tinhthanh->get_num_quanhuyen($id);
        if($total > 0){
            $msg = "Vẫn còn quận huyện trong thành phố: ".$st_name.". Không thể xóa";
        }else{
            if($this->db->query("DELETE FROM city WHERE city_id = $id")){
                $msg = "Xóa Tỉnh, thành phố: ".$st_name." thành công";
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tuychon/tinhthanh/ds/');
    }
}
