<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function get_rekap_visitor($where = null, $range = null)
    {
        $this->db->select('*');
        $this->db->from('pengunjung');
        $this->db->join('wisata', 'wisata.id_wisata = pengunjung.wisata_id');
        if ($where != null) {
            $this->db->where('wisata_id',$where);
        }
        if ($range != null) {
            $this->db->where('dateTime' . ' >=', $range['mulai']);
            $this->db->where('dateTime' . ' <=', $range['akhir']);
        }
        // $this->db->order_by('dateTime', 'DESC');
        $this->db->order_by('nama', 'ASC');
        return $this->db->get();
    }

    
}
