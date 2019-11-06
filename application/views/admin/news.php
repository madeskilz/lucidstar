<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>News & Updates</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <h3 class="col-md-12"><a href="<?= base_url("admin/add_news") ?>" class="btn btn-primary pull-right">Add News</a></h3>
            <div class="col-md-12 table-responsive">
                <?php $this->load->view("err-inc/msg") ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($updates) == 0) { ?>
                            <tr>
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                        <?php } ?>
                        <?php $xx = 1;
                        foreach ($updates as $up) { ?>
                            <tr>
                                <td><?= $xx ?></td>
                                <td><?= $up->title ?></td>
                                <td><?= $up->details ?></td>
                                <td><?= $up->published ?></td>
                                <td>
                                    <div class="btn-group" style="display:inline-flex;">
                                        <a href="<?= base_url("admin/edit_news/$up->id") ?>" class="btn btn-info" style="min-width:0;width:40px;height:45px;" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a data-href="<?= base_url("admin/remove_news/$up->id") ?>" class="btn_delete btn btn-danger" style="min-width:0;width:40px;height:45px;" title="Delete"><i class="fa fa-remove"></i></a>
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
<?php $this->load->view("admin/inc/footer") ?>
<script>
    $(".btn_delete").on("click", function(e) {
        let url = $(this).data("href");
        let des = confirm("Are you sure you want to delete this news?");
        if (des) {
            window.location = url;
        }
    });
</script>