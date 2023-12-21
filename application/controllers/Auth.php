<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Base_model', 'base');
    }

    private function _has_login()
    {
        if ($this->session->has_userdata('login_session')) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_has_login();

        // $data['title'] = 'Login Aplikasi';
        // $this->template->load('tempauth', 'auth/auth', $data);

        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Aplikasi';
            $this->template->load('tempauth', 'auth/auth', $data);
        } else {
            $input = $this->input->post(null, true);

            $cek_email = $this->auth->cek_email($input['email']);
            if ($cek_email > 0) {
                $password = $this->auth->get_password($input['email']);
                if (password_verify($input['password'], $password)) {
                    $user_db = $this->auth->userdata($input['email']);
                    if ($user_db['is_active'] != 1) {
                        set_pesan('akun anda belum aktif/dinonaktifkan. Silahkan hubungi admin.', false);
                        redirect('auth');
                    } else {
                        $userdata = [
                            'user'  => $user_db['id_user'],
                            'nama'  => $user_db['nama'],
                            'role'  => $user_db['role'],
                            'foto'  => $user_db['foto'],
                            'cv'    => $user_db['cv'],
                            'agama'  => $user_db['agama'],
                            'jenjang_pendidikan'  => $user_db['jenjang_pendidikan'],
                            'timestamp' => time(),
                            'status_pelamar'    => $user_db['status_pelamar'],
                        ];
                        $this->session->set_userdata('login_session', $userdata);

                        if ($user_db['role'] != 1) {
                            redirect('loker');
                        } else {
                            redirect('dashboard');
                        }
                    }
                } else {
                    set_pesan('password salah', false);
                    redirect('auth');
                }
            } else {
                set_pesan('email belum terdaftar', false);
                redirect('auth');
            }
        }
    }

    public function editProfile()
    {
        $post = $this->input->post(null, true);

        $params = [
            'nama' => $post['nama'],
        ];

        if ($post['password'] != null) {
            $params['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        $this->base->update('user', 'id_user', userdata('id_user'), $params);
        if ($this->db->affected_rows() > 0) {
            set_pesan('Data Berhasil Dismpan');
            // echo "<script type='text/javascript'>alert('File berhasil disimpan');</script>";
        } else {
            set_pesan('Data Berhasil Dismpan', false);
        }

        redirect('dashboard');
    }

    public function proses()
    {
        $input = $this->input->post(null, true);

        var_dump($input);

        $cek_email = $this->auth->cek_email($input['email']);

        var_dump($cek_email);
        if ($cek_email > 0) {
            $password = $this->auth->get_password($input['email']);
            if (password_verify($input['password'], $password)) {
                $user_db = $this->auth->userdata($input['email']);
                if ($user_db['is_active'] != 1) {
                    set_pesan('akun anda belum aktif/dinonaktifkan. Silahkan hubungi admin.', false);
                    redirect('auth');
                } else {
                    $userdata = [
                        'user'  => $user_db['id_user'],
                        'role'  => $user_db['role'],
                        'timestamp' => time()
                    ];
                    $this->session->set_userdata('login_session', $userdata);
                    redirect('dashboard');
                }
            } else {
                set_pesan('password salah', false);
                redirect('auth');
            }
        } else {
            //     set_pesan('email belum terdaftar', false);
            //     redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login_session');

        set_pesan('anda telah berhasil logout');
        redirect('home');
    }

    public function register()
    {
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

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Buat Akun';
            $this->template->load('tempauth', 'auth/register', $data);
        } else {
            $input = $this->input->post(null, true);

            // var_dump($input);
            unset($input['password2']);
            $input['nama']          = $input['nama'];
            $input['no_telp']       = $input['no_telp'];
            $input['alamat']        = $input['alamat'];
            $input['email']         = $input['email'];
            $input['password']      = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['role']          = 3;
            $input['is_active']     = 0;
            $input['foto']          = 'user.jpg';
            $input['agama']         = $input['agama'];
            $input['jenjang_pendidikan']     = $input['jenjang_pendidikan'];
            $input['createdOn']     = date('Y-m-d');

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $input['email'],
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $query = $this->base->insert('user', $input);
            if ($query) {
                set_pesan('Pendaftaran berhasil. Silahkan cek email untuk verifikasi');
                redirect('auth');
            } else {
                set_pesan('gagal menyimpan ke database', false);
                redirect('register');
            }
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->load->library('email');
        $post = $this->input->post(null, TRUE);

        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://mail.radinaltugasakhir.site',
            'smtp_user' => 'no-reply@radinaltugasakhir.site',
            'smtp_pass' => '1234Arema',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $data = [
            'from'  => $post['email'],
            'nama'  => $post['nama'],
            'link'  =>  base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token)
        ];

        $template = $this->load->view('front/email/template', $data,TRUE);

        $this->email->initialize($config);

        $this->email->from('no-reply@radinaltugasakhir.site', 'Account Verification');
        $this->email->to($post['email']);

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message($template);
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    if ($this->db->affected_rows() > 0) {
                        set_pesan('Akun berhasil verifikasi, Silahkan login');
                    }
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('auth');
        }
    }
}
