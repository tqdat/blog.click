<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Đơn đặt thuê xe du lịch</h2>
<div style="border-bottom: 1px dashed #d1d1d1; height: 10px; margin-bottom: 10px;"></div>
<table width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px;font-family: arial;">
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Họ và tên:</td>
        <td valign="top"><?=$info_mail->fullname?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Địa chỉ:</td>
        <td valign="top"><?=$info_mail->address?></td>
    </tr>
	<tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Số điện thoại:</td>
        <td valign="top"><?=$info_mail->phone?></td>
    </tr>
	<tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Ngày đi:</td>
        <td valign="top"><?=$info_mail->notes?></td>
    </tr>
	<tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Ngày về:</td>
        <td valign="top"><?=$info_mail->ngaydi?></td>
    </tr>
	<tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Ghi chú:</td>
        <td valign="top"><?=$info_mail->ngayve?></td>
    </tr>
</table>