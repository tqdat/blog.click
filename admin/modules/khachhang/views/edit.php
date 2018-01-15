<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<div class="col-md-12">
    <div class="box box-primary">
        <form role="form">
          <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Tiêu đề</label>
                <input type="text" name="vdata[title]" value="<?php echo $rs->title?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Giới thiệu</label>
                <textarea rows="4" class="form-control" name="vdata[des]"><?=$rs->des?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Hình ảnh</label>
                <input type="file" name="vdata[images]">
                <?if($rs->images != ''){?>
                <br>
                <img src="<?=base_url_site()?>data/support/<?=$rs->images?>" alt="">
                <?}?>
            </div>
        </div><!-- /.box-body -->
    </form>
</div>
</div>
<?php echo form_close();?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#file_upload').uploadify({
            'swf'  : base_url+'templates/swf/uploadify.swf',
            'uploader'    : base_url+'khachhang/uploader_edit/<?=$rs->id?>',    
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
                    '<div class="img" img_src="'+obj.filename+'"><img src="'+base_url_site+'data/khachhang/100/'+obj.filename+'"></div>'+
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

            $.post(base_url+"khachhang/del_img",{'id':id},function(data){
                if(img_src == img_old){
                    $("#images").val('');
                    $(".imgmain").html('');
                }
            });
            

            $(this).parent().parent().remove();
        })

        $(".img").live('click',function(){
            img_src = $(this).attr('img_src');
            $(".imgmain").html('<img src="'+base_url_site+'data/khachhang/200/'+img_src+'">');
            $("#images").val(img_src);
        })
    })
</script>
