<?php $this->load->view("home/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1>Login <small>To Access the CMS Dashboard</small></h1>
            </div>
        </div>
    </div>
    <div class="gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form method="post">
                        <?php $this->load->view("err-inc/msg") ?>
                        <div class="reg_box">
                            <input id="reg_email" name="login" type="text" placeholder="Your email" required="required">
                            <input id="reg_pass" name="password" type="password" placeholder="********" required="required">
                        </div>
                        <button class="submit button-normal green" type="submit">Log In</button>
                            <a href="<?= base_url("password-reset") ?>">I forgot my password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("home/inc/footer") ?>