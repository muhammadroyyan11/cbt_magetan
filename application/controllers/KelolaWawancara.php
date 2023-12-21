<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaWawancara extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model', 'base');
        cek_login();
        is_pelamar();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = [
            'wawancara' => $this->base->getWawancara()->result_array(),
            'title' => 'Wawancara',

        ];
        $this->template->load('template', 'kelolaWawancara/data', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Lowongan',
            'kategori'  => $this->base->getSub()->result_array()
        ];
        $this->template->load('template', 'kelolaLowongan/add', $data);
    }

    public function prosesFeedback(Type $var = null)
    {
        $post = $this->input->post(null, TRUE);

        $params = [
            'deskripsi'     => $post['deskripsi'],
            'tgl_selesai'   => date('Y-m-d H:i:s'),
            'kriteria'      => $post['kriteria'],
            'peserta_id'    => $post['peserta_id'],
            'user_id'       => $post['user_id']
        ];

        // $paramsUser = [
        //     'status_pelamar' => $post['status_pelamar']
        // ];

        $paramsView = [
            'statusLamaran' => $post['status_pelamar']
        ];

        $this->base->edit('el_hasil', $paramsView, ['siswa_id' => $post['user_id'], 'lowongan_id' => $post['lowongan_id']]);;

        // $this->base->edit('user', $paramsUser, ['id_user' => $post['user_id']]);;

        $this->base->add('hasil_wawancara', $params);


        if ($this->db->affected_rows() > 0) {
            $paramsEdit = [
                'status' => 1,
            ];

            $this->base->edit('peserta_wawancara', $paramsEdit, ['id_peserta' => $post['peserta_id']]);
            set_pesan('Feedback telah disimpan');
        } else {
            set_pesan('Gagal menyimpan data', FALSE);
        }

        redirect('kelolaWawancara/report/' . $post['wawancara_id']);
    }

    public function report($id)
    {
        $data = [
            'wawancara' => $this->base->getPeserta(['wawancara_id' => $id])->result_array(),
            // 'row' => $this->ujian->getLead(['ujian_id' => $id, 'el_hasil.status' => 0])->row(),
            // 'id'    => $id,
            'title' => 'Daftar Peserta Wawancara'
        ];

        // var_dump($data['wawancara']);
        $this->template->load('template', 'kelolaWawancara/report', $data);
    }

 
    public function detail($id)
    {
        $data = [
            'row' =>  $this->base->getFeedback(['peserta_id' => $id])->row(),
            'title' => 'Detail Hasil'
        ];
        // var_dump($data['row']);
        $this->template->load('template', 'kelolaWawancara/detail', $data);
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

        $this->base->add('lowongan', $params);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('KelolaLowongan');
    }

    public function terima($id){
        $params['status'] = 'Di Terima';

        $paramsPelamar['statusLamaran'] = 'Di Terima';

        $id_peserta = $this->base->get('hasil_wawancara', ['id_haswan' => $id])->row();

        $paramsUser = [
            'status_pelamar' => 'Di Terima'
        ];

        $this->base->edit('user', $paramsUser, ['id_user' => $id_peserta->user_id]);

        $this->base->edit('hasil_wawancara', $params, ['id_haswan' => $id]);

        $this->base->edit('peserta_wawancara', $paramsPelamar, ['id_peserta' => $id_peserta->peserta_id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('KelolaWawancara');
    }

    public function tolak($id){
        $params['status'] = 'Tidak Di Terima';

        $paramsPelamar['statusLamaran'] = 'Tidak Di Terima';

        $id_peserta = $this->base->get('hasil_wawancara', ['id_haswan' => $id])->row();

        $this->base->edit('hasil_wawancara', $params, ['id_haswan' => $id]);

        $this->base->edit('peserta_wawancara', $paramsPelamar, ['id_peserta' => $id_peserta->peserta_id]);

        
        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('KelolaWawancara');
    }

    public function prosesEdit($id)
    {
        $post = $this->input->post(null, true);

        $params = [
            'nama_wawancara'    => $post['nama_wawancara'],
            'tanggal'           => $post['tanggal']
        ];


        $this->base->edit('wawancara', $params, ['id_wawancara' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('kelolaWawancara');
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
}
