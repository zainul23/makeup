<?php defined('BASEPATH') or exit('No direct access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <h1 class="text-center">REGISTER</h1>
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
              <form class="m-0 sky-form" action="<?= site_url('auth/regis');?>" method="post">
                <?php if($this->session->userdata('uType') == 2): ?>
                  <p class="register-box-msg">Register a new Store Owner</p>
                  <label class="input mb-10">
                    <input name="uname" type="text" placeholder="Username" value="<?php echo set_value("uname") ?>">
                  </label>
                  <label class="input mb-10">
                    <input name="email" type="email" placeholder="Email address" value="<?php echo set_value("email") ?>">
                  </label>
                  <label class="input mb-10">
                    <input name="company_name" type="text" placeholder="Company Name" value="<?php echo set_value("company_name") ?>">
                  </label>
                  <label class="input mb-10">
                    <input name="owner" type="text" placeholder="Owner Name" value="<?php echo set_value("owner") ?>">
                  </label>
                  <label class="input mb-10">
                    <input name="add" type="text" placeholder="Address" value="<?php echo set_value("add") ?>">
                  </label>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="input mb-10">
                        <input name="province" type="text" placeholder="Province">
                      </label>
                    </div>
                    <div class="col-md-6">
                      <label class="input mb-10">
                        <input name="city" type="text" placeholder="City">
                      </label>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="input mb-10">
                        <input name="sub_district" type="text" placeholder="Sub District">
                      </label>
                    </div>
                    <div class="col-md-6">
                      <label class="input mb-10">
                        <input name="pCode" type="text" placeholder="Postcode" value="<?php echo set_value("pCode") ?>">
                      </label>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="input mb-10">
                        <input name="phone1" type="text" placeholder="Phone Number 1" value="<?php echo set_value("phone1") ?>">
                      </label>
                    </div>
                    <div class="col col-md-6 mb-10">
                      <label class="input">
                        <input name="phone2" type="text" placeholder="Phone Number 2" value="<?php echo set_value("phone2") ?>">
                      </label>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if($this->session->userdata('uType') == 1): ?>
                  <p class="register-box-msg">Register a new Admin</p>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="input mb-10">
                        <input class="form-control" name="uname" type="text" placeholder="Username" value="<?php echo set_value("uname") ?>">
                      </label>
                      <label class="input mb-10">
                        <input class="form-control" name="email" type="email" placeholder="Email address" value="<?php echo set_value("email") ?>">
                      </label>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="input">
                        <input class="form-control" name="fname" type="text" placeholder="First name" value="<?php echo set_value("fname") ?>">
                      </label>
                    </div>
                    <div class="col col-md-6">
                      <label class="input">
                        <input class="form-control" name="lname" type="text" placeholder="Last name" value="<?php echo set_value("lname") ?>">
                      </label>
                    </div>
                  </div>
                  <label class="input mb-10">
                    <input class="form-control" name="phone" type="text" placeholder="Phone Number" value="<?php echo set_value("phone") ?>">
                  </label>
                  <label class="input mb-10">
                    <select class="form-control" class="form-control" name="adminType">
                      <option value="0" selected disabled>Admin Authority</option>
                      <option value="1">Super Admin</option>
                      <option value="2">Admin</option>
                    </select>
                  </label>
                <?php endif; ?>
                <div class="row mt-10">
                  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-oldblue btn-default"><i class="fa fa-plus"></i> REGISTERz</button>
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
