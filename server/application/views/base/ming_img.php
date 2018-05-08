<div class="panel panel-default">
    <div class="panel-heading">
        <h2><i class="fa fa-list red"></i><span class="break"></span></h2>
        <ul class="nav tab-menu nav-tabs">
            <li class="active"><a data-toggle="tab" href="#img_upload">本地上传</a></li>
            <li class=""><a data-toggle="tab" href="#img_manage">在线管理</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane active" id="img_upload">
                <button type="button" class="btn btn-success btn-sm" onclick="mingImgAdd();">
                   选择图片
                </button>
                <button type="button" class="btn btn-success btn-sm" onclick="mingImgUp();">
                   上传
                </button>
                <input id="mingImgFile" type="file" name="file" class="hide" multiple="multiple" onchange="mingImgFile(this)">
                <div class="row" id="img_upload_show">
                    
                </div>
            </div>
            <div class="tab-pane" id="img_manage">
                <div class="row">
                    <?php if(!empty($list)){ foreach($list as $k=>$v){?>
                    <div class="col-md-2 col-sm-3 col-xs-4 img-item" onclick="mingImgCheck(this)">
                        <img class="img-thumbnail" src="<?php echo $v['url'];?>" data="<?php echo $v['url'];?>">
                        <span class="glyphicon icon"></span>
                    </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>