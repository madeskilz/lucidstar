<?php $this->load->view('admin/inc/header') ?>
<div class="content">
    <div class="container">
        <h3>Homepage Editor</h3>
        <?php if ($this->session->flashdata('success_msg')) { ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error_msg')) { ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
        <?php } ?>

        <div class="dash-card">
            <div class="content">
                <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/homepage') ?>">
                    <?php if ($this->config->item('csrf_protection')): ?>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Hero Heading</label>
                        <input type="text" name="hero_heading" class="form-control" value="<?= htmlspecialchars($hero_heading) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Hero Subtext</label>
                        <input type="text" name="hero_subtext" class="form-control" value="<?= htmlspecialchars($hero_subtext) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Hero Image (upload to replace)</label>
                        <input type="file" name="hero_image" class="form-control" />
                        <?php if (!empty($hero_image)) { ?>
                            <p>Current: <img src="<?= htmlspecialchars($hero_image) ?>" style="height:80px;" /></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Homepage Sections (JSON)</label>
                        <textarea name="homepage_sections" class="form-control" rows="6"><?= htmlspecialchars($homepage_sections) ?></textarea>
                        <small class="muted">Optional: store structured homepage sections here as JSON. Example: [{"type":"feature","title":"...","body":"..."}]</small>
                    </div>

                    <div style="margin-top:12px">
                        <button class="btn btn-primary" type="submit">Save Homepage</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/inc/footer') ?>