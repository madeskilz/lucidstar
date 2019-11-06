<header id="header" class="site-header clearfix">
    <div class="container">
        <div class="row">
            <div class="logo col-md-2">
                <a href="<?= base_url() ?>" style="display:inline-flex;width:225px"><img src="<?= base_url("assets/img/logo-black.png") ?>" style="height:50px;width:auto;" alt="Kindergarten Logo" />
                    <span class="logo-text">Lucid Stars</span></a>
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
                </nav>
                <div id="slide-overlay" class="slide-overlay"></div>
                <nav id="main-menu" class="menu">
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
                </nav>
            </div>
        </div>
    </div>
</header>