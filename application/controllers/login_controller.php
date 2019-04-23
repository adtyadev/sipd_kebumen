<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_controller extends CI_Controller{

  function __construct() {
    parent::__construct();
    $this->load->model('login_model');
    $this->load->library('form_validation');
  }
  function index() {
    if ($this->session->userdata('login') == 'yes') {
      
      redirect(base_url('dashboard/index'));
    }
    else {
      if( $this->input->post('login') == 'login'){
        $idAdmin = $this->input->post('idAdmin');
        $password = $this->input->post('password');
        $cekLogin = $this->login_model->adminLogin($idAdmin,$password)->row();
        if ($cekLogin == true ) {
          $session = array (
            'idAdmin' => $cekLogin->id_admin,
            'namaAdmin' => $cekLogin->nama_admin,
            'jabatan' => $cekLogin->jabatan,
            'login' => 'yes'
          );
          $this->session->set_userdata($session);
          redirect(base_url('dashboard/index'));

        }
        else{
          echo '<script>alert("Username atau Password Salah");window.location.href = "'.base_url().'"</script>';
        }
      } else {
        $this->load->view('login');
      }
    }


  }

  function logout() {
    $this->session->sess_destroy();
    redirect(base_url());
  }


}
