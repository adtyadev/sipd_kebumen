<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class biaya_transportasi_mobil_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->library('form_validation');
		$this->load->model("biaya_transportasi_mobil_model");
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['biaya_transportasi_mobil']=$this->biaya_transportasi_mobil_model->getAllBiayaTransportasiMobil()->result();
		$data['transportasi']=$this->biaya_transportasi_mobil_model->getAllTransportasiMobil()->result();
		$this->load->view('biaya_transportasi_mobil',$data);
	}

	function addDataBiayaTransportasiMobil(){
		$this->form_validation->set_rules('nominal_biaya_mobil','Nominal Biaya Mobil','required|numeric');
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$idTransportasi=$this->input->post('idTransportasi');
			$kilometer=$this->input->post('kilometer');
			$mesin_cc=$this->input->post('mesin_cc');
			$jenis_bbm=$this->input->post('jenis_bbm');
			$nominal_biaya_mobil=$this->input->post('nominal_biaya_mobil');
			$idBiayaTransportasiMobil=uniqid();
			$input = array(
				'idBiayaTransportasiMobil'=>$idBiayaTransportasiMobil,
				'kilometer'=>$kilometer,
				'idTransportasi'=>$idTransportasi,
				'mesin_cc'=>$mesin_cc,
				'jenis_bbm'=>$jenis_bbm,
				'nominal_biaya_mobil'=>$nominal_biaya_mobil
			);
			$this->biaya_transportasi_mobil_model->addDataBiayaTransportasiMobil($input);
			$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
			redirect(base_url('biaya_transportasi_mobil/index'));
		}
		
	}

	function updateDataBiayaTransportasiMobil($idBiayaTransportasiMobil){
		$idTransportasi=$this->input->post('idTransportasi');
		$kilometer=$this->input->post('kilometer');
		$mesin_cc=$this->input->post('mesin_cc');
		$jenis_bbm=$this->input->post('jenis_bbm');
		$nominal_biaya_mobil=$this->input->post('nominal_biaya_mobil');
		$input = array(
			'idTransportasi'=>$idTransportasi,
			'kilometer'=>$kilometer,
			'mesin_cc'=>$mesin_cc,
			'jenis_bbm'=>$jenis_bbm,
			'nominal_biaya_mobil'=>$nominal_biaya_mobil
		);
		$this->biaya_transportasi_mobil_model->updateDataBiayaTransportasiMobil($input,'idBiayaTransportasiMobil', $idBiayaTransportasiMobil);
		$this->session->set_flashdata('message', 'Data Sukses Dirubah');
		redirect(base_url('biaya_transportasi_mobil/index'));
	}

	function removeDataBiayaTransportasiMobil($idBiayaTransportasiMobil){
		$this->biaya_transportasi_mobil_model->removeDataBiayaTransportasiMobil('idBiayaTransportasiMobil', $idBiayaTransportasiMobil);
		$this->session->set_flashdata('message', 'Data Sukses Dihabus');
		redirect(base_url('biaya_transportasi_mobil/index'));
	}

	function ajaxDataBiayaTransportasiMobil(){
		$nama_transportasi = '';
		$idBiayaTransportasiMobil = $this->input->post('id');
		$query = $this->db->select('transportasi.nama_transportasi')->from('biaya_transportasi_mobil_motor')->join('transportasi','transportasi.idTransportasi=biaya_transportasi_mobil_motor.idTransportasi')->where('idBiayaTransportasiMobil = "'.$idBiayaTransportasiMobil.'"')->get()->row();
		if ($query == true ) {
			$nama_transportasi .= $query->nama_transportasi;
		}
		echo $nama_transportasi;
	}
}

?>