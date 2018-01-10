<?php echo form_open(uri_string(), array('id'=>'admindata'))?>
<div class="show_success">
    Click chọn 1 Module mà bạn muốn thêm mới
    <span class="del_smg"></span>
</div>
<table class="admindata">
    <thead>

        <tr>
            <th class="id">STT</th>
            <th style="width: 30px;"></th>
            <th style="width: 200px;">Tên Modules</th>
            <th>Miêu tả</th>
            <th style="width: 150px;">Tác giả</th>
            <th style="width: 70px;">Phiên bản</th>

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
<?php echo form_close()?>
