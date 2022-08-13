<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <!-- <h1 class="text-center">Add new</h1> -->
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
				<?php if ($_POST): ?>
					<div class="alert alert-mini alert-danger mb-30">
						<?=validation_errors('<p>', '</p>');?>
					</div>
				<?php endif ?>
              <!-- /ALERT -->
              <form class="m-0 sky-form" action="<?= site_url('admin/add-catalog');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <p class="register-box-msg">Add a new catalog</p>
                <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="items" type="text" placeholder="Catalog" value="<?php echo set_value("items") ?>">
                </label>
                <label class="input mb-10">
                  <textarea class="form-control" autocomplete="off" name="description" rows="8" cols="43" type="text" placeholder="Desc" value="<?php echo set_value("description") ?>"></textarea>
                  <!-- <textarea id="editor1" name="desc" rows="8" cols="43" placeholder="Description"><?php echo set_value("desc") ?></textarea> -->
                </label>
                <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="price" type="text" placeholder="Price" value="<?php echo set_value("price") ?>">
                </label>
                <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="quota" type="number" placeholder="Quota" value="<?php echo set_value("quota") ?>">
                </label>
                <label class="input mb-10">
                  <input type="file" name="catalog-pics" />
                </label>
                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= site_url('admin/list-catalog')?>" class="btn btn-default btn-default">Cancel</a>
                  </div>
                  <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-oldblue btn-default">Save</button>
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
