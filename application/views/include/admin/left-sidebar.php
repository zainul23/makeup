<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('asset/dist/img/user.png');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <br>
          <?php if($this->session->userdata('uType') == 1): ?>
            <p>Super Admin</p>
          <?php endif; ?>
          <?php if($this->session->userdata('uType') == 2): ?>
            <p>Admin</p>
          <?php endif; ?>
          <?php if($this->session->userdata('uType') == 3): ?>
            <p>Store Owner</p>
          <?php endif; ?>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($this->session->userdata('uType') == 1): ?>
          <li>
            <a href="<?= site_url('admin/sa_slider');?>"><i class="fa fa-pencil-square-o"></i><span> Cover</span></a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-id-badge"></i> <span>Master data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <!-- <li class="active"><a href="<?= site_url('admin/list-type');?>">Type</a></li> -->
                <li class="active"><a href="<?= site_url('admin/list-catalog');?>">Catalog</a></li>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-id-badge"></i> <span>Transaction</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <!-- <li class="active"><a href="<?= site_url('admin/list-type');?>">Type</a></li> -->
                <li class="active"><a href="<?= site_url('admin/list-catalog');?>">Catalog</a></li>
              </li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
