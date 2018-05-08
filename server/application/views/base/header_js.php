<script type="text/javascript">
$(document).ready(function(){
    $("#base_web").click(function(){
        var url = "<?php echo $this->config->item('base_web');?>";
        if( url != '' ){
            window.location.href= "<?php echo $this->config->item('base_web');?>";
        }
    });
});
//修改密码
function change_user_pwd(id){
    if( id == '' ){
        return false;
    }
    $("#user_id_checked").val(id);
    $.ajax({
        type : "GET",
        async : true,
        url : "<?php echo site_url('user/change_pwd');?>",
        data : { id:id },
        success : function(msg){
            if(msg){
                var msgobj = eval("("+ msg +")");
                if(msgobj.sta == '1'){
                    $('#div_show').html(msgobj.dat);
                    $('#div_show').show();
                    $('#div_content').hide();
                }
                ming_alert(msgobj.msg,msgobj.sta);
            }
        }
    });
}
//修改密码
function change_user_pwd_do(){
    var id = $('#user_id_checked').val();
    var pwd_o = $("#pwd_o").val();
    var pwd_n = $("#pwd_n").val();
    var pwd_n2 = $("#pwd_n2").val();

    var pwd_o_c = true;
    if(pwd_o != undefined){
        pwd_o_c = $("#pwd_o").authen({ //密码验证
            type:'functions',
            functions:function(val){
                var mark = false;
                $.ajax({
                    type : "GET",
                    async : false,
                    url : "<?php echo site_url('user/is_pwd');?>",
                    data : { id:id, pwd:pwd_o },
                    success : function(msg){
                        var msgobj = eval("("+ msg +")");
                        if(msgobj.sta == '1'){
                            mark = true;
                        }
                    }
                });
                if(!mark){
                    return '密码错误';
                }
                return true;
            },
            err_name:'原密码',
            empty:false
        });
    }
    
    var pwd_n_c = $("#pwd_n").authen({reg:'password',err_name:'密码',min_length:6,max_length:20,empty:false});
    var pwd_n2_c = $("#pwd_n2").authen({reg:'password2',pwd_id:'pwd_n',empty:false});
    if( pwd_o_c && pwd_n_c && pwd_n2_c){
        $.ajax({
            type : "GET",
            async : true,
            url : "<?php echo site_url('user/change_pwd_do');?>",
            data : { id:id,pwd:pwd_n },
            success : function(msg){
                var msgobj = eval("("+ msg +")");
                ming_alert(msgobj.msg,msgobj.sta);
            }
        });
    }
}
//返回
function back(){
    $('#div_show').hide();
    $('#div_content').show();
}

//图片管理
function mingImg(){
    $.ajax({
        type : "GET",
        async : true,
        url : "<?php echo site_url('image/mi_list');?>",
        data : {},
        success : function(msg){
            var msgobj = eval("("+ msg +")");
            if(msgobj.sta == '1'){
                $('#myModal .modal-body').html(msgobj.dat);
            }
        }
    });
    $('#myModal').modal({
        backdrop:false
    });
    $('#myModalTitle').html('图片管理');
    $('#myModal').modal('show');
}
//图片选择操作
function mingImgCheck(obj){
    var has = $(obj).hasClass('selected');
    if(has){
        $(obj).removeClass('selected');
    }else{
        $(obj).addClass('selected');
    }
}
//图片选择后的显示
function mingImgShow(src){
    return '<div class="col-md-2 col-sm-3 col-xs-4 img-item" ><img class="img-thumbnail" src="'+src+'" alt="Sample Image"></div>';
}
//选择图片按钮
function mingImgAdd(){
    $("#mingImgFile").click();
}
//新增上传
function mingImgFile(obj){
    var filelist = document.getElementById("mingImgFile").files;
    for(var i=0;i<filelist.length;i++){
        if (filelist[i]) {
            var reader = new FileReader();
            reader.readAsDataURL(filelist[i]);
            reader.onload = function (e) {
                var urlData = this.result;
                $("#img_upload_show").append('<div class="col-md-2 col-sm-3 col-xs-4 img-item"><img class="img-thumbnail" src="'+urlData+'" alt=""><span class="fa icon"></span></div>');
            };
        }
    }
    
}
//上传
function mingImgUp(){
    $("#img_upload_show").find("img").each(function(){
        var img = $(this).attr('src');
        var _this = this;
        if( !$(_this).parent().hasClass('selected') ){
            $.ajax({
                type : "POST",
                async : true,
                url : "<?php echo site_url('image/mi_up');?>",
                data : {img:img},
                success : function(msg){
                    var msgobj = eval("("+ msg +")");
                    if(msgobj.sta == '1'){
                        $(_this).attr('data',msgobj.dat.url);
                        $(_this).parent().addClass('selected');
                    }
                }
            });
        }
    });
    
}
//modal提交按钮
function myModalBtn(){
    if($("#img_upload").hasClass('active')){
        var id='img_upload';
    }else{
        var id='img_manage';
    }
    var html = '';
    $("#"+id).find(".img-item.selected").each(function(){
        html += mingImgShow($(this).children("img").first().attr('data'));
    });
    $("#img_show").append(html);
    //$("#img_show").html(html);
    $('#myModal').modal('hide');
}
/**ming提示框
 * @param msg 提示信息
 * @param type 提示类型 1：正确提示，0：错误提示
 * @returns {boolean}
 */
var ming_alert_cnt = 1;
function ming_alert( msg, type ){
    if( typeof(msg) == 'undefined' ){
        return false;
    }
    if( typeof(type) == 'undefined' ){
        type = 0;
    }
    if( type == 1 ){
        var msg = '<div id="ming_alert_box'+ming_alert_cnt+'" class="alert alert-dismissable alert-success "><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li class="fa fa-check-circle"></li><span>'+msg+'</span></div>';
    }else{
        var msg = '<div id="ming_alert_box'+ming_alert_cnt+'" class="alert alert-dismissable alert-danger "><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><li class="fa fa-exclamation-circle"></li><span>'+msg+'</span></div>';
    }
    $("#ming_alert").append(msg);
    setTimeout('ming_alert_hide('+ming_alert_cnt+');',3000);
    ming_alert_cnt++;
}
function ming_alert_hide(cnt){
    $("#ming_alert_box"+cnt).fadeOut(3000);
}
</script>