<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function cek_username($username)
    {
        $query = $this->db->get_where('user', ['username' => $username]);
        return $query->num_rows();
    }

    public function cek_email($email)
    {
        $query = $this->db->get_where('user', ['email' => $email]);
        return $query->num_rows();
    }

    public function get_password($email)
    {
        $data = $this->db->get_where('user', ['email' => $email])->row_array();
        return $data['password'];
    }

    public function userdata($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }
}
