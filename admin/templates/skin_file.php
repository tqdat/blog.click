<?
if($_SESSION['user_id'] == '' || $_SESSION['group_id'] < 11){
    redirect();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
    <title>Quản trị hệ thống</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?=$this->_templates('html/meta_file')?>
    <script type="text/javascript">
    $(document).ready(function() {
          $("#colleft").css({
              'height': $("#colright").height()
          });
    });
    </script>
</head>
<body id="body">
    <div id="bg_load"></div>
    <div id="loading">
        <span class="iconload"></span> Đang tải dữ liệu. Vui lòng đợi
    </div>
    <div id="header">
        <div id="title-admin"></div>
        <div id="iconheader">
            <a href="<?=base_url_site()?>" target="_blank" title="Trang ngoài" id="site"></a>
            <a href="<?=site_url('acinfo')?>" title="Thông tin tài khoản" id="info-acount"></a>
            <a href="" id="setting"></a>
            <a href="<?=site_url('home/logout')?>" title="Thoát đăng nhập" id="logout"></a>
        </div>
    </div>
    <div id="content">
        <div id="colleft"><?=$this->_templates('html/mod_menuleft')?></div>
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
        <div>Hệ thống quản trị website. Version 4.0 - Phát triển bởi: <b>Phan Gia Huy</b></div>
        <div>Thời gian nạp trang <?php echo timer_stop();?> giây</div>
    </div>
    <?=$this->session->unset_flashdata(array('message','error','alert'))?> 
</body>
</html>
