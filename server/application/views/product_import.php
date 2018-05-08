<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>导入</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no" />
<!--    <link href="--><?php //echo base_url('assets/bootstrap/css/bootstrap.min.css');?><!--" rel="stylesheet" />-->
<!--    <link href="--><?php //echo base_url('assets/css/custom.css');?><!--" rel="stylesheet" />-->
    <script src="<?php echo base_url('application/js/jquery.js');?>"></script>
</head>
<body>
<div class="container-fluid">
    <input type="file" name="file" id="file" value="">
    <input type="button" class="btn btn-primary" value="上传" onclick="my_import_do()">
</div>
<div id="msg_show">
</div>
<script src="<?php echo base_url('application/js/ajaxfileupload.js');?>"></script>
<script type="text/javascript">
    function my_import_do(){
        var str = $("#file").val();
        if(str == '') return;
        var arr = new Array();
        arr = str.split(".");
        var file_type = arr[arr.length-1];
        if(file_type == 'xls' || file_type == 'xlsx'){
            my_import_up('file');
        }else{
            alert('文件格式不支持');
        }
    }
    //ajax提交
    function my_import_up(file){
        $.ajaxFileUpload
        (
            {
                url:"<?php echo site_url('cu/my_import_do');?>",
                secureuri:true,
                fileElementId:file,
                dataType: 'json',
                data:{},
                success: function (data, status){alert(1);
                    if(data){
                        $("#msg_show").html(data.msg);
                    }
                },
                error: function (data, status, e)
                {console.log(data);
                    if(data){
                        $("#msg_show").html(data.msg);
                    }
                    return false;
                }
            }
        )
        return false;
    }
</script>
</body>
</html>