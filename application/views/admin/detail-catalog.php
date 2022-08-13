<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <h1 class="text-center"><?= $catalog['name']?></h1>
    <div class="container-fluid">
      <div class="register-box mt-0">
        <div class="register-box-body">
          <div class="row">
            <div class="col-xs-12 text-center mb-20">
              <img style="width:100px !important; height:100px;" src="<?= base_url('asset/brands/'.$catalog['logo']);?>">
            </div>
            <div class="col-xs-12">
              <table class="table block">
                <tr>
                  <th>Brand</th>
                  <td><?= $catalog['name'];?></td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td><?= $catalog['description'];?></td>
                </tr>
              </table>
            </div>
            <div class="col-xs-6">
              <a href="<?= site_url('admin/list-catalog')?>" class="btn btn-oldblue">Back</a>
            </div>
            <div class="col-xs-6 text-right">
              <a href="<?= site_url('admin/edit-catalog/'.$catalog['slugs'])?>" class="btn btn-oldblue">Edit</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
