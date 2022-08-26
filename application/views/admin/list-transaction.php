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
              <!-- <div class="row">
                  <div class="col-md-12">
                      <a href="<?= site_url('admin/add-transaction');?>" class="btn btn-oldblue"><i class="fa fa-plus"></i>Add</a>
                  </div>
              </div>
              <hr class=col-xs-12> -->
            <table id="dataTable" class="table table-bordered table-striped">
              <thead>
                <th width="5%">No.</th>
                <th width="20%">Nama</th>
                <th width="10%">Order Date</th>
                <th width="10%">Catalog</th>
                <th width="20%">Alamat</th>
                <th width="20%">Price</th>
                <th width="20%">Note</th>
                <th width="10%">Status</th>
                <th width="10%">Picture</th>
                <th width="15%" class="text-center">Action</th>
              </thead>
              <tbody>
                <?php $no=1; ?>
                <?php foreach($transactions as $transaction): ?>
                  <tr>
                    <td><?= $no;?></td>
                    <td><?= $transaction['nama'];?></td>
                    <td><?= $transaction['order_date'];?></td>
                    <td><?= $transaction['type'];?></td>
                    <td><?= $transaction['alamat'];?></td>
                    <td><?= number_format($transaction['price']);?></td>
                    <td><?= $transaction['note'];?></td>
                    <td>
                    <?php
                        switch($transaction['status']) {
                        case '0':
                            echo "<span class=\"float-right\">Pending</span>";
                            break;
                        case '1':
                            echo "<span class=\"float-right\">Process</span>";
                            break;
                        case '2':
                            echo "<span class=\"float-right\">Paid</span>";
                            break;
                        default:
                            break;
                        } ?>
                    </td>
                    <td>
                    <?php if (!is_null($transaction['picture'])): ?>
                        <a href="<?= base_url('asset/upload/').$transaction['picture'];?>" target="_blank">Click Here</a></td>
                    <?php else: ?>
                        <span>No Uploaded Files</span>
                    <?php endif; ?>
                    <td class="text-center">
                      <?php if ($transaction['status'] == '1'): ?>
                        <a href="<?=site_url('admin/finish-order/'.$transaction['order_id']);?>"><i class="btn btn-success fa fa-check"></i></a>
                      <?php else: ?>
                        <!-- <a href="<?=site_url('admin/finish-order/'.$transaction['order_id']);?>"><i class="btn btn-danger fa fa-power-off" title="conform transaction"></i></a> -->
                        <a href="<?= site_url('admin/delete-order/'.$transaction['order_id'])?>" onclick="return confirm('Are you sure?')"><i class="btn btn-danger fa fa-trash"></i></a>
                      <?php endif; ?>
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
