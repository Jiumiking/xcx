/**
 * 表单验证
 * @autre   jinjunming
 * @date    2014/4/17
 */
(function($){
    //插件主入口
    $.fn.authen = function(options){
        var opts = $.extend({msg_id:'m_'+$(this).attr('id')}, $.fn.authen.defaults, options);
        var val = $(this).val();
        var mark = true;

        opts.msg = opts.err_name+opts.msg;
        switch( opts.type ){
            case 'func':
                var back = eval( opts.func+"('"+val+"')");
                if(back != true){
                    mark = false;
                    opts.msg = back;
                }
                break;
            case 'functions':
                var back = opts.functions(val);
                if(back != true){
                    mark = false;
                    opts.msg = back;
                }
                break;
            default:
                if(val.length < opts.min_length || val.length > opts.max_length){
                    mark = false;
                    opts.msg = opts.err_name+'需'+opts.min_length+'-'+opts.max_length+'个字符';
                }else{
                    if(opts.reg != ''){
                        if(typeof(opts.reg) == 'object'){
                            var formark = false;
                            for(var i=0;i<opts.reg.length;i++){
                                var reg = eval("regex_data."+opts.reg[i]);
                                if( undefined != reg ){
                                    if((new RegExp(reg, 'i')).test(val)){
                                        if( undefined != opts.ajax_url ){
                                            if(ajax_authen(val,opts.ajax_url)){
                                                formark = true;
                                            }else{
                                                opts.msg = opts.err_name+'已存在';
                                            }
                                        }else{
                                            formark = true;
                                        }
                                    }
                                }
                            }
                            mark = formark;
                        }else{
                            switch( opts.reg ){
                                case 'password2':
                                    opts.msg = '两次输入密码不相同';
                                    if( undefined != $("#"+opts.pwd_id).val() && $("#"+opts.pwd_id).val() == val ){
                                        mark = true;
                                    }else{
                                        mark = false;
                                    }
                                    break;
                                default:
                                    var reg = eval("regex_data."+opts.reg);
                                    if( undefined != reg ){
                                        if((new RegExp(reg, 'i')).test(val)){
                                            if( undefined != opts.ajax_url ){
                                                if(!ajax_authen(val,opts.ajax_url)){
                                                    mark = false;
                                                    opts.msg = opts.err_name+'已存在';
                                                }
                                            }
                                        }else{
                                            mark = false;
                                        }
                                    }
                                    break;
                            }
                        }
                    }
                }
        }
        if(val == ''){
            if(opts.empty == false){
                opts.msg = opts.err_name+'必填';
                mark = false;
            }else{
                mark = true;
            }
        }
        if( opts.must_one != '' ){
            if( undefined != $("#"+opts.must_one).val() && $("#"+opts.must_one).val() == '' && val == ''){
                opts.msg = opts.err_name+'和'+opts.must_one_name+'必须填一项';
                if(opts.must_one_name == ''){
                    opts.msg = opts.err_name+'不能为空';
                }
                mark = false;
            }
        }
        if( opts.must_by != '' ){
            if( undefined != $("#"+opts.must_by).val() && $("#"+opts.must_by).val() != '' && val == ''){
                opts.msg = '请选择'+opts.err_name;
                mark = false;
            }
        }
        if(opts.min != '' && val < opts.min){
            mark = false;
            opts.msg = opts.err_name+'不得小于'+opts.min;
        }
        if(opts.max != '' && val > opts.max){
            mark = false;
            opts.msg = opts.err_name+'不得大于'+opts.max;
        }
        if( opts.except != '' ){
            if( val == opts.except ){
                mark = true;
            }
        }
        if( mark ){
            $('#'+opts.msg_id).html('');
            return true;
        }else{
            $('#'+opts.msg_id).html(opts.msg);
            return false;
        }
    }
    //ajax验证是否已存在
    function ajax_authen(val,url){
        if( undefined == val || undefined == url ){
            return false;
        }
        var mark = false;
        $.ajax({
            type : "GET",
            async : false,
            url : url,
            data : { value:val },
            success : function(msg){
                if(msg == 1){
                    mark = true;
                }
            }
        });
        return mark;
    }
    //默认配置
    $.fn.authen.defaults = {
        type : 'text',
        reg : '',
        empty : true,
        msg : '输入有误',
        err_name : '该项',
        min_length : 0,
        max_length : 500,
        min : '',
        max : '',
        func : '',
        functions : '',
        must_one : '',
        must_one_name : '',
        must_by : '',
        must_by_name : '',
        except : ''
    }
    //验证正则表达式库
    var regex_data = 
    {
        intege:"^-?[1-9]\\d*$",					//整数
        intege1:"^[1-9]\\d*$",					//正整数
        intege2:"^-[1-9]\\d*$",					//负整数
        num:"^([+-]?)\\d*\\.?\\d+$",			//数字
        num1:"^[1-9]\\d*|0$",					//正数（正整数 + 0）
        num2:"^-[1-9]\\d*|0$",					//负数（负整数 + 0）
        decmal:"^([+-]?)\\d*\\.\\d+$",			//浮点数
        decmal1:"^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$",　　	//正浮点数
        decmal2:"^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$",　 //负浮点数
        decmal3:"^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$",　 //浮点数
        decmal4:"^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$",　　 //非负浮点数（正浮点数 + 0）
        decmal5:"^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$",　　//非正浮点数（负浮点数 + 0）

        email:"^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$", //邮件
        color:"^[a-fA-F0-9]{6}$",				//颜色
        url:"^(http[s]?:\\/\\/)?([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$",	//url
        chinese:"^[\\u4E00-\\u9FA5\\uF900-\\uFA2D]+$",					//仅中文
        ascii:"^[\\x00-\\xFF]+$",				//仅ACSII字符
        zipcode:"^\\d{6}$",						//邮编
        mobile:"^1[3|4|5|8][0-9]\\d{8}$",				//手机/^1[3|4|5|8][0-9]\d{4,8}$/
        ip4:"^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$",	//ip地址
        notempty:"^\\S+$",						//非空
        picture:"(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$",	//图片
        rar:"(.*)\\.(rar|zip|7zip|tgz)$",								//压缩文件
        date:"^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$",					//日期
        qq:"^[1-9]*[1-9][0-9]*$",				//QQ号码
        tel:"^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?$",	//电话号码的函数(包括验证国内区号,国际区号,分机号)
        username:"^\\w+$",						//用来用户注册。匹配由数字、26个英文字母或者下划线组成的字符串
		password:"^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]+$",
        letter:"^[A-Za-z]+$",					//字母
        letter_u:"^[A-Z]+$",					//大写字母
        letter_l:"^[a-z]+$",					//小写字母
        idcard:"^[1-9]([0-9]{14}|[0-9]{17})$",	//身份证
        nickname:"^[\\u4E00-\\u9FA5\\uF900-\\uFA2D\\w\\.\\s]+$",
        bankid:"^[0-9]{19}$"
    }
    var aCity={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"} 

    function is_card_id(sId){
        var iSum=0 ;
        var info="" ;
        if(!/^\d{17}(\d|x)$/i.test(sId)) return "你输入的身份证长度或格式错误"; 
        sId=sId.replace(/x$/i,"a"); 
        if(aCity[parseInt(sId.substr(0,2))]==null) return "你的身份证地区非法"; 
        sBirthday=sId.substr(6,4)+"-"+Number(sId.substr(10,2))+"-"+Number(sId.substr(12,2)); 
        var d=new Date(sBirthday.replace(/-/g,"/")) ;
        if(sBirthday!=(d.getFullYear()+"-"+ (d.getMonth()+1) + "-" + d.getDate()))return "身份证上的出生日期非法"; 
        for(var i = 17;i>=0;i --) iSum += (Math.pow(2,i) % 11) * parseInt(sId.charAt(17 - i),11) ;
        if(iSum%11!=1) return "你输入的身份证号非法"; 
        return true;//aCity[parseInt(sId.substr(0,2))]+","+sBirthday+","+(sId.substr(16,1)%2?"男":"女") 
    }
})(jQuery)