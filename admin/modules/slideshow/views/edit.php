<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="table_" style="width: 100%;">
    <tr>
        <td valign="top" style="padding-right: 10px;">
            <table class="form">
                <tr>
                    <td class="label" style="width: 150px;">Tên ảnh</td>
                    <td><input type="text" name="vdata[ten]" value="<?php echo $rs->ten?>" style="width: 99%;"></td>
                </tr>
                <tr>
                    <td class="label">Links</td>
                    <td><input type="text" name="vdata[links]" value="<?php echo $rs->links?>" style="width: 99%;"></td>
                </tr>
                <tr>
                    <td class="label">Hiển thị tên slide</td>
                    <td>
                        <input type="radio" name="vdata[show_title]" value="1" <?php echo ($rs->show_title == 1)?'checked="checked"':'';?>>Có
                        <input type="radio" name="vdata[show_title]" value="0" <?php echo ($rs->show_title == 0)?'checked="checked"':'';?>> Không 
                    </td>
                </tr>
        </table>
    </td>
    <td style="width: 300px;" valign="top">
        <fieldset class="content-right">
            <legend>Thêm ảnh kích thước 990*300 px</legend>
                 <div class="img-news">
                    <?if($rs->images != ''){?>
                    <img src="<?=base_url_site().'data/sl/'.$rs->images?>" alt="">
                    <?}else{?>
                    <img src="<?=base_url()?>templates/images/img_news_no.png" alt="">
                    <?}?>
                 </div>
                 <div align="center"><input type="checkbox" value="1" name="del">Xóa hình</div>
                 <div align="center"><input type="file" name="userfile"></div>
        </fieldset>
        </td>
    </tr>
</table>