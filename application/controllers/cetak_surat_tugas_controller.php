<?php  
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class cetak_surat_tugas_controller extends CI_Controller{

 function __construct(){
    parent::__construct();  
   // $this->load->model("golongan_model");
}

function laporan_pdf(){

    $data = array(
        "dataku" => array(
            "nama" => "Petani Kode",
            "url" => "http://petanikode.com"
        )
    );

    $this->load->library('pdf');

    //$this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-petanikode.pdf";
    $this->pdf->load_view('cetak_surat_tugas', $data);


}
}


?>
