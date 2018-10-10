<?php
class productrange_model extends CI_Model {

public function insert_productrange($data){
	
$this->db->insert('Product', $data);	

	}

}
?>