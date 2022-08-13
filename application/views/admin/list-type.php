<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>List size</h1>
  </section>
  <section class="content">
    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= site_url('admin/addSize');?>" class="btn btn-oldblue"><i class="fa fa-plus"></i> Size</a>
                </div>
            </div>
            <hr class="col-xs-12">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
              <th>No.</th>
              <th>Name</th>
              <th>Size</th>
              <th>Delete</th>
            </thead>
            <tbody>
              <?php $no=1; ?>
              <?php foreach ($sizes as $size):?>
                <tr>
                  <td><?= $no?></td>
                  <td><?= $size['name'];?></td>
                  <td><?= $size['size'];?></td>
                  <td>
                  <a href="<?= site_url('admin/deleteSize/'.$size['id']);?>" onclick="return confirm('Are you sure?')"><i class="btn btn-danger fa fa-trash"></i></a>
                  <a href="<?= site_url('admin/infoSize/'.$size['id'])?>"><i class="btn btn-oldblue fa fa-info"></i></a>
                  </td>
                </tr>
                <?php $no++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
