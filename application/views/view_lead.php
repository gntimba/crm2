<link href="<?php echo base_url() ?>assets/css/table.css" rel="stylesheet" type="text/css">

<legend>
	<h5 align="center">
		<font color="navy" face="Segoe" size="+6">Select leads to view</font>
	</h5>
</legend>

<form id='form' name="seloption" action="AssignedLeads.php" method="POST">


	<div style="margin-left: 50px" class="row">
		<div class="col-sm-2">
			Select Month:
			<div style="margin-top: 5px">
				<div style="position: relative;">
					<select class="form-control" id="month" name="CaseStatement" value="Select" onmousedown="if(this.options.length>5){this.size=5;}" onchange='this.size=0;' onblur="this.size=0;">

						<?php

						foreach ( $months as $month ) {
							echo "<option value='" . $month->date2 . "'>" . $month->date2 . "</option>";
						}

						?>
					</select>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			Select Course:
			<!--    <div style=" margin-left: 70px; margin-top: 5px">-->
			<div style="position: relative;">
				<select name="AllCourses" class="form-control" id="course" onmousedown="if(this.options.length>5){this.size=5;}" onchange='this.size=0;' onblur="this.size=0;">
					<?php

					foreach ( $products as $product ) {
						echo "<option value='" . $product->Prod_ID . "'>" . $product->Prod_Name . "</option>";
					}

					?>
				</select>
				<!-- </div>-->
			</div>
		</div>

		<div class="col-sm-4">
			<label style="margin-left: 20px;">Select status:</label>
			<br>
			<div style="margin-left: 20px;">
				<Input type='Radio' Name='status' value='payed' checked="1">Pending
				<br>

				<Input type='Radio' Name='status' value='Not yet payed'>Not Pending
			</div>
		</div>
		<hr>
	</div>
	<legend></legend>

	<h5 align="center">
		<font color="#2B3B5B" face="Segoe" size="+2">View All Leads</font>
	</h5>
	<div align="center" class="one-third">
		<br>
		<label>
			<font size="4">Search by:&nbsp;</font>
		</label>
		SalesID:
		<input type="text" name="Sales_ID" value="Search with SalesID" onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Sales_ID" onblur="TBlur(this.id);"> &nbsp; Search Name:
		<input type="text" name="Name_Text" value="Search with Name" onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Name_Text" onblur="TBlur(this.id);"> &nbsp; Search Surname:
		<input type="text" name="Surname_Text" value="Search with Surname" onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Surname_Text" onblur="TBlur(this.id);">
		<br><br>
	</div>
	<legend></legend>
	<div style="overflow:auto;">


		<div id="tab"></div>
	</div>
				<div id="error" style="display: none">
  <center>
    <h1>SORRY NO CUSTOMERS FOR CURRENT SELECTION</h1>
  </center>
	</div>
	<div id="loading" style="display: none">
		<center><img src="<?php echo base_url();?>assets/img/Ripple-0.7s-200px.gif" alt=""/></center>
	</div>

	<script>
		function TClear( str ) {
			document.getElementById( str ).value = "";

			if ( str == "Sales_ID" ) {
				document.getElementById( 'Name_Text' ).value = "Search with Name";
				document.getElementById( 'Surname_Text' ).value = "Search with Surname";
			}
			if ( str == "Name_Text" ) {
				document.getElementById( 'Surname_Text' ).value = "Search with Surname";
				document.getElementById( 'Sales_ID' ).value = "Search with Email";
			}
			if ( str == "Surname_Text" ) {
				document.getElementById( 'Name_Text' ).value = "Search with Name";
				document.getElementById( 'Sales_ID' ).value = "Search with Email";
			}

		}
	</Script>

	<script>
		function myFunction( str ) {
			var input, filter, table, tr, td, i;
			input = document.getElementById( str );
			filter = input.value.toUpperCase();
			table = document.getElementById( "table" );
			tr = table.getElementsByTagName( "tr" );

			if ( str == "Sales_ID" ) {
				var indx = 0;
				for ( i = 0; i < tr.length; i++ ) {
					td = tr[ i ].getElementsByTagName( "td" )[ indx ];

					if ( td ) {
						if ( td.innerHTML.toUpperCase().indexOf( filter ) > -1 ) {
							tr[ i ].style.display = "";
						} else {
							tr[ i ].style.display = "none";
						}
					}
				}
			}
			if ( str == "Name_Text" ) {
				var indx = 1;
				for ( i = 0; i < tr.length; i++ ) {
					td = tr[ i ].getElementsByTagName( "td" )[ indx ];

					if ( td ) {
						if ( td.innerHTML.toUpperCase().indexOf( filter ) > -1 ) {
							tr[ i ].style.display = "";
						} else {
							tr[ i ].style.display = "none";
						}
					}
				}
			}
			if ( str == "Surname_Text" ) {
				var indx = 2;
				for ( i = 0; i < tr.length; i++ ) {
					td = tr[ i ].getElementsByTagName( "td" )[ indx ];

					if ( td ) {
						if ( td.innerHTML.toUpperCase().indexOf( filter ) > -1 ) {
							tr[ i ].style.display = "";
						} else {
							tr[ i ].style.display = "none";
						}
					}
				}
			}

		}
	</Script>

</form>

<script>
	$( document ).ready( function () {
		aja();

		$( "#form" ).change( function () {
			aja();
		} );
	} );

	function aja() {

		$( "#tab" ).css( "display", "none" );
		$( "#loading" ).show();
		$( "#error" ).css( "display", "none" );
		//$( '#import_form' ).hide();
		status = $( "input[name='status']:checked" ).val();
		month = $( '#month' ).val();
		course = $( '#course' ).val();
		console.log( course );
		console.log( status );
		console.log( month );
		$.ajax( {
			url: "<?php echo base_url()?>customer/jsonleads?status=" + status + "&month=" + month + "&course=" + course,
			contentType: false,
			async: true,
			dataType: 'json',
			success: function ( data ) {
				// $('#file').val('');
				//load_data();
				if ( !$.isEmptyObject( data ) ) {

					// console.log(data);
					createTableByForLoop( data );
					$( "#tab" ).css( "display", "block" );
					$( "#loading" ).css( "display", "none" );
				} else {
					$( "#error" ).css( "display", "block" );
					$( "#loading" ).css( "display", "none" );

				}
				console.log( data );
			}
		} )
	}






	function createTableByForLoop( data ) {

		var eTable = '<table  class="data-table" align="center" id="table" border="0" style="cursor: pointer;"><thead><th>Name</th><th>Surname</th> <th>Email</th><th>Phone</th><th>Company</th> <th>Designation</th><th>I_Status</th><th>Prod_Name</th><th>Prod_Duration</th><th>Prod_Price</th></tr></thead><tbody>';
		for ( var i = 0; i < data.length; i++ )

		{
			eTable += "<tr>";
			eTable += "<td>" + data[ i ][ 'Name' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Surname' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Email' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Phone' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Company' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Designation' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'I_Status' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Prod_Name' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Prod_Duration' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'Prod_Price' ] + "</td>";
			eTable += "</tr>";
		}
		eTable += "</tbody></table>";
		$( '#tab' ).html( eTable );

		//tableProducts();
		// $("#course_code").val(course);
	}
</script>