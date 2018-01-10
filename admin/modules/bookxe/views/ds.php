<script type="text/javascript" src="<?=base_url_site()?>templates/js/core/jquery.ui.core.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url_site()?>templates/js/core/jquery.ui.datepicker.js" charset="UTF-8"></script>
<link type="text/css" rel="stylesheet" href="<?=base_url_site()?>templates/css/jquery-ui.css" media="screen" />
<table class="admindata">
    <thead>
        <tr>
            <th class="checked"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
            <th style="width: 20px;">STT</th>
            <th>Tên khách hàng</th>
            <th style="width: 200px;">Địa chỉ</th>
            <th style="width: 70px;">Email</th>
            <th style="width: 70px;">Số điện thoại</th>
            <th style="width: 200px;">Ngày đi - Ngày về</th>
            <th style="width: 100px;">ID thuê xe</th>
            <th style="width: 120px;">Nội dung</th>
            <th class="fc">Chức năng</th>
        </tr>        
    </thead>
    <?
    $k=0;
    foreach($list as $rs):
	$k = $k+1;
    ?>
    <tr class="row<?=$k?>">
        <td align="center"><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->booking_id?>"></td>
        <td><?=$k?></td>
        <td><?=$rs->fullname?></td>
        <td><?=$rs->address?></td>
        <td><?=$rs->email?></td>
        <td><?=$rs->phone?></td>
        <td><?=$rs->ngaydi?> đến <?=$rs->ngayve?></td>
		<td align="center"><a href="<?=site_url('thuexe/edit/'.$rs->thuexe_id)?>"><?=$rs->thuexe_id?></a></td>
		<td><?=$rs->notes?></td>
        <td align="center">
            <?php 
                echo icon_del('bookxe/del/'.$rs->id.$link);
            ?> 
        </td>
    </tr>       
    <?php
    endforeach;
    ?>   
</table>