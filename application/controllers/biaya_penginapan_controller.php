<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class biaya_penginapan_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->library('form_validation');
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
		$this->form_validation->set_rules('nominal_biaya_penginapan','Nominal Biaya Penginapan','required|numeric');
		$this->form_validation->set_rules('idGolongan', 'Nama golongan', 'required');
		$this->form_validation->set_rules('idProvinsi', 'Nama provinsi', 'required');
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
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
			//redirect(base_url('biaya_penginapan/index'));
		}

	}

	function updateDataBiayaPenginapan($idBiayaPenginapan){
		$this->form_validation->set_rules('nominal_biaya_penginapan','Nominal Biaya Penginapan','required|numeric');
		$this->form_validation->set_rules('idGolongan', 'Nama golongan', 'required');
		$this->form_validation->set_rules('idProvinsi', 'Nama provinsi', 'required');
		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
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
		//redirect(base_url('biaya_penginapan/index'));
		}
	}

	function removeDataBiayaPenginapan($idBiayaPenginapan){
		
		$error_code = $this->biaya_penginapan_model->removeDataBiayaPenginapan('idBiayaPenginapan', $idBiayaPenginapan);
		if ($error_code==0) {
			$this->session->set_flashdata('message', 'Data Sukses Dihabus');
			redirect(base_url('biaya_penginapan/index'));
		} elseif ($error_code==1451) {
			$this->session->set_flashdata('message_error', "Data tidak bisa dihapus [foreign_key]");
			redirect(base_url('biaya_penginapan/index'));
		}

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