<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_tugas_controller extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("surat_tugas_model");
    }

    function index(){
    	
    	$data['pegawai']=$this->surat_tugas_model->getAllPegawai()->result();
        $data['perjalanan_dinas']=$this->surat_tugas_model->getAllPerjalananDinas()->result();
        $data['pegawai_pengikut']=$this->surat_tugas_model->getPegawaiPengikut()->result();
        $data['surat_tugas']=$this->surat_tugas_model->getAllSuratTugas()->result();
        $this->load->view('surat_tugas',$data);
    }

    function updateDataSuratTugas($idSPT){
        $nomor_spt = $this->input->post('nomor_spt');
        $status_cetak=$this->input->post('status_cetak');
        $input = array(
            'nomor_spt'=>$nomor_spt,
            'status_cetak'=>$status_cetak
        );
        $this->surat_tugas_model->updateDataSuratTugas($input,'idSPT', $idSPT);
        $this->session->set_flashdata('message', 'Data Sukses Dirubah');
        redirect(base_url('surat_tugas/index'));
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