$(document).ready(function() {
   
   
    $("#nl").change(function(){
        var qty = $(this).val();
        var tn = $("#trnho").val();
        var id = $("#tour_id").val();
        $.get(base_url+"tour/tour_price/?qty="+qty+"&tn="+tn+"&id="+id ,function(data){
            $("#total_payment").html(data.price);
        },'json');        
    })
    
    $("#trnho").change(function(){
        var tn = $(this).val();
        var qty = $("#nl").val();
        var id = $("#tour_id").val();
        $.get(base_url+"tour/tour_price/?qty="+qty+"&tn="+tn+"&id="+id ,function(data){
            $("#total_payment").html(data.price);
        },'json');
    })
    
    $("#book_tour").validate({
        errorElement: "div",
        ignore: "",
        rules: {
            'fullname': {required :true},
            'address': {required :true},
            'phone': {required :true},
            'email': {required :true,email:true},
            'datepicker': {required :true}  ,
            'adults': {required :true,min:1}
        },
        messages: {
            'fullname': {required : "Vui lòng nhập Họ tên"},
            'address': {required : "Vui lòng nhập Địa chỉ"},
            'phone': {required : "Vui lòng nhập Điện thoại"},
            'email': {required : "Vui lòng nhập Email", email: "Email nhập không đúng định dạng"},
            'datepicker': {required :"Chọn ngày đi"} , 
            'adults': {required :"Chọn số người lớn",min:"Người lớn tối thiểu phải = 1"}  
        },
        submitHandler: function(form) {
            var pay = $("input[name='pay']:checked").val();
            var b_day = $("select[name='day']").val();
            var b_month = $("select[name='month']").val();
            var b_year = $("select[name='year']").val();
            var  book_date = strtotime(parseInt(b_year)+'/'+parseInt(b_month)+'/'+parseInt(b_day));
            if(time_int_now < book_date){
                var error = 0;
                $(".validation").each(function(){
                    if($(this).val() == ''){
                        error ++;
                        $(this).addClass('error');
                    }
                })
                if(error > 0){
                    jAlert("Vui lòng nhập đầy đủ Họ tên, Ngày sinh của hành khách");    
                }else{
                    form.submit();
                }
            }else{
                jAlert("Vui lòng chọn ngày đi lớn hơn ngày hiện tại");
                return false;
            }
            
        }
    });
    
    $("input[name='bank_name']").keyup(function(){
        if($(this).val().length > 0){
            $("#bank_name").html('').hide();
        }else{
            $("#bank_name").html(str_bank_name).show();            
        }
    })
    
    $("input[name='pay_name']").keyup(function(){
        if($(this).val().length > 0){
            $("#pay_name").html('').hide();
        }else{
            $("#pay_name").html(str_pay_name).show();            
        }
    })
    
    $("input[name='pay_number']").keyup(function(){
        if($(this).val().length > 0){
            $("#pay_number").html('').hide();
        }else{
            $("#pay_number").html(str_pay_number).show();
        }
    })
    
    $(".type_pay").click(function(){
        var id = $(this).val();
        if(id == 1){
            $(".pay_online").hide();
        }else{
            $(".pay_online").show();
        }
    })
    
    $(".flip").click(function() {
        var payment = $(this).attr('payment');
        $('.panel').hide('slow');
        $('.arrawhttt').removeClass('tickArrowhttt').addClass('downArrowhttt');
        if ($(this).hasClass('activehttt')) {
            $(this).removeClass('activehttt');
        } else {
            $('.activehttt').removeClass('activehttt');
            $(this).addClass('activehttt');
            $(this).find('.arrawhttt').removeClass('downArrowhttt').addClass('tickArrowhttt');
            $("#index" + $(this).attr('index')).show("slow");
        }
        $("#payment_id").val(payment);
    });
    //$(".datepicker").click(function(){
//        $(".datepicker").datepicker({
//                changeMonth: true,
//                changeYear: true,
//                dateFormat: 'dd-mm-yy', 
//                numberOfMonths: 1,
//                yearRange: '1920:2014'
//        });    
    ///})
//    $(".validation").live('keyup',function(){
//        if($(this).val() != ''){
//            $(this).removeClass('error');
//        }
//    })
    
    // Thong tin khach hang dat tour
    /*
    $("#nl").change(function(){
        var total = $(this).val();
        var total_old = $("#list_adults .item").length;
        if(total > total_old){
            var html = '';
            k = total_old;
            for(i = total_old; i < total; i++){
                k++;
            html +='<tr class="item" id="row_'+k+'">';
                html +='<td><b>'+k+'</b></td>';
                html +='<td><input type="text" name="ar_name_nl[]" class="validation" placeholder="Họ và tên"></td>';
                html +='<td><input type="text" name="ar_date_nl[]" class="datepicker validation" placeholder="Ngày sinh"></td>';
            html +='</tr>';                
            }
            $("#list_adults tbody").append(html);
        }else{
            for(i = total_old; i > total; i--){
               $("#list_adults #row_"+i).remove();
            }
        }
        $(".datepicker").datepicker({
               changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy', 
                numberOfMonths: 1,
                yearRange: '1920:2014'
        }); 
    })
    
    $("#trnho").change(function(){
        var total = $(this).val();
        if(total > 0){
            var total_old = $("#list_children .item").length;
            if(total > total_old){
                var html = '';
                k = total_old;
                for(i = total_old; i < total; i++){
                    k++;
                html +='<tr class="item" id="row_'+k+'">';
                    html +='<td><b>'+k+'</b></td>';
                    html +='<td><input type="text" name="ar_name_te[]" class="validation" placeholder="Họ và tên"></td>';
                    html +='<td><input type="text" name="ar_date_te[]" class="datepicker validation" placeholder="Ngày sinh"></td>';
                html +='</tr>';                
                }
                $("#list_children tbody").append(html);
            }else{
                for(i = total_old; i > total; i--){
                   $("#list_children #row_"+i).remove();
                }
            }
            $("#list_children").show();
        }else{
            $("#list_children").hide();
        }
        $(".datepicker").datepicker({
               changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy', 
                numberOfMonths: 1,
                yearRange: '1920:2014'
        }); 
    })    
    
    $("#baby").change(function(){
        var total = $(this).val();
        if(total > 0){
            var total_old = $("#list_baby .item").length;
            if(total > total_old){
                var html = '';
                k = total_old;
                for(i = total_old; i < total; i++){
                    k++;
                html +='<tr class="item" id="row_'+k+'">';
                    html +='<td><b>'+k+'</b></td>';
                    html +='<td><input type="text" name="ar_name_eb[]" class="validation" placeholder="Họ và tên"></td>';
                    html +='<td><input type="text" name="ar_date_eb[]" class="datepicker validation" placeholder="Ngày sinh"></td>';
                html +='</tr>';                
                }
                $("#list_baby tbody").append(html);
            }else{
                for(i = total_old; i > total; i--){
                   $("#list_baby #row_"+i).remove();
                }
            }
            $("#list_baby").show();
        }else{
            $("#list_baby").hide();
        }
        $(".datepicker").datepicker({
               changeMonth: true,
                changeYear: true,
                dateFormat: 'dd-mm-yy', 
                numberOfMonths: 1,
                yearRange: '1920:2014'
        }); 
    }) 
     */
});
    
function strtotime(text, now) {
  // Convert string representation of date and time to a timestamp  
  // 
  // version: 1109.2015
  // discuss at: http://phpjs.org/functions/strtotime
  // +   original by: Caio Ariede (http://caioariede.com)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: David
  // +   improved by: Caio Ariede (http://caioariede.com)
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Wagner B. Soares
  // +   bugfixed by: Artur Tchernychev
  // +   improved by: A. MatÃ­as Quezada (http://amatiasq.com)
  // %        note 1: Examples all have a fixed timestamp to prevent tests to fail because of variable time(zones)
  // *     example 1: strtotime('+1 day', 1129633200);
  // *     returns 1: 1129719600
  // *     example 2: strtotime('+1 week 2 days 4 hours 2 seconds', 1129633200);
  // *     returns 2: 1130425202
  // *     example 3: strtotime('last month', 1129633200);
  // *     returns 3: 1127041200
  // *     example 4: strtotime('2009-05-04 08:30:00');
  // *     returns 4: 1241418600
  if (!text)
      return null;

  // Unecessary spaces
  text = text.trim()
      .replace(/\s{2,}/g, ' ')
      .replace(/[\t\r\n]/g, '')
      .toLowerCase();

  var parsed;

  if (text === 'now')
      return now === null || isNaN(now) ? new Date().getTime() / 1000 | 0 : now | 0;
  else if (!isNaN(parse = Date.parse(text)))
      return parse / 1000 | 0;
  if (text == 'now')
      return new Date().getTime() / 1000; // Return seconds, not milli-seconds
  else if (!isNaN(parsed = Date.parse(text)))
      return parsed / 1000;

  var match = text.match(/^(\d{2,4})-(\d{2})-(\d{2})(?:\s(\d{1,2}):(\d{2})(?::\d{2})?)?(?:\.(\d+)?)?$/);
  if (match) {
      var year = match[1] >= 0 && match[1] <= 69 ? +match[1] + 2000 : match[1];
      return new Date(year, parseInt(match[2], 10) - 1, match[3],
          match[4] || 0, match[5] || 0, match[6] || 0, match[7] || 0) / 1000;
  }

  var date = now ? new Date(now * 1000) : new Date();
  var days = {
      'sun': 0,
      'mon': 1,
      'tue': 2,
      'wed': 3,
      'thu': 4,
      'fri': 5,
      'sat': 6
  };
  var ranges = {
      'yea': 'FullYear',
      'mon': 'Month',
      'day': 'Date',
      'hou': 'Hours',
      'min': 'Minutes',
      'sec': 'Seconds'
  };

  function lastNext(type, range, modifier) {
      var day = days[range];

      if (typeof(day) !== 'undefined') {
          var diff = day - date.getDay();

          if (diff === 0)
              diff = 7 * modifier;
          else if (diff > 0 && type === 'last')
              diff -= 7;
          else if (diff < 0 && type === 'next')
              diff += 7;

          date.setDate(date.getDate() + diff);
      }
  }
}