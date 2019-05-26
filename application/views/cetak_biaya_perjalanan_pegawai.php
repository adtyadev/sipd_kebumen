<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("_partials/head.php") ?>
  <title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biaya Perjalanan Pegawai</title>

    <!-- <link rel="stylesheet" href="<?php echo base_url('assets')?>/bower_components/surat_sipd/css/surat_sipd.css"> -->

    <script type="text/javascript">
   //   window.print();
 </script>
</title>
</head>
<body>
  <?php
  foreach ($surat_perintah_perjalanan_dinas as $data_surat_perintah_perjalanan_dinas) {
    ?>
    <div class="container">
    <h3 class="modal-title">Invoice - Biaya Perjalanan Pegawai</h3>
    <div class="row">
      <div class="col-lg-12">
        <strong>Nomor SPPD </strong><br>
        <?php echo $data_surat_perintah_perjalanan_dinas->nomor_sppd; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-6">
            <address>
              <strong><br>Nama Pegawai Tugas:</strong><br><br>
              <?php

              foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                  $temp_idPerjalananDinas=$data_surat_perintah_perjalanan_dinas->idPerjalananDinas;
                  $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
                  foreach ($pegawai as $data_pegawai) {
                    if ($data_pegawai->NIP == $data_perjalanan_dinas->idPegawaiTugas) {
                      echo $data_pegawai->nama_pegawai . '<br>';
                      echo $data_pegawai->nama_golongan . '<br>';
                      echo $data_pegawai->nama_pangkat . '<br>';
                      echo $data_pegawai->nama_unit_kerja;
                      echo '<hr>';
                      $nama_pegawai[0]=$data_pegawai->nama_pegawai;

                    }
                  }
                  ?>
                </address>
              </div>
              <div class="col-xs-6 text-right">
                <address>
                  <strong>Nama Pegawai Pengikut:</strong><br>
                  <?php
                  foreach($pegawai_pengikut as $data_pegawai_pengikut){
                    if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                     foreach ($pegawai as $data_pegawai) {
                      if ($data_pegawai->NIP == $data_pegawai_pengikut->idPegawaiPengikut) {
                        echo $data_pegawai->nama_pegawai . '<br>';
                        echo  $data_pegawai->nama_pangkat . ' / Gol ' . $data_pegawai->nama_golongan ;
                        echo '<hr>';
                        array_push($nama_pegawai, $data_pegawai->nama_pegawai);
                                //echo $nama_pegawai[0] . $nama_pegawai[1];
                      }
                    }

                  }
                }
                break;
              }
            };
            ?>
          </address>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <address>
            <strong>Pembayaran :</strong><br>
            Transfer<br>
            <strong>Mata Anggaran :</strong><br>
            <?=$data_surat_perintah_perjalanan_dinas->mata_anggaran?><br>
          </address>
        </div>
        <div class="col-xs-6 text-right">
          <address>
            <strong>Tanggal Perjalanan:</strong><br>
            <?php
            echo date_indo($data_perjalanan_dinas->tanggal_berangkat) ." <br> s/d <br>" . date_indo($data_perjalanan_dinas->tanggal_kembali) ;
            ?>
          </address>
        </div>
      </div>
    </div>
  </div>
  <?php

  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Detail Anggaran</strong></h3>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <?php 

            $i=0;
            $total_anggaran_pegawai=0;
            foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
              if ($data_surat_perintah_perjalanan_dinas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                $temp_idPerjalananDinas=$data_surat_perintah_perjalanan_dinas->idPerjalananDinas;
                $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
                echo "Biaya Anggaran Pegawai Tugas : <br>";
                ?>
                <h5> [ <?php 
                  if ($i>count($nama_pegawai)-1) {
                   continue;
                 }
                 else{
                  echo $nama_pegawai[$i]; 
                  $i++; 
                }
                ?> 
              ] </h5>
              <table class="table table-condensed" border="0">
                <thead>
                  <tr>
                    <td><strong>Item Biaya</strong></td>
                    <td class="text-center"><strong>Harga</strong></td>
                    <td class="text-center"><strong>Jumlah</strong></td>
                    <td class="text-right"><strong>Total</strong></td>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($data_perjalanan_dinas->nominal_biaya_harian == NULL ) {
                    ?>
                    <tr>
                      <td>
                        <?php
                        echo "Biaya Harian "
                        ?>
                      </td>
                      <td class="text-center">
                       <?php
                       echo " Rp 0,- <br>";
                       $total_anggaran_pegawai+=0;
                       ?>
                     </td>
                     <td class="text-center">x - </td>
                     <td class="text-right">Rp 0,- </td>
                   </tr>

                   <?php
                 }

                 else {
                  ?>
                  <tr>  
                    <td>
                      <?php
                      echo "Biaya Harian " 
                      ?>
                    </td>
                    <td class="text-center">
                      <?php
                      echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_harian, 0, '', '.') ; 
                      ?>
                    </td>
                    <td class="text-center">x 
                      <?php
                      echo (INT)$data_perjalanan_dinas->lama_perjalanan;
                      ?>
                    </td>
                    <td class="text-right">
                      <?php
                      echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_harian* (INT)$data_perjalanan_dinas->lama_perjalanan, 0, '', '.')  . ',-';
                      $total_anggaran_pegawai+=( (INT)$data_perjalanan_dinas->nominal_biaya_harian * (INT)$data_perjalanan_dinas->lama_perjalanan);
                      ?>
                    </td>
                  </tr>

                  <?php
                }

                if ($data_perjalanan_dinas->nominal_biaya_penginapan==NULL) {
                  ?>
                  <tr>
                    <td>
                      <?php
                      echo "Biaya Penginapan "
                      ?>
                    </td>
                    <td class="text-center">
                     <?php
                     echo " Rp 0,- <br>";
                     $total_anggaran_pegawai+=0;
                     ?>
                   </td>
                   <td class="text-center">x - </td>
                   <td class="text-right">Rp 0,- </td>
                 </tr>

                 <?php
               }
               else{
                 ?>
                 <tr>  
                  <td>
                    <?php
                    echo "Biaya Penginapan " 
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                    echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_penginapan, 0, '', '.') ; 
                    ?>
                  </td>
                  <td class="text-center">x 
                    <?php
                    echo (INT)$data_perjalanan_dinas->lama_perjalanan;
                    ?>
                  </td>
                  <td class="text-right">
                    <?php
                    echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_penginapan, 0, '', '.')  . ',-';
                    $total_anggaran_pegawai+=( (INT)$data_perjalanan_dinas->nominal_biaya_penginapan );
                    ?>
                  </td>
                </tr>

                <?php
              }
              if ($data_perjalanan_dinas->nominal_biaya_mobil==NULL) {
                ?>
                <tr>
                  <td>
                    <?php
                    echo "Biaya Transportasi Mobil "
                    ?>
                  </td>
                  <td class="text-center">
                   <?php
                   echo " Rp 0,- <br>";
                   $total_anggaran_pegawai+=0;
                   ?>
                 </td>
                 <td class="text-center">x - </td>
                 <td class="text-right">Rp 0,- </td>
               </tr>

               <?php
             }
             else{
              ?>
              <tr>  
                <td>
                  <?php
                  echo "Biaya Transportasi Mobil " 
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_mobil, 0, '', '.') ; 
                  ?>
                </td>
                <td class="text-center">x 
                  <?php
                  echo (INT)$data_perjalanan_dinas->jarak_perjalanan . "Km";
                  ?>
                </td>
                <td class="text-right">
                  <?php
                  echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_mobil* (INT)$data_perjalanan_dinas->jarak_perjalanan, 0, '', '.')  . ',-';
                  $total_anggaran_pegawai+=( (INT)$data_perjalanan_dinas->nominal_biaya_mobil * (INT)$data_perjalanan_dinas->jarak_perjalanan);
                  ?>
                </td>
              </tr>

              <?php
            }
            if ($data_perjalanan_dinas->kelas_transportasi==NULL) {
             ?>
             <tr>
              <td>
                <?php
                echo "Biaya Transportasi Bukan Mobil "
                ?>
              </td>
              <td class="text-center">
               <?php
               echo " -- <br>";
               $total_anggaran_pegawai+=0;
               ?>
             </td>
             <td class="text-center">x - </td>
             <td class="text-right">-- </td>
           </tr>

           <?php
         }
         else {
           ?>
           <tr>  
            <td>
              <?php
              echo "Biaya Transportasi Bukan Mobil " 
              ?>
            </td>
            <td class="text-center">
              <?php
              echo $data_perjalanan_dinas->kelas_transportasi; 
              ?>
            </td>
            <td class="text-center">x 
              <?php
              echo "--";
              ?>
            </td>
            <td class="text-right">
              <?php
              echo $data_perjalanan_dinas->kelas_transportasi;
              ?>
            </td>
          </tr>
          <?php

        }
        if ( $data_perjalanan_dinas->nominal_biaya_tambahan == NULL) {
         ?>
         <tr>
          <td>
            <?php
            echo "Biaya Tambahan Lain "
            ?>
          </td>
          <td class="text-center">
           <?php
           echo " Rp 0,- <br>";
           $total_anggaran_pegawai+=0;
           ?>
         </td>
         <td class="text-center">x - </td>
         <td class="text-right">Rp 0,- </td>
       </tr>

       <?php
     } 
     else {
       ?>
       <tr>  
        <td>
          <?php
          echo "Biaya Tambahan Lain " 
          ?>
        </td>
        <td class="text-center">
          <?php
          echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_tambahan, 0, '', '.') ; 
          ?>
        </td>
        <td class="text-center">x 
          <?php
          echo "--";
          ?>
        </td>
        <td class="text-right">
          <?php
          echo " Rp " . number_format($data_perjalanan_dinas->nominal_biaya_tambahan, 0, '', '.')  . ',-';
          $total_anggaran_pegawai+= (INT)$data_perjalanan_dinas->nominal_biaya_tambahan ;
          ?>
        </td>
      </tr>

      <?php
    } 
    ?>
    <tr>
      <td class="no-line"></td>
      <td class="no-line"></td>
      <td class="no-line text-center"><strong>Total</strong></td>
      <td class="no-line text-right">Rp <?= number_format($total_anggaran_pegawai, 0, '', '.')?>,-</td>
    </tr>
  </tbody>
</table>
<!-- End Pegawai Tugas -->

<!-- Start Pegawai Pengikut -->
<?php
$total_anggaran_pegawai=0;
echo "Biaya Anggaran Pegawai Pengikut : <br>";

foreach($pegawai_pengikut as $data_pegawai_pengikut){
  if ( $data_pegawai_pengikut->idPerjalananDinas == $data_pegawai_pengikut->idPerjalananDinas){
    ?>
    <h5> <?php 
    if ($i>count($nama_pegawai)-1) {
     break;
   }
   else{
    echo "[".$nama_pegawai[$i] . "]"; 
    $i++; 
  }
  ?> 
</h5>
<table class="table table-condensed" border="0">
  <thead>
    <tr>
      <td><strong>Item Biaya</strong></td>
      <td class="text-center"><strong>Harga</strong></td>
      <td class="text-center"><strong>Jumlah</strong></td>
      <td class="text-right"><strong>Total</strong></td>
    </tr>
  </thead>
  <tbody>

    <?php
    if ($data_pegawai_pengikut->nominal_biaya_harian == NULL ) {
      ?>
      <tr>
        <td>
          <?php
          echo "Biaya Harian "
          ?>
        </td>
        <td class="text-center">
         <?php
         echo " Rp 0,- <br>";
         $total_anggaran_pegawai+=0;
         ?>
       </td>
       <td class="text-center">x - </td>
       <td class="text-right">Rp 0,- </td>
     </tr>

     <?php
   }

   else {
    ?>
    <tr>  
      <td>
        <?php
        echo "Biaya Harian " 
        ?>
      </td>
      <td class="text-center">
        <?php
        echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_harian, 0, '', '.') ; 
        ?>
      </td>
      <td class="text-center">x 
        <?php
        echo (INT)$data_perjalanan_dinas->lama_perjalanan;
        ?>
      </td>
      <td class="text-right">
        <?php
        echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_harian* (INT)$data_perjalanan_dinas->lama_perjalanan, 0, '', '.')  . ',-';
        $total_anggaran_pegawai+=( (INT)$data_pegawai_pengikut->nominal_biaya_harian * (INT)$data_perjalanan_dinas->lama_perjalanan);
        ?>
      </td>
    </tr>

    <?php
  }
  if ($data_pegawai_pengikut->nominal_biaya_penginapan==NULL) {
    ?>
    <tr>
      <td>
        <?php
        echo "Biaya Penginapan "
        ?>
      </td>
      <td class="text-center">
       <?php
       echo " Rp 0,- <br>";
       $total_anggaran_pegawai+=0;
       ?>
     </td>
     <td class="text-center">x - </td>
     <td class="text-right">Rp 0,- </td>
   </tr>

   <?php
 }
 else{
   ?>
   <tr>  
    <td>
      <?php
      echo "Biaya Penginapan " 
      ?>
    </td>
    <td class="text-center">
      <?php
      echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_penginapan, 0, '', '.') ; 
      ?>
    </td>
    <td class="text-center">x -
    </td>
    <td class="text-right">
      <?php
      echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_penginapan, 0, '', '.')  . ',-';
      $total_anggaran_pegawai+=( (INT)$data_pegawai_pengikut->nominal_biaya_penginapan );
      ?>
    </td>
  </tr>

  <?php
}
if ($data_pegawai_pengikut->nominal_biaya_mobil==NULL) {
  ?>
  <tr>
    <td>
      <?php
      echo "Biaya Transportasi Mobil "
      ?>
    </td>
    <td class="text-center">
     <?php
     echo " Rp 0,- <br>";
     $total_anggaran_pegawai+=0;
     ?>
   </td>
   <td class="text-center">x - </td>
   <td class="text-right">Rp 0,- </td>
 </tr>

 <?php
}
else{
  ?>
  <tr>  
    <td>
      <?php
      echo "Biaya Transportasi Mobil " 
      ?>
    </td>
    <td class="text-center">
      <?php
      echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_mobil, 0, '', '.') ; 
      ?>
    </td>
    <td class="text-center">x 
      <?php
      echo (INT)$data_perjalanan_dinas->jarak_perjalanan . "Km";
      ?>
    </td>
    <td class="text-right">
      <?php
      echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_mobil* (INT)$data_perjalanan_dinas->jarak_perjalanan, 0, '', '.')  . ',-';
      $total_anggaran_pegawai+=( (INT)$data_pegawai_pengikut->nominal_biaya_mobil * (INT)$data_perjalanan_dinas->jarak_perjalanan);
      ?>
    </td>
  </tr>

  <?php
}
if ($data_pegawai_pengikut->kelas_transportasi==NULL) {
 ?>
 <tr>
  <td>
    <?php
    echo "Biaya Transportasi Bukan Mobil "
    ?>
  </td>
  <td class="text-center">
   <?php
   echo " -- <br>";
   $total_anggaran_pegawai+=0;
   ?>
 </td>
 <td class="text-center">x - </td>
 <td class="text-right">-- </td>
</tr>

<?php
}
else {
 ?>
 <tr>  
  <td>
    <?php
    echo "Biaya Transportasi Bukan Mobil " 
    ?>
  </td>
  <td class="text-center">
    <?php
    echo $data_pegawai_pengikut->kelas_transportasi; 
    ?>
  </td>
  <td class="text-center">x 
    <?php
    echo "--";
    ?>
  </td>
  <td class="text-right">
    <?php
    echo $data_pegawai_pengikut->kelas_transportasi;
    ?>
  </td>
</tr>
<?php

}
if ( $data_pegawai_pengikut->nominal_biaya_tambahan == NULL) {
 ?>
 <tr>
  <td>
    <?php
    echo "Biaya Tambahan Lain "
    ?>
  </td>
  <td class="text-center">
   <?php
   echo " Rp 0,- <br>";
   $total_anggaran_pegawai+=0;
   ?>
 </td>
 <td class="text-center">x - </td>
 <td class="text-right">Rp 0,- </td>
</tr>

<?php
} 
else {
 ?>
 <tr>  
  <td>
    <?php
    echo "Biaya Tambahan Lain " 
    ?>
  </td>
  <td class="text-center">
    <?php
    echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_tambahan, 0, '', '.') ; 
    ?>
  </td>
  <td class="text-center">x 
    <?php
    echo "--";
    ?>
  </td>
  <td class="text-right">
    <?php
    echo " Rp " . number_format($data_pegawai_pengikut->nominal_biaya_tambahan, 0, '', '.')  . ',-';
    $total_anggaran_pegawai+= (INT)$data_pegawai_pengikut->nominal_biaya_tambahan ;
    ?>
  </td>
</tr>

<?php
} 

?>
<tr>
  <td class="no-line"></td>
  <td class="no-line"></td>
  <td class="no-line text-center"><strong>Total</strong></td>
  <td class="no-line text-right">Rp <?= number_format($total_anggaran_pegawai, 0, '', '.')?>,-</td>
</tr>
</tbody>
</table>
<?php
}
}
}

};
unset($nama_pegawai);
?> 
</div>
</div>
</div>
</div>
</div>

</div>


<?php
}
?>


</body>
</html>