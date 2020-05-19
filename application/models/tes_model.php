<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Regleg_model extends CI_Model
{
    /**
     * Fungsi ini digunakan untuk mendapatkan jumlah data register legalisir
     * @param string $searchText : ini optional untuk pencarian
     * @return number $count : ini untuk menghitung jumlah baris
     */
    function DaftarRegLegCount($searchText = '', $dt1 , $dt2)
    {
        $this->db->select('*,  jdk.nama as nmjdk , pjb.nama as nmpjb, rlg.tanggal as rlgtgl');
        $this->db->from('tbl_regleg as rlg');
        $this->db->join('tbl_pejabat as pjb', 'pjb.pejabatId = rlg.pejabatId');
        $this->db->join('tbl_jenisdok as jdk', 'jdk.jenisdokId = rlg.jenisdokId');

        if(!empty($searchText)) {
            $likeCriteria = "(no_dok  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($dt1) && !empty($dt2)){
            $dt1 = date('Y-m-d',strtotime($dt1));
            $dt2 = date('Y-m-d',strtotime($dt2));
            
            $likeCriteria = "rlg.tanggal between '".$dt1."' and '".$dt2."' ";
            $this->db->where($likeCriteria);   
        }

        $this->db->where('rlg.terhapus', 0);
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * Fungsi ini digunakan untuk mendapatkan jumlah data register legalisir
     * @param string $searchText : ini optional untuk pencarian
     * @param number $page : Ini untuk halaman (jumlah data)
     * @param number $segment : Ini untuk membatasi jumlah data yang akan ditampilkan
     * @return array $result : Ini adalah hasil
     */

    function DaftarRegLeg($searchText = '', $dt1 , $dt2, $page, $segment)
    {
        $this->db->select('*,  jdk.nama as nmjdk , pjb.nama as nmpjb, rlg.tanggal as rlgtgl');
        $this->db->from('tbl_regleg as rlg');
        $this->db->join('tbl_pejabat as pjb', 'pjb.pejabatId = rlg.pejabatId');
        $this->db->join('tbl_jenisdok as jdk', 'jdk.jenisdokId = rlg.jenisdokId');

        if(!empty($searchText)) {
            $likeCriteria = "(no_dok  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($dt1) && !empty($dt2)){
            $dt1 = date('Y-m-d',strtotime($dt1));
            $dt2 = date('Y-m-d',strtotime($dt2));
            
            $likeCriteria = "rlg.tanggal between '".$dt1."' and '".$dt2."' ";
            $this->db->where($likeCriteria);
        }

        $this->db->where('rlg.terhapus', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();

        return $result;
    }

    function cetakBasedPost($searchText = '', $dt1 , $dt2)
    {
        $this->db->select('*,  jdk.nama as nmjdk , pjb.nama as nmpjb, rlg.tanggal as rlgtgl');
        $this->db->from('tbl_regleg as rlg');
        $this->db->join('tbl_pejabat as pjb', 'pjb.pejabatId = rlg.pejabatId');
        $this->db->join('tbl_jenisdok as jdk', 'jdk.jenisdokId = rlg.jenisdokId');

        if(!empty($searchText)) {
            $likeCriteria = "(no_dok  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($dt1) && !empty($dt2)){
            $dt1 = date('Y-m-d',strtotime($dt1));
            $dt2 = date('Y-m-d',strtotime($dt2));
            
            $likeCriteria = "rlg.tanggal between '".$dt1."' and '".$dt2."' ";
            $this->db->where($likeCriteria);   
        }

        $this->db->where('rlg.terhapus', 0);
        $query = $this->db->get();
        
        $result = $query->result();        

        return $result;
    }

    function cetakTunggal($id)
    {
        $this->db->select('*,  jdk.nama as nmjdk , pjb.nama as nmpjb, rlg.tanggal as rlgtgl');
        $this->db->from('tbl_regleg as rlg');
        $this->db->from('tbl_bioadm as bio', 'bio.bioadmId = rlg.bioadmId');
        $this->db->join('tbl_pejabat as pjb', 'pjb.pejabatId = rlg.pejabatId');
        $this->db->join('tbl_jenisdok as jdk', 'jdk.jenisdokId = rlg.jenisdokId');
        $this->db->where('rlg.reglegId', $id);
        $this->db->where('rlg.terhapus', 0);
        $query = $this->db->get();
        
        $result = $query->result();        

        return $result;
    }

    /**
     * Fungsi ini digunakan untuk mendapatkan id baru yang akan ditambahkan
     */
    function getnewnoreg($year,$jenis)
    {
        $this->db->select('max(no_reg) as noregakhir');
        $this->db->from('tbl_regleg');
        $this->db->where('Year(tanggal)', $year);
        $this->db->where('jenisdokId', $jenis);

        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    /**
    * Fungsi ini digunakan untuk mencari status berdasarkan tahun
    */
    function checkstatbyyearjenis($year,$jenis)
    {
        $this->db->select('*');
        $this->db->from('tbl_regleg');
        $this->db->where('Year(tanggal)', $year);
        $this->db->where('jenisdokId', $jenis);

        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    

    function setNewNoReg($reglegInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_regleg', $reglegInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function editDateforNoReg($reglegInfo, $reglegId)
    {
        $this->db->where('reglegId', $reglegId);
        $this->db->update('tbl_regleg', $reglegInfo);
        
        return TRUE;
    }

    
    /**
     * Fungsi ini untuk menambahkan register legalisir baru
     * @return number $insert_id : Ini ID tambahan terakhir
     */
    function addNewRegLeg($reglegInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_regleg', $reglegInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * Fungsi ini digunakan untuk mendapatkan informasi register legalisir berdasarkan id
     * @param number $reglegId : Ini register legalisir id
     * @return array $result : Ini informasi register legalisir
     */
    function getreglegInfo($reglegId)
    {
        $this->db->select('*');
        $this->db->from('tbl_regleg');
        $this->db->where('reglegId', $reglegId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * Fungsi ini digunakan untuk memperbaharui informasi register legalisir
     * @param array $reglegInfo : Ini informasi register legalisir yang telah diperbaharui
     * @param number $reglegId : Ini register legalisir id
     */
    function insertRegLeg($reglegInfo)
    {

        $this->db->trans_start();
        $this->db->insert('tbl_regleg', $reglegInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    


    /**
     * Fungsi ini digunakan untuk menghapus informasi register legalisir
     * @param number $reglegId : Ini register legalisir id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteRegLeg($reglegId, $reglegInfo)
    {
        $this->db->where('reglegId', $reglegId);
        $this->db->update('tbl_regleg', $reglegInfo);
        
        return $this->db->affected_rows();
    }

}