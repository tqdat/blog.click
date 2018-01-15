/************************
* Date Created: 31/8/2012
*/

$(document).ready(function() {
    // Del Status Msg
    $(".del_smg").click(function(){
        $(this).parent().slideUp();
    });
    $(".htabs a").click(function(){
        var lang_id = $(this).attr('data_key');
        $(".htabs a").removeClass('selected');
        $(this).addClass('selected');
        $(".lang").hide();
        $("#"+lang_id).show();
    })
});
/*********
* Action checkbox Checked - Unchecked
*/
function setCheckboxes(the_form, id, do_check)
{
    var elts      = (typeof(document.forms[the_form].elements[id]) != 'undefined')
                  ? document.forms[the_form].elements[id]
                  : 0;
    var elts_cnt  = (typeof(elts.length) != 'undefined')
                  ? elts.length
                  : 0;

    if (elts_cnt) {
        for (var i = 0; i < elts_cnt; i++) {
            elts[i].checked = do_check;
            //$(elts[i].checked).parent('<span>').addClass().
        }
    } else {
        elts.checked        = do_check;
    }
return true; 
}

function check_chose(id, arid, the_form)
{
    var n = $('#'+id+':checked').val();
    if(n){
        setCheckboxes(the_form, arid, true);
        // Set Style Uifrom Checked 
        $("#"+the_form+" .checker span").addClass('checked');
        
    }else{
        setCheckboxes(the_form, arid, false);
        // Set Style Uifrom un Checked
        $("#"+the_form+" .checker span").removeClass('checked');
        
    }
}
/******************* END **************************/


/*******************
* Action Toolbar
*/
// Save
function action_save()
{
    $('#admindata').append('<input type="hidden" name="option" value="save">');
    $('#admindata').submit();
   return true;
}

// Apply
function action_apply()
{
    $('#admindata').append('<input type="hidden" name="option" value="apply">');
    $('#admindata').submit();
   return true;
}

// Status Published, Unpublished
function publish(table,field,id,status){
    $("#publish"+id).html('<image src="'+base_url+'templates/images/loading1.gif">');
    $.post(base_url+"api/publish",{'table':table,'field':field,'id':id,'status':status},function(data)
    {
        $("#publish"+id).html(data);                                               
    });     
}

// Delete All Record
function action_del()
{
    var res;
    var checked = $('input[type=checkbox]').is(':checked');
    if(!checked){
        jAlert('Vui lòng chọn một mục để xóa','Thông báo');
        return false;
    }else{    
        jConfirm('Bạn có chắc chắn muốn xóa  mục đã chọn.<br />Chọn <b>Đồng ý</b> hoặc <b>Không đồng ý</b>','Thông báo',function(r) {
          if(r){
              $('#admindata').submit();
          }
      });
        return false;
    }
}

// Del Item Recode
$(function() {   
    var link = '';
    $('.delete_record').click(function() {
        link = $(this).attr('href');
        if(link !=''){
            jConfirm('Bạn có chắc chắn muốn xóa mục đã chọn.<br />Chọn <b>Đồng ý</b> hoặc <b>Hủy bỏ</b>','Thông báo',function(r) {
                if(r){
                  window.location.href = link;
                }
            });           
        }
        return false;
    });
      
});
function load_show(){
    $("#bg_load, #loading").show();
}
function load_hide(){
    $("#bg_load, #loading").hide();
}

function ToNumber(nStr) {
    if (nStr != null && nStr != NaN) {
        var rgx = /[₫\s.]/;
        while (rgx.test(nStr)) {
            nStr = nStr.replace(rgx, '');
        }
        return eval(nStr) + 0;
    }
    return 0;

}

//formatCurrency
function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' +
    num.substring(num.length - (4 * i + 3));
    var currency = (((sign) ? '' : '-') + num);
    return currency;
}
/***************************END************************/
// Openr Images
function openKCFinder(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Đang tải ảnh...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                base_url_str = base_url.replace('http://'+document.domain,'');
                base_url_str = base_url_str.replace('admin/','');
                $("#news_img").val(url.replace(base_url_str,''));
                var img = document.getElementById('img');
                var o_w = img.offsetWidth;
                var o_h = img.offsetHeight;
                var f_w = div.offsetWidth;
                var f_h = div.offsetHeight;
                if ((o_w > f_w) || (o_h > f_h)) {
                    if ((f_w / f_h) > (o_w / o_h))
                        f_w = parseInt((o_w * f_h) / o_h);
                    else if ((f_w / f_h) < (o_w / o_h))
                        f_h = parseInt((o_h * f_w) / o_w);
                    //img.style.width = f_w + "px";
                    //img.style.height = f_h + "px";
                } else {
                   // f_w = o_w;
                   // f_h = o_h;
                }
                //img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                //img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };
    window.open(base_url+'templates/ckeditor/kcfinder/browse.php?type=images&dir=images/news',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}