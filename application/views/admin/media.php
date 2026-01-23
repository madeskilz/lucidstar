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
            <h4>Upload Media</h4>
            <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/add_media') ?>">
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
        <div class="col-md-6">
            <h4>Files</h4>
            <ul>
                <?php foreach ($media as $m) { ?>
                    <li>
                        <img src="<?= htmlspecialchars($m->file) ?>" style="height:40px;margin-right:10px;" />
                        <?= htmlspecialchars($m->alt) ?>
                        - <a href="<?= base_url('admin/remove_media/'.$m->id) ?>" onclick="return confirm('Remove media?')">Delete</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php $this->load->view('admin/inc/footer') ?>
