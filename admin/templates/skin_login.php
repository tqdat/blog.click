<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SYSTEM MANAGER</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>templates/css/imos_login.css">
</head>
<body>
    <?
    if($_SESSION['user_id'] && $_SESSION['group_id'] > 11){
        redirect('cpanel');
    }
    ?>
    <div id="bound-login">
        <div id="login-form">
            <div id="login-top">
                <div class="logo"><img src="<?=base_url()?>templates/images/logo.png" alt="DANANGXANH"></div>
            </div>
            <div id="login-imos">
                <div class="login-content">
                    <?=$this->view($page,$data)?>

                    <div class="footer">Design www.phangiahuy.com</div>
                </div>
            </div>
        </div>
    </div>
    <?=$this->session->unset_flashdata(array('message','error','alert'))?>    
</body>
</html>