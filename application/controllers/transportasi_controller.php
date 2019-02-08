<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class transportasi_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->model("transportasi_model");
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['transportasi']=$this->transportasi_model->getAllTransportasi()->result();
		$this->load->view('transportasi',$data);
	}

	function addDataTransportasi(){
		$nama_transportasi=$this->input->post('nama_transportasi');
		$jenis_transportasi=$this->input->post('jenis_transportasi');
		$idTransportasi=uniqid();
		$input = array(
			'idTransportasi'=>$idTransportasi,
			'nama_transportasi'=>$nama_transportasi,
			'jenis_transportasi'=>$jenis_transportasi
		);
		$this->transportasi_model->addDataTransportasi($input);
		$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
		redirect(base_url('transportasi/index'));
	}

	function updateDataTransportasi($idTransportasi){
		$nama_transportasi = $this->input->post('nama_transportasi');
		$jenis_transportasi=$this->input->post('jenis_transportasi');
		$input = array(
			'nama_transportasi'=>$nama_transportasi,
			'jenis_transportasi'=>$jenis_transportasi
		);
		$this->transportasi_model->updateDataTransportasi($input,'idTransportasi', $idTransportasi);
		$this->session->set_flashdata('message', 'Data Sukses Dirubah');
		redirect(base_url('transportasi/index'));
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