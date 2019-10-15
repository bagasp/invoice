<?php
class Addxsy extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model('addxsy_model');
    }
 
    public function index()
    {
        $dariDB = $this->addxsy_model->cekkodebarang();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 4);
        $kodebarangSekarang = $nourut + 1;
        $data = array('kodepesanan' => $kodebarangSekarang);
       
        $data['barangs'] = $this->addxsy_model->get();
        $this->load->view("addxsy", $data);
    }
 
    public function list(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$id = $this->input->post('namaitem');
		
    }
    function get_barang(){
		$namaitem=$this->input->post('namaitem');
		$data=$this->addxsy_model->get_data_barang_bykode($namaitem);
		echo json_encode($data);
	}
    public function simpan()
    {
        $kodepesanan = $this->input->post('kodepesanan');
        $namaitem = $this->input->post('namaitem');
        $kode_item = $this->input->post('kode_item');
        $hargajual = $this->input->post('hargajual');
		
 
		$data = array(
            'kodepesanan' => $kodepesanan,
            'namaitem' => $namaitem,
            'kode_item' => $kode_item,
            'hargajual' => $hargajual,

		
        );
		$this->addxsy_model->simpan($data,'addxsy');
		redirect('addxsy');
    }
}