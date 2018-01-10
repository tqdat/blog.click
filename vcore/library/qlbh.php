<?php
class qlbh{
    function __construct(){
        $this->App = get_instance();
    }
    
    function ma_nhapkho(){
        $scode = $this->App->config->item('code_nkho');
        $scode_length = $this->App->config->item('code_nkho_length');
        $row = $this->App->db->row("SELECT Code WHERE Scode = '$scode' ORDER BY NXKID DESC");
        $barcode_old = ($row_code)?$row_code->Code:'';
        return barcode($scode, $barcode_old, $scode_length);
    }
    
    function Get_Tonkho($kho_id, $sanpham_id){
        $nhap = $this->Get_NhapXuat_By_Pro($kho_id, $sanpham_id, array(10));
        $xuat = $this->Get_NhapXuat_By_Pro($kho_id, $sanpham_id, array(20));
        return $nhap - $xuat;
    }
    
    
    function Get_NhapXuat_By_Pro($kho_id, $sanpham_id ,$ar_id = array()){
        $result = $this->App->db->query("SELECT SUM(Soluong) AS Soluong FROM `nhapxuatct` WHERE `Sanpham_ID` = $sanpham_id AND `Kho_ID` = $kho_id AND LNX_ID IN ('".implode("','", $ar_id)."')"); 
        $row = $this->App->db->fetchRow($result);
        return $sum = (int)$row['Soluong'];
    }

}
