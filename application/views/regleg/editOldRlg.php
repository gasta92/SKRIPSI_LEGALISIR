<?php

$reglegId = '';
$pjbId = '';
$tgl = '';
$jnsdokId = '';
$nik = '';
$bioadmId = '';

if(!empty($reglegInfo))
{

    foreach ($reglegInfo as $uf)
    {
        $reglegId = $uf->reglegId;
        $pjbId = $uf->pejabatId;
        $tgl = $uf->tanggal;
        $jnsdokId = $uf->jenisdokId;
        $nik = $uf->nik;
        $no_reg = $uf->no_reg;
        $bioadmId = $uf->bioadmId;
    }
}


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manajemen Register Legalisir
        <small>Tambah / Ubah Register Legalisir</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Register Legalisir</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form status="form" action="<?php echo base_url() ?>editRegLeg" method="post" id="editRegLeg" status="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenisdokId">Jenis Dokumen</label>
                                        <select id="jenisdokId" class="form-control required" name="jenisdokId" onchange="_jdk();">
                                        <option value="">-- Pilih Jenis Dokumen --</option>
                                        <?php
                                            $arrjenis = $cbxJenis;
                                            foreach($arrjenis as $k=>$v){
                                                if($jnsdokId==$v->jenisdokId) $sel = 'selected';
                                                else $sel = '';
                                                ?>
                                                <option value="<?php echo $v->jenisdokId; ?>" <?php echo $sel; ?> ><?php echo $v->nama; ?></option>
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
                                        <label for="nik">Nomor Induk Kependudukan</label>
                                        <input type="text" class="form-control required" id="nik_" name="nik_" maxlength="50" value="<?php echo $nik; ?>">
<!--                                         <input type="hidden" class="form-control required" id="nik" name="nik" maxlength="50" value="<?php echo $nik; ?>">
                                        <span class="fa fa-search"><a href="javascript:openFrame();">Cari Data</a></span>
                                        <input type="hidden" class="form-control" id="bioadmId" name="bioadmId" maxlength="50" value="<?php echo $bioadmId; ?>"> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <br><input id="btncari" onclick="_carix();" style="margin-top:5px;" type="button" class="btn btn-primary" value="Cari" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control required" id="tanggal" name="tanggal" value="" maxlength="25">
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
                                                if($pjbId==$v->pejabatId) $sel = 'selected';
                                                else $sel = '';
                                                ?>
                                                <option value="<?php echo $v->pejabatId; ?>" <?php echo $sel; ?> ><?php echo $v->nama.' ('.$v->nip.') '; ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="frameGw"></div>
                            <?php
                            /*
                            <div class="row" style="border:3px solid; margin-left: 30px; margin-right:30px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="noregleg" style="text-align:center; width:100%; font-size:22px;"><u>Nomor Register Legalisir</u></label>
                                        <label style="text-align:center; width:100%; font-size:22px;"><?php echo 'KK'.sprintf("%07d", $no_reg).'/'.date('Y',strtotime($tgl)); ?></label>
                                    </div>
                                </div>
                            </div>
                            */
                            ?>
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
<script>
    function _jdk(){
        var valx = $('#jenisdokId').val();
        if(valx==4){
            $('#btncari').css("display","none");
            $('#frameGw').css("display","none");
        }
        else{
            $('#btncari').css("display","block");
            $('#frameGw').css("display","block");
        }
        $('#nik_').val('');
        $("#frameGw table").remove();
    }
</script>
<script type="text/javascript">
    function _carix(){
        var nik = $('#nik_').val();
        var urlx = "<?php echo base_url(); ?>ViewBioAdm?layout=free";

        $.ajax({
            //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
            url      : urlx,
            type     : 'POST',
            dataType : 'html',
            data     : 'nik='+nik,
            error: function (request, error) {
                alert(" Can't do because: " + error);
            },
            success  : function(respons){
                $('#frameGw').html(respons);
            },
        })
    }
</script>
<script src="<?php echo base_url(); ?>/assets/js/editRegLeg.js" type="text/javascript"></script>
<script>
    function openWindow() { 
       var x = screen.width/2 - 200;
       var y = screen.height/2 - 150;
       var win = window.open("<?php echo base_url(); ?>HookBioAdmList?layout=free","_blank","height=300,width=500,left="+x+",top="+y+", status=yes,toolbar=no,menubar=no,location=center"); 
       win.focus();
    }

    function openFrame(){ 
       var x = screen.width/2 - 200;
       var y = screen.height/2 - 150;
       var elm = '<iframe class="col-md-12" src="<?php echo base_url(); ?>HookBioAdmList?layout=free"></iframe>';
       var fg = document.getElementById('frameGw')
       fg.innerHTML = elm;
       // var win = window.open("<?php echo base_url(); ?>HookBioAdmList?layout=free","_blank","height=300,width=500,left="+x+",top="+y+", status=yes,toolbar=no,menubar=no,location=center"); 
       //win.focus();
    } 

    function passvaluex(bioadmId,nik){
        document.getElementById("bioadmId").value = bioadmId;
        document.getElementById("nik_").value = nik;
        document.getElementById("nik").value = nik;
    }

</script>