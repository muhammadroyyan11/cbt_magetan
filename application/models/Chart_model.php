<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chart_model extends CI_Model
{
    public function chart($id = null, $gol = null)
    {
        $this->db->select('sum(jumlah) as count, wisata_id, wisata.nama');
        $this->db->from('pengunjung');
        $this->db->join('wisata', 'wisata.id_wisata = pengunjung.wisata_id');
        if ($id != null) {
            $this->db->where('wisata_id', $id);
        }

        if ($gol != null) {
            $this->db->where('golongan', $gol);
        }
        $sql = $this->db->get();
        return $sql;
    }

    public function chart_data($id = null, $gol = null)
    {
        $this->db->select('distinct sum(jumlah) as count, golongan, wisata.nama, wisata_id');
        $this->db->from('pengunjung');
        $this->db->join('wisata', 'wisata.id_wisata = pengunjung.wisata_id');
        $this->db->where('DATE(dateTime)', date('Y-m-d'));
        if ($id != null) {
            $this->db->where('wisata_id', $id);
        }

        if ($gol != null) {
            $this->db->where('golongan', $gol);
        }
        $this->db->group_by('wisata_id');
        $this->db->group_by('golongan');
        $sql = $this->db->get();
        return $sql;
    }

    public function chart_total($id = null, $gol = null)
    {
        $this->db->select('sum(jumlah) as count, golongan, wisata.nama, wisata_id');
        $this->db->from('pengunjung');
        $this->db->join('wisata', 'wisata.id_wisata = pengunjung.wisata_id');
        $this->db->where('DATE(dateTime)', date('Y-m-d'));
        if ($id != null) {
            $this->db->where('wisata_id', $id);
        }

        if ($gol != null) {
            $this->db->where('golongan', $gol);
        }
        $this->db->group_by('wisata_id');
        // $this->db->group_by('golongan');
        $sql = $this->db->get();
        return $sql;
    }

    public function chartGolongan($gol = null)
    {
        $this->db->select('*');
        $this->db->from('pengunjung');
        if ($gol != null) {
            $this->db->where('golongan', $gol);
        }
        $sql = $this->db->get();
        return $sql;
    }

}