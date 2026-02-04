<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>Homepage Slides</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <h3 class="col-md-12"><a href="<?= base_url("admin/add_slide") ?>" class="btn btn-primary pull-right">New Slide</a></h3>
            <div class="col-md-12">
                <?php $this->load->view("err-inc/msg") ?>
                <?php if (empty($slides)) { ?>
                    <div class="dash-card">No slides found</div>
                <?php } else { ?>
                    <div class="dashboard-grid">
                        <?php foreach ($slides as $slide) { ?>
                            <div>
                                <div class="dash-card">
                                    <div style="width:140px;flex:0 0 140px;">
                                        <img src="<?= base_url('sitefiles/slides/'.$slide->image) ?>" style="width:140px;height:90px;object-fit:cover;border-radius:6px;" />
                                    </div>
                                    <div class="content">
                                        <h4><?= htmlspecialchars($slide->headline) ?></h4>
                                        <p class="muted" style="margin:0;"><?= htmlspecialchars($slide->body) ?></p>
                                        <div class="dash-actions" style="margin-top:8px;">
                                            <a class="btn btn-primary" href="<?= base_url('admin/edit_slide/'.$slide->id) ?>">Edit</a>
                                            <a class="btn btn-default btn_delete" href="#" data-href="<?= base_url('admin/remove_slide/'.$slide->id) ?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>
<script>
    $(".btn_delete").on("click", function(e) {
        let url = $(this).data("href");
        let des = confirm("Are you sure you want to delete this slide?");
        if (des) {
            window.location = url;
        }
    });
</script>