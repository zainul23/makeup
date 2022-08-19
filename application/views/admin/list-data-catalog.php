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
                      <a href="<?= site_url('admin/data-catalog');?>" class="btn btn-oldblue"><i class="fa fa-plus"></i>Add</a>
                  </div>
              </div>
              <hr class=col-xs-12>
            <table id="dataTable" class="table table-bordered table-striped">
              <thead>
                <th width="5%">No.</th>
                <th width="35%">Title</th>
                <th width="20%">Price</th>
                <th width="20%" class="text-center">Action</th>
              </thead>
              <tbody>
                <?php $no=1; ?>
                <?php foreach($catalogs as $catalog): ?>
                  <tr>
                    <td><?= $no;?></td>
                    <td><?= $catalog['title'];?></td>
                    <td><?= $catalog['price'];?></td>
                    <td class="text-center">
                      <a href="<?= site_url('admin/delete-data-catalog/'.$catalog['id'])?>" onclick="return confirm('Are you sure?')"><i class="btn btn-danger fa fa-trash"></i></a>
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
