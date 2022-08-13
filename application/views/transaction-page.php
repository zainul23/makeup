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

								<li class="fs-13 list-group-item">
									<a href="<?= base_url('home/transactionPage');?>"> Status Transaksi
									</a>
								</li>
								<li class="fs-13 list-group-item">
								    <a href="<?= base_url('home/historyPage');?>"> History
								    </a>
								</li>
								<li class="fs-13 list-group-item">
								    <a href="<?= base_url('home/profilePage');?>"> Profil
								    </a>
								</li>

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
                                        <i class="fa fa-bar-chart-o mr-10"></i> Status Transaksi
                                    </h2>
                                    <?php if ($orderList != NULL): ?>
                                      <!-- item -->
                                      <?php foreach ($orderList as $myOrder): ?>
                                        <div class="card card-success hover-shadow rad-0">
                                            <div class="card-heading">
                                                <!-- <a class="btn <?= $myOrder['class']?> btn-sm float-right"><?= $myOrder['status']?></a> -->
                                                <h2 class="card-title">
                                                    <div class="row ml-0 mr-0">
                                                        <div class="col-6 col-md-6">
                                                            <label class="fs-11 mb-0">Nomor Transaksi</label>
                                                            <strong><?= $myOrder['order_number']?></strong>
                                                        </div>
                                                        <div class="col-3 col-md-3">
                                                            <label class="fs-11 mb-0">Tanggal Transaski</label>
                                                            <strong><?= date_format(date_create($myOrder['order_date']), "d M Y")?></strong>
                                                        </div>
                                                        <div class="col-3 col-md-3">
                                                            <?php switch($myOrder['status']) {
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
                                                    <br />
                                                    <div class="row ml-0 mr-0">
                                                        <div class="col-6 col-md-6">
                                                            <label class="fs-11 mb-0">Type</label>
                                                            <strong><?=$myOrder['type']?></strong>
                                                        </div>
                                                        <div class="col-4 col-md-4">
                                                            <label class="fs-11 mb-0">Total Pembayaran</label>
                                                            <strong>Rp. <?= number_format(floatval($myOrder['price']), 0, ',', '.')?></strong>
                                                        </div>
                                                        <div class="col-2 col-md-2">
                                                            <a href="<?= site_url('home/detail_transaction/'.$myOrder['order_number']);?>" class="btn btn-outline-secondary btn-oldblue btn-sm float-right">Detail</a>
                                                        </div>
                                                    </div>

                                                </h2>
                                            </div>
                                        </div>

                                      <?php endforeach; ?>
                                      <!-- /item -->
                                    <?php else: ?>
                                      <div class="alert alert-light b-0">
                                          Maaf, anda belum memiliki order
                                      </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / -->
