<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container" style="margin-bottom:50px;">

        </div>
    </div>
    <div class="ll">
        <div class="container">
            <div class="col-md-4"></div>
            <?= form_open_multipart() ?>
            <div class="col-md-4">
                <?php $this->load->view("err-inc/msg") ?>
                <a href="<?= base_url("admin/slides") ?>" class="btn btn-danger pull-right" title="cancel" style="width:40px;height:40px;min-width:0;line-height:0;padding-top:10px;"><i class="fa fa-close"></i></a>
                <h3>Edit Slide(<?= $slide->headline ?>)</h3>
                <img src="<?= base_url() . "sitefiles/slides/$slide->image" ?>" id="previewImg" style="margin-top:10px;width:80%;height:auto;" />
                <div class="form-group">
                    <label for="image">Slide Image</label>
                    <input type="file" accept="image/*" onchange="loadname(this,'previewImg')" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="headline">Headline</label>
                    <input type="text" name="headline" id="headline" class="form-control" required value="<?= $slide->headline ?>">
                </div>
                <div class="form-group">
                    <label for="body">Slide Body</label>
                    <textarea name="body" id="body" class="form-control" required rows="5"><?= $slide->body ?></textarea>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-info">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>