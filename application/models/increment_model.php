<?php

class increment_model extends CI_Model {





	public

	function get_customers() {
		$this->db->select( '*' );
		$this->db->from( 'customer' );
		$query = $this->db->get();
		$leads = $query->result();
		foreach ( $leads as $lead ) {
			$leadID = $lead->CustID;
		}
		return $leadID;
	}

	public

	function get_status() {
		$this->db->select( '*' );
		$this->db->from( 'status' );
		$query = $this->db->get();
		$leads = $query->result();
		foreach ( $leads as $lead ) {
			$leadID = $lead->StatusID;
		}
		return $leadID;
	}
	public
	function get_columns($table,$primary) {
		$data = array();
		$this->db->select( 'name' );
		$this->db->from("sys.columns");
		$this->db->where( "object_id = OBJECT_ID( '$table' ) and name !='$primary'" );
		$this->db->order_by('column_id');
		$query = $this->db->get();
		$Names = $query->result();
		foreach ( $Names as $name ) {
			array_push($data,$name->name) ;
		}
		return $data;
	}
		public
	function get_columnsLeads($table) {
		$data = array();
		$this->db->select( 'name' );
		$this->db->from("sys.columns");
		$this->db->where( "object_id = OBJECT_ID( '$table' ) and name !='custid' and name !='leadid'" );
		$this->db->order_by('column_id');
		$query = $this->db->get();
		$Names = $query->result();
		foreach ( $Names as $name ) {
			array_push($data,$name->name) ;
		}
		return $data;
	}
			public

	function task_incr() {
		$this->db->select( '*' );
		$this->db->from( 'AssignTask' );
		$query = $this->db->get();
		$leads = $query->result();
		foreach ( $leads as $lead ) {
			$leadID = $lead->tsID;
		}
		return $leadID;
	}

}
?>