
<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="id" value="<?=$rs->id?>">
<table class="table_" style="width: 100%;">
    <tr>
        <td valign="top" style="padding-right: 10px;">
            <table class="form">
                <tr>
                    <td class="label" style="width: 150px;">Tiêu đề</td>
                    <td><input type="text" name="data[title]" value="<?php echo $rs->title?>" style="width: 99%;"></td>
                </tr>
				<tr>
                    <td class="label" style="width: 150px;">Giá(VNĐ)</td>
                    <td><input type="text" name="data[price]" value="<?php echo number_format($rs->price)?>" style="width: 99%;"></td>
                </tr>
				<tr>
                    <td class="label" style="width: 150px;">Địa chỉ</td>
                    <td><input type="text" name="data[address]" value="<?php echo $rs->address?>" style="width: 99%;"></td>
                </tr>
				<tr>
                    <td class="label" style="width: 150px;">Hạng sao</td>
                    <td>
						<select name="data[star]">
							<option value="">Không xác định</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</td>
                </tr>
                <tr>
                    <td class="label">Chủ đề</td>
                    <td>
                        <select name="data[catid]" style="font-size: 12px;" id="catid" class="w300">
                            <?foreach($listhotel_chanel as $val):
                            $list1 = $this->hotel->get_all_hotel_chanel($val->cat_id);
                            ?>
                            <option value="<?php echo $val->cat_id?>" <?=($val->cat_id == $rs->catid)?'selected="selected"':''?>><?=$val->cat_name?></option>
                                <?foreach($list1 as $val1):
                                $list2 = $this->hotel->get_all_hotel_chanel($val1->cat_id);
                                ?>
                                    <option value="<?php echo $val1->cat_id?>" <?=($val1->cat_id == $rs->catid)?'selected="selected"':''?>>|____|<?=$val1->cat_name?></option>
                                        <?foreach($list2 as $val2):?>
                                        <option value="<?php echo $val2->cat_id?>" <?=($val2->cat_id == $rs->catid)?'selected="selected"':''?>>|____|____| <?=$val2->cat_name?></option>
                                        <?endforeach;?>
                                <?endforeach;?>
                            <?endforeach;?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="label">Nổi bật</td>
                    <td>
                        <input type="checkbox" name="noibat" <?=($rs->noibat == 1)?'checked="checked"':''?> value="1">Có
                    </td>
                </tr>
                <tr>
                    <td class="label">Hiển thị</td>
                    <td>
                        <input type="radio" name="data[published]" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'checked="checked"';?>>Có
                        <input type="radio" name="data[published]" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>> Không 
                    </td>
                </tr> 
        </table>
        <div class="b-introtext">
            <textarea style="width:99%;" rows="5" name="data[introtext]"><?php echo $rs->introtext?></textarea>
        </div>
        <div class="b-introtext">
            <?=vnit_editor($rs->fulltext,'fulltext','full')?>
        </div>
    </td>
    <td style="width: 300px;" valign="top">
            <div class="content-right">
                 <div class="img-hotel">
                    <?if($rs->images == ""){?>
                        <img src="<?=base_url()?>templates/images/img_news_no.png" alt="">
                    <?}else{?>
                        <img src="<?=base_url_site()?>data/hotel/200/<?=$rs->images?>" alt="">
                    <?}?>
                 </div>
                 <div align="center"><input type="checkbox" value="1" name="del">Xóa hình</div>
                 <div align="center"><input type="file" name="userfile"></div>
            </div>
            
        </td>
    </tr>
</table>

<?php echo form_close();?>
<script type="text/javascript">
$(".panel h3.title").click(function(){
    div_id = $(this).attr('id');
    content = div_id+"_content";
    $(".panel h3").removeClass("vpanel_arrow_down");
    $(".panel h3").addClass("vpanel_arrow");

    $(".panel_content").slideUp();
    if($("#"+content).css('display')=='none'){
        $("#"+content).slideDown();
        $(this).removeClass("vpanel_arrow");
        $(this).addClass("vpanel_arrow_down"); 
    }else{
        $("#"+content).slideUp();
    }
});
$(document).ready(function() { 
    $("#catid").change(function(){
        catid = $(this).val();
        $.getJSON(base_url + 'hotel/get_channel/?catid='+ catid, function(data){
            $("#channel_id").html(data.ds);
        });
    })
    //load_kenh(<?=$listhotel_chanel[0]->cat_id?>);
});
</script>
