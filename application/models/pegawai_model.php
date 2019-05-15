<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pegawai_model extends CI_Model 
{
    private $_table = "pegawai";
    public function getAllPegawai(){
        $this->db->select('pegawai.NIP, pegawai.nama_pegawai,golongan.nama_golongan, pangkat.nama_pangkat, unit_kerja.nama_unit_kerja, pegawai.tempat_lahir, pegawai.tanggal_lahir');
        $this->db->from('pegawai');
        $this->db->join('pangkat', 'pegawai.idPangkat = pangkat.idPangkat');
        $this->db->join('golongan','pegawai.idGolongan = golongan.idGolongan');
        $this->db->join("unit_kerja",'pegawai.idUnitKerja = unit_kerja.idUnitKerja');
        return $this->db->get();
    }

    function getAllUnitKerja(){
        $this->db->select('unit_kerja.idUnitKerja, unit_kerja.nama_unit_kerja');
        $this->db->from('unit_kerja');
        return $this->db->get();
    }

    function getAllGolongan(){
        $this->db->select('golongan.idGolongan, golongan.nama_golongan');
        $this->db->from('golongan');
        return $this->db->get();
    }

    function getAllPangkat(){
        $this->db->select('pangkat.idPangkat, pangkat.nama_pangkat');
        $this->db->from('pangkat');
        return $this->db->get();
    }

    function getAllJabatan(){
        $this->db->select('jabatan.idJabatan, jabatan,nama_jabatan');
        $this->db->from('jabatan');
        return $this->db->get();
    }

    function addDataPegawai($input) {
        $this->db->insert($this->_table, $input);
    }

    function updateDataPegawai( $input, $columnWhere, $valueWhere){
        $this->db->where($columnWhere, $valueWhere);
        $this->db->update($this->_table, $input);
    }

    function removeDataPegawai($columnWhere, $valueWhere) {
        $this->db->where($columnWhere, $valueWhere);
        $this->db->delete($this->_table);
       //print_r($this->db->error()['code']);
        return $this->db->error()['code'];
    }
}