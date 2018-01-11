<link type="text/css" rel="stylesheet" href="<?php echo base_url().'templates/css/uploadify.css'; ?>" media="screen" />
<script type="text/javascript" src="<?php echo base_url().'templates/js/core/jquery.uploadify.js'; ?>"></script>
<?php echo form_open(uri_string(), array('id'=>'admindata'));?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề</label>
                        <input type="text" name="vdata[title]" value="<?php echo set_value('vdata[title]')?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Giới thiệu</label>
                        <textarea class="form-control" rows="4" name="vdata[des]"></textarea>
                    </div>
                    <div>
                        <input type="hidden" name="vdata[images]" id="images">
                        <input id="file_upload" name="file_upload" type="file" />
                    </div>
                    <div id="file_uploadQueue" class="uploadifyQueue"></div>
                    <div class="form-group">
                        <ul class="listimg">
                            <?foreach($img as $val):?>
                                <li>
                                    <div class="img" img_src="<?=$val->path?>"><img src="<?=base_url_site()?>data/tam/<?=$val->path?>"></div>
                                    <div class="l_del"><a href="javascript:;" img_id="<?=$val->id?>" img_src="<?=$val->path?>" class="del_img">Xóa</a></div>
                                    <input type="hidden" name="ar_img[]" value="<?=$val->path?>">
                                </li>
                                <?endforeach;?>
                            </ul> 
                        </div>
                    </div><!-- /.box-body -->
                </form>
            </div>
        </div>
    </div>

    <?php echo form_close();?>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#file_upload').uploadify({
                'swf'  : base_url+'templates/swf/uploadify.swf',
                'uploader'    : base_url+'khachhang/uploader/<?=$this->session->sessionid()?>',    
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

                $.post(base_url+"khachhang/del_img_tam",{'id':id},function(data){
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
