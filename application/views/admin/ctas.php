<?php $this->load->view('admin/inc/header') ?>
<div class="container">
    <h3>Call To Action (CTAs)</h3>
    <?php if ($this->session->flashdata('success_msg')) { ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
    <?php } ?>
    <?php if ($this->session->flashdata('error_msg')) { ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
    <?php } ?>

    <div class="row">
        <div class="col-md-6">
            <div class="dash-card">
                <div class="content">
                    <h4>Add CTA</h4>
                    <form method="post" action="<?= base_url('admin/add_cta') ?>">
                        <?php if ($this->config->item('csrf_protection')): ?>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" name="label" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" name="url" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Style (CSS class, optional)</label>
                            <input type="text" name="style" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Sort order</label>
                            <input type="number" name="sort_order" class="form-control" value="0" />
                        </div>
                        <button class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dash-card">
                <div class="content">
                    <h4>Existing CTAs</h4>
                    <div>
                        <?php foreach ($ctas as $c) { ?>
                            <div style="padding:8px 0;border-bottom:1px dashed rgba(0,0,0,0.04);display:flex;align-items:center;justify-content:space-between;">
                                <div>
                                    <strong><?= htmlspecialchars($c->label) ?></strong>
                                    <div class="muted small"><?= htmlspecialchars($c->url) ?> <span style="margin-left:8px; color:#666;">(<?= htmlspecialchars($c->style) ?>)</span></div>
                                </div>
                                <div>
                                    <a class="btn btn-default" href="<?= base_url('admin/remove_cta/' . $c->id) ?>" onclick="return confirm('Remove CTA?')">Delete</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/inc/footer') ?>