<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect("auth/login");
    }

    public function login()
    {
        if ($this->uri->uri_string() == 'auth/login')
            show_404();
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->auth();
        }
        if ($this->session->userdata("logged_in")) {
            redirect(base_url("admin"));
        }
        $p["active"] = "login";
        $p["title"] = "Admin Login";
        $this->load->view("home/login", $p);
    }

    private function auth()
    {
        $login = trim($this->input->post('login'));
        $password = md5(trim($this->input->post('password')));
        $validate = $this->user_model->validate($login, $password);
        if (count($validate) > 0) {
            $data = array();
            $data['user_id'] = $validate[0]->user_id;
            $data['username'] = $validate[0]->username;
            $data['email'] = $validate[0]->email;
            $data['active'] = $validate[0]->active;
            $data['level'] = $validate[0]->level;
            $data['logged_in'] = true;
            if ($data['active'] === '1') {
                $this->session->set_userdata($data);
                if ($data['level'] === '1') {
                    redirect('admin');
                }
            } else {
                $this->session->set_flashdata('msg', 'Account Suspended');
                redirect("login");
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Username/Email or Password Incorrect!!');
            redirect("login");
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}