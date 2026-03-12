<?php $this->load->view('admin/inc/header'); ?>
<div class="container">
    <h1><?= $title ?></h1>
    <?= isset($this->session) ? $this->session->flashdata('error_msg') ? '<div class="alert alert-danger">'.$this->session->flashdata('error_msg').'</div>' : '' : '' ?>
    <form method="post" action="" accept-charset="utf-8">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?= isset($page) ? htmlspecialchars($page->title) : '' ?>" />
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="<?= isset($page) ? htmlspecialchars($page->slug) : '' ?>" />
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea id="page-content" name="content" rows="10" class="form-control"><?= isset($page) ? htmlspecialchars($page->content) : '' ?></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="draft" <?= isset($page) && $page->status=='draft' ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= isset($page) && $page->status=='published' ? 'selected' : '' ?>>Published</option>
            </select>
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="<?= base_url('admin/pages') ?>" class="btn btn-default">Cancel</a>
    </form>
</div>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#page-content',
        height: 400,
        menubar: false,
        plugins: 'link image lists code table',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
        relative_urls: false,
        remove_script_host: false
    });
</script>
<?php $this->load->view('admin/inc/footer'); ?>
