<?php $this->load->view("home/inc/header") ?>

<section style="height:calc(100vh - 50px);padding-top:200px;text-align:center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><span class="t_red">4</span><span class="t_blue_light">0</span><span class="t_green_light_light">4</span></h1>
				<h2>Error!</h2>
				<p>Sorry, we can't find the page you are looking for.<br>
					Please go to Home.</p>
				<div class="button-normal green"><a href="<?= base_url() ?>">Go to home</a></div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view("home/inc/footer") ?>