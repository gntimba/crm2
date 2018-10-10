

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/build.css">




<form id='form' action="assigntask.php" method="post">


	<div id="selectbox">

		<select style="width: 200px" class="form-control" name="sales">
			<option disabled>Select Sale Member</option>
			<?php
			foreach ( $sales as $sale ) {
				$fullName = $sale->S_Name . ' ' . $sale->S_Surname;
				echo '<option value="' . $sale->SalesID . '">' . $fullName . '</option>';
			}

			?>
		</select>
	</div>
	<br>
	<br>
	<div style="overflow:auto; height:300px;width:100%">
		<?php
		$c=0;
		foreach ( $tasks as $customer ) {
			 $Name = $customer->Name . ' ' . $customer->Surname ;

		  echo '<div  class=" form-group ">
            <input  type="checkbox" name="foo[]" id="fancy-checkbox-success'.$c.'" autocomplete="off" value="' . $customer->CustID . '" />
            <div  class="[ btn-group ]">
                <label for="fancy-checkbox-success'.$c.'" class="[ btn btn-success ]">
                    <span class="[ glyphicon glyphicon-ok ]"></span>
                    <span> </span>
                </label>
                <label style="background-color:#2c3e50;" for="fancy-checkbox-success'.$c.'" class="[ btn btn-default active ]">
                  <font color="white"> ' . $Name . '
                </label></font>
            </div></div>';
			
			$c++;


		}
		?>
	</div>
<br>

	<input type="submit" name="submit" class="btn btn-success" value="Assign">
</form>
<br>
	<div id="loading" style="display: none">
		<center><img src="<?php echo base_url();?>assets/img/Ripple-0.7s-200px.gif" width="100px" alt=""/>
		</center>
	</div>
<div id="suc"></div>


<script>
$( document ).ready( function () {
	$('#form').submit(function(event){
		$('#loading').show();
		event.preventDefault();
		
				$.ajax( {
				type: 'POST',
				url: '<?php echo base_url() ?>customer/inser',
				dataType: 'json',
				data: $("#form").serialize(),
				success: function ( data ) {
					console.log( data );
					$('#suc').html(data.message);
					$('#loading').hide();
					fade();
					//$(".form-group input:checked").parent().remove();
				}
			} );
  $(".form-group input:checked").parent().remove();
});

});
	function fade(){

	setTimeout( function () {
	
			$( '#success' ).fadeOut( "slow" );
			/*$('#success').fadeOut(500); */
		
	}, 1000 );

	}

</script>