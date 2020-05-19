
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Template Register Legalisir
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Template Register Legalisir</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <div class="row" style="border:3px solid; margin-left: 30px; margin-right:30px;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noregleg" style="text-align:center; width:100%; font-size:22px;"><u>Nomor Register Legalisir</u></label>
                                    <label style="text-align:center; width:100%; font-size:22px;"><?php echo $jenisdok[0]->kode.$template[0]->no_reg.'/'.date('Y',strtotime($template[0]->tanggal)); ?></label>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->    
                    <div class="box-footer">
                        <button class="btn btn-primary" onclick="window.location='<?php echo base_url() ?>cetakTunggal/<?php echo $this->uri->segment('2') ?>';">Cetak</button>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>