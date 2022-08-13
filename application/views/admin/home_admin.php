<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Home
    </h1>
  </section>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <table id="dataTable" class="table">
            <thead>
              <th>No.</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone</th>
              <th>Detail</th>
            </thead>
            <tbody>
              <?php $no = 1;foreach($posts as $post): ?>
                <tr>
                  <td><?= $no.'.'?></td>
                  <td><?= $post['first_name'];?></td>
                  <td><?= $post['last_name'];?></td>
                  <td><?= $post['phone'];?></td>
                  <td><a href="<?= site_url('admin/listAdmin/'.$post['id_userlogin']);?>" class="btn btn-oldblue">Detail</a></td>
                </tr>
              <?php $no++; endforeach; ?>
            </tbody>
          </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
