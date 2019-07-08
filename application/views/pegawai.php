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
        Data Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pegawai</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row"> 
        <div class="col-sm-12">
          <div class="panel-body">
            <a href="#modalTambahData" data-toggle="modal" class="btn btn-primary">
              <i class="fa fa-plus"></i> Tambah Data
            </a>
            
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
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalTambahData" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                  <h4 class="modal-title">Tambah Data Pegawai</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('pegawai/addDataPegawai')?>">
                    <div class="form-group">

                      <div class="col-lg-12">
                       <label >NIP</label>
                       <input type="text" name="NIP" id="NIP" class="form-control" maxlength="18" placeholder="NIP" required>
                     </div>
                   </div>
                   <div class="form-group">
                    <div class="col-lg-12">
                      <label> Nama Pegawai</label>
                      <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama Pegawai" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-6 col-sm-6"> 
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="tempat_lahir" required>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <label>Tanggal Lahir</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control pull-right" id="datepicker1" placeholder="yyyy-mm-dd">
<!--                         <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                           <input type="text" class="form-control pull-right" id="datepicker" >
                          <input type="text" name="birthday" class="form-control pull-right" value="10-24-1984" />
                        </div> -->
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
<!--                     <div class="col-lg-4 col-sm-4"> 
                      <label>Pangkat</label>
                      <select name="idPangkat" id="idPangkat" class="form-control" required>

                        <option disabled="">-- PILIH PANGKAT --</option>
                        <?php 

                        foreach ($pangkat as $data_pangkat) {
                          ?>
                          <option value="<?php echo $data_pangkat->idPangkat ?>"> <?php echo $data_pangkat->nama_pangkat ?></option>
                          <?php 
                        }
                        ?>


                      </select>
                    </div> -->
                    <div class="col-lg-8 col-sm-8">
                      <label>Golongan</label>
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
                    <div class="col-lg-4 col-sm-4">
                      <label>Unit Kerja</label>
                      <select name="idUnitKerja" id="idUnitKerja" class="form-control" required>
                        <option disabled="">-- PILIH UNIT KERJA --</option>
                        <?php 

                        foreach ($unit_kerja as $data_unit_kerja) {
                          ?>
                          <option value="<?php echo $data_unit_kerja->idUnitKerja ?>"> <?php echo $data_unit_kerja->nama_unit_kerja ?></option>
                          <?php 
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                  <div id="alert-msg"></div>
                  <div class="form-group">
                    <div class="col-lg-offset-10 col-lg-10">
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
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="exampler" class="display table table-bordered table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama Pegawai</th>
                  <th>Golongan</th>
                 <!--  <th>Pangkat</th> -->
                  <!-- <th>Jabatan</th> -->
                  <th>Unit Kerja</th>   
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1 ;
                foreach($pegawai as $data_pegawai) {
                 ?>
                 <tr>
                  <td><?php echo $no?></td>
                  <td><?php echo $data_pegawai->NIP?></td>
                  <td><?php echo $data_pegawai->nama_pegawai?></td>
                  <td><?php echo $data_pegawai->nama_golongan?></td>
                 <!--  <td><?php echo $data_pegawai->nama_pangkat?></td> -->
                 <!--  <td>Kepala Dinas</td> -->
                  <td><?php echo $data_pegawai->nama_unit_kerja?></td>
                  <td> 
                    <div class="btn-group">
                      <a style="color: white" href="#modalViewData<?php echo $data_pegawai->NIP?>" data-toggle="modal"> 
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View </button>
                      </div> &nbsp;&nbsp;
                    </a>
                    <div class="btn-group">
                      <a style="color: white" href="#modalEditData<?php echo $data_pegawai->NIP?>" data-toggle="modal"> 
                        <button type="button" class="btn btn-warning btn-sm">
                          <i class="fa  fa-pencil-square"></i>&nbsp;Edit &nbsp;</button>  
                        </a> 
                      </div>&nbsp;&nbsp;
                      <div class="btn-group">
                       <button type="button" class="btn btn-danger btn-sm" onclick="hapusData('<?php echo $data_pegawai->NIP?>')"><i class="fa fa-trash"></i>Delete</button> 
                     </div>&nbsp;&nbsp;
                   </td>
                 </tr>
                 <?php
                 $no++;
               }
               ?>
             </tbody>
           </table>
           <!-- modal edit -->
           <?php
           foreach ($pegawai as $data_pegawai) {
            ?>
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalEditData<?php echo $data_pegawai->NIP?>" class="modal fade edit">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Edit Data Pegawai</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal edit" role="form" id="urlEdit<?=$data_pegawai->NIP?>" method="post" action="<?=base_url('pegawai/updateDataPegawai/'.$data_pegawai->NIP)?>">

                      <div class="form-group">

                        <div class="col-lg-12">
                         <label >NIP</label>
                         <input type="text" name="NIP<?= $data_pegawai->NIP ?>" id="NIP<?= $data_pegawai->NIP ?>" class="form-control NIP" placeholder="NIP" value="<?php echo $data_pegawai->NIP ?>" disabled required>
                       </div>
                     </div>
                     <div class="form-group">
                      <div class="col-lg-12">
                        <label> Nama Pegawai</label>
                        <input type="text" name="nama_pegawai<?= $data_pegawai->NIP ?>" id="nama_pegawai<?= $data_pegawai->NIP ?>" class="form-control nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $data_pegawai->nama_pegawai ?>" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-lg-6 col-sm-6"> 
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir<?= $data_pegawai->NIP ?>" id="tempat_lahir<?= $data_pegawai->NIP ?>" class="form-control tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $data_pegawai->tempat_lahir ?>" required>
                      </div>
                      <div class="col-lg-6 col-sm-6">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" name="tanggal_lahir<?= $data_pegawai->NIP ?>" id="tanggal_lahir<?= $data_pegawai->NIP ?>" class="form-control tanggal_lahir" placeholder="yyyy/mm/dd" value="<?php echo $data_pegawai->tanggal_lahir ?>" required>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                     <!--  <div class="col-lg-4 col-sm-4"> 
                        <label>Pangkat</label>
                        <select name="idPangkat<?= $data_pegawai->NIP ?>" id="idPangkat<?= $data_pegawai->NIP ?>" class="form-control idPangkat" value="<?php echo $data_pegawai->nama_pangkat ?>" required>

                          <option disabled="">-- PILIH PANGKAT --</option>
                          <?php 

                          foreach ($pangkat as $data_pangkat) {
                            if ( $data_pegawai->nama_pangkat == $data_pangkat->nama_pangkat ) {

                              echo "<option selected value='$data_pangkat->idPangkat'> $data_pangkat->nama_pangkat </option>";
                              continue;
                            }
                            ?>
                            <option value="<?php echo $data_pangkat->idPangkat ?>"> <?php echo $data_pegawai->nama_pangkat ?></option>
                            <?php 
                          }
                          ?>


                        </select>
                      </div> -->
                      <div class="col-lg-8 col-sm-8">
                        <label>Golongan</label>
                        <select name="idGolongan<?= $data_pegawai->NIP ?>" id="idGolongan<?= $data_pegawai->NIP ?>" class="form-control idGolongan" value="<?php echo $data_pegawai->nama_golongan ?>" required>

                          <option disabled="">-- PILIH GOLONGAN --</option>
                          <?php 

                          foreach ($golongan as $data_golongan) {
                            if ( $data_pegawai->nama_golongan == $data_golongan->nama_golongan ) {

                              echo "<option selected value='$data_golongan->idGolongan'> $data_pegawai->nama_golongan </option>";
                              continue;
                            }
                            ?>
                            <option value="<?php echo $data_golongan->idGolongan ?>"> <?php echo $data_golongan->nama_golongan ?></option>
                            <?php 
                          }
                          ?>


                        </select>
                      </div>
                      <div class="col-lg-4 col-sm-4">
                        <label>Unit Kerja</label>
                        <select name="idUnitKerja<?= $data_pegawai->NIP ?>" id="idUnitKerja<?= $data_pegawai->NIP ?>" class="form-control idUnitKerja" value="<?php echo $data_pegawai->nama_unit_kerja ?>" required>
                          <option disabled="">-- PILIH UNIT KERJA --</option>
                          <?php 

                          foreach ($unit_kerja as $data_unit_kerja) {
                            if ( $data_pegawai->nama_unit_kerja == $data_unit_kerja->nama_unit_kerja ) {
                              echo "string";
                              echo "<option selected value='$data_unit_kerja->idUnitKerja'> $data_pegawai->nama_unit_kerja </option>";
                              continue;
                            }
                            ?>
                            <option value="<?php echo $data_unit_kerja->idUnitKerja ?>"> <?php echo $data_unit_kerja->nama_unit_kerja ?></option>
                            <?php 
                          }
                          ?>

                        </select>
                      </div>
                    </div>
                    <!--    <div id="alert-msg"> </div> -->
                    <div class="alert-msg-edit"></div>
                    <div class="form-group">
                      <div class="col-lg-offset-10 col-lg-offset-10">
                        <button type="submit" class="btn btn-primary edit" name="edit" id="editButton<?= $data_pegawai->NIP ?>" value="edit">Update</button>
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
        <!-- End Modal Edit -->


        <!-- modal view -->
        <?php
        foreach ($pegawai as $data_pegawai) {
          ?>
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalViewData<?php echo $data_pegawai->NIP?>" class="modal fade">
            <div class="modal-dialog" style="width: 50%">
              <div class="box box-primary">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h3 class="modal-title"><?=$data_pegawai->nama_pegawai ?></h3>
                  </div>
                  <div class="modal-body">
                   <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label style="font-weight: bold;">Nomor Induk Pegawai</label>
                        <p><?=$data_pegawai->NIP?></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label style="font-weight: bold;">Tempat Lahir</label>
                        <p><?=$data_pegawai->tempat_lahir?></p>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label style="font-weight: bold;">Tanggal Lahir</label>
                        <p><?= date_indo($data_pegawai->tanggal_lahir) ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label style="font-weight: bold;">Pangkat</label>
                        <p><?=$data_pegawai->nama_pangkat ?></p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label style="font-weight: bold;">Golongan</label>
                        <p><?=$data_pegawai->nama_golongan ?></p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label style="font-weight: bold;">Unit Kerja</label>
                        <p><?=$data_pegawai->nama_unit_kerja ?></p>
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
   <!-- Select2 -->
   <script src="<?php echo base_url('assets/')?>bower_components/select2/dist/js/select2.full.min.js"></script>
   <script src="<?php echo base_url('assets/')?>bower_components/fastclick/lib/fastclick.js"></script>
   <!-- AdminLTE App -->
   <script src="<?php echo base_url('assets/')?>dist/js/adminlte.min.js"></script>
   <!-- Date-picker -->
   <script src="<?php echo base_url('assets/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script src="<?php echo base_url('assets/')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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
   <script src="<?php echo base_url('assets/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
   <!-- bootstrap datepicker -->
<!--    <script src="<?php echo base_url('assets/')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
-->
<script >
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

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
    $('.datepicker1').datepicker({
      autoclose: false
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

  window.setTimeout(function(){
    $(".alert").fadeTo(500,0).slideUp(500, function(){
      $(this).remove();
    })
  },2000);
</script>

</body>
</html>

<script>
 function hapusData(id) {
   // alert(id);
   $.ajax({
    url     : "<?php echo base_url()?>pegawai/ajaxDataPegawai",
    method  : "post",
    data    : {id:id},
    success : function(nama_pegawai) {
      swal({
        title               : "Apakah Anda Yakin?",
        text                : 'Anda Ingin Menghapus Pegawai "'+nama_pegawai+'"?',
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
            window.location.href = "<?php echo base_url()?>pegawai/removeDataPegawai/"+id;
          });
        }
      });
    }
  });
 }
</script>


<script type="text/javascript">

  $('#addButton').click(function() {

   var form_data = {
    NIP:$('#NIP').val(),
    nama_pegawai:$('#nama_pegawai').val(),
    tempat_lahir:$('#tempat_lahir').val(),
    tanggal_lahir:$('#tanggal_lahir').val(),
   // idPangkat:$('#idPangkat').val(),
    idGolongan:$('#idGolongan').val(),
    idUnitKerja:$('#idUnitKerja').val()
  };

  $.ajax({
    url: "<?php echo base_url('pegawai/addDataPegawai'); ?>",
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
          var NIP_edit = document.getElementsByClassName("form-control NIP")[index].id;
          var nama_pegawai_edit = document.getElementsByClassName("form-control nama_pegawai")[index].id;
          var tempat_lahir_edit = document.getElementsByClassName("form-control tempat_lahir")[index].id;
          var tanggal_lahir_edit =document.getElementsByClassName("form-control tanggal_lahir")[index].id;
         // var idPangkat_edit = document.getElementsByClassName("form-control idPangkat")[index].id;
          var idGolongan_edit = document.getElementsByClassName("form-control idGolongan")[index].id;
          var idUnitKerja_edit = document.getElementsByClassName("form-control idUnitKerja")[index].id;
          console.log(tanggal_lahir_edit);
          var b = document.getElementsByClassName("form-horizontal edit")[index].id;
          var url_edit = document.getElementById(b).action;
          console.log(url_edit);
          console.log(nama_pegawai_edit);
          var form_data = {
            NIP: $('#'+NIP_edit).val(),
          //  nama_pegawai: $('#nama_pegawai1232131221').val(),
          nama_pegawai: $('#'+nama_pegawai_edit).val(),
          tempat_lahir: $('#'+tempat_lahir_edit).val(),
          tanggal_lahir: $('#'+tanggal_lahir_edit).val(),
         // idPangkat: $('#'+idPangkat_edit).val(),
          idGolongan: $('#'+idGolongan_edit).val(),
          idUnitKerja: $('#'+idUnitKerja_edit).val(),
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

<script> // buat sidebar active 
var url = window.location;
    // Will only work if string in href matches with location
    $('.treeview-menu a[href="'+ url +'"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
    $('.treeview-menu a').filter(function() {
      return this.href == url;
    }).parent().addClass('active');
  </script>
  <script>
    var url = window.location;
// Will only work if string in href matches with location
$('.sidebar-menu a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('.sidebar-menu a').filter(function() {
  return this.href == url;
}).parent().addClass('active');
</script>






<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
</script>

<script>
  $(function() {
    $('input[name="birthday"]').daterangepicker({
      singleDatePicker: false,
      showDropdowns: false,
      minYear: 1901,
      maxYear: parseInt(moment().format('YYYY'),10)
    }, function(start, end, label) {
      var years = moment().diff(start, 'years');
    // alert("You are " + years + " years old!");
    alert("value" + $('input[name="birthday"]').val())
  });
  });
</script>