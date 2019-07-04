<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("_partials/head.php") ?>
  <meta name=”viewport” content=”width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no”>
  <title></title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <?php $this->load->view("_partials/header.php") ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <?php $this->load->view("_partials/sidebar.php") ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style=" background-image: url('<?php echo base_url('assets')?>/dist/img/regal.png');
    background-repeat: repeat;" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perjalanan Dinas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Perjalanan Dinas</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <div class="panel-body">
            <a href="#modalTambahData" data-toggle="modal" class="btn btn-primary">
              <i class="fa fa-plus"></i> Tambah Data Perjalanan Dinas
            </a>
            <?php
            if ($this->session->flashdata('message')) {
              ?>
              <div class="alert alert-success clearfix">
                <div class="noti-info">
                  <a href="#"><?=$this->session->flashdata('message')?></a>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
          <?php //echo validation_errors(); ?>
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="modalTambahData" class="modal fade" >
            <div class="modal-dialog" style="width: 60%">
              <div class="box box-primary">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Tambah Data Perjalanan Dinas</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('perjalanan_dinas/addDataPerjalananDinas'); ?>">
                      <div class="form-group">
                        <div class="col-lg-12">
                         <label >Pegawai yang ditugaskan</label> 
                         <select name="pegawai_tugas" id="pegawai_tugas" class="form-control select2 select2-hidden-accessible"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                           <option disabled=""> PILIH PEGAWAI YANG DITUGASKAN</option>
                           <?php 


                           foreach ($pegawai as $data_pegawai) {
                            ?>
                            <option value="<?php echo $data_pegawai->NIP ?>"> <?php echo $data_pegawai->nama_pegawai ?></option>
                            <?php 
                          }
                          ?>
                        </select>

                      </div>
                    </div>

                    <div class="form-group">

                      <div class="col-lg-12">
                        <label>Pegawai pengikut yang ditugaskan</label>
                        <select name="pegawai_pengikut[]" id="pegawai_pengikut" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="pilih pegawai pengikut" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option disabled="">-- PILIH PEGAWAI PENGIKUT --</option>
                          <?php 

                          foreach ($pegawai as $data_pegawai) {
                            ?>
                            <option value="<?php echo $data_pegawai->NIP ?>"> <?php echo $data_pegawai->nama_pegawai ?></option>
                            <?php 
                          }
                          ?>
                          <!-- masih bisa menerima data yang sama, pegawai tugas dan pegawai pengikut. -->
                          <!-- fixed by form validation -->

                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-lg-12 col-sm-12">
                        <div class="col-lg-6">
                          <label> Kegiatan Perjalanan </label>
                          <input type="text" name="kegiatan_perjalanan" id="kegiatan_perjalanan" class="form-control" placeholder="Kegiatan perjalanan" >
                        </div>
                        <div class="col-lg-6">
                          <label> Jenis Kegiatan </label>
                          <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" placeholder="Jenis Kegiatan" >
                            <option disabled>---Pilih Jenis Kegiatan---</option>
                            <option value="dinas">Dinas</option>
                            <option value="audit">Audit</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                     <div class="col-lg-12">
                      <label> Jarak Perjalanan </label>
                      <input type="number" min="0"  name="jarak_perjalanan" id="jarak_perjalanan" class="form-control" placeholder="jarak_perjalanan" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-12 col-sm-12">
                     <label> Lokasi tujuan : </label>
                   </div>

                   <div class="col-lg-12">

                     <div class="col-lg-3 col-sm-3"> 
                      <label>Provinsi</label>
                      <select name="idProvinsi" id="idProvinsi" class="form-control  select2 select2-hidden-accessible" onchange="" style="width: 100%;" tabindex="-1" aria-hidden="true"  >
                        <option>-- Pilih Provinsi --</option>
                        <?php 

                        foreach ($provinsi as $data_provinsi) {
                          ?>
                          <option value="<?php echo $data_provinsi->idProvinsi?>"> <?php echo $data_provinsi->nama_provinsi ?></option>
                          <?php 
                        }
                        ?>

                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                      <label>Kabupaten</label>
                      <select name="idKabupaten" id="idKabupaten" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >

                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                      <label>Kecamatan</label>
                      <select name="idKecamatan" id="idKecamatan" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >

                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                      <label>Kelurahan</label>
                      <select name="idKelurahan" id="idKelurahan" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >

                      </select>
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-12">
                    <label> Alamat lokasi </label>
                    <input type="text" name="alamat_lokasi" id="alamat_lokasi" class="form-control" placeholder="Alamat lokasi" >
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-6 col-sm-6">
                    <label> Tanggal berangkat </label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control pull-right" id="tanggal_berangkat" name="tanggal_berangkat" placeholder="yyyy-mm-dd">
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                    <label> Tanggal kembali </label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control pull-right" id="tanggal_kembali" name="tanggal_kembali" placeholder="yyyy-mm-dd">
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <label> Lama Perjalanan </label>
                    <input type="number" min="0"  name="lama_perjalanan" disabled id="lama_perjalanan" class="form-control" placeholder="Lama Perjalanan" >
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-12">
                    <label> Transportasi </label>
                    <select name="idTransportasi" id="idTransportasi" class="form-control" >
                      <option disabled="">-- PILIH TRANSPORTASI --</option>
                      <?php 
                      foreach ($transportasi as $data_transportasi) {
                        ?>
                        <option value="<?php echo $data_transportasi->idTransportasi ?>"> <?php echo $data_transportasi->nama_transportasi ?></option>
                        <?php 
                      }
                      ?>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12">
                    <label> Pejabat Penanda Tangan </label>
                    <select name="idPejabatPenandaTangan" id="idPejabatPenandaTangan" class="form-control" >
                     <option disabled="">-- PILIH PEJABAT PENANDA TANGAN --</option>
                     <?php 

                     foreach ($pejabat_penanda_tangan as $data_pejabat_penanda_tangan) {
                      ?>
                      <option value="<?php echo $data_pejabat_penanda_tangan->idPejabatPenandaTangan ?>"> <?php echo $data_pejabat_penanda_tangan->nama_pegawai ?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div id="alert-msg"></div>
              <div class="form-group">
                <div class="col-lg-offset-11 col-lg-offset-11">
                  <button type="submit" id="addButton" class="btn btn-primary" name="tambah" value="tambah">Kirim</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xs-12">
  <div class="box box-solid box-primary">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="exampler" class="table table-bordered table-striped" style="width: 100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pegawai Tugas</th>
            <th>Nama Pegawai Pengikut </th>
            <th>Lokasi Tujuan</th>
            <th>Kegiatan</th>
            <th>Transportasi</th>
            <th>Tanggal</th>
            <th>Lama</th>
            <th>Action</th>   
          </tr>
        </thead>
        <tbody>
         <?php
         $no=1 ;
         foreach($perjalanan_dinas as $data_perjalanan_dinas) {
           ?>
           <tr>
            <td><?php echo $no?></td>
            <td><?php echo $data_perjalanan_dinas->nama_pegawai?></td>
            <td> 
              <?php 
              foreach($pegawai_pengikut as $data_pegawai_pengikut){
                if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                  echo $data_pegawai_pengikut->nama_pegawai . "<br>";
                }

              }
              ?>
            </td>
            <td><?php echo $data_perjalanan_dinas->nama_kelurahan?></td>
            <td><?php echo $data_perjalanan_dinas->kegiatan?></td>
            <td><?php echo $data_perjalanan_dinas->nama_transportasi?></td>
            <td style="text-align: center;"> <?php echo $data_perjalanan_dinas->tanggal_berangkat . "<br> s/d <br>" . $data_perjalanan_dinas->tanggal_kembali ?></td>
            <td> <?php echo $data_perjalanan_dinas->lama_perjalanan?></td>
            <td> 
              <div class="btn-group">
                <a style="color:white" href="#modalViewData<?php echo $data_perjalanan_dinas->idPerjalananDinas?>" data-toggle="modal">
                  <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View </button>
                </a>
              </div> &nbsp;&nbsp;
              <div class="btn-group">
                <a style="color: white" href="#modalEditData<?php echo $data_perjalanan_dinas->idPerjalananDinas?>" data-toggle="modal">
                  <button type="button" class="btn btn-warning btn-sm"><i class="fa  fa-pencil-square"></i> Edit </button> 
                </a>
              </div>&nbsp;&nbsp;
<!--               <div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm" onclick="hapusData('<?php echo $data_perjalanan_dinas->idPerjalananDinas?>')"><i class="fa fa-trash"></i> Delete </button> 
              </div>&nbsp;&nbsp; -->
            </td>
          </div>
        </tr>
        <?php
        $no++;
      }
      ?>
    </tbody>
  </table>

  <!-- Modal Edit -->
  <?php
  foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
    ?>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="modalEditData<?php echo $data_perjalanan_dinas->idPerjalananDinas?>" class="modal fade">
      <div class="modal-dialog" style="width: 60%">
        <div class="box box-primary">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Edit Data Perjalanan Dinas</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal edit" role="form" id="urlEdit<?=$data_perjalanan_dinas->idPerjalananDinas?>" method="post" action="<?=base_url('perjalanan_dinas/updateDataPerjalananDinas/'.$data_perjalanan_dinas->idPerjalananDinas)?>">

                <div class="form-group">

                  <div class="col-lg-12">
                    <label >Pegawai yang ditugaskan</label> 
                    <select name="pegawai_tugas" id="pegawai_tugas<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control select2 select2-hidden-accessible pegawai_tugas"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                     <option disabled=""> PILIH PEGAWAI YANG DITUGASKAN</option>
                     <?php 
                     foreach ($pegawai as $data_pegawai) {
                      if ( $data_pegawai->NIP == $data_perjalanan_dinas->idPegawaiTugas ) {
                        echo "string";
                        echo "<option selected value='$data_pegawai->NIP'> $data_perjalanan_dinas->nama_pegawai </option>";
                        continue;
                      }
                      ?>
                      <option value="<?php echo $data_pegawai->NIP ?>"> <?php echo $data_pegawai->nama_pegawai ?></option>
                      <?php 
                    }
                    ?>
                  </select>
                </div>

                <div class="col-lg-12">
                  <label>Pegawai pengikut yang ditugaskan</label>
                  <select name="pegawai_pengikut[]" id="pegawai_pengikut<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control select2 select2-hidden-accessible pegawai_pengikut" multiple="" data-placeholder="pilih pegawai pengikut" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option disabled="">-- PILIH PEGAWAI PENGIKUT --</option>
                    <?php 
                    foreach ($pegawai as $data_pegawai) {
                      $cek=true;
                      foreach($pegawai_pengikut as $data_pegawai_pengikut){
                        if ($data_pegawai->NIP==$data_pegawai_pengikut->idPegawaiPengikut) {
                          if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                           echo "<option selected value='$data_pegawai_pengikut->idPegawaiPengikut'> $data_pegawai_pengikut->nama_pegawai </option>";
                           $cek=false;
                           break;
                         }
                       }
                     }
                     if ($cek==false) {
                      continue;
                    }
                    ?>
                    <option value="<?=$data_pegawai->NIP ?>"> <?=$data_pegawai->nama_pegawai ?></option>
                    <?php 
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <div class="col-lg-12 col-sm-12">
                  <div class="col-lg-6">
                    <label> Kegiatan Perjalanan </label>
                    <input type="text" name="kegiatan_perjalanan" id="kegiatan_perjalanan<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control kegiatan_perjalanan" placeholder="Kegiatan perjalanan" value="<?php echo $data_perjalanan_dinas->kegiatan?>">
                  </div>
                  <div class="col-lg-6">
                    <label> Jenis Kegiatan </label>
                    <select name="jenis_kegiatan" id="jenis_kegiatan<?=$data_perjalanan_dinas->jenis_kegiatan?>" class="form-control jenis_kegiatan" placeholder="Jenis Kegiatan" >
                     <option disabled>---Pilih Jenis Kegiatan---</option>
                     <?php 
                     if ($data_perjalanan_dinas->jenis_kegiatan=="dinas") {
                      echo "<option selected value='dinas'>Dinas</option>";
                      echo "<option value='audit'>Audit</option>";
                    } else {
                     echo "<option  value='dinas'>Dinas</option>";
                     echo "<option selected value='audit'>Audit</option>";
                   }
                   ?>
                 </select>
               </div>
             </div>
           </div>

           <div class="col-lg-12">
            <label> Jarak Perjalanan </label>
            <input type="number" min="0"  name="jarak_perjalanan" id="jarak_perjalanan<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control jarak_perjalanan" placeholder="jarak_perjalanan" value="<?php echo $data_perjalanan_dinas->jarak_perjalanan  ?>">
          </div>

          <div class="col-lg-12 col-sm-12">
           <label> Lokasi tujuan : </label>
         </div>

         <?php 
         $this->load->model("perjalanan_dinas_model");
         ?>

         <div class="col-lg-12">

           <div class="col-lg-3 col-sm-3"> 
            <label>Provinsi</label>
            <select name="idProvinsi" id="idProvinsi-edit<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control select2 select2-hidden-accessible provinsi" onchange="" style="width: 100%;" tabindex="-1" aria-hidden="true"  >
              <option hidden="">-- Pilih Provinsi --</option>
              <?php 

              foreach ($provinsi as $data_provinsi) {
                if ($data_provinsi->idProvinsi == substr($data_perjalanan_dinas->idLokasi, 0,2)) {  ?>
                 <option value="<?php echo $data_provinsi->idProvinsi?>" selected > <?php echo $data_provinsi->nama_provinsi ?></option>
                 <?php
                 continue;
               }else { ?>
                <option value="<?php echo $data_provinsi->idProvinsi?>"> <?php echo  $data_provinsi->nama_provinsi ?></option>
                <?php
              }

            }
            ?>

          </select>
        </div>
        <div class="col-lg-3 col-sm-3">
          <label>Kabupaten</label>
          <select name="idKabupaten" id="idKabupaten-edit<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control select2 select2-hidden-accessible kabupaten" style="width: 100%;" tabindex="-1" aria-hidden="true" >
            <?php 

            echo "<option disabled>-- Pilih Kabupaten --</option>";
            $data['kabupaten']=$this->perjalanan_dinas_model->getAllKabupaten(substr($data_perjalanan_dinas->idLokasi, 0,2))->result();
            foreach ($data['kabupaten'] as $data_kabupaten ) {
              if ($data_kabupaten->idKabupaten == substr($data_perjalanan_dinas->idLokasi, 0,4 )) {
                $kabupaten=" ";
                $kabupaten="<option class='c-kabupaten' selected value='$data_kabupaten->idKabupaten'> $data_kabupaten->nama_kabupaten </option>";
              }
              else{
                $kabupaten=" ";
                $kabupaten="<option class='c-kabupaten' value='$data_kabupaten->idKabupaten'> $data_kabupaten->nama_kabupaten </option>";
              }
              echo $kabupaten ;

            }
            ?>
          </select>
        </div>
        <div class="col-lg-3 col-sm-3">
          <label>Kecamatan</label>
          <select name="idKecamatan" id="idKecamatan-edit<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control select2 select2-hidden-accessible kecamatan" style="width: 100%;" tabindex="-1" aria-hidden="true" >

           <?php 

           echo "<option disabled>-- Pilih Kecamatan --</option>";
           $data['kecamatan']=$this->perjalanan_dinas_model->getAllKecamatan(substr($data_perjalanan_dinas->idLokasi, 0,4))->result();
           foreach ($data['kecamatan'] as $data_kecamatan ) {
            if ($data_kecamatan->idKecamatan == substr($data_perjalanan_dinas->idLokasi, 0,6 )) {
              $kecamatan=" ";
              $kecamatan="<option class='c-kecamatan' selected value='$data_kecamatan->idKecamatan'> $data_kecamatan->nama_kecamatan </option>";
            }
            else{
              $kecamatan=" ";
              $kecamatan="<option class='c-kecamatan' value='$data_kecamatan->idKecamatan'> $data_kecamatan->nama_kecamatan </option>";
            }
            echo $kecamatan ;

          }
          ?>
        </select>
      </div>
      <div class="col-lg-3 col-sm-3">
        <label>Kelurahan</label>
        <select name="idKelurahan" id="idKelurahan-edit<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control select2 select2-hidden-accessible kelurahan" style="width: 100%;" tabindex="-1" aria-hidden="true" >

         <?php 

         echo "<option disabled>-- Pilih Kelurahan --</option>";
         $data['kelurahan']=$this->perjalanan_dinas_model->getAllKelurahan(substr($data_perjalanan_dinas->idLokasi, 0,6))->result();
         foreach ($data['kelurahan'] as $data_kelurahan ) {
          if ($data_kelurahan->idKelurahan == $data_perjalanan_dinas->idLokasi) {
            $kelurahan=" ";
            $kelurahan="<option class='c-kelurahan' selected value='$data_kelurahan->idKelurahan'> $data_kelurahan->nama_kelurahan </option>";
          }
          else{
            $kelurahan=" ";
            $kelurahan="<option class='c-kelurahan' value='$data_kelurahan->idKelurahan'> $data_kelurahan->nama_kelurahan </option>";
          }
          echo $kelurahan ;

        }
        ?>
      </select>
    </div>
  </div>



  <div class="col-lg-12">
    <label> Alamat lokasi </label>
    <input type="text" name="alamat_lokasi" id="alamat_lokasi<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control alamat_lokasi" placeholder="Alamat lokasi" value="<?= $data_perjalanan_dinas->alamat_spesifik_tujuan?> " >
  </div>



  <div class="col-lg-6 col-sm-6">
    <label> Tanggal berangkat </label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input type="text" class="form-control datepicker tanggal_berangkat" style=" z-index: 1600 !important;" id="tanggal_berangkat<?=$data_perjalanan_dinas->idPerjalananDinas?>" name="tanggal_berangkat" placeholder="yyyy-mm-dd" value="<?= $data_perjalanan_dinas->tanggal_berangkat?>">
    </div>
  </div>

  <div class="col-lg-6 col-sm-6">
    <label> Tanggal kembali </label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input type="text" class="form-control datepicker tanggal_kembali" id="tanggal_kembali<?=$data_perjalanan_dinas->idPerjalananDinas?>" style=" z-index: 1600 !important;" name="tanggal_kembali" placeholder="yyyy-mm-dd" value="<?= $data_perjalanan_dinas->tanggal_kembali?>">
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-lg-12">
    <label> Lama Perjalanan </label>
    <input type="number" min="0"  name="lama_perjalanan" disabled id="lama_perjalanan<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control lama_perjalanan" placeholder="Lama Perjalanan" value="<?= $data_perjalanan_dinas->lama_perjalanan?>" >
  </div>
</div>

<div class="form-group">
  <div class="col-lg-12">
    <label> Transportasi </label>
    <select name="idTransportasi" id="idTransportasi<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control idTransportasi" >
      <option disabled="">-- PILIH TRANSPORTASI --</option>
      <?php 
      foreach ($transportasi as $data_transportasi) {
        if ($data_transportasi->idTransportasi==$data_perjalanan_dinas->idTransportasi) {
          echo "<option selected value='$data_transportasi->idTransportasi'> $data_transportasi->nama_transportasi </option>";
          continue;
        }
        echo "<option value='$data_transportasi->idTransportasi'> $data_transportasi->nama_transportasi </option>";
        ?>
        <?php 
      }
      ?>

    </select>
  </div>
</div>

<div class="form-group">
  <div class="col-lg-12">
    <label> Pejabat Penanda Tangan </label>
    <select name="idPejabatPenandaTangan" id="idPejabatPenandaTangan<?=$data_perjalanan_dinas->idPerjalananDinas?>" class="form-control pejabat_penanda_tangan" >
     <option disabled="">-- PILIH PEJABAT PENANDA TANGAN --</option>
     <?php 

     foreach ($pejabat_penanda_tangan as $data_pejabat_penanda_tangan) {
      $cek=true;
      foreach ($pegawai as $data_pegawai) {
        if ($data_pegawai->NIP==$data_pejabat_penanda_tangan->NIP) {
          if ($data_pejabat_penanda_tangan->idPejabatPenandaTangan==$data_perjalanan_dinas->idPejabatPenandaTangan) {
            echo "<option selected value='$data_pejabat_penanda_tangan->idPejabatPenandaTangan' > $data_pejabat_penanda_tangan->nama_pegawai>";
            $cek=false;
            break;
          }
        }
      }
      if ($cek==FALSE) {
        continue;
      }
      ?>
      <option value="<?php echo $data_pejabat_penanda_tangan->idPejabatPenandaTangan ?>"> <?php echo $data_pejabat_penanda_tangan->nama_pegawai ?></option>
      <?php 
    }

    ?>
  </select>
</div>
</div>

<div class="alert-msg-edit"></div>
<div class="form-group">
  <div class="col-lg-offset-10 col-lg-offset-10">
    <button type="submit"  class="btn btn-primary edit" id="editButton<?= $data_perjalanan_dinas->idPerjalananDinas ?>"  name="edit" value="edit">Update</button> 
    <!-- Belum selesai -->
  </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
<!-- end of modal edit -->


<!-- modal view -->
<?php
foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
  ?>
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalViewData<?php echo $data_perjalanan_dinas->idPerjalananDinas?>" class="modal fade">
    <div class="modal-dialog" style="width: 50%">
      <div class="box box-primary">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">View Data Perjalanan Dinas</h4>
          </div>
          <div class="modal-body">
           <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Pegawai Yang Ditugaskan</label>
                <p><?=$data_perjalanan_dinas->nama_pegawai?></p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Pegawai Pengikut Yang Ditugaskan</label>
                <p>
                  <?php  
                  $nomor=1;
                  foreach($pegawai_pengikut as $data_pegawai_pengikut){
                    if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                      echo $nomor .". " . $data_pegawai_pengikut->nama_pegawai ."&nbsp; &nbsp; &nbsp; ";
                      $nomor++;
                    }

                  }
                  ?>
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Kegiatan Perjalanan</label>
                <p><?=$data_perjalanan_dinas->kegiatan?></p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Lokasi Acara</label>
                <p><?="Kelurahan. "." ".$data_perjalanan_dinas->nama_kelurahan ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label style="font-weight: bold;">Alamat Lokasi</label>
                <p><?=$data_perjalanan_dinas->alamat_spesifik_tujuan ?></p>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Tanggal Berangkat</label>
                <p><?=date_indo($data_perjalanan_dinas->tanggal_berangkat)?></p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Tanggal Berakhir</label>
                <p><?=date_indo($data_perjalanan_dinas->tanggal_kembali)?></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Lama Perjalanan</label>
                <p><?=$data_perjalanan_dinas->lama_perjalanan ?></p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label style="font-weight: bold;">Transportasi</label>
                <p><?=$data_perjalanan_dinas->nama_transportasi ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label style="font-weight: bold;">Pejabat Penanda Tangan</label>
                <p>
                 <?php  
                 foreach($pejabat_penanda_tangan as $data_pejabat_penanda_tangan){
                  if ( $data_pejabat_penanda_tangan->idPejabatPenandaTangan == $data_perjalanan_dinas->idPejabatPenandaTangan){
                    echo $data_pejabat_penanda_tangan->nama_pegawai ;
                  }

                }
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
}
?>
<!-- end of modal view -->
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
   <!-- <script async="" src="//www.google-analytics.com/analytics.js"></script>; -->
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
   <script src="<?php echo base_url('assets/')?>bower_components/sweetalert/js/sweetalert/sweetalert.min.js"></script>
   <script src="<?php echo base_url('assets/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script src="<?php echo base_url('assets/')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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
  $(document).ready(function(){
    $('#exampler').DataTable({
      "scrollX":true,
      "autoWidth":true
    })
  })

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>

<script>

//function insert
$(function(){
  $.ajaxSetup({
    type : "POST",
    url : "<?php echo base_url()?>perjalanan_dinas/getData",
    cache:false,
  }),

  $('#idProvinsi').change(function(){
    var value=$(this).val();

    if (value>0) {
      $.ajax({
        data:{
          modul:'kabupaten',
          idDataLokasi: value
        },
        success: function(respond){
         $('#idKabupaten').html(respond);
         $('#idKecamatan').attr("disabled","");
         $('.c-kecamatan').remove();
         $('#idKelurahan').attr("disabled","");
         $('.c-kelurahan').remove();
             //alert(value);
           //  console.log(respond);
         }

       })
    }

  }),

  $('#idKabupaten').change(function(){
    var value=$(this).val();
     // alert(value);
     if (value>0) {
        //alert("halo");
        $.ajax({
          data:{
            modul:'kecamatan',
            idDataLokasi: value
          },
          success: function(respond){
            $('#idKecamatan').removeAttr("disabled","")
            $('#idKecamatan').html(respond);
            $('#idKelurahan').attr("disabled","");
            $('.c-kelurahan').remove();
             //alert(value);
            //console.log(respond);
          }

        })
      }

    }),

  $('#idKecamatan').change(function(){
    var value=$(this).val();

    if (value>0) {
       // alert(value);
       $.ajax({
        data:{
          modul:'kelurahan',
          idDataLokasi: value
        },
        success: function(respond){
         $('#idKelurahan').removeAttr("disabled","")
         $('#idKelurahan').html(respond);
             //alert(value);
           //  console.log(respond);
         }

       })
     }
     
   })

})
</script>

<script >
  //function edit
  $(function(){
    $.ajaxSetup({
      type : "POST",
      url : "<?php echo base_url()?>perjalanan_dinas/getData",
      cache:false,
    }),

    $('.form-control.select2.select2-hidden-accessible.provinsi').change(function(){
      var value=$(this).val();
      
      if (value>0) {
        $.ajax({
          data:{
            modul:'kabupaten',
            idDataLokasi: value
          },
          success: function(respond){
           $('.form-control.select2.select2-hidden-accessible.kabupaten').html(respond);
           $('.form-control.select2.select2-hidden-accessible.kecamatan').attr("disabled","");
           $('.c-kecamatan').remove();
           $('.form-control.select2.select2-hidden-accessible.kelurahan').attr("disabled","");
           $('.c-kelurahan').remove();
             //alert(value);
           //  console.log(respond);
         }

       })
      }

    }),

    $('.form-control.select2.select2-hidden-accessible.kabupaten').change(function(){
      var value=$(this).val();
     // alert(value);
     if (value>0) {
        //alert("halo");
        $.ajax({
          data:{
            modul:'kecamatan',
            idDataLokasi: value
          },
          success: function(respond){
            $('.form-control.select2.select2-hidden-accessible.kecamatan').removeAttr("disabled","")
            $('.form-control.select2.select2-hidden-accessible.kecamatan').html(respond);
            $('.form-control.select2.select2-hidden-accessible.kelurahan').attr("disabled","");
            $('.c-kelurahan').remove();
             //alert(value);
            //console.log(respond);
          }

        })
      }

    }),

    $('.form-control.select2.select2-hidden-accessible.kecamatan').change(function(){
      var value=$(this).val();
      
      if (value>0) {
       // alert(value);
       $.ajax({
        data:{
          modul:'kelurahan',
          idDataLokasi: value
        },
        success: function(respond){
         $('.form-control.select2.select2-hidden-accessible.kelurahan').removeAttr("disabled","")
         $('.form-control.select2.select2-hidden-accessible.kelurahan').html(respond);
             //alert(value);
           //  console.log(respond);
         }

       })
     }
     
   })

  })
</script>

<script>
 function hapusData(id) {
   // alert(id);
   $.ajax({
    url     : "<?php echo base_url()?>perjalanan_dinas/ajaxDataPerjalananDinas",
    method  : "post",
    data    : {id:id},
    success : function(nama_kegiatan) {
      swal({
        title               : "Apakah Anda Yakin?",
        text                : 'Anda Ingin Menghapus perjalanan dinas "'+nama_kegiatan+'"?',
        type                : "warning",
        showCancelButton    : true,
        confirmButtonColor  : "#DD6B55",
        confirmButtonText   : "Ya",
        cancelButtonText    : "Tidak",
        closeOnConfirm      : false,
        closeOnCancel       : true
      },
      function (isConfirm) {
        if (isConfirm) {
          swal({
            title             : "Dihapus!",
            text              : "Data Sukses Dihapus.",
            timer             : 1500,
            type              : "success",
            showConfirmButton : false
          }, function () {
            window.location.href = "<?php echo base_url()?>perjalanan_dinas/removeDataPerjalananDinas/"+id;
          });
        }
      });
    }
  });
 }
</script>


</body>
</html>


<script type="text/javascript">
  $('#addButton').click(function() {
   var form_data = {
    pegawai_tugas:$('#pegawai_tugas').val(),
    pegawai_pengikut:$('#pegawai_pengikut').val(),
    kegiatan_perjalanan:$('#kegiatan_perjalanan').val(),
    jenis_kegiatan:$('#jenis_kegiatan').val(),
    jarak_perjalanan:$('#jarak_perjalanan').val(),
    idProvinsi:$('#idProvinsi').val(),
    idKabupaten:$('#idKabupaten').val(),
    idKecamatan:$('#idKecamatan').val(),
    idKelurahan:$('#idKelurahan').val(),
    alamat_lokasi:$('#alamat_lokasi').val(),
    tanggal_berangkat:$('#tanggal_berangkat').val(),
    tanggal_kembali:$('#tanggal_kembali').val(),
    lama_perjalanan:$('#lama_perjalanan').val(),
    idTransportasi:$('#idTransportasi').val(),
    idPejabatPenandaTangan:$('#idPejabatPenandaTangan').val(),
  };
  console.log(form_data);
  $.ajax({
    url: "<?php echo base_url('perjalanan_dinas/addDataPerjalananDinas'); ?>",
    type: 'POST',
    data: form_data,
    dataType: "JSON",
    success: function(message) {
      if (message.status == 1){
        $('#alert-msg').html('<div class="alert alert-success">' + message.message + '</div>');
        location.reload();
      }
      else if (message.status == 0){
        $('#alert-msg').html('<div class="alert alert-danger">' + message.message + '</div>');
      }
      else{
       location.reload();
     }
   }
 });
  return false;
});
</script>

<!-- Edit Modal -->
<script type="text/javascript">

  var editButton = document.getElementsByClassName("btn btn-primary edit");

  $('.btn.btn-primary.edit').each(function(index) {

    $(this).on("click", function(){
      //alert("message?: DOMString");
      var cek = document.getElementsByClassName("btn btn-primary edit");
      console.log(cek);
          // console.log(cek);
          var pegawai_tugas_edit = document.getElementsByClassName("form-control select2 select2-hidden-accessible pegawai_tugas")[index].id;
          var pegawai_pengikut_edit = document.getElementsByClassName("form-control select2 select2-hidden-accessible pegawai_pengikut")[index].id;
          var kegiatan_perjalanan_edit = document.getElementsByClassName("form-control kegiatan_perjalanan")[index].id;
          var jenis_kegiatan_edit = document.getElementsByClassName("form-control jenis_kegiatan")[index].id;
          var jarak_perjalanan_edit = document.getElementsByClassName("form-control jarak_perjalanan")[index].id;
          var idProvinsi_edit = document.getElementsByClassName("form-control select2 select2-hidden-accessible provinsi")[index].id;
          var idKabupaten_edit = document.getElementsByClassName("form-control select2 select2-hidden-accessible kabupaten")[index].id;
          var idKecamatan_edit = document.getElementsByClassName("form-control select2 select2-hidden-accessible kecamatan")[index].id;
          var idKelurahan_edit = document.getElementsByClassName("form-control select2 select2-hidden-accessible kelurahan")[index].id;
          var alamat_lokasi_edit = document.getElementsByClassName("form-control alamat_lokasi")[index].id;
          var tanggal_berangkat_edit = document.getElementsByClassName("form-control tanggal_berangkat")[index].id;
          var tanggal_kembali_edit = document.getElementsByClassName("form-control tanggal_kembali")[index].id;
          var lama_perjalanan_edit = document.getElementsByClassName("form-control lama_perjalanan")[index].id;
          var transportasi_edit = document.getElementsByClassName("form-control idTransportasi")[index].id;
          var idPejabatPenandaTangan_edit = document.getElementsByClassName("form-control pejabat_penanda_tangan")[index].id;

          var b = document.getElementsByClassName("form-horizontal edit")[index].id;
          var url_edit = document.getElementById(b).action;
/*          console.log(url_edit);
console.log(nama_pegawai_edit);*/
var form_data = {
  pegawai_tugas: $('#'+pegawai_tugas_edit).val(),
  pegawai_pengikut: $('#'+pegawai_pengikut_edit).val(),
  kegiatan_perjalanan: $('#'+kegiatan_perjalanan_edit).val(),
  jenis_kegiatan: $('#'+jenis_kegiatan_edit).val(),
  jarak_perjalanan: $('#'+jarak_perjalanan_edit).val(),
  idProvinsi: $('#'+idProvinsi_edit).val(),
  idKabupaten: $('#'+idKabupaten_edit).val(),
  idKecamatan: $('#'+idKecamatan_edit).val(),
  idKelurahan: $('#'+idKelurahan_edit).val(),
  alamat_lokasi: $('#'+alamat_lokasi_edit).val(),
  tanggal_berangkat: $('#'+tanggal_berangkat_edit).val(),
  tanggal_kembali: $('#'+tanggal_kembali_edit).val(),
  lama_perjalanan: $('#'+lama_perjalanan_edit).val(),
  idTransportasi: $('#'+transportasi_edit).val(),
  idPejabatPenandaTangan: $('#'+idPejabatPenandaTangan_edit).val()
};
console.log(form_data);
$.ajax({
  url: url_edit,
  type: 'POST',
  data: form_data,
  dataType: "JSON",
  success: function(message) {
    if (message.status == 1){
     $('.alert-msg-edit').html('<div class="alert alert-success">' + message.message + '</div>');
     location.reload();
   }
   else{
    $('.alert-msg-edit').html('<div class="alert alert-danger">' + message.message + '</div>');
  }
}
});
return false;

});
  });
  $('.modal.fade.edit').on('hidden.bs.modal', function () {
    $('input[name=checkListItem').val('');
    $( ".alert.alert-danger" ).remove();
  })
</script>

<script>
  $('#tanggal_berangkat').change(function() {
   // document.getElementById('tanggal_berangkat').value = $(this).val();
   getLamaPerjalanan();
 });
  $('#tanggal_kembali').change(function() {
   // document.getElementById('tanggal_kembali').value = $(this).val();
   getLamaPerjalanan();
 });

  function getLamaPerjalanan() {

    var tanggal_berangkat=new Date(document.getElementById('tanggal_berangkat').value);
    var tanggal_kembali=new Date(document.getElementById('tanggal_kembali').value);
         // time difference
         var time_difference = Math.abs(tanggal_kembali.getTime() - tanggal_berangkat.getTime());

         // days difference
         var days_difference = Math.ceil(time_difference / (1000 * 3600 * 24));

         if (days_difference==0) {
          days_difference++;
        }

         // difference
         document.getElementById('lama_perjalanan').value=days_difference;
       }
     </script>