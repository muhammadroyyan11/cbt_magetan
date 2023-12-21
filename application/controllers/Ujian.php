<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
        $this->load->model('Ujian_m', 'ujian');
    }

    public function index()
    {
        $data = [
            'ujian' => $this->base->get('ujian')->result_array(),
            'lowongan' => $this->base->get('lowongan')->result_array(),
            'title' => 'Ujian'
        ];
        $this->template->load('template', 'ujian/data', $data);
    }


    public function report($id)
    {
        $data = [
            'ujian' => $this->ujian->getLeadList(['el_hasil.ujian_id' => $id, 'el_hasil.status' => 0])->result_array(),
            'row' => $this->ujian->getLead(['el_hasil.ujian_id' => $id, 'el_hasil.status' => 0])->row(),
            'count' =>  $this->ujian->getLead(['el_hasil.ujian_id' => $id, 'el_hasil.status' => 0])->num_rows(),
            'id'    => $id,
            'title' => 'Report Ujian'
        ];

        // var_dump($data['ujian']);
        $this->template->load('template', 'ujian/report', $data);
    }

    public function detail($id)
    {
        $data = [
            'row' => $this->ujian->getLead(['id_hasil' => $id])->row(),
            'title' => 'Detail Hasil'
        ];
        // var_dump($data['row']);
        $this->template->load('template', 'ujian/detail', $data);
    }

    public function generate($id)
    {
        $get_ujian = $this->ujian->getLead(['el_hasil.ujian_id' => $id])->row();

        $get_peserta = $this->ujian->getLead(['el_hasil.ujian_id' => $id])->result();

        // if ($get_ujian == 'Staff Produksi') {
        foreach ($get_peserta as $key => $data) {

            // var_dump($data->nilai);
            if ($data->nilai >= $data->kkm) {
                $params = [
                    'statusLamaran' => 'Lolos ke tahap wawancara'
                ];

                $wawancara_id = $this->base->get('wawancara', ['lowongan_id' => $data->lowongan_id])->row();
                
                
                $paramsWawacara = [
                    'user_id'       => $data->siswa_id,
                    'status'        => 0,
                    'wawancara_id'   => $wawancara_id->id_wawancara,
                    'lowongan_id'   => $data->lowongan_id
                ];
                
                $check = $this->ujian->check_data(['user_id' => $data->siswa_id, 'wawancara_id' => $wawancara_id->id_wawancara])->num_rows();


                if ($check != 1) {
                    $this->base->add('peserta_wawancara', $paramsWawacara);
                }

            } else {
                $params = [
                    'statusLamaran' => 'Tidak Lolos'
                ];
            }
            $array = ['id_hasil' => $data->id_hasil, 'siswa_id' => $data->siswa_id, 'ujian_id' => $id];

            $this->base->updateGenerate('el_hasil', $array, $params);

            

            if ($this->db->affected_rows() > 0) {
                set_pesan('Berhasil memberikan keputusan');
            } else {
                set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
            }
        }
        // }

        redirect('Ujian');
    }

    public function generate_kantor($id)
    {
        $get_ujian = $this->ujian->getLead(['el_hasil.ujian_id' => $id])->row();

        $get_peserta = $this->ujian->getLead(['el_hasil.ujian_id' => $id])->result();

        // var_dump($get_peserta);

        // if ($get_ujian == 'Staff Produksi') {
        foreach ($get_peserta as $key => $data) {

            if ($data->nilai >= $data->kkm) {
                $params = [
                    'statusLamaran' => 'Lolos ke tahap wawancara'
                ];

                $wawancara_id = $this->base->get('wawancara', ['lowongan_id' => $data->lowongan_id])->row();
                
                
                $paramsWawacara = [
                    'user_id'       => $data->siswa_id,
                    'status'        => 0,
                    'wawancara_id'   => $wawancara_id->id_wawancara,
                    'lowongan_id'   => $data->lowongan_id
                ];

                $check = $this->ujian->check_data(['user_id' => $data->siswa_id, 'wawancara_id' => $wawancara_id->id_wawancara])->num_rows();

                var_dump($check);

                if ($check != 1) {
                    $this->base->add('peserta_wawancara', $paramsWawacara);
                }

            } else {
                $params = [
                    'statusLamaran' => 'Tidak Lolos Seleksi'
                ];
            }
            $array = ['id_hasil' => $data->id_hasil, 'siswa_id' => $data->siswa_id];

            $this->base->updateGenerate('el_hasil', $array, $params);

            if ($this->db->affected_rows() > 0) {
                set_pesan('Berhasil memberikan keputusan');
            } else {
                set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
            }
        }
        // }

        redirect('Ujian');
    }

    public function proses()
    {
        $post = $this->input->post(null, true);

        $cek_ujian = $this->base->get('ujian', ['lowongan_id' => $post['lowongan_id']])->num_rows();

        if ($cek_ujian > 0) {
            set_pesan('Ujian dengan lowongan tersebut sudah ada', FALSE);
        } else {
            $params = [
                'nama_ujian' => $post['ujian'],
                'jenis' => $post['jenis'],
                'jumlah_soal' => $post['jumlah'],
                'waktu' => $post['waktu'],
                'tgl_dibuat' => date('Y-m-d h:i:s'),
                'tgl_selesai' => $post['tgl_selesai'],
                'lowongan_id' => $post['lowongan_id'],
                'token' => strtoupper(random_string('alpha', 5)),
            ];
            // var_dump($params);
            $this->base->add('ujian', $params);

            if ($this->db->affected_rows() > 0) {
                set_pesan('Data berhasil disimpan');
            } else {
                set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
            }
        }

        redirect('Ujian');
    }

    public function prosesEdit($id)
    {
        $post = $this->input->post(null, true);

        $params = [
            'nama_ujian' => $post['ujian'],
            'jenis' => $post['jenis'],
            'jumlah_soal' => $post['jumlah'],
            'waktu' => $post['waktu'],
            'tgl_dibuat' => date('Y-m-d h:i:s'),
            'tgl_selesai' => $post['tgl_selesai'],
            'lowongan_id' => $post['lowongan_id'],
        ];

        // var_dump($params);

        $this->base->edit('ujian', $params, ['id_ujian' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('Ujian');
    }

    public function delete($id)
    {
        $this->base->del('Ujian', ['id_Ujian' => $id]);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil dihapus');
        } else {
            set_pesan('Terjadi kesalahan menghapus data!', FALSE);
        }

        redirect('Ujian');
    }
}
