
<?php

$mess='';

if(isset($_POST['submit'])){	

$data = array(
'SalesID' => $sales,
'S_Name' => $this->input->post('name'),
'S_Surname' => $this->input->post('surname'),
'S_Role' => $this->input->post('role'),
'S_Emails' => $this->input->post('email'),
'S_Password' => $this->input->post('password'),
'Address' => '',
'City' => '',
'Postal_code' =>'',
'Profile_Picture' => '',	
'Country' =>'',
'Employee_Status' =>'1'
);
//Transfering data to Model
$DBName = "Sales_Rep";	
$this->customer_model->form_insert($DBName,$data);	
	
$mess='<div id="success" style="width:300px" class="alert alert-success">Sales Consultant has been Added </div>';
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Add sales</title>
</head>
<fieldset>
<body bgcolor="silver">

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>

<fieldset>

<div class="container"> 

<form id="contact" action="" method="post">
Name:<br>
<input placeholder="Name" type="text"  required autofocus name="name" >
  <br>
Surname:<br>
<input placeholder="Surname" name="surname" type="text"  required autofocus >
   <br>
Position:<br>
<input type="text" name="role" required autofocus>
   <br>
Email:<br>
<input type="email" name="email" required placeholder="Enter Email Address" required autofocus>
   <br>
Password:<br>
<input placeholder="password" type="text" name ="password"  size ="20"required autofocus>
  <br><br>
  <border>
<button type="submit" name="submit"> Add Sales Member</button>
<br>
<a href="TeamLeaderHome.php">Back </a > 


</form>
</div>
<?php echo $mess ?>

<script>

	
	setTimeout(function(){
  if ($('#success').length > 0) {
    $('#success').remove();
  }
}, 5000)
</script>	
