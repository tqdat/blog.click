<script type="text/javascript" src="<?=base_url()?>templates/js/core/jquery.ui.core.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/core/jquery.ui.datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/core/jquery.ui.widget.js" charset="UTF-8"></script>
<link type="text/css" rel="stylesheet" href="<?=base_url()?>templates/css/jquery-ui.css?v=2.0" media="screen" />
<link type="text/css" rel="stylesheet" href="<?=base_url()?>templates/css/datepicker.css?v=2.0" media="screen" />
<link type="text/css" rel="stylesheet" href="<?=base_url()?>templates/css/datetheme.css?v=2.0" media="screen" />
<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="id" value="<?=$rs->id?>">
<table class="form">
    <tr>
        <td class="label" style="width: 150px;">Tên quảng cáo</td>
        <td><input type="text" name="vdata[name]" value="<?php echo $rs->name?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label">Hình ảnh</td>
        <td><input type="file" name="userfile"> (190px)</td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Link</td>
        <td><input type="text" name="vdata[link]" value="<?php echo $rs->link?>" class="w300"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Sắp xếp</td>
        <td><input type="text" name="vdata[ordering]" value="<?php echo $rs->ordering?>" class="w100"></td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Ngày bắt đầu</td>
        <td>
            <select name="begin_h">
                <?
                
                for($i = 0; $i <= 23; $i++ ){?>
                <option value="<?=$i?>" <?=($i == date('H',$rs->date_begin))?'selected="selected"':''?>><?=$i?> h</option>
                <?}?>
            </select>
            <select name="begin_i">
                <?for($i = 0; $i <= 59; $i++ ){?>
                <option value="<?=$i?>" <?=($i == date('i',$rs->date_begin))?'selected="selected"':''?>><?=$i?></option>
                <?}?>
            </select>
            <input type="text" name="begin" id="date_begin" value="<?php echo date('d-m-Y',$rs->date_begin)?>" class="w100">
        </td>
    </tr>
    <tr>
        <td class="label" style="width: 150px;">Ngày kết thúc</td>
        <td>
            <select name="end_h">
                <?for($i = 0; $i <= 23; $i++ ){?>
                <option value="<?=$i?>" <?=($i == date('H',$rs->date_end))?'selected="selected"':''?>><?=$i?> h</option>
                <?}?>
            </select>
            <select name="end_i">
                <?for($i = 0; $i <= 59; $i++ ){?>
                <option value="<?=$i?>" <?=($i == date('i',$rs->date_end))?'selected="selected"':''?>><?=$i?></option>
                <?}?>
            </select>
            <input type="text" name="end" id="date_end" value="<?php echo date('d-m-Y',$rs->date_end)?>" class="w100">
        </td>
    </tr>
</table>
<?php echo form_close();?>
<script type="text/javascript">
    $(function() {
        var dates = $( "#date_begin, #date_end" ).datepicker({
            changeMonth: true,
            dateFormat: 'dd-mm-yy', 
            numberOfMonths: 1,
            onSelect: function( selectedDate ) {
                var option = this.id == "date_begin" ? "minDate" : "maxDate",
                    instance = $( this ).data( "datepicker" );
                    date = $.datepicker.parseDate(
                        instance.settings.dateFormat ||
                        $.datepicker._defaults.dateFormat,
                        selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
    });
</script>