<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        is_pelamar();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
        $this->load->model('Chart_model', 'chart');
    }

    public function index()
    {
        $data = [
            'kategori' => $this->base->get('kategori')->result_array(),
            'title' => 'Department'
        ];
        $this->template->load('template', 'kategori/data', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, true);

        $params = [
            'nama_kategori' => $post['kategori']
        ];

        $this->base->add('kategori', $params);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Data berhasil disimpan');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('Kategori');
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
