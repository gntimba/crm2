<?php

ob_start();
class Customer extends CI_Controller {

	public

	function __construct() {
		parent::__construct();
		if ( !isset( $_SESSION[ 'sidebar' ] ) ) {
			redirect( base_url( 'users' ) );

		}

		// Your own constructor code

	}


	public

	function index() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'dashboard';
		$data[ 'header' ] = 'Dashboard';
		$data[ 'main_content' ] = 'dashboard';
		$this->load->view( 'layout\main', $data );
	}

	public

	function dashjson() {
		$data[ 'newopportunity' ] = $this->dashboard_model->get_newopportunity();
		$data[ 'disqualified' ] = $this->dashboard_model->get_disqualified();
		$data[ 'notattempted' ] = $this->dashboard_model->get_notattempted();


		$this->load->view( 'jsons\dash', $data );
	}
	public

	function dashtable() {

		$data[ 'monthee' ] = $this->dashboard_model->get_bargraphdata();

		$this->load->view( 'jsons\table', $data );
	}

	public

	function cust() {
		$status = $this->input->get( 'status' );
		$data[ 'customers' ] = $this->customer_model->get_customers( $status );
		$this->load->view( 'all_customer', $data );

	}


	public

	function
	import () {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'import';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'import';
		$data[ 'main_content' ] = 'import_view';
		$this->load->view( 'layout\main', $data );

	}
	public

	function emp_assign( $type ) {

		$sales = $this->input->post( 'salesid' );
		$this->customer_model->employee( $sales, $type );
		//$this->load->view( 'jsons\assign', $data );

		/*		if($type=='0'){
					$data['sale']= $this->input->post('salesid');
					$this->customer_model->employee( $sales, $type);
					
					//$this->load->view( 'jsons\assign', $data );
				}
				*/
	}
	public

	function confirm() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Confirm';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'confirm';
		$data[ 'main_content' ] = 'confirm_invoice';
		$this->load->view( 'layout\main', $data );

	}
	public

	function add() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'sales' ] = add( $this->customer_model->get_last_sale(), 'S' );
		$data[ 'header' ] = 'Add Sales Member';
		$data[ 'sidebar' ] = 'Team';
		$data[ 'header' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'add_sales';
		$data[ 'main_content' ] = 'add_sales';
		$this->load->view( 'layout\main', $data );

	}
	public

	function delete() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'salesIn' ] = $this->customer_model->get_salesIn();
		$data[ 'salesOut' ] = $this->customer_model->get_salesOut();
		$data[ 'header' ] = 'Delete';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'delete_sales';
		$data[ 'main_content' ] = 'delete_sales';
		$this->load->view( 'layout\main', $data );

	}
	public

	function monitor() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Monitor Calendar';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'monitor';
		$data[ 'main_content' ] = 'monitor_calender';
		$this->load->view( 'layout\main', $data );

	}

	public

	function manual()

	{
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Manual Registration';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'manual';
		$data[ 'main_content' ] = 'manual_view';
		$this->load->view( 'layout\main', $data );
	}


	public

	function jsonleads() {
		$Status = $this->input->get( 'status' );
		$month = $this->input->get( 'month' );
		$course = $this->input->get( 'course' );
		$data[ 'leads' ] = $this->customer_model->get_viewleads( $Status, $month, $course );
		ob_end_clean();
		$this->load->view( 'jsons\leads', $data );

	}


	public

	function viewlead() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'products' ] = $this->customer_model->get_products();
		$data[ 'months' ] = $this->customer_model->get_months();

		$data[ 'header' ] = 'View Lead';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'viewlead';

		$data[ 'main_content' ] = 'view_lead';
		$this->load->view( 'layout\main', $data );
	}

	public

	function customer_con() {
		//$side = $_SESSION[ 'sidebar' ];
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'CUSTOMERS';
		$data[ 'customers' ] = $this->customer_model->get_customers( 'Not Attempted' );
		$data[ 'products' ] = $this->customer_model->get_products();
		$data[ 'leadID' ] = add( $this->customer_model->get_Leads(), 'L' );
		$data[ 'inv' ] = add( $this->customer_model->get_invoice(), 'INV' );
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'customer';
		$data[ 'main_content' ] = 'view_customer';
		$this->load->view( 'layout\main', $data );
	}
	public

	function LeadsReport() {

		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Leads Report';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'Leadsreport';
		$data[ 'main_content' ] = 'view_LeadsReport';
		$this->load->view( 'layout\main', $data );
	}
	public

	function InvoicingReport() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Invoice Report';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'View_invoicing_report';
		$data[ 'main_content' ] = 'view_ Invoice';
		$this->load->view( 'layout\main', $data );
	}

	public

	function ProductRange() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Product Range';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'products' ] = add( $this->customer_model->get_pid(), "P" );
		$data[ 'sidebar' ] = 'Manager';
		$data[ 'active' ] = 'Add_Product_Range';
		$data[ 'main_content' ] = 'view_ProRange';
		//$this->load->model('customer_model');
		$this->load->view( 'layout\main', $data );
	}

	public

	function CaseReport() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'products' ] = $this->customer_model->get_products();
		$data[ 'header' ] = 'Case Report';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'Case_reports';

		$data[ 'main_content' ] = 'view_Case';
		$this->load->view( 'layout\main', $data );
	}


	public

	function CaseProgress( $prodID, $case ) {
		if ( $case == 1 )
			$status = 'Not Yet paid';
		else
			$status = 'Paid';

		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Case Report';
		$data[ 'cases' ] = $this->customer_model->get_case( $prodID, $status );
		$data[ 'products' ] = $this->customer_model->get_products();
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'Case_reports';
		$data[ 'active' ] = 'Case_reports';
		$data[ 'main_content' ] = 'view_case_progress';
		$this->load->view( 'layout\main', $data );

	}

	public

	function PerSales() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Per Sales';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'Leads_Per_Sale';

		$data[ 'salesid' ] = $this->Viewpersales_model->get_salesid();
		//$data[ 'names' ] = $this->Viewpersales_model->get_names();
		$data[ 'months' ] = $this->Viewpersales_model->get_months();
		//$data[ 'lead' ] = $this->Viewpersales_model->get_leads($sales,$status,$month);
		$data[ 'status' ] = $this->Viewpersales_model->get_status();
		//$data[ 'target' ] = $this->Viewpersales_model->get_target($sales,$month);

		$data[ 'main_content' ] = 'view_leadspersales';
		$this->load->view( 'layout\main', $data );
	}
	public

	function TaskSales() {
		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'header' ] = 'Task Sales';
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = 'Task_Per_Sales';
		$data[ 'main_content' ] = 'assigntask';

		$data[ 'sales' ] = $this->customer_model->get_salesRep();
		$tasks = $this->customer_model->num_tasks();
		if ( $tasks > 0 )
			$data[ 'tasks' ] = $this->customer_model->tasks();
		else
			$data[ 'tasks' ] = $this->customer_model->get_all_customers();
		$this->load->view( 'layout\main', $data );
	}
	public

	function get_emp( $status ) {
		$data[ 'employee' ] = $this->customer_model->get_employee( $status );
		$this->load->view( 'jsons/emp_json', $data );
	}


	public

	function importExcel() {

		$data[ 'hey' ] = $_FILES[ 'excel' ];
		$all = array();
		$this->load->model( 'increment_model' );
		$this->load->library( 'excel' );
		$excel = PHPExcel_IOFactory::load( $_FILES[ 'excel' ][ 'tmp_name' ] );
		$excel->setActiveSheetIndex( 0 );
		//determines which row the data series start
		$i = 2;
		while ( $excel->getActiveSheet()->getCell( 'A' . $i )->getValue() != "" ) {
			$name = $excel->getActiveSheet()->getCell( 'A' . $i )->getValue();
			$surname = $excel->getActiveSheet()->getCell( 'B' . $i )->getValue();
			$email = $excel->getActiveSheet()->getCell( 'C' . $i )->getValue();
			$company = $excel->getActiveSheet()->getCell( 'E' . $i )->getValue();
			$designation = $excel->getActiveSheet()->getCell( 'F' . $i )->getValue();
			$phone = $excel->getActiveSheet()->getCell( 'D' . $i )->getValue();
			$addr1 = $excel->getActiveSheet()->getCell( 'G' . $i )->getValue();
			$city = $excel->getActiveSheet()->getCell( 'H' . $i )->getValue();
			$province = $excel->getActiveSheet()->getCell( 'K' . $i )->getValue();
			$zip = $excel->getActiveSheet()->getCell( 'I' . $i )->getValue();
			$country = $excel->getActiveSheet()->getCell( 'K' . $i )->getValue();
			$custid = add( $this->increment_model->get_customers(), 'C' );
			$status = add( $this->increment_model->get_status(), 'ST' );
			$data = array(
				'CustID' => $custid,
				'Name' => $name,
				'Surname' => $surname,
				'Email' => $email,
				'Phone' => $phone,
				'Company' => $company,
				'Designation' => $designation,
				'Address' => $addr1,
				'City' => $city,
				'Zip_code' => $zip,
				'Province' => $province,
				'Country' => $city
			);
			$status1 = array( 'StatusID' => $status,
				'CustID' => $custid,
				'Status_Name' => 'Not Attempted' );
			$this->customer_model->insert( 'Customer', $data );
			$this->customer_model->insert( 'Status', $status1 );
			$i++;
		}
		$data[ 'array1' ] = 'inserted successfuly';
		$this->load->view( 'jsons\excel', $data );
	}


	public

	function exportExcelCust() {
		$this->load->model( 'increment_model' );
		$this->load->library( 'excel' );
		//$data[ 'array1' ] = $this->increment_model->get_columns();
		//$data['columns'] = array( "Name", "Address", "Gender", "Designation", "Age" );
		//$this->load->view( 'jsons\tests', $data );
		$object = new PHPExcel();
		$object->setActiveSheetIndex( 0 );
		$key = 'custid';
		$table = 'dbo.customer';
		$table_columns = $this->increment_model->get_columns( $table, $key );
		$column = 0;

		foreach ( $table_columns as $field ) {
			$object->getActiveSheet()->setCellValueByColumnAndRow( $column, 1, $field );
			$column++;
		}
		$employee_data = $this->customer_model->fetch();
		$excel_row = 2;
		foreach ( $employee_data as $row ) {
			$object->getActiveSheet()->setCellValueByColumnAndRow( 0, $excel_row, $row->Name );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 1, $excel_row, $row->Surname );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 2, $excel_row, $row->Email );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 3, $excel_row, $row->Password );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 4, $excel_row, $row->Phone );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 5, $excel_row, $row->Company );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 6, $excel_row, $row->Designation );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 7, $excel_row, $row->Address );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 8, $excel_row, $row->City );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 9, $excel_row, $row->Zip_code );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 10, $excel_row, $row->Province );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 11, $excel_row, $row->Country );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 12, $excel_row, $row->Date_Added );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 13, $excel_row, $row->Comment );


			$excel_row++;
		}
		$name = "customer " . date( "F j Y" ) . ".xlsx";
		$object_writer = PHPExcel_IOFactory::createWriter( $object, 'Excel2007' );
		header( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
		header( "Last-Modified: " . gmdate( "D,d M YH:i:s" ) . " GMT" );
		header( 'Content-type: text/xml' );
		//header( 'Content-Type: application/vnd.ms-excel' );
		header( "Cache-Control: no-cache, must-revalidate" );
		header( "Pragma: no-cache" );
		header( "Content-Disposition: attachment; filename=" . $name );
		//$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
		ob_end_clean();
		$object_writer->save( 'php://output' );
	}
	//not yet done need to contionuur
	public

	function exportExcelLeads() {
		$this->load->model( 'increment_model' );
		$this->load->library( 'excel' );
		$table = 'dbo.Lead';

		//$data[ 'array1' ] =  $this->increment_model->get_columnsLeads($table);

		//$this->load->view( 'jsons\tests', $data );
		$object = new PHPExcel();
		$object->setActiveSheetIndex( 0 );

		$table = 'dbo.Lead';
		$table_columns = $this->increment_model->get_columnsLeads( $table );
		$object->getActiveSheet()->setCellValueByColumnAndRow( 0, 1, 'Name' );
		$object->getActiveSheet()->setCellValueByColumnAndRow( 1, 1, 'Surname' );
		$column = 2;

		foreach ( $table_columns as $field ) {
			$object->getActiveSheet()->setCellValueByColumnAndRow( $column, 1, $field );
			$column++;
		}
		$employee_data = $this->customer_model->fetch_leads();
		$excel_row = 2;
		foreach ( $employee_data as $row ) {
			$object->getActiveSheet()->setCellValueByColumnAndRow( 0, $excel_row, $row->Name );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 1, $excel_row, $row->Surname );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 2, $excel_row, $row->Description );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 3, $excel_row, $row->Product );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 4, $excel_row, $row->Date_Created );
			$object->getActiveSheet()->setCellValueByColumnAndRow( 5, $excel_row, $row->Prod_ID );
			$excel_row++;
		}
		$name = "Lead " . date( "F j Y" ) . ".xlsx";
		$object_writer = PHPExcel_IOFactory::createWriter( $object, 'Excel2007' );
		header( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
		header( "Last-Modified: " . gmdate( "D,d M YH:i:s" ) . " GMT" );
		header( 'Content-type: text/xml' );
		//header( 'Content-Type: application/vnd.ms-excel' );
		header( "Cache-Control: no-cache, must-revalidate" );
		header( "Pragma: no-cache" );
		header( "Content-Disposition: attachment; filename=" . $name );
		//$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
		ob_end_clean();
		$object_writer->save( 'php://output' );
	}

	public

	function email() {
		$prodID = $this->input->post( 'ProdType' );
		$prodD = $this->input->post( 'ProdName' );
		$prodPrice = $this->input->post( 'prodPrice' );
		$custID = $this->input->post( 'fname' );
		$leadID = $this->input->post( 'leadID' );
		$inv = $this->input->post( 'invoice' );
		$da = date( "Y-m-d h:i:s" );
		$lead = array(
			'LeadID' => $leadID,
			'CustID' => $custID,
			'Description' => '',
			'Product' => $prodD,
			'Prod_ID' => $prodID
		);
		$invoice = array(
			'Invoice_ID' => $inv,
			'I_Status' => 'Not Yet Paid',
			'Invoice_cost' => $prodPrice,
			'Additional_Costs' => '0.0',
			'AC_Description' => '',
			'Lead_ID' => $leadID
		);

		$update = array(
			'Status_Name' => 'New Opportunity',
			'Status_Date' => $da
		);

		$this->customer_model->insert( 'Lead', $lead );
		$this->customer_model->insert( 'Invoice', $invoice );
		$this->customer_model->update( $update, $custID );
		$data[ 'mess' ] = '' . css() . '<div class="container">
  <h2 style = "padding-left: 60px;" >Invoice</h2>
              
  <table class="pure-table pure-table-bordered">
    <tbody>
      <tr class="pure-table-odd">
        <td>Invoice ID</td>
        <td>' . $inv . '</td>
      </tr>
      <tr ">
        <td>lead ID</td>
        <td>' . $leadID . '</td>

      </tr>
      <tr class="pure-table-odd">
        <td>Customer ID</td>
        <td>' . $custID . '</td>
      </tr>
	              <tr ">
        <td>Product ID</td>
        <td>' . $prodID . '</td>
      </tr>
           <tr class="pure-table-odd">
        <td>Product description</td>
        <td>' . $prodD . '</td>
      </tr>
            <tr >
        <td>Product Price</td>
        <td>' . $prodPrice . '</td>
      </tr>
    </tbody>
  </table>
</div>';
		$this->load->view( 'final_lead', $data );

	}
	public

	function inser() {
		$this->load->model( 'increment_model' );
		$foo = $this->input->post( 'foo' );
		$sales = $this->input->post( 'sales' );
		$count = 0;
		while ( !empty( $foo[ $count ] ) )

		{
			$taskid = add( $this->increment_model->task_incr(), 'A' );

			$data = array(
				'tsID' => $taskid,
				'SalesID' => $sales,
				'custid' => $foo[ $count ]
			);

			$this->customer_model->form_insert( 'AssignTask', $data );
			$count++;
		}
		$data[ 'count' ] = $count;

		$this->load->view( 'jsons\task', $data );

	}


	/*	public

		function table1() {

			$data[ 'salesid' ] = $this->Viewpersales_model->get_salesid();
			//$data[ 'names' ] = $this->Viewpersales_model->get_names();
			$data[ 'months' ] = $this->Viewpersales_model->get_months();
			//$data[ 'lead' ] = $this->Viewpersales_model->get_leads($sales,$status,$month);
			$data[ 'status' ] = $this->Viewpersales_model->get_status();
			//$data[ 'target' ] = $this->Viewpersales_model->get_target($sales,$month);

			$data['sidebar']=$_SESSION[ 'sidebar' ];
			$data['active']='dashboard';
			$data['header']='Dashboard';
			$data[ 'main_content' ] = 'view_leadspersales';


			$this->load->view( 'layout\main', $data );
		}*/

	public

	function table() {
		$sales = $this->input->get( 'sales' );
		$status = $this->input->get( 'status' );
		$month = $this->input->get( 'month' );
		$data[ 'target' ] = $this->Viewpersales_model->get_target( $sales, $month );
		$data[ 'lead' ] = $this->Viewpersales_model->get_leads( $sales, $status, $month );

		$data[ 'test' ] = array( $sales, $status, $month );

		$data[ 'names' ] = $this->Viewpersales_model->get_names( $sales, $status, $month );
		//$data['test']=array($sales,$status,$month);


		$this->load->view( 'test_view', $data );
	}


	//about us
	public

	function aboutUs() {


		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = '';
		$data[ 'header' ] = 'ABOUT US';
		$data[ 'main_content' ] = 'view_AboutUs';


		$this->load->view( 'layout\main', $data );
	}

	//calendar
	public

	function calendar() {

		$data[ 'salesname' ] = $this->customer_model->get_sales();
		$data[ 'sidebar' ] = $_SESSION[ 'sidebar' ];
		$data[ 'active' ] = '';
		$data[ 'header' ] = 'Calendar';
		$data[ 'main_content' ] = 'view_calendar';


		$this->load->view( 'layout\main', $data );
	}
	public

	function manual_reg() {

		$salesid = $_SESSION[ 'saleid' ];
		$this->load->model( 'increment_model' );
		$name = $this->input->post( 'name' );
		$surname = $this->input->post( 'surname' );
		$email = $this->input->post( 'email' );
		$company = $this->input->post( 'company' );
		$designation = $this->input->post( 'designation' );
		$phone = $this->input->post( 'phone' );
		$addr1 = $this->input->post( 'addr1' );
		$city = $this->input->post( 'city' );
		$province = $this->input->post( 'province' );
		$zip = $this->input->post( 'zip' );
		$country = $this->input->post( 'country' );
		$status_name = $this->input->post( 'status' );
		$comment = $this->input->post( 'comment' );


		$custid = add( $this->increment_model->get_customers(), 'C' );
		$status = add( $this->increment_model->get_status(), 'ST' );
		$taskid = add( $this->increment_model->task_incr(), 'A' );

		$customer = array(
			'CustID' => $custid,
			'Name' => $name,
			'Surname' => $surname,
			'Email' => $email,
			'Phone' => $phone,
			'Company' => $company,
			'Designation' => $designation,
			'Address' => $addr1,
			'City' => $city,
			'Zip_code' => $zip,
			'Province' => $province,
			'Country' => $city,
			'Comment'=>$comment
		);

		$status1 = array( 'StatusID' => $status,
			'CustID' => $custid,
			'Status_Name' => $status_name );

		$task = array(
			'tsID' => $taskid,
			'SalesID' => $salesid,
			'custid' => $custid
		);
			$data['customer']=$name.' '.$surname;
		$this->customer_model->insert( 'Customer', $customer );
		$this->customer_model->insert( 'Status', $status1 );
		$this->customer_model->form_insert( 'AssignTask', $task );
		$this->load->view( 'jsons\manual_j',$data );

	}


}

?>
?>