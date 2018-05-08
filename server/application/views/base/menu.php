<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<input type="hidden" id="user_id_checked" value="">
<!-- start: Main Menu -->
<div class="sidebar ">
    <div class="sidebar-collapse">
        <div class="sidebar-header t-center">
            <span><i class="fa fa-home fa-3x white"></i></span>
        </div>
        <div class="sidebar-menu">
            <ul class="nav nav-sidebar">
                <?php if(!empty($menu)){ ?>
                <?php foreach($menu as $k=>$v){?>
                <li>
                    <a href="<?php echo empty($v['link'])?'javascript:void(0);':site_url($v['link']); ?>"><i class="<?php if(!empty($v['icon'])){echo $v['icon'];}?>"></i><span class="text"> <?php echo $v['name'];?></span> <?php if(!empty($v['sons'])){?><span class="fa fa-angle-down pull-right"></span><?php } ?> </a>
                    <?php if(!empty($v['sons'])){ ?>
                    <ul class="nav sub">
                    <?php foreach($v['sons'] as $kk=>$vv){?>
                        <li><a href="<?php echo empty($vv['link'])?'javascript:void(0);':site_url($vv['link']); ?>"><i class="<?php if(!empty($vv['icon'])){echo $vv['icon'];}?>"></i><span class="text"> <?php echo $vv['name'];?></span></a></li>
                    <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer">
    </div>
</div>
<!-- end: Main Menu -->