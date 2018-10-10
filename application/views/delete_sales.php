<link href="<?php echo base_url(); ?>assets/css/table.css" rel="stylesheet" type="text/css">
<style>
	h3 {
		font-family: Cambria, Georgia, serif;
		font-size: 24px;
		font-style: normal;
		font-variant: normal;
		font-weight: 500;
		line-height: 15.4px;
		color: #1b4f9b;
	}
	
	input[type="radio"] {
		display: inline;
		position: relative;
		margin: 2 2px 2 2px;
	}
	
	.selectedText {
		font-family: Cambria, Georgia, serif;
		width: 20%;
		padding: 12px 20px;
		margin: 8px 0;
		box-sizing: border-box;
		border: 2px solid black;
		border-radius: 4px;
		background-color: #3CBC8D;
		color: white;
		font-size: 18px;
		height: 30px;
	}
</style>


<legend>
	<h5 align="center">
		<font color="#FF0004" face="Segoe" size="+6">Delete Sales Member</font>
	</h5>
</legend>

<form id="check">
	<h3> Please select employee status view: </h3>

	<Input style="font-size: 14px;" type='Radio' Name='EmpStatus' id="Employed" value='1'>Employed
	<br>
	<Input style="font-size: 14px;" type='Radio' Name='EmpStatus' id="Released" value='0'>Released
</form>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

	<p style="margin-bottom: 10px;"></p>

	<br> <br> SalesID:&nbsp;
	<input type="text" name="Sales_ID" value="Search with SalesID" onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Sales_ID" onblur="TBlur(this.id);" size="16"> Search Name:
	<input type="text" name="Name_Text" value="Search with Name" onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Name_Text" onblur="TBlur(this.id);" size="14"> Search Surname:
	<input type="text" name="Surname_Text" value="Search with Surname" onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Surname_Text" onblur="TBlur(this.id);" size="17">
	<br><br> Clicked_SalesID:&nbsp; &nbsp;
	<input class="selectedText" type="text" name="lname" id="lname" readonly>
	<input class="selectedText" type="hidden" name="salesid" id="salesid" readonly>
	<br><br>
	<input type="submit" name="Delete" id="Delete" class="btn btn-danger" value="Delete">
	<input type="submit" name="Reinstate" id="Reinstate" class="btn btn-success" value="Reinstate">
	<br> <br>

</form>


<center>
	<div id="employee"> </div>
	<div id="error" style="display: none">
		<center>
			<h1>SORRY NO CUSTOMERS FOR CURRENT SELECTION</h1>
		</center>
	</div>
	<div id="loading" style="display: none">
		<center><img src="<?php echo base_url();?>assets/img/Ripple-0.7s-200px.gif" alt=""/>
		</center>
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
	</script>

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
	</script>
	<br>
	<font color="red">
		<center>
			<?php echo "NB: YOU CANNOT VIEW THE TABLE BEFORE YOU SELECT DELETE/REINSTATE A PERSON!!"; ?>
		</center>
	</font>
</center>
</form>


<script>
	$( document ).ready( function () {
		$( '#Delete' ).click( function ( event ) {
			event.preventDefault();

			var sales = '#' + $( '#salesid' ).val();
			$.ajax( {
				type: 'POST',
				url: '<?php echo base_url() ?>customer/emp_assign/0',
				dataType: 'json',
				data: {
					salesid: $( '#salesid' ).val()
				},
				success: function ( data ) {
					console.log( data.sale );
				}
			} );
			//alert(sales);

			$( sales ).remove();
			$( '#lname' ).val( "" );
			$( '#salesid' ).val( "" );
		} );

		$( '#Reinstate' ).click( function ( event ) {
			event.preventDefault();
			var sales = '#' + $( '#salesid' ).val();
			//alert(sales);
			$.ajax( {
				type: 'POST',
				url: '<?php echo base_url() ?>customer/emp_assign/1',
				dataType: 'json',
				data: {
					salesid: $( '#salesid' ).val()
				},
				success: function ( data ) {
					console.log( data.sale );
				}
			} );
			$( sales ).remove();
			$( '#lname' ).val( "" );
			$( '#salesid' ).val( "" );
		} );



		//tableCust();
		//tableProducts();
		//$("#loading").hide();
		$( '#Reinstate' ).attr( 'disabled', 'disabled' );
		$( '#Delete' ).attr( 'disabled', 'disabled' );
		$( "#check" ).change( function () {
			status = $( "input[name='EmpStatus']:checked" ).val();

			//$("#loading").css("display", "none");
			//event.preventDefault();
			//disable the submit button

			//alert(status);
			$( "#employee" ).css( "display", "none" );
			$( "#loading" ).show();
			$( "#error" ).css( "display", "none" );

			//alert(course);
			if ( status == 1 ) {
				$( '#Reinstate' ).attr( 'disabled', 'disabled' );
				$( '#Delete' ).removeAttr( 'disabled' );
			} else {
				$( '#Delete' ).attr( 'disabled', 'disabled' );
				$( '#Reinstate' ).removeAttr( 'disabled' );
			}
			$.ajax( {
				url: '<?php echo base_url();?>customer/get_emp/' + status,
				success: function ( data, status ) {
					if ( !$.isEmptyObject( data ) ) {

						//console.log( data );
						createTableByForLoop( data );
						$( "#employee" ).css( "display", "block" );
						$( "#loading" ).css( "display", "none" );
					} else {
						$( "#error" ).css( "display", "block" );
						$( "#loading" ).css( "display", "none" );

					}
					// createTableByJqueryEach(data);
					//enable the submit button
					// $('#myBtn').css('cursor','pointer');$('#myBtn').html('Submit');$('#myBtn').removeAttr('disabled');
				},
				async: true,
				dataType: 'json'
			} );
		} );
	} );

	function createTableByForLoop( data, course ) {

		var eTable = '<table class="data-table" id="table" border="1" style="cursor: pointer;"><thead><th>Sales_ID</th><th>Name</th><th>Surname</th><th>Position</th><th>Email</th><th>Password</th></tr></thead><tbody>';
		for ( var i = 0; i < data.length; i++ )

		{
			eTable += "<tr id=" + data[ i ][ 'SalesID' ] + " >";
			eTable += "<td>" + data[ i ][ 'SalesID' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'S_Name' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'S_Surname' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'S_Role' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'S_Emails' ] + "</td>";
			eTable += "<td>" + data[ i ][ 'S_Password' ] + "</td>";
			eTable += "</tr>";
		}
		eTable += "</tbody></table>";
		$( '#employee' ).html( eTable );
		tableCust();
		//tableProducts();
		// $("#course_code").val(course);
	}

	function tableCust() {
		var table = document.getElementById( "table" );

		for ( var i = 1; i < table.rows.length; i++ )
		// document.getElementById("lname").value = this.cells[1].innerHTML;
		{
			table.rows[ i ].onclick = function () {
				//rIndex = this.rowIndex;
				document.getElementById( "salesid" ).value = this.cells[ 0 ].innerHTML;
				document.getElementById( "lname" ).value = this.cells[ 1 ].innerHTML + "  " + this.cells[ 2 ].innerHTML;
				// document.getElementById("lname").value = this.cells[1].innerHTML;
				//document.getElementById("age").value = this.cells[2].innerHTML;
			};
		}
	}
</script>

<script type="text/javascript">
	setTimeout( function () {
		if ( $( '#success' ).length > 0 ) {
			$( '#success' ).fadeOut( "slow" );
			/*$('#success').fadeOut(500); */
		}
	}, 1000 )
</script>