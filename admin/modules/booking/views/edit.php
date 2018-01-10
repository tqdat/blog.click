<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<div class="block" style="width: 400px; margin-right: 10px;">
    <div class="ds">
        <h1>Thông tin khách hàng</h1>
        <table cellpadding="0" cellspacing="0" class="info">
            <tr>
                <td class="label" style="width: 100px;">Họ tên: </td>
                <td><?=$rs->fullname?></td>
            </tr>
            <tr>
                <td class="label">Địa chỉ: </td>
                <td><?=$rs->address?></td>
            </tr>
            <tr>
                <td class="label">Điện thoại: </td>
                <td><?=$rs->phone?></td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td><?=$rs->email?></td>
            </tr>
            <tr>
                <td class="label">Điểm đón</td>
                <td><?=$rs->diemdon?></td>
            </tr>
            <tr>
                <td class="label">Ghi chú</td>
                <td><?=$rs->notes?></td>
            </tr>
        </table>
    </div>
</div>
<div class="block" style="width: 400px; margin-right: 10px;">
    <div class="ds">
        <h1>Trạng thái</h1>
        <table cellpadding="0" cellspacing="0" class="info">
            <tr>
                <td class="label" style="width: 100px;">Đơn hàng: </td>
                <td>
                    <select name="order_status" style="width: 150px;">
                        <option value="0" <?=($rs->order_status == 0)?'selected="selected"':''?>>Chưa xác nhận</option>
                        <option value="1" <?=($rs->order_status == 1)?'selected="selected"':''?>>Đã xác nhận</option>
                        <option value="2" <?=($rs->order_status == 2)?'selected="selected"':''?>>Thành công</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">Thanh toán: </td>
                <td>
                    <select name="pay_status" style="width: 150px;">
                        <option value="0" <?=($rs->pay_status == 0)?'selected="selected"':''?>>Chưa thanh toán</option>
                        <option value="1" <?=($rs->pay_status == 1)?'selected="selected"':''?>>Đã thanh toán</option>
                    </select>                
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="block" style="width: 600px; margin-right: 10px;">
    <div class="ds">
        <h1>Thông tin Book</h1>
        <table cellpadding="0" cellspacing="0" class="info">
            <tr>
                <td class="label" style="width: 140px;">Tour: </td>
                <td><a href="<?=base_url_site().$tour->id.'-'.$tour->slug?>.html" target="_blank" style="color: #FF0000;"><?=$tour->title?></a></td>
            </tr>
            <tr>
                <td class="label">Ngày khởi hành: </td>
                <td style="font-size: 15px;color: #FF0000;font-weight: bold;"><?=date('d/m/Y',$rs->date_to)?></td>
            </tr>
            <tr>
                <td class="label">Ngày đặt Tour: </td>
                <td><?=date('d/m/Y',$rs->date_add)?></td>
            </tr>
            <tr>
                <td class="label">Người lớn:</td>
                <td>
                    <p><?=$rs->nguoilon?></p>
                    <?if($rs->nguoilon > 0){?>
                    <?
                    $listnl = $this->booking->getBookDetail($rs->id, 1);
                    ?>
                    <?
                    $i = 1;
                    foreach($listnl as $val):?>
                    <p><b><?=$i?>: </b><?=$val->fullname?> | <?=$val->birthday?></p>
                    <?
                    $i++;
                    endforeach;?>
                    <?}?>
                </td>
            </tr>
            <tr>
                <td class="label">Trẻ em:</td>
                <td>
                    <p><?=$rs->treem?></p>
                    <?if($rs->treem > 0){?>
                    <?
                    $listnl = $this->booking->getBookDetail($rs->id, 2);
                    ?>
                    <?
                    $i = 1;
                    foreach($listnl as $val):?>
                    <p><b><?=$i?>: </b><?=$val->fullname?> | <?=$val->birthday?></p>
                    <?
                    $i++;
                    endforeach;?>
                    <?}?>                    
                </td>
            </tr>
            <tr>
                <td class="label">Em bé:</td>
                <td>
                    <p><?=$rs->embe?></p>
                    <?if($rs->embe > 0){?>
                    <?
                    $listnl = $this->booking->getBookDetail($rs->id, 3);
                    ?>
                    <?
                    $i = 1;
                    foreach($listnl as $val):?>
                    <p><b><?=$i?>: </b><?=$val->fullname?> | <?=$val->birthday?></p>
                    <?
                    $i++;
                    endforeach;?>
                    <?}?>
                </td>
            </tr>
            <tr>
                <td class="label">Tổng tiền: </td>
                <td style="font-size: 17px;color: #FF0000;font-weight: bold;"><?=number_format($rs->total,0,'.','.')?></td>
            </tr>
            <tr>
                <td class="label">Thanh toán</td>
                <td>
                    <?if($rs->payment == 'VP'){ echo 'Thanh toán tại Văn phòng Công ty';}else{ echo 'Thanh toán qua hình thức chuyển khoản';}?>
                </td>
            </tr>
        </table>
    </div>
</div>
<p>Ghi chú</p>
<p><?=vnit_editor($rs->ghichu,'ghichu','_tongquan')?></p>


<?=form_close()?>
<style type="text/css">
.block{
    border: 1px solid #CCC;
    margin-bottom: 10px;
}
.ds{
    border: 1px solid #FFF;
    background: #f2f2f2;
    padding: 5px;
}
.ds h1{
    font-size: 15px;
    padding: 5px 5px;
}
.info{
    width: 100%;
}
.info td{
    padding: 5px;
}
.info td.label{
    font-weight: bold;
    text-align: right;
}
</style>