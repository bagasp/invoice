<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model','barang');
	}

	public function index()
    {
		$this->load->model('barang_model');
        $dariDB = $this->barang_model->cekkodebarang();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 4);
        $kodeBarangSekarang = $nourut + 1;
		$data = array('kode_item' => $kodeBarangSekarang);
		$data['data'] = $data;
        $this->load->view("barang_view", $data);
    }

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->barang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $barang) {
			$no++;
			$row = array();
			$row[] = $barang->kode_item;
			$row[] = $barang->namaitem;
			$row[] = $barang->uom;
			$row[] = $barang->hargajual;
		
			if($barang->photo)
				$row[] = '<a href="'.base_url('upload/'.$barang->photo).'" target="_blank"><img src="'.base_url('upload/'.$barang->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_barang('."'".$barang->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_barang('."'".$barang->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->barang->count_all(),
						"recordsFiltered" => $this->barang->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->barang->get_by_id($id);
			echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'kode_item' => $this->input->post('kode_item'),
				'namaitem' => $this->input->post('namaitem'),
				'uom' => $this->input->post('uom'),
				'hargajual' => $this->input->post('hargajual'),
			
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->barang->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kode_item' => $this->input->post('kode_item'),
				'namaitem' => $this->input->post('namaitem'),
				'uom' => $this->input->post('uom'),
				'hargajual' => $this->input->post('hargajual'),
			
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$barang = $this->barang->get_by_id($this->input->post('id'));
			if(file_exists('upload/'.$barang->photo) && $barang->photo)
				unlink('upload/'.$barang->photo);

			$data['photo'] = $upload;
		}

		$this->barang->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$barang = $this->barang->get_by_id($id);
		if(file_exists('upload/'.$barang->photo) && $barang->photo)
			unlink('upload/'.$barang->photo);
		
		$this->barang->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kode_item') == '')
		{
			$data['inputerror'][] = 'kode_item';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('namaitem') == '')
		{
			$data['inputerror'][] = 'namaitem';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

	

		if($this->input->post('uom') == '')
		{
			$data['inputerror'][] = 'uom';
			$data['error_string'][] = 'Please select uom';
			$data['status'] = FALSE;
		}

		if($this->input->post('hargajual') == '')
		{
			$data['inputerror'][] = 'hargajual';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
