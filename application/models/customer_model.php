<?php
class Customer_model extends CI_Model {
	private $inv = '';
	private $leadID = '';
    

	public

		function get_customers($status) {
		$salesid=$_SESSION['saleid'];
		$this->db->from( 'Customer c,AssignTask a, Status' );
		$this->db->where( "c.CustID=a.custid and Status.CustID=c.CustID and a.SalesID='$salesid' and Status.Status_Name='$status'" );
		$query = $this->db->get();
		return $query->result();
		

	}
	public

	function get_products() {
		$this->db->select( '*' );
		$this->db->from( 'product' );
		$query = $this->db->get();
		return $query->result();
	}
		public

	function get_sales() {
		$this->db->select( '*' );
		$this->db->from( 'Sales_Rep');
		$this->db->where("salesid='".$_SESSION['saleid']."'" );
		$query = $this->db->get();
		return $query->result();
	}

	public

	function get_Leads() {
		$this->db->select( '*' );
		$this->db->from( 'lead' );
		$query = $this->db->get();
		$leads= $query->result();
		foreach ( $leads as $lead ) {
			$leadID = $lead->LeadID;
		}
		return $leadID;
	}
		function get_pid() {
		$this->db->select( '*' );
		$this->db->from( 'product' );
		$query = $this->db->get();
		$leads= $query->result();
		foreach ( $leads as $lead ) {
			$leadID = $lead->Prod_ID;
		}
		return $leadID;
	}
	public

	function get_invoice() {
		$this->db->select( '*' );
		$this->db->from( 'invoice' );
		$query = $this->db->get();
		$invoices = $query->result();
		foreach ( $invoices as $invoice ) {
			$inv = $invoice->Invoice_ID;
		}
		return $inv;
		
	}
		function get_last_sale() {
		$this->db->select( '*' );
		$this->db->from( 'Sales_Rep' );
		$query = $this->db->get();
		$sales = $query->result();
		foreach ( $sales as $sale ) {
			$last = $sale->SalesID;
		}
		return $last;
		
	}
	public

	function get_salesRep() {
		$this->db->select( '*' );
		$this->db->from( 'Sales_Rep' );
		$query = $this->db->get();
		return $query->result();
	}
	public

	function get_salesIn() {
		$salesID = $_SESSION[ 'saleid' ];
		$this->db->select( '*' );
		$this->db->from( 'Sales_Rep' );
		$this->db->where(" SalesID !='$salesID' and Employee_Status !='0' ");
		$query = $this->db->get();
		return $query->result();
	}	
		function get_salesOut() {
		$salesID = $_SESSION[ 'saleid' ];	
		$this->db->select( '*' );
		$this->db->from( 'Sales_Rep' );
		$this->db->where(" SalesID !='$salesID' and Employee_Status ='0' ");
		$query = $this->db->get();
		return $query->result();
	}
	public	function get_case($prodid,$status) {
	$this->db->select( 'Name,Surname,Email,Phone,Company,Designation,I_Status,Prod_Name,Prod_Duration,Prod_Price' );
	$this->db->from( 'dbo.Invoice i,dbo.Lead l, dbo.Product p, dbo.Customer c' );
	$this->db->where("i.Lead_ID=l.LeadID and p.Prod_ID=l.Prod_ID and
			l.CustID=c.CustID and I_Status='$status' and p.Prod_ID LIKE '%$prodid%'");
	$query = $this->db->get();
	return $query->result();
}
	function insert( $table, $data ) {
		$this->db->insert( $table, $data );
	}

	function form_insert($table, $data){
	// Inserting in Table(students) of Database(college)
	$this->db->insert($table, $data);
	}
	function employee( $id, $EmpStatus){
	// Inserting in Table(students) of Database(college)
	$this->db->set('Employee_Status',$EmpStatus);	
	$this->db->where('SalesID',$id);	
	$this->db->update('Sales_Rep');
		
	}
	function get_employee($status){
		$salesID = $_SESSION[ 'saleid' ];	
		$this->db->select( "*" );
		$this->db->from( 'Sales_Rep' );
		$this->db->where(" Employee_status = '$status' and SalesID !='$salesID' ");
		$query = $this->db->get();
		return $query->result();
	}
			public

	function fetch() {
		$salesid = $_SESSION[ 'saleid' ];
		$this->db->from( 'Customer c,AssignTask a, Status' );
		$this->db->where( "c.CustID=a.custid and Status.CustID=c.CustID and a.SalesID='$salesid'" );
		$query = $this->db->get();
		return $query->result();
	}
		
		public

	function fetch_leads() {
		$salesid = $_SESSION[ 'saleid' ];
		$this->db->from( 'Customer c, AssignTask a, Lead l' );
		$this->db->where( "c.CustID=a.custid and a.SalesID='$salesid' and l.CustID=c.CustID" );
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	function update($data,$id)
	{
		$this->db->where('custID', $id);
$this->db->update('Status', $data); 
	}
	
			public
	
	function get_months() {
$sql_get_month = "select distinct month(a.stMonth) as num,datename(mm,a.stMonth) as date2
from AssignTask a order by month(a.stMonth),datename(mm,a.stMonth)";

		$query = $this->db->query($sql_get_month);
		$date2 = $query->result();
		return $date2;
	
	}
	
		public 

function get_viewleads($Status, $month, $course) {
		$salesid = $_SESSION[ 'saleid' ];

		    $sql="select distinct c.CustID,a.SalesID, c.Name,c.Surname,c.Email,c.Phone,c.Company,c.Designation,i.I_Status,p.Prod_Name,p.Prod_Duration,p.Prod_Price
          from dbo.Invoice i,dbo.Lead l, dbo.Product p, dbo.Customer c, dbo.AssignTask a, dbo.Sales_Rep s
          where i.Lead_ID=l.LeadID
          and i.I_Status = '$Status'
          and p.Prod_ID=l.Prod_ID 
          and c.CustID=a.custid
          and l.CustID =a.custid
          and DATENAME(m, l.Date_Created) = '$month'           
          and p.Prod_ID LIKE '%$course%' 
          and a.SalesID ='$salesid'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public
	
	function num_tasks() {
		$sql8= "select * from dbo.AssignTask";
		$query = $this->db->query($sql8);
	
			return sizeof($query->result());
	}
	public
	
	function tasks() {
		  $sql='select distinct c.CustID,Name,Surname from Customer c, AssignTask a
        where c.CustID not in (select AssignTask.custid from AssignTask)';
		$query = $this->db->query($sql);
		return $query->result();
	}
		public

		function get_all_customers() {
		$salesid=$_SESSION['saleid'];
		$this->db->from( 'Customer' );
		
		$query = $this->db->get();
		return $query->result();
		

	}
	
}
?>