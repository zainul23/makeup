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
<section id="review" class="section-lg pt-120 pb-60">
    <div class="row">
        <div class="container">
            <div class="col-12 pb-40">
                <h3 class="text-center">Review This Site</h3>
            </div>
            <?php if ($this->session->has_userdata('error')): ?>
                <div class="text-center">
                    <div class="container">
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $this->session->userdata('error');?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($this->session->has_userdata('success')): ?>
                <div class="text-center">
                    <div class="container">
                        <div class="alert alert-success text-center" role="alert">
                            <?= $this->session->userdata('success');?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <!-- REVIEW FORM -->
                <form method="post" action="<?= site_url('home/review/')?>" id="form-review">

                    <div class="row mb-10">

                        <div class="col-md-6 mb-10">
                            <!-- Name -->
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name *" maxlength="100" required="">
                        </div>

                        <div class="col-md-6">
                            <!-- Email -->
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email *" maxlength="100"
                                required="">
                        </div>

                    </div>

                    <!-- Comment -->
                    <div class="mb-30">
                        <textarea name="comment" id="comment" class="form-control" rows="6" placeholder="Comment" maxlength="1000"></textarea>
                    </div>

                    <!-- Stars -->
                    <div class="product-star-vote clearfix">

                        <label class="radio float-left">
                            <input type="radio" name="product-review-vote" value="1" />
                            <i></i> 1 Star
                        </label>

                        <label class="radio float-left">
                            <input type="radio" name="product-review-vote" value="2" />
                            <i></i> 2 Stars
                        </label>

                        <label class="radio float-left">
                            <input type="radio" name="product-review-vote" value="3" />
                            <i></i> 3 Stars
                        </label>

                        <label class="radio float-left">
                            <input type="radio" name="product-review-vote" value="4" />
                            <i></i> 4 Stars
                        </label>

                        <label class="radio float-left">
                            <input type="radio" name="product-review-vote" value="5" />
                            <i></i> 5 Stars
                        </label>

                    </div>
                    <!-- Send Button -->
                    <button type="submit" class="btn btn-oldblue"><i class="fa fa-check"></i> Send Review</button>
                </form>
                <!-- /REVIEW FORM -->
            </div>
        </div>
    </div>
</section>
