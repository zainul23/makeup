<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- -->
<section class="section-xs">
    <div class="container">
        <div class="row">

            <!-- LEFT -->

            <!-- CATEGORIES -->
            <div class="col-12 col-md-3 order-md-1 order-lg-1">

              <div class="side-nav mb-60">

                <div class="side-nav-head" data-toggle="collapse" data-target="#categories">
                  <button class="fa fa-bars btn btn-mobile"></button>
                  <h4>STATUS</h4>
                </div>

                <ul id="categories" class="list-group list-unstyled">

                  <li class="fs-13 list-group-item"><a href="<?= base_url('home/transactionPage');?>"> Status Transaksi</a></li>
                  <li class="fs-13 list-group-item"><a href="<?= base_url('home/historyPage');?>"> History</a></li>
                  <li class="fs-13 list-group-item"><a href="<?= base_url('home/profilePage');?>"> Profil</a></li>
                </ul>

              </div>
            </div>
            <!-- /CATEGORIES -->

            <!-- RIGHT -->
            <div class="col-12 col-md-9 mb-80 order-md-2 order-lg-1">

                <div class="side-custom-content float-left mt-0">

                    <div class="row">
                      <div class="col-12 col-md-12">
                        <h2 class="fs-16 font-regular mb-20 mt-6">
                          Detail Transaksi
                          <span class="text-muted"></span>
                        </h2>

                        <div class="row ml-0 mrad-0">

                          <div class="col-12 mb-20">
                            <div class="row ml-0 mr-0">
                              <div class="col-6 col-md-6">
                                <label class="fs-12 mb-0">Nomor Transaksi</label>
                                <label class="pt-0 fs-16"><?= $detailOrder['order_number']?></label>
                              </div>

                              <div class="col-6 col-md-6 pt-10">
                                  <?php
                                  switch($detailOrder['status']) {
                                    case 0:
                                      echo "<span class=\"badge badge-secondary btn-sm float-right\">Menunggu Pembayaran</span>";
                                      break;
                                  case 1:
                                      echo "<span class=\"badge badge-success float-right\">Order Diproses</span>";
                                      break;
                                  case 2:
                                      echo "<span class=\"badge badge-warning btn-sm float-right\">Order Selesai</span>";
                                      break;
                                  default:
                                      break;
                                  } ?>

                              </div>
                            </div>

                              <hr>
                              <div class="row ml-0 mr-0">
                                  <div class="col-4 col-md-4">
                                      <label class="fs-12 mb-0">Tanggal Order</label>
                                      <label class="pt-0 fs-16"><?= $detailOrder['order_date']?></label>
                                  </div>
                                  <div class="col-4 col-md-4">
                                      <label class="fs-12 mb-0">Total Pembayaran</label>
                                      <label class="pt-0 fs-16">Rp. <?= number_format(floatval($detailOrder['price']), 0, ',', '.')?></label>
                                  </div>
                              </div>
                            <hr>
                            
                            <label class="fs-12 mb-0">Note</label>
                            <label class="pt-0 fs-16 mb-0"><?= $detailOrder['note']?></label>
                            <hr>
                            <?php if(isset($error)): ?>
                              <div class="alert alert-mini alert-danger mb-30">
                                <strong>Oh snap!</strong> <?php echo $error ?>
                              </div>
                            <?php endif; ?>
                            <?= form_open_multipart('home/upload-payment/', array('class' => 'm-0 sky-form')); ?>
                            <input type="hidden" name="id" value="<?= $detailOrder['order_number']?>">
                            <input type="hidden" name="order_id" value="<?= $detailOrder['order_id']?>">
                            <!-- <form class="m-0 sky-form boxed" action="<?= site_url('home/detail-transaction');?>" method="post"> -->
                              <header>
                                  <h3>Upload Bukti Pembayaran</h3>
                              </header>

                              <fieldset class="m-0">
                                  <label class="input mb-15">
                                      <i class="ico-append fa fa-file"></i>
                                      <input class="form-control" name="file" type="file" placeholder="Select date" autocomplete="off">
                                  </label>
                              </fieldset>
                              <div class="row mb-20">
                                  <div class="col-md-12">
                                      <button type="submit" class="btn btn-oldblue btn-default">Upload</button>
                                      <a href="<?= site_url('home/transactionPage');?>" class="btn btn-secondary btn-default">Cancel</a>
                                      <!-- <button type="submit" class="btn btn-secondary btn-default">Cancel</button> -->
                                  </div>
                              </div>

                            </form>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- / -->
