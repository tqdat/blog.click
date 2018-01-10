<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;"> Đánh giá Tour: </td>
        <td><b><?=$this->tourcomment->get_tour($rs->tour_id)->title;?></b></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Họ và Tên</td>
        <td>
            <input type="text" name="vdata[fullname]" value="<?php echo $rs->fullname?>" class="w300">
        </td>
    </tr>
    <tr>
        <td class="label">Email</td>
        <td><input type="text" name="vdata[email]" value="<?=$rs->email?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Nội dung</td>
        <td><textarea style="width: 300px;" rows="2" name="vdata[content]"><?=$rs->content?></textarea></td>
    </tr>
    
    <tr>
        <td class="label" style="width: 150px;">Đánh giá</td>
        <td>
            <select id="star" name="vdata[star]" style="width: 90px; padding: 3px;">
                <option value="5" <?php echo ($rs->star==5) ? " selected = 'selected'" : "";?>>5 Sao</option>
                <option value="4" <?php echo ($rs->star==4) ? " selected = 'selected'" : "";?>>4 Sao</option>
                <option value="3" <?php echo ($rs->star==3) ? " selected = 'selected'" : "";?>>3 Sao</option>
                <option value="2" <?php echo ($rs->star==2) ? " selected = 'selected'" : "";?>>2 Sao</option>
                <option value="1" <?php echo ($rs->star==1) ? " selected = 'selected'" : "";?>>1 Sao</option>
            </select>
            <input type="hidden" name="vdata[tour_id]" value="<?=$rs->tour_id?>">
        </td>
    </tr>
    <tr>
        <td class="label">Hiển thị</td>
        <td>
            <input type="radio" name="vdata[published]" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'checked="checked"';?>>Có
            <input type="radio" name="vdata[published]" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>> Không 
        </td>
    </tr> 
</table>
<?php echo form_close();?>