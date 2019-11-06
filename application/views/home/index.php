<?php $this->load->view("home/inc/header") ?>
<?php $this->load->view("home/inc/slider")?>
<section id="content">
	<div class="banner large text-center wow fadeInUp">
		<div class="container">
			<div class="row">
				<h1 class="no-margin">Welcome to <span class="yellow-text">Lucid Stars</span> Private School</h1>
			</div>
		</div>
	</div>
	<div class="about-us no-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6 wow fadeIn">
					<div class="heading-block">
						<h2>Welcome</h2>
					</div>
					<p class="text-justify">
						We are so happy to welcome you all. We appreciate you all, for coming to our school - Lucid Stars Private School. It is an absolute pleasure to see new faces in our school, as well as meet our old pupils and parents who we have built a close relationship with on every of our child’s educational journey. So thank you everyone, for being a part of the Lucid Stars Family, we are grateful.
					</p>
					<div class="button-normal green">
						<a href="<?= base_url("about") ?>">About Us</a>
					</div>
				</div>

				<div class="about-img col-md-6 wow fadeInLeft">
					<img src="<?= base_url("assets/img/about-kindergarten.png") ?>" alt="" />
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view("home/inc/activity") ?>
	<div class="banner small wow fadeIn">
		<div class="container">
			<div class="row">
				<div class="col-md-8 pull-left wow fadeInUp">
					<h3>What are you waiting for?</h3>
				</div>

				<div class="col-md-4 wow fadeInUp">
					<div class="button-normal white pull-right">
						<a href="<?= base_url("about") ?>" class="no-margin">Read More!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="our-facility with-bg-image" style="background-image: url('<?= base_url("assets/img/our-facility-bg.jpg") ?>')">
		<div class="container">
			<div class="row">
				<div class="facility-item col-md-3 text-center wow fadeIn">
					<div class="counter-number">
						<h2 class="counter">24</h2>
					</div>
					<h4 class="title">Staff</h4>
				</div>

				<div class="facility-item col-md-3 text-center wow fadeIn">
					<div class="counter-number">
						<h2 class="counter">80</h2>
					</div>
					<h4 class="title">Student</h4>
				</div>

				<div class="facility-item col-md-3 text-center wow fadeIn">
					<div class="counter-number">
						<h2 class="counter">8</h2>
					</div>
					<h4 class="title">Classes</h4>
				</div>

				<div class="facility-item col-md-3 text-center wow fadeIn">
					<div class="counter-number">
						<h2 class="counter">4</h2>
					</div>
					<h4 class="title">Labs</h4>
				</div>
			</div>
		</div>
		<div class="overlay dark"></div>
	</div>
</section>
<div class="our-classes wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
	<div class="container">
		<div class="heading-block wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
			<h2>Latest News</h2>
		</div>

		<div class="row">
			<div class="classes">
				<?php foreach (home_news() as $news) { ?>
					<div class="col-md-6 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<a href="#!">
							<div class="class-item" style="background-color: #7fb881;">
								<div class="class-details" style="height: 216px;">
									<div class="class-desc">
										<h4><?=$news->title?></h4>
										<p class="class-category">
											<?=$news->details?>
										</p>
									</div>

									<div class="class-type">
										<div class="class-year">
											<h6 class="title">Publiished:</h6>
											<p><?=neatDate($news->published)?></p>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("home/inc/footer") ?>