<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if($this->session->userdata('uType') == 1): ?>
        <title>Super Admin</title>
    <?php else: ?>
        <title>American Giant Mattress</title>
    <?php endif; ?>
    <?php if($this->session->userdata('uType') == 2): ?>
        <title>Admin</title>
    <?php endif; ?>
    <link rel="icon" type="image/icon" href="<?= base_url('asset/logo-agm/favicon.png');?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/font-awesome/css/font-awesome.min.css');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/Ionicons/css/ionicons.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset/dist/css/AdminLTE.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('asset/dist/css/skins/_all-skins.css');?>">
    <!-- Morris chart -->
    <!-- <link rel="stylesheet" href="<?= base_url('asset/bower_components/morris.js/morris.css');?>"> -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/jvectormap/jquery-jvectormap.css');?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/bootstrap-daterangepicker/daterangepicker.css');?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/select2/dist/css/select2.min.css');?>">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/timepicker/bootstrap-timepicker.min.css');?>">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css');?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/iCheck/all.css');?>">
    <link rel="stylesheet" href="<?= base_url('asset/css/custom.css')?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
    <!--Datatables button-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= site_url();?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Adm</b></span>
            <!-- logo for regular state and mobile devices -->
            <?php if($this->session->userdata('uType') == 1): ?>
                <span class="logo-lg"><b>Admin</b></span>
            <?php else: ?>
                <span class="logo-lg"><b>Adm</b></span>
            <?php endif;?>
            <?php if($this->session->userdata('uType') == 2): ?>
                <span class="logo-lg"><b>Admin</b> Adm</span>
            <?php endif; ?>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="<?=site_url();?>" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-users user-image hidden-xs mt-3" alt="User Image"></i>
                            <span class="hidden-xs">Profile</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= base_url('asset/dist/img/user.png');?>" class="img-circle" alt="User Image">
                                <p>Admin</p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="pull-left">
                                    <?php
                                    $url = '';
                                    switch($this->session->userdata('uType')){
                                        case 1 : $url = 'admin/Profile';
                                        break;
                                        case 3 : $url = 'stores/Profile';
                                        break;
                                        default: break;
                                    }
                                    ?>
                                    <a href="<?=site_url($url)?>" class="btn btn-default btn-flat h-30">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= site_url('auth/logout')?>" class="btn btn-default btn-flat h-30">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header><!-- Content Wrapper. Contains page content -->
