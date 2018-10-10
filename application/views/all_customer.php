<?php
header('Content-Type: application/json');
$arrayobj = new ArrayObject();
$customer1=array();
$x=0;
		
foreach ( $customers as $customer) {
			$arrayobj['customers'][] = new ArrayObject( array("custid"=>fixrn($customer->CustID ),"Name"=>fixrn($customer->Name),"Surname"=>fixrn($customer->Surname),"Email"=>fixrn($customer->Email),"Phone"=>fixrn($customer->Phone ),"Company"=>fixrn($customer->Company),"Designation"=>fixrn($customer->Designation),"Status_Name"=>fixrn($customer->Status_Name),"SalesID"=>fixrn($customer->SalesID)));
	
		}
echo json_encode($arrayobj);
?>