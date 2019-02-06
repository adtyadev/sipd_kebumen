<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class biaya_perjalanan_pegawai_model extends CI_Model{

    private $_table="sppd";
    public function getAllSuratPerintahPerjalananDinas(){
        $this->db->select('sppd.idPerjalananDinas, sppd.idSPPD, sppd.nomor_sppd, sppd.mata_anggaran, sppd.keterangan_lain_lain,sppd.status_cetak, sppd.status_cetak_anggaran');
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

    public function getAllBiayaHarian(){
        $this->db->select('biaya_harian.idBiayaHarian, biaya_harian.nominal_biaya_harian');
        $this->db->from('biaya_harian');
        return $this->db->get();
    }

    public function getAllBiayaPenginapan(){
        $this->db->select('biaya_penginapan.idBiayaPenginapan, biaya_penginapan.nominal_biaya_penginapan');
        $this->db->from('biaya_penginapan');
        return $this->db->get();
    }

    public function getAllBiayaTambahanLain(){
        $this->db->select('biaya_tambahan_lain.idBiayaTambahan, biaya_tambahan_lain.keperluan, biaya_tambahan_lain.nominal_biaya_tambahan');
        $this->db->from('biaya_tambahan_lain');
        return $this->db->get();
    }

    public function getAllBiayaTransportasiLain(){
        $this->db->select('biaya_transportasi_lain.idBiayaTransportasiLain, biaya_transportasi_lain.kelas_transportasi');
        $this->db->from('biaya_transportasi_lain');
        return $this->db->get();
    }

    public function getAllBiayaTransportasiMobilMotor(){
        $this->db->select('biaya_transportasi_mobil_motor.idBiayaTransportasiMobil, biaya_transportasi_mobil_motor.nominal_biaya_mobil,biaya_transportasi_mobil_motor.kilometer');
        $this->db->from('biaya_transportasi_mobil_motor');
        return $this->db->get();
    }



    function getAllPerjalananDinas(){
    	$this->db->select('perjalanan_dinas.idPegawaiTugas, pegawai.nama_pegawai, lokasi_kelurahan.nama_kelurahan, perjalanan_dinas.kegiatan, transportasi.nama_transportasi, perjalanan_dinas.tanggal_berangkat, perjalanan_dinas.tanggal_kembali, perjalanan_dinas.lama_perjalanan,perjalanan_dinas.jarak_perjalanan, perjalanan_dinas.idPerjalananDinas, ,biaya_harian.idBiayaHarian, biaya_harian.nominal_biaya_harian,biaya_penginapan.idBiayaPenginapan, biaya_penginapan.nominal_biaya_penginapan,biaya_tambahan_lain.idBiayaTambahan, biaya_tambahan_lain.keperluan, biaya_tambahan_lain.nominal_biaya_tambahan,biaya_transportasi_lain.idBiayaTransportasiLain, biaya_transportasi_lain.kelas_transportasi,biaya_transportasi_mobil_motor.idBiayaTransportasiMobil, biaya_transportasi_mobil_motor.nominal_biaya_mobil,biaya_transportasi_mobil_motor.kilometer');
    	$this->db->FROM('perjalanan_dinas');
    	$this->db->join('pegawai','perjalanan_dinas.idPegawaiTugas=pegawai.NIP');
    	$this->db->join('lokasi_kelurahan','perjalanan_dinas.idLokasi = lokasi_kelurahan.idKelurahan');
    	$this->db->join('transportasi','perjalanan_dinas.idTransportasi = transportasi.idTransportasi');
        $this->db->join('biaya_harian', 'perjalanan_dinas.idBiayaHarian=biaya_harian.idBiayaHarian','left');
        $this->db->join('biaya_penginapan','perjalanan_dinas.idBiayaPenginapan=biaya_penginapan.idBiayaPenginapan','left');
        $this->db->join('biaya_tambahan_lain','perjalanan_dinas.idBiayaTambahan=biaya_tambahan_lain.idBiayaTambahan','left');
        $this->db->join('biaya_transportasi_lain','perjalanan_dinas.idBiayaTransportasiLain=biaya_transportasi_lain.idBiayaTransportasiLain','left');
        $this->db->join('biaya_transportasi_mobil_motor','perjalanan_dinas.idBiayaTransportasiMobil=biaya_transportasi_mobil_motor.idBiayaTransportasiMobil','left');
        return $this->db->get();

    }

    function getPegawaiPengikut(){
        $this->db->distinct();
        $this->db->select('punya_pegawai_pengikut.idPegawaiPengikut, pegawai.nama_pegawai, punya_pegawai_pengikut.idPerjalananDinas, biaya_harian.idBiayaHarian, biaya_harian.nominal_biaya_harian,biaya_penginapan.idBiayaPenginapan, biaya_penginapan.nominal_biaya_penginapan,biaya_tambahan_lain.idBiayaTambahan, biaya_tambahan_lain.keperluan, biaya_tambahan_lain.nominal_biaya_tambahan,biaya_transportasi_lain.idBiayaTransportasiLain, biaya_transportasi_lain.kelas_transportasi,biaya_transportasi_mobil_motor.idBiayaTransportasiMobil, biaya_transportasi_mobil_motor.nominal_biaya_mobil,biaya_transportasi_mobil_motor.kilometer');
        $this->db->FROM('punya_pegawai_pengikut');
        $this->db->join('pegawai','pegawai.NIP=punya_pegawai_pengikut.idPegawaiPengikut');
        $this->db->join('biaya_harian', 'punya_pegawai_pengikut.idBiayaHarian=biaya_harian.idBiayaHarian','left');
        $this->db->join('biaya_penginapan','punya_pegawai_pengikut.idBiayaPenginapan=biaya_penginapan.idBiayaPenginapan','left');
        $this->db->join('biaya_tambahan_lain','punya_pegawai_pengikut.idBiayaTambahan=biaya_tambahan_lain.idBiayaTambahan','left');
        $this->db->join('biaya_transportasi_lain','punya_pegawai_pengikut.idBiayaTransportasiLain=biaya_transportasi_lain.idBiayaTransportasiLain','left');
        $this->db->join('biaya_transportasi_mobil_motor','punya_pegawai_pengikut.idBiayaTransportasiMobil=biaya_transportasi_mobil_motor.idBiayaTransportasiMobil','left');
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