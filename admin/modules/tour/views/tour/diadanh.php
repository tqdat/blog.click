<table class="admindata">
    <?foreach($list as $rs):?>
    <tr>
        <td style="width: 30px;font-weight: bold"><a class="choice_local" href="javascript:;" local_id="<?=$rs->local_id?>" local_name="<?=$rs->title?>">Chọn</a></td>
        <td><img src="<?=base_url_site()?>data/localtion/100/<?=$rs->images?>" alt=""></td>
        <td><?=$rs->title?></td>
    </tr>
    <?endforeach;?>
</table>
<div class="pages" style="padding: 10px 0px;"><?=$pagination?></div>
<script type="text/javascript">
function local(page_no){  
    load_show();   
    var city_id = <?=$city_id?>;
    $.post(base_url+"tour/get_local",{'page_no':page_no,'city_id':city_id},function(data){
        $("#list_local").html(data);                                            
        load_hide();
    });
}
</script>