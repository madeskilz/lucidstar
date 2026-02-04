<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>News & Updates</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <h3 class="col-md-12"><a href="<?= base_url("admin/add_news") ?>" class="btn btn-primary pull-right">Add News</a></h3>
            <div class="col-md-12">
                <?php $this->load->view("err-inc/msg") ?>
                <?php if (empty($updates)) { ?>
                    <div class="dash-card">No news yet</div>
                <?php } else { ?>
                    <div class="dashboard-grid">
                        <?php foreach ($updates as $up) { ?>
                            <div>
                                <div class="dash-card">
                                    <div class="content">
                                        <h4><?= htmlspecialchars($up->title) ?></h4>
                                        <p class="muted" style="margin:0;"><?= htmlspecialchars(mb_strimwidth($up->details,0,140,'...')) ?></p>
                                        <div class="muted small">Published: <?= htmlspecialchars($up->published) ?></div>
                                        <div class="dash-actions" style="margin-top:8px;">
                                            <a class="btn btn-primary" href="<?= base_url('admin/edit_news/'.$up->id) ?>">Edit</a>
                                            <a class="btn btn-default btn_delete" href="#" data-href="<?= base_url('admin/remove_news/'.$up->id) ?>">Delete</a>
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
        let des = confirm("Are you sure you want to delete this news?");
        if (des) {
            window.location = url;
        }
    });
</script>