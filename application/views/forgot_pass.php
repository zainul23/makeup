<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php defined('BASEPATH') or exit('No direct script access allow'); ?>
<section class="page-header">
  <div class="container">

    <h1>FORGOT PASSWORD</h1>

    <!-- breadcrumbs -->
    <!--<ol class="breadcrumb">-->
    <!--  <li><a href="<?=site_url();?>">Home</a></li>-->
    <!--  <li class="active"><a href="<?= site_url('auth/login');?>">Login</a></li>-->
    <!--</ol>-->
    <!-- /breadcrumbs -->

  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3">
        <!-- ALERT -->
        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-mini alert-danger mb-30">
            <strong>Oh snap!</strong> <?= $this->session->flashdata('error');?>
          </div>
        <?php elseif (validation_errors() != NULL): ?>
            <div class="alert alert-mini alert-danger mb-30">
              <strong>Oh snap!</strong> <?= validation_errors();;?>
            </div>
        <?php endif; ?>
        <!-- /ALERT -->
        <form class="m-0 sky-form boxed" action="<?= site_url('auth/reset_password_profile');?>" method="post">
          <header>
              <i class="fa fa-users"></i>Forgot Password
          </header>
          <fieldset class="m-0">
                <label class="input mb-10">
                  <input name="email" type="text" placeholder="Email">
                </label>
          </fieldset>
          <div class="row mb-20">
              <div class="col-md-12">
                  <button type="submit" class="btn btn-oldblue"><i class="fa fa-check"></i>Forgot Password</button>
              </div>
          </div>
        </form>
      </div>
    </div>

    </div>
  </div>
</section>
