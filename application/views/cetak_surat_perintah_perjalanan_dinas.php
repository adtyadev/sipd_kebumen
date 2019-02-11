
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Perjalanan Dinas</title>

  <link rel="stylesheet" href="<?php echo base_url('assets')?>/bower_components/surat_sipd/css/surat_sipd.css">

  <script type="text/javascript">
   //   window.print();
 </script>
</head>

<body style="font-size: 15px" >
  <?php
  $no=1;
  $temp_idPerjalananDinas='';
  $temp_idPegawaiTugas='';


  ?>
  <page size="A4">
    <div class="padding-10mm">
      <table class="align-center" border="0px" width="100%">
        <td width="20%">
         <img style="max-width:50%;height:auto;" src="<?php echo base_url('assets')?>/bower_components/surat_sipd/img/logoKebumen.jpg"> 
       </td>
       <td>
        <table class="align-center" border="0" width="100%">
          <tr>
            <td class="bold f20">PEMERINTAH KABUPATEN KEBUMEN</td>
          </tr>
          <tr>
            <td class="bold f16">DINAS KOMUNIKASI DAN INFORMATIKA</td>
          </tr>
          <tr>
            <td class="">Jl. Kutorjo No. ?? Telp (0287) 383349 <br> 
              <span style="font-weight: bold;"> K E B U M E N - 54511 </span>
              <br>
            </td>
          </tr>
        </table>
      </td>

    </table>
    <div class="garis5p"></div>
    <div class="garis1p"></div>
    <br>
    <div class="content">

      <table class="align-center" width="100%" border="0">
        <tr> 
          <td style="font-weight: bold; text-decoration: underline; font-size: 18px">
            SURAT PERINTAH PERJALANAN DINAS
          </td>
        </tr>
        <tr>
          <td>
           <?php 
           foreach ($surat_perintah_perjalanan_dinas as $data_surat_perintah_perjalanan_dinas) {
            if ($data_surat_perintah_perjalanan_dinas->idSPPD==$idSPPD) {
              echo "Nomor : ".$data_surat_perintah_perjalanan_dinas->nomor_sppd;
              ?>

            </td>
          </tr>
        </table>
        <br>
      </div>

      <!-- isi -->
      <div class="content">
        <table class="mainTable" width="100%" >
         <tr>
           <td width="2%"> 1. </td>
           <td colspan="2" width="40%"> Pejabat yang memberi perintah </td>
           <td width="1%">:</td>
           <td colspan="3" style="text-transform: uppercase;"> 
            <?php
            foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
              if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                $temp_NIP_pejabat_penanda_tangan=$data_perjalanan_dinas->NIP;
                echo $data_perjalanan_dinas->keterangan_jabatan . '<br>';
                ?>
              </td>
            </tr>
            <tr>
             <td width="2%"> 2. </td>
             <td colspan="2" width="40%"> Nama pegawai yang diperintahkan </td>
             <td width="1%">:</td>
             <td colspan="3">
              <?php
              $temp_idPerjalananDinas=$data_surat_perintah_perjalanan_dinas->idPerjalananDinas;
              $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
              echo $data_perjalanan_dinas->nama_pegawai . '<br>';
              ?>

            </td>
          </tr>
          <tr>
           <td rowspan="3" width="2%"> 3. </td>
           <td width="1%">a.</td>
           <td width="40%"> Pangkat dan golongan menurut PP No. 6 Th. 1997 </td>
           <td width="1%">:</td>
           <td colspan="3">
            <?php
            foreach ($pegawai as $data_pegawai) {
              if ($data_pegawai->NIP == $temp_idPegawaiTugas) {
                echo $data_pegawai->nama_pangkat."/".$data_pegawai->nama_golongan . '<br>';
                 //echo count($temp_idPegawaiPengikut);
                ?>
              </td>
            </tr>
            <tr>
             <td width="1%">b.</td>
             <td width="40%"> Jabatan </td>
             <td width="1%">:</td>
             <td colspan="3">< Kasi Infrastek > pada < Bidang PDE ></td>
           </tr>
           <tr>
             <td width="1%">c.</td>
             <td width="40%"> Tingkat menurut perjalanan </td>
             <td width="1%">:</td>
             <td colspan="3">
              <?php
              echo $data_pegawai->nama_golongan . '<br>';
              break;
            }

          }
          ?>
        </td>
      </tr>
      <tr>
       <td width="2%">4.</td>
       <td colspan="2" width="40%"> Maksud perjalanan dinas </td>
       <td width="1%">:</td>
       <td colspan="3">
        <?php
        echo "1. &nbsp;" .$data_perjalanan_dinas->kegiatan . '<br>';
        ?>
      </td>
    </tr>
    <tr>
     <td width="2%">5.</td>
     <td colspan="2" width="40%"> Alat angkut yang dipergunakan </td>
     <td width="1%">:</td>
     <td colspan="3" style="text-transform: capitalize;">        
      <?php
      echo $data_perjalanan_dinas->keterangan;
      ?>
    </td>
  </tr>
  <tr>
   <td rowspan="2" width="2%">6.</td>
   <td width="1%">a.</td>
   <td width="40%"> Tempat berangkat </td>
   <td width="1%">:</td>
   <td colspan="3">Kebumen</td>
 </tr>
 <tr>
   <td width="1%">b.</td>
   <td width="40%"> Tempat tujuan </td>
   <td width="1%">:</td>
   <td colspan="3">
    <?php
    echo $data_perjalanan_dinas->nama_kelurahan;
    ?>
  </td>
</tr>
<tr>
 <td rowspan="3" width="2%">7. </td>
 <td width="1%">a.</td>
 <td width="40%"> Lamanya perjalanan dinas </td>
 <td width="1%">:</td>
 <td colspan="3">
  <?php
  echo $data_perjalanan_dinas->lama_perjalanan . " hari";
  ?>
</td>
</tr>
<tr>
 <td width="1%">b.</td>
 <td width="40%"> Tanggal berangkat </td>
 <td width="1%">:</td>
 <td colspan="3">
  <?php
  echo date_indo($data_perjalanan_dinas->tanggal_berangkat);
  ?>
</td>
</tr>
<tr>
 <td width="1%">c.</td>
 <td width="40%"> Tanggal harus kembali </td>
 <td width="1%">:</td>
 <td colspan="3">
  <?php
  echo date_indo($data_perjalanan_dinas->tanggal_kembali);

  foreach($pegawai_pengikut as $data_pegawai_pengikut){
    if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
    // echo $data_pegawai_pengikut->nama_pegawai . "<br>";
     if (!isset($temp_idPegawaiPengikut)) {
      $temp_idPegawaiPengikut[0]=$data_pegawai_pengikut->idPegawaiPengikut;
    }
    else {
      array_push($temp_idPegawaiPengikut, $data_pegawai_pengikut->idPegawaiPengikut);
    }
  }
}
//echo count($temp_idPegawaiPengikut);
?>
</td>
</tr>
<!--  -->
<?php
$count=0;
for ($i=0; $i < count($temp_idPegawaiPengikut); $i++) { 
  foreach ($pegawai as $data_pegawai) {
    if ($data_pegawai->NIP == $temp_idPegawaiPengikut[$count]) {
      if ($count==0) {
        ?>
        <tr>
         <td width="2%" rowspan="<?=count($temp_idPegawaiPengikut);?>">8. </td>
         <td colspan="2" width="40%" rowspan="<?=count($temp_idPegawaiPengikut);?>"> Pengikut </td>
         <td width="1%">:</td>
         <td width="2%">
          <?= $count+1 . "."; ?>
        </td>
        <td width="20%">
          <?php
          echo $data_pegawai->nama_pegawai;
          ?>
        </td>
        <td width="15%">
          <?php
          echo "Golongan " . $data_pegawai->nama_golongan;
          break;
          ?>
        </td>
      </tr>
      <?php
    }
    else{
      ?>
      <tr>
       <td width="1%">:</td>
       <td width="2%">
        <?= $count+1 . "."; ?>
      </td>
      <td width="20%">
        <?php
        echo $data_pegawai->nama_pegawai;
        ?>
      </td>
      <td width="15%">
        <?php
        echo "Golongan " . $data_pegawai->nama_golongan;
        break;
        ?>
      </td>
    </tr>
    <?php
  }
}
}
$count++;
}
?>
<tr>
 <td width="2%" >9. </td>
 <td colspan="2" width="40%"> Pembebanan anggaran </td>
 <td width="1%">:</td>
 <td colspan="3"><b></td>
 </tr>
 <tr>
  <td rowspan="2" width="2%" >10. </td>
  <td width="1%">a.</td>
  <td width="40%"> Instansi </td>
  <td width="1%">:</td>
  <td colspan="7">
    <?php
    foreach ($pegawai as $data_pegawai) {
      if ($data_pegawai->NIP == $temp_idPegawaiTugas) {
        echo $data_pegawai->nama_unit_kerja . " Kabupaten Kebumen";
        ?>
      </td>
    </tr>
    <tr>
     <td width="1%">b.</td>
     <td width="40%"> Mata Anggaran </td>
     <td width="1%">:</td>
     <td colspan="3">< 5.2.2.15.02 ></td>
   </tr>
   <tr>
     <td width="2%">11. </td>
     <td colspan="2" width="40%"> Keterangan lain-lain </td>
     <td width="1%">:</td>
     <td colspan="3">
      <?php
      echo $data_surat_perintah_perjalanan_dinas->keterangan_lain_lain ;
      ?>
    </td>
  </tr>

  <?php
}
}
}
}
}
}
?>
</table>
</div>
<!-- Footer  -->
<table width="100%"" border="0" >

</table>
<br><br>
<table width="100%" border="0">
  <tr>
    <td width="65%"></td>
    <td width="35%">
      <table width="100%">
        <tr>
          <td width="85%">Ditetapkan di kebumen,</td>
        </tr>
        <tr>
          <td width="85%">Pada tanggal
           <?php
           echo date("D, M Y");
           ?>

         </td>
       </tr>
       <tr>
        <td width="85%" rowspan="2" style="text-align: center; text-transform: uppercase" >
          <?php foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
            if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
              $temp_NIP_pejabat_penanda_tangan=$data_perjalanan_dinas->NIP;
              echo $data_perjalanan_dinas->keterangan_jabatan . '<br>';
            }
          }
          ?>  
        </td>
      </tr>
      <tr>
        <td width="85%">&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <tr>
          <td width="85%">&nbsp;</td>
        </tr>
        <tr>
          <td width="85%"></td>
        </tr>
        <tr>
         <td width="90%" style="text-align: center; font-weight: bold; text-decoration: underline; text-transform: uppercase"> 

           <?php foreach ($pegawai as $data_pegawai) {
            if ($data_pegawai->NIP == $temp_NIP_pejabat_penanda_tangan) {
              echo $data_pegawai->nama_pegawai.'<br>';
              $temp_golongan_pejabat_penanda_tangan= $data_pegawai->nama_pangkat;
              
              break;
            }

          }
          ?>

        </td>
      </tr>                    
      <tr>
        <td width="85%" style="text-align: center;"> <?=$temp_golongan_pejabat_penanda_tangan?></td>
      </tr>
      <tr>
        <td width="85%" style="text-align: center;"> NIP. <?=$temp_NIP_pejabat_penanda_tangan?> </td>
      </tr>
    </table>
  </page>
</body>
</html>