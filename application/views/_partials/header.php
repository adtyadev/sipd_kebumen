<!-- Logo -->
<a href="<?php echo base_url('dashboard/index')?>" class="logo" style="background-color:#2C5380 ">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>SIPD</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg" style="background:#2C5380;">
    <b>SIPD</b> Kab KEBUMEN<br>
  </span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" style="background: linear-gradient(to left,#2af598,#2C5380);">
  <!-- background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%); -->
  <!-- background: linear-gradient(to left,#6a9113,#2C5364); -->

  <!-- background-image: linear-gradient(to top, #09203f 0%, #537895 100%); -->
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <!-- Notifications: style can be found in dropdown.less -->
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img style=" max-width: 100px " src="<?php echo base_url('assets/')?>dist/img/kebumen.png" class="user-image" alt="User Image">
          <span class="hidden-xs" style="font-weight: bold; text-transform: capitalize"><?=$this->session->userdata('nama_admin')?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img style=" max-width: 120px " src="<?php echo base_url('assets/')?>dist/img/kebumen.png" class="img-circle" alt="User Image">

            <p>
              <?=$this->session->userdata('namaUser')?>
              <small>Administrator</small>
            </p>
          </li>
          <!-- Menu Body -->
          <!-- <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div> -->
            <!-- /.row -->
            <!-- </li> -->
            <!-- Menu Footer-->
            <li class="user-footer">
            <!-- <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div> -->
            
            <div class="col-md-12 text-center">
              <a href="<?=base_url('login_controller/logout')?>" class="btn btn-default btn-flat">Sign out</a>
            </div>
            
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
    </ul>
  </div>
</nav>
