<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model
{

    public function get($table, $where = null, $order = null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($where != null) {
            $this->db->where($where);
        }

        if ($order != null) {
            $this->db->order_by($order, 'DESC');
        }
        $sql = $this->db->get();
        return $sql;
    }

    public function getLowonganJoin()
    {
        $this->db->select('*');
        $this->db->from('lowongan');
        $this->db->join('sub_kategori', 'sub_kategori.id_sub = lowongan.dept_id');
        $this->db->join('kategori', 'kategori.id_kategori = sub_kategori.kategori_id');
        $this->db->order_by('id_lowongan', 'DESC');
        return $this->db->get();
    }

    public function getWawancara($where = null)
    {
        $this->db->select('*');
        $this->db->from('wawancara');
        $this->db->join('lowongan', 'lowongan.id_lowongan = wawancara.lowongan_id');
        if ($where != null) {
            $this->db->where($where);
        }

        $sql = $this->db->get();
        return $sql;
    }

    public function getPelamar($where = null)
    {
        $this->db->select('*, lamaran.deskripsi as desc');
        $this->db->from('lamaran');
        $this->db->join('user', 'user.id_user = lamaran.user_id');
        $this->db->join('lowongan', 'lowongan.id_lowongan = lamaran.lowongan_id');
        if ($where != null) {
            $this->db->where($where);
        }

        $sql = $this->db->get();
        return $sql;
    }

    public function getFeedback($where = null)
    {
        $this->db->select('*');
        $this->db->from('hasil_wawancara');
        $this->db->join('user', 'user.id_user = hasil_wawancara.user_id');
        $this->db->join('peserta_wawancara', 'peserta_wawancara.id_peserta = hasil_wawancara.peserta_id');
        if ($where != null) {
            $this->db->where($where);
        }

        $sql = $this->db->get();
        return $sql;
    }

    public function getPeserta($where = null)
    {
        $this->db->select('*, a.statusLamaran as hasil');
        $this->db->from('peserta_wawancara as a');
        $this->db->join('user', 'user.id_user = a.user_id');
        $this->db->join('lowongan', 'lowongan.id_lowongan = a.lowongan_id');
        $this->db->join('wawancara', 'wawancara.id_wawancara = a.wawancara_id');
        if ($where != null) {
            $this->db->where($where);
        }

        $sql = $this->db->get();
        return $sql;
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getPegguna($table, $where = null)
    {
        $this->db->select('user.nama as nama_lengkap, user.cv,user.username, user.is_active, user.email, user.id_user, user.role, user.createdOn');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        return $this->db->get();
    }


    public function getNewMember()
    {
        $this->db->select('user.nama as nama_lengkap, user.cv, user.username, user.is_active, user.email, user.id_user, user.role, user.createdOn');
        $this->db->from('user');
        $this->db->where('MONTH(createdOn)', date('m'));

        return $this->db->get();
    }

    public function get_surat($where = null)
    {
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->join('user', 'user.id_user = pengajuan.createdBy');
        if ($where != null) {
            $this->db->where('id_pengajuan', $where);
        }
        $sql = $this->db->get();
        return $sql;
    }

    public function getPrint($where = null)
    {
        $this->db->select('*');
        $this->db->from('pengajuan');
        if ($where != null) {
            $this->db->where('id_pengajuan', $where);
        }
        $sql = $this->db->get();
        return $sql;
    }

    public function getUser($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function foto($post)
    {
        $params = [
            'ttd' => $post['foto']
        ];

        $this->db->where('id_user', $post['id_user']);
        $this->db->update('user', $params);
    }

    public function changePassword($post)
    {
        $params = [
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
        ];

        $this->db->where('id_user', $post['id_user']);
        $this->db->update('user', $params);
    }

    public function update_signature($table, $post)
    {
        $params = [
            'ttd' => $post['ttd']
        ];

        $this->db->where('id_user', $post['id_user']);

        $this->db->update($table, $params);
    }

    public function joinCategory2($order, $where, $range = null)
    {
        $this->db->select('*');
        $this->db->from('cash_balance');
        $this->db->join('categori', 'categori.id_categori = cash_balance.category');
        $this->db->join('user', 'user.id_user = cash_balance.id_user');
        $this->db->order_by($order, 'DESC');
        $this->db->where($where);

        if ($range != null) {
            $this->db->where('date' . ' >=', $range['mulai']);
            $this->db->where('date' . ' <=', $range['akhir']);
        }
        // return $this->db->get('barang_masuk bm')->result_array();
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getUsers($id)
    {
        $this->db->select('user.nama as nama_lengkap, user.username, user.is_active, user.email, user.id_user, user.role, user.createdOn, user.cv');
        $this->db->from('user');
        $this->db->where('id_user !=', $id);
        return $this->db->get()->result_array();
    }

    public function getReport($where = null)
    {
        $this->db->select('*');
        $this->db->from('pengunjung');
        $this->db->join('wisata', 'wisata.id_wisata = pengunjung.wisata_id');
        if ($where != null) {
            $this->db->where($where);
        };
        $this->db->order_by('dateTime', 'DESC');
        return $this->db->get();
    }

    public function count($table)
    {
        return $this->db->get($table)->num_rows();
    }

    function data($table, $number, $offset)
    {
        $this->db->order_by('id_barang', 'desc');
        $query = $this->db->get($table, $number, $offset)->result();
        return $query;
    }

    public function getOrder()
    {
        // $login = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('kartikel');
        $this->db->where('isActive', '1');
        $query = $this->db->get();
        return $query;
    }

    public function getOrderProduk()
    {
        // $login = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('kproduk');
        $this->db->where('isActive', '1');
        $query = $this->db->get();
        return $query;
    }

    public function getCash($table, $order)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order, 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_barang()
    {
        // $tanggal = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->order_by('id_barang', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    public function get_artikel()
    {
        // $tanggal = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('posting');
        $this->db->order_by('id_posting', 'DESC');
        $this->db->join('kartikel', 'kartikel.id_kartikel = posting.id_kartikel');
        $this->db->join('user', 'user.id_user = posting.user');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query;
    }

    public function get_category($table, $number = null, $offset = null, $id)
    {
        // $this->db->select('*');
        // $this->db->from('posting');
        $this->db->order_by('id_posting', 'desc');
        // $this->db->join('kartikel', 'kartikel.id_kartikel = posting.id_kartikel');
        // $this->db->join('user', 'user.id_user = posting.user');
        // $this->db->order_by($order, $az);

        $this->db->where('id_kartikel', $id);
        $sql = $this->db->get($table, $number, $offset)->result();
        return $sql;
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function get_max_id($table, $field, $where)
    {
        $this->db->select_max($field);
        $this->db->where($where);
        $sql = $this->db->get($table);
        return $sql;
    }
    public function get_group_id($table, $group_by)
    {
        $this->db->group_by($group_by);
        $this->db->order_by($group_by . " DESC");
        $sql = $this->db->get($table);
        return $sql;
    }
    public function add($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function del($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function edit($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function getSub($id = null)
    {
        // $nowDate = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('sub_kategori');
        $this->db->join('kategori', 'kategori.id_kategori=sub_kategori.kategori_id');
        // $this->db->where('tgl_antrian_loket');
        if ($id != null) {
            $this->db->where('id_antrian_loket', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getLamaranView($where)
    {
        $this->db->select('*');
        $this->db->from('lamaran a');
        $this->db->join('lowongan b', 'b.id_lowongan = a.lowongan_id');
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }

    public function getLowongan($id = null, $limit = null)
    {
        // $nowDate = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('lowongan');
        $this->db->join('sub_kategori', 'sub_kategori.id_sub=lowongan.dept_id');
        $this->db->join('ujian', 'ujian.lowongan_id=lowongan.id_lowongan');
        $this->db->join('kategori', 'kategori.id_kategori=sub_kategori.kategori_id');

        // $this->db->where('tgl_antrian_loket');
        if ($id != null) {
            $this->db->where('seo_title', $id);
        }

        if ($limit != null) {
            $this->db->limit($limit);
        }

        $this->db->order_by('id_lowongan', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function aktif()
    {
        $this->db->select('*');
        $this->db->from('lowongan');
        $this->db->join('sub_kategori', 'sub_kategori.id_sub = lowongan.dept_id');
        $this->db->join('kategori', 'kategori.id_kategori = sub_kategori.kategori_id');
        $this->db->where('deadline >', date("Y-m-d H:i:s"));

        return $this->db->get();
    }

    public function getLowonganList($id = null)
    {
        // $nowDate = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('lowongan');
        $this->db->join('sub_kategori', 'sub_kategori.id_sub=lowongan.dept_id');
        $this->db->join('ujian', 'ujian.lowongan_id=lowongan.id_lowongan');
        $this->db->join('kategori', 'kategori.id_kategori=sub_kategori.kategori_id');

        // $this->db->where('tgl_antrian_loket');
        if ($id != null) {
            $this->db->where('seo_title', $id);
        }

        $this->db->order_by('id_lowongan', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getLowonganSearch($where = 'null', $kontrak = 'null')
    {
        // $nowDate = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('lowongan');
        $this->db->join('sub_kategori', 'sub_kategori.id_sub=lowongan.dept_id');
        $this->db->join('ujian', 'ujian.lowongan_id=lowongan.id_lowongan');
        $this->db->join('kategori', 'kategori.id_kategori=sub_kategori.kategori_id');

        if ($where != 'null') {
            $this->db->like($where);
        }

        $this->db->order_by('id_lowongan', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getBankSoal() {
        $this->db->select('*');
        $this->db->from('soal');
        $this->db->join('sub_kategori', 'sub_kategori.id_sub=soal.dept_id');
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

    public function getLamaran($id = null)
    {
        // $nowDate = date('Y-m-d');
        $this->db->select('*, ujian.token as tokenUjian');
        $this->db->from('lamaran');
        $this->db->join('lowongan', 'lowongan.id_lowongan=lamaran.lowongan_id');
        // $this->db->join('user', 'user.id_user= lamaran.user_id');
        $this->db->join('ujian', 'ujian.lowongan_id = lowongan.id_lowongan');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getKelolaLamaran($id = null)
    {
        $this->db->select('*');
        $this->db->from('el_hasil');
        $this->db->join('ujian', 'ujian.id_ujian = el_hasil.ujian_id');
        $this->db->join('lowongan', 'lowongan.id_lowongan = ujian.lowongan_id');
        if ($id != null) {
            $this->db->where($id);
        }

        return $this->db->get();
    }


    public function getUjianById($id)
    {
        $this->db->select('*');
        $this->db->from('ujian a');
        // $this->db->join('user b', 'a.user_id=b.id_user');
        // $this->db->join('matkul c', 'a.matkul_id=c.id_matkul');
        $this->db->where('id_ujian', $id);
        // $this->db->order_by('level', 'ASC');
        return $this->db->get()->row();
    }

    public function getChallenge2($id_ujian)
    {
        $this->db->select('*');
        $this->db->from('ujian');
        // $this->db->join('el_hasil', 'el_hasil.id_hasil = el_hasil.ujian_id', 'left');

        $this->db->where('id_ujian', $id_ujian);
        // $this->db->join('el_pengajar', 'el_pengajar.id_pengajar = el_ujian_soal.pengajar_id');
        $query = $this->db->get()->row();
        return $query;
    }

    public function getUjian($id = null)
    {
        // $nowDate = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('ujian');
        $this->db->join('lowongan', 'lowongan.id_lowongan=lamaran.lowongan_id');
        $this->db->join('user', 'user.id_user= lamaran.user_id');
        $this->db->where('status', 0);
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function update_cv($pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update('user', $data);
    }

    public function getPosting($seo_judul)
    {
        $this->db->select('*');
        $this->db->from('posting');
        $this->db->join('kartikel', 'kartikel.id_kartikel = posting.id_kartikel');
        $this->db->join('user', 'user.id_user = posting.user');
        $this->db->where('seo_judul', $seo_judul);
        return $this->db->get()->row();
    }

    public function getPosting2()
    {
        $this->db->select('*');
        $this->db->from('posting');
        $this->db->order_by('id_posting', 'ASC');
        $this->db->join('kartikel', 'kartikel.id_kartikel = posting.id_kartikel');
        // $this->db->where('seo_judul', $seo_judul);
        return $this->db->get();
    }

    public function getProduk($seo_name)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kproduk', 'kproduk.id_kproduk = barang.id_kproduk');
        $this->db->where('seo_name', $seo_name);
        return $this->db->get()->row();
    }


    public function get_join($table, $number = null, $offset = null)
    {
        // $this->db->select('*');
        // $this->db->from('posting');
        $this->db->order_by('id_posting', 'desc');
        $this->db->join('kartikel', 'kartikel.id_kartikel = posting.id_kartikel');
        $this->db->join('user', 'user.id_user = posting.user');
        // $this->db->order_by($order, $az);
        $sql = $this->db->get($table, $number, $offset)->result();
        return $sql;
    }
    public function get_join2()
    {
        $login = $this->session->userdata('id_user');
        $this->db->select('user.id, onlineform.date, onlineform.day, onlineform.in1, 
        onlineform.out1, onlineform.in2, onlineform.out2');
        $this->db->from('user');
        $this->db->join('cash_balance', 'cash_balace.id = user.id');
        $this->db->where('id_user', $login);
        // $this->db->order_by($order, $az);
        $sql = $this->db->get();
        return $sql;
    }
    public function join_multiple($table, $join, $pq, $join1, $pq1, $order, $az)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join($join, $pq);
        $this->db->join($join1, $pq1);
        $this->db->order_by($order, $az);
        $sql = $this->db->get();
        return $sql;
    }
    public function get_id($table, $where)
    {
        $this->db->where($where);
        $sql = $this->db->get($table);
        return $sql;
    }
    public function fetch_data($table, $field, $num, $offset)
    {
        empty($offset) ? $offset = 0 : $offset;

        $this->db->query("SET @no=" . $offset);
        $this->db->select('*,(@no:=@no+1) AS nomor');
        $this->db->group_by($field);
        $this->db->order_by($field, 'DESC');

        $data = $this->db->get($table, $num, $offset);

        return $data->result();
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function updateGenerate($table, $array, $data)
    {
        $this->db->where($array);
        return $this->db->update($table, $data);
    }

    public function updateLamaran($id_user, $id_ujian)
    {
        $sql = 'UPDATE  `lamaran` set `status` = 1 WHERE `user_id` = ' . $id_user . ' and `ujian_id` =  ' . $id_ujian . '';

        return $sql;
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getDefaultValues()
    {
        return [
            'judul'        => '',
            'seo_judul'    => '',
            'konten'      => '',
            'description'      => '',
            'featured'     => 'N',
            'choice'       => 'N',
            'thread'       => 'N',
            'id_category'  => '',
            'photo'        => '',
            'is_active'    => '1',
            'date'         => ''
        ];
    }

    public function addEvent($post)
    {
        $params = [
            'nama_event' => $post['nama_event'],
            'description' => $post['description'],
            'tanggal' => $post['tanggal'],
            'lokasi' => $post['lokasi'],
            'foto_pamflet' => $post['image']
        ];
        $this->db->insert('tbl_tentang_kami', $params);
    }
}
