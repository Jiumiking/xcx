<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo empty($this_setting['station_name'])?'':$this_setting['station_name']; ?></title>
    <link href="<?php echo base_url('images/icon.ico');?>" type="image/x-icon" rel="shortcut icon" />

    <!-- Css files -->
    <link href="<?php echo base_url('asset/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('asset/css/jquery.mmenu.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('asset/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <!--link href="<?php echo base_url('css/climacons-font.css');?>" rel="stylesheet" type="text/css"-->
    <link href="<?php echo base_url('asset/third_party/jquery-ui/css/jquery-ui-1.10.4.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('asset/css/style.min.css');?>" rel="stylesheet">
    <!--link href="<?php echo base_url('css/add-ons.min.css');?>" rel="stylesheet"-->
    <!--动态加载css-->
    <?php if(!empty($_css)){ ?>
    <?php foreach($_css as $css){ ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/'.$css.'.css');?>" />
    <?php } ?>
    <?php } ?>

    <script src="<?php echo base_url('asset/js/jquery.js');?>"></script>
    <!--动态加载js-->
    <?php if(!empty($_js)){ ?>
    <?php foreach($_js as $js){ ?>
    <script src="<?php echo base_url('asset/js/'.$js.'.js');?>"></script>
    <?php } ?>
    <?php } ?>
</head>
<body>
    <?php $this->load->view('base/header_js'); ?>
    <?php $this->load->view('base/header_base'); ?>
    <div class="container-fluid content">
        <div class="row">
            <?php $this->load->view('base/menu.php'); ?>
            <!-- start: Content -->
            <div class="main">
                <?php $this->load->view('base/header_bred.php'); ?>
                <div id="div_show" style="display:none;">
                </div>
                <div id="div_content">