<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo empty($this_setting['station_name'])?'':$this_setting['station_name']; ?></title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script src="<?php echo base_url('asset/js/jquery.js');?>"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('asset/css/bootstrap.min.css');?>" rel='stylesheet' type='text/css' />
    <!-- Login CSS -->
    <link href="<?php echo base_url('asset/css/login.css');?>" rel='stylesheet' type='text/css' />
    <script src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>
</head>
<body id="login" onkeydown="if(event.keyCode==13){login_submit();}">

    <div class="login-logo">
        <a href="#"><img src="<?php echo empty($this_setting['logo_name'])?'':$this->config->item('front_url').'/uploads/logo/'.$this_setting['logo_name'];?>" alt=""/></a>
    </div>
    <h2 class="form-heading">login</h2>
    <div class="app-cam">
        <form id="login_form" method="post" action="<?php echo site_url('sign/do_login');?>">
            <input id="user_name" name="user_name" type="text" class="text" value="" placeholder="用户名" maxlength="50">
            <input id="password" name="password" type="password" value="" placeholder="密码" maxlength="50">
            <div class="submit"><input type="button" onclick="login_submit();" onclick="myFunction()" value="登录"></div>
            <span id="message" class="error-block"><?php echo $msg;?></span>
        </form>
    </div>
<!--     <div class="copy_layout login"> -->
<!--         <p>Copyright &copy; 2016.Ming All rights reserved.</p> -->
<!--     </div> -->

<script type="text/javascript">
function login_submit(){
    var objMsg = document.getElementById("message");
    objMsg.innerHTML = "";
    if ( document.getElementById('user_name').value == '' ){
        objMsg.innerHTML = "请输入用户名!";
        return false;
    }
    if ( document.getElementById('password').value == '' ){
        objMsg.innerHTML = "请输入密码!";
        return false;
    }
    
    try {
        if ( document.getElementById("p_cap").style.display == 'block' ) {
            var vCode = document.getElementById('verification_code').value;
            if ( vCode == '' ){
                objMsg.innerHTML = "请输入验证码!";
                return false;
            }
            if( !check_captcha(vCode) ){
                objMsg.innerHTML = "验证码错误!";
                change_captcha();
                return false;
            }
        }
    } catch (e) {
    }
    $("#login_form").submit();
}
function change_captcha(){
    document.getElementById("cap").src = "<?php echo site_url('sign/get_captcha');?>";
}
function check_captcha(code){
    var mark = false;
    $.ajax({
        type : "GET",
        async : false,
        url : "<?php echo site_url('sign/check_captcha');?>",
        data : { code:code },
        success : function(msg){
            if(msg){
                if(msg == '1'){
                    mark = true;
                }
            }
        }
    });
    return mark;
}
</script>
</body>
</html>