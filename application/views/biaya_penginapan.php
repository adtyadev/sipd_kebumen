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
        Data Biaya Penginapan Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Biaya Penginapan</li>
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
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="modalTambahData" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                  <h4 class="modal-title">Tambah Data Biaya Penginapan</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('biaya_penginapan/addDataBiayaPenginapan')?>">
                    <div class="form-group">
                      <label class="col-lg-3 col-sm-3 control-label">Nama Golongan</label>
                      <div class="col-lg-9 col-sm-9">
                        <select name="idGolongan" id="idGolongan" class="form-control" required>

                          <option disabled="">-- PILIH GOLONGAN --</option>
                          <?php 

                          foreach ($golongan as $data_golongan) {
                            ?>
                            <option value="<?php echo $data_golongan->idGolongan ?>"> <?php echo $data_golongan->nama_golongan ?></option>
                            <?php 
                          }
                          ?>


                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-lg-3 col-sm-3 control-label">Lokasi Provinsi</label>
                      <div class="col-lg-9 col-sm-9">
                       <select name="idProvinsi" id="idProvinsi" class="form-control select2 select2-hidden-accessible" onchange="" style="width: 100%;" tabindex="-1" aria-hidden="true"  >
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

                  </div>

                  <div class="form-group">
                    <label class="col-lg-3 col-sm-3 control-label">Nominal</label>
                    <div class="col-lg-9 col-sm-9">
                      <input type="number" name="nominal_biaya_penginapan" id="nominal_biaya_penginapan" class="form-control" placeholder="Masukan Nominal" required>
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
                      <th>Nama Golongan</th>
                      <th>Lokasi Provinsi</th>
                      <th>Nominal Biaya</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($biaya_penginapan as $data_biaya_penginapan) {
                      ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data_biaya_penginapan->nama_golongan?></td>
                        <td><?php echo $data_biaya_penginapan->nama_provinsi?></td>
                        <td><?php echo "Rp ". number_format($data_biaya_penginapan->nominal_biaya_penginapan, 0, '', '.')  .",-"?></td>
                        <td style="text-align: center">
                          <a href="#modalEditData<?php echo $data_biaya_penginapan->idBiayaPenginapan?>" data-toggle="modal" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>&nbsp;Edit &nbsp;
                          </a>
                          <button type="button" class="btn btn-danger btn-sm" onclick="hapusData('<?php echo $data_biaya_penginapan->idBiayaPenginapan?>')"><i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>

                <?php
                foreach ($biaya_penginapan as $data_biaya_penginapan) {
                  ?>
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditData<?php echo $data_biaya_penginapan->idBiayaPenginapan?>" class="modal fade edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Data BiayaPenginapan</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal edit" role="form" id="urlEdit<?=$data_biaya_penginapan->idBiayaPenginapan?>" method="post" action="<?=base_url('biaya_penginapan/updateDataBiayaPenginapan/'.$data_biaya_penginapan->idBiayaPenginapan)?>">

                           <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Nama Golongan</label>
                            <div class="col-lg-9 col-sm-9">
                              <select name="idGolongan<?=$data_biaya_penginapan->idBiayaPenginapan?>" id="idGolongan<?=$data_biaya_penginapan->idBiayaPenginapan?>" class="form-control idGolongan" required>

                                <option disabled="">-- PILIH GOLONGAN --</option>
                                <?php 

                                foreach ($golongan as $data_golongan) {
                                  if ($data_biaya_penginapan->idGolongan==$data_golongan->idGolongan) {
                                    echo " <option selected value='$data_golongan->idGolongan'>$data_golongan->nama_golongan</option>";
                                    continue;
                                  }
                                  ?>
                                  <option value="<?php echo $data_golongan->idGolongan ?>"> <?php echo $data_golongan->nama_golongan ?></option>
                                  <?php 
                                }
                                ?>


                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Lokasi Provinsi</label>
                            <div class="col-lg-9 col-sm-9">
                             <select name="idProvinsi<?=$data_biaya_penginapan->idBiayaPenginapan?>" id="idProvinsi<?=$data_biaya_penginapan->idBiayaPenginapan?>" class="form-control idProvinsi select2 select2-hidden-accessible" onchange="" style="width: 100%;" tabindex="-1" aria-hidden="true">
                              <option disabled=""> -- Pilih Lokasi Provinsi --</option>
                              <?php 

                              foreach ($provinsi as $data_provinsi) {
                                if ($data_biaya_penginapan->idProvinsi==$data_provinsi->idProvinsi) {
                                  echo " <option selected value='$data_provinsi->idProvinsi'> $data_provinsi->nama_provinsi</option>";
                                  continue;
                                }
                                ?>
                                <option value="<?php echo $data_provinsi->idProvinsi?>"> <?php echo $data_provinsi->nama_provinsi ?></option>
                                <?php 
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 col-sm-3 control-label">Nominal</label>
                          <div class="col-lg-9 col-sm-9">
                            <input type="number" name="nominal_biaya_penginapan<?=$data_biaya_penginapan->idBiayaPenginapan?>" id="nominal_biaya_penginapan<?=$data_biaya_penginapan->idBiayaPenginapan?>" class="form-control nominal_biaya_penginapan" placeholder="Masukan Nominal" value="<?php echo $data_biaya_penginapan->nominal_biaya_penginapan?>" required>
                          </div>
                        </div>
                        <div class="alert-msg-edit"></div>
                        <div class="form-group">
                          <div style="padding-left: 60%" class="col-lg-offset-3 col-lg-9">
                            <button type="submit" class="btn btn-primary edit" name="edit" id="editButton<?=$data_biaya_penginapan->idBiayaPenginapan?>" value="edit">Update</button>
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


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/')?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/')?>dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/')?>bower_components/select2/dist/js/select2.full.min.js"></script>
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
<script >
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
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
    url     : "<?php echo base_url()?>biaya_penginapan/ajaxDataBiayaPenginapan",
    method  : "post",
    data    : {id:id},
    success : function(idBiayaPenginapan) {
      swal({
        title               : "Apakah Anda Yakin?",
        text                : 'Anda Ingin Menghapus BiayaPenginapan "'+idBiayaPenginapan+'"?',
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
            window.location.href = "<?php echo base_url()?>biaya_penginapan/removeDataBiayaPenginapan/"+id;
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
    nominal_biaya_penginapan:$('#nominal_biaya_penginapan').val(),
    idGolongan:$('#idGolongan').val(),
    idProvinsi:$('#idProvinsi').val()
  };
  $.ajax({
    url: "<?php echo base_url('biaya_penginapan/addDataBiayaPenginapan'); ?>",
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
          var idGolongan_edit = document.getElementsByClassName("form-control idGolongan")[index].id;
          var idProvinsi_edit = document.getElementsByClassName("form-control idProvinsi")[index].id;
          var nominal_biaya_penginapan_edit = document.getElementsByClassName("form-control nominal_biaya_penginapan")[index].id;

          var b = document.getElementsByClassName("form-horizontal edit")[index].id;
          var url_edit = document.getElementById(b).action;
          console.log(url_edit);

          var form_data = {
            idGolongan: $('#'+idGolongan_edit).val(),
            idProvinsi: $('#'+idProvinsi_edit).val(),
            nominal_biaya_penginapan: $('#'+nominal_biaya_penginapan_edit).val()

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