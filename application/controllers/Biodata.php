<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
        $this->load->model('Chart_model', 'chart');
    }

    public function index()
    {
        $data = [
            'title' => 'Biodata' ,
            'row'   => $this->base->get('user', ['id_user' => userdata('id_user')])->row()
        ];
        $this->template->load('front/template', 'front/biodata/form', $data);
    }
}
