<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container" style="margin-bottom:50px;">
            
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php $this->load->view("err-inc/msg") ?>
                <a href="<?= base_url("admin/news") ?>" class="btn btn-danger pull-right" title="cancel" style="width:40px;height:40px;min-width:0;line-height:0;padding-top:10px;"><i class="fa fa-close"></i></a>
                <h3>Add News</h3>
                <form method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" class="form-control" required rows="5"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>