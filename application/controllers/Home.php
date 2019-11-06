<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$p["active"] = "home";
		$this->load->view('home/index', $p);
	}
	public function about()
	{
		$p["active"] = "about";
		$p["title"] = "About Us";
		$this->load->view('home/about', $p);
	}
	public function gallery($gname = "")
	{
		$id = explode("-", $gname)[count(explode("-", $gname)) - 1];
		$this->db->where("id", $id);
		$tag = $this->db->get("gallery_tags", 1)->row();
		if ($tag === null) return redirect(base_url());
		$this->db->like("tags", $tag->tag_class);
		$p["gallery"] = $this->db->get("gallery")->result();
		$p["active"] = "gallery";
		$p["title"] = "Gallery";
		$p["gname"] = $tag->tag_name;
		$this->load->view('home/gallery', $p);
	}
	public function xadmission()
	{
		$p["active"] = "admission";
		$p["title"] = "Admission";
		$this->load->view('home/admission', $p);
	}
	public function contact()
	{
		$p["active"] = "contact";
		$p["title"] = "Contact Us";
		$this->load->view('home/contact', $p);
	}
}
