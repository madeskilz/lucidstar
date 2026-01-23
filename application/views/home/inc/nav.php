<header id="header" class="site-header clearfix">
    <div class="container">
        <div class="row">
            <div class="logo col-md-2">
                <?php $logo_path = site_option('logo_path', base_url("assets/img/logo-black.png")); ?>
                <?php $site_name = site_option('site_name', 'Lucid Stars'); ?>
                <a href="<?= base_url() ?>" style="display:inline-flex;width:225px"><img src="<?= $logo_path ?>" style="height:50px;width:auto;" alt="<?= htmlspecialchars($site_name) ?> Logo" />
                    <span class="logo-text"><?= htmlspecialchars($site_name) ?></span></a>
                <div class="mobile-menu">
                    <button id="slide-buttons" class="icon icon-navicon-round"></button>
                </div>
            </div>
            <div class="navigation col-md-10 text-right">
                <div id="sb-search" class="sb-search" style="display:none !important;">
                    <form>
                        <input class="sb-search-input" placeholder="Enter your search term..." type="search" value="" name="search" id="search">
                        <input class="sb-search-submit" type="submit" value="">
                        <span class="sb-icon-search"><i class="fa fa-search"></i></span>
                    </form>
                </div>

                <nav id="c-menu--slide-right" class="c-menu c-menu--slide-right">
                    <button class="c-menu__close icon icon-remove-delete"></button>
                    <div class="logo-menu-right text-center">
                    </div>
                    <?php
                    // Try to load a DB-driven menu; fallback to the hard-coded menu
                    $mobile_menu = get_menu('primary');
                    if (!empty($mobile_menu)) {
                        echo '<ul class="menus-mobile">' . menu_render($mobile_menu) . '</ul>';
                    } else {
                    ?>
                    <ul class="menus-mobile">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><a href="<?= base_url("about") ?>">About</a></li>
                        <li><a href="<?= base_url("admission") ?>">Admission</a></li>
                        <li class="has-child">
                            <a href="#!">Gallery</a>
                            <ul class="child">
                                <?php foreach (gallery_tags() as $tag) { ?>
                                    <li><a href="<?= base_url("gallery/$tag->tag_class-$tag->id") ?>"><?= $tag->tag_name ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a href="<?= base_url("contact") ?>">Contact</a></li>
                        <li><a href="<?= base_url("login") ?>">CMS</a></li>
                        <li><a target="_blank" href="http://portal.lucidstars.sch.ng">Portal</a></li>
                    </ul>
                    <?php } ?>
                </nav>
                <div id="slide-overlay" class="slide-overlay"></div>
                <nav id="main-menu" class="menu">
                    <?php
                    $main_menu = get_menu('primary');
                    if (!empty($main_menu)) {
                        echo '<ul id="menu-top-menu" class="menus">' . menu_render($main_menu) . '</ul>';
                    } else {
                    ?>
                    <ul id="menu-top-menu" class="menus">
                        <li class="<?= ($active === "home") ? "active" : "" ?>"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="<?= ($active === "about") ? "active" : "" ?>"><a href="<?= base_url("about") ?>">About</a></li>
                        <li class="<?= ($active === "admission") ? "active" : "" ?>"><a href="<?= base_url("admission") ?>">Admission</a></li>
                        <li class="has-child <?= ($active === "gallery") ? "active" : "" ?>">
                            <a href="#!">Gallery</a>
                            <ul class="child">
                                <?php foreach (gallery_tags() as $tag) { ?>
                                    <li><a href="<?= base_url("gallery/$tag->tag_class-$tag->id") ?>"><?= $tag->tag_name ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="<?= ($active === "contact") ? "active" : "" ?>"><a href="<?= base_url("contact") ?>">Contact</a></li>
                        <li class="<?= ($active === "login") ? "active" : "" ?>"><a href="<?= base_url("login") ?>">CMS</a></li>
                        <li><a target="_blank" href="http://portal.lucidstars.sch.ng">Portal</a></li>
                    </ul>
                    <?php } ?>
                </nav>
            </div>
        </div>
    </div>
</header>