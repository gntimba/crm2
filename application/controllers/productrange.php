<?php

class productrange extends CI_Controller{

function __construct(){
	parent::__construct();	
	$this->load->model('productrange_model');
}
public function index(){
	$this->load->view( 'view_ProRange');	
}

public function insert(){
	

if(!$this->input->post('load'==null)){
$data = array('Prod_ID' => add($this->customer_model->get_pid(),'P'),
'Prod_Name' => $this->input->post('prod_name'),
'Prod_Duration' => $this->input->post('prod_desc'),
'Prod_Price' => $this->input->post('prod_price')

);

$this->productrange_model->insert_productrange($data);
}

//$data['message'] = 'Data insert successfully';
		$ext['main_content']='view_ProRange';
		$this->load->view( 'layout/main');	
	}
	
	}
?>