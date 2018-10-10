<?php
class user_model extends CI_Model {
	
	public
	function verify_user($email,$password) {
		//get Databases
		
		$this->db->select( '*' );
		$this->db->from( 'Sales_Rep' );
		$this->db->where( "S_Emails = '$email' and S_Password = '$password'");
		$query = $this->db->get();
		return $query->result();

	}

}
?>