<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manajemen Register Legalisasi
        <small>Tambah / Ubah Register Legalisasi</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Register Legalisasi</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form name="frmRegLeg" status="form" id="addRegLeg" action="<?php echo base_url() ?>addNewRegLeg" method="post" status="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control required" id="tanggal" name="tanggal" maxlength="25">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pejabatId">NIP Pejabat Legalisir</label>
                                        <select id="pejabatId" class="form-control required" name="pejabatId">
                                        <option value="">-- Pilih Pejabat --</option>
                                        <?php

                                            $arrpejabat = $cbxPejabat;
                                            foreach($arrpejabat as $k=>$v){
                                                ?>
                                                <option value="<?php echo $v->pejabatId; ?>" ><?php echo $v->nama.' ('.$v->nip.') '; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenisdokId">Jenis Dokumen</label>
                                        <select id="jenisdokId" class="form-control required" name="jenisdokId">
                                        <option value="">-- Pilih Jenis Dokumen --</option>
                                        <?php

                                            $arrjenis = $cbxJenis;
                                            foreach($arrjenis as $k=>$v){
                                                ?>
                                                <option value="<?php echo $v->jenisdokId; ?>" ><?php echo $v->nama; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_dok">Nomor Identitas Dokumen Adminduk</label>
                                        <input type="text" disabled class="form-control required" id="no_dok" name="no_dok" maxlength="50">
                                        <input type="hidden" class="form-control required" id="nodok" name="nodok" maxlength="50">
                                        <span class="fa fa-search"><a href="javascript:openWindow();">Cari Data</a></span>
                                        <input type="hidden" class="form-control" id="bioadmId" name="bioadmId" maxlength="50">
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
<script src="<?php echo base_url(); ?>assets/js/addRegLeg.js" type="text/javascript"></script>
<script>
    function openWindow() { 
       var x = screen.width/2 - 200;
       var y = screen.height/2 - 150;
       var win = window.open("<?php echo base_url(); ?>HookBioAdmList?layout=free","_blank","height=300,width=500,left="+x+",top="+y+", status=yes,toolbar=no,menubar=no,location=center"); 
       win.focus();
    } 
</script>