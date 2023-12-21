<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
        $this->load->model('Ujian_m', 'ujian');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data = [
            'title'     => 'Lowongan Open',
            'lowongan'  => $this->base->getLowonganList()->result_array(),
            'lamaran'   => $this->base->getLamaran(userdata('id_user'))->result_array(),
            'history'   => $this->base->getKelolaLamaran(['siswa_id' => userdata('id_user')])->result_array(),
            'lamaranCount'   => $this->base->getLamaran(userdata('id_user'))->num_rows(),
            'cv'        => $this->base->get('user', ['id_user' => userdata('id_user')])->row()
        ];

        // var_dump($data['lamaran']);
        $this->template->load('front/template', 'front/lowongan/data', $data);
    }

    public function search()
    {
        $post = $this->input->post(null, true);
        $where = ['pendidikan' => $post['pendidikan'], 'section' => $post['pekerjaan'], 'tipe' => $post['kontrak']];
        
        $data = [
            'title'     => 'Lowongan Open',
            'lowongan'  => $this->base->getLowonganSearch($where)->result_array(),
            'lamaran'   => $this->base->getLamaran(userdata('id_user'))->result_array(),
            'history'   => $this->base->getKelolaLamaran(['siswa_id' => userdata('id_user')])->result_array(),
            'lamaranCount'   => $this->base->getLamaran(userdata('id_user'))->num_rows(),
            'cv'        => $this->base->get('user', ['id_user' => userdata('id_user')])->row()
        ];

        // var_dump($where);
        $this->template->load('front/template', 'front/lowongan/data', $data);
    }

    public function changeProfile()
    {
        // redirect('loker');
        $post = $this->input->post(null, TRUE);

        $config['upload_path']          = './assets/uploads/foto/';
        $config['allowed_types']        = 'jpeg|png|jpg';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $config['file_name']            = 'foto-' . userdata('nama') . date('ymd') . '-' . substr(md5(rand()), 0, 6);



        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $post['foto'] = $this->upload->data('file_name');

            $params = [
                'nama' => $post['nama'],
            ];

            if ($post['password'] != null) {
                $params['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
            }
            $params['foto'] = $post['foto'];
            $this->base->update('user', 'id_user', userdata('id_user'), $params);
            if ($this->db->affected_rows() > 0) {
                set_pesan('Data Berhasil Dismpan');
                // echo "<script type='text/javascript'>alert('File berhasil disimpan');</script>";
            } else {
                set_pesan('Data Berhasil Dismpan', false);
            }
        } else {
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
        }

        redirect('Loker');
    }
    public function start($id_ujian)
    {
        $check = $this->ujian->check_ujian(['user_id' => userdata('id_user'), 'ujian_id' => $id_ujian])->num_rows();

        if ($check > 0) {
            // $kelas = array('siswa_id', $this->session->userdata('login_session')['siswa_id']);
            // $where = array('ujian_id' => $id_ujian);
            $ujian = $this->base->getChallenge2($id_ujian);
            // var_dump($ujian);
            // $siswa = $this->ujian->getKelasNow($kelas)->row();

            // var_dump($siswa);
            $data = array(
                'title' => "Informasi Challenge",
                'ujian' => $ujian,
                // 'siswa' => $siswa,
                'encrypted_id' => urlencode($this->encryption->encrypt($id_ujian))
            );

            // var_dump($this->session->userdata('nama'));
            $dateTime = date('Y-m-d H:i:s'); 
            $tz_from = 'Asia/Jakarta'; 
            $newDateTime = new DateTime($dateTime, new DateTimeZone($tz_from)); 
            $newDateTime->setTimezone(new DateTimeZone("GMT+7")); 
            $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");

            // echo $dateTimeUTC;
            // $this->template->load('tempUjian', 'test/infoChallenge', $data);
            $this->template->load('tempUjian', 'test/infoChallenge', $data);

            // echo date('Y-m-d h:i:s');
        } else {
            set_pesan('Anda tidak memiliki akses untuk mengerjakan', FALSE);
            redirect('loker');
        }
    }

    public function view($slug)
    {   
        $id_lowongan = $this->base->get('lowongan', ['seo_title' => $slug])->row();
        $data = [
            'title'     => 'Lowongan Open',
            'lowongan'  => $this->base->getLowongan($slug)->row(),
            'featured'  => $this->base->getLowongan(NULL, '5')->result_array(),
            'count'     => $this->base->getLamaranView(['user_id' => userdata('id_user'), 'seo_title' => $slug])->num_rows(),
            'pelamar'   => $this->base->get('lamaran', ['lowongan_id' => $id_lowongan->id_lowongan])->num_rows()
        ];

        // var_dump($data['row'], userdata('id_user'));

        $this->template->load('front/template', 'front/lowongan/read', $data);
    }

    public function lamar($slug)
    {
        $data = [
            'title'     => 'Lowongan Open',
            'lowongan'  => $this->base->getLowongan($slug)->row(),
            'user'        => $this->base->get('user', ['id_user' => userdata('id_user')])->row()
        ];

        // var_dump($data['lowongan']);

        $this->template->load('front/template', 'front/lowongan/lamar', $data);
    }

    public function prosesLamar(Type $var = null)
    {
        $post = $this->input->post(null, true);

        $params = [
            'user_id'       => $post['user_id'],
            'lowongan_id'   => $post['lowongan_id'],
            'deskripsi'     => $post['deskripsi'],
            'status'        => 0,
            'ujian_id'      => $post['ujian_id']
        ];

        $this->base->add('lamaran', $params);

        if ($this->db->affected_rows() > 0) {
            set_pesan('Berhasil melamar, silahkan cek kelola tes ujian dan menunggu informasi untuk melakukan ujian');
        } else {
            set_pesan('Terjadi kesalahan menyimpan data!', FALSE);
        }

        redirect('loker');
    }

    public function upload_cv()
    {
        $post = $this->input->post(null, TRUE);

        $config['upload_path']          = './assets/uploads/cv/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $config['file_name']            = 'CV-' . userdata('nama') . date('ymd') . '-' . substr(md5(rand()), 0, 6);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('cv')) {
            $post['cv'] = $this->upload->data('file_name');
            $this->base->update_cv('id_user', userdata('id_user'), $post);
            if ($this->db->affected_rows() > 0) {
                set_pesan('Data Berhasil Dismpan');
                // echo "<script type='text/javascript'>alert('File berhasil disimpan');</script>";
            } else {
                set_pesan('Data Berhasil Dismpan', false);
            }
            redirect('Loker');
        } else {
            set_pesan('Terjadi kesalahan saat mengupload data', false);
        }
    }

    public function upload_foto()
    {
        $post = $this->input->post(null, TRUE);

        $config['upload_path']          = './assets/uploads/foto/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $config['file_name']            = 'profile-' . userdata('nama') . date('ymd') . '-' . substr(md5(rand()), 0, 6);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('cv')) {
            $post['cv'] = $this->upload->data('file_name');
            $this->base->update_cv('id_user', userdata('id_user'), $post);
            if ($this->db->affected_rows() > 0) {
                set_pesan('Data Berhasil Dismpan');
                // echo "<script type='text/javascript'>alert('File berhasil disimpan');</script>";
            } else {
                set_pesan('Data Berhasil Dismpan', false);
            }
            redirect('Loker');
        } else {
            set_pesan('Terjadi kesalahan saat mengupload data', false);
        }
    }

    public function output_json($data, $encode = true)
    {
        if ($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function json($id = null)
    {
        $this->output_json($this->base->getDataUjian($id), false);
    }

    public function encrypt()
    {
        $id = $this->input->post('id_ujian', true);
        $key = urlencode($this->encryption->encrypt($id));
        // $decrypted = $this->encryption->decrypt(rawurldecode($key));
        $this->output_json(['key' => $key]);
    }

    public function cektoken()
    {
        $id = $this->input->post('id_ujian', true);
        $token = $this->input->post('token', true);
        $cek = $this->base->getUjianById($id);

        // var_dump($cek);
        // var_dump($token);

        $data['status'] = $token === $cek->token ? TRUE : FALSE;
        // var_dump($data['status']);
        $this->output_json($data['status']);
    }

    public function garap()
    {
        $id_en = $this->input->get('key', true);
        $id  = $this->encryption->decrypt(rawurldecode($id_en));

        $idSiswa = userdata('id_user');

        $ujian = $this->base->getUjianById($id);

        // $dept = $this->base->get();

        // var_dump($ujian);
        $soal = $this->ujian->getSoal($id);
        // var_dump($soal);

        $h_ujian     = $this->ujian->HslUjian($id, $idSiswa);

        $cek_sudah_ikut = $h_ujian->num_rows();
        // var_dump($cek_sudah_ikut);

        if ($cek_sudah_ikut < 1) {
            $soal_urut_ok     = array();
            $i = 0;
            foreach ($soal as $key => $s) {
                $soal_per = new stdClass();
                $soal_per->id_soal         = $s->id_soal;
                $soal_per->pertanyaan     = $s->pertanyaan;
                $soal_per->file         = $s->file;
                $soal_per->tipe_file     = $s->tipe_file;
                $soal_per->p_a             = $s->p_a;
                $soal_per->p_b             = $s->p_b;
                $soal_per->p_c             = $s->p_c;
                $soal_per->p_d             = $s->p_d;
                $soal_per->jawaban         = $s->kunci;
                // $soal_per->jawaban         = $s->level;
                $soal_urut_ok[$i]         = $soal_per;
                $i++;
            }
            // var_dump($soal_per);
            $soal_urut_ok     = $soal_urut_ok;
            $list_id_soal    = "";
            $list_jw_soal     = "";

           

            if (!empty($soal)) {
                foreach ($soal as $d) {
                    $list_id_soal .= $d->id_soal . ",";
                    $list_jw_soal .= $d->id_soal . "::N,";
                }
            }

            $list_id_soal     = substr($list_id_soal, 0, -1);
            $list_jw_soal     = substr($list_jw_soal, 0, -1);
            $waktu_selesai     = date('Y-m-d H:i:s', strtotime("+{$ujian->waktu} minute"));
            $time_mulai        = date('Y-m-d H:i:s');

            $id_lowongan = $this->base->get('ujian', ['id_ujian' => $id])->row();

            $input = [
                'lowongan_id'      => $id_lowongan->lowongan_id,
                'ujian_id'         => $id,
                'siswa_id'        => $idSiswa,
                'list_soal'        => $list_id_soal,
                'list_jawaban'     => $list_jw_soal,
                'jml_benar'        => 0,
                'nilai'            => 0,
                'tgl_mulai'        => $time_mulai,
                'tgl_selesai'    => $waktu_selesai,
                'status'        => 1
            ];
            $this->ujian->create('el_hasil', $input);

            $this->base->updateGenerate('lamaran', array('user_id' => $idSiswa, 'ujian_id' => $id), ['status' => 1]);


            redirect('loker/garap/?key=' . urlencode($id_en), 'location', 301);
        }
        

        $q_soal = $h_ujian->row();

        $urut_soal         = explode(",", $q_soal->list_jawaban);
        
        $soal_urut_ok    = array();
        for ($i = 0; $i < sizeof($urut_soal); $i++) {
            $pc_urut_soal    = explode(":", $urut_soal[$i]);
            $pc_urut_soal1     = empty($pc_urut_soal[1]) ? "''" : "'{$pc_urut_soal[1]}'";
            $ambil_soal     = $this->ujian->ambilSoal($pc_urut_soal1, $pc_urut_soal[0]);
            $soal_urut_ok[] = $ambil_soal;
        }
        
        $detail_tes = $q_soal;
        $soal_urut_ok = $soal_urut_ok;  

        $pc_list_jawaban = explode(",", $detail_tes->list_jawaban);
        $arr_jawab = array();
        foreach ($pc_list_jawaban as $v) {
            $pc_v     = explode(":", $v);
            $idx     = $pc_v[0];
            $val     = $pc_v[1];
            $rg     = $pc_v[2];

            $arr_jawab[$idx] = array("j" => $val, "r" => $rg);
        }

        $arr_opsi = array("a", "b", "c", "d");
        $html = '';
        $no = 1;

        if (!empty($soal_urut_ok)) {
            foreach ($soal_urut_ok as $s) {
                $path = 'assets/uploads/bank_soal/';
                $vrg = $arr_jawab[$s->id_soal]["r"] == "" ? "N" : $arr_jawab[$s->id_soal]["r"];
                $html .= '<input type="hidden" name="id_soal_' . $no . '" value="' . $s->id_soal . '">';
                // $html .= '<input type="hidden" name="level_' . $no . '" value="' . $s->level . '">';
                $html .= '<input type="hidden" name="rg_' . $no . '" id="rg_' . $no . '" value="' . $vrg . '">';
                $html .= '<div class="step" id="widget_' . $no . '">';

                $html .= '<div class="text-center"><div class="w-50">' . tampil_media($path . $s->file) . '</div></div>' . $s->pertanyaan . '<div class="funkyradio">';
                for ($j = 0; $j < count($arr_opsi); $j++) {
                    $opsi             = "p_" . $arr_opsi[$j];
                    $file             = "file_" . $arr_opsi[$j];
                    $checked         = $arr_jawab[$s->id_soal]["j"] == $arr_opsi[$j] ? "checked" : "";
                    $pilihan_opsi     = !empty($s->$opsi) ? $s->$opsi : "";
                    $tampil_media_opsi = (is_file(base_url() . $path . $s->$file) || $s->$file != "") ? tampil_jawaban($path . $s->$file) : "";
                    $html .= '<div class="funkyradio-success" onclick="return simpan_sementara();">
						<input type="radio" id="p_' . strtolower($arr_opsi[$j]) . '_' . $s->id_soal . '" name="p_' . $no . '" value="' . $arr_opsi[$j] . '" ' . $checked . '> <label for="p_' . strtolower($arr_opsi[$j]) . '_' . $s->id_soal . '"><div class="huruf_opsi">' . $arr_opsi[$j] . '</div> <p>' . $pilihan_opsi . '</p><div class="w-75">' . $tampil_media_opsi . '</div></label></div>&nbsp;';
                }
                $html .= '</div></div>';
                $no++;
            }
        }


        $id_tes = $this->encryption->encrypt($detail_tes->ujian_id);
        $id_tes = $this->encryption->encrypt($detail_tes->ujian_id);
        $tes = $this->session->userdata('login_session');

        $data = [
            'title'     => 'Quiz',
            'user'         => $this->session->userdata('login_session'),
            'mhs'        => $idSiswa,
            'judul'        => 'Ujian',
            'subjudul'    => 'Lembar Ujian',
            'soal'        => $detail_tes,
            'no'         => $no,
            'html'         => $html,
            'id_tes'    => $id_tes
        ];

        $this->template->load('tempUjian', 'test/garap', $data);
    }

    public function simpan_satu()
    {
        // Decrypt Id
        $id_tes = $this->input->post('id_tes', true);
        $jml = $this->input->post('jml_soal', true);
        // $id_tes = $this->encryption->decrypt($id_tes);
        
        $jml_soal = $jml - 1;

        $input     = $this->input->post(null, true);
        $list_jawaban     = "";

        for ($i = 1; $i < $jml; $i++) {
            $jawab     = "p_" . $i;
            $soal     = "id_soal_" . $i;
            $_ragu         = "rg_" . $i;
            $jawaban_     = empty($input[$jawab]) ? "" : $input[$jawab];
            $list_jawaban    .= "" . $input[$soal] . ":" . $jawaban_ . ":" . $input[$_ragu] . ",";
        }

        $list_jawaban    = substr($list_jawaban, 0, -1);
        $d_simpan = array(
            'list_jawaban' => $list_jawaban
        );

        $siswa_id = userdata('id_user');
        $this->ujian->update('el_hasil', $d_simpan, 'siswa_id', $siswa_id);

        // $point = $this->ujian->getPoint($id_tes, $siswa_id);
        // var_dump($point);

        $waktu_habis = $this->ujian->getWaktu($siswa_id, $id_tes);

        // Pecah Jawaban
        $jawaban_simpan = explode(",", $list_jawaban);
        // var_dump($jawaban_simpan);

        $jumlah_benar     = 0;
        $jumlah_salah     = 0;
        $jumlah_ragu      = 0;
        $nilai_bobot     = 0;
        $total_bobot    = 0;
        $jumlah_soal    = sizeof($jawaban_simpan);

        var_dump($jml_soal);

        foreach ($jawaban_simpan as $jwb) {
            $dt_jwb         = explode(":", $jwb);
            $id_soal     = $dt_jwb[0];
            $jawaban     = $dt_jwb[1];
            $ragu         = $dt_jwb[2];

            $cek_jwb     = $this->ujian->getSoalId($id_soal)->row();

            if ($jawaban == $cek_jwb->kunci) {
                $jumlah_benar++;
            } else {
                $jumlah_salah++;
            }
        }
        $nilai = ($jumlah_benar / $jml_soal)  * 100;
        // $set_point = $nilai * 2;

        // end update nilai
        $d_update = [
            'jml_benar'        => $jumlah_benar,
            'nilai'            => number_format(floor($nilai), 0),
            // 'point'            => $set_point,
        ];
        // $this->ujian->update('el_hasil', $d_update, 'siswa_id', $siswa_id);

        $this->base->edit('el_hasil', $d_update, ['siswa_id' => $siswa_id, 'ujian_id' => $id_tes]);

        $current_level = $this->input->post('level', true);

        // $level_2_point = 49;
        // $level_3_point = 75;
        // $level_result = [];

        // // REQUIRE POINT 
        // if ($current_level == 2 && $point <= $level_2_point) {
        // 	$level_result = ['messages' => 'point tidak cukup'];
        // } elseif ($current_level == 3 && $set_point <= $level_3_point) {
        // 	$level_result = ['messages' => 'point tidak cukup'];
        // }

        // $this->output_json(['data' => $level_result]);
    }

    // public function simpan_akhir()
    // {
    // 	// Decrypt Id
    // 	$id_awal = $this->input->post('id_ujian', true);
    // 	// $id_tes = $this->encryption->decrypt($id_awal);
    // 	$id_tes =$this->input->post('id_tes' , true);
    //     var_dump($id_tes);

    // 	$siswa_id = userdata('id_user');

    // 	// Get Jawaban
    // 	$list_jawaban = $this->ujian->getJawaban($id_tes, $siswa_id);
    // 	$nilai = $this->ujian->getNilai($id_tes, $siswa_id);

    // 	$waktu_habis = $this->ujian->getWaktu($siswa_id, $id_tes);

    // 	// Pecah Jawaban
    // 	$jawaban_simpan = explode(",", $list_jawaban);

    // 	$jumlah_benar 	= 0;
    // 	$jumlah_salah 	= 0;
    // 	$jumlah_ragu  	= 0;
    // 	$jumlah_soal	= sizeof($jawaban_simpan);

    // 	foreach ($jawaban_simpan as $jwb) {
    // 		$dt_jwb 	= explode(":", $jwb);
    // 		$id_soal 	= $dt_jwb[0];
    // 		$jawaban 	= $dt_jwb[1];
    // 		$ragu 		= $dt_jwb[2];

    // 		$cek_jwb 	= $this->ujian->getSoalId($id_soal)->row();

    // 		// $jawaban = $cek_jwb->kunci ? $jumlah_benar++ : $jumlah_salah++;
    // 		if ($jawaban == $cek_jwb->kunci) {
    // 			$jumlah_benar++;
    // 		} else {
    // 			$jumlah_salah++;
    // 		}
    // 	}

    // 	$cek_row = $this->ujian->HslUjianGive($id_tes);

    // 	$cek = $cek_row->num_rows();

    // 	var_dump($cek);

    // 	$d_update = [
    // 		'jml_benar'		=> $jumlah_benar,
    // 		'nilai'			=> number_format(floor($nilai), 0),
    // 		'point'			=> $set_point,
    // 		'waktu_pengerjaan' => $differences,
    // 		'status'		=> 0,
    // 		'tgl_selesai'	=> $waktu_a,
    // 	];

    // 	if ($cek < 1) {
    // 		$update_siswa = [
    // 			'nama_file' => 'time.png',
    // 			'siswa_id' => $this->session->userdata('login_session')['siswa_id']
    // 		];
    // 		$this->db->insert('el_badge', $update_siswa);
    // 	}

    // 	$this->ujian->update('el_hasil', $d_update, 'siswa_id', $siswa_id);
    // 	$this->output_json(['status' => TRUE, 'data' => $d_update, 'id' => $siswa_id]);
    // }
    public function simpan_akhir()
    {
        // $this->simpan_satu();

        $siswa_id = userdata('id_user');

        $id_ujian = $this->input->post('id_tes', true);

        $d_update = [
            'status'        => 0,
        ];

        $lamaran = ['status' => 1];


        $this->ujian->update('el_hasil', $d_update, 'siswa_id', $siswa_id);

        // if ($this->db->affected_rows() > 0) {
        // }
        // $this->ujian->update('lamaran', $lamaran, 'user_id', $siswa_id);
        $this->output_json(['status' => TRUE, 'data' => $d_update, 'id' => $siswa_id]);
    }
}
