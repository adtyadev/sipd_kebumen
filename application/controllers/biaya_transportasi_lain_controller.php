<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class biaya_transportasi_lain_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->model("biaya_transportasi_lain_model");
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['biaya_transportasi_lain']=$this->biaya_transportasi_lain_model->getAllBiayaTransportasiLain()->result();
		$data['golongan']=$this->biaya_transportasi_lain_model->getAllGolongan()->result();
		$data['transportasi']=$this->biaya_transportasi_lain_model->getAllTransportasi()->result();
		$this->load->view('biaya_transportasi_lain',$data);
	}

	function addDataBiayaTransportasiLain(){
		$this->form_validation->set_rules('kelas_transportasi','kelas Transportasi','required|regex_match[/-/]');
		$this->form_validation->set_rules('idGolongan','Nama Golongan','required');
		$this->form_validation->set_rules('idTransportasi','Nama Transportasi','required');
		$this->form_validation->set_rules('kelas_transportasi','kelas Transportasi','required');
		
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$idGolongan=$this->input->post('idGolongan');
			$idTransportasi=$this->input->post('idTransportasi');
			$kelas_transportasi=$this->input->post('kelas_transportasi');
			$idBiayaTransportasiLain=uniqid();
			$input = array(
				'idBiayaTransportasiLain'=>$idBiayaTransportasiLain,
				'idGolongan'=>$idGolongan,
				'idTransportasi'=>$idTransportasi,
				'kelas_transportasi'=>$kelas_transportasi
			);
			$this->biaya_transportasi_lain_model->addDataBiayaTransportasiLain($input);
			$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
			//redirect(base_url('biaya_transportasi_lain/index'));
		}
		
	}

	function updateDataBiayaTransportasiLain($idBiayaTransportasiLain){
		$this->form_validation->set_rules('kelas_transportasi','kelas Transportasi','required|regex_match[/-/]');
		$this->form_validation->set_rules('idGolongan','Nama Golongan','required');
		$this->form_validation->set_rules('idTransportasi','Nama Transportasi','required');
		$this->form_validation->set_rules('kelas_transportasi','kelas Transportasi','required');
		
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$idGolongan=$this->input->post('idGolongan');
			$idTransportasi=$this->input->post('idTransportasi');
			$kelas_transportasi=$this->input->post('kelas_transportasi');
			$input = array(
				'idGolongan'=>$idGolongan,
				'idTransportasi'=>$idTransportasi,
				'kelas_transportasi'=>$kelas_transportasi
			);
			$this->biaya_transportasi_lain_model->updateDataBiayaTransportasiLain($input,'idBiayaTransportasiLain', $idBiayaTransportasiLain);
			$this->session->set_flashdata('message', 'Data Sukses Dirubah');
		//redirect(base_url('biaya_transportasi_lain/index'));
		}
	}

	function removeDataBiayaTransportasiLain($idBiayaTransportasiLain){

		$error_code = $this->biaya_transportasi_lain_model->removeDataBiayaTransportasiLain('idBiayaTransportasiLain', $idBiayaTransportasiLain);
		if ($error_code==0) {
			$this->session->set_flashdata('message', 'Data Sukses Dihabus');
			redirect(base_url('biaya_transportasi_lain/index'));
		} elseif ($error_code==1451) {
			$this->session->set_flashdata('message_error', "Data tidak bisa dihapus [foreign_key]");
			redirect(base_url('biaya_transportasi_lain/index'));

		}
	}

	function ajaxDataBiayaTransportasiLain(){
		$nama_transportasi = '';
		$idBiayaTransportasiMobil = $this->input->post('id');
		$query = $this->db->select('transportasi.nama_transportasi')->from('biaya_transportasi_lain')->join('transportasi','transportasi.idTransportasi=biaya_transportasi_lain.idTransportasi')->where('idBiayaTransportasiLain = "'.$idBiayaTransportasiMobil.'"')->get()->row();
		if ($query == true ) {
			$nama_transportasi .= $query->nama_transportasi;
		}
		echo $nama_transportasi;
	}
}

?>