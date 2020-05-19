<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Pejabat (PejabatController)
 * Class Pejabat untuk mengendalikan semua pejabat yang berkaitan dengan operasi.
 * @author : Fani Fatina
 */

class Pejabat extends BaseController
{
    /**
     * Ini dasar konstruksi pada Class 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pejabat_model');
        $this->isLoggedIn();   
    }
    
    /**
     * Fungsi ini digunakan menampilkan awal halaman pada pejabat
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Adminduk : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * Fungsi ini digunakan untuk menampilkan daftar pejabat
     */
    function DaftarPejabat()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('pejabat_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->pejabat_model->DaftarPejabatCount($searchText);

			$returns = $this->paginationCompress ( "DaftarPejabat/", $count, 5 );
            
            $data['pejabatRecords'] = $this->pejabat_model->DaftarPejabat($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Adminduk : Daftar Pejabat';
            
            $this->loadViews("pejabat/viewList", $this->global, $data, NULL);
        }
    }

    /**
     * Fungsi ini digunakan untuk menampilkan form tambah pejabat
     */
    function addPejabat()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('pejabat_model');
            
            $this->global['pageTitle'] = 'Adminduk : Buat Pejabat Baru';

            $this->loadViews("pejabat/addPejabat", $this->global, '', NULL);
        }
    }

    /**
     * Fungsi ini digunakan untuk menambah pejabat baru ke dalam sistem.
     */
  
    function addNewPejabat()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('nip','NIP','trim|required|max_length[25]|xss_clean');
            $this->form_validation->set_rules('nama','Nama Pejabat','trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('jabatan','Jabatan','trim|required|max_length[50]|xss_clean');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addPejabat();
            }
            else
            {
                $nip = $this->input->post('nip');
                $nama = $this->input->post('nama');
                $jabatan = $this->input->post('jabatan');

                $pejabatInfo = array('nip'=>$nip, 'nama'=>$nama, 'jabatan'=>$jabatan, 'dibuatOleh'=>$this->vendorId, 'waktuDibuat'=>date('Y-m-d H:i:s'));
                
                $this->load->model('pejabat_model');
                $result = $this->pejabat_model->addNewPejabat($pejabatInfo);
                
                if($result > 0)
                    $this->session->set_flashdata('success', 'Pejabat Baru Berhasil Dibuat');
                else
                    $this->session->set_flashdata('error', 'Pejabat Baru Gagal Dibuat');
                
                redirect('pejabat/addPejabat');
            }
        }
    }

    
    /**
     * Fungsi ini digunakan untuk menampilkan informasi pejabat yang akan diubah
     */
    function editOldPjb($pejabatId = NULL)
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($pejabatId == null)
            {
                redirect('DaftarPejabat');
            }
            
            $data['pejabatInfo'] = $this->pejabat_model->getPejabatInfo($pejabatId);
            
            $this->global['pageTitle'] = 'Adminduk : Ubah Pejabat';
            
            $this->loadViews("pejabat/editOldPjb", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * Fungsi ini digunakan untuk merubah data pejabat
     */
    function editPejabat()
    {
        if($this->isForAll() == TRUE)
        {

            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $pejabatId = $this->input->post('pejabatId');

            $this->form_validation->set_rules('nip','NIP','trim|required|max_length[25]|xss_clean');
            $this->form_validation->set_rules('nama','Nama Pejabat','trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('jabatan','Jabatan','trim|required|max_length[50]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldPjb($pejabatId);
            }
            else
            {
                $nip = $this->input->post('nip');
                $nama = $this->input->post('nama');
                $jabatan = $this->input->post('jabatan');
                
                $pejabatInfo = array('nip'=>$nip, 'nama'=>$nama, 'jabatan'=>$jabatan,
                                    'diubahOleh'=>$this->vendorId, 'waktuDiubah'=>date('Y-m-d H:i:s'));
                
                $result = $this->pejabat_model->editPejabat($pejabatInfo, $pejabatId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Data Pejabat Berhasil Diubah !');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Data Pejabat Gagal Diubah');
                }
                
                redirect('DaftarPejabat');
            }
        }
    }


    /**
     * Fungsi ini digunakan untuk menghapus data pejabat menggunakan pejabatId
     * @return boolean $result : TRUE / FALSE
     */
    function deletePejabat()
    {
        if($this->isForAll() == TRUE)
        {       
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $pejabatId = $this->input->post('pejabatId');
            $pejabatInfo = array('terhapus'=>1,'diubahOleh'=>$this->vendorId, 'waktuDiubah'=>date('Y-m-d H:i:s'));
            
            $result = $this->pejabat_model->deletePejabat($pejabatId, $pejabatInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
}

?>