<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <h1 class="text-center">ADD Slider</h1>
    <div class="container-fluid">
      <div class="register-box mt-0">
        <div class="register-box-body">
          <div class="row">
            <div class="col-md-12 col-sm-6">
              <!-- ALERT -->
              <?php if(isset($error)): ?>
                <div class="alert alert-mini alert-danger mb-30">
                  <strong>Oh snap!</strong> <?php echo $error ?>
                </div>
              <?php endif; ?>
              <!-- /ALERT -->
              <form class="m-0 sky-form" action="<?= site_url('admin/addSlider');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <p class="register-box-msg">Add a new slider</p>
                <div class="form-group">
                  <p class="help-block text-danger fs-12">Desktop Version have maximum size 2 MB and maximum resolution 1440 x 600 pixel</p>
                  <input type="file" class="mt-5" name="sliderPict" />
                </div>
                <div class="form-group">
                  <p class="help-block text-danger fs-12">Mobile version have maximum size 2 MB and maximum resolution 400 x 600 pixel</p>
                  <input type="file" class="mt-5" name="sliderPict-mobile" />
                </div>
                <div class="row">
                  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-oldblue btn-default"><i class="fa fa-plus"></i>ADD</button>
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
