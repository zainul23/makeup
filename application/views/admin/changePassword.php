<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
    <section class="content">
        <h1 class="text-center">CHANGE PASSWORD</h1>
        <div class="container-fluid">
            <div class="register-box mt-0">
                <div class="register-box-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <!-- ALERT -->
                            <?php if($this->session->has_userdata('error')): ?>
                                <div class="alert alert-mini alert-danger mb-30">
                                    <strong>Oh snap!</strong> <?= $this->session->userdata('error')?>
                                </div>
                            <?php endif; ?>
                            <?= validation_errors('<div class="alert alert-mini alert-danger mb-30">', '</div>');?>
                            <!-- /ALERT -->
                            <form class="m-0 sky-form" action="<?= site_url('admin/changePassword');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                <label><strong>Current Password</strong></label>
                                <label class="input mb-10">
                                    <input class="form-control" name="current" type="password" placeholder="Current Password">
                                </label>
                                <label><strong>New Password</strong></label>
                                <label class="input mb-10">
                                    <input class="form-control" name="new" type="password" placeholder="New Password">
                                </label>
                                <label><strong>Confirm Password</strong></label>
                                <label class="input mb-10">
                                    <input class="form-control" name="confirm" type="password" placeholder="Confirm Password">
                                </label>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-oldblue btn-default">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
