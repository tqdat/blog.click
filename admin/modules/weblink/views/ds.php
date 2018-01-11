<?php echo form_open('weblink/dels',  array('id' => 'admindata'));?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr class="pagination">
                            <th class="head" colspan="5">
                                Hiện có <?php echo count($list)?> Liên kết
                            </th>
                        </tr>
                        <tr>
                            <th class="id">ID</th>
                            <th>Liên kết</th>
                            <th>Link</th>
                            <th>Chức năng</th>
                        </tr>        
                    </thead>
                    <?
                    $k=1;
                    foreach($list as $rs):
                        ?>
                        <tr class="row<?=$k?>">

                            <td align="center"><?=$rs->id?></td>
                            <td>
                                <a href="<?=site_url('weblink/edit/'.$rs->id)?>"><?=$rs->name?></a>
                            </td>
                            <td><a href="<?=$rs->link?>" target="_blank"><?=$rs->link?></a></td>
                            <td align="center">
                                <?php echo icon_edit('weblink/edit/'.$rs->id)?>
                                <span id="publish<?php echo $rs->id?>"><?php echo icon_active("'weblink'","'id'",$rs->id,$rs->published)?></span>
                                <?php echo icon_del('weblink/del/'.$rs->id)?>
                            </td>
                        </tr>       
                        <?php
                        $k=1-$k;
                    endforeach;
                    ?>   
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
    $.post(base_url+"help/save_order_help",fields, function(data) {
        //load_hide();
        location.reload();
    });
}
</script>
