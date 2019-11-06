<?php $this->load->view("admin/inc/header") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
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
                <a href="<?= base_url("admin/gallery") ?>" class="btn btn-danger pull-right" title="cancel" style="width:40px;height:40px;min-width:0;line-height:0;padding-top:10px;"><i class="fa fa-close"></i></a>
                <h3>Edit Slide</h3>
                <img src="<?= base_url("sitefiles/gallery/$img->image") ?>" id="previewImg" style="margin-top:10px;width:80%;height:auto;" />
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" accept="image/*" onchange="loadname(this,'previewImg')" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control" multiple required>
                        <?php foreach (gallery_tags() as $tag) { ?>
                            <option value="<?= $tag->tag_class ?>" <?= (in_array($tag->tag_class, explode(',', $img->tags))) ? "selected" : "" ?>><?= $tag->tag_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-info">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script>
    $('select').selectpicker();
</script>