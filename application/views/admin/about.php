<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>About</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <div style="height:50px;"></div>
            <div class="col-md-12">
                <?php $this->load->view("err-inc/msg") ?>
            </div>
            <div class="col-md-12 wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                <div class="dash-card">
                    <div class="content">
                        <form method="post" class="row">
                            <div class="col-sm-6">
                                <input type="text" required name="school_name" placeholder="School Name" value="<?=$about->school_name?>" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" required name="slogan" placeholder="Slogan" value="<?=$about->slogan?>" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <textarea required name="address" rows="3" placeholder="Address" class="form-control"><?=$about->address?></textarea>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" required name="phone1" placeholder="Phonenumber 1" value="<?=$about->phone1?>" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" required name="phone2" placeholder="Phonenumber 2" value="<?=$about->phone2?>" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <textarea required name="vision" rows="5" placeholder="Vision" class="form-control"><?=$about->vision?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <textarea required name="mission" rows="5" placeholder="Mission" class="form-control"><?=$about->mission?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <textarea required name="achievements" rows="5" placeholder="Achievements" class="form-control"><?=$about->achievements?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <textarea required name="about" rows="8" placeholder="About" class="form-control"><?=$about->about?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="submit button-normal green">Save School Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>