<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="content-wrapper">
  <section class="content">
  <!-- <h1 class="text-center">Edit Brand</h1> -->
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
              <?php elseif($this->input->post('items') == NULL): ?>
                <?= validation_errors('<div class="alert alert-mini alert-danger mb-30">', '</div>');?>
              <?php endif;?>
              <!-- /ALERT -->
              <?= form_open_multipart('admin/edit-catalog/'.$catalog['slugs'], array('class' => 'm-0 sky-form')); ?>
                <input type="hidden" name="id" value="<?= $catalog['id']?>">
                <label class="input mb-10">
                  <input class="form-control" name="items" type="text" placeholder="Brand" value="<?= $catalog['name']?>">
                </label>
                <label class="input mb-10">
                  <textarea class="form-control" autocomplete="off" name="description" rows="8" cols="43" type="text" placeholder="Desc"><?= $catalog['description']?></textarea>
                </label>
                <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="price" type="text" placeholder="Price" value="<?= $catalog['price']?>">
                </label>
                <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="quota" type="number" placeholder="Quota" value="<?= $catalog['quota']?>">
                </label>
                <div class="col-xs-12 text-center mb-20">
                  <img id="logoBrand" style="width:100px !important; height:100px;" src="<?= base_url('asset/brands/'.$catalog['logo']);?>">
                </div>
                <label class="input mb-10">
                  <input type="file" name="catalog-pics" id="file"/>
                </label>
                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= site_url('admin/list-catalog')?>" class="btn btn-oldblue btn-default">Cancel</a>
                  </div>
                  <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-oldblue btn-default"></i>Submit</button>
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
