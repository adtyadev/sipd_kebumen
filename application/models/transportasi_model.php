<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transportasi_model extends CI_Model{

	private $_table = "transportasi";

	function getAllTransportasi() {
		$this->db->select('transportasi.nama_transportasi, transportasi.idTransportasi, transportasi.jenis_transportasi, transportasi.keterangan');
		$this->db->from('transportasi');
		$this->db->order_by('transportasi.jenis_transportasi', 'ASC');
		return $this->db->get();
	}

	function addDataTransportasi($input) {
		$this->db->insert($this->_table, $input);
	}

	function updateDataTransportasi( $input, $columnWhere, $valueWhere){
		$this->db->where($columnWhere, $valueWhere);
		$this->db->update($this->_table, $input);
	}

	function removeDataTransportasi($columnWhere, $valueWhere) {
		$this->db->where($columnWhere, $valueWhere);
		$this->db->delete($this->_table);
		return $this->db->error()['code'];
	}
}

?>

