<script type="text/javascript" src="<?=base_url_site()?>templates/js/core/jquery.ui.core.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url_site()?>templates/js/core/jquery.ui.datepicker.js" charset="UTF-8"></script>
<link type="text/css" rel="stylesheet" href="<?=base_url_site()?>templates/css/jquery-ui.css" media="screen" />
<script type="text/javascript">
    $(function() {
        var dates = $( "#bhtn_date_begin, #bhtn_date_end" ).datepicker({
            changeMonth: true,
            dateFormat: 'dd-mm-yy', 
            numberOfMonths: 1,
            onSelect: function( selectedDate ) {
                var option = this.id == "bhtn_date_begin" ? "minDate" : "maxDate",
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
<?=form_open('booking/search')?>
<fieldset>
    <legend>Tìm kiếm</legend>
    <input type="hidden" name="page" value="<?php echo $page?>">
    <table class="tuychon" style="width: 100%;">
        <tr>
            <td class="label" width="150px">Mã Tour:</td>
            <td><input type="text" value="<?=$get['key']?>" name="key" style="width: 290px;"></td>
        </tr>
        <tr>
            <td class="label">Từ ngày:</td>
            <td><input type="text" id="bhtn_date_begin" name="date_begin" value="<?=$get['begin']?>" style="width: 100px;">
            <b style="padding-left: 20px;">Đến ngày:</b>
            <input type="text" id="bhtn_date_end" name="date_end" value="<?=$get['end']?>" style="width: 100px;"></td>
        </tr>
        <tr>
            <td class="label">Trạng thái đơn hàng:</td>
            <td>
                <select name="trangthai_donhang" style="width: 200px;">
                    <option value="0" <?=($get['status'] == 0)?'selected="selected"':''?>>Chưa xác nhận</option>
                    <option value="1" <?=($get['status'] == 1)?'selected="selected"':''?>>Đã xác nhận</option>
                    <option value="2" <?=($get['status'] == 2)?'selected="selected"':''?>>Thành công</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">Trạng thái thanh toán:</td>
            <td>
                <select name="trangthai_thanhtoan" style="width: 200px;">
                    <option value="0" <?=($get['pay'] == 0)?'selected="selected"':''?>>Chưa thanh toán</option>
                    <option value="1" <?=($get['pay'] == 1)?'selected="selected"':''?>>Đã thanh toán</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Tìm kiếm">
                <input type="button" value="Làm lại" onclick="go_search_reset()">
            </td>
        </tr>
    </table>
</fieldset>
<?=form_close()?>
<?php echo form_open('booking/dels',  array('id' => 'admindata'));?> 
<?
$page = (int)$this->uri->segment(3);
$url = 'booking/ds/';
$link = '/'.$page.'/'.$str_suff;
?>

<style type="text/css">
.tuychon td{
    padding: 5px;
}
.tuychon td.label{
    font-weight: bold;
    text-align: right;
}
</style>
<script type="text/javascript">
    function go_search(){ 
        var key = $("#key").val();
        window.location.href = base_url + "<?php echo $url?>?key=" + key+'<?=($catid != 0)?'&catid='.$catid:''?>';
    }
    function go_search_reset(){ 
        window.location.href = '<?=site_url($url)?>';
    }    
</script>

<table class="admindata">
    <thead>
        <tr class="pagination">
            <th colspan="10">
                Hiện có <?php echo $num?> Booking <span class="pages"><?php echo $pagination?></span>
            </th>
        </tr>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th style="width: 130px;">Mã đặt Tour</th>
            <th>Tên khách hàng</th>
            <th style="width: 70px;">Người lớn</th>
            <th style="width: 70px;">Trẻ em</th>
            <th style="width: 70px;">Trẻ nhỏ</th>
            <th style="width: 100px;">Tổng</th>
            <th style="width: 100px;">Trang thái</th>
            <th style="width: 120px;">Ngày khởi hành</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=1;
    foreach($list as $rs):
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->booking_id?>"></td>
        <td><a href="<?=site_url('booking/edit/'.$rs->id.$link)?>"><?=$rs->code?></a></td>
        <td><?=$rs->fullname?></td>
        <td><?=$rs->nguoilon?></td>
        <td><?=$rs->treem?></td>
        <td><?=$rs->embe?></td>
        <td align="right"><b><?=number_format($rs->total,0,'.','.')?></b> vnd</td>
        <td>
            <?
            if($rs->order_status == 0){
                echo "Chưa xác nhận";
            }else if($rs->order_status == 1){
                echo 'Đã xác nhận';
            }else{
                echo 'Thành công';
            }
            ?>
        </td>
        <td><?=date('d/m/Y',$rs->date_to)?></td>
        <td align="center">
            <?php echo icon_edit('booking/edit/'.$rs->id.$link)?>
            <?php 
                echo icon_del('booking/del/'.$rs->id.$link);
            ?> 
        </td>
    </tr>       
    <?php
    $k=1-$k;
    endforeach;
    ?>
    <tfoot>
        <td colspan="10">
            Hiện có <?php echo $num?> Booking <span class="pages"><?php echo $pagination?></span>
        </td>
    </tfoot>    
</table>
<?php echo form_close()?>