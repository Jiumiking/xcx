<?php $default_status = $this->config->item('default_status'); ?>
<?php if(!empty($data)){ ?>
<?php foreach($data as $info){ ?>
<tr>
    <td><?php echo $info['number']; ?></td>
    <td><?php echo $info['name']; ?></td>
    <td><?php echo $info['material']; ?></td>
    <td><?php echo $info['format']; ?></td>
    <td><?php echo $info['face']; ?></td>
    <td><?php echo $info['price']; ?></td>
    <td><?php echo $info['isOnline']; ?></td>
    <td>
        <button type="button" class="btn btn-primary btn-xs" title="编辑" onclick="edit('<?php echo $info['id'];?>')" >
            <i class="fa fa-edit "></i>
        </button>
        <button type="button" class="btn btn-danger btn-xs" title="删除" onclick="del('<?php echo $info['id'];?>')" >
            <i class="fa fa-trash-o "></i>
        </button>
    </td>
</tr>
<?php } ?>
<?php }else{ ?>
<tr>
    <td colspan="8">未找到有效数据</td>
</tr>
<?php } ?>