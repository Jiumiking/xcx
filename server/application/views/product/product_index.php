<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('base/header'); ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-search">
            <select name="filter">
                <option value="number">产品编号</option>
                <option value="name">产品名称</option>
                <option value="material">产品材质</option>
                <option value="format">产品规格</option>
                <option value="face">表面处理</option>
                <option value="price">建议售价</option>
            </select>
            <input type="text" name="value" value="">&nbsp;&nbsp;
            <select name="isOnline">
                <option value="">允许网上销售</option>
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
            <button type="button" class="btn btn-success btn-sm" onclick="edit('')">新增</button>
            <button type="button" class="btn btn-success btn-sm" onclick="my_import()">导入</button>
            <button type="button" class="btn btn-primary btn-sm" name="search">搜索</button>
        </div>
        <table class="table table-bordered table-striped table-condensed table-hover">
            <thead>
                <tr>
                    <th>产品编号</th>
                    <th>产品名称</th>
                    <th>产品材质</th>
                    <th>产品规格</th>
                    <th>表面处理</th>
                    <th>建议售价</th>
                    <th>允许网上销售</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="list_content">
                <?php $this->load->view($this_controller.'/'.$this_controller.'_tb'); ?>
            </tbody>
        </table>
        <div>
            当前<input type="text" class="page-input" onkeypress="pagelist.changePage(event,this)" id="pg_page" maxlength="10" value="1"/>页,
            共<span id="pg_page_count"><?php echo $pages['page_count']?></span>页，
            <span id="pg_count"><?php echo $pages['count']?></span>条记录
            <a href="javascript:pagelist.lastPage();">上一页</a>
            <a href="javascript:pagelist.nextPage();">下一页</a>
        </div>
    </div>
</div>
<?php $this->load->view('base/list_js'); ?>
<script type="text/javascript">
//编辑验证函数
function edit_authen(){
    var number = $("#number").authen({err_name:'产品编号',empty:false});
    var name = $("#name").authen({err_name:'产品名称',empty:false});
    var material = $("#material").authen({err_name:'产品材质',empty:false});
    var format = $("#format").authen({err_name:'产品规格',empty:false});
    var price = $("#price").authen({err_name:'建议售价',reg:['decmal4','num1'],empty:false});
    var back = number && name && material && format && price;
    return back;
}
//导入
function my_import(){
    $.ajax({
        type : "GET",
        async : true,
        url : "<?php echo site_url($this_controller.'/my_import');?>",
        data : {},
        success : function(msg){
            if(msg){
                var msgobj = eval("("+ msg +")");
                if(msgobj.sta == '1'){
                    $('#div_show').html(msgobj.dat);
                    $('#div_show').show();
                    $('#div_content').hide();
                }else{
                    ming_alert(msgobj.msg,msgobj.sta);
                }
            }
        }
    });
}
function my_import_do(){
    var str = $("#file").val();
    if(str == '') return;
    var arr = new Array();
    arr = str.split(".");
    var file_type = arr[arr.length-1];
    if(file_type == 'xls' || file_type == 'xlsx'){
        my_import_up('file');
    }else{
        ming_alert('文件格式不支持');
    }
}
//ajax提交
function my_import_up(file){
    $.ajaxFileUpload
    (
        {
            url:"<?php echo site_url($this_controller.'/my_import_do');?>",
            secureuri:true,
            fileElementId:file,
            dataType: 'json',
            data:{},
            success: function (data, status){
                if(data){
                    ming_alert(data.msg,1);
                    pagelist.loadPage();
                    back();
                }
            },
            error: function (data, status, e)
            {
                if(data){
                    ming_alert(data.msg);
                }
                return false;
            }
        }
    )
    return false;
}
$(document).ready(function(){
    //搜索
    $("[name='search']").click(function(){
        var filter = $("[name='filter']").val();
        var value = $("[name='value']").val();

        pagelist.filter['number'] = undefined;
        pagelist.filter['name'] = undefined;
        pagelist.filter['material'] = undefined;
        pagelist.filter['format'] = undefined;
        pagelist.filter['face'] = undefined;
        pagelist.filter['price'] = undefined;
        pagelist.filter[filter] = value;
        pagelist.filter['isOnline'] = $("[name='isOnline']").val();
        pagelist.loadPage();
    });
});
</script>
<?php $this->load->view('base/footer'); ?>