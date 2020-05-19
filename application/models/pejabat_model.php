<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pejabat_model extends CI_Model
{
    /**
     * Fungsi ini digunakan untuk mendapatkan jumlah data pejabat
     * @param string $searchText : ini optional untuk pencarian
     * @return number $count : ini untuk menghitung jumlah baris
     */
    function DaftarPejabatCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_pejabat');
        if(!empty($searchText)) {
            $likeCriteria = "(nip  LIKE '%".$searchText."%'
                            OR  nama  LIKE '%".$searchText."%'
                            OR  jabatan  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('terhapus', 0);
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * Fungsi ini digunakan untuk mendapatkan jumlah data pejabat
     * @param string $searchText : ini optional untuk pencarian
     * @param number $page : Ini untuk halaman (jumlah data)
     * @param number $segment : Ini untuk membatasi jumlah data yang akan ditampilkan
     * @return array $result : Ini adalah hasil
     */

    function DaftarPejabat($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_pejabat');
        if(!empty($searchText)) {
            $likeCriteria = "(nip  LIKE '%".$searchText."%'
                            OR  nama  LIKE '%".$searchText."%'
                            OR  jabatan  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('terhapus', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        

        return $result;
    }
    
    /**
     * Fungsi ini untuk menambahkan pejabat baru
     * @return number $insert_id : Ini ID tambahan terakhir
     */
    function addNewPejabat($pejabatInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_pejabat', $pejabatInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * Fungsi ini digunakan untuk mendapatkan informasi pejabat berdasarkan id
     * @param number $pejabatId : Ini pejabat id
     * @return array $result : Ini informasi pejabat
     */
    function getPejabatInfo($pejabatId)
    {
        $this->db->select('*');
        $this->db->from('tbl_pejabat');
        $this->db->where('pejabatId', $pejabatId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * Fungsi ini digunakan untuk memperbaharui informasi pejabat
     * @param array $pejabatInfo : Ini informasi pejabat yang telah diperbaharui
     * @param number $pejabatId : Ini pejabat id
     */
    function editPejabat($pejabatInfo, $pejabatId)
    {
        $this->db->where('pejabatId', $pejabatId);
        $this->db->update('tbl_pejabat', $pejabatInfo);
        
        return TRUE;
    }
    

    /**
     * Fungsi ini digunakan untuk menghapus informasi pejabat
     * @param number $pejabatId : Ini pejabat id
     * @return boolean $result : TRUE / FALSE
     */
    function deletePejabat($pejabatId, $pejabatInfo)
    {
        $this->db->where('pejabatId', $pejabatId);
        $this->db->update('tbl_pejabat', $pejabatInfo);
        
        return $this->db->affected_rows();
    }

}