<?php
class api extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('api_model','api');
    }
    
    // Tuy chinh hien thi trang thai cua ban ghi 
    function publish(){
      $status = $_POST['status'];
      $id = $_POST['id'];
      $field = $_POST['field'];
      $table = $_POST['table'];
      if($status == 0){
          $pub = 1;
      }else{
          $pub = 0;
      }
      $vdata['published'] = $pub;
      $this->db->update($table, $vdata, array($field => $id));

      echo icon_active("'$table'","'$field'",$id,$pub);
    }
    
    function get_local(){
        $address = $this->request->post['address'];
        $city_id = $this->request->post['city_id'];
        $district_id = $this->request->post['district_id'];
        $local = $address;
        $row = $this->api->get_city($district_id);
        if($row){
            $local .=", ".$row->city_name;
        }
        $row1 = $this->api->get_city($district_id);
        if($row1){
            $local .=", ".$row1->city_name;
        }
        $data['local'] = $local;
        echo json_encode($data);
    }
}
