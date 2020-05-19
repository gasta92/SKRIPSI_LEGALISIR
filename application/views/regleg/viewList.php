<?php

$dt1str = '';
$dt2str = '';
$searchText1 = '';
$jdok = '';

if($dt1!='') $dt1str = strtotime($dt1);
else $dt1str = '-';

if($dt2!='') $dt2str = strtotime($dt2);
else $dt2str = '-';

if($searchText!='') $searchText1 = $searchText;
else $searchText1 = '-';

if($iptjensidok!='') $jdok = $iptjensidok;
else $jdok = '-';

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manajemen Register Legalisasi
<!--         <small>Tambah, Ubah, Hapus</small> -->
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>editOldRlg"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Register Legalisir</h3>

                    <div class="box-tools">
                        <form name="frm" action="<?php echo base_url() ?>DaftarRegLeg" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari No. Dokumen"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                            <div class="input-group" style="padding:10px;">
                              Tanggal <input type="date" name="date1" value="" />
                              &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                              Tanggal <input type="date" name="date2" value="" />
                              &nbsp;&nbsp;&nbsp;
                              <select style="height:42px;" name="jenisdok" >
                                <option value="">--Pilih--</option>
                                <?php
                                foreach($jenisdok as $k=>$v){
                                  if($jdok==$v->jenisdokId) $chck='checked';
                                  else $chck='';
                                  ?>
                                  <option value="<?php echo $v->jenisdokId; ?>" <?php echo $chck; ?>><?php echo $v->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              &nbsp;&nbsp;&nbsp;
                              <a class="btn btn-primary" href="javascript:document.frm.submit();"><i class="fa fa-search"></i> CARI</a>
                              &nbsp;&nbsp;&nbsp;
                              <a class="btn btn-primary" href="<?php echo base_url() ?>cetakpdf/<?php echo $dt1str; ?>/<?php echo $dt2str; ?>/<?php echo $jdok; ?>/<?php echo $searchText1; ?>"><i class="fa fa-print"></i> CETAK</a>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <br><br><br>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>No. Register</th>
                      <th>Nomor Identitas Kependudukan</th>
                      <th>Jenis Dokumen</th>
                      <th>Pejabat Legalisir</th>
                      <th>Tanggal</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($reglegRecords))
                    {
                        $no = 1;
                        foreach($reglegRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $record->kode.$record->no_reg.'/'.date('Y',strtotime($record->rlgtgl)); ?></td>
                      <td><?php echo $record->nik ?></td>
                      <td><?php echo $record->nmjdk ?></td>
                      <td><?php echo $record->nmpjb ?></td>
                      <td><?php echo date('d-m-Y',strtotime($record->rlgtgl));?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'viewTemplate/'.$record->reglegId; ?>"><i class="fa fa-search"></i></a>
                      </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    }
                    ?>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "DaftarRegLeg/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>