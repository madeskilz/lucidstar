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
        $password = trim($this->input->post('password'));

        $user = $this->user_model->get_by_login($login);

        if ($user) {
            $stored = $user->password;
            $verified = false;

            // If stored password looks like a PHP password_hash() value, verify with password_verify
            if (is_string($stored) && strlen($stored) > 0 && strpos($stored, '$') === 0) {
                if (password_verify($password, $stored)) {
                    $verified = true;
                    // Rehash if algorithm params changed
                    if (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
                        $this->user_model->update_password($user->user_id, password_hash($password, PASSWORD_DEFAULT));
                    }
                }
            } else {
                // Fallback for existing MD5-hashed passwords: compare and migrate on successful login
                if (md5($password) === $stored) {
                    $verified = true;
                    $this->user_model->update_password($user->user_id, password_hash($password, PASSWORD_DEFAULT));
                }
            }

            if ($verified) {
                $data = array();
                $data['user_id'] = $user->user_id;
                $data['username'] = $user->username;
                $data['email'] = $user->email;
                $data['active'] = $user->active;
                $data['level'] = $user->level;
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