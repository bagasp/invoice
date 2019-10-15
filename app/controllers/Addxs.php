<?php
class Addxs extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model('Addxs_model');
    }
 
    public function index()
    {
        $dariDB = $this->Addxs_model->cekkodebarang();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 4);
        $kodeBarangSekarang = $nourut + 1;
        $data = array('kodepesanan' => $kodeBarangSekarang);
       $data['barangs'] = $this->Addxs_model->gets();
        $data['customers'] = $this->Addxs_model->get();
        $this->load->view("addxs", $data);
    }
 
    public function list(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$id = $this->input->post('namacustomer');
		
    }
    function get_barang(){
		$namacustomer=$this->input->post('namacustomer');
		$data=$this->Addxs_model->get_data_barang_bykode($namacustomer);
		echo json_encode($data);
	}
	
	  function get_barangg(){
		$namaitem=$this->input->post('namaitem');
		$data=$this->Addxs_model->get_data_barangg_bykode($namaitem);
		echo json_encode($data);
	}
    public function simpan()
    {
        $kodepesanan = $this->input->post('kodepesanan');
        $namacustomer = $this->input->post('namacustomer');
        $kodecustomer = $this->input->post('kodecustomer');
        $alamat = $this->input->post('alamat');
        $nohp = $this->input->post('nohp');
		$namaitem = $this->input->post('namaitem');
		$kode_item = $this->input->post('kode_item');
		$hargajual = $this->input->post('hargajual');
		$jumlah = $this->input->post('jumlah');
		
 
		$data = array(
            'kodepesanan' => $kodepesanan,
            'namacustomer' => $namacustomer,
            'kodecustomer' => $kodecustomer,
            'alamat' => $alamat,
            'nohp' => $nohp,
			'namaitem' => $namaitem,
			'kode_item' => $kode_item,
			'hargajual' => $hargajual,
			'jumlah' => $jumlah,
		
        );
		$this->Addxs_model->simpan($data,'addxs');
		redirect('pesanan');
    }
}