<?php defined('BASEPATH') or Exit('No direct script access allowed'); ?>
<!-- <script src="https://www.google.com/recaptcha/api.js?render=6Lcxm5wUAAAAAEhnAdo5xeknvh7RXGpTqWq5XDTO"></script> -->
<!-- FOOTER -->
<footer id="footer">
    <div class="container footer-zero">
        <div class="row mb-40 fs-13 footer-zero">
            <!-- col #1 -->
            <div class="col-12 col-md-7 pb-10 footer-zero">
                <h2 class="pt-10">
                    Stay in the know
                </h2>
                <h6>Be the first to hear about new inventory and offers.</h6>
                <form id="newsletter" method="post" action="<?=site_url('home/subscribe')?>">
					<?php if($this->session->has_userdata('error_newsletter')): ?>
						<div class="alert alert-mini alert-danger">
							<?= $this->session->userdata('error_newsletter')?>
						</div>
					<?php endif; ?>
                    <div class="input-email">
                        <input type="email" name="email" class="form-control form-control-footer" placeholder="Your Mail"
                               aria-label="Your Mail" aria-describedby="basic-addon2" style="background-color: #5F5F5F;">
						<input type="hidden" name="token" id="token">
                        <div>
                            <button type="button" class="email-button eyebrow" data-toggle="modal" data-target="#newsletter-modal">SUBMIT<i class="pl-5 fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </form>

                <!-- Social Icons -->
                <div class="pt-15">
                    <div class="clearfix">
                        <a href="https://facebook.com"
                           class="social-icon social-icon-border social-icon-round social-facebook float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/agmstore.id/"
                           class="social-icon social-icon-border social-icon-round social-instagram float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Instagram">
                            <i class="icon-instagram2"></i>
                            <i class="icon-instagram2"></i>
                        </a>
						<a href="https://wa.me/6281211904686"
						   class="social-icon social-icon-border social-icon-round social-whatsapp float-left"
						   data-toggle="tooltip"
						   data-placement="top" title="Chat on Whatsapp">
							<i class="icon-chat"></i>
							<i class="icon-chat"></i>
						</a>
                        <a href="whatsapp://call?number=6281211904686"
                           class="social-icon social-icon-border social-icon-round social-whatsapp float-left"
                           data-toggle="tooltip"
                           data-placement="top" title="Call on Whatsapp">
                            <i class="icon-call"></i>
                            <i class="icon-call"></i>
                        </a>
                    </div>
                </div>
                <!-- /Social Icons -->
            </div>
            <!-- /col #1 -->

            <!-- col #2 -->
            <!-- <div class="col-sm-12 col-md-5 pt-10 footer-zero">
                <div class="row">
                    <div class="col-md-4 col-4 pt-5">
                        <h4 class="letter-spacing-1 footer-zero">SHOP</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="<?= site_url('home/shop/aireloom'); ?>">Aireloom</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/kingkoil'); ?>">Kingkoil</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/serta'); ?>">Serta</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/tempur'); ?>">Tempur</a></li>
                            <li><a class="block" href="<?= site_url('home/shop/florence'); ?>">Florence</a></li>
							<li><a class="block" href="<?= site_url('home/shop/ogawa'); ?>">Ogawa</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-4 pt-5">
                        <h4 class="letter-spacing-1 footer-zero">ABOUT</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="<?= site_url(''); ?>home/about">About Us</a></li>
                            <li><a class="block" href="<?= site_url(''); ?>home/contact">Contact Us</a></li>
                            <li><a class="block" href="<?= site_url(''); ?>home/faq">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-4 pt-5">
                        <h4 class="letter-spacing-1 footer-zero">HELP</h4>
                        <ul class="list-unstyled footer-list half-paddings b-0">
                            <li><a class="block" href="<?= site_url(''); ?>home/termCondition">Terms & Conditions</a>
                            </li>
                            <li><a class="block" href="<?= site_url(''); ?>home/privacyPolicy">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- /col #2 -->
        </div>
    </div>
    <div class="copyright">
        <div class="container text-center">
            &copy; All Rights Reserved, <b>AGM - American Giant Mattress</b>
        </div>
    </div>
</footer>
<!-- /FOOTER -->

<div class="modal fade bs-example-modal-sm" id="newsletter-modal" tabindex="-1" role="dialog" aria-labelledby="newsletterModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- header modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="mySmallModalLabel">Small modal</h4>
			</div>

			<!-- body modal -->
			<div class="modal-body">
				<p>Terima kasih atas minat Anda pada situs web kami. Data diri Anda hanya akan digunakan untuk tujuan pengiriman promosi dan informasi dari AGM.</p>
			</div>

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" id="ok" class="btn btn-default" data-dismiss="modal">Ok</button>
			</div>

		</div>
	</div>
</div>

</div>
<!-- SCROLL TO TOP -->
<a href="<?= site_url('#'); ?>" id="toTop"></a>

<!-- JAVASCRIPT FILES -->
<script>
    var plugin_path = "<?= base_url('asset/plugins/');?>";
</script>
<script src="<?= base_url('asset/plugins/jquery/jquery-3.3.1.min.js'); ?>"></script>

<script src="<?= base_url('asset/javascript/scripts.js'); ?>"></script>
<script src="<?= base_url('asset/javascript/scrollAnimated.js'); ?>"></script>

<!-- STYLESWITCHER - REMOVE -->
<!-- <script async type="text/javascript" src="demo_files/styleswitcher/styleswitcher.js"></script> -->
<script src="<?= base_url('asset/plugins/slider.swiper/dist/js/swiper.min.js'); ?>"></script>
<script src="<?= base_url('asset/javascript/demo.swiper_slider.js'); ?>"></script>

<!-- AutoNumber -->
<script type="text/javascript" src="https://unpkg.com/autonumeric"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script src="<?= base_url('asset/javascript/demo.shop.js'); ?>"></script>


<!-- <script>
	jQuery("#shipswitch").bind("click",function(){jQuery('#shipping').slideToggle(200,function(){if(jQuery('#shipping').is(":visible")){_scrollTo('#shipping',150);}});});

	jQuery("#shipswitch").bind("click", function(){
		jQuery("#historyshipping").slideToggle(200, function(){
			if(jQuery("#historyshipping").is(":visible")){
				_scrollTo("#historyshipping", 150);
				$("#shippinghistory").show();
				jQuery("#shipswitch1").bind("click", function(){
					jQuery("#shipping").slideToggle(200, function(){
						if(jQuery("#shipping").is(":visible")){
							_scrollTo("#shipping",150);
							$("default_address").hide();
							$("#historyshipping").hide();
						}else{
							$("default_address").show();
							$("#historyshipping").hide();
						}
					});
				});
			}else{
				$("#historyshipping").hide();
			}
		})
	})
</script> -->

<script>
    // grecaptcha.ready(function() {
    //     // do request for recaptcha token
    //     // response is promise with passed token
    //     grecaptcha.execute('6Lcxm5wUAAAAAEhnAdo5xeknvh7RXGpTqWq5XDTO', {action: 'create_comment'}).then(function(token) {
    //         // add token to form
    //         $('#token').val(token)
    //     });;
    // });
</script>

</body>

</html>
