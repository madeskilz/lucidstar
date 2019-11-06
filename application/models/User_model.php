<?php
class User_model extends CI_Model
{
    function validate($login, $password)
    {
        $this->db->group_start();
        $this->db->where('email', $login);
        $this->db->or_where('username', $login);
        $this->db->group_end();
        $this->db->where('password', $password);
        $result = $this->db->get('users', 1)->result();
        return $result;
    }
}