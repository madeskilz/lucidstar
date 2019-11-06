<?php $this->load->view("home/inc/header") ?>
<section id="content" class="single-wrapper">
	<div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
		<div class="container">
			<div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
				<h1><?= $gname ?></h1>
			</div>
		</div>
	</div>
	<div class="gallery">
		<div class="container">
			<div id="gallery" class="wow fadeIn clearfix animated" style="position: relative; height: 605.844px; visibility: visible; animation-name: fadeIn;">
				<?php if (count($gallery) > 0) {
					foreach ($gallery as $image) { ?>
						<div class="gallery-item exterior">
							<div class="wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
								<a title="gallery" href="<?= base_url("sitefiles/gallery/$image->image") ?>">
									<div class="gallery-image">
										<img src="<?= base_url("sitefiles/gallery/$image->image") ?>" alt="">
										<div class="overlay dark"></div>
										<span><i class="fa fa-plus"></i></span>
									</div>
								</a>
							</div>
						</div>
					<?php }
					} else { ?>
					<h4 class="text-center">No Image in This Gallery</h4>
				<?php } ?>
			</div>
			<script type="text/javascript">
				jQuery(window).load(function() {

					var $container = $('#gallery');

					$container.isotope({
						transitionDuration: '0.65s'
					});

					$(window).resize(function() {
						$container.isotope('layout');
					});
					$container.infinitescroll({
							loading: {
								finishedMsg: 'There is no more',
								msgText: 'loading',
								speed: 'normal'
							},

							state: {
								isDone: false
							},
							navSelector: '#load-more-portfolio',
							nextSelector: '#load-more-portfolio a',
							itemSelector: '.gallery-item',

						},
						function(newElements) {
							$container.isotope('appended', $(newElements));
							var t = setTimeout(function() {
								$container.isotope('layout');
							}, 2000);

						});

					$container.infinitescroll('unbind');
					$("#load-infinite").click(function() {
						$container.infinitescroll('retrieve');
						return false;
					});

				});
			</script>
		</div>
	</div>
</section>
<?php $this->load->view("home/inc/footer") ?>