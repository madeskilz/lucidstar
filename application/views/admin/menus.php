<?php $this->load->view('admin/inc/header') ?>
<div class="container">
    <h3>Menus</h3>
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
                    <h4>Create Menu</h4>
                    <form method="post" action="<?= base_url('admin/add_menu') ?>">
                        <?php if ($this->config->item('csrf_protection')): ?>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Menu Name (internal)</label>
                            <input type="text" name="menu_name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Label (display)</label>
                            <input type="text" name="label" class="form-control" />
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dash-card">
                <div class="content">
                    <h4>Existing Menus</h4>
                    <ul class="list-unstyled">
                        <?php foreach ($menus as $m) { ?>
                            <li style="padding:8px 0;border-bottom:1px dashed rgba(0,0,0,0.04);">
                                <strong><?= htmlspecialchars($m->menu_name) ?> (<?= htmlspecialchars($m->label) ?>)</strong>
                                <div style="margin-top:6px">
                                    <a class="btn btn-default" href="<?= base_url('admin/edit_menu/' . $m->id) ?>">Edit Items</a>
                                    <a class="btn btn-default" href="<?= base_url('admin/remove_menu/' . $m->id) ?>" onclick="return confirm('Remove menu?')">Delete</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/inc/footer') ?>