<?php $this->load->view('admin/inc/header'); ?>
<div class="container">
    <h1>Pages <a class="btn btn-primary pull-right" href="<?= base_url('admin/page_edit') ?>">Add Page</a></h1>
    <?php if (!empty($error_msg)): ?>
        <div class="alert alert-danger"><?= $error_msg ?></div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead><tr><th>Title</th><th>Slug</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($pages as $pg): ?>
            <tr>
                <td><?= htmlspecialchars($pg->title) ?></td>
                <td><?= htmlspecialchars($pg->slug) ?></td>
                <td><?= htmlspecialchars($pg->status) ?></td>
                <td>
                    <a href="<?= base_url('admin/page_edit/'.$pg->id) ?>" class="btn btn-sm btn-default">Edit</a>
                    <a href="<?= base_url('admin/page_remove/'.$pg->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove page?')">Remove</a>
                    <a href="<?= base_url($pg->slug) ?>" class="btn btn-sm btn-info" target="_blank">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('admin/inc/footer'); ?>
