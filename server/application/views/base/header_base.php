<!-- start: Header -->
<div class="navbar" role="navigation">
    <div class="container-fluid">		

        <ul class="nav navbar-nav navbar-actions navbar-left">
            <li class="visible-md visible-lg"><a href="javascript:void(0);" id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
            <li class="visible-xs visible-sm"><a href="javascript:void(0);" id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>			
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown visible-md visible-lg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="user-avatar" src="<?php echo base_url('asset/images/3.png');?>" alt="user-mail"><?php echo $this_user['name_real'];?></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-menu-header">
                        <strong>Account</strong>
                    </li>
                    <li><a href="javascript:void(0);" onclick="change_user_pwd('<?php echo empty($this_user['id'])?'':$this_user['id'];?>','top')"><i class="fa fa-wrench"></i>修改密码</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('sign/logout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>	
                </ul>
            </li>
            <li><a href="<?php echo site_url('sign/logout');?>"><i class="fa fa-power-off"></i></a></li>
        </ul>
    </div>
</div>
<!-- end: Header -->