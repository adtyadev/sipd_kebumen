<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class biaya_penginapan_model extends CI_Model{

	private $_table = "biaya_penginapan";

	function getAllBiayaPenginapan() {
		$this->db->select('golongan.nama_golongan, biaya_penginapan.idGolongan, biaya_penginapan.idBiayaPenginapan, lokasi_provinsi.nama_provinsi, biaya_penginapan.nominal_biaya_penginapan');
		$this->db->from('biaya_penginapan');
		$this->db->join('golongan','golongan.idGolongan=biaya_penginapan.idGolongan');
		$this->db->join('lokasi_provinsi','lokasi_provinsi.idProvinsi=biaya_penginapan.idLokasiProvinsi');
		$this->db->order_by('lokasi_provinsi.nama_provinsi', 'ASC');
		return $this->db->get();
	}

	function getAllGolongan() {
		$this->db->select('golongan.nama_golongan, golongan.idGolongan');
		$this->db->from('golongan');
		$this->db->order_by('golongan.nama_golongan', 'ASC');
		return $this->db->get();
	}

	function getAllProvinsi(){
		$this->db->select('lokasi_provinsi.idProvinsi,lokasi_provinsi.nama_provinsi');
		$this->db->from('lokasi_provinsi');
		return $this->db->get();
	}

	function addDataBiayaPenginapan($input) {
		$this->db->insert($this->_table, $input);
	}

	function updateDataBiayaPenginapan( $input, $columnWhere, $valueWhere){
		$this->db->where($columnWhere, $valueWhere);
		$this->db->update($this->_table, $input);
	}

	function removeDataBiayaPenginapan($columnWhere, $valueWhere) {
		$this->db->where($columnWhere, $valueWhere);
		$this->db->delete($this->_table);
	}
}

?>

