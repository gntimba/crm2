<?php
class viewpersales_model extends CI_Model {
	
		//get sales id
		public

	function get_salesid() {
$sql_get_salesid = "select S_Name, SalesID from dbo.Sales_Rep";

		$query = $this->db->query($sql_get_salesid);
		$sales = $query->result();
		
		return $sales;
	}

//get months
	public
	
	function get_months() {
$sql_get_month = "select distinct month(a.stMonth) as num,datename(mm,a.stMonth) as date2
from AssignTask a order by month(a.stMonth),datename(mm,a.stMonth)";

		$query = $this->db->query($sql_get_month);
		$date2 = $query->result();
		return $date2;
	
	}
	
		public
//Getting the data from the db according to the selected s_name and status

	function get_names($sales_name, $status,$month) {
	   
   $sql2 = "select distinct(s.S_Name), s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm,l.Date_Created) as Date
from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a
where a.SalesID = s.SalesID
AND c.CustID = l.CustID
AND l.Prod_ID = p.Prod_ID
AND l.LeadID = i.Lead_ID
AND datename(mm, a.stMonth) = datename(mm, l.Date_Created)
AND i.I_Status = '$status'
AND a.SalesID = '$sales_name'
AND datename(MM, a.stMonth) = '$month'";

		$query = $this->db->query($sql2);
		return $query->result();
	}

		public
//Getting the data from the db according to the selected s_name and status
	function get_target($sales, $month) {
	   
	   //$sales_name = mysqli_real_escape_string(get_salesid());
	   //$month = mysqli_real_escape_string(get_months());
	   
	$sql_get_target = "select a.custid as stTarget from assigntask a where a.SalesID = '$sales' and datename(MM, stMonth) = '$month'";

		/*$query = $this->db->query($sql_get_target);
		 $target=$query->result();
		 return $target;
		 */
		$query = $this->db->query($sql_get_target);
		return $query->num_rows();
		 
		 
	}


		public
//getting number of leads according to status
//Not running for some reason
	function get_leads($sales,$status,$month) {	
	
	$sql_get_leads = "select s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm, L.Date_Created) from Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a where a.SalesID = s.SalesID AND c.CustID = l.CustID AND l.Prod_ID = p.Prod_ID AND l.LeadID = i.Lead_ID AND datename(mm, a.stMonth) = datename(mm, l.Date_Created) AND i.I_Status = '$status' AND a.SalesID = '$sales' AND datename(mm, a.stMonth) = '$month' Group by s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, l.Date_Created";
	   
 /*
  $this->db->select('*'); 
 $this->db->from('Sales_Rep');*/   
     
	   /*
$this->db->select('s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, datename(mm, L.Date_Created)'); 
 $this->db->from('Sales_Rep s, Customer c, Lead l, Invoice i, Product p, AssignTask a');   
 $this->db->Where("a.SalesID = s.SalesID AND c.CustID = l.CustID AND l.Prod_ID = p.Prod_ID AND l.LeadID = i.Lead_ID AND datename(mm, a.stMonth) = datename(mm, l.Date_Created) AND i.I_Status = 'Not myet paid' AND a.SalesID = 'S001' AND datename(mm, a.stMonth) = 'April'");    
 $this->db->group_by('s.S_Name, s.salesid, c.custid, c.name, c.surname, c.phone, c.email, l.product, i.I_Status, l.Date_Created');  
 $query = $this->db->get();*/
 		
		$query = $this->db->query($sql_get_leads);
		return $query->num_rows();
		
	}

		public
//getting number of leads according to status from invoice
	function get_status() {
	   
$sql_get_status = "select distinct(I_Status) from dbo.Invoice";
$query = $this->db->query($sql_get_status);
	
	$status1 = $query->result();
	
		return $status1;
	}

}
?>