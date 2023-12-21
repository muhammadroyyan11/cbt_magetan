<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaLowongan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model', 'base');
        $this->load->model('Ujian_m', 'ujian');
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        is_pelamar();
    }

    public function index()
    {
        $data = [
            'lowongan' => $this->base->getLowonganJoin()->result_array(),
            'title' => 'Lowongan',

        ];

        // var_dump($data['lowongan']);
        $this->template->load('template', 'kelolaLowongan/data', $data);
    }

    public function aktif()
    {
        $data = [
            'lowongan' => $this->base->aktif('lowongan')->result_array(),
            'title' => 'Lowongan Aktif',

        ];
        $this->template->load('template', 'kelolaLowongan/data', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Lowongan',
            'kategori'  => $this->base->getSub()->result_array()
        ];
        $this->template->load('template', 'kelolaLowongan/add', $data);
    }

    public function edit($id)
    {
        $data = [
            'title'     => 'Lowongan',
            'row'       => $this->base->get('lowongan', ['id_lowongan' => $id])->row(),
            'kategori'  => $this->base->getSub()->result_array()
        ];
        $this->template->load('template', 'kelolaLowongan/edit', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, true);

        $paramsLowongan = [
            'title' => $post['nama'],
            'seo_title' => slugify($post['nama']),
            'requirements' => $post['requrement'],
            'deskripsi' => $post['deskripsi'],
            'dept_id' => $post['dept_id'],
            'tipe' => $post['tipe'],
            'created' => date('Y-m-d'),
            'section'   => $post['section'],
            'deadline'  => $post['deadline'],
            'pendidikan'  => $post['pendidikan'],
            'is_active' => '1',
            'kkm' => $post['kkm']
        ];

        $count_soal = $this->ujian->get_soal(['dept_id' => $post['dept_id']])->num_rows();

        if ($count_soal < $post['jumlah']) {
            set_pesan('Bank soal yang teredia tidak mencukupi, Silahkan tambah bank soal terlebih dahulu', FALSE);
            redirect('KelolaLowongan/add');
        } else {
            $return_id =   $this->base->insert('lowongan', $paramsLowongan);
            // var_dump($return_id);

            $dateTime = date('Y-m-d H:i:s'); 
            $tz_from = 'Asia/Jakarta'; 
            $newDateTime = new DateTime($dateTime, new DateTimeZone($tz_from)); 
            $newDateTime->setTimezone(new DateTimeZone("GMT+7")); 
            $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");

            $paramsUjian = [
                'nama_ujian' => 'Test ' . $post['nama'],
                'jenis' => $post['jenis'],
                'jumlah_soal' => $post['jumlah'],
                'waktu' => $post['waktu'],
                'tgl_dibuat' => $dateTimeUTC,
                'tgl_selesai' => $post['tgl_selesai'],
                'lowongan_id' => $return_id,
                'token' => strtoupper(random_string('alpha', 5)),
            ];

            $this->base->add('ujian', $paramsUjian);

            $paramsWawancara = [
                'nama_wawancara' => 'Wawancara ' . $post['nama'],
                'tanggal'        => $post['tgl_wawancara'],
                'lowongan_id'    => $return_id
            ];

            $this->base->add('wawancara', $paramsWawancara);

            if ($this->db->affected_rows() > 0) {
                set_pesan('Data berhasil disimpan');
            } else {
                set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
            }

            redirect('KelolaLowongan');
        }
    }

    public function report($id)
    {
        $data = [
            'lowongan' => $this->base->getPelamar(['lowongan_id' => $id])->result_array(),
            // 'row' => $this->ujian->getLead(['ujian_id' => $id, 'el_hasil.status' => 0])->row(),
            // 'id'    => $id,
            'title' => 'Report Pelamar'
        ];

        // var_dump($data['lowongan']);
        $this->template->load('template', 'kelolaLowongan/report', $data);
    }

    public function compare()
    {
        $post = $this->input->post(null, true);

        $data = [
            'title' => 'Compare Data',
            'satu' => $this->base->getPelamar(['id_lamaran' => $post['pelamar_one']])->row(),
            'dua' =>  $this->base->getPelamar(['id_lamaran' => $post['pelamar_two']])->row()
        ];

        $this->template->load('template', 'kelolaLowongan/compare', $data);
    }


    public function done_send()
    {
        $post = $this->input->post(null, true);

        $params = [
            'status'    => $post['status']
        ];
        $this->base->edit('lamaran', $params, ['id_lamaran' => $post['id_lamaran']]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('kelolaLowongan/report/' . $post['lowongan_id']);
    }

    public function detail($id)
    {
        $data = [
            'row' =>  $this->base->getPelamar(['id_lamaran' => $id])->row(),
            'title' => 'Detail Hasil'
        ];
        // var_dump($data['row']);
        $this->template->load('template', 'kelolaLowongan/detail', $data);
    }

    public function prosesEdit($id)
    {
        $post = $this->input->post(null, true);

        $params = [
            'title' => $post['nama'],
            'seo_title' => slugify($post['nama']),
            'requirements' => $post['requrement'],
            'deskripsi' => $post['deskripsi'],
            'dept_id' => $post['dept_id'],
            'tipe' => $post['tipe'],
            'created' => date('Y-m-d'),
            'section'   => $post['section'],
            'is_active' => '1'
        ];

        $this->base->edit('lowongan', $params, ['id_lowongan' => $id]);
        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('kelolaLowongan');
    }

    public function delete($id)
    {
        $this->base->del('lowongan', ['id_lowongan' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil dihapus');
        } else {
            set_pesan('Terjadi kesalahan menghapus data!', FALSE);
        }

        redirect('kelolaLowongan');
    }

    public function toggle($getId)
    {
        $status = $this->base_model->getUser('lowongan', ['id_lowongan' => $getId])['is_active'];
        $toggle = $status ? 0 : 1;
        $pesan = $toggle ? 'lowongan diaktifkan.' : 'lowongan dinonaktifkan.';

        if ($this->base_model->update('lowongan', 'id_lowongan', $getId, ['is_active' => $toggle])) {
            set_pesan($pesan);
        }
        redirect('keloaLowongan');
    }
}
