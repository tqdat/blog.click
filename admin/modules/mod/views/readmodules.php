<?php echo form_open(uri_string(), array('id'=>'admindata'))?>
<div class="callout callout-info">
              <h5>Click chọn 1 Module mà bạn muốn thêm mới</h5>
            </div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="id">STT</th>
                            <th></th>
                            <th>Tên Modules</th>
                            <th>Miêu tả</th>
                            <th>Tác giả</th>
                            <th>Phiên bản</th>
                        </tr>        
                    </thead>
                    <?php
                    $k = 1;
                    $i = 1;
                    while(false !== ($file = readdir($handle))){
                        if ($file != "." && $file != ".." && $file != 'index.php') {
                            $xml = simplexml_load_file(ROOT.'site/mod/'.$file.'/'.$file.'.xml')    
                            ?>
                            <tr class="row<?php echo $k?>">
                                <td align="center"><?php echo $i?></td>
                                <td align="center"><input type="radio" name="modules_name" value="<?php echo $file?>"></td>
                                <td><?php echo $file?></td>
                                <td><?=$xml->name[0]?></td>  
                                <td><?=$xml->author[0]?></td>  
                                <td><?=$xml->version[0]?></td>  
                            </tr>
                            <?php    
                            $i ++ ;
                        }      

                        $k = 1 - $k;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php echo form_close()?>
