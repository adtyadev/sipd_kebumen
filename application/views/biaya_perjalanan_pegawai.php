<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("_partials/head.php") ?>
  <title></title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <?php $this->load->view("_partials/header.php") ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar" >
      <!-- style="background: #194051" -->
      <!-- style="background: #194051" -->
      <!-- sidebar: style can be found in sidebar.less -->
      <?php $this->load->view("_partials/sidebar.php") ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style=" background-image: url('<?php echo base_url('assets')?>/dist/img/regal.png');
    background-repeat: repeat;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Biaya Perjalanan Dinas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Biaya Perjalanan Dinas</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="exampler" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor SPPD</th>
                    <th>Nama Pegawai Tugas</th>
                    <th>Mata Anggaran</th>
                    <th>Rincian Anggaran</th>
                    <th>Total Anggaran</th>
<!--                     <th>Laporan SPJ</th>
                    <th>Cetak Anggaran</th> -->
                    <th>Action</th>   
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  $temp_idPerjalananDinas='';
                  $temp_idPegawaiTugas='';


                  foreach ($surat_perintah_perjalanan_dinas as $data_surat_perintah_perjalanan_dinas) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $no;?>
                      </td>
                      <td> <?php echo $data_surat_perintah_perjalanan_dinas->nomor_sppd; ?> </td>
                      <td> 
                        <?php
                        foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                          if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                            $temp_idPerjalananDinas=$data_surat_perintah_perjalanan_dinas->idPerjalananDinas;
                            $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
                            echo $data_perjalanan_dinas->nama_pegawai . '<br>';

                            foreach($pegawai_pengikut as $data_pegawai_pengikut){
                              if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                                echo $data_pegawai_pengikut->nama_pegawai . "<br>";
                                if (!isset($temp_idPegawaiPengikut)) {
                                  $temp_idPegawaiPengikut[0]=$data_pegawai_pengikut->idPegawaiPengikut;
                                }
                                else {
                                  array_push($temp_idPegawaiPengikut, $data_pegawai_pengikut->idPegawaiPengikut);
                                }
                              }
                            }
                            break;
                          }
                        };
                        ?>
                      </td>
                      <td> 
                        <?php echo $data_surat_perintah_perjalanan_dinas->mata_anggaran;
                        ?>
                      </td>
                      <td>
                        <?php
                        $total_anggaran=0;
                        foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                          if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                            $temp_idPerjalananDinas=$data_surat_perintah_perjalanan_dinas->idPerjalananDinas;
                            $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
                            echo "Biaya Anggaran Pegawai Tugas : <br>";

                            if ($data_perjalanan_dinas->nominal_biaya_harian == NULL ) {
                             echo "Biaya Harian : Rp 0,- <br>";
                             $total_anggaran+=0;
                           }
                           else {
                             echo "Biaya Harian : Rp " . $data_perjalanan_dinas->nominal_biaya_harian . ',-<br>';
                             $total_anggaran+=(INT)$data_perjalanan_dinas->nominal_biaya_harian;
                           }

                           if ($data_perjalanan_dinas->nominal_biaya_penginapan==NULL) {
                             echo "Biaya Penginapan : Rp 0,- <br>";
                             $total_anggaran+=0;
                           }
                           else{
                            echo "Biaya Penginapan : Rp " . $data_perjalanan_dinas->nominal_biaya_penginapan . ',-<br>';
                            $total_anggaran+=(INT)$data_perjalanan_dinas->nominal_biaya_penginapan;
                          }

                          if ($data_perjalanan_dinas->nominal_biaya_mobil==NULL) {
                            echo "Biaya Transportasi Mobil : Rp 0,-  <br>";
                            $total_anggaran+=0;
                          }
                          else{
                            echo "Biaya Transportasi Mobil : Rp " . (INT)$data_perjalanan_dinas->nominal_biaya_mobil*(INT)$data_perjalanan_dinas->jarak_perjalanan . ',-<br>';
                            $total_anggaran+=( (INT)$data_perjalanan_dinas->nominal_biaya_mobil*(INT)$data_perjalanan_dinas->jarak_perjalanan );
                          }

                          if ($data_perjalanan_dinas->kelas_transportasi==NULL) {
                            echo "Biaya Transportasi Bukan Mobil : -  <br>" ;
                          }
                          else {
                           echo "Biaya Transportasi Bukan Mobil : Rp " . $data_perjalanan_dinas->kelas_transportasi . ',-<br>';
                         }

                         if ( $data_perjalanan_dinas->nominal_biaya_tambahan == NULL) {
                          echo "Biaya Tambahan lain : Rp 0,- <br>";
                          $total_anggaran+=0;
                        } 
                        else {
                          echo "Biaya Tambahan lain : Rp " . $data_perjalanan_dinas->nominal_biaya_tambahan . ',-<br>';
                          $total_anggaran+=(INT)$data_perjalanan_dinas->nominal_biaya_tambahan;
                        } 

                        $noPengikut=1;
                        foreach($pegawai_pengikut as $data_pegawai_pengikut){

                          if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                            echo "<br>Biaya Anggaran Pegawai Pengikut : <br>";
                            if ($data_pegawai_pengikut->nominal_biaya_harian == NULL ) {
                             echo "Biaya Harian : Rp 0,- <br>";
                             $total_anggaran+=0;
                           }
                           else {
                             echo "Biaya Harian : Rp " . $data_pegawai_pengikut->nominal_biaya_harian . ',-<br>';
                             $total_anggaran+=(INT)$data_pegawai_pengikut->nominal_biaya_harian;
                           }

                           if ($data_pegawai_pengikut->nominal_biaya_penginapan==NULL) {
                             echo "Biaya Penginapan : Rp 0,- <br>";
                             $total_anggaran+=0;
                           }
                           else{
                            echo "Biaya Penginapan : Rp " . $data_pegawai_pengikut->nominal_biaya_penginapan . ',-<br>';
                            $total_anggaran+=(INT)$data_pegawai_pengikut->nominal_biaya_penginapan;
                          }

                          if ($data_pegawai_pengikut->nominal_biaya_mobil==NULL) {
                            echo "Biaya Transportasi Mobil : Rp 0,-  <br>";
                            $total_anggaran+=0;
                          }
                          else{
                            echo "Biaya Transportasi Mobil : Rp " . (INT)$data_pegawai_pengikut->nominal_biaya_mobil*(INT)$data_perjalanan_dinas->jarak_perjalanan . ',-<br>';
                            $total_anggaran+=(INT)$data_pegawai_pengikut->nominal_biaya_mobil*(INT)$data_perjalanan_dinas->jarak_perjalanan;
                          }

                          if ($data_pegawai_pengikut->kelas_transportasi==NULL) {
                            echo "Biaya Transportasi Bukan Mobil : -  <br>" ;
                          }
                          else {
                           echo "Biaya Transportasi Bukan Mobil : " . $data_pegawai_pengikut->kelas_transportasi . '<br>';
                         }

                         if ( $data_pegawai_pengikut->nominal_biaya_tambahan == NULL) {
                          echo "Biaya Tambahan lain : Rp 0,- <br>";
                          $total_anggaran+=0;
                        } 
                        else {
                          echo "Biaya Tambahan lain : Rp " . $data_pegawai_pengikut->nominal_biaya_tambahan . ',-<br>';
                          $total_anggaran+=(INT)$data_pegawai_pengikut->nominal_biaya_tambahan;
                        } 

                        $noPengikut++;
                        if (!isset($temp_idPegawaiPengikut)) {
                          $temp_idPegawaiPengikut[0]=$data_pegawai_pengikut->idPegawaiPengikut;
                        }
                        else {
                          array_push($temp_idPegawaiPengikut, $data_pegawai_pengikut->idPegawaiPengikut);
                        }
                      }

                    }
                    break;
                  }
                };
                ?> 

              </td>
              <td> Rp <?php echo $total_anggaran; ?>,-</td>
<!--               <td> 
                <button type="button" class="btn btn-group">Belum</button>
              </td>
              <td>
                <div class="btn-group">
                  <?php 

                  if ($data_surat_perintah_perjalanan_dinas->status_cetak_anggaran=="sudah") {
                    ?>
                    <button type="button" class="btn btn-success"> <?php echo $data_surat_perintah_perjalanan_dinas->status_cetak_anggaran;?> </button>
                    <?php
                  }
                  else{
                    ?>
                    <button type="button" class="btn btn"> <?php echo $data_surat_perintah_perjalanan_dinas->status_cetak_anggaran;?></button> 
                    <?php
                  }

                  ?>
                </button>
              </div> &nbsp;&nbsp;
            </td> -->
            <td> 
              <div class="btn-group">
                <a href="#">
                  <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View </button>
                </a>
              </div> &nbsp;&nbsp;
              <div class="btn-group">
                <a href="#modalEditData<?php echo $data_surat_perintah_perjalanan_dinas->idSPPD?>" data-toggle="modal" class="btn btn-warning btn-sm">
                  <i class="fa fa-edit"></i> Edit
                </a>
              </div>&nbsp;&nbsp;
              <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete </button> 
              </div>&nbsp;&nbsp;
            </td>
          </tr>
          <?php 
          $no++;
          $temp_idPerjalananDinas='';
        } ?>
      </tbody>
    </table>

    <?php
    foreach ($surat_perintah_perjalanan_dinas as $data_surat_perintah_perjalanan_dinas) {
      ?>
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditData<?php echo $data_surat_perintah_perjalanan_dinas->idSPPD?>" class="modal fade">
        <div class="modal-dialog" style="width: 60%">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Edit Data Surat Perintah Perjalanan Dinas</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form" method="post" action="<?=base_url('surat_perintah_perjalanan_dinas/updateDataSuratPerintahPerjalananDinas/'.$data_surat_perintah_perjalanan_dinas->idSPPD)?>">

                <div class="form-group">
                  <label class="col-lg-3 col-sm-3 control-label">Nama Pegawai Tugas</label>

                  <div class="col-lg-12">
                    <select name="pegawai_tugas[]" id="pegawai_tugas" class="form-control select2 select2-hidden-accessible" multiple="" disabled data-placeholder="" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <?php
                      foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                        if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                          echo "<option selected> $data_perjalanan_dinas->nama_pegawai</option>";
                          foreach($pegawai_pengikut as $data_pegawai_pengikut){
                            if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                              echo "<option selected> $data_pegawai_pengikut->nama_pegawai</option>";
                            }
                          }
                          break;
                        }
                      };
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label">Nomor SPPD </label>
                  <div class="col-lg-12">
                    <input type="text" name="nomor_sppd" id="nomor_sppd" class="form-control" placeholder="Nomor SPPD" disabled value="<?php echo $data_surat_perintah_perjalanan_dinas->nomor_sppd?>" required>
                  </div>
                </div>
                <h4 class="modal-title" style="text-align: center;"><br>Detail Anggaran Pegawai Petugas</h4>
                <?php
                foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                  if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                    $temp_idPerjalananDinas=$data_surat_perintah_perjalanan_dinas->idPerjalananDinas;
                    $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
                    ?>
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                      <label class="col-lg-12 col-sm-12">
                        <?php
                        echo " $data_perjalanan_dinas->nama_pegawai";
                        ?>
                      </label>
                      <div class="form-group">
                        <div class="col-lg-6 col-sm-6">
                          <label>Biaya Harian</label>
                          <!-- <input type="text" name="idBiayaHarian" id="idBiayaHarian" class="form-control" placeholder="biaya Harian" value="<?php ?>" required> -->
                          <select name="idBiayaHarian" id="idBiayaHarian" class="form-control" required>
                            <option disabled=""> -- Pilih Biaya Harian --</option>
                            <?php 
                            if ($data_perjalanan_dinas->nominal_biaya_harian == NULL ) {
                             echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                           }
                           else {
                             echo "<option value=NULL>Null</option><br>";
                             echo "<option selected value='$data_perjalanan_dinas->idBiayaHarian'>$data_perjalanan_dinas->nominal_biaya_harian</option><br>";
                           }
                           ?>
                         </select>
                       </div>
                       <div class="col-lg-6 col-sm-6">
                        <label>Biaya Penginapan</label>
                        <select name="idBiayaPenginapan" id="idBiayaPenginapan" class="form-control" required>
                          <option disabled=""> -- Pilih Biaya Penginapan --</option>
                          <?php 
                          if ($data_perjalanan_dinas->nominal_biaya_penginapan == NULL ) {
                           echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                         }
                         else {
                           echo "<option value=NULL>Null</option><br>";
                           echo "<option selected value='$data_perjalanan_dinas->idBiayaPenginapan'>$data_perjalanan_dinas->nominal_biaya_penginapan</option><br>";
                         }
                         ?>
                       </select>
                     </div>
                   </div>
                   <div class="form-group">
                    <div class="col-lg-6 col-sm-6">
                      <label>Biaya Transportasi  Mobil </label>

                      <select name="idBiayaTransportasi Mobil" id="idBiayaTransportasi Mobil" class="form-control" required>
                        <option disabled=""> -- Pilih Biaya Transportasi  Mobil --</option>
                        <?php 
                        if ($data_perjalanan_dinas->nominal_biaya_mobil == NULL ) {
                         echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                       }
                       else {
                         echo "<option value=NULL>Null</option><br>";
                         echo "<option selected value='$data_perjalanan_dinas->idBiayaTransportasi Mobil'>$data_perjalanan_dinas->nominal_biaya_mobil</option><br>";
                       }
                       ?>
                     </select>

                   </div>
                   <div class="col-lg-6 col-sm-6">
                    <label>Biaya Transportasi  Bukan Mobil </label>

                    <select name="idTransportasi Lain" id="idTransportasi Lain" class="form-control" required>
                      <option disabled=""> -- Pilih Transportasi  Bukan Mobil --</option>
                      <?php 
                      if ($data_perjalanan_dinas->kelas_transportasi == NULL ) {
                       echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                     }
                     else {
                       echo "<option value=NULL>Null</option><br>";
                       echo "<option selected value='$data_perjalanan_dinas->idTransportasi Lain'>$data_perjalanan_dinas->kelas_transportasi</option><br>";
                     }
                     ?>
                   </select>

                 </div>
               </div>
               <div class="form-group">
                <div class="col-lg-12 col-sm-12">
                 <label>Biaya Tambahan Lain </label>

                 <select name="idBiayaTambah" id="idBiayaTambah" class="form-control" required>
                  <option disabled=""> -- Pilih Biaya Tambahan Lain --</option>
                  <?php 
                  if ($data_perjalanan_dinas->nominal_biaya_tambahan == NULL ) {
                   echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                 }
                 else {
                   echo "<option value=NULL>Null</option><br>";
                   echo "<option selected value='$data_perjalanan_dinas->idBiayaTambah'>$data_perjalanan_dinas->keperluan( $data_perjalanan_dinas->nominal_biaya_tambahan)</option><br>";
                 }
                 ?>
               </select>

             </div>
           </div>
         </div>
         <?php
         foreach($pegawai_pengikut as $data_pegawai_pengikut){
          if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
            ?>
            <div class="modal-header">
            </div>
            <div class="modal-body">
              <label class="col-lg-12 col-sm-12">
                <?php
                         // echo " $data_perjalanan_dinas->nama_pegawai";
                echo "$data_pegawai_pengikut->nama_pegawai";
                ?>
              </label>
              <div class="form-group">

                <div class="col-lg-6 col-sm-6">
                  <label>Biaya Harian</label>
                  <select name="idBiayaHarian" id="idBiayaHarian" class="form-control" required>
                    <option disabled=""> -- Pilih Biaya Harian --</option>
                    <?php 
                    if ($data_pegawai_pengikut->nominal_biaya_harian == NULL ) {
                     echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                   }
                   else {
                     echo "<option value=NULL>Null</option><br>";
                     echo "<option selected value='$data_pegawai_pengikut->idBiayaHarian'>$data_pegawai_pengikut->nominal_biaya_harian</option><br>";
                   }
                   ?>
                 </select>
               </div>

               <div class="col-lg-6 col-sm-6">
                <label>Biaya Penginapan</label>
                <select name="idBiayaPenginapan" id="idBiayaPenginapan" class="form-control" required>
                  <option disabled=""> -- Pilih Biaya Penginapan --</option>
                  <?php 
                  if ($data_pegawai_pengikut->nominal_biaya_penginapan == NULL ) {
                   echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
                 }
                 else {
                   echo "<option value=NULL>Null</option><br>";
                   echo "<option selected value='$data_pegawai_pengikut->idBiayaPenginapan'>$data_pegawai_pengikut->nominal_biaya_penginapan</option><br>";
                 }
                 ?>
               </select>
             </div>
           </div>

           <div class="form-group">
            <div class="col-lg-6 col-sm-6">
              <label>Biaya Transportasi  Mobil </label>
              <select name="idBiayaTransportasi Mobil" id="idBiayaTransportasi Mobil" class="form-control" required>
                <option disabled=""> -- Pilih Biaya Transportasi  Mobil --</option>
                <?php 
                if ($data_pegawai_pengikut->nominal_biaya_mobil == NULL ) {
                 echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
               }
               else {
                 echo "<option value=NULL>Null</option><br>";
                 echo "<option selected value='$data_pegawai_pengikut->idBiayaTransportasi Mobil'>$data_pegawai_pengikut->nominal_biaya_mobil</option><br>";
               }
               ?>
             </select>
           </div>
           <div class="col-lg-6 col-sm-6">
            <label>Biaya Transportasi  Bukan Mobil </label>
            <select name="idTransportasi Lain" id="idTransportasi Lain" class="form-control" required>
              <option disabled=""> -- Pilih Transportasi  Bukan Mobil --</option>
              <?php 
              if ($data_pegawai_pengikut->kelas_transportasi == NULL ) {
               echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
             }
             else {
               echo "<option value=NULL>Null</option><br>";
               echo "<option selected value='$data_pegawai_pengikut->idTransportasi Lain'>$data_pegawai_pengikut->kelas_transportasi</option><br>";
             }
             ?>
           </select>
         </div>
       </div>

       <div class="form-group">
        <div class="col-lg-12 col-sm-12">
         <label>Biaya Tambahan Lain </label>
         <select name="idBiayaTambah" id="idBiayaTambah" class="form-control" required>
          <option disabled=""> -- Pilih Biaya Tambahan Lain --</option>
          <?php 
          if ($data_pegawai_pengikut->nominal_biaya_tambahan == NULL ) {
           echo "<option selected value=NULL>Null</option><br>";
                             //$total_anggaran+=0;
         }
         else {
           echo "<option value=NULL>Null</option><br>";
           echo "<option selected value='$data_pegawai_pengikut->idBiayaTambah'>$data_pegawai_pengikut->keperluan( $data_pegawai_pengikut->nominal_biaya_tambahan)</option><br>";
         }
         ?>
       </select>
     </div>
   </div>
 </div>
 <?php

}
}
break;
}
};
?>



<!-- <div class="form-group">
  <label class="col-lg-2 col-sm-2 control-label"> Status Cetak</label>
  <div class="col-lg-10 col-sm-10">
    <?php 
    if ($data_surat_perintah_perjalanan_dinas->status_cetak=="belum") {
      ?>
      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="status_cetak" value="sudah">
        <label class="custom-control-label">Sudah</label>
      </div>

      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="defaultGroupExample2" checked name="status_cetak" value="belum">
        <label class="custom-control-label">Belum</label>
      </div>
      <?php
    } else {
      ?>
      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="status_cetak" checked value="sudah">
        <label class="custom-control-label">Sudah</label>
      </div>

      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="status_cetak" value="belum">
        <label class="custom-control-label">Belum</label>
      </div>
      <?php
    }
    ?>
  </div>
</div> -->
<div class="form-group">
  <div style="padding-left: 60%" class="col-lg-offset-3 col-lg-9">
    <button type="submit" class="btn btn-primary" name="edit" value="edit">Update</button>
  </div>
</div>
</form>

</div>
</div>
</div>
</div>
<?php
}
?>

</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>

</section>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- dashboard hightlight information SPPD -->


<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="pull-right hidden-xs">  
  </div>
  <strong>Copyright &copy; Kuliah Magang Mahasiswa S1 Informatika UNS  KOMINFO Kebumen 2019</strong>
</footer>
</div>
<!-- Control Sidebar -->

<!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->


    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/')?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/')?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/')?>dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/')?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <!-- Select2 -->
    <script src="<?php echo base_url('assets/')?>bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url('assets/')?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url('assets/')?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('assets/')?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url('assets/')?>bower_components/chart.js/Chart.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url('assets/')?>dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/')?>dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url('assets/')?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/')?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script >
      $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

<script>
  $(function (){
    $('#exampler').DataTable()
  });
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>

<script>

  var url = window.location;
// Will only work if string in href matches with location
$('.treeview-menu a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('.treeview-menu a').filter(function() {
  return this.href == url;
}).parent().addClass('active');
</script>
</body>
</html>
