<?php
class User_model extends CI_Model
{
    // Fetch a single user by username or email
    public function get_by_login($login)
    {
        $this->db->group_start();
        $this->db->where('email', $login);
        $this->db->or_where('username', $login);
        $this->db->group_end();
        $result = $this->db->get('users', 1)->row();
        return $result;
    }

    // Update user's password (expects already-hashed password)
    public function update_password($user_id, $new_hash)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', array('password' => $new_hash));
        return $this->db->affected_rows();
    }
}