<link type="text/css" rel="stylesheet" href="<?php echo base_url().'templates/css/uploadify.css'; ?>" media="screen" />
<script type="text/javascript" src="<?php echo base_url().'templates/js/core/jquery.uploadify.js'; ?>"></script>
<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<table style="width: 100%;">
    <tr>
        <td>
            <table class="form">
                <tr>
                    <td class="label" style="width: 150px;">Tiêu đề</td>
                    <td><input type="text" name="vdata[title]" value="<?php echo set_value('vdata[title]')?>" class="w500"></td>
                </tr>
                <tr>
                    <td class="label">Loại xe</td>
                    <td><input type="text" name="vdata[loaixe]" value="<?php echo set_value('vdata[loaixe]')?>"></td>
                </tr>
                <tr>
                    <td class="label">Nhãn hiệu</td>
                    <td><input type="text" name="vdata[nhanhieu]" value="<?php echo set_value('vdata[nhanhieu]')?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Nội dung</b>
                        <?=vnit_editor(set_value(htmlspecialchars_decode('thongtin')),'thongtin','full')?>
                    </td>
                </tr>
            </table>        
        </td>
        <td>
            <table style="margin-left: 10px;">
                <tr>
                    <td style="width: 200px;">
                        <div class="imgmain" style="border: 1px solid #CCC; background: #FFF;width: 150px;height: 100px;margin-bottom: 10px;">
                            
                        </div>
                        <input type="hidden" name="vdata[images]" id="images">
                        <div id="block_upload"><input id="file_upload" name="file_upload" type="file" /></div>
                        <div id="file_uploadQueue" class="uploadifyQueue" style="width: 200px;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul class="listimg">
                        <?foreach($img as $val):?>
                        <li>
                              <div class="img" img_src="<?=$val->path?>"><img src="<?=base_url_site()?>data/tam/<?=$val->path?>"></div>
                              <div class="l_del"><a href="javascript:;" img_id="<?=$val->id?>" img_src="<?=$val->path?>" class="del_img">Xóa</a></div>
                              <input type="hidden" name="ar_img[]" value="<?=$val->path?>">
                        </li>
                        <?endforeach;?>
                        </ul>  
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php echo form_close();?>
<script type="text/javascript">
$(document).ready(function() {
    
    $('#file_upload').uploadify({
        'swf'  : base_url+'templates/swf/uploadify.swf',
        'uploader'    : base_url+'thuexe/uploader/<?=$this->session->sessionid()?>',    
        'width': 130,
        'height'    : 30,
        'queueID'        : 'file_uploadQueue',
        'scriptAccess'  : 'always',
        'fileTypeDesc'  : '*.jpg;*.png;*.gif',
        'fileTypeExts'  : '*.jpg;*.png;*.gif',
        'fileSizeLimit'  : (204800 * 1024),
        'onUploadSuccess' : function(file, data, response) {
            obj = $.parseJSON(data);
            if(obj.error == 0){
                var html ='<li>'+
                          '<div class="img" img_src="'+obj.filename+'"><img src="'+base_url_site+'data/tam/'+obj.filename+'"></div>'+
                          '<div class="l_del"><a href="javascript:;" img_id="'+obj.id+'" img_src="'+obj.filename+'" class="del_img">Xóa</a></div>'+
                          '<input type="hidden" name="ar_img[]" value="'+obj.filename+'">'+
                          '</li>';
                $(".listimg").append(html);
            }else{
                alert(obj.msg);
            }
        }     
    });
    
    $(".del_img").live('click',function(){
        var img_src = $(this).attr('img_src');
        var img_old = $("#images").val();
        var id = $(this).attr('img_id');
        
        $.post(base_url+"thuexe/del_img_tam",{'id':id},function(data){
            if(img_src == img_old){
                $("#images").val('');
                $(".imgmain").html('');
            }
        });
            
        
        $(this).parent().parent().remove();
    })
    
    $(".img").live('click',function(){
        img_src = $(this).attr('img_src');
        $(".imgmain").html('<img src="'+base_url_site+'data/tam/'+img_src+'">');
        $("#images").val(img_src);
    })
})
</script>
<style type="text/css">
.imgmain img{
    width: 150px;
    height: 100px;
}
ul.listimg li{
    float: left;
    width: 90px;
    height: 80px;
    margin-right: 10px;
    margin-bottom: 10px;
}
ul.listimg li .img{
    width: 90px;
    height: 60px;
    border: 1px solid #CCC;
    background: #FFF;
    display: block;
    overflow: hidden;
    cursor: pointer;
}
ul.listimg li .img img{
    width: 90px;
    min-height : 60px;
}
ul.listimg .l_del{
    margin-top: 5px;
    font-weight: bold;
    text-align: center;
}
</style>