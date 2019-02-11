<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Tugas</title>
    <link rel="stylesheet" href="<?php echo base_url('assets')?>/bower_components/surat_sipd/css/surat_sipd.css">
    <script type="text/javascript">
        window.print();
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
                        SURAT TUGAS
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>
                            <?php 
                            foreach ($surat_tugas as $data_surat_tugas) {
                                if ($data_surat_tugas->idSPT==$idSPT) {
                                    echo "Nomor :  $data_surat_tugas->nomor_spt";
                                    ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    <br>

                    <table width="100%">
                        <tr>
                            <td>
                               <table width="100%" border="0">
                                <tr>
                                    <td width="15%">Dasar</td>
                                    <td width="1%">:</td>
                                    <td> Kegiatan Dinas Kominfo Kabupaten Kebumen Tahun 2019 </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>    
                <!-- isi -->
                <table width="100%">
                    <tr>
                        <td>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="5" style="text-align: center; font-weight: bold; text-decoration: underline; font-size: 16px" class="ind">
                                      MENUGASKAN
                                  </td>
                              </tr>

                              <tr>
                                <td width="15%">Kepada </td>
                                <td width="1%">:</td>
                                <?php
                                foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                                    if ($data_surat_tugas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                                        ?>
                                        <td width="15%"> Nama </td>
                                        <td width="1%"> : </td>
                                        <td> 
                                            <?php 
                                            $temp_idPerjalananDinas=$data_surat_tugas->idPerjalananDinas;
                                            $temp_idPegawaiTugas=$data_perjalanan_dinas->idPegawaiTugas;
                                            echo $data_perjalanan_dinas->nama_pegawai . '<br>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%"></td>
                                        <td width="1%"></td>
                                        <td width="15%"> NIP </td>
                                        <td width="1%"> : </td>
                                        <td> 
                                            <?php 
                                            echo $data_perjalanan_dinas->idPegawaiTugas . '<br>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%"></td>
                                        <td width="1%"></td>
                                        <td width="15%"> Pangkat/Gol </td>
                                        <td width="1%"> : </td>
                                        <td> 
                                            <?php foreach ($pegawai as $data_pegawai) {
                                                if ($data_pegawai->NIP == $temp_idPegawaiTugas) {
                                                    echo $data_pegawai->nama_pangkat."/".$data_pegawai->nama_golongan . '<br>';
                                                            //echo count($temp_idPegawaiPengikut);
                                                    break;
                                                }

                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%"></td>
                                        <td width="1%"></td>
                                        <td width="15%"> Jabatan  </td>
                                        <td width="1%"> : </td>
                                        <td> < Kasi Infastek Bidang PDE ></td>
                                    </tr>
                                    <?php
                                    foreach($pegawai_pengikut as $data_pegawai_pengikut){+
                                        if ( $data_pegawai_pengikut->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){
                                            ?>
                                            <tr>
                                                <td colspan="5" style="text-align: justify;" class="ind">
                                                   <br>
                                               </td>
                                           </tr>
                                           <tr>
                                            <td width="15%"></td>
                                            <td width="1%"></td>
                                            <td width="15%"> Nama </td>
                                            <td width="1%"> : </td>
                                            <td> 
                                                <?php 
                                                echo $data_pegawai_pengikut->nama_pegawai . "<br>";
                                                if (!isset($temp_idPegawaiPengikut)) {
                                                    $temp_idPegawaiPengikut[0]=$data_pegawai_pengikut->idPegawaiPengikut;
                                                }
                                                else {
                                                    array_push($temp_idPegawaiPengikut, $data_pegawai_pengikut->idPegawaiPengikut);
                                                }
                                                ?>
                                                <tr>
                                                    <td width="15%"></td>
                                                    <td width="1%"></td>
                                                    <td width="15%"> NIP </td>
                                                    <td width="1%"> : </td>
                                                    <td> 
                                                        <?php
                                                        echo $data_pegawai_pengikut->idPegawaiPengikut . "<br>";
                                                        ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%"></td>
                                                    <td width="1%"></td>
                                                    <td width="15%"> Pangkat/Gol </td>
                                                    <td width="1%"> : </td>
                                                    <td> 
                                                        <?php 
                                                        $cek_loop=0;
                                                        $count_temp_idPegawaiPengikut=count($temp_idPegawaiPengikut);
                                                        foreach ($pegawai as $data_pegawai) {
                                                            if ($cek_loop==$count_temp_idPegawaiPengikut) {
                                                                break;
                                                            }
                                                            for ($temp=0; $temp < $count_temp_idPegawaiPengikut ; $temp++) { 
                                                                if ($data_pegawai->NIP == $temp_idPegawaiPengikut[$temp]) {
                                                                    echo $data_pegawai->nama_pangkat ."/". $data_pegawai->nama_golongan . '<br>';
                                                                    $cek_loop++;;
                                                                }
                                                            }
                                                        }
                                                        unset($temp_idPegawaiPengikut)
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="15%"></td>
                                                    <td width="1%"></td>
                                                    <td width="15%"> Jabatan  </td>
                                                    <td width="1%"> : </td>
                                                    <td> < Staf Bidang PDE > </td>
                                                </tr>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                }
                                break;
                            }
                        }
                    }
                }
                ?>
                <tr>
                    <td width="15%"></td>
                    <td width="1%"></td>
                    <td width="15%"> </td>
                    <td width="1%"> </td>
                    <td> < Pada Dinas Kominfo Kabupaten Kebmen > </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- Footer  -->
<table width="100%"" border="0" >
    <tr>
        <td width="15%">Untuk  </td>
        <td width="1%">:</td>
        <td colspan="3"> 
            <?php foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                if ($data_surat_tugas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                    echo "1. &nbsp;" .$data_perjalanan_dinas->kegiatan . '<br>';
                }
            }
            ?>    
        </td>
    </tr>
    <tr>
        <td width="15%"></td>
        <td width="1%"></td>
        <td width="15%"> Pada </td>
        <td width="1%"> : </td>
        <td></td>
    </tr>
    <tr>
        <td width="15%"></td>
        <td width="1%"></td>
        <td width="15%"> Hari/tanggal </td>
        <td width="1%"> : </td>
        <td> 
            <?php foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                if ($data_surat_tugas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                    echo $data_perjalanan_dinas->tanggal_acara . '<br>';
                }
            }
            ?>    
        </td>
    </tr>
    <tr>
        <td width="15%"></td>
        <td width="1%"></td>
        <td width="15%"> Tempat </td>
        <td width="1%"> : </td>
        <td> 
            <?php foreach ($perjalanan_dinas as $data_perjalanan_dinas) {
                if ($data_surat_tugas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                    echo $data_perjalanan_dinas->alamat_spesifik_tujuan . '<br>';
                }
            }
            ?>    
        </td>
    </tr>
    <tr>
        <td width="15%"></td>
        <td width="1%"></td>
        <td colspan="3"> 2 < Koordinasi dan Penyempurnaan Perbub Draft TIK Kabupaten Kebumen ></td>
    </tr>
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
                            if ($data_surat_tugas->idPerjalananDinas == $data_perjalanan_dinas->idPerjalananDinas){ 
                                $temp_NIP_pejabat_penanda_tangan=$data_perjalanan_dinas->NIP;
                                echo $data_perjalanan_dinas->keterangan_jabatan . '<br>';
                            }
                        }
                        ?>  
                    </td>
                </tr>
                <tr>
                    <tr>
                        <td width="85%">&nbsp;</td>
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
            </td>
        </tr>
    </table>
</div>
</div>
</page>
</body>
</html>