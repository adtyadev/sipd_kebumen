<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawai_controller extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model("pegawai_model");
		$this->load->helper('security');
		$this->load->library('form_validation');
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data_pegawai['pegawai'] = $this->pegawai_model->getAllPegawai()->result();
		$data_pegawai['pangkat'] = $this->pegawai_model->getAllPangkat()->result();
		$data_pegawai['golongan'] = $this->pegawai_model->getAllGolongan()->result();
		$data_pegawai['unit_kerja'] = $this->pegawai_model->getAllUnitKerja()->result();
		$this->load->view('pegawai', $data_pegawai);
	}

	function addDataPegawai(){

		$this->form_validation->set_rules('NIP','Nomor Induk Pegawai','required|numeric|exact_length[18]');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir', 'required|alpha|max_length[25]');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required|alpha_numeric_spaces|max_length[50]');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|regex_match[/-/]');

		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$NIP=$this->input->post('NIP');
			$nama_pegawai=$this->input->post('nama_pegawai');
			$tempat_lahir=$this->input->post('tempat_lahir');
			$tanggal_lahir=$this->input->post('tanggal_lahir');
			$idPangkat=$this->input->post('idPangkat');
			$idGolongan=$this->input->post('idGolongan');
			$idUnitKerja=$this->input->post('idUnitKerja');
			$input = array(
				'NIP'=>$NIP,
				'nama_pegawai'=>$nama_pegawai,
				'tempat_lahir'=>$tempat_lahir,
				'tanggal_lahir'=>$tanggal_lahir,
				'idPangkat'=>$idPangkat,
				'idGolongan'=>$idGolongan,
				'idUnitKerja'=>$idUnitKerja
			);
			$this->pegawai_model->addDataPegawai($input);
			$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
			//redirect(base_url('pegawai/index'));	
		}
		
	}

	function updateDataPegawai($NIP){
		$nama_pegawai=$this->input->post('nama_pegawai');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tanggal_lahir=$this->input->post('tanggal_lahir');
		$idPangkat=$this->input->post('idPangkat');
		$idGolongan=$this->input->post('idGolongan');
		$idUnitKerja=$this->input->post('idUnitKerja');
		$input = array(
			'nama_pegawai'=>$nama_pegawai,
			'tempat_lahir'=>$tempat_lahir,
			'tanggal_lahir'=>$tanggal_lahir,
			'idPangkat'=>$idPangkat,
			'idGolongan'=>$idGolongan,
			'idUnitKerja'=>$idUnitKerja
		);
		$this->pegawai_model->updateDataPegawai($input,'NIP', $NIP);
		//$this->session->set_flashdata('message', $NIP);
		$this->session->set_flashdata('message', 'Data Sukses Dirubah');
		redirect(base_url('pegawai/index'));
	}

	function removeDataPegawai($NIP){
		$this->pegawai_model->removeDataPegawai('NIP', $NIP);
		$this->session->set_flashdata('message', 'Data Sukses Dihabus');
		redirect(base_url('pegawai/index'));
	}

	function ajaxDataPegawai(){

		$nama_pegawai = '';
		$NIP = $this->input->post('id');
		$query = $this->db->select('pegawai.nama_pegawai')->from('pegawai')->where('pegawai.NIP = "'.$NIP.'"')->get()->row();
		if ($query == true ) {
			$nama_pegawai .= $query->nama_pegawai;
		}
		echo $nama_pegawai;
	}
}


?>