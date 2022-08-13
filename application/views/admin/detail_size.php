<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <h1 class="text-center"><?= $size['name']?></h1>
    <div class="container-fluid">
      <div class="register-box mt-0">
        <div class="register-box-body">
          <div class="row">
            <div class="col-xs-12">
              <table class="table block">
                <tr>
                  <th style="border-top:0; border-bottom:1px #f4f4f4 solid !important">Size Name</th>
                  <td style="border-top:0; border-bottom:1px #f4f4f4 solid !important"><?= $size['name'];?></td>
                </tr>
                <tr>
                  <th style="border-top:0; border-bottom:1px #f4f4f4 solid !important">Size</th>
                  <td style="border-top:0; border-bottom:1px #f4f4f4 solid !important"><?= $size['size'];?></td>
                </tr>
              </table>
            </div>
            <div class="col-xs-6">
              <a href="<?= site_url('admin/sa_size')?>" class="btn btn-oldblue">Back</a>
            </div>
            <div class="col-xs-6 text-right">
              <a href="<?= site_url('admin/editSize/'.$size['id'])?>" class="btn btn-oldblue">Edit Size</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
