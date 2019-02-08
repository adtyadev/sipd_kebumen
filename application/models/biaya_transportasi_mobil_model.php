<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_transportasi_mobil_model extends CI_Model{

	private $_table = "biaya_transportasi_mobil_motor";

	function getAllBiayaTransportasiMobil() {
		$this->db->select('transportasi.nama_transportasi, transportasi.idTransportasi, biaya_transportasi_mobil_motor.kilometer, biaya_transportasi_mobil_motor.idBiayaTransportasiMobil, biaya_transportasi_mobil_motor.mesin_cc, biaya_transportasi_mobil_motor.jenis_bbm, biaya_transportasi_mobil_motor.nominal_biaya_mobil');
		$this->db->from('biaya_transportasi_mobil_motor');
		$this->db->join('transportasi','transportasi.idTransportasi=biaya_transportasi_mobil_motor.idTransportasi');
		$this->db->order_by('transportasi.nama_transportasi', 'ASC');
		return $this->db->get();
	}

	function getAllTransportasiMobil() {
		$this->db->select('transportasi.nama_transportasi, transportasi.idTransportasi, transportasi.jenis_transportasi');
		$this->db->from('transportasi');
		$this->db->order_by('transportasi.nama_transportasi', 'ASC');
		return $this->db->get();
	}

	function addDataBiayaTransportasiMobil($input) {
		$this->db->insert($this->_table, $input);
	}

	function updateDataBiayaTransportasiMobil( $input, $columnWhere, $valueWhere){
		$this->db->where($columnWhere, $valueWhere);
		$this->db->update($this->_table, $input);
	}

	function removeDataBiayaTransportasiMobil($columnWhere, $valueWhere) {
		$this->db->where($columnWhere, $valueWhere);
		$this->db->delete($this->_table);
	}
}

?>

