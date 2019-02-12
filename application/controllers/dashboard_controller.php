<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_controller extends CI_Controller{
  function __construct() {
    parent::__construct();
    $this->load->model("dashboard_model");
    if ($this->session->userdata('login') != 'yes') {
      redirect(base_url());
    }
  }

  function index() {
   $data['belum_cetak']    = $this->dashboard_model->getCountSPPD_belum_cetak()->row()->jumlah_belum_cetak;
   $data['sudah_cetak']  = $this->dashboard_model->getCountSPPD_sudah_cetak()->row()->jumlah_sudah_cetak;
   if (isset($this->dashboard_model->getCountSPJ_group_by_sppd()->row()->jumlah_sudah_spj)) {
    $data['selesai_spj'] = $this->dashboard_model->getCountSPJ_group_by_sppd()->row()->jumlah_sudah_spj;
  }
  else $data['selesai_spj']=0;
  $this->load->view('dashboard', $data);

}

}
