<?php $this->load->view('admin/inc/header') ?>
<div class="container">
    <h3>Media Library</h3>
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
                    <h4>Upload Media</h4>
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/add_media') ?>">
                        <?php if ($this->config->item('csrf_protection')): ?>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <?php endif; ?>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Alt Text</label>
                            <input type="text" name="alt" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Caption</label>
                            <textarea name="caption" class="form-control" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dash-card">
                <div class="content">
                    <h4>Files</h4>
                    <ul class="list-unstyled">
                        <?php foreach ($media as $m) { ?>
                            <li style="padding:8px 0;border-bottom:1px dashed rgba(0,0,0,0.04); display:flex; align-items:center; gap:10px;">
                                <img src="<?= htmlspecialchars($m->file) ?>" style="height:48px;width:auto;border-radius:6px;" />
                                <div style="flex:1">
                                    <div><?= htmlspecialchars($m->alt) ?></div>
                                    <div class="muted small">Uploaded: <?= date('Y-m-d', strtotime($m->date_uploaded)) ?></div>
                                </div>
                                <div>
                                    <a class="btn btn-default" href="<?= base_url('admin/remove_media/' . $m->id) ?>" onclick="return confirm('Remove media?')">Delete</a>
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