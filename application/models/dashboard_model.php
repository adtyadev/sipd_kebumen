<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_model extends CI_Model {
	private $_tableSPPD = "sppd";
	private $_tableSPJ = "spj";

	function getCountSPPD_belum_cetak() {
		$this->db->select('count(idSPPD) jumlah_belum_cetak');
		$this->db->from($this->_tableSPPD);
		$this->db->where("status_cetak='belum'");
		return $this->db->get();
	}

	function getCountSPPD_sudah_cetak() {
		$this->db->select('count(idSPPD) jumlah_sudah_cetak');
		$this->db->from($this->_tableSPPD);
		$this->db->where("status_cetak='sudah'");
		return $this->db->get();
	}

	function getCountSPJ_group_by_sppd() {
		$this->db->select('count(idSppd) jumlah_sudah_cetak');
		$this->db->from($this->_tableSPJ);
		$this->db->group_by('idSppd');
		return $this->db->get();
	}

}