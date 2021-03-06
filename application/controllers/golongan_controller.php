<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class golongan_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->model("golongan_model");
		$this->load->helper('security');
		$this->load->library("form_validation");
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['golongan']=$this->golongan_model->getAllGolongan()->result();
		$this->load->view('golongan',$data);
	}

	function addDataGolongan(){
		$this->form_validation->set_rules('nama_golongan', 'Nama Golongan', 'required|is_unique[golongan.nama_golongan]',
			array(
				'is_unique'     => 'This %s already exists.'
			));
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$nama_golongan=$this->input->post('nama_golongan');
			$idGolongan=uniqid();
			$input = array(
				'idGolongan'=>$idGolongan,
				'nama_golongan'=>$nama_golongan
			);
			$this->golongan_model->addDataGolongan($input);
			$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
			//redirect(base_url('golongan/index'));	
		}
		
	}

	function updateDataGolongan($idGolongan){
		$this->form_validation->set_rules('nama_golongan', 'Nama Golongan', 'required');
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$nama_golongan = $this->input->post('nama_golongan');
			$input = array(
				'nama_golongan'=>$nama_golongan);
			$this->golongan_model->updateDataGolongan($input,'idGolongan', $idGolongan);
			$this->session->set_flashdata('message', 'Data Sukses Dirubah');
			//redirect(base_url('golongan/index'));
		}
	}

	function removeDataGolongan($idGolongan){
		$error_code = $this->golongan_model->removeDataGolongan('idGolongan', $idGolongan);
		if ($error_code==0) {
			$this->session->set_flashdata('message', 'Data Sukses Dihabus');
			redirect(base_url('golongan/index'));
		} elseif ($error_code==1451) {
			$this->session->set_flashdata('message_error', "Data tidak bisa dihapus [foreign_key]");
			redirect(base_url('golongan/index'));
		}
	}

	function ajaxDataGolongan(){
		$nama_golongan = '';
		$idGolongan = $this->input->post('id');
		$query = $this->db->select('golongan.nama_golongan')->from('golongan')->where('idGolongan = "'.$idGolongan.'"')->get()->row();
		if ($query == true ) {
			$nama_golongan .= $query->nama_golongan;
		}
		echo $nama_golongan;
	}
}

?>