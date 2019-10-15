<?php
class Addxs_model extends CI_Model {
 
        public $kodepesanan;
 
    public function __construct()
    {
        $this->load->database();
    }
 
    public function cekkodebarang()
    {
        $query = $this->db->query("SELECT MAX(kodepesanan) as kodepesanan from addxs");
        $hasil = $query->row();
        return $hasil->kodepesanan;
    }

 
    public function simpan()
    {
        $this->kodepesanan    = $_POST['kodepesanan'];
        $this->namacustomer    = $_POST['namacustomer'];
        $this->kodecustomer    = $_POST['kodecustomer'];
        $this->alamat    = $_POST['alamat'];
        $this->nohp    = $_POST['nohp'];
		$this->namaitem    = $_POST['namaitem'];
		$this->kode_item    = $_POST['kode_item'];
		$this->hargajual    = $_POST['hargajual'];
		$this->jumlah    = $_POST['jumlah'];

        $this->db->insert('addxs', $this);
    }
    function get_data_barang_bykode($namacustomer){
		$hsl=$this->db->query("SELECT * FROM customers WHERE namacustomer='$namacustomer'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'namacustomer' => $data->namacustomer,
					'kodecustomer' => $data->kodecustomer,
					'alamat' => $data->alamat,
					'nohp' => $data->nohp,
					);
			}
		}
		return $hasil;
	}
	
	function get_data_barangg_bykode($namaitem){
		$hsl=$this->db->query("SELECT * FROM barangs WHERE namaitem='$namaitem'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'namaitem' => $data->namaitem,
					'kode_item' => $data->kode_item,
					'hargajual' => $data->hargajual,
					);
			}
		}
		return $hasil;
	}
	
    public function get(){
		return $this->db->get("customers")->result();
	   }
	   
	   
    public function gets(){
		return $this->db->get("barangs")->result();
	   }
}