<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_perjalanan_pegawai_controller extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("biaya_perjalanan_pegawai_model");
        if ($this->session->userdata('login') != 'yes') {
            redirect(base_url());
        }
    }

    function index(){
    	
    	$data['pegawai']=$this->biaya_perjalanan_pegawai_model->getAllPegawai()->result();
        $data['perjalanan_dinas']=$this->biaya_perjalanan_pegawai_model->getAllPerjalananDinas()->result();
        $data['pegawai_pengikut']=$this->biaya_perjalanan_pegawai_model->getPegawaiPengikut()->result();
        $data['surat_perintah_perjalanan_dinas']=$this->biaya_perjalanan_pegawai_model->getAllSuratPerintahPerjalananDinas()->result();
        $data['biaya_harian']=$this->biaya_perjalanan_pegawai_model->getAllBiayaHarian()->result();
        $data['biaya_penginapan']=$this->biaya_perjalanan_pegawai_model->getAllBiayaPenginapan()->result();
        $data['biaya_tambahan_lain']=$this->biaya_perjalanan_pegawai_model->getAllBiayaTambahanLain()->result();
        $data['biaya_transportasi_lain']=$this->biaya_perjalanan_pegawai_model->getAllBiayaTransportasiLain()->result();
        $data['biaya_trasnportasi_mobil_motor']=$this->biaya_perjalanan_pegawai_model->getAllBiayaTransportasiMobilMotor()->result();
        $this->load->view('biaya_perjalanan_pegawai',$data);
        
    }

    function cetakAnggaran(){
        $this->load->view('');
    }

    function updateDataBiayaPerjalananPegawais($idSPPD){
        $idBiayaPenginapan=$this->input->post('idBiayaPenginapan');
        $idBiayaTransportasiMobil=$this->input->post('idBiayaTransportasiMobil');
        $idBiayaTransportasiLain=$this->input->post('idBiayaTransportasiLain');
        $idBiayaHarian=$this->input->post('idBiayaHarian');
        $idBiayaTambahan=$this->input->post('idBiayaTambahan');
        $input = array(
            'idBiayaPenginapan'=>$idBiayaPenginapan,
            'idBiayaTransportasiMobil'=>$idBiayaTransportasiMobil,
            'idBiayaTransportasiLain'=>$idBiayaTransportasiLain,
            'idBiayaHarian'=>$idBiayaHarian,
            'idBiayaTambahan'=>$idBiayaTambahan
        );
        $this->biaya_perjalanan_pegawai_model->updateDataBiayaPerjalananPegawai($input,'idSPPD', $idSPPD);
        $this->session->set_flashdata('message', 'Data Sukses Dirubah');
        redirect(base_url('biaya_perjalanan_pegawai/index'));
    }

    function removeDataTransportasi($idTransportasi){
        $this->transportasi_model->removeDataTransportasi('idTransportasi', $idTransportasi);
        $this->session->set_flashdata('message', 'Data Sukses Dihabus');
        redirect(base_url('transportasi/index'));
    }

    function ajaxDataTransportasi(){
        $nama_transportasi = '';
        $idTransportasi = $this->input->post('id');
        $query = $this->db->select('transportasi.nama_transportasi')->from('transportasi')->where('idTransportasi = "'.$idTransportasi.'"')->get()->row();
        if ($query == true ) {
            $nama_transportasi .= $query->nama_transportasi;
        }
        echo $nama_transportasi;
    }

}

?>