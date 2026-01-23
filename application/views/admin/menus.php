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
            <h4>Create Menu</h4>
            <form method="post" action="<?= base_url('admin/add_menu') ?>">
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
        <div class="col-md-6">
            <h4>Existing Menus</h4>
            <ul>
                <?php foreach ($menus as $m) { ?>
                    <li>
                        <strong><?= htmlspecialchars($m->menu_name) ?> (<?= htmlspecialchars($m->label) ?>)</strong>
                        - <a href="<?= base_url('admin/edit_menu/'.$m->id) ?>">Edit Items</a>
                        - <a href="<?= base_url('admin/remove_menu/'.$m->id) ?>" onclick="return confirm('Remove menu?')">Delete</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php $this->load->view('admin/inc/footer') ?>
