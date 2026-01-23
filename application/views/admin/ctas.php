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
            <h4>Add CTA</h4>
            <form method="post" action="<?= base_url('admin/add_cta') ?>">
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
        <div class="col-md-6">
            <h4>Existing CTAs</h4>
            <ul>
                <?php foreach ($ctas as $c) { ?>
                    <li>
                        <?= htmlspecialchars($c->label) ?> - <?= htmlspecialchars($c->url) ?> (<?= htmlspecialchars($c->style) ?>)
                        - <a href="<?= base_url('admin/remove_cta/'.$c->id) ?>" onclick="return confirm('Remove CTA?')">Delete</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php $this->load->view('admin/inc/footer') ?>
