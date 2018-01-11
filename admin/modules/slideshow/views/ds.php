<?php echo form_open('slideshow/dels',  array('id' => 'admindata'));?> 
<input type="hidden" name="page" value="<?php echo set_post_page()?>">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr class="pagination"> 
                            <th>
                                Hiện có <?php echo $num?> ảnh slide <span class="pages"><?php echo $pagination?></span>
                            </th>
                        </tr>
                        <tr>
                            <th class="checked" style="text-align: center;"><input type="checkbox" name="sa" id="sa" onclick="check_chose('sa', 'ar_id[]', 'admindata')"></th>
                            <th class="id">ID</th>
                            <th>Tên ảnh</th>
                            <th>Links</th>
                            <th>Ảnh</th>
                            <th>Sắp xếp <?php echo action_order()?></th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <?
                    $k=1;
                    foreach($list as $rs):
                        ?>
                        <tr class="row<?=$k?>">
                            <td><input  type="checkbox" name="ar_id[]" value="<?php echo $rs->id_slide?>"></td>
                            <td><?=$rs->id_slide?></td>
                            <td><a href="<?=site_url('slideshow/edit/'.$rs->id_slide)?>"><?=$rs->ten?></a></td>
                            <td><?=$rs->links?></td>
                            <td><img width="100" src="<?=base_url_site().'data/sl/'.$rs->images?>" alt=""></td>
                            <td>
                                <input type="text" class="order" name="order_<?=$rs->id_slide?>" value="<?=$rs->ordering?>">
                                <input type="hidden" name="id[]" value="<?=$rs->id_slide?>">
                            </td>
                            <td>
                                <span id="publish<?php echo $rs->id_slide?>"><?php echo icon_active("'slideshow'","'id_slide'",$rs->id_slide,$rs->published)?></span>
                                <?php echo icon_edit('slideshow/edit/'.$rs->id_slide)?>
                                <?php 
                                echo icon_del('slideshow/del/'.$rs->id_slide);
                                ?> 
                            </td>
                        </tr>       
                        <?php
                        $k=1-$k;
                    endforeach;
                    ?>
                    <tfoot>
                        <td>
                            Hiện có <?php echo $num?> ảnh slide <span class="pages"><?php echo $pagination?></span>
                        </td>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
</div>


<?php echo form_close()?>

<script type="text/javascript">
    function save_order(){
    //load_show();
    var fields = $("#admindata :input").serializeArray();
    $.post(base_url+"slideshow/save_order",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
