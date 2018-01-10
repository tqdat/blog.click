<?php
class search extends vnit{
    function __construct(){
        parent::__construct();
      }
	 
	function tour(){
		$data['title'] = "Tìm kiếm Tour Du lịch";
		if(isset($_GET['submit'])){
			$keywords = $this->request->get['keywords'];
			$khoihanh = $this->request->get['khoihanh'];
			$ngay = $this->request->get['ngay'];
			$price_search = $this->request->get['price_search'];
			$sql = "SELECT * FROM tour WHERE published = '1' ";
			if ($khoihanh) {
			  	 $sql.= " AND ketthuc = $khoihanh ";
			  }
			if ($ngay) {
			  	 $sql.= " AND ngay = $ngay ";
			  }
		    if ($price_search) {
			  	 $sql.= " AND price_search = '$price_search'";
			  }
			if ($keywords) {
			  	 $sql.= "  AND (title LIKE '%$keywords%' OR code LIKE '%$keywords%') ";
			  }
			//var_dump($sql); die();
			$data['search'] = $this->db->result($sql);
			$this->load->templates('index',$data);
		}
		else {
			redirect();
		}
	}
}
