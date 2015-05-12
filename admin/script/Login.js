// JavaScript Document

$(document).ready(function () {
    $('#btn_login').click(function () {
        var data = {};
        data.action = "login";
        data.userName = $('#txt_Account').val();
        data.password = $('#txt_Pass').val();
        
        console.log("action: "+data.action +"| userName: "+data.userName+"| password: "+data.password);

        $.ajax({
            type: "POST",
            url: "control/UserManagement.php",
            data: "action="+data.action+"&userName="+data.userName+"&password="+data.password,
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Failure: ' + textStatus + ". Error thrown: " + errorThrown);
                alert('Failure: ' + textStatus + ". Error thrown: " + errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                if( data === 'success')
                {
                    $('#form_login .alert-success').removeClass("hidden").fadeIn(600);
                    setTimeout(function(){
                        location.href = "index.php";
                    }, 1500);
                    
                }else
                {
                    $('#form_login .alert-danger').removeClass("hidden").fadeIn(600).fadeOut(400).fadeIn(600);
                    setTimeout(function(){
                        $('#form_login .alert-danger').addClass("hidden");
                    }, 1000);
                }
                
            }
        });
    });
    
    $('#btn_logout').click(function(){
        var action = "logout";
        $.ajax({
            type: 'POST',
            url: "control/UserManagement.php",
            data: "action="+action,
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Failure: "+textStatus+" error thrown: "+errorThrown);
            },
            success: function (data, textStatus, jqXHR) {
                alert("đăng xuất thành côngv \n --> bắt đầu chuyển hướng");
                setTimeout(function(){
                    location.href = "Login.php";
                }, 500);
            }
        });
    });
    
    $('#txt_Account').keydown(function(e){
        if(e.keyCode == 13){
            $('#btn_login').click();
        }
    });
    
    $('#txt_Pass').keydown(function(e){
        if(e.keyCode == 13){
            $('#btn_login').click();
        }
    });
});