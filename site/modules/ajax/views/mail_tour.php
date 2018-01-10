<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table style="font-size: 12px;font-family: Arial;" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2" style="font-size: 22px;font-weight: bold;text-align: center;padding: 10px;">Đơn hàng đặt Tour</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;font-size: 13px;font-weight: bold;padding: 0px">Mã đặt Tour: <span style="color: blue;"><?=$rs->code?></span></td>
    </tr>
</table>
<div style="border-bottom: 1px dashed #d1d1d1; height: 10px; margin-bottom: 10px;"></div>
<table width="100%" cellpadding="1" cellspacing="2" style="font-size: 12px;font-family: arial;">
    <tr>
        <td rowspan="7" width="160" valign="top">
            <img width="150" src="<?=base_url()?>data/tour/500/<?=$val->images?>" alt="">
        </td>
        <td width="110" style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Tour:</td>
        <td valign="top"><?=$val->title?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Mã Tour:</td>
        <td valign="top"><?=$val->code?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Thời gian:</td>
        <td valign="top"><?=$val->ngay?> ngày <?=($val->dem > 0)?', '.$val->dem.' đêm':''?></td>
    </tr>
    <?
    $di = $this->ajax->get_city_by_id($val->khoihanh);
    $ve = $this->ajax->get_city_by_id($val->ketthuc);
    ?>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Điểm khởi hành:</td>
        <td valign="top"><?=$di->city_name?></td>
    </tr>
    <?if($ve){?>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Điểm kết thúc:</td>
        <td valign="top"><?=$ve->city_name?></td>
    </tr>
    <?}?>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Phương tiện:</td>
        <td valign="top"><?=$val->vanchuyen?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;color: blue;padding: 2px 5px;" valign="top">Lịch trình:</td>
        <td valign="top"><?=$val->lichtrinh?></td>
    </tr>
</table>
<div style="font-family: Tahoma;font-weight: bold;font-size: 17px; border-bottom: 1px dashed #d1d1d1; padding: 5px 0px; margin-bottom: 10px;">Thông tin đặt Tour</div>
<table width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px;font-family: Arial;">
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Ngày khởi hành:</td>
        <td><?=date('d/m/Y',$rs->date_to)?></td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Tổng số khách:</td>
        <td>
            <?=$rs->nguoilon?> người lớn
            <?=($rs->treem > 0)?', '.$rs->treem.' trẻ em':''?>
            <?=($rs->embe > 0)?', '.$rs->embe.' em bé':''?>
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Tổng thanh toán:</td>
        <td><span style="font-size: 17px;font-weight: bold; color: #FF0000;"><?=number_format($rs->total,0,'.','.')?></span> vnđ</td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Thanh toán</td>
        <td>
            <?if($rs->payment == 'VP'){ echo 'Thanh toán tại Văn phòng';}else{ echo 'Thanh toán qua hình thức chuyển khoản';}?>
        </td>
    </tr>    
</table>
<div style="font-family: Tahoma;font-weight: bold;font-size: 17px; border-bottom: 1px dashed #d1d1d1; padding: 5px 0px; margin-bottom: 10px;">Thông tin khách hàng</div>
<table width="100%" cellpadding="0" cellspacing="0" style="font-size: 12px;font-family: Arial;">
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Họ tên:</td>
        <td><?=$rs->fullname?></td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Địa chỉ:</td>
        <td><?=$rs->address?></td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Điện thoại:</td>
        <td><?=$rs->phone?></td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120">Email:</td>
        <td><?=$rs->email?></td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120" valign="top">Điểm đón:</td>
        <td valign="top"><?=$rs->diemdon?></td>
    </tr>
    <tr>
        <td style="font-weight: bold; padding: 2px 5px;" width="120" valign="top">Ghi chú:</td>
        <td valign="top"><?=$rs->notes?></td>
    </tr>
</table>
<div style="font-family: Tahoma;font-weight: bold;font-size: 15px; border-bottom: 1px dashed #d1d1d1; padding: 5px 0px; margin-bottom: 10px;">Thông tin hỗ trợ thanh toán</div>
<div style="font-family: Tahoma;font-weight: bold;font-size: 12px; border-bottom: 1px dashed #d1d1d1; padding: 5px 0px; margin-bottom: 10px;">Trong Trường hợp quý khách lấy hóa đơn GTGT, vui lòng đóng thêm 10% thuế VAT và CK theo tài khoản sau:</div>
<table width="100%" cellpadding="2" border="1" cellspacing="0" style="font-size: 12px;font-family: Arial; border-color: #f8f8f8;">
				<tbody>
					<tr>
						<td style="width:25%; font-weight: bold;">
						Số tài khoản
						</td>
						<td style="width:40%; font-weight: bold;">
						Tên tài khoản
						</td>
						<td style="width:35%; font-weight: bold;">
						Tên ngân hàng
						</td>
					</tr>
					<tr>
						<td>
						0041 000 158 603
						</td>
						<td>
						Công ty TNHH MTV TUẤN NGUYỄN TRAVEL
						</td>
						<td>
						Vietcombank Đà Nẵng
						</td>
					</tr>
				</tbody>
</table>
<div style="font-family: Tahoma;font-weight: bold;font-size: 12px; border-bottom: 1px dashed #d1d1d1; padding: 5px 0px; margin-bottom: 10px;">Hoặc không lấy hóa đơn GTGT:</div>
<table  width="100%" border="1" cellpadding="2" cellspacing="0" style="font-size: 12px;font-family: Arial; border-color: #f8f8f8;">
				<tbody>
					<tr>
						<td style="width:25%; font-weight: bold;">
						Số tài khoản
						</td>
						<td style="width:40%; font-weight: bold;">
						Tên tài khoản
						</td>
						<td style="width:35%; font-weight: bold;">
						Tên ngân hàng
						</td>
					</tr>
					<tr>
						<td>
						0041 000 158 604
						</td>
						<td>Nguyễn Thị Phương Thu</td>
						<td>
						Vietcombank Đà Nẵng
						</td>
					</tr>
					<tr>
						<td>711AC8919865</td>
						<td>
							Nguyễn Thị Phương Thu</td>
						<td>
						Viettinbank Đà Nẵng
						</td>
					</tr>
					<tr>
						<td>
						5601 0000 8873 57
						</td>
						<td>
						Nguyễn Thị Phương Thu
						</td>
						<td>
						BIDV Đà Nẵng
						</td>
					</tr>
					<tr>
						<td>
						1903 0184 1400 11
						</td>
						<td>
						Nguyễn Thị Phương Thu
						</td>
						<td>
						Techcombank Đà Nẵng
						</td>
					</tr>
					<tr>
						<td>
						9704 3206 1008 4081
						</td>
						<td>
						Nguyễn Thị Phương Thu
						</td>
						<td>
						VP BANK Hà Nội
						</td>
					</tr>
					<tr>
						<td>
						2011 206 015 434
						</td>
						<td>
						Nguyễn Thị Phương Thu
						</td>
						<td>
						Agribank Đà Nẵng
						</td>
					</tr>
					<tr>
						<td>
						0400 5334 0506
						</td>
						<td>
						Nguyễn Thị Phương Thu
						</td>
						<td>
						Sacombank Đà Nẵng
						</td>
					</tr>
					<tr>
						<td>
						010 8382 810
						</td>
						<td>
						Nguyễn Thị Phương Thu
						</td>
						<td>
						Đông Á Bank Đà Nẵng
						</td>
					</tr>
				</tbody>
</table>

<div style="font-size: 13px;font-family: Tahoma;text-align: center; margin-bottom: 10px 0px;">Xin cảm ơn quý khách hàng đã đặt Tour tại công ty chúng tôi!</div>
<div style="background: #f2f2f2; padding: 10px; margin-top: 10px;">

</div>