<?php
defined('BASEPATH') or exit('No direct script access allowed');

class about
{
    public $school_name = "";
    public $slogan = "";
    public $address = "";
    public $vision = "";
    public $mission = "";
    public $achievements = "";
    public $about = "";
    public $phone1 = "";
    public $phone2 = "";
}
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Require an authenticated admin session for all Admin routes.
        if (!$this->session->userdata("logged_in") || $this->session->userdata("level") != "1") {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $p["active"] = "home";
        $p["title"] = "Admin Dashboard";

        // try cached counts first (TTL seconds)
        $ttl = 30; // seconds
        $p['counts'] = $this->get_dashboard_counts($ttl);

        // recent activity: latest 5 news and media (only if tables exist)
        $p['recent_news'] = array();
        $p['recent_media'] = array();
        if ($this->db->table_exists('news')) {
            $p['recent_news'] = $this->db->order_by('published', 'DESC')->limit(5)->get('news')->result();
        }
        if ($this->db->table_exists('media')) {
            $p['recent_media'] = $this->db->order_by('date_uploaded', 'DESC')->limit(5)->get('media')->result();
        }

        $this->load->view('admin/index', $p);
    }

    /**
     * Simple file-based cache for dashboard counts to reduce DB queries.
     * Returns associative array of counts.
     */
    private function get_dashboard_counts($ttl = 30)
    {
        $cache_file = APPPATH . 'cache/dashboard_counts.json';
        if (file_exists($cache_file)) {
            $meta = @stat($cache_file);
            if ($meta && (time() - $meta['mtime'] < $ttl)) {
                $data = @file_get_contents($cache_file);
                $arr = @json_decode($data, true);
                if (is_array($arr)) return $arr;
            }
        }

        // compute counts (check table existence to avoid DB errors)
        $tables = ['news','slides','gallery','menus','menu_items','media','ctas','settings'];
        $counts = [];
        foreach ($tables as $t) {
            if ($t === 'settings') {
                // settings uses a where-count_all_results
                if ($this->db->table_exists('settings')) {
                    $counts['settings'] = (int)$this->db->where('skey IS NOT NULL', null, false)->count_all_results('settings');
                } else {
                    $counts['settings'] = 0;
                }
                continue;
            }
            if ($this->db->table_exists($t)) {
                $counts[$t] = (int)$this->db->count_all($t);
            } else {
                $counts[$t] = 0;
            }
        }

        // write cache (best-effort)
        @file_put_contents($cache_file, json_encode($counts));
        return $counts;
    }
    /**
     * Site settings editor — supports logo upload and common site options.
     */
    public function settings()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_settings();
        }
        $p['active'] = "settings";
        $p['title'] = "Site Settings";
        // load current values from `settings` table (safe defaults) — include hero and stats
        $keys = [
            'site_name', 'logo_path', 'short_description', 'hero_heading', 'hero_subtext',
            'stat_staff','stat_students','stat_classes','stat_labs',
            'address', 'phone1', 'phone2', 'email', 'staff_email_url',
            'social_facebook', 'social_twitter', 'social_instagram'
        ];
        if ($this->db->table_exists('settings')) {
            foreach ($keys as $k) {
                $row = $this->db->where('skey', $k)->get('settings', 1)->row();
                $p[$k] = ($row && isset($row->svalue)) ? $row->svalue : '';
            }
        } else {
            foreach ($keys as $k) $p[$k] = '';
        }
        $this->load->view('admin/settings', $p);
    }

    private function update_settings()
    {
        // keys we'll accept from the form (add hero and stats keys)
        $keys = [
            'site_name','short_description','hero_heading','hero_subtext',
            'stat_staff','stat_students','stat_classes','stat_labs',
            'address','phone1','phone2','email','staff_email_url',
            'social_facebook','social_twitter','social_instagram'
        ];
        // handle logo upload
        if (isset($_FILES) && isset($_FILES['logo']) && $_FILES['logo']['name'] != '') {
            $imagePrefix = time();
            $imagename = $imagePrefix . $_FILES['logo']['name'];
            $path = './sitefiles/media/';
            if (!is_dir($path)) @mkdir($path, 0755, true);
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|gif|jpg|png|svg';
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('logo')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                return redirect('admin/settings');
            } else {
                $upload_data = $this->upload->data();
                // store full URL for convenience in views
                $logo_url = base_url("sitefiles/media/" . $upload_data['file_name']);
                $this->db->where('skey','logo_path');
                $exists = $this->db->get('settings',1)->row();
                if ($exists) {
                    $this->db->where('skey','logo_path')->set('svalue',$logo_url)->update('settings');
                } else {
                    $this->db->insert('settings', ['skey'=>'logo_path','svalue'=>$logo_url]);
                }
            }
        }

        // save other keys
        foreach ($keys as $k) {
            $v = trim($this->input->post($k));
            $this->db->where('skey',$k);
            $exists = $this->db->get('settings',1)->row();
            if ($exists) {
                $this->db->where('skey',$k)->set('svalue',$v)->update('settings');
            } else {
                $this->db->insert('settings', ['skey'=>$k,'svalue'=>$v]);
            }
        }

        $this->session->set_flashdata('success_msg', 'Settings saved.');
        $this->clear_dashboard_cache();
        return redirect('admin/settings');
    }
    public function about()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_about();
        }
        $p['active'] = "about";
        $p['title'] = "About";
        $abt = $this->db->get("about",1)->row();
        if ($abt !== null) {
            $p["about"] = $abt;
        }else {
            $p['about'] = new about;
        }
        $this->load->view("admin/about", $p);
    }
    private function update_about()
    {
        $abt = $this->db->get("about", 1)->row();
        $data = array(
            "school_name" => trim($this->input->post('school_name')),
            "slogan" => trim($this->input->post('slogan')),
            "address" => trim($this->input->post('address')),
            "vision" => trim($this->input->post('vision')),
            "mission" => trim($this->input->post('mission')),
            "achievements" => trim($this->input->post('achievements')),
            "about" => trim($this->input->post('about')),
            "phone1" => trim($this->input->post('phone1')),
            "phone2" => trim($this->input->post('phone2'))
        );
        if ($abt !== null) {
            $this->db->where("id", $abt->id);
            $this->db->set($data);
            if ($this->db->update("about")) {
                $this->session->set_flashdata('success_msg', 'About us successfully updated.');
                redirect("admin/about");
            } else {
                $this->session->set_flashdata('error_msg', "Error Updating About us");
                redirect("admin/about");
            };
        } else {
            if ($this->db->insert("about", $data)) {
                $this->session->set_flashdata('success_msg', 'About us successfully added.');
                redirect("admin/about");
            } else {
                $this->session->set_flashdata('error_msg', "Error adding About us");
                redirect("admin/about");
            };
        }
    }
    public function news()
    {
        $p["active"] = "news";
        $p["title"] = "News & Updates";
        $p["updates"] = $this->db->get("news")->result();
        $this->load->view('admin/news', $p);
    }
    public function add_news()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->new_update();
        }
        $p["active"] = "news";
        $p["title"] = "Add News";
        $this->load->view('admin/add-news', $p);
    }
    private function new_update()
    {
        $data = array();
        $data['title'] = trim($this->input->post('title'));
        $data['details'] = trim($this->input->post('details'));
        if ($this->db->insert("news", $data)) {
            $this->session->set_flashdata('success_msg', "News update added successfully");
            $this->clear_dashboard_cache();
            return redirect("admin/news");
        } else {
            $this->session->set_flashdata('error_msg', "News update not added contact admin if error persists");
            return redirect("admin/add_news");
        }
    }
    public function edit_news($id)
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_news($id);
        }
        $this->db->where("id", $id);
        $news = $p["news"] = $this->db->get("news", 1)->row();
        if ($news == null) {
            $this->session->set_flashdata('error_msg', "News not found");
            return redirect("admin/news");
        }
        $p["active"] = "news";
        $p["title"] = "Edit News";
        $this->load->view('admin/edit-news', $p);
    }
    public function remove_news($id)
    {
        $this->db->where("id", $id);
        $news = $this->db->get("news", 1)->row();
        if ($news == null) {
            $this->session->set_flashdata('error_msg', "News not found");
            return redirect("admin/news");
        }

        $this->db->where('id', $id)->delete('news');
        $this->clear_dashboard_cache();
        $this->session->set_flashdata('success_msg', "News deleted successfully");
        return redirect("admin/news");
    }

    private function update_news($id)
    {
        $data = array();
        $data['title'] = trim($this->input->post('title'));
        $data['details'] = trim($this->input->post('details'));
        $this->db->where("id", $id);
        $this->db->set($data);
        if ($this->db->update("news", $data)) {
            $this->session->set_flashdata('success_msg', "News updated successfully");
            $this->clear_dashboard_cache();
            return redirect("admin/news");
        } else {
            $this->session->set_flashdata('error_msg', "News not updated contact admin if error persists");
            return redirect("admin/edit_news");
        }
    }
    public function gallery()
    {
        $p["active"] = "gallery";
        $p["title"] = "Gallery";
        $p["gallery"] = $this->db->get("gallery")->result();
        $p["gallery_tags"] = $this->db->get("gallery_tags")->result();
        $this->load->view('admin/gallery', $p);
    }
    public function gallery_tag()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $data = array();
            $id = trim($this->input->post('id'));
            $data['tag_class'] = trim($this->input->post('tag_class'));
            $data['tag_name'] = $tn = trim($this->input->post('tag_name'));
            $action = trim($this->input->post('action'));
            // var_dump($action);exit;
            if ($action == "edit") {
                $this->db->where("id", $id);
                $this->db->set($data);
                if ($this->db->update("gallery_tags")) {
                    $this->session->set_flashdata('success_msg', 'Event tag successfully updated.');
                    redirect("admin/gallery");
                } else {
                    $this->session->set_flashdata('error_msg', "Error Updating Event Tag");
                    redirect("admin/gallery");
                };
            } else {
                $data['tag_class'] = preg_replace("/[^\w-]/", "-", strtolower($tn));
                if ($this->db->insert("gallery_tags", $data)) {
                    $this->session->set_flashdata('success_msg', 'Event tag successfully added.');
                    redirect("admin/gallery");
                } else {
                    $this->session->set_flashdata('error_msg', "Error adding Event Tag");
                    redirect("admin/gallery");
                };
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function add_img()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->new_img();
        }
        $p["active"] = "gallery";
        $p["title"] = "Add Gallery Image";
        $this->load->view('admin/add-img', $p);
    }
    public function edit_img($id)
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_img($id);
        }
        $this->db->where("id", $id);
        $img = $p["img"] = $this->db->get("gallery", 1)->row();
        if ($img == null) {
            $this->session->set_flashdata('error_msg', "Image not found");
            return redirect("admin/gallery");
        }
        // var_dump($img->tags);
        // exit;
        $p["active"] = "gallery";
        $p["title"] = "Edit Gallery Image";
        $this->load->view('admin/edit-img', $p);
    }
    public function remove_img($id)
    {
        $this->db->where("id", $id);
        $img = $this->db->get("gallery", 1)->row();
        if ($img == null) {
            $this->session->set_flashdata('error_msg', "Image not found");
            return redirect("admin/gallery");
        }

        // attempt to unlink local gallery file if present
        $local = './sitefiles/gallery/' . $img->image;
        if (file_exists($local)) @unlink($local);

        $this->db->where('id', $id)->delete('gallery');
        $this->clear_dashboard_cache();
        $this->session->set_flashdata('success_msg', "Image deleted successfully");
        return redirect("admin/gallery");
    }
    public function remove_tag($id)
    {
        $this->db->where("id", $id);
        $tag = $this->db->get("gallery_tags", 1)->row();
        if ($tag == null) {
            $this->session->set_flashdata('error_msg', "Tag not found");
            return redirect("admin/gallery");
        } else {
            $this->db->where("id", $id);
            $this->db->delete("gallery_tags");
            $this->session->set_flashdata('success_msg', "Tag deleted successfully");
            return redirect("admin/gallery");
        }
    }
    private function new_img()
    {
        $upload_data = array();
        $data['tags'] = implode(",", $this->input->post('tags'));
        // var_dump($data['tags']);
        // exit;
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagePrefix = time();
            $imagename = $imagePrefix . $_FILES['image']['name'];
            $path = './sitefiles/gallery/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("admin/add_img");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        $data['image'] = $upload_data['file_name'];
        if ($this->db->insert("gallery", $data)) {
            $this->session->set_flashdata('success_msg', 'Image successfully added.');
            $this->clear_dashboard_cache();
            redirect("admin/gallery");
        } else {
            $this->session->set_flashdata('error_msg', "Error Saving Image");
            redirect("admin/add_img");
        };
    }
    private function update_img($id)
    {
        $upload_data = array();
        $data['tags'] = implode(",", $this->input->post('tags'));
        // var_dump($data['tags']);
        // exit;
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagePrefix = time();
            $imagename = $imagePrefix . $_FILES['image']['name'];
            $path = './sitefiles/gallery/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("admin/edit_img");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        if (count($upload_data) > 0) :
            $data['image'] = ($upload_data['file_name']);
        endif;
        $this->db->where("id", $id);
        $this->db->set($data);
        if ($this->db->update("gallery")) {
            $this->session->set_flashdata('success_msg', 'Image successfully updated.');
            $this->clear_dashboard_cache();
            redirect("admin/gallery");
        } else {
            $this->session->set_flashdata('error_msg', "Error updating image");
            redirect("admin/edit_img");
        };
    }
    public function slides()
    {
        $p["active"] = "slides";
        $p["title"] = "Homepage Slides";
        $p["slides"] = $this->db->get("slides")->result();
        $this->load->view('admin/slides', $p);
    }

    /**
     * Menus management
     */
    public function menus()
    {
        $p['active'] = 'menus';
        $p['title'] = 'Menus';
        $p['menus'] = $this->db->get('menus')->result();
        $this->load->view('admin/menus', $p);
    }

    public function add_menu()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') return redirect('admin/menus');
        $name = trim($this->input->post('menu_name'));
        $label = trim($this->input->post('label'));
        if ($name == '') {
            $this->session->set_flashdata('error_msg','Menu name required');
            return redirect('admin/menus');
        }
        $this->db->insert('menus', ['menu_name'=>$name,'label'=>$label]);
        $this->session->set_flashdata('success_msg','Menu created');
        $this->clear_dashboard_cache();
        return redirect('admin/menus');
    }

    public function edit_menu($id)
    {
        $this->db->where('id',$id);
        $menu = $this->db->get('menus',1)->row();
        if (!$menu) { $this->session->set_flashdata('error_msg','Menu not found'); return redirect('admin/menus'); }
        $p['menu'] = $menu;
        $p['items'] = $this->db->where('menu_id',$id)->order_by('sort_order','ASC')->get('menu_items')->result();
        $this->load->view('admin/edit-menu', $p);
    }

    public function remove_menu($id)
    {
        $this->db->where('id',$id);
        $menu = $this->db->get('menus',1)->row();
        if (!$menu) { $this->session->set_flashdata('error_msg','Menu not found'); return redirect('admin/menus'); }
        $this->db->where('id',$id)->delete('menus');
        // remove items
        $items = $this->db->where('menu_id',$id)->get('menu_items')->result();
        // store for undo (push onto deleted_menus stack, keep last 5)
        $stack = $this->session->userdata('deleted_menus');
        if (!$stack || !is_array($stack)) $stack = array();
        array_unshift($stack, ['menu' => (array)$menu, 'items' => array_map(function ($i) {
            return (array)$i;
        }, $items)]);
        $stack = array_slice($stack, 0, 5);
        $this->session->set_userdata('deleted_menus', $stack);
        $this->db->where('menu_id',$id)->delete('menu_items');
        $this->clear_dashboard_cache();
        $this->session->set_flashdata('success_msg','Menu removed. <a href="'.base_url('admin/restore_menu').'">Undo</a>');
        return redirect('admin/menus');
    }

    public function restore_menu()
    {
        $stack = $this->session->userdata('deleted_menus');
        if (!$stack || !is_array($stack) || count($stack) == 0) { $this->session->set_flashdata('error_msg','Nothing to restore'); return redirect('admin/menus'); }
        $data = array_shift($stack);
        $this->session->set_userdata('deleted_menus', $stack);
        $menu = $data['menu'];
        if (isset($menu['id'])) unset($menu['id']);
        $this->db->insert('menus', $menu);
        $new_menu_id = $this->db->insert_id();
        if (!empty($data['items'])) {
            foreach ($data['items'] as $it) {
                if (isset($it['id'])) unset($it['id']);
                $it['menu_id'] = $new_menu_id;
                $this->db->insert('menu_items',$it);
            }
        }
        $this->session->set_flashdata('success_msg','Menu restored');
        return redirect('admin/menus');
    }

    public function menu_item_save()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') return redirect('admin/menus');
        $menu_id = intval($this->input->post('menu_id'));
        $title = trim($this->input->post('title'));
        $url = trim($this->input->post('url'));
        $parent_id = intval($this->input->post('parent_id'));
        $sort_order = intval($this->input->post('sort_order'));
        if ($title == '' || $url == '') { $this->session->set_flashdata('error_msg','Title and URL required'); return redirect('admin/edit_menu/'.$menu_id); }
        $this->db->insert('menu_items', ['menu_id'=>$menu_id,'title'=>$title,'url'=>$url,'parent_id'=>$parent_id,'sort_order'=>$sort_order]);
        $this->session->set_flashdata('success_msg','Menu item added');
        $this->clear_dashboard_cache();
        return redirect('admin/edit_menu/'.$menu_id);
    }

    public function remove_menu_item($id)
    {
        $this->db->where('id',$id);
        $it = $this->db->get('menu_items',1)->row();
        if (!$it) { $this->session->set_flashdata('error_msg','Menu item not found'); return redirect('admin/menus'); }
        $menu_id = $it->menu_id;
        // push deleted row into session stack for undo (keep last 10)
        $stack = $this->session->userdata('deleted_menu_items');
        if (!$stack || !is_array($stack)) $stack = array();
        array_unshift($stack, (array)$it);
        $stack = array_slice($stack, 0, 10);
        $this->session->set_userdata('deleted_menu_items', $stack);
        $this->db->where('id',$id)->delete('menu_items');
        $this->clear_dashboard_cache();
        $undo_link = base_url('admin/restore_menu_item');
        $this->session->set_flashdata('success_msg','Menu item removed. <a href="'.$undo_link.'">Undo</a>');
        return redirect('admin/edit_menu/'.$menu_id);
    }

    public function save_menu_order($menu_id)
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') return redirect('admin/menus');
        $order_raw = $this->input->post('order');
        if (!$order_raw) { $this->output->set_status_header(400); echo 'no order'; return; }
        $items = json_decode($order_raw, true);
        if (!is_array($items)) { $this->output->set_status_header(400); echo 'invalid'; return; }
        // items is expected as array of {id,parent_id,depth,order}
        // We'll update parent_id and sort_order based on the order in the array
        $orders = array();
        foreach ($items as $it) {
            $id = intval($it['id']);
            $parent = intval($it['parent_id']);
            if (!isset($orders[$parent])) $orders[$parent] = 0;
            $sort = $orders[$parent]++;
            $this->db->where('id',$id)->set(['parent_id'=>$parent,'sort_order'=>$sort])->update('menu_items');
        }
        // update complete, clear cache so dashboard reflects new order
        $this->clear_dashboard_cache();
        echo 'ok';
    }

    public function restore_menu_item()
    {
        $stack = $this->session->userdata('deleted_menu_items');
        if (!$stack || !is_array($stack) || count($stack) == 0) { $this->session->set_flashdata('error_msg','Nothing to restore'); return redirect('admin/menus'); }
        $data = array_shift($stack);
        $this->session->set_userdata('deleted_menu_items', $stack);
        if (isset($data['id'])) unset($data['id']);
        $this->db->insert('menu_items', $data);
        $this->session->set_flashdata('success_msg','Menu item restored');
        return redirect('admin/menus');
    }

    /**
     * Media management (upload/list/delete)
     */
    public function media()
    {
        $p['active'] = 'media';
        $p['title'] = 'Media Library';
        $p['media'] = $this->db->order_by('date_uploaded','DESC')->get('media')->result();
        $this->load->view('admin/media', $p);
    }

    public function add_media()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') return redirect('admin/media');
        if (!isset($_FILES) || !isset($_FILES['file']) || $_FILES['file']['name']=='') { $this->session->set_flashdata('error_msg','No file'); return redirect('admin/media'); }
        $imagePrefix = time();
        $imagename = $imagePrefix . $_FILES['file']['name'];
        $path = './sitefiles/media/';
        if (!is_dir($path)) @mkdir($path,0755,true);
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpeg|gif|jpg|png|svg|webp';
        $config['file_name'] = $imagename;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('error_msg', $this->upload->display_errors());
            return redirect('admin/media');
        }
        $ud = $this->upload->data();
        $file_url = base_url('sitefiles/media/'.$ud['file_name']);
        $alt = trim($this->input->post('alt'));
        $caption = trim($this->input->post('caption'));
        $this->db->insert('media', ['file'=>$file_url,'type'=>$ud['file_type'],'alt'=>$alt,'caption'=>$caption]);
        $this->session->set_flashdata('success_msg','Media uploaded');
        $this->clear_dashboard_cache();
        return redirect('admin/media');
    }

    public function remove_media($id)
    {
        $this->db->where('id',$id);
        $m = $this->db->get('media',1)->row();
        if (!$m) { $this->session->set_flashdata('error_msg','Media not found'); return redirect('admin/media'); }
        // attempt to unlink file (if it's under sitefiles/media)
        $u = $m->file;
        $local = null;
        if (strpos($u, 'sitefiles/media/') !== false) {
            $parts = explode('sitefiles/media/', $u);
            $local = './sitefiles/media/'.end($parts);
        }
        if ($local && file_exists($local)) @unlink($local);
        $this->db->where('id',$id)->delete('media');
        $this->clear_dashboard_cache();
        $this->session->set_flashdata('success_msg','Media removed');
        return redirect('admin/media');
    }

    /**
     * CTAs management
     */
    public function ctas()
    {
        $p['active'] = 'ctas';
        $p['title'] = 'CTAs';
        $p['ctas'] = $this->db->order_by('sort_order','ASC')->get('ctas')->result();
        $this->load->view('admin/ctas', $p);
    }

    public function add_cta()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') return redirect('admin/ctas');
        $label = trim($this->input->post('label'));
        $url = trim($this->input->post('url'));
        $style = trim($this->input->post('style'));
        $sort_order = intval($this->input->post('sort_order'));
        if ($label == '' || $url == '') { $this->session->set_flashdata('error_msg','Label & URL required'); return redirect('admin/ctas'); }
        $this->db->insert('ctas',['label'=>$label,'url'=>$url,'style'=>$style,'sort_order'=>$sort_order]);
        $this->session->set_flashdata('success_msg','CTA added');
        $this->clear_dashboard_cache();
        return redirect('admin/ctas');
    }

    public function remove_cta($id)
    {
        $this->db->where('id',$id);
        $c = $this->db->get('ctas',1)->row();
        if (!$c) { $this->session->set_flashdata('error_msg','CTA not found'); return redirect('admin/ctas'); }
        $this->db->where('id',$id)->delete('ctas');
        $this->clear_dashboard_cache();
        $this->session->set_flashdata('success_msg','CTA removed');
        return redirect('admin/ctas');
    }
    public function add_slide()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->new_slide();
        }
        $p["active"] = "slides";
        $p["title"] = "Add Slide";
        $this->load->view('admin/add-slide', $p);
    }
    public function edit_slide($id)
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->update_slide($id);
        }
        $this->db->where("id", $id);
        $slide = $p["slide"] = $this->db->get("slides", 1)->row();
        if ($slide == null) {
            $this->session->set_flashdata('error_msg', "slide not found");
            return redirect("admin/slides");
        }
        $p["active"] = "slides";
        $p["title"] = "Edit Slide";
        $this->load->view('admin/edit-slide', $p);
    }
    public function remove_slide($id)
    {
        $this->db->where("id", $id);
        $slide = $this->db->get("slides", 1)->row();
        if ($slide == null) {
            $this->session->set_flashdata('error_msg', "Slide not found");
            return redirect("admin/slides");
        } else {
            $this->db->where("id", $id);
            $this->db->delete("slides");
            $this->clear_dashboard_cache();
            $this->session->set_flashdata('success_msg', "Slide deleted successfully");
            return redirect("admin/slides");
        }
    }
    private function new_slide()
    {
        $upload_data = array();
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagePrefix = time();
            $imagename = $imagePrefix . $_FILES['image']['name'];
            $path = './sitefiles/slides/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("admin/add_slide");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        $data['headline'] = trim($this->input->post('headline'));
        $data['body'] = trim($this->input->post('body'));
        $data['image'] = $upload_data['file_name'];
        if ($this->db->insert("slides", $data)) {
            $this->session->set_flashdata('success_msg', 'Slide successfully added.');
            $this->clear_dashboard_cache();
            redirect("admin/slides");
        } else {
            $this->session->set_flashdata('error_msg', "Error Saving Slide");
            redirect("admin/add_slide");
        };
    }
    private function update_slide($id)
    {
        $upload_data = array();
        if (isset($_FILES) && $_FILES['image']['name'] != '') :
            $imagePrefix = time();
            $imagename = $imagePrefix . $_FILES['image']['name'];
            $path = './sitefiles/slides/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;
            $config['file_name'] = $imagename;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect("admin/edit_slide");
            } else {
                $upload_data = $this->upload->data();
            }
        endif;
        $data['headline'] = trim($this->input->post('headline'));
        $data['body'] = trim($this->input->post('body'));
        if (count($upload_data) > 0) :
            $data['image'] = ($upload_data['file_name']);
        endif;
        $this->db->where("id", $id);
        $this->db->set($data);
        if ($this->db->update("slides")) {
            $this->session->set_flashdata('success_msg', 'Slide successfully updated.');
            $this->clear_dashboard_cache();
            redirect("admin/slides");
        } else {
            $this->session->set_flashdata('error_msg', "Error updating slide");
            redirect("admin/edit_slide");
        };
    }

    /**
     * Clear the dashboard counts cache file if present.
     */
    private function clear_dashboard_cache()
    {
        $cache_file = APPPATH . 'cache/dashboard_counts.json';
        if (file_exists($cache_file)) @unlink($cache_file);
    }
}
