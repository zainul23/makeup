<?php defined('BASEPATH') or exit('No direct script access allow'); ?>
<section class="page-header">
  <div class="container">

    <h1>LOGIN</h1>

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
        <?php if($this->session->has_userdata('successmsg')): ?>
          <div class="alert alert-success mb-30">
	          <strong><?= $this->session->userdata('successmsg');?></strong>
          </div>
        <?php endif; ?>
        <?php if($this->session->has_userdata('error')): ?>
          <div class="alert alert-mini alert-danger mb-30">
            <strong>Oh snap!</strong> <?= $this->session->userdata('error');?>
          </div>
        <?php endif; ?>
        <!-- /ALERT -->
        <form class="m-0 sky-form boxed" action="<?= site_url('auth/login');?>" method="post">
          <header>
              <i class="fa fa-users"></i>Login
          </header>

          <fieldset class="m-0">
            <label class="input mb-10">
                <input name="email" type="text" placeholder="Email">
            </label>
            <label class="input mb-10">
                <input name="password" type="password" placeholder="Password">
            </label>
            <label class="input mb-10">
              <a href="<?= site_url('auth/reset_password_profile')?>">Forgot password?</a>
            </label>
          </fieldset>
          <div class="mt-30">
              <div class="col-12 col-md-12 full-width text-center">
                <button type="submit" class="col-md-10 btn btn-oldblue" style="margin-left: 0"><i class="fa fa-check"></i>Login</button>
              </div>
            </div>
            <hr>
            <label class="fs-12 text-center">
              <a href="<?= site_url('auth/regis');?>">
                <i class="glyphicon glyphicon-user"></i> &nbsp; Don't have an account yet?
              </a>
            </label>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
