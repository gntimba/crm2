
<?php

//This will the admin to enter new products into the database 
$mess="";
	if(isset($_POST['load'])){
	
/*	$prod_name = $_POST['prod_name'];
	$prod_duration = $_POST['prod_duration'];
	$prod_price = $_POST['prod_price'];
	
	$sql1= "select prod_id from dbo.Product";*/
/*
foreach ( salesname as $product ) {
			$temp= explode("P",$product->Prod_ID);
			
		}
		$temp[1]+=1;
		$str_length = 3;

// hardcoded left padding if number < $str_length
$prod_id= substr("0000{$temp[1]}", -$str_length);

		//$Prod_ID="P".$temp[1];
		 $prod_id="P".$prod_id;*/
	
/*	//adding products in the database
	$sql = "Insert into product(prod_id, prod_name, prod_duration, prod_price)
		values('$prod_id','$prod_name', '$prod_duration', '$prod_price')";*/
	
	/*$stmt3 = sqlsrv_query( $conn, $sql);*/
	
$data = array(
'Prod_ID' => $products,
'Prod_Name' => $this->input->post('prod_name'),
'Prod_Duration' => $this->input->post('prod_duration'),
'Prod_Price' => $this->input->post('prod_price')
);
//Transfering data to Model
$DBName = "Product";	
$this->customer_model->form_insert($DBName,$data);
$data['message'] = 'Data Inserted Successfully';
$mess='<div id="success" style="width:300px" class="alert alert-success">Product has been Added </div>';		
}
?>


<link href="<?php echo base_url()?>assets/css/stylesheet.css" rel="stylesheet" type="text/css">


<form action="" method="post">


Product Name: <input type="text" class="form-control" name="prod_name" placeholder="Product Name" required>
<br>
<br>
Product Description: <input type="text" class="form-control" name="prod_duration" placeholder="Product Duration" required>
<br>
<br>
Product Price: <input type="text" name="prod_price" class="form-control" placeholder="Product Price" required>
<br>
<br>
<button type="submit" class="btn btn-success" name="load">Load product</button>

</form>
<?php echo $mess;?>

<script>

	
	setTimeout(function(){
  if ($('#success').length > 0) {
    $('#success').remove();
  }
}, 5000)
</script>

