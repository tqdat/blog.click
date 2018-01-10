<?
if($_SESSION['user_id'] == '' || $_SESSION['group_id'] < 11){
    redirect();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
    <title>Quản trị hệ thống - Hệ thống website www.pgh.vn</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?=$this->_templates('html/meta')?>
</head>
<body id="body">
    <div id="bg_load"></div>
    <div id="loading">
        <span class="iconload"></span> Đang tải dữ liệu. Vui lòng đợi
    </div>
    <div id="header">
        <div id="title-admin">Administrator - Quản trị hệ thống</div>
        <div id="iconheader">
            <a href="<?=base_url_site()?>" target="_blank" title="Trang ngoài" id="site"></a>
            <a href="<?=site_url('acinfo')?>" title="Thông tin tài khoản" id="info-acount"></a>
            <a href="" id="setting"></a>
            <a href="<?=site_url('home/logout')?>" title="Thoát đăng nhập" id="logout"></a>
        </div>
    </div>
    <div id="content">
        <div id="colright">
            <div id="menutop"><?=$this->_templates('html/mod_menu')?></div>
            <div id="boxbutton">
                <div class="title"><h3><?=(isset($title))?$title:""?></h3></div>
                <?=$this->_templates('html/toolbar')?>
            </div>
            <div id="wrapper">
                <?if(isset($message) && $message !=''){ echo '<div class="show_notice" id="msg">'.$message.'<span class="del_smg"></span></div>';}?>
                <?if($this->session->get_flashdata('message')){
                    echo '<div class="show_success" id="msg">'.$this->session->get_flashdata('message').'<span class="del_smg"></span></div>';
                }if($this->session->get_flashdata('error')){
                    echo '<div class="show_error" id="msg">'.$this->session->get_flashdata('error').'<span class="del_smg"></span></div>';
                }if($this->session->get_flashdata('alert')){
                    echo '<div class="show_notice" id="msg">'.$this->session->get_flashdata('alert').'<span class="del_smg"></span></div>';
                }
                ?>
                <?=$this->view($page,$data)?>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div id="footer">
        <div>Developed by <a target="_blank" href="http://www.pgh.vn" title="Giải pháp Ứng dụng CNTT toàn diện cho Doanh nghiệp!"><b>Phan Gia Huy Co., Ltd.</b></a> - <span style="color: red; font-weight: bold;">Support: 0905 211 588 (Mr Long)</span></div>
    </div>
    <?=$this->session->unset_flashdata(array('message','error','alert'))?> 
</body>
</html>
