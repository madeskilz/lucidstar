<?php $this->load->view("admin/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1><small>CMS Dashboard</small></h1>
            </div>
        </div>
    </div>
    <div class="ll">
        <div class="container">
            <div class="col-md-12">
                <?php $this->load->view("err-inc/msg") ?>
            </div>
            <div class="col-md-12 row text-center" style="margin-top:20px;">
                <?php $c = isset($counts) ? $counts : array(); ?>
                <div class="col-md-3">
                    <div class="dash-card">
                        <i class="fa fa-cog fa-3x"></i>
                        <h4>Settings</h4>
                        <p class="muted"><?php echo isset($c['settings']) ? $c['settings'] : '-'; ?> items</p>
                        <div class="dash-actions">
                            <a class="btn btn-xs btn-primary" href="<?= base_url('admin/settings') ?>">Manage</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-card">
                        <i class="fa fa-list fa-3x"></i>
                        <h4>Menus</h4>
                        <p class="muted"><?php echo isset($c['menus']) ? $c['menus'] : '-'; ?> menus, <?php echo isset($c['menu_items']) ? $c['menu_items'] : '-'; ?> items</p>
                        <div class="dash-actions">
                            <a class="btn btn-xs btn-success" href="<?= base_url('admin/menus') ?>">Manage</a>
                            <a class="btn btn-xs btn-default" href="<?= base_url('admin/menus') ?>#add">Add Menu</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-card">
                        <i class="fa fa-photo fa-3x"></i>
                        <h4>Media Library</h4>
                        <p class="muted"><?php echo isset($c['media']) ? $c['media'] : '-'; ?> files</p>
                        <div class="dash-actions">
                            <a class="btn btn-xs btn-success" href="<?= base_url('admin/media') ?>">Browse</a>
                            <a class="btn btn-xs btn-default" href="<?= base_url('admin/media') ?>#upload">Upload</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dash-card">
                        <i class="fa fa-bullhorn fa-3x"></i>
                        <h4>CTAs</h4>
                        <p class="muted"><?php echo isset($c['ctas']) ? $c['ctas'] : '-'; ?> items</p>
                        <div class="dash-actions">
                            <a class="btn btn-xs btn-success" href="<?= base_url('admin/ctas') ?>">Manage</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-top:20px"></div>
                <div class="col-md-8" style="margin-top:10px;">
                    <div class="dash-card">
                        <h4>Recent Activity</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Latest News</h5>
                                <ul class="list-unstyled recent-activity-list">
                                    <?php if (!empty($recent_news)): foreach($recent_news as $n): ?>
                                        <li>
                                            <strong><?= htmlspecialchars($n->title) ?></strong>
                                            <div class="muted small"><?= date('Y-m-d', strtotime($n->published)) ?></div>
                                        </li>
                                    <?php endforeach; else: ?>
                                        <li class="muted">No recent news</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Latest Media</h5>
                                <ul class="list-unstyled recent-activity-list">
                                    <?php if (!empty($recent_media)): foreach($recent_media as $m): ?>
                                        <li>
                                            <img src="<?= htmlspecialchars($m->file) ?>" style="height:36px; width:auto; margin-right:8px; vertical-align:middle;" />
                                            <span><?= htmlspecialchars($m->caption ? $m->caption : basename($m->file)) ?></span>
                                            <div class="muted small"><?= date('Y-m-d', strtotime($m->date_uploaded)) ?></div>
                                        </li>
                                    <?php endforeach; else: ?>
                                        <li class="muted">No recent uploads</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top:10px;">
                    <div class="dash-card">
                        <h4>Quick Links</h4>
                        <p><a href="<?= base_url('admin/news') ?>">Manage News</a></p>
                        <p><a href="<?= base_url('admin/slides') ?>">Manage Slides</a></p>
                        <p><a href="<?= base_url('admin/gallery') ?>">Manage Gallery</a></p>
                        <p><a href="<?= base_url('admin/settings') ?>">Site Settings</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("admin/inc/footer") ?>