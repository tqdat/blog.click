// Load Form Lost Pass
function forgot_pass(){
    $("#login-form").slideUp();
    $("#forgot-pass").slideDown();
}
function form_login(){
    $("#forgot-pass").slideUp();
    $("#login-form").slideDown();
}
function send_pass(){
    var email = $("#email").val();
    if(!checkEmail(email) || email ==''){
        jAlert('Vui lòng nhập đúng địa chỉ Email','Thông báo');
    }else{
        $.post(base_url+"home/sendpass/",{'email':email},function(data)
        {
               if(data.error == 0){
                   $("#email").val('Địa chỉ Email');
                   form_login(); 
               }               
               jAlert(data.msg,'Thông báo');                             
        },'json');     
    }
}

function checkEmail(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        return true
    }else{
        return false;
    }
}