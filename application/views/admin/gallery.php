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
                <ul class="e_tags">
                    <?php foreach ($gallery_tags as $tag) { ?>
                        <li style="margin-top:10px;">
                            <?= $tag->tag_name ?>
                            <div class="btn-group" style="display:inline-flex;margin-left:40px;">
                                <a href="javascript:;" data-tag_id="<?= $tag->id ?>" data-tag_name="<?= $tag->tag_name ?>" data-tag_class="<?= $tag->tag_class ?>" data-action="edit" class="btn btn-info edit_gtag tag_action" style="min-width:0;width:40px;height:45px;" title="Edit <?= $tag->tag_name ?>"><i class="fa fa-edit"></i></a>
                                <a data-href="<?= base_url("admin/remove_tag/$tag->id") ?>" class="btn_delete btn btn-danger" style="min-width:0;width:40px;height:45px;" title="Delete <?= $tag->tag_name ?>"><i class="fa fa-remove"></i></a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <h3 class="col-md-12" style="margin-top:20px;">Gallery <a href="<?= base_url("admin/add_img") ?>" class="btn btn-primary pull-right">New Image</a></h3>
            <div class="col-md-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($gallery) == 0) { ?>
                            <tr>
                                <td colspan="4" class="text-center">No records found</td>
                            </tr>
                        <?php } ?>
                        <?php $xx = 1;
                        foreach ($gallery as $img) { ?>
                            <tr>
                                <td><?= $xx ?></td>
                                <td><img style="width:300px;" src="<?= base_url("sitefiles/gallery/") . $img->image ?>" /></td>
                                <td>
                                    <?php
                                        $tag_arr = explode(",", $img->tags);
                                        //st = single tag
                                        foreach ($tag_arr as $st) {
                                            echo "<span class='badge badge-info'>$st</span>";
                                        }
                                        ?>
                                </td>
                                <td>
                                    <div class="btn-group" style="display:inline-flex;">
                                        <a href="<?= base_url("admin/edit_img/$img->id") ?>" class="btn btn-info" style="min-width:0;width:40px;height:45px;" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a data-href="<?= base_url("admin/remove_img/$img->id") ?>" class="btn_delete btn btn-danger" style="min-width:0;width:40px;height:45px;" title="Delete"><i class="fa fa-remove"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php $xx++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= base_url("admin/gallery_tag") ?>">
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