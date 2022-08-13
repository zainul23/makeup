<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Detail Admin
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="box">
                    <div class="box-body">
                        <h2 class="text-center mb-20">
                            Admin Name
                        </h2>
                        <div class="row text-center mb-20">
                            <div class="col-xs-12 mb-20">
                                <img style="width:100px !important; height:100px;" src="<?= base_url('asset/dist/img/user.png');?>">
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-xs-12 mb-20">
                                <div class="product-detail">
                                    <div class="col-xs-12 mb-20">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Username</th>
                                                    <td><?= $detail_admin['username']?></td>
                                                </tr>
                                                <tr>
                                                    <th>First Name</th>
                                                    <td><?= $detail_admin['first_name']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td><?= $detail_admin['last_name']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td><?= $detail_admin['email']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td><?= $detail_admin['phone']?></td>
                                                </tr>
                                                <tr>
                                                    <th>Role</th>
                                                    <td><?= ($detail_admin['user_type'] == 1 ? 'Super Admin':'Admin')?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="<?= site_url('admin/listAdmin');?>"><button class="btn btn-oldblue btn-default" style="float:left;">Back</button></a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="<?= site_url('admin/changePassword/'.$detail_admin['user_id']);?>"><button class="btn btn-oldblue btn-default" style="float:right;">Change Password</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
