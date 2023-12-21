<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        // if (!is_admin()) {
        //     redirect('dashboard');
        // }
        is_pelamar();
        $this->load->model('Base_model', 'base');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->base_model->getUsers(userdata('id_user'));

        $this->template->load('template', 'user/data', $data);
    }

    public function bulan()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->base_model->getNewMember()->result_array();
        // var_dump($data['users']);

        $this->template->load('template', 'user/data', $data);
    }

    public function uploaded()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->base_model->getPegguna('user', ['cv <>' => null])->result_array();
        // var_dump($data['users']);

        $this->template->load('template', 'user/data', $data);
    }
    public function not_uploaded()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->base_model->getPegguna('user', ['cv' => null])->result_array();
        // var_dump($data['users']);

        $this->template->load('template', 'user/data', $data);
    }

    private function _validasi($mode)
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($mode == 'add') {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim');
        } else {
            $db = $this->base_model->getUser('user', ['id_user' => $this->input->post('id_user', true)]);
            $username = $this->input->post('username', true);
            $email = $this->input->post('email', true);

            $uniq_username = $db['username'] == $username ? '' : '|is_unique[user.username]';
            $uniq_email = $db['email'] == $email ? '' : '|is_unique[user.email]';

            $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric' . $uniq_username);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $uniq_email);
        }
    }

    public function add()
    {

        // $this->template->load('template', 'user/add', $data);

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('password2', 'Password', 'matches[password]|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('ttl', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis_kelamin', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('jenjang_pendidikan', 'Jenjang Pendidikan', 'required|trim');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Add new user'
            );
            $this->template->load('template', 'user/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $params = [
                'nama'          => $input['nama'],
                'email'         => $input['email'],
                'no_telp'       => $input['no_telp'],
                'ttl'           => $input['ttl'],
                'alamat'        => $input['alamat'],
                'agama'         => $input['agama'],
                'jenjang_pendidikan'        => $input['jenjang_pendidikan'],
                'jenis_kelamin'        => $input['jenis_kelamin'],
                'password'      => password_hash($input['password'], PASSWORD_DEFAULT),
                'role'          => $input['role'],
                'is_active'     => 1,
                'foto'          => 'user.jpg',
                'createdOn'     => date('Y-m-d')
            ];

            if ($this->base_model->insert('user', $params)) {
                set_pesan('data berhasil disimpan.');
                redirect('user');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('user/add');
            }
        }
    }



    public function proses()
    {
        $input = $this->input->post(null, true);

        $input_data = [
            'nama_lengkap'  => $input['nama'],
            'username'      => $input['username'],
            'email'         => $input['email'],
            'no_telp'       => $input['no_telp'],
            'role'          => $input['role'],
            'password'      => password_hash($input['password'], PASSWORD_DEFAULT),
            'created_at'    => time(),
            'foto'          => 'user.png',
            'is_active'     => 1
        ];


        if ($this->base_model->insert('user', $input_data)) {
            set_pesan('data berhasil disimpan.');
            redirect('user');
        } else {
            set_pesan('data gagal disimpan', false);
            redirect('user/add');
        }
    }

    public function add2()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah User";
            $this->template->load('template', 'user/add', $data);
        } else {
            $input = $this->input->post(null, true);

            $input_data = [
                'nama_lengkap'  => $input['nama'],
                'username'      => $input['username'],
                'email'         => $input['email'],
                'no_telp'       => $input['no_telp'],
                'role'          => $input['role'],
                'password'      => password_hash($input['password'], PASSWORD_DEFAULT),
                'created_at'    => time(),
                'foto'          => 'user.png'
            ];


            if ($this->base_model->insert('user', $input_data)) {
                set_pesan('data berhasil disimpan.');
                redirect('user');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('user/add');
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit User";
        // $data['user'] = $this->base_model->getUser('user', ['id_user' => $id]);
        $data['row'] = $this->base_model->get('user', ['id_user' => $id])->row();
        $this->template->load('template', 'user/edit', $data);
    }

    public function prosesAdd()
    {
        $input = $this->input->post(null, true);
        $params = [
            'nama'          => $input['nama'],
            'email'         => $input['email'],
            'no_telp'       => $input['no_telp'],
            'ttl'           => $input['ttl'],
            'alamat'        => $input['alamat'],
            'agama'         => $input['agama'],
            'jenjang_pendidikan'        => $input['jenjang_pendidikan'],
            'jenis_kelamin'        => $input['jenis_kelamin'],
            'password'      => password_hash($input['password'], PASSWORD_DEFAULT)
        ];

        $this->base->add('user', $params);

        if ($this->db->affected_rows() > 0) {
            set_pesan('data berhasil ditambahkan.');
        } else {
            set_pesan('data gagal diubah.', false);
        }

        redirect('user');
    }

    public function prosesEdit()
    {
        $input = $this->input->post(null, true);
        $params = [
            'nama'          => $input['nama'],
            'email'         => $input['email'],
            'no_telp'       => $input['no_telp'],
            'ttl'           => $input['ttl'],
            'alamat'        => $input['alamat'],
            'agama'        => $input['agama'],
            'jenjang_pendidikan'        => $input['jenjang_pendidikan'],
            'jenis_kelamin'        => $input['jenis_kelamin'],
        ];

        if ($input['password'] != null) {
            $params['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }
        // var_dump($params);
        $this->base->edit('user', $params, ['id_user' => $input['id_user']]);
        if ($this->db->affected_rows() > 0) {
            set_pesan('data berhasil diubah.');
            redirect('user');
        } else {
            set_pesan('data gagal diubah.', false);
            redirect('user/edit/' . $input['id_user']);
        }
    }

    public function edit2($id)
    {
        // $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit User";
            $data['user'] = $this->base_model->getUser('user', ['id_user' => $id]);
            var_dump($data['user']);
            // $this->template->load('template', 'user/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'nama_lengkap'  => $input['nama'],
                'username'      => $input['username'],
                'email'         => $input['email'],
                'no_telp'       => $input['no_telp'],
                'role'          => $input['role']
            ];

            if ($this->base_model->update('user', 'id_user', $id, $input_data)) {
                set_pesan('data berhasil diubah.');
                redirect('user');
            } else {
                set_pesan('data gagal diubah.', false);
                redirect('user/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        // $id = encode_php_tags($getId);
        if ($this->base_model->delete('user', 'id_user', $getId)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('user');
    }

    public function toggle($getId)
    {
        $status = $this->base_model->getUser('user', ['id_user' => $getId])['is_active'];
        $toggle = $status ? 0 : 1;
        $pesan = $toggle ? 'user diaktifkan.' : 'user dinonaktifkan.';

        if ($this->base_model->update('user', 'id_user', $getId, ['is_active' => $toggle])) {
            set_pesan($pesan);
        }
        redirect('user');
    }
}
