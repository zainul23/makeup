<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- SLIDER -->
<section id="slider" class="h-600 mobile-fullheight">

    <div class="swiper-container" data-effect="slide" data-autoplay="true">
        <div class="swiper-wrapper">
            <?php
				$i = 0;
				foreach ($slides as $pic) {
                ?>
                <!-- SLIDES -->

                <a class="d-none d-sm-block swiper-slide" href="<?= $pic['bannerlink'] ?>"
                   style="display:inline-block;background-image: url(<?php echo base_url('asset/upload/'.$pic['slide']); ?>);">
                <?php if ($i == 0) { ?>
						<div class="overlay dark-1"><!-- dark overlay [1 to 9 opacity] -->
							<div class="display-table">

								<div class="display-table-cell" style="vertical-align-middle">
									<div class="container">
										<div class="row">
											<div class="text-center col-md-8 col-xs-12 offset-md-2">
												<div class="fixed-bottom pb-35">
													<a class="btn btn-lg btn-exp scrollTo b-0" href="#product">EXPLORE
														<br>
														<i class="fa fa-chevron-down">
														</i>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
              	<?php } ?>
				</a>
                <a class="d-block d-sm-none swiper-slide" href="<?= $pic['bannerlink'] ?>"
                   style="display:inline-block;background-image: url(<?php echo base_url('asset/upload/'.$pic['slide_mobile']); ?>);">
                   <?php if ($i == 0) { ?>
                        <div class="overlay dark-1"><!-- dark overlay [1 to 9 opacity] -->
                            <div class="display-table">

                                <div class="display-table-cell" style="vertical-align-middle">
                                    <div class="container">
                                        <div class="row">
                                            <div class="text-center col-md-8 col-xs-12 offset-md-2">
                                                <div class="fixed-bottom pb-35">
                                                    <a class="btn btn-lg btn-exp scrollTo b-0" href="#product">EXPLORE
                                                        <br>
                                                        <i class="fa fa-chevron-down">
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                <?php } ?>
                </a>
                <!-- /SLIDE -->
            <?php $i++; } ?>

            <!-- Swiper Arrows -->
        </div>
		<div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
		<div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
	</div>

</section>

<!-- PRODUCT -->
<section id="product" class="section-lg pt-120 pb-60">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12 pb-40">
                        <h3 class="text-center">Purchase now</h3>
                    </div>
                    <div class="col-12 pb-40">
                        <a class="btn btn-oldblue" href="<?= site_url(''); ?>home/page-order">Order Now</a>
                    </div>
                </div>
                <!-- <div class="row text-center justify-content-between">
                </div> -->
            </div>
        </div>
    </div>
    </div>
</section>
<!-- /PRODUCT -->
