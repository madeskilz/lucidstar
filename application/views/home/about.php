<?php $this->load->view("home/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1>About Us</h1>
            </div>
        </div>
    </div>
    <div class="about-us">
        <div class="container">
            <div class="row">
                <div class="accordion col-md-6">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">Vision</h4>
                                </div>
                            </a>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?= $about->vision ?>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">Our Mission</h4>
                                </div>
                            </a>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <p> <?= $about->mission ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">Awards and Achivements</h4>
                                </div>
                            </a>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p> <?= $about->achievements ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <div class="heading-block">
                        <h2>About Lucid Stars</h2>
                    </div>
                    <p><?= $about->about ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view("home/inc/activity") ?>
</section>
<?php $this->load->view("home/inc/footer") ?>