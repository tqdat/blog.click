
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
                    <td class="label" style="width: 150px;">Link hiện tại</td>
                    <td><input type="text" name="data[slug]" value="<?php echo $rs->slug?>" style="width: 99%;"></td>
                </tr>
                <tr>
                    <td class="label">Chủ đề</td>
                    <td>
                        <select name="data[catid]" style="font-size: 12px;" id="catid" class="w300">
                            <?foreach($listcategory as $val):
                            $list1 = $this->news->get_all_category($val->cat_id);
                            ?>
                            <option value="<?php echo $val->cat_id?>" <?=($val->cat_id == $rs->catid)?'selected="selected"':''?>><?=$val->cat_name?></option>
                                <?foreach($list1 as $val1):
                                $list2 = $this->news->get_all_category($val1->cat_id);
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
                 <div class="img-news">
                    <?if($rs->images == ""){?>
                        <img src="<?=base_url()?>templates/images/img_news_no.png" alt="">
                    <?}else{?>
                        <img src="<?=base_url_site()?>data/news/200/<?=$rs->images?>" alt="">
                    <?}?>
                 </div>
                 <div align="center"><input type="checkbox" value="1" name="del">Xóa hình</div>
                 <div align="center"><input type="file" name="userfile"></div>
            </div>
            
            <div class="panel">
                <h3 id="infonews" class="title vpanel_arrow_down" ><span>Thông tin Metadata</span></h3>
                <div class="panel_content" id="infonews_content" style="display: block;">
                    <table style="width: 100%;">
                        <tr>
                            <td class="_key" style="width: 90px;">Trạng thái</td>
                            <td class="_value">
                                <?=($rs->published==1)?'Đã được bật':'Đã tắt'?>    
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Lần xem</td>
                            <td class="_value">
                                <?php echo $rs->hits?>    
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Đã tạo</td>
                            <td class="_value">
                                <input type="text" value="<?php echo date('H:i:s d-m-Y',$rs->created)?>">    
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Đã được sửa</td>
                            <td class="_value">
                                <input type="text" value="<?php if($rs->modified!=0){echo date('H:i:s d-m-Y',$rs->modified);}else{echo '';}?>">    
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel">
            <?
            /*function get_params($name,$params){
                parse_str($params, $output);
                return $output[$name];
            } */
            $show_intro = get_params('show_intro',$rs->attr);
            $show_author = get_params('show_author',$rs->attr);
            $show_date = get_params('show_date',$rs->attr);
            $show_editdate = get_params('show_editdate',$rs->attr);
            $show_print = get_params('show_print',$rs->attr);
            $show_email = get_params('show_email',$rs->attr);
            $show_comment = get_params('show_comment',$rs->attr);
            $show_other = get_params('show_other',$rs->attr);

            ?>
            
                <h3 id="info" class="title vpanel_arrow"><span>Các thông số - bài viết</span></h3>
                <div class="panel_content" id="info_content">
                    <table style="width: 100%;">
                        <tr>
                            <td class="_key">Phần mở đầu</td>
                            <td class="_value">
                                <select name="attr[show_intro]">
                                    <option value="2" <?=($show_intro==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_intro==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_intro==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Hiển thị tin liên quan</td>
                            <td class="_value">
                                <select name="attr[show_other]">
                                    <option value="2" <?=($show_other==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_other==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_other==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Tên tác giả</td>
                            <td class="_value">
                                <select name="attr[show_author]">
                                    <option value="2" <?=($show_author==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_author==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_author==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Ngày và giờ tạo</td>
                            <td class="_value">
                                <select name="attr[show_date]">
                                    <option value="2" <?=($show_date==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_date==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_date==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr>   
                        <tr>
                            <td class="_key">Ngày và giờ sửa</td>
                            <td class="_value">
                                <select name="attr[show_editdate]">
                                    <option value="2" <?=($show_editdate==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_editdate==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_editdate==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr> 
                        <tr>
                            <td class="_key">Biểu tượng In</td>
                            <td class="_value">
                                <select name="attr[show_print]">
                                    <option value="2" <?=($show_print==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_print==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_print==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr> 
                        <tr>
                            <td class="_key">Biểu tượng email</td>
                            <td class="_value">
                                <select name="attr[show_email]">
                                    <option value="2" <?=($show_email==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_email==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_email==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr>                                                                                                                                 <tr>
                            <td class="_key">Bình luận</td>
                            <td class="_value">
                                <select name="attr[show_comment]">
                                    <option value="2" <?=($show_comment==2)?'selected="selected"':''?>>Mặc định</option>
                                    <option value="1" <?=($show_comment==1)?'selected="selected"':''?>>Hiện</option>
                                    <option value="0" <?=($show_comment==0)?'selected="selected"':''?>>Ẩn</option>
                                </select>
                            </td>
                        </tr>                                      
                    </table>
                </div>
            </div>
            <div class="panel">
                <h3 id="meta" class="title vpanel_arrow" ><span>Thông tin Metadata</span></h3>
                <div class="panel_content" id="meta_content">
                    <table style="width: 100%;">
                        <tr>
                            <td class="_key" style="width: 70px;">Miêu tả</td>
                            <td class="_value">
                                <textarea rows="5" style="width: 95%;" name="data[metadesc]"><?=$rs->metadesc?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="_key">Từ khóa</td>
                            <td class="_value">
                                <textarea rows="5" style="width: 95%;" name="data[metakey]"><?=$rs->metakey?></textarea>
                            </td>
                        </tr>
                                  
                    </table>
                </div>
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
        $.getJSON(base_url + 'news/get_channel/?catid='+ catid, function(data){
            $("#channel_id").html(data.ds);
        });
    })
    //load_kenh(<?=$listcategory[0]->cat_id?>);
});
</script>
