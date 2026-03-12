<?php $this->load->view('home/inc/header'); ?>
<main class="container page-content">
    <h1><?= isset($page->title) ? htmlspecialchars($page->title) : '' ?></h1>
    <div class="content">
        <?= isset($page->content) ? $page->content : '' ?>
    </div>
</main>
<?php $this->load->view('home/inc/footer'); ?>
