<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class perjalanan_dinas_model extends CI_Model{
	
    private $_tablePerjalananDinas='perjalanan_dinas';
    private $_tablePunyaPegawaiPengikut='punya_pegawai_pengikut';
    private $_tableSPT='spt';
    private $_tableSPPD='sppd';

    function getAllPegawai(){
        $this->db->select('pegawai.NIP, pegawai.nama_pegawai,golongan.nama_golongan, pangkat.nama_pangkat, unit_kerja.nama_unit_kerja');
        $this->db->from('pegawai');
        $this->db->join('pangkat', 'pegawai.idPangkat = pangkat.idPangkat');
        $this->db->join('golongan','pegawai.idGolongan = golongan.idGolongan');
        $this->db->join('unit_kerja','pegawai.idUnitKerja = unit_kerja.idUnitKerja');
        return $this->db->get();
    }

    function getAllPerjalananDinas(){
       $this->db->select('pegawai.nama_pegawai, lokasi_kelurahan.nama_kelurahan, perjalanan_dinas.kegiatan, transportasi.nama_transportasi, perjalanan_dinas.tanggal_berangkat, perjalanan_dinas.tanggal_kembali, perjalanan_dinas.lama_perjalanan, perjalanan_dinas.idPerjalananDinas');
       $this->db->FROM('perjalanan_dinas');
       $this->db->join('pegawai','perjalanan_dinas.idPegawaiTugas=pegawai.NIP');
       $this->db->join('lokasi_kelurahan','perjalanan_dinas.idLokasi = lokasi_kelurahan.idKelurahan');
       $this->db->join('transportasi','perjalanan_dinas.idTransportasi = transportasi.idTransportasi');
       return $this->db->get();

   }

   function getPegawaiPengikut(){
    $this->db->select('pegawai.nama_pegawai, punya_pegawai_pengikut.idPerjalananDinas');
    $this->db->FROM('punya_pegawai_pengikut');
    $this->db->join('pegawai','pegawai.NIP=punya_pegawai_pengikut.idPegawaiPengikut');
       // $this->db->WHERE('punya_pegawai_pengikut.idPerjalananDinas="perjalanan1"');
    return $this->db->get();
}

function getAllTransportasi(){
    $this->db->select('transportasi.idTransportasi, transportasi.nama_transportasi');
    $this->db->from('transportasi');
    return $this->db->get();
}

function getAllPejabatPenandaTangan(){
    $this->db->select('pejabat_penanda_tangan.idPejabatPenandaTangan, pegawai.nama_pegawai');
    $this->db->from('pejabat_penanda_tangan');
    $this->db->join('pegawai', 'pejabat_penanda_tangan.NIP=pegawai.NIP');
    return $this->db->get();

}

function getAllProvinsi(){
    $this->db->select('*');
    $this->db->from('lokasi_provinsi');
    return $this->db->get();
}

function getAllKabupaten($idProvinsi){
    $this->db->distinct();
    $this->db->select('lokasi_kabupaten.idKabupaten,lokasi_kabupaten.nama_kabupaten');
    $this->db->from('lokasi_kabupaten,lokasi_provinsi');
    $this->db->where('lokasi_kabupaten.idProvinsi = "'.$idProvinsi.'"');
    return $this->db->get();
    //return $idProvinsi;
}

function getAllKecamatan($idKabupaten){
    $this->db->distinct();
    $this->db->select('lokasi_kecamatan.idKecamatan,lokasi_kecamatan.nama_kecamatan');
    $this->db->from('lokasi_kecamatan,lokasi_kabupaten');
    $this->db->where('lokasi_kecamatan.idKabupaten= "'.$idKabupaten.'"');
    
    return $this->db->get();
}

function getAllKelurahan($idKecamatan){
    $kelurahan="";
    $this->db->distinct();
    $this->db->select('lokasi_kelurahan.idKelurahan, lokasi_kelurahan.nama_kelurahan');
    $this->db->from('lokasi_kelurahan,lokasi_kecamatan');
    $this->db->where(' lokasi_kelurahan.idKecamatan ="' .$idKecamatan.'"' );
    
    return $this->db->get();
}

function addDataPerjalananDinas($input) {
    $this->db->insert($this->_tablePerjalananDinas, $input);
}

function addDataPunyaPegawaiPengikut($input){
    $this->db->insert($this->_tablePunyaPegawaiPengikut, $input);
}

function addDataSPT($inputSPT){
    $this->db->insert($this->_tableSPT,$inputSPT);
}

function addDataSPPD($inputSPPD){
    $this->db->insert($this->_tableSPPD,$inputSPPD);
}

function updateDataPerjalananDinas( $input, $columnWhere, $valueWhere){
    $this->db->where($columnWhere, $valueWhere);
    $this->db->update($this->_table, $input);
}

function removeDataPerjalananDinas($columnWhere, $valueWhere) {
    $this->db->where($columnWhere, $valueWhere);
    $this->db->delete($this->_tablePerjalananDinas);
}

function getGolonganPegawai($NIP){
    $this->db->select('pegawai.idGolongan');
    $this->db->from('pegawai');
    $this->db->where('pegawai.NIP',$NIP);
    return $this->db->get();

}

function getBiayaPenginapan($idGolongan,$idLokasiProvinsi){
    $this->db->select('biaya_penginapan.idBiayaPenginapan,biaya_penginapan.nominal_biaya_penginapan');
    $this->db->from('biaya_penginapan');
    $this->db->where('idLokasiProvinsi',$idLokasiProvinsi);
    $this->db->where('idGolongan',$idGolongan);
    return $this->db->get();
}

function getBiayaTransportasiMobil($idTransportasi){    
    $this->db->select('biaya_transportasi_mobil_motor.idBiayaTransportasiMobil, biaya_transportasi_mobil_motor.nominal_biaya_mobil');
    $this->db->from('biaya_transportasi_mobil_motor');
    $this->db->where('idTransportasi',$idTransportasi);
    return $this->db->get();
}

function getBiayaTransportasiLain($idTransportasi,$idGolongan){
    $this->db->select('biaya_transportasi_lain.idBiayaTransportasiLain, biaya_transportasi_lain.kelas_transportasi');
    $this->db->from('biaya_transportasi_lain');
    $this->db->where('biaya_transportasi_lain.idGolongan',$idGolongan);
    $this->db->where('biaya_transportasi_lain.idTransportasi',$idTransportasi);
    return $this->db->get();
}

function getBiayaHarian($idGolongan,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan){

    if ((int)$jarak_perjalanan<2) {
     $jarak_perjalanan=1;   
 }
 elseif (2<=(int)$jarak_perjalanan AND (int)$jarak_perjalanan<=10) {
    $jarak_perjalanan=10;  
}
elseif (11<=(int)$jarak_perjalanan AND (int)$jarak_perjalanan<=20) {
    $jarak_perjalanan=20;
}
elseif ((int)$jarak_perjalanan>20) {
    $jarak_perjalanan=30;
}

if ((int)$jarak_perjalanan==30) {

   if((int)$idLokasiProvinsi==34 ){
    $wilayah="jogja";
} 
elseif((int)$idLokasiProvinsi==33){
    $wilayah="jawa_tengah";
}
elseif((int)$idLokasiProvinsi==31){
    $wilayah="jakarta";
}
elseif((int)$idLokasiProvinsi==35 || (int)$idLokasiProvinsi==32 || (int)$idLokasiProvinsi==36){
    $wilayah="jawa";
}
else{
    $wilayah="luar_jawa";
}

$this->db->select('biaya_harian.nominal_biaya_harian, biaya_harian.idBiayaHarian');
$this->db->from('biaya_harian');
$this->db->where('biaya_harian.idGolongan',$idGolongan);
$this->db->where('biaya_harian.wilayah',$wilayah);
  //  $this->db->where('biaya_harian.idLokasiProvinsi',$idLokasiProvinsi);
$this->db->where('biaya_harian.jarak_perjalanan',$jarak_perjalanan);
$this->db->where('biaya_harian.jenis_kegiatan',$jenis_kegiatan);
return $this->db->get();  
}
else{
    $this->db->select('biaya_harian.nominal_biaya_harian, biaya_harian.idBiayaHarian');
    $this->db->from('biaya_harian');
    $this->db->where('biaya_harian.idGolongan',$idGolongan);
    $this->db->where('biaya_harian.wilayah',"kebumen");
  //  $this->db->where('biaya_harian.idLokasiProvinsi',$idLokasiProvinsi);
    $this->db->where('biaya_harian.jarak_perjalanan',$jarak_perjalanan);
    $this->db->where('biaya_harian.jenis_kegiatan',$jenis_kegiatan);
    return $this->db->get();    
}


}

}

?>