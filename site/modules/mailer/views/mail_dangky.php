<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background: #f2f2f2;padding: 10px;margin: 0px;font-family: Arial;font-size: 12px;">

<div style="width: 500px; margin: 0 auto; background: #f2f2f2; border-radius: 10px 10px 10px 10px">
    <div style="overflow: hidden; background: #f5a220; border-radius: 5px 5px 0px 0px;text-align: center;">
        <h1 style="font-size: 14px; padding: 5px;text-transform: uppercase;">Thông tin đăng ký tài khoản</h1>
    </div>
    <div style="padding: 20px 10px;background: #FFF; border-bottom: 1px solid #CCC;">
        <table cellpadding="2" cellspacing="2">
            <tr>
                <td colspan="2">
                    <div  style="background: #a4f59e; padding: 5px;border-radius: 5px 5px 5px 5px; margin-bottom: 10px;">Tài khoản của quý khách tại geckotrip.com đã được đăng ký thành công. Chúng tôi gửi thông tin đăng ký qua Email cho quý khách</div>
                </td>
            </tr>
            <tr>
                <td style="width: 100px;">Họ và tên</td>
                <td><?=$rs->fullname?></td>
            </tr>
            <tr>
                <td>Ngày sinh</td>
                <td><?=date('d/m/Y',$rs->birthday)?></td>
            </tr>
            <tr>
                <td>Giới tính</td>
                <td>
                <?
                if($rs->male == 1){
                    echo 'Nam';
                }else if($rs->male == 2){
                    echo 'Khác';
                }else{
                    echo 'Nữ';
                }
                ?>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?=$rs->email?></td>
            </tr>
            <tr>
                <td>Loại tài khoản</td>
                <td><?=$rs->group_name?></td>
            </tr>
        </table>
    </div>
    <div style="background: none repeat scroll 0 0 #333333;border-radius: 0 0 5px 5px;color: #FFFFFF;padding: 10px;text-align: center;">
        <a href="http://geckotrip.com" target="_blank" style="color: #FFF;text-decoration: none;">geckotrip.com</a>
    </div>
</div>
</body>
</html>
