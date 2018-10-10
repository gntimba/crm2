<?php
class Sales extends CI_Controller {
	public
	function index() {
		$data[ 'customers' ] = $this->customer_model->get_customers();
		$data[ 'products' ] = $this->customer_model->get_products();
		$data[ 'leadID' ] = add($this->customer_model->get_Leads(),'L');
		$data[ 'inv' ] = add($this->customer_model->get_invoice(),'INV');
		$data['sidebar']='Sales';
		$data['active']='customer';
		$data[ 'main_content' ] = 'view_customer';
		$this->load->view( 'layout\main', $data );
	}
	
	public function cust()
	{
		$data[ 'customers' ] = $this->customer_model->get_customers();
		$this->load->view( 'all_customer', $data );
		
	}

	
	
}

?>