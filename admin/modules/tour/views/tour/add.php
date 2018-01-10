<link type="text/css" rel="stylesheet" href="<?php echo base_url().'templates/css/uploadify.css'; ?>" media="screen" />
<script type="text/javascript" src="<?php echo base_url().'templates/js/core/jquery.uploadify.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'templates/js/core/price_format.js'; ?>"></script>
<?=form_open(uri_string(),array('id'=>'admindata'));?>
<div class="htabs">
    <a href="javascript:;" data_key="thong_tin" class="selected">Thông tin</a>
    <a href="javascript:;" data_key="noi_dung">Nội dung</a>
    <a href="javascript:;" data_key="bang_gia">Bảng giá</a>
    <a href="javascript:;" data_key="hinh_anh">Hình ảnh</a>
    <a href="javascript:;" data_key="lich">Lịch khởi hành</a>
   <!-- <a href="javascript:;" data_key="language_local">Địa danh đi qua</a> -->
</div>      
<div><label style="display: none;float: none;display: none;" class="error" generated="true" for="images">Vui lòng Upload và chọn hình đại diện cho Tour</label></div>               
<div class="lang" id="thong_tin" style="display: block;">
    <table class="form">
        <tr>
            <td class="label" style="width: 150px;">Danh mục Tour</td>
            <td>
                <?foreach($dscat as $val):
                $subcat = $this->tour->get_all_cat($val->cat_id);
                ?>
                <div style="width: 200px;float: left; margin-right: 5px;">
                    <div style="font-size: 14px;"><b><?=$val->name?></b></div>
                    <ul>
                        <?foreach($subcat as $val1):
                        $subcat2 = $this->tour->get_all_cat($val1->cat_id);
                        ?>
                        <li><input type="checkbox" id="<?=$val1->cat_id?>" name="ar_cat_id[]" value="<?=$val1->cat_id?>"><label for="<?=$val1->cat_id?>"><?=$val1->name?></label></li>
                        <?foreach($subcat2 as $val12):?>
                        <li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  |__<input type="checkbox" id="<?=$val12->cat_id?>" name="ar_cat_id[]" value="<?=$val12->cat_id?>"><label for="<?=$val12->cat_id?>"><?=$val12->name?></label></li>
                        <?endforeach;?>
                        
                        <?endforeach;?>
                        
                    </ul>
                </div>
                <?endforeach;?>
            </td>
        </tr>
        <tr>
            <td class="label">Mã Tour</td>
            <td>
                
               <input type="text" name="vdata[code]" value="<?=set_value('vdata[code]')?>" class="w100">
            </td>
        </tr>
		<tr>
            <td class="label">Giảm giá</td>
            <td>  
                <input type="text" name="vdata[giamgia]" value="<?=set_value('vdata[giamgia]')?>" class="w100"><b style="margin-left: 22px;">%</b>
            </td>
        </tr>
		<tr>
            <td class="label">Khoảng giá tìm kiếm</td>
            <td>  
                <select name="vdata[price_search]">
					<option value="">Không xác định</option>
					<?php 
						$sql = "SELECT * FROM price_search WHERE published = 1";
						$price_search = $this->db->result($sql);
						foreach($price_search as $list) {
					?>
						<option value="<?=$list->id?>"><?=$list->price?></option>
					<?php 
						}
					?>
				</select>
            </td>
        </tr>
        <tr>
            <td class="label">Thời gian Tour</td>
            <td>
                <b style="margin-left: 20px; padding-top: 2px; padding-right: 5px;text-align: right;" class="fl">Số ngày: </b>
                <input type="text" name="vdata[ngay]" value="<?=(set_value('vdata[ngay]') == '')?1:set_value('vdata[ngay]')?>" class="w100 fl">
                <b style="margin-left: 20px;float: left; padding-top: 2px; padding-right: 5px;text-align: right;width: 146px;">Số đêm: </b>
                <input type="text" name="vdata[dem]" value="<?=(set_value('vdata[dem]') == '')?0:set_value('vdata[dem]')?>" class="w100">
            </td>
        </tr> 

        <tr>
            <td class="label">Tùy chọn</td>
            <td>
                <b>Nổi bật: </b>
                <input type="checkbox" name="noibat" value="1" <?=($rs->noibat == 1)?'checked="checked"':''?>>
                <b style="padding-left: 20px;">Khuyến mãi: </b>
                <input type="checkbox" name="khuyenmai" value="1" <?=($rs->khuyenmai == 1)?'checked="checked"':''?>>
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Tên Tour</td>
            <td>
                <input type="text" name="vdata[title]" value="<?=set_value('vdata[title]')?>" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Tên Tour SEO</td>
            <td>
                <input type="text" name="vdata[title_seo]" value="<?=set_value('vdata[title_seo]')?>" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Vận chuyển</td>
            <td>
                <input type="text" name="vdata[vanchuyen]" value="<?=set_value('vdata[vanchuyen]')?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Lịch trình</td>
            <td>
                <input type="text" name="vdata[lichtrinh]" value="<?=set_value('vdata[lichtrinh]')?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Ngày khởi hành</td>
            <td>
                <input type="text" name="vdata[ngaykhoihanh]" value="<?=set_value('vdata[ngaykhoihanh]')?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Hình thức</td>
            <td>
                <input type="text" name="vdata[hinhthuc]" value="<?=set_value('vdata[hinhthuc]')?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label">Chủ đề Tour</td>
            <td>
                <select name="vdata[id_chude]" style="width: 200px;">
                    <option value="0">Chọn chủ đề Tour</option>
                    <?foreach($chude as $val):?>
                    <option value="<?=$val->id_chude?>"><?=$val->ten_chude?></option>
                    <?endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">Điểm khởi hành</td>
            <td>
                <select name="vdata[khoihanh]" style="width: 200px;">
                    <option value="0">Chọn điểm khởi hành</option>
                    <?foreach($list_city as $val):?>
                    <option value="<?=$val->city_id?>" <?=($val->city_id == 501)?'selected="selected"':''?>><?=$val->city_name?></option>
                    <?endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">Điểm kết thúc</td>
            <td>
                <select name="vdata[ketthuc]" style="width: 200px;">
                    <option value="0">Chọn điểm kết thúc</option>
                    <?foreach($list_city as $val):?>
                    <option value="<?=$val->city_id?>"><?=$val->city_name?></option>
                    <?endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">Tour liên quan </td>
            <td>
                <input type="text" name="vdata[tourlienquan]" value="<?=set_value('vdata[tourlienquan]')?>" style="width: 400px;">
                (Nhập id từng tour, cách nhau bởi dấu phẩy, ví dụ: 50,51,62)
            </td>
        </tr>
    </table>
</div>

<div class="lang" id="bang_gia" style="display: none;">
    <table class="form">
        <tr>
            <td class="label">Bảng giá Tour</td>
            <td class="bangia">
                <div class="item" style="margin-bottom:5px">
                    <select name="ar_begin[]" class="songay" style="width: 150px;">
                        <option value="1"> >= 1 Khách</option>
                    </select>
                    Giá: <input type="text" name="ar_price[]" class="price"> Giá trẻ em: <input type="text" name="ar_price2[]" class="price"> <span style="margin-left: 40px;">[<a class="add_price" href="javascript:;">Thêm giá</a>]</span>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="lang" id="hinh_anh" style="display: none;">
    <div class="imgmain" style="margin-left: 40px;">
        
    </div>
    <input type="hidden" name="vdata[images]" id="images">
    <div id="block_upload" style="margin-left: 36px;"><input id="file_upload" name="file_upload" type="file" /></div>
    <div id="file_uploadQueue" class="uploadifyQueue" style="width: 200px;"></div>
    <div style="margin: 10px 0px; overflow: hidden; display: block;">
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
</div>
<div class="lang" id="noi_dung" style="display: none;">
    <table class="form">
        <tr>
            <td class="label">Giới thiệu Tour</td>
            <td>
                <textarea style="width: 99%;" rows="5" name="vdes[gioithieu]"><?=set_value('vdes[gioithieu]')?></textarea>
            </td>
        </tr> 
        <tr>
            <td class="label">Từ khóa</td>
            <td>
                <textarea style="width: 99%;" rows="3" name="vdes[keyword]"><?=set_value('vdes[keyword]')?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label">Chương trình Tour</td>
            <td>
                <?=vnit_editor(set_value('vdes[chuongtrinh]'),'vdes[chuongtrinh]','chuongtrinh')?>
            </td>
        </tr>
        <tr>
            <td class="label">Phụ lục Tour</td>
            <td>
                <?=vnit_editor(set_value('vdes[phuluc]'),'vdes[phuluc]','phuluc')?>
            </td>
        </tr> 
       <!-- <tr>
            <td class="label">Quy định đặt tour</td>
            <td>
                <?=vnit_editor(set_value('vdes[dieukien]'),'vdes[dieukien]','dieukien')?>
            </td>
        </tr>   -->
    </table>
</div>
<!--
<div class="lang" id="language_local" style="display: none;">
    <table style="width: 100%;">
        <tr>
            <td>
                <h2 style="margin-bottom: 24px; margin-top: 5px; font-size: 15px;">Danh sách địa danh đi qua</h2>
                <div id="local_choice">

                </div>
            </td>
            <td style="border-left: 1px dashed #CCC; padding-left: 10px;width: 50%;">
                <h2 style="font-size: 15px;margin-top: 5px;">Chọn địa danh đi qua</h2>
                <select name="" id="select_city">
                    <option value="0">Chọn Tỉnh, Thành phố</option>
                    <?foreach($list_city as $val):?>
                    <option value="<?=$val->city_id?>"><?=$val->city_name?></option>
                    <?endforeach;?>
                </select>
                <div id="list_local" style="max-height: 300px; min-height: 193px;overflow-x:hidden"></div>
            </td>
        </tr>
    </table>
</div> -->
<div class="lang" id="lich" style="display: none;">
    <table class="admindata" id="listlich">
        <thead>
            <tr class="pagination">
                <th style="width: 150px;">Ngày khởi hành</th>
                <th>Ngày kết thúc</th>
            </tr>
        </thead>

    </table>
    <div style="padding: 10px 0px;"><b><a href="javascript:;" class="addlich">Thêm mới</a></b></div>
</div>
<?=form_close()?>
<script type="text/javascript" src="<?=base_url()?>templates/js/core/datetimepicker_css.js" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".addlich").click(function(){
        rowCount = $('#listlich tr').length;
        var html = '<tr class="row0" id="row_lich_'+rowCount+'">'+
                   '<td>'+
                        '<input type="text" name="date_begin[]" id="begin_'+rowCount+'" style="width: 100px;">'+
                        '<a href="javascript:;" onclick="javascript:NewCssCal('+'\'begin_'+rowCount+'\',\'ddmmyyyy\')"> <img src="'+base_url+'templates/icon/date.png" alt=""></a>'+
                   '</td>'+
                   '<td>'+
                        '<input type="text" name="date_end[]" id="end_'+rowCount+'" style="width: 100px;">'+
                        '<a href="javascript:;"onclick="javascript:NewCssCal('+'\'end_'+rowCount+'\',\'ddmmyyyy\')"> <img src="'+base_url+'templates/icon/date.png" alt=""></a>'+
                        '<a href="javascript:;" class="del_lich" data_id="'+rowCount+'"><b style="margin-left:20px;">Xóa</b></a>'+
                   '</td>'+
                   '</tr>';
        $("#listlich").append(html);
        
    })
    
    $(".del_lich").live('click',function(){
        var i = $(this).attr('data_id');
        $("#row_lich_"+i).remove();
    })
    
    $("#select_city").change(function(){
        var city_id = $(this).val();
        $.post(base_url+"tour/get_local",{'city_id':city_id},function(data){
            $("#list_local").html(data);
        });
    })
    
    $(".choice_local").live('click',function(){
        var local_id = $(this).attr('local_id');
        var local_name = $(this).attr('local_name');
        var length = $("#local_div_"+local_id).length;
        if(length > 0){
            jAlert("Địa danh này đã được chọn");
        }else{
            var html ='<div id="local_div_'+local_id+'">'+
                      '<input type="hidden" name="ar_id[]" value="'+local_id+'">'+local_name+
                      ' <a href="javascript:;" class="del_local" data_key="'+local_id+'"><b>[ Xóa ]</b></a>'+
                      '</div>';
            $("#local_choice").append(html);
        }
    })
    
    $(".del_local").live('click',function(){
        var local_id = $(this).attr('data_key');
        $("#local_div_"+local_id).remove();
    }) ;
    
    $(".price").live('keyup',function(){
        $(this).val(formatCurrency(ToNumber($(this).val())));
    })
    $(".add_price").click(function(){
        var min = 0;
        $(".songay").each(function(){
            var ngay =  $(this).val();
            if(ngay > min){
                min = ngay;
            }
        })
        var html ='<div class="item" style="margin-bottom:5px">'+
                 '<select name="ar_begin[]" class="songay" style="width: 150px;">';
                 for(i = (parseInt(min) + 1); i <= 50; i++){
                     html +='<option value="'+i+'"> >= '+i+' Khách</option>';
                 }
                 html +='</select> ';
                 /*
                 html +='Đến: <select name="ar_end[]">';
                 for(i = 1; i <= 50; i++){
                     html +='<option value="'+i+'">'+i+' Khách</option>';
                 }
                 html +='</select> ';
                 */
                 html +='Giá: <input type="text" name="ar_price[]" class="price"> Giá trẻ em: <input type="text" name="ar_price2[]" class="price"> <a style="margin-left: 40px;" class="del_price" href="javascript:;">[Xóa]</a>';
                 $(".bangia").append(html);
    });
    
    $(".del_price").live('click',function(){
        $(this).parent().remove();
    })
    
    $("#admindata").validate({
        errorElement: "div",
        rules: {
            'vdata[title]': "required"       
        },
        messages: {
            'vdata[title]': "Vui lòng nhập Tên Tour"
        }
    })    
    
    $('#file_upload').uploadify({
        'swf'  : base_url+'templates/swf/uploadify.swf',
        'uploader'    : base_url+'tour/uploader/<?=$this->session->sessionid()?>',    
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
        
        $.post(base_url+"tour/del_img_tam",{'id':id},function(data){
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

});
</script>

<style>
#list_local div,
#local_choice div{
    background: none repeat scroll 0 0 #F2F2F2;
    border-bottom: 1px solid #FFFFFF;
    overflow: hidden;
    padding: 8px 5px;
}
#list_local div a,
#local_choice div a{
    color: #FF0000;
    float: left;
    width: 50px;
}
#list_local div a b,
#local_choice div a b{
    color: #FF0000;
}
div.error{
    color: #FF0000;
}
.imgmain{
    border: 1px solid #CCC;
    width: 120px;
    height: 100px;
    overflow: hidden;
    display: block;
    margin-bottom: 10px;
    background: #FFF;
}
.imgmain img{
    width: 120px; 
    min-height: 100px;
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