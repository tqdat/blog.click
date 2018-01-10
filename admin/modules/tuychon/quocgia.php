<?php
class quocgia extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('quocgia_model','quocgia');
        $this->load->model('tuychon_model','tuychon');
        $this->ip = $this->config->item('ip_webservice');
        $this->write_quocgia();
    }
    
    function index(){
        $chauluc = $this->tuychon->get_all_chauluc();
        $id = $chauluc[0]->id;
        redirect('tuychon/quocgia/ds/?ct='.$id);
    }
    
    function ds(){
        $ct = (int)$this->request->get['ct'];
        $edit = ($this->request->get['edit'] != '')?1:0;
        if($edit == 1){
            $id = $this->request->get['edit'];
            $data['r'] = $this->db->row("SELECT * FROM dc_country WHERE ct_id = '".$id."'");
        }
        $data['ct'] = $ct;
        $data['edit'] = $edit;
        $data['chauluc'] = $this->tuychon->get_all_chauluc();
        $data['title'] = "Danh sách quốc gia";
        //$data['add'] = 'tuychon/quocgia/add';
        $config['base_url'] = base_url().'tuychon/quocgia/ds';
        $config['total_rows']   =  $this->quocgia->get_num_quocgia($ct);
        $config['suffix'] = '/?ct='.$ct;
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->quocgia->get_all_quocgia($config['per_page'],segment(4,'int'),$ct);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('quocgia/ds',$data);
    }
    
    function save(){
        $id = $this->request->post['id'];
        $chauluc_id = $this->request->post['chauluc_id'];
        $name = $this->request->post['name'];
        $edit = $this->request->post['edit'];
        
        $vdata['ct_name'] = $name;
        if($edit == 0){
            $vdata['ct_id'] = $id;
            $vdata['ct_continent_id']  = $chauluc_id;
            if($this->db->insert('dc_country',$vdata)){
                $data['error'] = 0;
                $data['msg'] = "Mã quốc gia đã tồn tại";
            }else{
                $data['error'] = 1;
                $data['msg'] = "Mã quốc gia đã tồn tại";
            }
        }else{                                                         
            if($this->db->update('dc_country',$vdata,array('ct_id'=>$id))){
                $data['error'] = 0;
            }
        }
        $client = loadSoap($this->config->item('url_service_hotel'));
        $client->update_country($this->ip, $id,$name);
        
        $client1 = loadSoap($this->config->item('url_service_news'));
        $client1->update_country($this->ip, $id,$name);
        
        $data['url'] = site_url('tuychon/quocgia/ds/?ct='.$chauluc_id);
        echo json_encode($data);
    }
    
    function del(){
        $id = segment(4);
        $page = segment(5,'int');
        $ct = $this->request->get['ct'];
        $rs = $this->quocgia->get_quocgia($id);
        $ct_name = $rs->ct_name;
        $total = $this->tuychon->get_num_thanhpho($id);
        if($total > 0){
            $msg = "Vẫn còn Thành phố trong quốc gia: ".$ct_name.". Không thể xóa";
        }else{
            if($this->db->query("DELETE FROM dc_country WHERE ct_id = '$id'")){
                $client = loadSoap($this->config->item('url_service_hotel'));
                $client->del_country($this->ip, $id);
                
                $client1 = loadSoap($this->config->item('url_service_news'));
                $client1->del_country($this->ip, $id);
                $msg = "Xóa Quốc gia: ".$ct_name." thành công";
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tuychon/quocgia/ds/'.$page.'/?ct='.$ct);
    }
    
    function tinhthanh(){
        $id = $this->request->post['id'];
        $type = $this->request->post['type'];
        $list = $this->tuychon->get_all_quocgia($id);
        $linkall = site_url('tuychon/tinhthanh/ds/?co='.$id);
        $html = '';
        if($type == 'link'){
            $html .= '<option value="'.$linkall.'">Tất cả</option>';
        }
        foreach($list as $rs):
            if($type == 'link'){
                $link = site_url('tuychon/tinhthanh/ds/?co='.$id.'&ct='.$rs->ct_id);
            }else{
                $link = $rs->ct_id;
            }
            $html .='<option value="'.$link.'">'.$rs->ct_name.'</option>';
        endforeach;
        $data['html'] = $html;
        echo json_encode($data);
    }
    
    function write_quocgia(){
        $this->load->helper('file');
        $list = $this->quocgia->get_list_quocgia();
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $ar_id_vi = "";
        foreach($list as $rs):
            $ct_id = $rs->ct_id;
            $name = $rs->ct_name;
            $ar_id_vi .= "array('id'=>'$ct_id','name'=>'$name'),\n";
           
            
        endforeach;
        $ar_id_vi  = rtrim($ar_id_vi,',');

        
        $str .= "\n\$config['ar_country'] = array($ar_id_vi);"; 
        write_file(ROOT.'site/config/cache/config_country.php', $str);
    }
}
