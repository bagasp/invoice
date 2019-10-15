<?php
class Addxsy_model extends CI_Model {
 
        public $kodepesanan;
 
    public function __construct()
    {
        $this->load->database();
    }
 
    public function cekkodebarang()
    {
        $query = $this->db->query("SELECT MAX(kodepesanan) as kodepesanan from addxsy");
        $hasil = $query->row();
        return $hasil->kodepesanan;
    }
 
    public function simpan()
    {
        $this->kodepesanan    = $_POST['kodepesanan'];
        $this->namaitem    = $_POST['namaitem'];
        $this->kode_item    = $_POST['kode_item'];
        $this->hargajual    = $_POST['hargajual'];


        $this->db->insert('addxsy', $this);
    }
    function get_data_barang_bykode($namaitem){
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
		return $this->db->get("barangs")->result();
	   }
}