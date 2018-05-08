<div class="panel panel-default">
    <div class="panel-heading">
        <h2>导入</h2>
    </div>
    <div class="panel-body">
        <h5>步骤一：下载模板</h5>
        <a class="btn btn-primary" href="<?php echo site_url('product/my_import_template');?>" >下载模板</a>
        <h5>步骤二：填写内容</h5>
        <h5>步骤三：上传</h5>
        <input type="file" name="file" id="file" value="">
        <input type="button" class="btn btn-primary" value="上传" onclick="my_import_do()">
    </div>
    <div class="panel-footer">
        <input type="button" class="btn btn-sm btn-danger" value="返回" onclick="back()">
    </div>
</div>