<?php $this->load->view('admin/inc/header') ?>
<div class="content">
    <div class="container">
        <h3>Site Settings</h3>
        <?php if ($this->session->flashdata('success_msg')) { ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error_msg')) { ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/settings') ?>">
            <div class="form-group">
                <label>Site Name</label>
                <input type="text" name="site_name" class="form-control" value="<?= htmlspecialchars($site_name) ?>" />
            </div>
            <div class="form-group">
                <label>Logo (upload to replace)</label>
                <input type="file" name="logo" class="form-control" />
                <?php if (!empty($logo_path)) { ?>
                    <p>Current: <img src="<?= htmlspecialchars($logo_path) ?>" style="height:40px;" /></p>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control" rows="4"><?= htmlspecialchars($short_description) ?></textarea>
            </div>
            <div class="form-group">
                <label>Homepage Hero Heading</label>
                <input type="text" name="hero_heading" class="form-control" value="<?= htmlspecialchars(isset($hero_heading)?$hero_heading:'') ?>" />
            </div>
            <div class="form-group">
                <label>Homepage Hero Subtext</label>
                <textarea name="hero_subtext" class="form-control" rows="3"><?= htmlspecialchars(isset($hero_subtext)?$hero_subtext:'') ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Staff Count</label>
                    <input type="text" name="stat_staff" class="form-control" value="<?= htmlspecialchars(isset($stat_staff)?$stat_staff:'24') ?>" />
                </div>
                <div class="form-group col-md-3">
                    <label>Students Count</label>
                    <input type="text" name="stat_students" class="form-control" value="<?= htmlspecialchars(isset($stat_students)?$stat_students:'80') ?>" />
                </div>
                <div class="form-group col-md-3">
                    <label>Classes Count</label>
                    <input type="text" name="stat_classes" class="form-control" value="<?= htmlspecialchars(isset($stat_classes)?$stat_classes:'8') ?>" />
                </div>
                <div class="form-group col-md-3">
                    <label>Labs Count</label>
                    <input type="text" name="stat_labs" class="form-control" value="<?= htmlspecialchars(isset($stat_labs)?$stat_labs:'4') ?>" />
                </div>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($address) ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Phone 1</label>
                    <input type="text" name="phone1" class="form-control" value="<?= htmlspecialchars($phone1) ?>" />
                </div>
                <div class="form-group col-md-6">
                    <label>Phone 2</label>
                    <input type="text" name="phone2" class="form-control" value="<?= htmlspecialchars($phone2) ?>" />
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" />
            </div>
            <div class="form-group">
                <label>Staff Email URL</label>
                <input type="text" name="staff_email_url" class="form-control" value="<?= htmlspecialchars($staff_email_url) ?>" />
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Facebook URL</label>
                    <input type="text" name="social_facebook" class="form-control" value="<?= htmlspecialchars($social_facebook) ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label>Twitter URL</label>
                    <input type="text" name="social_twitter" class="form-control" value="<?= htmlspecialchars($social_twitter) ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label>Instagram URL</label>
                    <input type="text" name="social_instagram" class="form-control" value="<?= htmlspecialchars($social_instagram) ?>" />
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Save Settings</button>
        </form>
    </div>
</div>
<?php $this->load->view('admin/inc/footer') ?>
