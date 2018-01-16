<?
if($_SESSION['user_id'] == '' || $_SESSION['group_id'] < 11){
    redirect();
}
?>
<!DOCTYPE html> 
<html>
<head>
    <title>Quản trị hệ thống - Hệ thống website www.pgh.vn</title> 
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> 
    <meta charset="UTF-8">
    <?=$this->_templates('html/meta')?>
</head>
<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url()?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">.*.</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Hệ thống</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url() ?>templates/dest/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?= $rs->fullname?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url() ?>templates/dest/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= $rs->fullname?>
                                        <small><?= $rs->birthday?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=site_url('acinfo')?>" title="Thông tin tài khoản" id="info-acount">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=site_url('home/logout')?>" title="Thoát đăng nhập" id="logout">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Header -->
        <!-- Sidebar -->
        <aside class="main-sidebar">
            <?=$this->_templates('html/mod_menu')?>
        </aside>
        <!-- Sidebar -->
        <!-- Content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="title"><h3><?=(isset($title))?$title:""?></h3></div>
                <div><?=$this->_templates('html/toolbar')?></div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="hello">
                    <?if(isset($message) && $message !=''){ echo '<div class="show_notice" id="msg">'.$message.'<span class="del_smg"></span></div>';}?>
                    <?
                    if($this->session->get_flashdata('message')){
                        echo '<div class="alert alert-success" id="msg">'.$this->session->get_flashdata('message').'<span class="del_smg"></span></div>';
                    }if($this->session->get_flashdata('error')){
                        echo '<div class="alert alert-danger" id="msg">'.$this->session->get_flashdata('error').'<span class="del_smg"></span></div>';
                    }if($this->session->get_flashdata('alert')){
                        echo '<div class="alert alert-success" id="msg">'.$this->session->get_flashdata('alert').'<span class="del_smg"></span></div>';
                    }
                    ?>
                </div><!-- /.row -->
                <?=$this->view($page,$data)?>
            </section>
            <!-- /.Main Content -->
        </div>
        <!-- Content -->
        <!-- Footer -->
        <footer class="main-footer">
            <div>Developed by <a target="_blank" href="http://www.pgh.vn" title="Giải pháp Ứng dụng CNTT toàn diện cho Doanh nghiệp!"><b>Phan Gia Huy Co., Ltd.</b></a> - <span style="color: red; font-weight: bold;">Support: 0905 211 588 (Mr Long)</span></div>
        </footer>
        <!-- Footer -->
        <?=$this->session->unset_flashdata(array('message','error','alert'))?> 
    </div>
</body>
</html>