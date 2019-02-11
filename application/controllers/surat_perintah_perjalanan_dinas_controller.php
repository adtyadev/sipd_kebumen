<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_perintah_perjalanan_dinas_controller extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("surat_perintah_perjalanan_dinas_model");
        if ($this->session->userdata('login') != 'yes') {
            redirect(base_url());
        }
    }

    function index(){
    	
    	$data['pegawai']=$this->surat_perintah_perjalanan_dinas_model->getAllPegawai()->result();
        $data['perjalanan_dinas']=$this->surat_perintah_perjalanan_dinas_model->getAllPerjalananDinas()->result();
        $data['pegawai_pengikut']=$this->surat_perintah_perjalanan_dinas_model->getPegawaiPengikut()->result();
        $data['surat_perintah_perjalanan_dinas']=$this->surat_perintah_perjalanan_dinas_model->getAllSuratPerintahPerjalananDinas()->result();
        $this->load->view('surat_perintah_perjalanan_dinas',$data);
    }

    function cetakSuratPerintahPerjalananDinas($idSPPD){
        $data['pegawai']=$this->surat_perintah_perjalanan_dinas_model->getAllPegawai()->result();
        $data['perjalanan_dinas']=$this->surat_perintah_perjalanan_dinas_model->getAllPerjalananDinas()->result();
        $data['pegawai_pengikut']=$this->surat_perintah_perjalanan_dinas_model->getPegawaiPengikut()->result();
        $data['surat_perintah_perjalanan_dinas']=$this->surat_perintah_perjalanan_dinas_model->getAllSuratPerintahPerjalananDinas()->result();
        $data['idSPPD']=$idSPPD;
        $this->load->view('cetak_surat_perintah_perjalanan_dinas',$data);
    }

    function updateDataSuratPerintahPerjalananDinas($idSPPD){
        $nomor_sppd = $this->input->post('nomor_sppd');
        $mata_anggaran=$this->input->post('mata_anggaran');
        $keterangan_lain_lain=$this->input->post('keterangan_lain_lain');
        $status_cetak=$this->input->post('status_cetak');
        $input = array(
            'nomor_sppd'=>$nomor_sppd,
            'mata_anggaran'=>$mata_anggaran,
            'keterangan_lain_lain'=>$keterangan_lain_lain,
            'status_cetak'=>$status_cetak
        );
        $this->surat_perintah_perjalanan_dinas_model->updateDataSuratPerintahPerjalananDinas($input,'idSPPD', $idSPPD);
        $this->session->set_flashdata('message', 'Data Sukses Dirubah');
        redirect(base_url('surat_perintah_perjalanan_dinas/index'));
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