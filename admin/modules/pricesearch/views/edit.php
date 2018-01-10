<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Giá tìm kiếm</td>
        <td>
            <input type="text" name="vdata[price]" value="<?=$rs->price?>" class="w300">
        </td>
    </tr>
</table>
<?php echo form_close();?>
