<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model','customer');
	}

	public function index()
    {
		$this->load->model('customer_model');
        $dariDB = $this->customer_model->cekkodebarang();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 4);
        $kodeBarangSekarang = $nourut + 1;
		$data = array('kodecustomer' => $kodeBarangSekarang);
		$data['data'] = $data;
        $this->load->view("customer_view", $data);
    }

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->customer->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customer) {
			$no++;
			$row = array();
			$row[] = $customer->kodecustomer;
			$row[] = $customer->namacustomer;
			$row[] = $customer->alamat;
			$row[] = $customer->nohp;
			$row[] = $customer->email;
			if($customer->photo)
				$row[] = '<a href="'.base_url('upload/'.$customer->photo).'" target="_blank"><img src="'.base_url('upload/'.$customer->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_customer('."'".$customer->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_customer('."'".$customer->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->customer->count_all(),
						"recordsFiltered" => $this->customer->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->customer->get_by_id($id);
		$data->email = ($data->email == '0000-00-00') ? '' : $data->email; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'kodecustomer' => $this->input->post('kodecustomer'),
				'namacustomer' => $this->input->post('namacustomer'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'email' => $this->input->post('email'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->customer->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kodecustomer' => $this->input->post('kodecustomer'),
				'namacustomer' => $this->input->post('namacustomer'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'email' => $this->input->post('email'),
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
			$customer = $this->customer->get_by_id($this->input->post('id'));
			if(file_exists('upload/'.$customer->photo) && $customer->photo)
				unlink('upload/'.$customer->photo);

			$data['photo'] = $upload;
		}

		$this->customer->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$customer = $this->customer->get_by_id($id);
		if(file_exists('upload/'.$customer->photo) && $customer->photo)
			unlink('upload/'.$customer->photo);
		
		$this->customer->delete_by_id($id);
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

		if($this->input->post('kodecustomer') == '')
		{
			$data['inputerror'][] = 'kodecustomer';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('namacustomer') == '')
		{
			$data['inputerror'][] = 'namacustomer';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Please select alamat';
			$data['status'] = FALSE;
		}

		if($this->input->post('nohp') == '')
		{
			$data['inputerror'][] = 'nohp';
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
