<section id="slider" class="flexslider-wrap fullscreen clearfix">
    <div class="slider-wrapper">
        <div class="flexslider clearfix">
            <ul class="slides">
                <li class="clearfix" style="background-image: url(<?= base_url("assets/img/slider/home/slide2.jpg") ?>); background-size: cover; background-repeat: no-repeat;">
                    <div class="overlay color"></div>
                    <div class="flex-content vertical-center">
                        <div class="container">
                            <div class="caption wow fadeInLeft">
                                <h3 style="color: #ffffff; font-weight: 500;">Welcome to</h3>
                            </div>
                            <div class="caption wow fadeInUp">
                                <h1 style="color: #ffffff; font-size: 46px;">Lucid Stars <br> Private School</h1>
                            </div>
                            <div class="caption wow fadeIn">
                                <p style="color: #ffffff; font-size: 18px;">Your children, our children</p>
                            </div>
                            <div class="caption wow fadeInUp">
                                <div class="button-normal white">
                                    <a href="<?= base_url("about") ?>">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php foreach (homeSlides() as $slide) { ?>
                    <li class="clearfix" style="background-image: url(<?= base_url("sitefiles/slides/$slide->image") ?>); background-size: cover; background-repeat: no-repeat;">
                        <div class="overlay color"></div>
                        <div class="flex-content vertical-center">
                            <div class="container">
                                <div class="caption wow fadeInLeft">
                                    <h3 style="color: #ffffff; font-weight: 500;">Welcome to Lucid Stars</h3>
                                </div>
                                <div class="caption wow fadeInUp">
                                    <h1 style="color: #ffffff; font-size: 46px;"><?= $slide->headline ?></h1>
                                </div>
                                <div class="caption wow fadeIn">
                                    <p style="color: #ffffff; font-size: 18px;"><?= $slide->body ?></p>
                                </div>
                                <div class="caption wow fadeInUp">
                                    <div class="button-normal white">
                                        <a href="<?= base_url("about") ?>">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>