<link type="text/css" rel="stylesheet" href="<?php echo base_url().'templates/css/uploadify.css'; ?>" media="screen" />
<script type="text/javascript" src="<?php echo base_url().'templates/js/core/jquery.uploadify.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'templates/js/core/price_format.js'; ?>"></script>
<div class="htabs">
    <a href="javascript:;" data_key="thong_tin" class="selected">Thông tin</a>
    <a href="javascript:;" data_key="noi_dung">Nội dung</a>
    <a href="javascript:;" data_key="bang_gia">Bảng giá</a>
    <a href="javascript:;" data_key="hinh_anh">Hình ảnh</a>
    <a href="javascript:;" data_key="lich">Lịch khởi hành</a>
</div>
<?=form_open(uri_string(),array('id'=>'admindata'));?>
<?
$ar_cat = explode(',',$rs->cat_id);
?>
<div class="lang" id="thong_tin">
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
                        <li><input type="checkbox" id="<?=$val1->cat_id?>" name="ar_cat_id[]" value="<?=$val1->cat_id?>" <?=(in_array($val1->cat_id,$ar_cat))?'checked="checked"':''?>><label for="<?=$val1->cat_id?>"><?=$val1->name?></label></li>
                        <?foreach($subcat2 as $val12):?>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  |__<input type="checkbox" id="<?=$val12->cat_id?>" name="ar_cat_id[]" value="<?=$val12->cat_id?>" <?=(in_array($val12->cat_id,$ar_cat))?'checked="checked"':''?>><label for="<?=$val12->cat_id?>"><?=$val12->name?></label></li>
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
               <input type="text" name="vdata[code]" value="<?=$rs->code?>" class="w100">
            </td>
        </tr>
		<tr>
            <td class="label">Giảm giá</td>
            <td>  
                <input type="text" name="vdata[giamgia]" value="<?=$rs->giamgia?>" class="w100"><b style="margin-left: 22px;">%</b>
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
						<option <?=($list->id == $rs->price_search)?'selected="selected"':''?> value="<?=$list->id?>"><?=$list->price?></option>
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
                <input type="text" name="vdata[ngay]" value="<?=$rs->ngay?>" class="w100 fl">
                <b style="margin-left: 20px;float: left; padding-top: 2px; padding-right: 5px;text-align: right;width: 146px;">Số đêm: </b>
                <input type="text" name="vdata[dem]" value="<?=$rs->dem?>" class="w100">
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
                <input type="text" name="vdata[title]" value="<?=$rs->title?>" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Tên Tour SEO</td>
            <td>
                <input type="text" name="vdata[title_seo]" value="<?=$rs->title_seo?>" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Link Tour</td>
            <td>
                <input type="text" name="vdata[slug]" value="<?=$rs->slug?>" style="width: 98%;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Vận chuyển</td>
            <td>
                <input type="text" name="vdata[vanchuyen]" value="<?=$rs->vanchuyen?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Lịch trình</td>
            <td>
                <input type="text" name="vdata[lichtrinh]" value="<?=$rs->lichtrinh?>" style="width: 400px;">
            </td>
        </tr>
         <tr>
            <td class="label" style="width: 150px;">Ngày khởi hành</td>
            <td>
                <input type="text" name="vdata[ngaykhoihanh]" value="<?=$rs->ngaykhoihanh?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Hình thức</td>
            <td>
                <input type="text" name="vdata[hinhthuc]" value="<?=$rs->hinhthuc?>" style="width: 400px;">
            </td>
        </tr>
        <tr>
            <td class="label">Chủ đề Tour</td>
            <td>
                <select name="vdata[id_chude]" style="width: 200px;">
                    <option value="0">Chọn chủ đề Tour</option>
                    <?foreach($chude as $val):?>
                    <option value="<?=$val->id_chude?>" <?=($val->id_chude == $rs->id_chude)?'selected="selected"':''?>><?=$val->ten_chude?></option>
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
                    <option value="<?=$val->city_id?>" <?=($val->city_id == $rs->khoihanh)?'selected="selected"':''?>><?=$val->city_name?></option>
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
                    <option value="<?=$val->city_id?>" <?=($val->city_id == $rs->ketthuc)?'selected="selected"':''?>><?=$val->city_name?></option>
                    <?endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label">Tour liên quan</td>
            <td>
                <input type="text" name="vdata[tourlienquan]" value="<?=$rs->tourlienquan?>" style="width: 98%;">
                (Nhập id từng tour, cách nhau bởi dấu phẩy, ví dụ: 50,51,62)
            </td>
        </tr>
    </table>
</div>
<div class="lang" id="bang_gia" style="display: none;">
    <table class="form">
        <tr>
            <td class="label" style="width: 150px;">Bảng giá Tour</td>
            <td class="bangia">
                <?
                if(count($ds_price) > 0){
                $k = 1;
                foreach($ds_price as $val):?>
                <div class="item" style="margin-bottom:5px">
                    <select name="ar_begin[]" class="songay" style="width: 150px;">
                        <?for($i = 1; $i <= 50; $i++){?>
                        <option value="<?=$i?>" <?=($val->begin == $i)?'selected="selected"':''?>> >= <?=$i?> Khách</option>
                        <?}?>
                    </select>
                    Giá: <input type="text" name="ar_price[]" value="<?=number_format($val->price,0,'.','.')?>" class="price"> 
                    Giá trẻ em: <input type="text" name="ar_price2[]" value="<?=number_format($val->price2,0,'.','.')?>" class="price"> 
                    <?if($k == 1){?>
                    <span style="margin-left: 40px;">[<a class="add_price" href="javascript:;">Thêm giá</a>]</span>
                    <?}else{?>
                    <a style="margin-left: 40px;" class="del_price" href="javascript:;">[Xóa]</a>
                    <?}?>
                </div>
                <?
                $k++;
                endforeach;
                }else{
                ?>
                <div class="item" style="margin-bottom:5px">
                    <select name="ar_begin[]" class="songay" style="width: 150px;">
                        <?for($i = 1; $i <= 50; $i++){?>
                        <option value="<?=$i?>"> >= <?=$i?> Khách</option>
                        <?}?>
                    </select>
                    Giá <input type="text" name="ar_price[]" value="<?=number_format($val->price,0,'.','.')?>" class="price"> 
                    Giá trẻ em<input type="text" name="ar_price2[]" value="<?=number_format($val->price2,0,'.','.')?>" class="price"> 
                    <span style="margin-left: 40px;">[<a class="add_price" href="javascript:;">Thêm giá</a>]</span>
                </div>                        
                
                <?}?>
            </td>
        </tr>
    </table>
</div>
<div class="lang" id="hinh_anh" style="display: none;">
    <div class="imgmain" style="margin-left: 40px;">
        <img src="<?=base_url_site()?>data/tour/80/<?=$rs->images?>" alt="">    
    </div>
    <label for="images" generated="true" class="error" style="display: none;float: none;display: none;">Vui lòng Upload và chọn hình đại diện cho sản phẩm</label>
    <input type="hidden" name="vdata[images]" id="images" value="<?=$rs->images?>">
    <div id="block_upload" style="margin-left: 36px;"><input id="file_upload" name="file_upload" type="file" /></div>
    <div id="file_uploadQueue" class="uploadifyQueue" style="width: 200px;"></div>
    <div style="margin: 10px 0px; overflow: hidden; display: block;">
        <ul class="listimg">
        <?foreach($img as $val):?>
        <li>
          <div class="img" img_src="<?=$val->path?>"><img src="<?=base_url_site()?>data/tour/80/<?=$val->path?>"></div>
          <div class="l_del"><a href="javascript:;" img_id="<?=$val->img_id?>" img_src="<?=$val->path?>" class="del_img">Xóa</a></div>
          <input type="hidden" name="ar_img[]" value="<?=$val->path?>">
        </li>
        <?endforeach;?>
        </ul>            
    </div>
</div>
<div class="lang" id="noi_dung" style="display: none;">
    <table class="form">
        <tr>
            <td class="label" style="width: 150px;">Giới thiệu Tour</td>
            <td>
                <textarea style="width: 99%;" rows="5" name="vdes[gioithieu]"><?=$rs->gioithieu?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label" style="width: 150px;">Từ khóa</td>
            <td>
                <textarea style="width: 99%;" rows="3" name="vdes[keyword]"><?=$rs->keyword?></textarea>
            </td>
        </tr>
        <tr>
            <td class="label">Chương trình Tour</td>
            <td>
                <?=vnit_editor($rs->chuongtrinh,'vdes[chuongtrinh]','chuongtrinh_')?>
            </td>
        </tr>
        <tr>
            <td class="label">Phụ lục Tour</td>
            <td>
                <?=vnit_editor($rs->phuluc,'vdes[phuluc]','phuluc_')?>
            </td>
        </tr>
       <!-- <tr>
            <td class="label">Quy định đặt tour</td>
            <td>
                <?=vnit_editor($rs->dieukien,'vdes[dieukien]','dieukien')?>
            </td>
        </tr>   -->
    </table>
</div>

<div class="lang" id="lich" style="display: none;">
    <table class="admindata" id="listlich">
        <thead>
            <tr class="pagination">
                <th style="width: 150px;">Ngày khởi hành</th>
                <th>Ngày kết thúc</th>
            </tr>
        </thead>
        <?
        $k = 1;
        $i = 1;
        foreach($lich as $val):?>
        <tr class="row0" id="row_lich_<?=$i?>">
            <td>
                <input type="text" name="date_begin[]" id="begin_<?=$i?>" value="<?=date('d-m-Y',$val->ngaydi)?>" style="width: 100px;">
                <a href="javascript:;"  onclick="javascript:NewCssCal('begin_<?=$i?>','ddmmyyyy')"><img src="<?=base_url()?>templates/icon/date.png" alt=""></a>
            </td>
            <td>
                <input type="text" name="date_end[]" id="end_<?=$i?>" value="<?=date('d-m-Y',$val->ngayve)?>" style="width: 100px;">
                <a href="javascript:;"  onclick="javascript:NewCssCal('end_<?=$i?>','ddmmyyyy')"><img src="<?=base_url()?>templates/icon/date.png" alt=""></a>
                <a href="javascript:;" class="del_lich" data_id="<?=$i?>"><b style="margin-left:20px;">Xóa</b></a>
            </td>
        </tr>
        <?
        $i++;
        endforeach;?>
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
            'vdata[title]': "Vui lòng nhập Tên sản phẩm"
        }
    })    
    
    $('#file_upload').uploadify({
        'swf'  : base_url+'templates/swf/uploadify.swf',
        'uploader'    : base_url+'tour/uploader_edit/<?=$rs->id?>',    
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
                          '<div class="img" img_src="'+obj.filename+'"><img src="'+base_url_site+'data/tour/80/'+obj.filename+'"></div>'+
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
        
        $.post(base_url+"tour/del_img",{'id':id},function(data){
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

#local_choice div{
    background: none repeat scroll 0 0 #F2F2F2;
    border-bottom: 1px solid #FFFFFF;
    overflow: hidden;
    padding: 8px 5px;
}

#local_choice div a{
    color: #FF0000;
    float: left;
    width: 50px;
}

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