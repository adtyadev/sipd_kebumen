<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_harian_model extends CI_Model{

	private $_table = "biaya_harian";

	function getAllBiayaHarian() {
		$this->db->select('golongan.nama_golongan, biaya_harian.idGolongan, biaya_harian.jarak_perjalanan, biaya_harian.idBiayaHarian, biaya_harian.wilayah, biaya_harian.jenis_kegiatan, biaya_harian.nominal_biaya_harian');
		$this->db->from('biaya_harian');
		$this->db->join('golongan','golongan.idGolongan=biaya_harian.idGolongan');
		$this->db->order_by('golongan.nama_golongan', 'ASC');
		return $this->db->get();
	}

	function getAllGolongan() {
		$this->db->select('golongan.nama_golongan, golongan.idGolongan');
		$this->db->from('golongan');
		$this->db->order_by('golongan.nama_golongan', 'ASC');
		return $this->db->get();
	}

	function addDataBiayaHarian($input) {
		$this->db->insert($this->_table, $input);
	}

	function updateDataBiayaHarian( $input, $columnWhere, $valueWhere){
		$this->db->where($columnWhere, $valueWhere);
		$this->db->update($this->_table, $input);
	}

	function removeDataBiayaHarian($columnWhere, $valueWhere) {
		$this->db->where($columnWhere, $valueWhere);
		$this->db->delete($this->_table);
	}
}

?>

