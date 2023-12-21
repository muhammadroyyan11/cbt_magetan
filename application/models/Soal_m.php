<?php defined('BASEPATH') or exit('No direct script access allowed');

class Soal_m extends CI_Model
{

    public function get($where = null)
    {
        $this->db->select('*');
        $this->db->from('el_ujian_soal');
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = array(
            'pertanyaan' => $post['pertanyaan'],
            'p_a' => $post['p_a'],
            'p_b' => $post['p_b'],
            'p_c' => $post['p_c'],
            'p_d' => $post['p_d'],
            'kunci' => $post['kunci'],
            'ujian_id' => $post['ujian_id'],
        );
        $this->db->insert('soal', $params);
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

    public function getSoalById($id_soal)
    {
        return $this->db->get_where('soal', ['id_soal' => $id_soal])->row();
    }
    
}
