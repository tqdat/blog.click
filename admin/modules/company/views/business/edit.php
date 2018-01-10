<?=form_open(uri_string(),array('id'=>'admindata'))?>
<input type="hidden" name="id" value="<?=$rs->id?>">
<input type="hidden" name="page" value="<?=$this->uri->segment(5)?>">
<table class="form">
    <tr>
        <td class="label required" style="width: 130px;">Tên doanh nghiệp (Vi)</td>
        <td><input type="text" name="vdata[name]" value="<?=$rs->name?>" class="w500"></td>
    </tr>
    <tr>
        <td class="label">Tên doanh nghiệp (En)</td>
        <td><input type="text" name="vdata[name_en]" value="<?=$rs->name_en?>" class="w500"></td>
    </tr>
    <tr>
        <td class="label">Doanh nghiệp nổi bật</td>
        <td><input type="checkbox" name="noibat" value="1" <?=($rs->noibat == 1)?'checked="checked"':'';?>></td>
    </tr>    
    <tr>
        <td class="label">Người đại diện</td>
        <td><input type="text" name="vdata[owner]" value="<?=$rs->owner?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Lĩnh vực hoạt động</td>
        <td>
            <div class="item-row">
                <div class="item">
                    <select name="vdata[catid1]" id="maincat" size="10" style="width: 200px;">
                        <option value="0">Chọn lĩnh vực cấp 1</option>
                        <?foreach($maincat as $val):?>
                        <option value="<?=$val->catid?>" <?=($val->catid == $rs->catid1)?'selected="selected"':''?>><?=$val->catname?></option>
                        <?endforeach;?>
                    </select>
                </div>
                <div class="item">
                    <select name="vdata[catid2]" id="subcat" size="10" style="width: 200px;">
                        <option value="0">Chọn lĩnh vực cấp 2</option> 
                        <?foreach($subcat as $val):?>
                        <option value="<?=$val->catid?>" <?=($val->catid == $rs->catid2)?'selected="selected"':''?>><?=$val->catname?></option>
                        <?endforeach;?>
                    </select>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="label">Mã số thuế</td>
        <td><input type="text" name="vdata[masothue]" value="<?=$rs->masothue?>" class="w200"></td>
    </tr>
    <tr>
        <td class="label">Địa chỉ</td>
        <td>
            <input type="text" name="vdata[address]" value="<?=$rs->address?>" class="w500">
            <div class="item-row" style="margin-top: 5px;">
                <div class="item">
                    <select name="vdata[city]" style="width: 200px;">
                        <option value="1">TP. Đà Nẵng</option>
                    </select>
                </div>
                <div class="item">
                    <select name="vdata[district]" style="width: 200px;">
                        <?foreach($district as $val):?>
                        <option value="<?=$val->city_id?>" <?=($rs->district == $val->city_id)?'selected="selected"':'';?>><?=$val->city_name?></option>
                        <?endforeach;?>
                    </select>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="label">Điện thoại bàn</td>
        <td><input type="text" name="vdata[phone]" value="<?=$rs->phone?>" class="w200"></td>
    </tr>
    <tr>
        <td class="label">Di động</td>
        <td><input type="text" name="vdata[mobile]" value="<?=$rs->mobile?>" class="w200"></td>
    </tr>
    <tr>
        <td class="label">Fax</td>
        <td><input type="text" name="vdata[fax]" value="<?=$rs->fax?>" class="w200"></td>
    </tr>
    <tr>
        <td class="label">Email</td>
        <td><input type="text" name="vdata[email]" value="<?=$rs->email?>" class="w200"></td>
    </tr>
    <tr>
        <td class="label">Website</td>
        <td><input type="text" name="vdata[website]" value="<?=$rs->website?>" class="w200"></td>
    </tr>
    <tr>
        <td colspan="2">
            <p>Giới thiệu</p>
            <?=vnit_editor($rs->content,'content','full')?>
        </td>
    </tr>
</table>

<?=form_close()?>
<style>
.item-row{
    overflow: hidden;
}
.item-row .item{
    float: left;
    margin-right: 10px;
}
</style>
<script type="text/javascript">
$(document).ready(function() { 
    $("#maincat").change(function(){
        catid = $(this).val();
        $.getJSON(base_url + 'company/business/maincat/?catid='+ catid, function(data){
            $("#subcat").html(data.ds);
        });
    });
});
</script>