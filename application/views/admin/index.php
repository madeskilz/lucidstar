<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>CMS Dashboard</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <div class="col-md-12">
                <?php $this->load->view("err-inc/msg") ?>
            </div>
            <div class="col-md-12 row text-center" style="margin-top:50px;">
                <div class="col-md-4">
                    <a href="<?= base_url("admin/news") ?>"><i class="fa fa-newspaper-o fa-5x"></i><br /> <span class="sub-text">News & Updates</span></a>
                </div>
                <div class="col-md-4">
                    <a href="<?= base_url("admin/slides") ?>"><i class="fa fa-image fa-5x"></i><br /> <span class="sub-text">Homepage Slides</span></a>
                </div>
                <div class="col-md-4">
                    <a href="<?= base_url("admin/gallery") ?>"><i class="fa fa-clone fa-5x"></i><br /> <span class="sub-text">Gallery</span></a>
                </div>
                <div class="col-md-4">
                    <a href="<?= base_url("admin/about") ?>"><i class="fa fa-cogs fa-5x"></i><br /> <span class="sub-text">About</span></a>
                </div>
                <div class="col-md-4">
                    <a href="#"><i class="fa fa-user fa-5x"></i><br /> <span class="sub-text">User Profile</span></a>
                </div>
                <div class="col-md-4">
                    <a href="<?= base_url("logout") ?>"><i class="fa fa-sign-out fa-5x"></i><br /> <span class="sub-text">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>