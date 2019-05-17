<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_transportasi_lain_model extends CI_Model{

	private $_table = "biaya_transportasi_lain";

	function getAllBiayaTransportasiLain() {
		$this->db->select('transportasi.nama_transportasi, transportasi.idTransportasi,biaya_transportasi_lain.idBiayaTransportasiLain, biaya_transportasi_lain.kelas_transportasi, golongan.nama_golongan, biaya_transportasi_lain.idGolongan');
		$this->db->from('biaya_transportasi_lain');
		$this->db->join('transportasi','transportasi.idTransportasi=biaya_transportasi_lain.idTransportasi');
		$this->db->join('golongan','golongan.idGolongan=biaya_transportasi_lain.idGolongan');
		$this->db->order_by('transportasi.nama_transportasi', 'ASC');
		return $this->db->get();
	}

	function getAllTransportasi() {
		$this->db->select('transportasi.nama_transportasi, transportasi.idTransportasi, transportasi.jenis_transportasi');
		$this->db->from('transportasi');
		$this->db->order_by('transportasi.nama_transportasi', 'ASC');
		return $this->db->get();
	}

	function getAllGolongan() {
		$this->db->select('golongan.nama_golongan, golongan.idGolongan');
		$this->db->from('golongan');
		$this->db->order_by('golongan.nama_golongan', 'ASC');
		return $this->db->get();
	}

	function addDataBiayaTransportasiLain($input) {
		$this->db->insert($this->_table, $input);
	}

	function updateDataBiayaTransportasiLain( $input, $columnWhere, $valueWhere){
		$this->db->where($columnWhere, $valueWhere);
		$this->db->update($this->_table, $input);
	}

	function removeDataBiayaTransportasiLain($columnWhere, $valueWhere) {
		$this->db->where($columnWhere, $valueWhere);
		$this->db->delete($this->_table);
		return $this->db->error()['code'];
	}
}

?>

