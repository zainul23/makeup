<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

		<section class="page-header page-header-md pb-10">
			<div class="container">

                <!-- <img src="<?= base_url('asset/brands/'.$brand['logo']);?>" /> -->

				<!-- breadcrumbs -->
				<!--<ol class="breadcrumb">-->
				<!--	<li><a href="#">Home</a></li>-->
				<!--	<li class="active">Product</li>-->
				<!--</ol>-->
				<!-- /breadcrumbs -->

			</div>
		</section>
		<!-- /PAGE HEADER -->

		<section class="pt-0">
			<div class="container">

				<div class="row">
					<!-- LEFT -->
					<div class="col-lg-3 col-md-3 col-sm-3 order-md-1 order-lg-1 mt-60">

						<!-- BRANDS -->
                        <div class="side-nav mb-60 mt-60">

							<div class="side-nav-head" data-toggle="collapse" data-target="#brands">
								<button class="fa fa-bars btn btn-mobile"></button>
								<h4>CATEGORIES</h4>
							</div>

							<ul id="brands" class="list-group list-unstyled">
                                <?php foreach ($catalogs as $catalog): ?>
                                    <li class="list-group-item"><a href="<?= site_url('home/catalog/'.$catalog['slugs']);?>"><?php echo $catalog['name'] ?></a></li>
                                <?php endforeach;?>
							</ul>

						</div>
						<!-- BRANDS -->

					</div>

					<!-- RIGHT -->
					<div class="pajinate col-lg-9 col-md-9 col-sm-9 order-md-2 order-lg-2" data-pajinante-items-per-page="12"
					 data-pajinate-container=".pajinate-container">
					    <?php if($products == NULL):?>
                            <p class="text-center">Catalog tidak tersedia</p>
                        <?php else:?>
						<!-- LIST OPTIONS -->
							<div class="pajinate-nav shop-list-options mb-20 absolute"
								 style="left:unset !important; right:0px !important;">

								<!-- Pagination Default -->
								<ul class="pagination mt-0">
									<!-- pages added by pajinate plugin -->
								</ul>
								<!-- /Pagination Default -->

							</div>
						<!-- /LIST OPTIONS -->
                            <ul class="pajinate-container shop-item-list row list-inline mt-60">
							<?php foreach ($products as $product): ?>
								<!-- ITEM -->
								<li class="col-lg-4 col-sm-4">

									<div class="shop-item">

										<div class="thumbnail">
											<!-- product image(s) -->
                                            <?php if($product['picture'] === NULL) {?>
											<a class="shop-item-image" target="_blank" href="<?= site_url('asset/brands/'.$product['picture']);?>">
												<img class="img-fluid" src="<?= site_url('asset/brands/'.$product['picture']);?>" alt="product name" />
											</a>
                                            <?php } else { ?>
                                                <a class="shop-item-image" target="_blank" href="<?= site_url('asset/brands/'.$product['picture']);?>">
                                                    <img class="img-fluid" src="<?= site_url('asset/brands/'.$product['picture']);?>" alt="product name" />
                                                </a>
                                            <?php } ?>
											<!-- /product image(s) -->

											<div class="shop-item-summary text-center">
												<h2><?= $product['title'];?></h2>
												<!-- /rating -->
												<p>Starts from</p>
												<!-- price -->
												<div class="shop-item-price">
													<?php
														if ($product['price']) {
															if ($product["price"] < $product["price"]) { ?>
																Rp. <?= number_format($product['price'], 0, ",", ".");?>
													<?php	} else { ?>
																Rp. <?= number_format($product['price'], 0, ",", ".");?>
													<?php	}
														} else {?>
															Rp. <?= number_format($product['price'], 0, ",", ".");?>
														<?php	}
													?>

												</div>
												<!-- /price -->
											</div>
										</div>
									</li>
							<?php endforeach; ?>
                            <!-- /ITEM -->
						</ul>
						<hr />
						<!-- Pagination Default -->
						<div class="pajinate-nav text-center">
							<ul class="pagination">
								<!-- pages added by pajinate plugin -->
							</ul>
						</div>
						<!-- /Pagination Default -->

                        <?php endif;?>
					</div>
				</div>
                <!-- reviews -->
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 order-md-2 order-lg-2">
                        <h4 class="">Reviews</h4>
                        <ul style="padding-left:0px !important;">
							<?php foreach ($reviews as $review): ?>
								<li style="border: 1px solid grey; list-style-type: none; margin-top:10px;">
									<h5 style="margin-bottom: 0px !important; margin-top: 10px !important; margin-left: 10px !important;"><?= $review['name'];?></h5>
									<div class="rating rating-<?= $review['stars'];?>" style="margin-left: 10px !important;">
									</div>
									<h5 style="margin-left: 10px !important;"><?= $review['comment'];?></h5>
								</li>
							<?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 order-md-1 order-lg-1 mt-60"></div>
                </div>
		</div>
		</section>
