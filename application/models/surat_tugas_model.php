<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class surat_tugas_model extends CI_Model{

    private $_table="spt";
    public function getAllSuratTugas(){
        $this->db->select('spt.idSPT, spt.nomor_spt, spt.status_cetak, spt.idPerjalananDinas');
        $this->db->from('spt');
        return $this->db->get();
    }

    public function getAllPegawai(){
        $this->db->select('pegawai.NIP, pegawai.nama_pegawai,golongan.nama_golongan, pangkat.nama_pangkat, unit_kerja.nama_unit_kerja');
        $this->db->from('pegawai');
        $this->db->join('pangkat', 'pegawai.idPangkat = pangkat.idPangkat');
        $this->db->join('golongan','pegawai.idGolongan = golongan.idGolongan');
        $this->db->join('unit_kerja','pegawai.idUnitKerja = unit_kerja.idUnitKerja');
        return $this->db->get();
    }

    function getAllPerjalananDinas(){
    	$this->db->select('perjalanan_dinas.idPegawaiTugas, pegawai.nama_pegawai, lokasi_kelurahan.nama_kelurahan, perjalanan_dinas.kegiatan, transportasi.nama_transportasi, perjalanan_dinas.tanggal_berangkat, perjalanan_dinas.tanggal_kembali, perjalanan_dinas.lama_perjalanan, perjalanan_dinas.idPerjalananDinas');
    	$this->db->FROM('perjalanan_dinas');
    	$this->db->join('pegawai','perjalanan_dinas.idPegawaiTugas=pegawai.NIP');
    	$this->db->join('lokasi_kelurahan','perjalanan_dinas.idLokasi = lokasi_kelurahan.idKelurahan');
    	$this->db->join('transportasi','perjalanan_dinas.idTransportasi = transportasi.idTransportasi');
    	return $this->db->get();

    }

    function getPegawaiPengikut(){
        $this->db->select('punya_pegawai_pengikut.idPegawaiPengikut, pegawai.nama_pegawai, punya_pegawai_pengikut.idPerjalananDinas');
        $this->db->FROM('punya_pegawai_pengikut');
        $this->db->join('pegawai','pegawai.NIP=punya_pegawai_pengikut.idPegawaiPengikut');
       // $this->db->WHERE('punya_pegawai_pengikut.idPerjalananDinas="perjalanan1"');
        return $this->db->get();
    }

    function updateDataSuratTugas( $input, $columnWhere, $valueWhere){
        $this->db->where($columnWhere, $valueWhere);
        $this->db->update($this->_table, $input);
    }

    function removeDataSuratTugas($columnWhere, $valueWhere) {
        $this->db->where($columnWhere, $valueWhere);
        $this->db->delete($this->_table);
    }

}

?>