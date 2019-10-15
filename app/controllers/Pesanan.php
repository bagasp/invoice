<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pesanan_model','pesanan');
	}
	public function index(){    
		$this->data['customers'] = $this->pesanan_model->get();
		$this->load->view('pesanan', $this->data);
	  
		$this->load->helper('url');
	}


	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->pesanan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pesanan) {
			$no++;
			$row = array();
			$row[] = $pesanan->kodepesanan;
			$row[] = $pesanan->namacustomer;
			$row[] = $pesanan->kodecustomer;
			$row[] = $pesanan->alamat;
			$row[] = $pesanan->nohp;
			$row[] = $pesanan->namaitem;
			$row[] = $pesanan->kode_item;
			$row[] = $pesanan->hargajual;
			$row[] = $pesanan->jumlah;
			
			$row[] = '<a class="btn btn-sm btn-primary" href="faktur" title="Buat" onclick="buat_faktur('."'".$pesanan->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Buat Faktur</a>
			<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pesanan('."'".$pesanan->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pesanan('."'".$pesanan->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pesanan->count_all(),
						"recordsFiltered" => $this->pesanan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pesanan->get_by_id($id);
		
			echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'kodepesanan' => $this->input->post('kodepesanan'),
				'namacustomer' => $this->input->post('namacustomer'),
				'kodecustomer' => $this->input->post('kodecustomer'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'namaitem' => $this->input->post('namaitem'),
				'kode_item' => $this->input->post('kode_item'),
				'hargajual' => $this->input->post('hargajual'),
				'jumlah' => $this->input->post('jumlah'),
			);

		

		$insert = $this->pesanan->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kodepesanan' => $this->input->post('kodepesanan'),
				'namacustomer' => $this->input->post('namacustomer'),
				'kodecustomer' => $this->input->post('kodecustomer'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'namaitem' => $this->input->post('namaitem'),
				'kode_item' => $this->input->post('kode_item'),
				'hargajual' => $this->input->post('hargajual'),
				'jumlah' => $this->input->post('jumlah'),
			);

		

		$this->pesanan->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		
		$this->pesanan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kodepesanan') == '')
		{
			$data['inputerror'][] = 'kodepesanan';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('namacustomer') == '')
		{
			$data['inputerror'][] = 'namacustomer';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

	

		if($this->input->post('kodecustomer') == '')
		{
			$data['inputerror'][] = 'kodecustomer';
			$data['error_string'][] = 'Please select tanggalpesanan';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('nohp') == '')
		{
			$data['inputerror'][] = 'nohp';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('namaitem') == '')
		{
			$data['inputerror'][] = 'namaitem';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('kode_item') == '')
		{
			$data['inputerror'][] = 'kode_item';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('hargajual') == '')
		{
			$data['inputerror'][] = 'hargajual';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('jumlah') == '')
		{
			$data['inputerror'][] = 'jumlah';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
