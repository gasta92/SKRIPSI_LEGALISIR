<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Register Legaisir (RegLegController)
 * Class RegLeg untuk mengendalikan semua register legalisir yang berkaitan dengan operasi.
 * @author : Fani Fatina
 */

class RegLeg extends BaseController
{
    /**
     * Ini dasar konstruksi pada Class 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('regleg_model');
        $this->load->model('pejabat_model');
        $this->load->model('jenisdok_model');
        $this->load->model('bioadm_model');
        $this->isLoggedIn();
    }
    
    /**
     * Fungsi ini digunakan menampilkan awal halaman pada register legalisir
     */

    public function index()
    {
        $this->global['pageTitle'] = 'Adminduk : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }


    function cetakpdf(){
        //2 (tglawal) 3 (tglakhir) 4 (searchText)
        $tgl1 = $tgl2 = $searchText = $jenisdok = '';

        if($this->uri->segment('2')!='-') $tgl1 = date('d-m-Y',$this->uri->segment('2'));
        else $tgl1 = '';

        if($this->uri->segment('3')!='-') $tgl2 = date('d-m-Y',$this->uri->segment('3'));
        else $tgl2 = '';

        if($this->uri->segment('4')!='-') $jenisdok = $this->uri->segment('4');
        else $jenisdok = '';

        if($this->uri->segment('5')!='-') $searchText = $this->uri->segment('5');
        else $searchText = '';

        $pdf = new FPDF('L','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string
        $pdf->Cell(275,7,'LAPORAN REGISTER LEGALISIR',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $reglegData = $this->regleg_model->cetakBasedPost($searchText,$tgl1,$tgl2,$jenisdok);


        if($tgl1!='' && $tgl2!=''){
            $pdf->Cell(190,6,'Tanggal '.$tgl1.' s/d '.$tgl2,0,1,'C');
        }
        if($jenisdok!=''){
            $pdf->Cell(190,6,'Jenis Dokumen : '.$reglegData[0]->nmjdk,0,1,'C');
        }

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(10,6,'',0,0);
        $pdf->Cell(10,6,'',0,0);
        $pdf->Cell(10,6,'',0,0);
        $pdf->Cell(10,6,'No.',1,0);
        $pdf->Cell(35,6,'No Register',1,0);
        $pdf->Cell(35,6,'NIK',1,0);
        $pdf->Cell(45,6,'Jenis Dokumen',1,0);
        $pdf->Cell(55,6,'Pejabat Legalisir',1,0);
        $pdf->Cell(25,6,'Tanggal',1,1);
        $pdf->SetFont('Arial','',10);

        $i=1;
        foreach ($reglegData as $row){
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(10,6,$i,1,0);
            $pdf->Cell(35,6,$row->kode.$row->no_reg.'/'.date('Y',strtotime($row->rlgtgl)),1,0);
            $pdf->Cell(35,6,$row->nik,1,0);
            $pdf->Cell(45,6,$row->nmjdk,1,0);
            $pdf->Cell(55,6,$row->nmpjb,1,0);
            $pdf->Cell(25,6,date('d-m-Y',strtotime($row->rlgtgl)),1,1);

            $i++;
        }

        $pdf->Output();
    }

    function cetakTunggal(){
        date_default_timezone_set("Asia/Jakarta");
        $tgl1 = $tgl2 = $searchText = '';

        $id= $this->uri->segment('2');
        if($id!=''){
            $reglegData = $this->regleg_model->cetakTunggal($id);

            $pdf = new FPDF('l','cm',array(15,12));
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',10);
            $pdf->MultiCell(13,0.5,'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL '."\n".' KABUPATEN BANTUL',0,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->MultiCell(13,0.5,'Tanggal : '.date('d-m-Y').' '."\n".' Jam : '.date('H:i').' ',0,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Ln();
            $pdf->MultiCell(13,0.5,'NO. KARTU KELUARGA : '.$reglegData[0]->NO_KK,0,'C');
            $pdf->MultiCell(13,0.5,'Nomor Register Legalisasi Dokumen Adminduk : ',0,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->MultiCell(13,0.5,$reglegData[0]->kode.$reglegData[0]->no_reg.'/'.date('Y',strtotime($reglegData[0]->rlgtgl)),0,'C');
            $pdf->SetFont('Arial','',10);
            $pdf->Ln();
            $pdf->SetFont('Arial','',8);
            $pdf->MultiCell(13,0.5,'Silahkan tulis nomor di atas pada dokumen adminduk dengan '."\n".' tanggal yang sama, yang telah dilegalisir di Disdukcapil Bantul',0,'C');
            $pdf->MultiCell(13,0.5,'--TERIMAKASIH--',0,'C');
            $pdf->MultiCell(13,0.5,$reglegData[0]->jabatan,0,'R');
            $pdf->Ln();$pdf->Ln();
            $pdf->MultiCell(13,0.5,$reglegData[0]->nmpjb."\n".$reglegData[0]->nip,0,'R');


            $pdf->Output();
        }
    }


    /**
     * Fungsi ini digunakan untuk menampilkan daftar pejabat di combobox
     */
    function CbxPejabat()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('pejabat_model');
            $data['pejabatRecords'] = $this->pejabat_model->DaftarPejabat('', '', '');
            return $data['pejabatRecords'];

            
        //  $this->loadViews("pejabat/viewList", $this->global, $data, NULL);
        }
    }

    /**
     * Fungsi ini digunakan untuk menampilkan daftar jenis dokumen di combobox
     */
    function CbxJenis()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('jenisdok_model');
            $data['jenisdokRecords'] = $this->jenisdok_model->DaftarJenisDok('', '', '');
            return $data['jenisdokRecords'];

            
        //  $this->loadViews("pejabat/viewList", $this->global, $data, NULL);
        }
    }


    
    /**
     * Fungsi ini digunakan untuk menampilkan daftar biodata adminduk
     */
    function HookBioAdmList()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('bioadm_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->bioadm_model->DaftarBioAdmCount($searchText);

            $returns = $this->paginationCompress ( "DaftarBioAdm/", $count, 5 );
            
            $data['bioadmRecords'] = $this->bioadm_model->DaftarBioAdm($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Adminduk : Daftar Biodata Adminduk';
            
            $this->loadViews("regleg/viewBioAdmList", $this->global, $data, NULL);
        }
    }

    /**
     * Fungsi ini digunakan untuk menampilkan daftar register legalisir
     */
    function DaftarRegLeg()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('regleg_model');
            $this->load->model('jenisdok_model');
        
            $searchText = $this->input->post('searchText');
            $dt1 = $this->input->post('date1');
            $dt2 = $this->input->post('date2');
            $jenisdok = $this->input->post('jenisdok');

            $data['searchText'] = $searchText;
            $data['dt1'] = $dt1;
            $data['dt2'] = $dt2;
            $data['iptjensidok'] = $jenisdok;

            $this->load->library('pagination');
            
            $data['jenisdok'] = $this->jenisdok_model->ListJenisDok();
            
            $count = $this->regleg_model->DaftarRegLegCount($searchText, $dt1, $dt2, $jenisdok);

			$returns = $this->paginationCompress ( "DaftarRegLeg/", $count, 5 );
            
            $data['reglegRecords'] = $this->regleg_model->DaftarRegLeg($searchText, $dt1, $dt2, $jenisdok, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Adminduk : Daftar Register Legalisir';
            
            $this->loadViews("regleg/viewList", $this->global, $data, NULL);
        }
    }

    /**
    * Fungsi ini digunakan untuk menampilkan form tambah register legalisir
    */

    function setDate()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            $this->load->model('regleg_model');
            $this->global['pageTitle'] = 'Tentukan Tanggal';
            $this->loadViews("regleg/setDate", $this->global, '', NULL);

        }
    }

    function setDateNew()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('tanggal','Tanggal','trim|required|max_length[25]|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->setDate();
            }
            else
            {
                $tanggal = $this->input->post('tanggal');
                $y__ = date('Y', strtotime($tanggal));
                $this->load->model('regleg_model');

                $chckstat = $this->regleg_model->checkstatbyyear($y__);

                $THEID = '';
                if(count($chckstat)==0){
                    // insert baru
                    $DATANOBARU = $this->regleg_model->getnewnoreg($y__);

                    $GETNOREGBARU = '';
                    if(count($DATANOBARU)==0) $GETNOREGBARU = 1;
                    else $GETNOREGBARU = $DATANOBARU[0]->noregakhir+1;

                    $reglegInfo = array('tanggal'=>$tanggal, 'no_reg'=>$GETNOREGBARU, 'dibuatOleh'=>$this->vendorId, 'waktuDibuat'=>date('Y-m-d H:i:s'));
                    $result = $this->regleg_model->setNewNoReg($reglegInfo);
                    $THEID = $result;
                }
                else{
                    // update yang lama
                    $reglegId = $chckstat[0]->reglegId;
                    $reglegInfo = array('tanggal'=>$tanggal);   
                    $result = $this->regleg_model->editDateforNoReg($reglegInfo,$reglegId);
                    $THEID = $reglegId;
                }
                
                // if($result > 0)
                //     $this->session->set_flashdata('success', 'Register Legalisir Baru Berhasil Dibuat');
                // else
                //     $this->session->set_flashdata('error', 'Register Legalisir Baru Gagal Dibuat');
                
                redirect('regleg/editOldRlg/'.$THEID);
            }
        }
    }


    function addRegLeg()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            $this->load->model('regleg_model');
            $data['cbxPejabat'] = $this->CbxPejabat();
            $data['cbxJenis'] = $this->CbxJenis();
            
            $this->global['pageTitle'] = 'Adminduk : Buat Register Legalisir Baru';

            $this->loadViews("regleg/addRegLeg", $this->global, $data, NULL);

        }
    }
  
    
    /**
     * Fungsi ini digunakan untuk menampilkan informasi register legalisir yang akan diubah
     */
    function editOldRlg($reglegId = NULL)
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            // if($reglegId == null)
            // {
            //     redirect('DaftarRegLeg');
            // }

            $this->load->model('regleg_model');
            $data['cbxPejabat'] = $this->CbxPejabat();
            $data['cbxJenis'] = $this->CbxJenis();
            $data['reglegInfo'] = $this->regleg_model->getRegLegInfo($reglegId);

            $this->global['pageTitle'] = 'Adminduk : Ubah Register Legalisir';
            
            $this->loadViews("regleg/editOldRlg", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * Fungsi ini digunakan untuk merubah data register legalisir
     */
    function editRegLeg()
    {
        if($this->isForAll() == TRUE)
        {

            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            

            $this->form_validation->set_rules('pejabatId','Pejabat','trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('jenisdokId','Jenis Dokumen','trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('nik_','Nomor Induk Kependudukan','trim|required|max_length[16]|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldRlg();
            }
            else
            {   

                $pejabat = $this->input->post('pejabatId');
                $jenis = $this->input->post('jenisdokId');
                $nik = $this->input->post('nik_');
                $tanggal = $this->input->post('tanggal');
                $y__ = date('Y', strtotime($tanggal));

                $DATANOBARU = $this->regleg_model->getnewnoreg($y__,$jenis);
                $GETNOREGBARU = '';
                if(count($DATANOBARU)==0) $GETNOREGBARU = 1;
                else $GETNOREGBARU = $DATANOBARU[0]->noregakhir+1;

                if($jenis=='4'){
                    $dt1week = $this->regleg_model->getreglegInfoByNIK($nik);
                    echo'<pre>';
                    print_r($dt1week);
                    echo'</pre>';

                    if(strtotime($tanggal)>strtotime($dt1week[0]->tanggal)+604800){
                        $GETNOREGBARU = $GETNOREGBARU;   
                    }
                    else{
                        $GETNOREGBARU = $dt1week[0]->no_reg;
                    }

                    echo $GETNOREGBARU;
                }

                $reglegInfo = array('tanggal'=>$tanggal, 'no_reg'=>$GETNOREGBARU, 'pejabatId'=>$pejabat, 'jenisdokId'=>$jenis, 'nik'=>$nik, 'dibuatOleh'=>$this->vendorId,'waktuDibuat'=>date('Y-m-d H:i:s'));
    
                $result = $this->regleg_model->insertRegLeg($reglegInfo);
                redirect('viewTemplate/'.$result);
            }
        }
    }

    function ViewTemplate()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $id =  $this->uri->segment('2');
            $this->load->model('regleg_model');
            $this->load->model('jenisdok_model');
            $data['template'] = $this->regleg_model->getreglegInfo($id);
            $data['jenisdok'] = $this->jenisdok_model->getJenisDokInfo($data['template'][0]->jenisdokId);

            $this->global['pageTitle'] = 'Adminduk : Template Register Legalisir';
            
            $this->loadViews("regleg/viewTemplate", $this->global, $data, NULL);
        }
    }



    /**
     * Fungsi ini digunakan untuk menghapus data register legalisir menggunakan reglegId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteReglLeg()
    {
        if($this->isForAll() == TRUE)
        {       
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $reglegId = $this->input->post('reglegId');
            $reglegInfo = array('terhapus'=>1,'diubahOleh'=>$this->vendorId, 'waktuDiubah'=>date('Y-m-d H:i:s'));
            
            $result = $this->regleg_model->deleteRegLeg($reglegId, $reglegInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    function ViewBioAdm()
    {
        if($this->isForAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if(isset($_POST['nik'])){
                $this->load->model('bioadm_model');
                $data['bioadmRecords'] = $this->bioadm_model->getBioAdmInfoByNIK($_POST['nik']);
                $this->global['pageTitle'] = 'Adminduk : Detail Biodata Adminduk';
                $this->loadViews("regleg/viewBio", $this->global, $data, NULL);

            }
        }
    }

}

?>
