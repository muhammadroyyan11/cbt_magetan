<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
        $this->load->model('Chart_model', 'chart');
        is_pelamar();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard'  
        ];

        // var_dump($this->base->aktif());

        // var_dump(date('w'));
        $this->template->load('template', 'dashboard/dashboard', $data);
    }
}
