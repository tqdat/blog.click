<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table class="form">
    <?
    $i = 1;
    $top_tour_ = $this->config->item('top_tour');
    $top_tour = explode(',',$top_tour_);
    foreach($top_tour as $val):
    ?>
    <tr>
        <td class="label" style="width: 80px;">ID Tour <?=$i?></td>
        <td><input type="text" name="id_tour[]" value="<?=$val?>"></td>
    </tr>
    <?
    $i++;
    endforeach;?>
</table>
<?php echo form_close();?>