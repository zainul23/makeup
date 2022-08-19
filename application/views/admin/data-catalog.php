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
              <form class="m-0 sky-form" action="<?= site_url('admin/data-catalog');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <p class="register-box-msg">Add a new Data catalog</p>
                <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="items" type="text" placeholder="Title" value="<?php echo set_value("items") ?>">
                </label>
                <!-- <label class="input mb-10">
                  <textarea class="form-control" autocomplete="off" name="description" rows="8" cols="43" type="text" placeholder="Desc" value="<?php echo set_value("description") ?>"></textarea>
                </label> -->
                <label class="input mb-15">
                    <select class="form-control" name="type">
                    </select>
                </label>
                <label class="input mb-15">
                    <input id="price" class="price" readonly name="price" type="hidden" placeholder="Price" autocomplete="off">
                    <input id="category" class="category" readonly name="category" type="hidden" placeholder="category" autocomplete="off">
                    <input id="cat_id" class="cat_id" readonly name="cat_id" type="hidden" placeholder="cat_id" autocomplete="off">
                </label>
                <!-- <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="price" type="text" placeholder="Price" value="<?php echo set_value("price") ?>">
                </label> -->
                <!-- <label class="input mb-10">
                  <input class="form-control" autocomplete="off" name="quota" type="number" placeholder="Quota" value="<?php echo set_value("quota") ?>">
                </label> -->
                <label class="input mb-10">
                  <input type="file" name="catalog-pics" />
                </label>
                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= site_url('admin/list-data-catalog')?>" class="btn btn-default btn-default">Cancel</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script> -->
<script>
  $(function () {
    // register listener perawat
    $.get('<?=base_url('home/list-catalog')?>', function(data) {
        // console.log('data1', data);
        const selectEl = $('select[name="type"]');
        selectEl.html('<option selected disabled>- Choose -</option>');
        $.each(data, function(key, value) {
            const {id, name, price, quota} = value;
            const optionEl = `<option ${quota > 0 ? 'style="display:block;"' : 'style="display:none;"' } value="${id}">${name}</option>`
            selectEl.append(optionEl);
        });
    });

    $(document).on('change', 'select[name="type"]', function(e) {
        const targetEl = $(this).val();
        $.get('<?=base_url('home/list-catalog/')?>'+ targetEl, function(data) {
            // console.log('data', data);
            $.each(data, function(key, value) {
                const {id, name, price, quota} = value;
                // new AutoNumeric('#price', {
                //     digitGroupSeparator: '.',
                //     decimalCharacter: ',',
                //     unformatOnSubmit: true,
                //     decimalPlacesOverride: '0',
                //     unformatOnSubmit: true,
                //     minimumValue: 0
                // });
                $('#price').val(price);
                $('#category').val(name);
                $('#cat_id').val(id);
            });
        });
    });
  });
</script>
