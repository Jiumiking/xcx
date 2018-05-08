<div class="panel panel-default">
    <div class="panel-heading">
        <h2>编辑</h2>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo site_url($this_controller.'/my_edit_do');?>" method="post">
            <input type="hidden" name="id" value="<?php echo empty($data['id'])?'':$data['id']; ?>">
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">产品编号</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="number" id="number" value="<?php echo empty($data['number'])?'':$data['number']; ?>" placeholder="输入产品编号">
                    <span class="error-block" id="m_number"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">产品名称</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo empty($data['name'])?'':$data['name']; ?>" placeholder="输入产品名称">
                    <span class="error-block" id="m_name"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">产品材质</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="material" id="material" value="<?php echo empty($data['material'])?'':$data['material']; ?>" placeholder="输入产品材质">
                    <span class="error-block" id="m_material"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">产品规格</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="format" id="format" value="<?php echo empty($data['format'])?'':$data['format']; ?>" placeholder="输入产品规格">
                    <span class="error-block" id="m_format"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">表面处理</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="face" id="face" value="<?php echo empty($data['face'])?'':$data['face']; ?>" placeholder="输入表面处理">
                    <span class="error-block" id="m_face"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">建议售价</label>
                <div class="col-lg-10 col-md-10">
                    <input type="text" class="form-control" name="price" id="price" value="<?php echo empty($data['price'])?'':$data['price']; ?>" placeholder="输入建议售价">
                    <span class="error-block" id="m_price"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 col-md-2 control-label" for="text-input">是否允许网上销售</label>
                <div class="col-lg-10 col-md-10">
                    <label class="radio-inline" >
                        <input name="isOnline" type="radio" value="1" <?php if( !isset($data['isOnline']) || $data['isOnline'] == '1' ){ ?> checked="checked" <?php } ?>>
                        是
                    </label>
                    <label class="radio-inline">
                        <input name="isOnline" type="radio" value="0" <?php if( isset($data['isOnline']) && $data['isOnline'] == '0' ){ ?> checked="checked" <?php } ?>>
                        否
                    </label>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <input type="button" class="btn btn-sm btn-success" value="确认" onclick="edit_do()">
        <input type="button" class="btn btn-sm btn-danger" value="返回" onclick="back()">
    </div>
</div>