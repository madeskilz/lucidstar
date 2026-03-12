<?php $this->load->view("admin/inc/header") ?>
<style>
    .e_tags {
        font-size: 18px;
    }
</style>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>Gallery & Event Tags</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <div class="col-md-12">
                <?php $this->load->view("err-inc/msg") ?>
            </div>
            <h3 class="col-md-12">Gallery Event Tags <a href="javascript:;" data-action="new" class="btn btn-info pull-right tag_action">New Tag</a></h3>
            <div class="col-md-12">
                <div class="dash-card">
                    <div class="content">
                        <h4>Gallery Event Tags <a href="javascript:;" data-action="new" class="btn btn-info pull-right tag_action">New Tag</a></h4>
                        <div style="margin-top:10px;">
                            <?php foreach ($gallery_tags as $tag) { ?>
                                <span style="display:inline-block;margin:6px;padding:6px 10px;border-radius:6px;background:#fff;border:1px solid rgba(0,0,0,0.04);">
                                    <?= htmlspecialchars($tag->tag_name) ?>
                                    <span style="margin-left:10px">
                                        <a href="javascript:;" data-tag_id="<?= $tag->id ?>" data-tag_name="<?= $tag->tag_name ?>" data-tag_class="<?= $tag->tag_class ?>" data-action="edit" class="btn btn-xs btn-info edit_gtag tag_action" title="Edit <?= htmlspecialchars($tag->tag_name) ?>"><i class="fa fa-edit"></i></a>
                                        <a data-href="<?= base_url("admin/remove_tag/$tag->id") ?>" class="btn_delete btn btn-xs btn-danger" title="Delete <?= htmlspecialchars($tag->tag_name) ?>"> <i class="fa fa-remove"></i></a>
                                    </span>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="col-md-12" style="margin-top:20px;">Gallery <a href="<?= base_url("admin/add_img") ?>" class="btn btn-primary pull-right">New Image</a></h3>
            <div class="col-md-12">
                <?php if (empty($gallery)) { ?>
                    <div class="dash-card">No images found</div>
                <?php } else { ?>
                    <div class="dashboard-grid">
                        <?php foreach ($gallery as $img) { ?>
                            <div>
                                <div class="dash-card">
                                    <div style="width:120px;flex:0 0 120px;">
                                        <img src="<?= base_url('sitefiles/gallery/' . $img->image) ?>" style="width:120px;height:90px;object-fit:cover;border-radius:6px;" />
                                    </div>
                                    <div class="content">
                                        <div><?php $tag_arr = explode(",", $img->tags);
                                                foreach ($tag_arr as $st) echo '<span class="badge badge-info" style="margin-right:6px">' . htmlspecialchars($st) . '</span>'; ?></div>
                                        <div class="muted small">Uploaded: <?= date('Y-m-d', strtotime($img->date_uploaded)) ?></div>
                                        <div class="dash-actions" style="margin-top:8px;">
                                            <a class="btn btn-primary" href="<?= base_url('admin/edit_img/' . $img->id) ?>">Edit</a>
                                            <a class="btn btn-default btn_delete" href="#" data-href="<?= base_url('admin/remove_img/' . $img->id) ?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= base_url("admin/gallery_tag") ?>">
                <?php if ($this->config->item('csrf_protection')): ?>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <?php endif; ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Update Tag Details</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Tag: <span id="tag_dname"></span></h6>
                    </div>
                    <div class="form-group">
                        <label>Event Tag Name</label>
                        <input type="text" class="form-control" name="tag_name" id="tag_name" value="" placeholder="Tag Name" />
                        <input type="hidden" name="id" id="tag_id" value="" />
                        <input type="hidden" name="tag_class" id="tag_class" value="" />
                        <input type="hidden" name="action" id="action" value="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("admin/inc/footer") ?>
<script>
    $(".tag_action").on("click", function(e) {
        $('#main-wrapper').removeClass('animsition');
        let action = $(this).data("action");
        // alert(action);return false;
        let tag_id, tag_name, tag_class;
        if (action == "edit") {
            tag_id = $(this).data("tag_id");
            tag_name = $(this).data("tag_name");
            $("#title").text(`Edit ${tag_name}`);
            tag_class = $(this).data("tag_class");
            $("#tag_name").val(tag_name);
        } else {
            tag_id = "";
            tag_name = "New Tag";
            tag_class = "";
            // alert(tag_name);return false;
            $("#title").text(tag_name);
            $("#tag_name").val("");
        }
        $('#updateModal').find("#tag_dname").text(tag_name).end()
            .find("#tag_id").val(tag_id).end()
            .find("#tag_class").val(tag_class).end()
            .find("#action").val(action).end()
            .modal('show');
    });
</script>
<script>
    $(".btn_delete").on("click", function(e) {
        let url = $(this).data("href");
        let des = confirm("Are you sure you want to continue?");
        if (des) {
            window.location = url;
        }
    });
</script>