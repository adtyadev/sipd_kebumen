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
        Data Biaya Transportasi Lain Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Biaya Transportasi Lain</li>
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
                  <h4 class="modal-title">Tambah Data Biaya Transportasi Lain</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('biaya_transportasi_lain/addDataBiayaTransportasiLain')?>">
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
                      <label class="col-lg-3 col-sm-3 control-label">Nama Tranportasi</label>
                      <div class="col-lg-9 col-sm-9">
                       <select name="idTransportasi" id="idTransportasi" class="form-control select2 select2-hidden-accessible" onchange="" style="width: 100%;" tabindex="-1" aria-hidden="true"  >
                        <option disabled>-- Pilih Transportasi --</option>
                        <?php 

                        foreach ($transportasi as $data_transportasi) {
                          if ($data_transportasi->jenis_transportasi=="Darat") {
                            continue;
                          }
                          else{
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
                    <label class="col-lg-3 col-sm-3 control-label">Kelas Transportasi</label>
                    <div class="col-lg-9 col-sm-9">
                      <input type="text" name="kelas_transportasi" id="kelas_transportasi" class="form-control" placeholder="Masukan Kelas Transportasi" required>
                    </div>
                  </div>

                  <div id="alert-msg"> </div>
                  <div class="form-group">
                    <div style="padding-left: 60%" class="col-lg-offset-3 col-lg-9">
                      <button type="submit" id="addButton" class="btn btn-primary" name="tambah" onclick="form_validation()" value="tambah">Kirim</button>
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
          <div class="alert alert-success clearfix">
            <div class="noti-info">
              <a href="#"><?php echo $this->session->flashdata('message')?></a>
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
                <table class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama Golongan</th>
                      <th>Nama Tranportasi</th>
                      <th>Kelas Transportasi </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($biaya_transportasi_lain as $data_biaya_transportasi_lain) {
                      ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data_biaya_transportasi_lain->nama_golongan?></td>
                        <td><?php echo $data_biaya_transportasi_lain->nama_transportasi?></td>
                        <td><?php echo $data_biaya_transportasi_lain->kelas_transportasi?></td>
                        <td style="text-align: center">
                          <a href="#modalEditData<?php echo $data_biaya_transportasi_lain->idBiayaTransportasiLain?>" data-toggle="modal" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                          <button type="button" class="btn btn-danger btn-sm" onclick="hapusData('<?php echo $data_biaya_transportasi_lain->idBiayaTransportasiLain?>')"><i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                </table>

                <?php
                foreach ($biaya_transportasi_lain as $data_biaya_transportasi_lain) {
                  ?>
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditData<?php echo $data_biaya_transportasi_lain->idBiayaTransportasiLain?>" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                          <h4 class="modal-title">Edit Data BiayaTransportasiLain</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" role="form" method="post" action="<?=base_url('biaya_transportasi_lain/updateDataBiayaTransportasiLain/'.$data_biaya_transportasi_lain->idBiayaTransportasiLain)?>">

                           <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Nama Golongan</label>
                            <div class="col-lg-9 col-sm-9">
                              <select name="idGolongan" id="idGolongan" class="form-control" required>

                                <option disabled="">-- PILIH GOLONGAN --</option>
                                <?php 

                                foreach ($golongan as $data_golongan) {
                                  if ($data_biaya_transportasi_lain->idGolongan==$data_golongan->idGolongan) {
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
                            <label class="col-lg-3 col-sm-3 control-label">Nama Tranportasi</label>
                            <div class="col-lg-9 col-sm-9">
                             <select name="idTransportasi" id="idTransportasi" class="form-control select2 select2-hidden-accessible" onchange="" style="width: 100%;" tabindex="-1" aria-hidden="true">
                              <option disabled=""> -- Pilih Nama Tranportasi --</option>
                              <?php 

                              foreach ($transportasi as $data_transportasi) {
                               if ($data_transportasi->jenis_transportasi=="Darat") {
                                continue;
                              }
                              else{
                                if ($data_biaya_transportasi_lain->idTransportasi==$data_transportasi->idTransportasi) {
                                  echo " <option selected value='$data_transportasi->idTransportasi'> $data_transportasi->nama_transportasi</option>";
                                  continue;
                                }
                              }
                              ?>
                              <option value="<?php echo $data_transportasi->idTransportasi?>"> <?php echo $data_transportasi->nama_transportasi ?></option>
                              <?php 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label">Kelas Transportasi</label>
                        <div class="col-lg-9 col-sm-9">
                          <input type="text" name="kelas_transportasi" id="kelas_transportasi" class="form-control" placeholder="Masukan Kelas Transportasi" value="<?php echo $data_biaya_transportasi_lain->kelas_transportasi?>" required>
                        </div>
                      </div>

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

   <script type="text/javascript">
    function form_validation(){
      //alert("message?: DOMString");
 //  var urlTambah = document.getElementById("urlTambah").action;
 // console.log(urlTambah);
 var form_data = {
  kelas_transportasi:$('#kelas_transportasi').val()
};
$.ajax({
  url: "<?php echo base_url('biaya_transportasi_lain/addDataBiayaTransportasiLain'); ?>",
  type: 'POST',
  data: form_data,
  success: function(message) {
    if (message == "Sukses"){
      $('#alert-msg').html('<div class="alert alert-success">' + "Data Berhasil Ditambahkan" + '</div>');
     //location.reload();
   }
   else{
        //    alert(message)
       $('#alert-msg').html('<div class="alert alert-danger">' + message + '</div>');
      }
    }
  });
//return false;


}

</script>

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
    $('#dynamic-table').DataTable()
  });
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
    url     : "<?php echo base_url()?>biaya_transportasi_lain/ajaxDataBiayaTransportasiLain",
    method  : "post",
    data    : {id:id},
    success : function(idBiayaTransportasiLain) {
      swal({
        title               : "Apakah Anda Yakin?",
        text                : 'Anda Ingin Menghapus BiayaTransportasiLain "'+idBiayaTransportasiLain+'"?',
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
            window.location.href = "<?php echo base_url()?>biaya_transportasi_lain/removeDataBiayaTransportasiLain/"+id;
          });
        }
      });
    }
  });
 }
</script>

</body>
</html>

<script>

  var url = window.location;
// Will only work if string in href matches with location
$('.treeview-menu a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('.treeview-menu a').filter(function() {
  return this.href == url;
}).parent().addClass('active');
</script>