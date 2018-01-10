<div class="popup" id="pop-message">
    <div class="close" id="close_ajax"></div>
    <?=form_open(uri_string(),array('id'=>'form_sendmessage'))?>
    <div class="title">Gửi tin nhắn</div>
    <div class="pop-content" style="background: #FFF;">
        <?if($rs){?>
        <table class="form">
            <tr>
                <td class="label">Gửi tới</td>
                <td><b style="padding-top: 2px;float: left;"><?=$rs->shop_name?></b></td>
            </tr>
            <tr>
                <td class="label">Tiêu đề</td>
                <td><input type="text" name="title" id="subject" value="" style="width: 350px;"></td>
            </tr>
            <tr>
                <td class="label">Nội dung</td>
                <td><textarea style="width: 350px;" rows="4" name="content" id="content"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="" id="bt_sendmessge" class="bt_send"></td>
            </tr>
        </table>
        <?}else{?>
            <p align="center">Xin lôi. Shop không có trong hệ thống</p>
        <?}?>
    </div>
    <?=form_close()?>
</div>