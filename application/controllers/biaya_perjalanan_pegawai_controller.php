<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_perjalanan_pegawai_controller extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("biaya_perjalanan_pegawai_model");
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
        $this->biaya_perjalanan_pegawai_model->updateDataSuratPerintahPerjalananDinas($input,'idSPPD', $idSPPD);
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