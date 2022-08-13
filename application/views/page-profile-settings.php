<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
		<!-- -->
		<section class="section-xs">
			<div class="container">
				<div class="row">

					<!-- RIGHT -->
					<div class="col-8 offset-2 mb-80">

						<ul class="nav nav-tabs nav-top-border">
							<li class="active"><a href="#info" data-toggle="tab">Personal Info</a></li>
							<li><a href="#password" data-toggle="tab">Password</a></li>
						</ul>

						<div class="tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane active" id="info">
								<?php if (validation_errors() != NULL): ?>
									<div class="text-center">
										<div class="container">
											<div class="container text-center" style="background: #ffcccc; border: 1px solid red;">
												<?php if ($this->session->userdata('error') != NULL): ?>
													<?= $this->session->userdata('error')?>
												<?php else: ?>
												<?= validation_errors();?>
											<?php endif; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
								<form action="<?= site_url('home/profileSetting')?>" method="post">
									<div class="form-group">
										<label class="form-control-label">First Name</label>
										<input type="text" name="firstname" value="<?= $profile['first_name'];?>" class="form-control">
									</div>
									<div class="form-group">
										<label class="form-control-label">Last Name</label>
										<input type="text" name="lastname" value="<?= $profile['last_name']?>" class="form-control">
									</div>
									<div class="form-group">
										<label class="form-control-label">Phone Number</label>
										<input type="text" name="phone" value="<?= $profile['phone']?>" class="form-control">
									</div>
									<div class="form-group">
										<label class="form-control-label">Address</label>
										<textarea class="form-control" name="address" rows="3" placeholder=""><?= $profile['address']?></textarea>
									</div>
									<div class="margiv-top10">
										<button type="submit" class="btn btn-oldblue"><i class="fa fa-check"></i> Save Changes </button>
										<a href="<?= site_url('home/profilePage');?>" class="btn btn-default">Cancel </a>
									</div>
								</form>
							</div>
							<!-- /PERSONAL INFO TAB -->

							<!-- PASSWORD TAB -->
							<div class="tab-pane fade" id="password">

								<?php if (validation_errors() == TRUE): ?>
									<div class="text-center">
										<div class="container">
											<div class="container text-center" style="background: #ffcccc; border: 1px solid red;">
												<?php if ($this->session->userdata('error') != NULL): ?>
													<?= $this->session->userdata('error');?>
												<?php else: ?>
													<?= validation_errors();?>
												<?php endif; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>

								<form action="<?= site_url('home/profileSetting/password')?>" method="post">

									<div class="form-group">
										<label class="form-control-label">Current Password</label>
										<input name="current_password" type="password" class="form-control">
									</div>
									<div class="form-group">
										<label class="form-control-label">New Password</label>
										<input name="password" type="password" class="form-control">
									</div>
									<div class="form-group">
										<label class="form-control-label">Re-type New Password</label>
										<input name="confirm_password" type="password" class="form-control">
									</div>

									<div class="margiv-top10">
										<button type="submit" class="btn btn-oldblue"><i class="fa fa-check"></i> Change Password</button>
										<a href="#" class="btn btn-default">Cancel </a>
									</div>

								</form>

							</div>
							<!-- /PASSWORD TAB -->

						</div>

					</div>

				</div>
			</div>
		</section>
		<!-- / -->
