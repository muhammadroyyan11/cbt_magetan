<?php

class Fungsi
{

    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function count_siswa()
    {
        $this->ci->load->model('Admin_m', 'admin');
        return $this->ci->admin->getSiswa()->num_rows();
    }

    public function count_lowongan()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->get('lowongan')->num_rows();
    }

    public function count_aktif()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->aktif()->num_rows();
    }

    public function count_dept()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->get('kategori')->num_rows();
    }

    public function count_subDept()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->get('sub_kategori')->num_rows();
    }

    public function count_karyawan()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->get('user', ['role <>' => 1])->num_rows();
    }

    public function count_newMember()
    {   
        
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->getNewMember()->num_rows();
    }

    public function count_upload_cv()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->get('user', ['cv <>' => null])->num_rows();
    }

    public function count_no_upload()
    {
        $this->ci->load->model('Base_model', 'base');
        return $this->ci->base->get('user', ['cv' => null])->num_rows();
    }

    public function count_kelas()
    {
        $this->ci->load->model('Admin', 'admin');
        return $this->ci->admin->get('el_kelas')->num_rows();
    }

    public function count_quiz()
    {
        $where = array('login_id' => $this->ci->session->userdata('login_session')['user']);
        // var_dump($this->ci->session->userdata('login_session'));
        $this->ci->load->model('Admin_m', 'admin');
        return $this->ci->admin->get('el_ujian', $where)->num_rows();
    }

    public function count_perumahan()
    {
        $this->ci->load->model('detail_m');
        return $this->ci->detail_m->get()->num_rows();
    }

    public function count_jenis()
    {
        $this->ci->load->model('jenisPerumahan_m', 'jenis');
        return $this->ci->jenis->get()->num_rows();
    }

    public function count_antriantotal()
    {
        $this->ci->load->model('antrianloket_m');
        return $this->ci->antrianloket_m->getAll()->num_rows();
    }

    function user_login()
    {
        $this->ci->load->model('users_m');
        $user_id = $this->ci->session->userdata('id_user');
        $user_data = $this->ci->users_m->getCount($user_id)->row();
        return $user_data;
    }
}
