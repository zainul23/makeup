<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content-header">
      <h1>List</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
              <div class="row">
                  <div class="col-md-12">
                      <a href="<?= site_url('admin/add-catalog');?>" class="btn btn-oldblue"><i class="fa fa-plus"></i>Add</a>
                  </div>
              </div>
              <hr class=col-xs-12>
            <table id="dataTable" class="table table-bordered table-striped">
              <thead>
                <th width="5%">No.</th>
                <th width="35%">Items</th>
                <th width="20%">Price</th>
                <th width="20%">Quota</th>
                <th width="20%" class="text-center">Action</th>
              </thead>
              <tbody>
                <?php $no=1; ?>
                <?php foreach($catalogs as $catalog): ?>
                  <tr>
                    <td><?= $no;?></td>
                    <td><?= $catalog['name'];?></td>
                    <td><?= $catalog['price'];?></td>
                    <td><?= $catalog['quota'];?></td>
                    <td class="text-center">
                      <?php if ($catalog['status'] == 1): ?>
                        <a href="<?=site_url('admin/active-catalog/'.$catalog['slugs']);?>"><i class="btn btn-success fa fa-power-off"></i></a>
                      <?php else: ?>
                        <a href="<?=site_url('admin/active-catalog/'.$catalog['slugs']);?>"><i class="btn btn-danger fa fa-power-off"></i></a>
                      <?php endif; ?>
                      <a href="<?= site_url('admin/delete-catalog/'.$catalog['slugs'])?>" onclick="return confirm('Are you sure?')"><i class="btn btn-danger fa fa-trash"></i></a>
                      <a href="<?= site_url('admin/info-catalog/'.$catalog['slugs'])?>"><i class="btn btn-oldblue fa fa-info"></i></a>
                    </td>
                  </tr>
                  <?php $no++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
