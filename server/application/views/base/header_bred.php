<?php if(!empty($bred)){ ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <?php foreach($bred as $v){ ?>
            <li><i class="<?php echo $v['icon'];?>"></i><?php echo $v['name'];?></li>
            <?php } ?>
        </ol>
    </div>
</div>
<?php } ?>