<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**默认状态**/
$config['default_status'][0] = '无效';
$config['default_status'][1] = '有效';
$config['default_status'][2] = '无效';
/**商品状态**/
$config['goods_status'][1] = '上架';
$config['goods_status'][2] = '下架';
/**订单状态**/
$config['order_status'][0] = '已取消';
$config['order_status'][1] = '待付款';
$config['order_status'][2] = '待发货';
$config['order_status'][3] = '待收货';
$config['order_status'][4] = '已完成';
/**评论状态**/
$config['comment_status'][0] = '待审核';
$config['comment_status'][1] = '有效';
$config['comment_status'][2] = '无效';

/**ajax默认状态**/
$config['default_ajax_status'][0] = '参数错误';
$config['default_ajax_status'][1] = '操作成功';
$config['default_ajax_status'][2] = '操作失败';