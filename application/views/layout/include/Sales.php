
<div class="sidebar" data-color="#9E9797" data-image="<?php echo base_url()?>assets/profile/<?php echo $_SESSION['email']?>.jpg">
  <?php
	$dashboard='';
	$import='';
	$manual='';
	$customer='';
	$viewlead='';
	if($active=='dashboard')
		$dashboard='class="active"';
	else if($active=='import')
	$import='class="active"';
	else if($active=='manual')
	$manual='class="active"';
	else if($active=='customer')
	$customer='class="active"';
	else if($active=='viewlead')
	$viewlead='class="active"';
	
	
?>
  Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
  Tip 2: you can also add an image using data-image tag
  <div class="sidebar-wrapper">
    <div class="logo"> <a href="" class="simple-text"> <?php echo $salesname[0]->S_Name.' '.$salesname[0]->S_Surname?> </a> </div>
    <ul class="nav">
      </a>
      </li>
      <li <?php echo $dashboard?> > <a href="<?php echo base_url()?>customer"> <i class="pe-7s-user"></i>
        <p>Dashboard</p>
        </a> </li>
      <li <?php echo $import?> > <a href="<?php echo base_url()?>customer/import"> <i class="pe-7s-note2"></i>
        <p>Import</p>
        </a> </li>
      <li <?php echo $manual?> > <a href="<?php echo base_url()?>customer/manual"> <i class="pe-7s-news-paper"></i>
        <p>Manual Registration</p>
        </a> </li>
      <li <?php echo $customer?> > <a href="<?php echo base_url()?>customer/customer_con"> <i class="pe-7s-science"></i>
        <p>view/Edit Customer</p>
        </a> </li>
      <li <?php echo $viewlead?> > <a href="<?php echo base_url()?>customer/viewlead"> <i class="pe-7s-user"></i>
        <p>View lead</p>
        </a> </li>
    </ul>
  </div>
</div>
