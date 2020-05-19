
<?php
if(empty($bioadmRecords)){
    ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Data tidak ditemukan                    
    </div>
    <?php
    die();
}
else{
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Data ditemukan !
    </div>
    <?php
}
?>
<table class="table table-hover">
<tr>
  <th>No</th>
  <th>NIK</th>
  <th>Nama Lengkap</th>
  <th>Jenis Kelamin</th>
  <th>Tempat Lahir</th>
  <th>Tanggal Lahir</th>
  <th class="text-center">Actions</th>
</tr>
<?php
if(!empty($bioadmRecords)){
    $no = 1;
    foreach($bioadmRecords as $record){
    ?>
    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $record->NIK ?></td>
      <td><?php echo $record->NAMA_LGKP ?></td>
      <td><?php if($record->JENIS_KLMIN=='L') echo'Laki-Laki'; else if($record->JENIS_KLMIN=='P') echo'Perempuan'; ?></td>
      <td><?php echo $record->TMPT_LHR ?></td>
      <td><?php echo $record->TGL_LHR ?></td>
      
      <td class="text-center">
          <a target="_blank" class="btn btn-sm btn-info" href="<?php echo base_url().'detailBam/'.$record->bioadmId; ?>"><i class="fa fa-info"></i></a>
      </td>
    </tr>
    <?php
    $no++;
    }
}
?>
</table>
<input type="hidden" name="bioadmId" value="<?php echo $bioadmRecords[0]->bioadmId; ?>" />