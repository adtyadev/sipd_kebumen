<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class biaya_penginapan_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->model("biaya_penginapan_model");
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['biaya_penginapan']=$this->biaya_penginapan_model->getAllBiayaPenginapan()->result();
		$data['golongan']=$this->biaya_penginapan_model->getAllGolongan()->result();
		$data['provinsi']=$this->biaya_penginapan_model->getAllProvinsi()->result();
		$this->load->view('biaya_penginapan',$data);
	}

	function addDataBiayaPenginapan(){
		$idGolongan=$this->input->post('idGolongan');
		$idProvinsi=$this->input->post('idProvinsi');
		$nominal_biaya_penginapan=$this->input->post('nominal_biaya_penginapan');
		$idBiayaPenginapan=uniqid();
		$input = array(
			'idBiayaPenginapan'=>$idBiayaPenginapan,
			'idGolongan'=>$idGolongan,
			'idLokasiProvinsi'=>$idProvinsi,
			'nominal_biaya_penginapan'=>$nominal_biaya_penginapan
		);
		$this->biaya_penginapan_model->addDataBiayaPenginapan($input);
		$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
		redirect(base_url('biaya_penginapan/index'));
	}

	function updateDataBiayaPenginapan($idBiayaPenginapan){
		$idGolongan=$this->input->post('idGolongan');
		$idProvinsi=$this->input->post('idProvinsi');
		$nominal_biaya_penginapan=$this->input->post('nominal_biaya_penginapan');
		$input = array(
			'idGolongan'=>$idGolongan,
			'idLokasiProvinsi'=>$idProvinsi,
			'nominal_biaya_penginapan'=>$nominal_biaya_penginapan
		);
		$this->biaya_penginapan_model->updateDataBiayaPenginapan($input,'idBiayaPenginapan', $idBiayaPenginapan);
		$this->session->set_flashdata('message', 'Data Sukses Dirubah');
		redirect(base_url('biaya_penginapan/index'));
	}

	function removeDataBiayaPenginapan($idBiayaPenginapan){
		$this->biaya_penginapan_model->removeDataBiayaPenginapan('idBiayaPenginapan', $idBiayaPenginapan);
		$this->session->set_flashdata('message', 'Data Sukses Dihabus');
		redirect(base_url('biaya_penginapan/index'));
	}

	function ajaxDataBiayaPenginapan(){
		$idGolongan = '';
		$idBiayaPenginapan = $this->input->post('id');
		$query = $this->db->select('biaya_penginapan.idGolongan')->from('biaya_penginapan')->where('idBiayaPenginapan = "'.$idBiayaPenginapan.'"')->get()->row();
		if ($query == true ) {
			$idGolongan .= $query->idGolongan;
		}
		echo $idGolongan;
	}
}

?>