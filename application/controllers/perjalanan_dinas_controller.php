<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perjalanan_dinas_controller extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model("perjalanan_dinas_model");
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->helper(array('url'));
		if ($this->session->userdata('login') != 'yes') {
			redirect(base_url());
		}
	}

	function index(){
		$data['perjalanan_dinas']=$this->perjalanan_dinas_model->getAllPerjalananDinas()->result();
		$data['pegawai_pengikut']=$this->perjalanan_dinas_model->getPegawaiPengikut()->result();
		$data['pegawai']=$this->perjalanan_dinas_model->getAllPegawai()->result();
		$data['provinsi']=$this->perjalanan_dinas_model->getAllProvinsi()->result();
		//$data['kabupaten']=$this->perjalanan_dinas_model->getAllKabupaten_data()->result();
		// $data['kecamatan']=$this->perjalanan_dinas_model->getAllKecamatan_data()->result();
		// $data['kelurahan']=$this->perjalanan_dinas_model->getAllKelurahan_data()->result();
		$data['transportasi']=$this->perjalanan_dinas_model->getAllTransportasi()->result();
		$data['pejabat_penanda_tangan']=$this->perjalanan_dinas_model->getAllPejabatPenandaTangan()->result();
		$this->load->view('perjalanan_dinas',$data);
	}

	function addDataSPPD(){

	}
	
	function addDataPerjalananDinas(){

		$this->form_validation->set_rules('pegawai_tugas', 'Pegawai Tugas', 'required');
		$this->form_validation->set_rules('pegawai_pengikut[]', 'Pegawai Pengikut', 'required|differs[pegawai_tugas]');
		$this->form_validation->set_rules('kegiatan_perjalanan','Kegiatan Perjalanan', 'required|max_length[100]');
		$this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required|max_length[25]');
		$this->form_validation->set_rules('jarak_perjalanan', 'Jarak Perjalanan', 'required|numeric');
		$this->form_validation->set_rules('idProvinsi', 'Provinsi', 'required|max_length[2]');
		$this->form_validation->set_rules('idKabupaten', 'Kabupaten', 'required|max_length[4]');
		$this->form_validation->set_rules('idKecamatan', 'Kecamatan','required|max_length[6]');
		$this->form_validation->set_rules('idKelurahan','Kelurahan','required|max_length[10]');
		$this->form_validation->set_rules('tanggal_berangkat', 'Tanggal Berangkat','required|regex_match[/-/]');
		$this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required|regex_match[/-/]');
		$this->form_validation->set_rules('lama_perjalanan', 'Lama Perjalanan', 'required|numeric');
		$this->form_validation->set_rules('idTransportasi', 'Transportasi', 'required');
		$this->form_validation->set_rules('idPejabatPenandaTangan', 'Pejabat Penanda Tangan', 'required');

		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$idTransportasi=$this->input->post('idTransportasi');
			$NIP_pegawai_tugas=$this->input->post('pegawai_tugas');
			$idPejabatPenandaTangan=$this->input->post('idPejabatPenandaTangan');
			$idLokasi= $this->input->post('idKelurahan');
			$idLokasiProvinsi=$this->input->post('idProvinsi');

			$idGolongan=$this->perjalanan_dinas_model->getGolonganPegawai($NIP_pegawai_tugas)->row()->idGolongan;
			
			if (($this->perjalanan_dinas_model->getBiayaPenginapan($idGolongan,$idLokasiProvinsi)->num_rows()>0) ){
				$idBiayaPenginapan=$this->perjalanan_dinas_model->getBiayaPenginapan($idGolongan,$idLokasiProvinsi)->row()->idBiayaPenginapan;
			}else $idBiayaPenginapan=NULL;

			
			if (($this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->num_rows()>0)) {
				$idBiayaTransportasiMobil=$this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->row()->idBiayaTransportasiMobil;
			} else $idBiayaTransportasiMobil=NULL;

			
			if (($this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolongan)->num_rows()>0)) {
				$idBiayaTransportasiLain=$this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolongan)->row()->idBiayaTransportasiLain;
			} else $idBiayaTransportasiLain=NULL;


			$jenis_kegiatan=$this->input->post('jenis_kegiatan');
			$idGolongan=$this->perjalanan_dinas_model->getGolonganPegawai($NIP_pegawai_tugas)->row()->idGolongan;
			$jenis_kegiatan=$this->input->post('jenis_kegiatan');
			$idLokasiProvinsi=$this->input->post('idProvinsi');
			$jarak_perjalanan=$this->input->post('jarak_perjalanan');
			
			if (($this->perjalanan_dinas_model->getBiayaHarian($idGolongan,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->num_rows()>0)) {
				$idBiayaHarian=$this->perjalanan_dinas_model->getBiayaHarian($idGolongan,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->row()->idBiayaHarian;
			} else $idBiayaHarian=NULL;

			$idBiayaTambahan=NULL;
			$idPerjalananDinas=uniqid();
			$NIP_pegawai_pengikut=$this->input->post('pegawai_pengikut[]');
			$kegiatan_perjalanan=$this->input->post('kegiatan_perjalanan');
			$alamat_spesifik_tujuan=$this->input->post('alamat_lokasi');
			$tanggal_berangkat=$this->input->post('tanggal_berangkat');
			$tanggal_kembali=$this->input->post('tanggal_kembali');
			$lama_perjalanan=$this->input->post('lama_perjalanan');

			$input = array(
				'idTransportasi'=>$idTransportasi,
				'idPegawaiTugas'=>$NIP_pegawai_tugas,
				'idPejabatPenandaTangan'=>$idPejabatPenandaTangan,
				'idLokasi'=>$idLokasi,
				'idBiayaPenginapan'=>$idBiayaPenginapan,
				'idBiayaTransportasiMobil'=>$idBiayaTransportasiMobil,
				'idBiayaTransportasiLain'=>$idBiayaTransportasiLain,
				'idBiayaHarian'=>$idBiayaHarian,
				'jarak_perjalanan'=>$jarak_perjalanan,
				'idBiayaTambahan'=>$idBiayaTambahan,
				'idPerjalananDinas'=>$idPerjalananDinas,
				'tanggal_berangkat'=>$tanggal_berangkat,
				'tanggal_kembali'=>$tanggal_kembali,
				'lama_perjalanan'=>$lama_perjalanan,
				'kegiatan'=>$kegiatan_perjalanan,
				'jenis_kegiatan'=>$jenis_kegiatan,
				'alamat_spesifik_tujuan'=>$alamat_spesifik_tujuan,


			);
			$this->perjalanan_dinas_model->addDataPerjalananDinas($input);

		// print_r($NIP_pegawai_pengikut);
		// echo count($NIP_pegawai_pengikut);
			$i=0;
			foreach ($NIP_pegawai_pengikut as $data_NIP_pegawai_pengikut) {

				$idGolonganPengikut=$this->perjalanan_dinas_model->getGolonganPegawai($NIP_pegawai_pengikut[$i])->row()->idGolongan;
				

				if (($this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolonganPengikut)->num_rows()>0)) {
					$idBiayaTransportasiLainPengikut=$this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolonganPengikut)->row()->idBiayaTransportasiLain;
				}else $idBiayaTransportasiLainPengikut=NULL;

				
				if (($this->perjalanan_dinas_model->getBiayaHarian($idGolonganPengikut,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->num_rows()>0)) {
					$idBiayaHarianPengikut=$this->perjalanan_dinas_model->getBiayaHarian($idGolonganPengikut,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->row()->idBiayaHarian;
				}else $idBiayaHarianPengikut=NULL;

				
				if (($this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->num_rows()>0)) {
					$idBiayaTransportasiMobilPengikut=$this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->row()->idBiayaTransportasiMobil;
				}else $idBiayaTransportasiMobilPengikut=NULL;


				
				if (($this->perjalanan_dinas_model->getBiayaPenginapan($idGolonganPengikut,$idLokasiProvinsi)->num_rows()>0)) {
					$idBiayaPenginapanPengikut=$this->perjalanan_dinas_model->getBiayaPenginapan($idGolonganPengikut,$idLokasiProvinsi)->row()->idBiayaPenginapan;
				}else $idBiayaPenginapanPengikut=NULL;

				$input = array(
					'idBiayaTransportasiLain'=>$idBiayaTransportasiLainPengikut,
					'idBiayaHarian'=>$idBiayaHarianPengikut,
					'idBiayaTransportasiMobil'=>$idBiayaTransportasiMobilPengikut,
					'idBiayaPenginapan'=>$idBiayaPenginapanPengikut,
					'idBiayaTambahan'=>$idBiayaTambahanPengikut,
					'idPegawaiPengikut'=>$NIP_pegawai_pengikut[$i],
					'idPerjalananDinas'=>$idPerjalananDinas
				);
				$this->perjalanan_dinas_model->addDataPunyaPegawaiPengikut($input);
				$i++;
			}


			$idSPT=uniqid();
			$nomor_spt=NULL;
			$status_cetak_spt="belum";


			$inputSPT = array(
				'idPerjalananDinas'=>$idPerjalananDinas,
				'idSPT'=>$idSPT,
				'nomor_spt'=>$nomor_spt,
				'status_cetak'=>$status_cetak_spt
			);
			$this->perjalanan_dinas_model->addDataSPT($inputSPT);
			$idSPPD=uniqid();
			$nomor_sppd=NULL;
			$mata_anggaran=NULL;
			$keterangan_lain_lain="-";
			$status_cetak_sppd="belum";
			$status_cetak_anggaran="belum";
			$inputSPPD = array(
				'idPerjalananDinas'=>$idPerjalananDinas,
				'idSPPD'=>$idSPPD,
				'nomor_sppd'=>$nomor_sppd,
				'mata_anggaran'=>$mata_anggaran,
				'keterangan_lain_lain'=>$keterangan_lain_lain,
				'status_cetak'=>$status_cetak_sppd,
				'status_cetak_anggaran'=>$status_cetak_anggaran
			);
			$this->perjalanan_dinas_model->addDataSPPD($inputSPPD);

			$this->session->set_flashdata('message', 'Data Sukses Ditambahkan');
		//redirect(base_url('perjalanan_dinas/index'));
		}
		
	}

	function updateDataPerjalananDinas($idPerjalananDinas){
		$this->form_validation->set_rules('pegawai_tugas', 'Pegawai Tugas', 'required');
		$this->form_validation->set_rules('pegawai_pengikut[]', 'Pegawai Pengikut', 'required|differs[pegawai_tugas]');
		$this->form_validation->set_rules('kegiatan_perjalanan','Kegiatan Perjalanan', 'required|max_length[100]');
		$this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required|max_length[25]');
		$this->form_validation->set_rules('jarak_perjalanan', 'Jarak Perjalanan', 'required|numeric');
		$this->form_validation->set_rules('idProvinsi', 'Provinsi', 'required|max_length[2]');
		$this->form_validation->set_rules('idKabupaten', 'Kabupaten', 'required|max_length[4]');
		$this->form_validation->set_rules('idKecamatan', 'Kecamatan','required|max_length[6]');
		$this->form_validation->set_rules('idKelurahan','Kelurahan','required|max_length[10]');
		$this->form_validation->set_rules('tanggal_berangkat', 'Tanggal Berangkat','required|regex_match[/-/]');
		$this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required|regex_match[/-/]');
		$this->form_validation->set_rules('lama_perjalanan', 'Lama Perjalanan', 'required|numeric');
		$this->form_validation->set_rules('idTransportasi', 'Transportasi', 'required');
		$this->form_validation->set_rules('idPejabatPenandaTangan', 'Pejabat Penanda Tangan', 'required');

		if ($this->form_validation->run()==FALSE) {
			echo json_encode(array('status'=>0, 'message' => validation_errors()));
		}
		else{

			$idTransportasi=$this->input->post('idTransportasi');
			$NIP_pegawai_tugas=$this->input->post('pegawai_tugas');
			$idPejabatPenandaTangan=$this->input->post('idPejabatPenandaTangan');
			$idLokasi= $this->input->post('idKelurahan');
			$idLokasiProvinsi=$this->input->post('idProvinsi');

			$idGolongan=$this->perjalanan_dinas_model->getGolonganPegawai($NIP_pegawai_tugas)->row()->idGolongan;
			
			if (($this->perjalanan_dinas_model->getBiayaPenginapan($idGolongan,$idLokasiProvinsi)->num_rows()>0) ){
				$idBiayaPenginapan=$this->perjalanan_dinas_model->getBiayaPenginapan($idGolongan,$idLokasiProvinsi)->row()->idBiayaPenginapan;
			}else $idBiayaPenginapan=NULL;

			
			if (($this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->num_rows()>0)) {
				$idBiayaTransportasiMobil=$this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->row()->idBiayaTransportasiMobil;
			} else $idBiayaTransportasiMobil=NULL;

			
			if (($this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolongan)->num_rows()>0)) {
				$idBiayaTransportasiLain=$this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolongan)->row()->idBiayaTransportasiLain;
			} else $idBiayaTransportasiLain=NULL;

			$jenis_kegiatan=$this->input->post('jenis_kegiatan');
			$idGolongan=$this->perjalanan_dinas_model->getGolonganPegawai($NIP_pegawai_tugas)->row()->idGolongan;
			$idLokasiProvinsi=$this->input->post('idProvinsi');
			$jarak_perjalanan=$this->input->post('jarak_perjalanan');
			
			if (($this->perjalanan_dinas_model->getBiayaHarian($idGolongan,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->num_rows()>0)) {
				$idBiayaHarian=$this->perjalanan_dinas_model->getBiayaHarian($idGolongan,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->row()->idBiayaHarian;
			} else $idBiayaHarian=NULL;


			$idBiayaTambahan=NULL;
			$NIP_pegawai_pengikut=$this->input->post('pegawai_pengikut[]');
			$kegiatan_perjalanan=$this->input->post('kegiatan_perjalanan');
			$alamat_spesifik_tujuan=$this->input->post('alamat_lokasi');
			$tanggal_berangkat=$this->input->post('tanggal_berangkat');
			$tanggal_kembali=$this->input->post('tanggal_kembali');
			$lama_perjalanan=$this->input->post('lama_perjalanan');

			$input = array(
				'idTransportasi'=>$idTransportasi,
				'idPegawaiTugas'=>$NIP_pegawai_tugas,
				'idPejabatPenandaTangan'=>$idPejabatPenandaTangan,
				'idLokasi'=>$idLokasi,
				'idBiayaPenginapan'=>$idBiayaPenginapan,
				'idBiayaTransportasiMobil'=>$idBiayaTransportasiMobil,
				'idBiayaTransportasiLain'=>$idBiayaTransportasiLain,
				'idBiayaHarian'=>$idBiayaHarian,
				'jarak_perjalanan'=>$jarak_perjalanan,
				'idBiayaTambahan'=>$idBiayaTambahan,
				'tanggal_berangkat'=>$tanggal_berangkat,
				'tanggal_kembali'=>$tanggal_kembali,
				'lama_perjalanan'=>$lama_perjalanan,
				'kegiatan'=>$kegiatan_perjalanan,
				'jenis_kegiatan'=>$jenis_kegiatan,
				'alamat_spesifik_tujuan'=>$alamat_spesifik_tujuan,
			);


			$this->perjalanan_dinas_model->updateDataPerjalananDinas($input,"idPerjalananDinas",$idPerjalananDinas);

		 //print_r($NIP_pegawai_pengikut);
		// echo count($NIP_pegawai_pengikut);

			$this->perjalanan_dinas_model->removePegawaiPengikut($idPerjalananDinas);

			$i=0;
			foreach ($NIP_pegawai_pengikut as $data_NIP_pegawai_pengikut) {

				$idGolonganPengikut=$this->perjalanan_dinas_model->getGolonganPegawai($NIP_pegawai_pengikut[$i])->row()->idGolongan;
				

				if (($this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolonganPengikut)->num_rows()>0)) {
					$idBiayaTransportasiLainPengikut=$this->perjalanan_dinas_model->getBiayaTransportasiLain($idTransportasi,$idGolonganPengikut)->row()->idBiayaTransportasiLain;
				}else $idBiayaTransportasiLainPengikut=NULL;

				
				if (($this->perjalanan_dinas_model->getBiayaHarian($idGolonganPengikut,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->num_rows()>0)) {
					$idBiayaHarianPengikut=$this->perjalanan_dinas_model->getBiayaHarian($idGolonganPengikut,$idLokasiProvinsi,$jarak_perjalanan,$jenis_kegiatan)->row()->idBiayaHarian;
				}else $idBiayaHarianPengikut=NULL;

				
				if (($this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->num_rows()>0)) {
					$idBiayaTransportasiMobilPengikut=$this->perjalanan_dinas_model->getBiayaTransportasiMobil($idTransportasi)->row()->idBiayaTransportasiMobil;
				}else $idBiayaTransportasiMobilPengikut=NULL;


				
				if (($this->perjalanan_dinas_model->getBiayaPenginapan($idGolonganPengikut,$idLokasiProvinsi)->num_rows()>0)) {
					$idBiayaPenginapanPengikut=$this->perjalanan_dinas_model->getBiayaPenginapan($idGolonganPengikut,$idLokasiProvinsi)->row()->idBiayaPenginapan;
				}else $idBiayaPenginapanPengikut=NULL;

				$idBiayaTambahanPengikut=NULL;

				$input = array(
					'idBiayaTransportasiLain'=>$idBiayaTransportasiLainPengikut,
					'idBiayaHarian'=>$idBiayaHarianPengikut,
					'idBiayaTransportasiMobil'=>$idBiayaTransportasiMobilPengikut,
					'idBiayaPenginapan'=>$idBiayaPenginapanPengikut,
					'idBiayaTambahan'=>$idBiayaTambahanPengikut,
					'idPegawaiPengikut'=>$NIP_pegawai_pengikut[$i],
					'idPerjalananDinas'=>$idPerjalananDinas
				);

				$this->perjalanan_dinas_model->addDataPunyaPegawaiPengikut($input);
				
				$i++;

			}
			//echo "<script> console.log('cobadulu')</script>";
			echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
			$this->session->set_flashdata('message', "Data berhasil dirubah");
		//redirect(base_url('perjalanan_dinas/index'));
			//echo json_encode(array('status'=>1, 'message' => 'Successfully Submiited'));
		}
	}

	function removeDataPerjalananDinas($idPerjalananDinas){
		$this->perjalanan_dinas_model->removeDataPerjalananDinas('idPerjalananDinas', $idPerjalananDinas);
		$this->session->set_flashdata('message', 'Data Sukses Dihapus');
		redirect(base_url('perjalanan_dinas/index'));
	}

	function ajaxDataPerjalananDinas(){
		$kegiatan_perjalanan = '';
		$idPerjalananDinas = $this->input->post('id');
		$query = $this->db->select('perjalanan_dinas.kegiatan')->from('perjalanan_dinas')->where('idPerjalananDinas = "'.$idPerjalananDinas.'"')->get()->row();
		if ($query == true ) {
			$kegiatan_perjalanan .= $query->kegiatan;
		}
		echo $kegiatan_perjalanan;
	}

	function getData(){
		$modul=$this->input->post('modul');
		$idDataLokasi=$this->input->post('idDataLokasi');
		$idPegawaiPengikut=$this->input->post('idPegawaiPengikut');

		if ($modul=="kabupaten") {
			echo "<option disabled>-- Pilih Kabupaten --</option>";
			$data['kabupaten']=$this->perjalanan_dinas_model->getAllKabupaten($idDataLokasi)->result();
			foreach ($data['kabupaten'] as $data_kabupaten ) {
				$kabupaten=" ";
				$kabupaten="<option class='c-kabupaten' value='$data_kabupaten->idKabupaten'> $data_kabupaten->nama_kabupaten </option>";
				echo $kabupaten ;
				
			}
		}
		elseif ($modul=="kecamatan") {
			echo "<option disabled>-- Pilih kecamatan --</option>";
			$data['kecamatan']=$this->perjalanan_dinas_model->getAllKecamatan($idDataLokasi)->result();
			foreach ($data['kecamatan'] as $data_kecamatan ) {
				$kecamatan=" ";
				$kecamatan="<option class='c-kecamatan' value='$data_kecamatan->idKecamatan'> $data_kecamatan->nama_kecamatan </option>";
				echo $kecamatan;
			}
			
		}
		elseif ($modul=="kelurahan") {
			echo "<option disabled>-- Pilih Kelurahan --</option>";
			$data['kelurahan']=$this->perjalanan_dinas_model->getAllKelurahan($idDataLokasi)->result();
			foreach ($data['kelurahan'] as $data_kelurahan ) {
				$kelurahan=" ";
				$kelurahan="<option class='c-kelurahan' value='$data_kelurahan->idKelurahan'> $data_kelurahan->nama_kelurahan </option>";
				echo $kelurahan;
			}

		}
		elseif ($modul=="cek") {
			//echo $idPegawaiPengikut;
			//print_r($idPegawaiPengikut);
		}
		else {
			echo "Hayoo salah, dicek penulisan besar kecilnya sama typo!!";
		}
	}

}
?>