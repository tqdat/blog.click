<?php echo form_open_multipart(uri_string(), array('id'=>'admindata'));?>
<input type="hidden" name="id" value="<?=$rs->id?>">
<div class="col-md-8">
    <div class="box box-warning">
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" name="data[title]" value="<?php echo $rs->title?>"/>
                </div>
                <div class="form-group">
                    <label>Link hiện tại</label>
                    <input type="text" class="form-control" name="data[slug]" value="<?php echo $rs->slug?>"/>
                </div>
                <div class="form-group">
                    <label>Chủ đề</label>
                    <select class="form-control" id="catid" name="data[catid]">
                        <?  foreach($listcategory as $val):
                        $list1 = $this->news->get_all_category($val->cat_id);
                        ?>
                        <option value="<?php echo $val->cat_id?>" <?=($val->cat_id == set_value('data[catid]'))?'selected="selected"':''?>><?=$val->cat_name?></option>
                        <?  foreach($list1 as $val1):
                        $list2 = $this->news->get_all_category($val1->cat_id);
                        ?>
                        <option value="<?php echo $val1->cat_id?>" <?=($val1->cat_id == set_value('data[catid]'))?'selected="selected"':''?>>|____|<?=$val1->cat_name?></option>
                        <?  foreach($list2 as $val2):?>
                            <option value="<?php echo $val2->cat_id?>" <?=($val2->cat_id == set_value('data[catid]'))?'selected="selected"':''?>>|____|____| <?=$val2->cat_name?></option>
                        <?  endforeach;?>
                        <?endforeach;?>
                        <?endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nổi bật  </label>
                    <input type="checkbox"  name="noibat" <?=($rs->noibat == 1)?'checked="checked"':''?> value="1">Có
                </div>
                <div class="form-group">
                    <label>Hiển thị</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[published]" value="1" <?php echo ($rs->published == 1)?'checked="checked"':'checked="checked"';?>>Có
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[published]" value="0" <?php echo ($rs->published == 0)?'checked="checked"':'';?>> Không 
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <div class='box-body pad'>
                        <form>
                            <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $rs->introtext?></textarea>
                        </form>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <?=vnit_editor(set_value('fulltext'),'fulltext','full')?>
                </div> -->
                <div class="form-group">
                    <label>Hình đại diện</label>
                    <?if($rs->images == ""){?>
                    <img src="<?=base_url()?>templates/images/img_news_no.png" alt="">
                    <?}else{?>
                    <img src="<?=base_url_site()?>data/news/200/<?=$rs->images?>" alt="">
                    <?}?>
                    <input type="checkbox" name="del" value="1"><span>Xóa Hình </span>  
                    <input type="file" name="userfile">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Thông tin Metadata</h3>
        </div>
        <div class="box-body">
            <table>
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

            <div class="box-header">
                <h3 class="box-title">Các thông số - bài viết</h3>
            </div>
            <div class="box-body">
                <table>
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
            <div class="box-body">
                <div class="panel">
                    <h3 id="meta" class="title vpanel_arrow" ><span>Thông tin Metadata</span></h3>
                    <div class="panel_content" id="meta_content">
                        <table style="width: 100%;">
                            <tr>
                                <td class="_key" ">Miêu tả</td>
                                <td class="_value">
                                    <textarea rows="5" style="width: 95%;" name="data[metadesc]"><?=set_value('data[metadesc]')?><?=$rs->metadesc?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="_key">Từ khóa</td>
                                <td class="_value">
                                    <textarea rows="5" style="width: 95%;" name="data[metakey]"><?=set_value('data[metakey]')?><?=$rs->metakey?></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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