<form id='import_form' method='POST' enctype='multipart/form-data' action='<?php echo base_url()?>customer/importExcel'>
	<input class="btn btn-success" required id='excel' type='file' name='excel' accept='.xls, .xlsx'>
	<br>
	<button  class="btn btn-primary" type='submit'>Load</button>
</form>
<div id="export">
	<br>
	<a class="btn btn-primary" href="<?php echo base_url()?>customer/exportExcelCust">Export customers</a>
	<a class="btn btn-primary" href="<?php echo base_url()?>customer/exportExcelLeads">Export Leads</a>

</div>
<div id="loading" style="display: none">
	<center><img src="<?php echo base_url();?>assets/img/Ripple-0.7s-200px.svg" alt=""/>
	</center>
</div>
<br>
<div id="success" class="alert alert-success" style="display: none;width: 200px">
	<P>Succesfuly Imported</P>
</div>


<script>
	$( document ).ready( function () {

		$( '#import_form' ).on( 'submit', function ( event ) {
			event.preventDefault();
			//$( '#import_form' ).hide();
			$( '#export' ).hide();
			$( "#loading" ).show();
			$.ajax( {
				url: "<?php echo base_url()?>customer/importExcel",
				method: "POST",
				data: new FormData( this ),
				contentType: false,
				async: true,
				dataType: 'json',
				cache: false,
				processData: false,
				success: function ( data ) {
					// $('#file').val('');
					//load_data();
					$( "#loading" ).hide();
					$( "#success" ).show();
					success();
					console.log( data );
				}
			} )
		} );

		function success() {
			setTimeout( function () {
				
				$( '#success' ).remove();
				$( '#import_form' ).show();
				$( '#export' ).show();
				
			}, 5000 )
		}

		/* function load_unseen_notification(view = '')
		 {
			 var value = $("#sale").val();
		  $.ajax({
		   url:"fetch.php?field="+value,
		   method:"POST",
		   data:{view:view},
		   dataType:"json",
		   success:function(data)
		   {
		    $('.dropdown-menu').html(data.notification);
		    if(data.unseen_notification > 0)
		    {
		     $('.count').html(data.unseen_notification);
		    }
		   }
		  });
		 }
		 
		 load_unseen_notification();
		 
		$(document).on('click', '.dropdown-toggle', function(){
		  $('.count').html('');
		  load_unseen_notification('yes');
		 });
		 
		 setInterval(function(){ 
		  load_unseen_notification();; 
		 }, 5000);*/

	} );
</script>