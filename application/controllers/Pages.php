<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
    }

    public function view($slug = null)
    {
        if (!$slug) return show_404();
        // allow numeric ids or slugs
        $page = $this->Page_model->get($slug);
        if (!$page) return show_404();
        $p = [];
        $p['title'] = $page->title;
        $p['page'] = $page;
        // allow themes to render pages via views/pages/view.php
        $this->load->view('pages/view', $p);
    }
}
