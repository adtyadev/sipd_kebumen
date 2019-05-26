<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class transportasi_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();	
		$this->load->model("transportasi_model");
		$this->load->library('form_validation');
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['transportasi']=$this->transportasi_model->getAllTransportasi()->result();
		$this->load->view('transportasi',$data);
	}

	function addDataTransportasi(){
		$this->form_validation->set_rules('nama_transportasi', 'Nama Transportasi', 'required|max_length[15]|is_unique[transportasi.nama_transportasi]',
			array(
				'is_unique'     => 'This %s already exists.'
			));
		$this->form_validation->set_rules('jenis_transportasi', 'Jenis Transportasi','required|alpha|max_length[15]');
		$this->form_validation->set_rules('keterangan','Keterangan Transportasi', 'required');

		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$nama_transportasi=$this->input->post('nama_transportasi');
			$jenis_transportasi=$this->input->post('jenis_transportasi');
			$keterangan=$this->input->post('keterangan');
			$idTransportasi=uniqid();
			$input = array(
				'idTransportasi'=>$idTransportasi,
				'nama_transportasi'=>$nama_transportasi,
				'jenis_transportasi'=>$jenis_transportasi,
				'keterangan'=>$keterangan
			);
			$this->transportasi_model->addDataTransportasi($input);
			$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');

			//redirect(base_url('transportasi/index'));
		}

		
	}

	function updateDataTransportasi($idTransportasi){
		$this->form_validation->set_rules('nama_transportasi', 'Nama Transportasi', 'required|max_length[15]');
		$this->form_validation->set_rules('jenis_transportasi', 'Jenis Transportasi','required|alpha|max_length[15]');
		$this->form_validation->set_rules('keterangan','Keterangan Transportasi', 'required');

		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$nama_transportasi = $this->input->post('nama_transportasi');
			$jenis_transportasi=$this->input->post('jenis_transportasi');
			$keterangan=$this->input->post('keterangan');
			$input = array(
				'nama_transportasi'=>$nama_transportasi,
				'jenis_transportasi'=>$jenis_transportasi,
				'keterangan'=>$keterangan
			);
			$this->transportasi_model->updateDataTransportasi($input,'idTransportasi', $idTransportasi);
			$this->session->set_flashdata('message', 'Data Sukses Dirubah');
			//redirect(base_url('transportasi/index'));
		}
	}

	function removeDataTransportasi($idTransportasi){
		$error_code = $this->transportasi_model->removeDataTransportasi('idTransportasi', $idTransportasi);
		if ($error_code==0) {
			$this->session->set_flashdata('message', 'Data Sukses Dihapus');
			redirect(base_url('transportasi/index'));
		} elseif ($error_code==1451) {
			$this->session->set_flashdata('message_error', "Data tidak bisa dihapus [foreign_key]");
			redirect(base_url('transportasi/index'));
		}
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