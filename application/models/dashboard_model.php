<?php
class dashboard_model extends CI_Model {
	
		public

	function get_newopportunity() {
$sql_get_newOpportunity = "select s.Status_Name
from Status s, Customer c
where s.CustID = c.CustID
AND datename(mm, s.Status_Date) = 'February'
AND s.Status_Name = 'New Opportunity'";

		$query = $this->db->query($sql_get_newOpportunity);
		//$newopportunity = $query->result();
	 
	// $_SESSION['num_newOpportunity'] = $num_newOpportunity;
		
		return $query->num_rows();
	}

//get months
	public
	
	function get_notattempted() {
$sql_get_NotAttempted = "select s.Status_Name
from Status s, Customer c
where s.CustID = c.CustID
AND datename(mm, s.Status_Date) = 'February'
AND s.Status_Name = 'Not Attempted'";
	 
	//$_SESSION['num_notAtempted'] = $num_notAtempted;

		$query = $this->db->query($sql_get_NotAttempted);
		return $query->num_rows();
	
	}
	
		public
//Getting the data from the db according to the selected s_name and status

	function get_disqualified() {
	   
$sql_get_disqualified = "select s.Status_Name
from Status s, Customer c
where s.CustID = c.CustID
AND datename(mm, s.Status_Date) = 'February'
AND s.Status_Name = 'disqualified'";

	 
	//$_SESSION['num_disqualified'] = $num_disqualified;
	
		$query = $this->db->query($sql_get_disqualified);
		return $query->num_rows();
	}
	
	//Getting data from the getDataDashBarGraph
	
	//Array for months
	public 
		function get_bargraphdata(){
$monthee= array('January','February','March','April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');


$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Months', 'type' => 'string'),
    array('label' => 'Leads', 'type' => 'number')

);
$count=0;
$arr = array ();

//this gets all the number of months from the DB 

while($count<=11){
		$dates=date('Y');
		$this->db->select( 'count(*) as dates' );
		$this->db->from( 'Customer c' );
	$this->db->where( "datename(MM, c.Date_Added) ='$monthee[$count]' and datename(yy, c.Date_Added) = '$dates'" );
		$query = $this->db->get();
		 $leads= $query->result();
			$temp1[$count] = $leads[0]->dates;
		

	

		
	
	$temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $monthee[$count]); 

    // Values of each slice
    $temp[] = array('v' => (int) $temp1[$count]); 
    $arr[] = array('c' => $temp);
	$count++;
		
}

	$table['rows'] = $arr;
 return $jsonTable = json_encode($table);
	}
} //end of class
?>
