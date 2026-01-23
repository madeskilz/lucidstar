
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="widget-footer col-md-4 wow fadeIn">
				<div class="short-desc">
					<div class="logo-footer">
					<h4 class="title"><?= htmlspecialchars(site_option('site_name', 'Lucid Stars')) ?></h4>
					</div>
					<p>
					<?= nl2br(htmlspecialchars(site_option('short_description', "We can’t wait to see you kids in the class learning, and playing during break time, we missed you all."))) ?>
					</p>
				</div>
			</div>
			<div class="widget-footer col-md-4 wow fadeIn">
				<div class="contact-footer">
					<h4 class="title">Contact Us</h4>
					<div class="footer-content">
						<div class="contact-section">
							<?php $address = site_option('address', "6, Akinwale Street,\n\nOgba, Ikeja,\n\nLagos State, Nigeria."); ?>
							<?php foreach (explode("\n", $address) as $line) { if (trim($line)!=='') echo '<p class="no-margin-bottom">'.htmlspecialchars(trim($line)).'</p>'; } ?>
							<?php $phone1 = site_option('phone1', '08023148981'); $phone2 = site_option('phone2', '08033160691'); ?>
							<p><?= htmlspecialchars($phone1) ?> | <?= htmlspecialchars($phone2) ?></p>
							<?php $email = site_option('email', 'info@lucidstars.sch.ng'); ?>
							<p><a href="mailto:<?= htmlspecialchars($email) ?>" style="color:#fff;"><?= htmlspecialchars($email) ?></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-footer col-md-4 wow fadeIn">
				<div class="buy-now">
					<h4 class="title">Connect With Us!</h4>
					<div class="footer-content">
						<div class="button-normal white">
							<a href="<?= htmlspecialchars(site_option('staff_email_url', 'http://webmail.lucidstars.sch.ng')) ?>"><?= htmlspecialchars(site_option('staff_email_label', 'Staff Email')) ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<div id="copyright">
	<div class="container">
		<div class="row">
			<div class="copyright-text col-md-6">
				<p>Copyright <?= date("Y") ?> | All Rights Reserved | Powered by <a target="_blank" href="http://schoolville.com">Schoolville Ltd.</a></p>
			</div>
			<div class="social-links col-md-6">
				<ul class="no-padding">
					<?php $fb = site_option('social_facebook', 'http://facebook.com/'); if ($fb) { echo '<li><a href="'.htmlspecialchars($fb).'" target="_blank"><i class="fa fa-facebook"></i></a></li>'; } ?>
					<?php $tw = site_option('social_twitter', 'http://twitter.com/'); if ($tw) { echo '<li><a href="'.htmlspecialchars($tw).'" target="_blank"><i class="fa fa-twitter"></i></a></li>'; } ?>
					<?php $ig = site_option('social_instagram', 'http://instagram.com/'); if ($ig) { echo '<li><a href="'.htmlspecialchars($ig).'" target="_blank"><i class="fa fa-instagram"></i></a></li>'; } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="<?= base_url("assets/js/plugin.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/main.js") ?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery(".flexslider-wrap .flexslider").flexslider({
			animation: "fade",
			animationLoop: true,
			animationSpeed: 1500,
			slideshow: true,
			pauseOnHover: false,
			controlNav: false,
			directionNav: true
		});

	});
</script>
</body>

</html>