				<?php
				echo $message = '';
				$me = '';
				$stat = '';
				?>

<div class="progress">
	<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-2">
			<input type="hidden" name="var2" id="copy2">
			<input type="text" class="form-control" name="var3" id="fullnames" placeholder="Customer Name">
			<br>
			<input type="text" name="fname" id="fname" placeholder="Customer ID" required class="readonly form-control ">

			<script>
				$( ".readonly" ).keydown( function ( e ) {
					e.preventDefault();
				} );
			</script>
		</div>
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-7">

					<select style="width:auto" class="form-control" id="filter" name="myselect">
						<option selected disabled value="">Filter By Status</option>
						<option value="Not Attempted">Not Attempted</option>
						<option value="New Opportunity">New Opportunity</option>
						<option value="Disqualified">Disqualified</option>
						<option value="Contacted">Contacted</option>
						<option value="Attempted">Attempted</option>
						<option value="Additional Contact">Additional Contact</option>
					</select>
					<br>
					<input type="text" id="myInput" style="width:auto" class="form-control flex-item" size="27px" onkeyup="myFunction()" placeholder="Search by email" title="Type in a name">
				</div>
				<div class="col-sm-1">
					<center>
						<h3 id="top_t"></h3>
					</center>
				</div>
			</div>





		</div>
		<div class="col-sm-1">
			<form action="" id="form1" method="post">

				<select name="status" style="width:auto" class="form-control" id="sel12">
					<option value="Not Attempted">Not Attempted</option>
					<option value="New Opportunity">New Opportunity</option>
					<option value="Disqualified">Disqualified</option>
					<option value="Contacted">Contacted</option>
					<option value="Attempted">Attempted</option>
					<option value="Additional Contact">Additional Contact</option>
				</select>
				<br>
				<input type="submit" name="sub" id="sub" class="btn btn-info " disabled value="Change Status">
				<div>

				</div>
			</form>
		</div>
	</div>
</div>
<fieldset>
	<div id="forTable" class="content table-responsive table-full-width" style="overflow:auto; height:350px;width:100%">
		<table align="center" class="table table-hover table-striped" id="table" border="0" style="cursor: pointer;">

			<thead>
				<tr>
					<th>CustID</th>
					<th>Name</th>
					<th>Last Name</th>
					<th>email</th>
					<th>phone</th>
					<th>comapny</th>
					<th>Designation</th>
					<th>Status</th>
					<th>SalesID</th>
				</tr>
			</thead>
			<tbody>
				<?php 
foreach($customers as $customer):?>
				<?php
				echo '<tr">
					<td>' . $customer->CustID . '</td>
					<td>' . $customer->Name . '</td>
					<td>' . $customer->Surname . '</td>
					<td>' . $customer->Email . '</td>
					<td>' . $customer->Phone . '</td>
					<td>' . $customer->Company . '</td>
					<td>' . $customer->Designation . '</td>
					<td>' . $customer->Status_Name . '</td>
					<td>' . $customer->SalesID . '</td>                                            
				</tr>';

				?>

				<?php endforeach?>
			</tbody>
		</table>

	</div>
	<div id="error" style="display: none">
  <center>
    <h1>SORRY NO CUSTOMERS FOR CURRENT SELECTION</h1>
  </center>
	</div>
	<div id="loading" style="display: none">
		<center><img src="<?php echo base_url();?>assets/img/Ripple-0.7s-200px.svg" alt=""/></center>
	</div>
	<input type="button" name="data[password]" class="next btn btn-info" value="Next"/>
</fieldset>

<fieldset>
	<div class="content table-responsive table-full-width" style="overflow:auto; height:350px;width:80%">
		<table class="table table-hover table-striped" align="center" id="table1" border="0" style="cursor: pointer;">
			<thead>
				<tr>
					<th>Product ID</th>
					<th>Prod Name</th>

					<th>Price</th>

				</tr>
			</thead>
			<tbody>

				<?php 
foreach($products as $product):?>
				<?php

				echo '<tr>
					<td>' . $product->Prod_ID . '</td>
					<td>' . $product->Prod_Name . '</td>
					
					<td>' . $product->Prod_Price . '</td>
					                                         
				</tr>';

				?>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
	<input type="button" name="previous" class="previous btn btn-default" value="Previous"/>
	<input type="button" name="data[password]" class="next btn btn-info" value="Next"/>

</fieldset>
<fieldset>
	Invoice No:
	<strong><input type="text" name="invoice" value="<?php echo $inv; ?>" style="border: none" readonly></strong><br><br> Prod ID:<input type="text" name="ProdType" id="prodid" style="border: none"> <br><br> Lead ID:<input type="text" name="leadID" id="leadID" style="border: none" value="<?php echo $leadID?>" readonly><br><br> prod Price:<input type="text" name="prodPrice" id="prodPrice" style="border: none" size="60px" readonly><br><br> Prod Name:<input type="text" name="ProdName" id="prodName" style="border: none" size="60px" readonly><br><br>
	<br>
	<input type="button" name="previous" class="previous btn btn-default" value="Previous"/>
	<input type="submit" id="start_button" name="submit" class="submit btn btn-success" value="Submit" id="submit_data" disabled/>
</fieldset>
<script>
	
$(document).ready(function(){
	tableCust();
	tableProducts();
//$("#loading").hide();
  $("#filter").change(function () {
	  
	 //$("#loading").css("display", "none");
	  //event.preventDefault();
    //disable the submit button
	  var status = $(this).val();
	  $("#forTable").css("display", "none");
	  $("#loading").show();
	  $("#error").css("display", "none");
	  
    //alert(course);
   // $(this).attr('disabled','true');$(this).css('cursor','progress');$(this).html('processing');
    $.ajax({
      url: '<?php echo base_url();?>customer/cust?status='+status,
      success: function(data,status)
      {
		  if(!$.isEmptyObject(data)){
		  
		 // console.log(data);
        createTableByForLoop(data);
			  $("#forTable").css("display", "block");
			   $("#loading").css("display", "none");
		  }
		  else{
			  $("#error").css("display", "block");
			   $("#loading").css("display", "none");
			  
		  }
       // createTableByJqueryEach(data);
        //enable the submit button
       // $('#myBtn').css('cursor','pointer');$('#myBtn').html('Submit');$('#myBtn').removeAttr('disabled');
      },
      async:   true,
      dataType: 'json'
    }); 
  });
});
 
function createTableByForLoop(data,course)
{
	
  var eTable=	'<table align="center" class="table table-hover table-striped" id="table" border="0" style="cursor: pointer;"><thead><tr><th>CustID</th><th>Name</th><th>Last Name</th><th>email</th><th>phone</th><th>comapny</th><th>Designation</th><th>Status</th><th>SalesID</th></tr></thead><tbody>';
  for(var i=0; i<data.customers.length;i++)
  {
    eTable += "<tr>";
    eTable += "<td>"+data.customers[i]['custid']+"</td>";
	eTable += "<td>"+data.customers[i]['Name']+"</td>";
    eTable += "<td>"+data.customers[i]['Surname']+"</td>";
	eTable += "<td>"+data.customers[i]['Email']+"</td>";
	eTable += "<td>"+data.customers[i]['Phone']+"</td>";
	eTable += "<td>"+data.customers[i]['Company']+"</td>";
	 eTable += "<td>"+data.customers[i]['Designation']+"</td>";
	  eTable += "<td>"+data.customers[i]['Status_Name']+"</td>";
	  eTable += "<td>"+data.customers[i]['SalesID']+"</td>";
    eTable += "</tr>";
  }
  eTable +="</tbody></table>";
  $('#forTable').html(eTable);
	tableCust();
	tableProducts();
	// $("#course_code").val(course);
}
	
	function tableCust(){
			var table = document.getElementById( 'table' );

	for ( var i = 1; i < table.rows.length; i++ ) {
		table.rows[ i ].onclick = function () {
			//rIndex = this.rowIndex;
			document.getElementById( "fname" ).value = this.cells[ 0 ].innerHTML;
			// document.getElementById("lname").value = this.cells[1].innerHTML;
			//document.getElementById("age").value = this.cells[2].innerHTML;
			document.getElementById( "fullnames" ).value = this.cells[ 1 ].innerHTML + " " + this.cells[ 2 ].innerHTML;;
			if ( enable() == true ) {
				document.getElementById( 'sub' ).disabled = false;
				//document.getElementById( 'su' ).disabled = false;
			}




			if ( validate() == true ) {
				document.getElementById( 'start_button' ).disabled = false;
			} else {
				document.getElementById( 'start_button' ).disabled = true;
			}
		};
	}
	}
	
	
	function tableProducts(){
			var table = document.getElementById( 'table1' );

	for ( var i = 1; i < table.rows.length; i++ ) {
		table.rows[ i ].onclick = function () {
			//rIndex = this.rowIndex;
			document.getElementById( "prodid" ).value = this.cells[ 0 ].innerHTML;
			document.getElementById( "prodName" ).value = this.cells[ 1 ].innerHTML;
			document.getElementById( "prodPrice" ).value = this.cells[ 2 ].innerHTML;
			if ( validate() == true ) {
				document.getElementById( 'start_button' ).disabled = false;
			} else {
				document.getElementById( 'start_button' ).disabled = true;
			}
			//document.getElementById("age").value = this.cells[2].innerHTML;
		};
	}
	}
	</script>





<script>
	function myFunction() {
		var input, filter, table, tr, td, i;
		input = document.getElementById( "myInput" );
		filter = input.value.toUpperCase();
		table = document.getElementById( "table" );
		tr = table.getElementsByTagName( "tr" );
		for ( i = 0; i < tr.length; i++ ) {
			td = tr[ i ].getElementsByTagName( "td" )[ 3 ];
			if ( td ) {
				if ( td.innerHTML.toUpperCase().indexOf( filter ) > -1 ) {
					tr[ i ].style.display = "";
				} else {
					tr[ i ].style.display = "none";
				}
			}
		}
	}
</script>

<script type="text/javascript">
	$( document ).ready( function () {
		var current = 1,
			current_step, next_step, steps;
		steps = $( "fieldset" ).length;
		$( ".next" ).click( function () {
			current_step = $( this ).parent();
			next_step = $( this ).parent().next();
			next_step.show();
			current_step.hide();
			setProgressBar( ++current );
		} );
		$( ".previous" ).click( function () {
			current_step = $( this ).parent();
			next_step = $( this ).parent().prev();
			next_step.show();
			current_step.hide();
			setProgressBar( --current );
		} );
		setProgressBar( current );
		// Change progress bar action
		function setProgressBar( curStep ) {
			var text = "";
			var percent = parseFloat( 100 / steps ) * curStep;
			percent = percent.toFixed();
			//var percent2=percent;
			if ( percent == '33' ) {
				var text = "CUSTOMERS";
				$( "#top_t" ).text( "CUSTOMERS" );
			} else if ( percent == '67' ) {
				var text = "PRODUCTS";
				$( "#top_t" ).text( "PRODUCTS" );

			} else if ( percent == '100' ) {
				var text = "CONFIRM";
				$( "#top_t" ).text( "CONFIRM" );
			}

			$( ".progress-bar" )
				.css( "width", percent + "%" )
				.html( text + ' ' + percent + '%' );
		}
	} );
</script>
<script type="text/javascript">
	function validate() {

		if ( document.getElementById( "fname" ).value.length <= 0 )
			return false;
		else if ( document.getElementById( "prodName" ).value.length <= 0 )
			return false;
		else if ( document.getElementById( "prodPrice" ).value.length <= 0 )
			return false;
		else if ( document.getElementById( "prodid" ).value.length <= 0 )
			return false;
		else
			return true;
	}

	function enable() {
		if ( document.getElementById( "fullnames" ).value.length > 0 )
			return true;
		else false;
	}





	// function verify(){
	// if (myTextempty){
	//  alert "Put some text in there!"
	//  //  return;
	//  }
	// else{
	//		
	//      do button functionality
	//  }
</script>
