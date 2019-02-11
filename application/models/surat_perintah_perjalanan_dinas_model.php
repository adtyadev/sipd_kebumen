<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class surat_perintah_perjalanan_dinas_model extends CI_Model{

    private $_table="sppd";
    public function getAllSuratPerintahPerjalananDinas(){
        $this->db->select('sppd.idPerjalananDinas, sppd.idSPPD, sppd.nomor_sppd, sppd.mata_anggaran, sppd.keterangan_lain_lain,sppd.status_cetak');
        $this->db->from($this->_table);
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
        $this->db->select('perjalanan_dinas.idPegawaiTugas, pegawai.nama_pegawai, lokasi_kelurahan.nama_kelurahan, perjalanan_dinas.kegiatan, transportasi.nama_transportasi, transportasi.keterangan,perjalanan_dinas.tanggal_berangkat, perjalanan_dinas.tanggal_kembali, perjalanan_dinas.lama_perjalanan, perjalanan_dinas.idPerjalananDinas, perjalanan_dinas.alamat_spesifik_tujuan, perjalanan_dinas.tanggal_acara, perjalanan_dinas.idPejabatPenandaTangan, pejabat_penanda_tangan.NIP, pejabat_penanda_tangan.keterangan_jabatan');
        $this->db->FROM('perjalanan_dinas');
        $this->db->join('pegawai','perjalanan_dinas.idPegawaiTugas=pegawai.NIP');
        $this->db->join('lokasi_kelurahan','perjalanan_dinas.idLokasi = lokasi_kelurahan.idKelurahan');
        $this->db->join('transportasi','perjalanan_dinas.idTransportasi = transportasi.idTransportasi');
        $this->db->join('pejabat_penanda_tangan', 'perjalanan_dinas.idPejabatPenandaTangan = pejabat_penanda_tangan.idPejabatPenandaTangan');
        return $this->db->get();

    }

    function getPegawaiPengikut(){
        $this->db->select('punya_pegawai_pengikut.idPegawaiPengikut, pegawai.nama_pegawai, punya_pegawai_pengikut.idPerjalananDinas');
        $this->db->FROM('punya_pegawai_pengikut');
        $this->db->join('pegawai','pegawai.NIP=punya_pegawai_pengikut.idPegawaiPengikut');
       // $this->db->WHERE('punya_pegawai_pengikut.idPerjalananDinas="perjalanan1"');
        return $this->db->get();
    }

    function updateDataSuratPerintahPerjalananDinas( $input, $columnWhere, $valueWhere){
        $this->db->where($columnWhere, $valueWhere);
        $this->db->update($this->_table, $input);
    }

    function removeDataSuratPerintahPerjalananDinas($columnWhere, $valueWhere) {
        $this->db->where($columnWhere, $valueWhere);
        $this->db->delete($this->_table);
    }

}

?>