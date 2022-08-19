<?php defined('BASEPATH') or exit('No directt script access allowed'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-30">
                    <header class="mb-20">
                        <h3>Exixsting Quota</h3>
                    </header>
                    <div class="m-0 sky-form boxed">
                        <div class="row">
                            <?php $no=1; ?>
                            <?php foreach ($quotas as $quota): ?>
                                <div class="col-md-3"><span class="text-center"><?= $no;?>) <strong><?= $quota['name']?></strong> : <strong><?= $quota['quota']?></strong></span></div>
                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- LOGIN -->
                <div class="col-md-12 col-sm-12">
                    <!-- ALERT -->
                    <?php if($this->session->has_userdata('error')): ?>
                    <div class="alert alert-mini alert-danger mb-30">
                        <strong>Oh snap!</strong> <?= $this->session->userdata('error')?>
                    </div>
                    <?php endif; ?>
                    <?= validation_errors('<div class="alert alert-mini alert-danger mb-30">', '</div>');?>
                    <!-- /ALERT -->

                    <!-- register form -->
                    <form class="m-0 sky-form boxed" action="<?= site_url('home/page-order');?>" method="post">
                        <header>
                            <h3>Form Order</h3>
                        </header>

                        <fieldset class="m-0">
                            <label class="input mb-15">
                                <i class="ico-append fa fa-calendar"></i>
                                <input class="form-control datepicker" name="date" type="text" placeholder="Select date" autocomplete="off">
                            </label>
                            <label class="input mb-15">
                                <select class="form-control" name="type">
                                </select>
                            </label>
                            <label class="input mb-15">
                                <input id="price" class="price" readonly name="price" type="text" placeholder="Price" autocomplete="off">
                                <input id="category" class="category" readonly name="category" type="hidden" placeholder="category" autocomplete="off">
                            </label>
                            <label class="input mb-15">
                                <input name="nama" type="text" placeholder="Nama">
                            </label>
                            <label class="input mb-15">
                                <input name="alamat" type="text" placeholder="Alamat">
                            </label>
                            <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="Note"></textarea>
                        </fieldset>
                        <div class="row mb-20">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-oldblue btn-default">Submit</button>
                                <button type="submit" class="btn btn-secondary btn-default">Cancel</button>
                            </div>
                        </div>

                    </form>
                    <!-- /register form -->

                </div>
                <!-- /LOGIN -->
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->
<script>
    $(function () {
        // select2 initial
        // $('select').select2({
        //     theme: 'bootstrap4',
        // });

        // new AutoNumeric('#price', {
        //     digitGroupSeparator: '.',
        //     decimalCharacter: ',',
        //     unformatOnSubmit: true,
        //     decimalPlacesOverride: '0',
        //     unformatOnSubmit: true,
        //     minimumValue: 0
        // });

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
                });
            });
        });
    })
</script>
