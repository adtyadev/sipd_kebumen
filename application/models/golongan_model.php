<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class golongan_model extends CI_Model{

	private $_table = "golongan";

	function getAllGolongan() {
		$this->db->select('golongan.nama_golongan, golongan.idGolongan');
		$this->db->from('golongan');
		$this->db->order_by('golongan.nama_golongan', 'ASC');
		return $this->db->get();
	}

	function addDataGolongan($input) {
		$this->db->insert($this->_table, $input);
	}

	function updateDataGolongan( $input, $columnWhere, $valueWhere){
		$this->db->where($columnWhere, $valueWhere);
		$this->db->update($this->_table, $input);
	}

	function removeDataGolongan($where, $nilaiWhere) {
		$this->db->where($where, $nilaiWhere);
		$this->db->delete($this->_table);
	}
}

?>

