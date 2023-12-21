<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BankSoal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_pelamar();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
        $this->load->model('Soal_m', 'soal');
        $this->load->model('Ujian_m', 'ujian');
    }

    public function index()
    {
        $data = [
            'soal' => $this->base->getBankSoal()->result_array(),
            'title' => 'Bank Soal'
        ];
        $this->template->load('template', 'soal/data', $data);
    }

    public function add()
    {
        $soal = new stdClass();
        $soal->id_soal = null;
        $soal->pertanyaan = null;
        $soal->file = null;
        $soal->p_a = null;
        $soal->p_b = null;
        $soal->p_c = null;
        $soal->p_d = null;
        $soal->file_a = null;
        $soal->file_b = null;
        $soal->file_c = null;
        $soal->file_d = null;
        $soal->tipe_file = null;
        $soal->kunci = null;
        $soal->level = null;
        $soal->hrd_id = null;
        $soal->dept_id = null;

        // $where = array('login_id' => $this->session->userdata('login_session')['user']);
        // $ujian = $this->ujian->get($where)->result();

        // $tes = $this->ujian->getUjianId(25);
        // var_dump($tes);

        $data = [
            'title' => 'Bank Soal',
            'row' => $soal,
            'page' => 'add',
            'kategori'  => $this->base->getSub()->result_array()
            // 'ujian' => $ujian
        ];

        $this->template->load('template', 'soal/add', $data);
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Soal',
            'row'   => $this->base->get('soal', ['id_soal' => $id])->row(),
            'page'  => 'edit',
            'kategori'  => $this->base->getSub()->result_array()
        ];

        $this->template->load('template', 'soal/add', $data);
    }

    public function file_config()
    {
        $allowed_type     = [
            "image/jpeg", "image/jpg", "image/png", "image/gif",
            "audio/mpeg", "audio/mpg", "audio/mpeg3", "audio/mp3", "audio/x-wav", "audio/wave", "audio/wav",
            "video/mp4", "application/octet-stream"
        ];
        $config['upload_path']      = FCPATH . 'uploads/bank_soal/';
        $config['allowed_types']    = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        // $config['encrypt_name']     = TRUE;

        return $this->load->library('upload', $config);
    }

    public function del($id)
    {
        $this->base->del('soal', ['id_soal' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil di hapus');
        } else {
            set_pesan('Gagal Menghapus data', FALSE);
        }

        redirect('bankSoal');
    }

    public function prosesAdd()
    {
        $post = $this->input->post(null, true);

        $config['upload_path']          = './assets/uploads/bank_soal/';
        $config['allowed_types']        = 'jpeg|jpg|png|gif|mpeg|mpg|mpeg3|mp3|wav|wave|mp4';
        $config['file_name']            = 'soal-' . userdata('nama') . date('ymd') . '-' . substr(md5(rand()), 0, 6);

        $this->load->library('upload', $config);

        if (isset($_POST['add'])) {

            if (@$_FILES['file_soal']['name'] != null) {
                if ($this->upload->do_upload('file_soal')) {
                    $post['file_soal'] = $this->upload->data('file_name');
                    $post['tipe_file'] = $this->upload->data('file_type');

                    $params = [
                        'pertanyaan' => $post['pertanyaan'],
                        'p_a' => $post['p_a'],
                        'p_b' => $post['p_b'],
                        'p_c' => $post['p_c'],
                        'p_d' => $post['p_d'],
                        'kunci' => $post['kunci'],
                        'file'  => $post['file_soal'],
                        'tipe_file' => $post['tipe_file'],
                        'dept_id'   => $post['dept_id']
                    ];

                    $this->base->add('soal', $params);

                    if ($this->db->affected_rows() > 0) {
                        set_pesan('Soal berhasil di tambahkan');
                    } else {
                        set_pesan('Gagal menyimpan soal, silahkan cek kembali form inputan soal', FALSE);
                    }

                    redirect('bankSoal');
                } else {
                    'error';
                }
            } else {
                $params = [
                    'pertanyaan' => $post['pertanyaan'],
                    'p_a' => $post['p_a'],
                    'p_b' => $post['p_b'],
                    'p_c' => $post['p_c'],
                    'p_d' => $post['p_d'],
                    'kunci' => $post['kunci'],
                    'dept_id'   => $post['dept_id']
                ];

                $this->base->add('soal', $params);

                if ($this->db->affected_rows() > 0) {
                    set_pesan('Soal berhasil di tambahkan');
                } else {
                    set_pesan('Gagal menyimpan soal, silahkan cek kembali form inputan soal', FALSE);
                }

                redirect('bankSoal');
            }
        } elseif (isset($_POST['edit'])) {
            if (@$_FILES['file_soal']['name'] != null) {
                if ($this->upload->do_upload('file_soal')) {
                    $post['file_soal'] = $this->upload->data('file_name');
                    $post['tipe_file'] = $this->upload->data('file_type');

                    $params = [
                        'pertanyaan' => $post['pertanyaan'],
                        'p_a' => $post['p_a'],
                        'p_b' => $post['p_b'],
                        'p_c' => $post['p_c'],
                        'p_d' => $post['p_d'],
                        'kunci' => $post['kunci'],
                        'file'  => $post['file_soal'],
                        'tipe_file' => $post['tipe_file'],
                        'dept_id'   => $post['dept_id']
                    ];

                    $this->base->edit('soal', $params, ['id_soal' => $post['id_soal']]);

                    if ($this->db->affected_rows() > 0) {
                        set_pesan('Soal berhasil di edit');
                    } else {
                        set_pesan('Gagal menyimpan soal, silahkan cek kembali form inputan soal', FALSE);
                    }

                    redirect('bankSoal');
                } else {
                    echo 'error';
                }
            } else {
                $params = [
                    'pertanyaan' => $post['pertanyaan'],
                    'p_a' => $post['p_a'],
                    'p_b' => $post['p_b'],
                    'p_c' => $post['p_c'],
                    'p_d' => $post['p_d'],
                    'kunci' => $post['kunci'],
                    'dept_id'   => $post['dept_id']
                ];

                $this->base->edit('soal', $params, ['id_soal' => $post['id_soal']]);

                if ($this->db->affected_rows() > 0) {
                    set_pesan('Soal berhasil di edit');
                } else {
                    set_pesan('Gagal menyimpan soal, silahkan cek kembali form inputan soal', FALSE);
                }

                redirect('bankSoal');
            }
        }
    }

    public function prosesEdit($id)
    {
        $post = $this->input->post(null, true);

        $params = [
            'nama_kategori' => $post['kategori']
        ];

        $this->base->edit('kategori', $params, ['id_kategori' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('Kategori');
    }

    public function delete($id)
    {
        $this->base->del('kategori', ['id_kategori' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil dihapus');
        } else {
            set_pesan('Terjadi kesalahan menghapus data!', FALSE);
        }

        redirect('Kategori');
    }
}
