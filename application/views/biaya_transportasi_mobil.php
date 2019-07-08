<!DOCTYPE html>
<html>
<head>
 <?php $this->load->view("_partials/head.php") ?>
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
        Data Biaya Transportasi Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Biaya Transportasi</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <div class="row justify-content-center">
        <div class="col-sm-12">
          <div class="panel-body">
            <a href="#modalTambahData" data-toggle="modal" class="btn btn-primary">
              <i class="fa fa-plus"></i> Tambah Data
            </a>
          </div>
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalTambahData" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                  <h4 class="modal-title">Tambah Data Biaya Transportasi</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('biaya_transportasi_mobil/addDataBiayaTransportasiMobil')?>">
                    <div class="form-group">
                      <label class="col-lg-3 col-sm-3 control-label">Nama Transportasi</label>
                      <div class="col-lg-9 col-sm-9">
                        <select name="idTransportasi" id="idTransportasi" class="form-control" required>

                          <option disabled="">-- PILIH TRANSPORTASI --</option>
                          <?php 

                          foreach ($transportasi as $data_transportasi) {
                            if ($data_transportasi->jenis_transportasi=="Darat") {
                              ?>
                              <option value="<?php echo $data_transportasi->idTransportasi ?>"> <?php echo $data_transportasi->nama_transportasi ?></option>
                              <?php
                              continue;
                            }
                          }
                          ?>


                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 col-sm-3 control-label">Jarak Kilometer</label>
                      <div class="col-lg-9 col-sm-9">
                       <select name="kilometer" id="kilometer" class="form-control" required>
                         <option disabled=""> -- Pilih Jarak Kilometer --</option>
                         <option value="7"> 7 Km </option>
                         <option value="10"> 10 Km </option>
                         <option value="20"> 20 Km </option>
                       </select>
                     </div>
                   </div>

                   <div class="form-group">
                    <label class="col-lg-3 col-sm-3 control-label">Mesin CC</label>
                    <div class="col-lg-9 col-sm-9">
                      <select name="mesin_cc" id="mesin_cc" class="form-control" required>
                        <option disabled=""> -- Pilih Mesin CC --</option>
                        <option value="1000"> Mesin 1000 CC</option>
                        <option value="1500"> Mesin 1500 CC</option>
                        <option value="2000"> Mesin 2000 CC</option>
                        <option value="150"> Mesin 150 CC</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-3 col-sm-3 control-label">Jenis BBM</label>
                    <div class="col-lg-9 col-sm-9">
                     <select name="jenis_bbm" id="jenis_bbm" class="form-control" required>
                      <option disabled=""> -- Pilih Jenis BBM --</option>
                      <option value="10000/liter">10.000/Liter</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 col-sm-3 control-label">Nominal</label>
                  <div class="col-lg-9 col-sm-9">
                    <input type="number" name="nominal_biaya_mobil" id="nominal_biaya_mobil" class="form-control" placeholder="Masukan Nominal" required>
                  </div>
                </div>

                <div id="alert-msg"> </div>
                <div class="form-group">
                  <div style="padding-left: 60%" class="col-lg-offset-3 col-lg-9">
                    <button type="submit" id="addButton" class="btn btn-primary" name="tambah" value="tambah">Kirim</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
       <?php
      if ($this->session->flashdata('message')) {
        ?>
        <br><br>
        <div class="alert alert-success clearfix">
          <div class="noti-info">
            <a href="#"><?=$this->session->flashdata('message')?></a>
          </div>
        </div>
        <?php
      }
      else if ($this->session->flashdata('message_error')){
       ?>
       <br><br>
       <div class="alert alert-danger clearfix">
        <div class="noti-info">
          <a href="#"><?=$this->session->flashdata('message_error')?></a>
        </div>
      </div>
      <?php

    }
    ?>
    </div>

    <div class="col-sm-10 col-lg-10 offset-md-3" ">
      <div class=" box box-primary">
        <section class="panel">
          <div class="panel-body">
            <div class="adv-table">
              <table class="display table table-bordered table-striped" id="dynamic-table" style="width: 100%">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama Transportasi</th>
                    <th>Jarak Kilometer</th>
                    <th>Mesin CC</th>
                    <th>Jenis BBM</th>
                    <th>Nominal Biaya</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($biaya_transportasi_mobil as $data_biaya_transportasi_mobil) {
                    ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $data_biaya_transportasi_mobil->nama_transportasi?></td>
                      <td><?php echo $data_biaya_transportasi_mobil->kilometer . " Km"?></td>
                      <td><?php echo $data_biaya_transportasi_mobil->mesin_cc . " cc"?></td>
                      <td><?php echo $data_biaya_transportasi_mobil->jenis_bbm?></td>
                      <td><?php echo "Rp ". number_format($data_biaya_transportasi_mobil->nominal_biaya_mobil, 0, '', '.') .",-"?></td>
                      <td style="text-align: center">
                        <a href="#modalEditData<?php echo $data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" data-toggle="modal" class="btn btn-warning btn-sm">
                          <i class="fa fa-edit"></i>&nbsp;Edit &nbsp;
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusData('<?php echo $data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>')"><i class="fa fa-trash-o"></i> Hapus</button>
                      </td>
                    </tr>
                    <?php
                    $no++;
                  }
                  ?>
                </tbody>
              </table>

              <?php
              foreach ($biaya_transportasi_mobil as $data_biaya_transportasi_mobil) {
                ?>
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditData<?php echo $data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" class="modal fade">
                  <div class="modal-dialog edit">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Edit Data BiayaTransportasiMobil</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal edit" role="form" id="urlEdit<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" method="post" action="<?=base_url('biaya_transportasi_mobil/updateDataBiayaTransportasiMobil/'.$data_biaya_transportasi_mobil->idBiayaTransportasiMobil)?>">

                         <div class="form-group">
                          <label class="col-lg-3 col-sm-3 control-label">Nama Transportasi</label>
                          <div class="col-lg-9 col-sm-9">
                            <select name="idTransportasi<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" id="idTransportasi<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" class="form-control idTransportasi" required>

                              <option disabled="">-- PILIH TRANSPORTASI --</option>
                              <?php 

                              foreach ($transportasi as $data_transportasi) {
                                if ($data_transportasi->jenis_transportasi=="Darat") {
                                  if ($data_biaya_transportasi_mobil->idTransportasi==$data_transportasi->idTransportasi) {
                                    echo " <option selected value='$data_transportasi->idTransportasi'>$data_transportasi->nama_transportasi</option>";
                                    continue;
                                  }
                                  ?>
                                  <option value="<?php echo $data_transportasi->idTransportasi ?>"> <?php echo $data_transportasi->nama_transportasi ?></option>
                                  <?php 
                                }
                              }
                              ?>


                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 col-sm-3 control-label">Jarak Kilometer</label>
                          <div class="col-lg-9 col-sm-9">
                           <select name="kilometer<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" id="kilometer<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" class="form-control kilometer" required>

                            <?php switch ((INT)$data_biaya_transportasi_mobil->kilometer) {
                              case 7:
                              ?>
                              <option disabled=""> -- Pilih Jarak Kilometer --</option>
                              <option selected value="7"> 7 Km </option>
                              <option value="10"> 10 Km </option>
                              <option value="20"> 20 Km </option>
                              <?php 
                              break;
                              
                              case 10:
                              ?>
                              <option disabled=""> -- Pilih Jarak Kilometer --</option>
                              <option value="7"> 7 Km </option>
                              <option selected value="10"> 10 Km </option>
                              <option value="20"> 20 Km </option>
                              <?php 
                              break;
                              case 20:
                              ?>
                              <option disabled=""> -- Pilih Jarak Kilometer --</option>
                              <option value="7"> 7 Km </option>
                              <option value="10"> 10 Km </option>
                              <option selected value="20"> 20 Km </option>
                              <?php 
                              break;
                              default:

                              break;
                            } ?>
                            

                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Mesin CC</label>
                        <div class="col-lg-9 col-sm-9">
                          <select name="mesin_cc<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" id="mesin_cc<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" class="form-control mesin_cc" required>

                            <?php 
                            switch ($data_biaya_transportasi_mobil->mesin_cc) {
                              case '1000':
                              ?>
                              <option disabled=""> -- Pilih Mesin CC --</option>
                              <option selected value="1000"> Mesin 1000 CC</option>
                              <option value="1500"> Mesin 1500 CC</option>
                              <option value="2000"> Mesin 2000 CC</option>
                              <?php
                              break;
                              case '1500':
                              ?>
                              <option disabled=""> -- Pilih Mesin CC --</option>
                              <option value="1000"> Mesin 1000 CC</option>
                              <option selected value="1500"> Mesin 1500 CC</option>
                              <option value="2000"> Mesin 2000 CC</option>
                              <?php
                              break;
                              case '2000':
                              ?>
                              <option disabled=""> -- Pilih Mesin CC --</option>
                              <option value="1000"> Mesin 1000 CC</option>
                              <option value="1500"> Mesin 1500 CC</option>
                              <option selected value="2000"> Mesin 2000 CC</option>
                              <?php
                              break;

                              default:
                                  # code...
                              break;
                            }
                            ?>

                            

                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Jenis BBM</label>
                        <div class="col-lg-9 col-sm-9">
                          <select name="jenis_bbm<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" id="jenis_bbm<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" class="form-control jenis_bbm" required>
                            <option disabled=""> -- Pilih Jenis BBM --</option>
                            <option selected value="10000/liter">10.000/Liter</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Nominal</label>
                        <div class="col-lg-9 col-sm-9">
                          <input type="number" name="nominal_biaya_mobil<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" id="nominal_biaya_mobil<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" class="form-control nominal_biaya_mobil" placeholder="Masukan Nominal" value="<?php echo $data_biaya_transportasi_mobil->nominal_biaya_mobil?>" required>
                        </div>
                      </div>
                      <div class="alert-msg-edit"></div>
                      <div class="form-group">
                        <div style="padding-left: 60%" class="col-lg-offset-3 col-lg-9">
                          <button type="submit" class="btn btn-primary edit" id="editButton<?=$data_biaya_transportasi_mobil->idBiayaTransportasiMobil?>" name="edit" value="edit">Update</button>
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
      </div>
    </section>
  </div>
</div>
</div>
<!-- /.box -->
<!-- /.col -->


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

   <script>
  $(document).ready(function(){
    $('#dynamic-table').DataTable({
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
   function hapusData(id) {
   // alert(id);
   $.ajax({
    url     : "<?php echo base_url()?>biaya_transportasi_mobil/ajaxDataBiayaTransportasiMobil",
    method  : "post",
    data    : {id:id},
    success : function(idBiayaTransportasiMobil) {
      swal({
        title               : "Apakah Anda Yakin?",
        text                : 'Anda Ingin Menghapus BiayaTransportasiMobil "'+idBiayaTransportasiMobil+'"?',
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
            title             : "Removing",
            text              : "Data Akan Dihapus.",
            timer             : 1500,
            type              : "warning",
            showConfirmButton : false
          }, function () {
            window.location.href = "<?php echo base_url()?>biaya_transportasi_mobil/removeDataBiayaTransportasiMobil/"+id;
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
    nominal_biaya_mobil:$('#nominal_biaya_mobil').val(),
    kilometer:$('#kilometer').val(),
    mesin_cc:$('#mesin_cc').val(),
    jenis_bbm:$('#jenis_bbm').val(),
    idTransportasi:$('#idTransportasi').val()
  };
  $.ajax({
    url: "<?php echo base_url('biaya_transportasi_mobil/addDataBiayaTransportasiMobil'); ?>",
    type: 'POST',
    data: form_data,
    dataType: "JSON",
    success: function(message) {
      if (message.status == 1){
       $('#alert-msg').html('<div class="alert alert-success">' + message.message + '</div>');
       location.reload();
     }
     else{
      $('#alert-msg').html('<div class="alert alert-danger">' + message.message + '</div>');
    }
  }
});
  return false;
});
</script>

<script type="text/javascript">

  var editButton = document.getElementsByClassName("btn btn-primary edit");

  $('.btn.btn-primary.edit').each(function(index) {

    $(this).on("click", function(){
      //alert("message?: DOMString");
      var cek = document.getElementsByClassName("btn btn-primary edit");
      console.log(cek);
          // console.log(cek);

          var nominal_biaya_mobil_edit = document.getElementsByClassName("form-control nominal_biaya_mobil")[index].id;
          var idTransportasi_edit = document.getElementsByClassName("form-control idTransportasi")[index].id;
          var kilometer_edit = document.getElementsByClassName("form-control kilometer")[index].id;
          var mesin_cc_edit = document.getElementsByClassName("form-control mesin_cc")[index].id;
          var jenis_bbm_edit = document.getElementsByClassName("form-control jenis_bbm")[index].id;
          var b = document.getElementsByClassName("form-horizontal edit")[index].id;
          var url_edit = document.getElementById(b).action;
          console.log(url_edit);

          var form_data = {

            nominal_biaya_mobil: $('#'+nominal_biaya_mobil_edit).val(),
            idTransportasi:$('#'+idTransportasi_edit).val(),
            kilometer:$('#'+kilometer_edit).val(),
            mesin_cc:$('#'+mesin_cc_edit).val(),
            jenis_bbm_edit:$('#'+jenis_bbm_edit).val()

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

  var url = window.location;
// Will only work if string in href matches with location
$('.treeview-menu a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('.treeview-menu a').filter(function() {
  return this.href == url;
}).parent().addClass('active');
</script>