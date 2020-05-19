<?php

$pejabatId = '';
$nip = '';
$nama = '';
$jabatan = '';

if(!empty($pejabatInfo))
{
    foreach ($pejabatInfo as $uf)
    {
        $pejabatId = $uf->pejabatId;
        $nip = $uf->nip;
        $nama = $uf->nama;
        $jabatan = $uf->jabatan;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manajemen Pejabat
        <small>Tambah / Ubah Pejabat</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Pejabat</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form status="form" action="<?php echo base_url() ?>editPejabat" method="post" id="editPejabat" status="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="<?php echo $nip; ?>" maxlength="25">
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?php echo $nama; ?>" maxlength="50">
                                        <input type="hidden" value="<?php echo $pejabatId; ?>" name="pejabatId" id="pejabatId" />    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" name="jabatan" value="<?php echo $jabatan; ?>" maxlength="50">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>../assets/js/editPejabat.js" type="text/javascript"></script>