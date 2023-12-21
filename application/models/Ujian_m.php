<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Ujian_m extends CI_Model
{

    public function get($where = null)
    {
        $this->db->select('*');
        $this->db->from('ujian');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('id_ujian', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_soal($where = null) {
        $this->db->select('*');
        $this->db->from('soal');
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getOne()
    {
        $this->db->select('*');
        $this->db->from('el_hasil');
        $this->db->order_by('point', 'DESC');
        $this->db->order_by('nilai', 'DESC');
        return $this->db->get();
    }

    public function getBest()
    {
        $this->db->select('*');
        $this->db->from('el_hasil');
        // $this->db->order_by('point', 'DESC');
        $this->db->order_by('nilai', 'DESC');
        return $this->db->get();
    }


    public function add($post)
    {
        $params = array(
            'judul' => $post['judul'],
            'tgl_dibuat' => $post['tgl_dibuat'],
            'tgl_selesai' => $post['tgl_selesai'],
            'login_id' => $this->session->userdata('login_session')['user'],
            'waktu' => $post['waktu'],
            'jumlah_soal' => $post['jumlah_soal'],
            'jenis' => $post['jenis'],
            'token' => strtoupper(random_string('alpha', 5))
        );

        $this->db->insert('ujian', $params);
    }

    public function getChallenge($id_ujian)
    {
        $this->db->select('*');
        $this->db->from('soal');
        // $this->db->where('ujian_id', $id_ujian);
        // $this->db->join('ujian', 'ujian.id_ujian = soal.ujian_id');
        // $this->db->join('el_login', 'el_login.id_login = soal.login_id');
        $query = $this->db->get()->row();
        return $query;
    }

    public function getChallenge2($id_ujian)
    {
        $this->db->select('*');
        $this->db->from('ujian');
        $this->db->where('id_ujian', $id_ujian);
        // $this->db->join('ujian', 'ujian.id_ujian = soal.ujian_id');
        // $this->db->join('el_pengajar', 'el_pengajar.id_pengajar = soal.pengajar_id');
        $query = $this->db->get()->row();
        return $query;
    }

    public function getKelasNow($where = null)
    {
        $this->db->select('*');
        $this->db->from('el_siswa_kelas');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->join('el_kelas', 'el_kelas.id_kelas = el_siswa_kelas.kelas_id');
        // $this->db->join('el_siswa', 'el_siswa.id_siswa = el_siswa_kelas.siswa_id');
        $query = $this->db->get();
        return $query;
    }

    public function getIdMahasiswa($nim)
    {
        $this->db->select('*');
        $this->db->from('el_siswa a');
        // $this->db->join('el_kelas b', 'a.kelas_id=b.id_kelas');
        // $this->db->join('el_jurusan c', 'b.jurusan_id=c.id_jurusan');
        $this->db->where('nis', $nim);
        return $this->db->get()->row();
    }

    public function getUjianById($id)
    {
        $this->db->select('*');
        $this->db->from('ujian a');
        // $this->db->join('el_login b', 'a.login_id=b.id_user');
        // $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->where('id_ujian', $id);
        // $this->db->order_by('level', 'ASC');
        return $this->db->get()->row();
    }

    public function getUjianId($id)
    {
        $this->db->select('*');
        $this->db->from('ujian a');
        $this->db->join('lowongan b', 'a.lowongan_id=b.id_lowongan');
        $this->db->join('sub_kategori c', 'b.dept_id=c.id_sub');
        // $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->where('id_ujian', $id);
        // $this->db->order_by('level', 'ASC');
        return $this->db->get()->row();
    }

    public function getSoal($id)
    {
        $ujian = $this->getUjianId($id);

        $id_kategori = $ujian->id_sub;

        $this->db->select('id_soal, pertanyaan, file, p_a, p_b, p_c, p_d, kunci,  tipe_file, dept_id');
        $this->db->from('soal');
        $this->db->where('dept_id', $id_kategori);
        if ($ujian->jenis == 'acak') {
            $this->db->order_by('rand()');
        } else {
            $this->db->order_by('id_soal', 'ASC');
        }
        $this->db->limit($ujian->jumlah_soal);
        return $this->db->get()->result();
    }

    public function getSoalId($id_soal)
    {
        $this->db->select('*');
        $this->db->from('soal');
        $this->db->where('id_soal', $id_soal);
        return $this->db->get();
    }

    public function create($table, $data, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->insert($table, $data);
        } else {
            $insert = $this->db->insert_batch($table, $data);
        }
        return $insert;
    }

    public function HslUjian($id, $siswa)
    {
        $this->db->select('*, UNIX_TIMESTAMP(tgl_selesai) as waktu_habis');
        $this->db->from('el_hasil');
        // $this->db->join('ujian', 'ujian=id_ujian = el_hasil.ujian_id');
        $this->db->where('ujian_id', $id);
        $this->db->where('siswa_id', $siswa);
        return $this->db->get();
    }

    public function HslUjianGive($id)
    {
        $this->db->select('*');
        $this->db->from('el_hasil');
        $this->db->where('ujian_id', $id);
        $this->db->where('status', '0');
        return $this->db->get();
    }

    public function ambilSoal($pc_urut_soal1, $pc_urut_soal_arr)
    {
        $this->db->select("*, {$pc_urut_soal1} AS jawaban");
        $this->db->from('soal');
        $this->db->where('id_soal', $pc_urut_soal_arr);
        return $this->db->get()->row();
    }

    public function update($table, $data, $pk, $id = null, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->update($table, $data, array($pk => $id));
        } else {
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }

    public function updateBadge($id_siswa, $data)
    {
        $this->db->where('id_siswa', $id_siswa);
        $this->db->update('el_siswa', $data);
    }

    public function getJawaban($id_tes, $siswa_id)
    {
        $this->db->select('list_jawaban');
        $this->db->from('el_hasil');
        $this->db->where('ujian_id', $id_tes);
        $this->db->where('siswa_id', $siswa_id);
        return $this->db->get()->row()->list_jawaban;
    }

    public function getNilai($id_tes, $siswa_id)
    {
        $this->db->select('nilai');
        $this->db->from('el_hasil');
        $this->db->where('ujian_id', $id_tes);
        $this->db->where('siswa_id', $siswa_id);
        return $this->db->get()->row()->nilai;
    }

    public function getExp($siswa_id)
    {
        $this->db->select('*');
        $this->db->from('el_siswa');
        $this->db->where('id_siswa', $siswa_id);
        return $this->db->get()->row();
    }

    public function cekBadge($id)
    {
        $this->db->select('*');
        $this->db->from('el_badge');
        $this->db->where('siswa_id', $id);
        $this->db->where('nama_file', 'star.png');
        return $this->db->get();
    }

    public function getWaktu($siswa, $id_tes)
    {
        $this->db->select('UNIX_TIMESTAMP(tgl_selesai) as waktu_habis');
        $this->db->from('el_hasil');
        $this->db->where('siswa_id', $siswa);
        $this->db->where('ujian_id', $id_tes);
        return $this->db->get()->row()->waktu_habis;
    }

    public function getHasil()
    {
        $this->db->select('*');
        $this->db->from('el_hasil');
        return $this->db->get();
    }

    public function getLamaranById($array)
    {
        $this->db->select('*');
        $this->db->from('lamaran');
        $this->db->where($array);
        // $this->db->where('user_id', userdata('id_user'));
        return $this->db->get();
    }

    public function getLeadList($where = null)
    {
        $this->db->distinct();
        $this->db->select('*, el_hasil.status as statusTest, el_hasil.nilai as nilai, lowongan.kkm as kkm, el_hasil.statusLamaran as hasilUjian');
        $this->db->from('el_hasil');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('nilai', 'DESC');
        $this->db->join('user', 'user.id_user = el_hasil.siswa_id', 'left');
        $this->db->join('ujian', 'ujian.id_ujian = el_hasil.ujian_id');
        $this->db->join('lowongan', 'lowongan.id_lowongan = ujian.lowongan_id');
        // $this->db->join('lamaran', 'lamaran.ujian_id = ujian.id_ujian');
        return $this->db->get();
    }

    public function getLead($where = null)
    {
        $this->db->distinct();
        $this->db->select('*, el_hasil.status as statusTest, el_hasil.nilai as nilai, lowongan.kkm as kkm, el_hasil.statusLamaran as hasilUjian,lamaran.deskripsi as lamaranDesc');
        $this->db->from('el_hasil');
        if ($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('nilai', 'DESC');
        $this->db->join('user', 'user.id_user = el_hasil.siswa_id', 'left');
        $this->db->join('ujian', 'ujian.id_ujian = el_hasil.ujian_id');
        $this->db->join('lowongan', 'lowongan.id_lowongan = ujian.lowongan_id');
        $this->db->join('lamaran', 'lamaran.ujian_id = ujian.id_ujian');
        return $this->db->get();
    }

    public function check_data($where = null)
    {
        $this->db->select('*');
        $this->db->from('peserta_wawancara');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function check_ujian($where = null)
    {
        $this->db->select('*');
        $this->db->from('lamaran');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }
}
