
<link href="<?php echo base_url(); ?>assets/css/stylesheet.css" rel="stylesheet" />
<form id="contact"  method="post">
Name
<input placeholder="Name" type="text"  required autofocus name="name" >
<br><br>
Surname
<input placeholder="Surname" name="surname" type="text"  required >
<br><br>
Email Address*
<input type="email" name="email" required placeholder="Enter email address">
<br><br>
Company *
<input placeholder="Company" type="text" name ="company"  required >
<br><br>
Designation *
<input placeholder="Designation" type="text" name ="designation"  required >
<br><br>
Phone*
<input placeholder="Enter phone number" name="phone" type="text" pattern="[0-9]{10}"/>
<br><br>
ID Address Line1 *
<input placeholder="Address line 1" name="addr1" type="text"  required >
<br><br>
City Line2 *
<input placeholder="City" type="text" name="city"  required >
<br><br>
Province*
<input placeholder="Province" name="province" type="text" required >
<br><br>
(Zip)*
<input placeholder="Zip*" name= "zip" type="text"  required >
<br><br>
<label for="country">Country*</label>
<select name="country" id="country" size="1"> 
 <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="United Kingdom">United Kingdom</option>
<option value="American Samoa">American samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua">Antigua</option>
<option value="South Africa">South Africa</option>
<option value="Armenia">Armenia</option><option value="Aruba">Aruba</option>
<option value="Australia">Austtralia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="The Bahamas">The bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Uganda">Uganda</option>
<option value="Zimbabwe">Zimbabwe</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Taiwan">Taiwan</option>
<optiohn value="Bhutan">Bhutan</select>

<form>
</select>

<br><br>
<label for="status">Status*</label>
<select name="status" id="status" size="1"> 
<option value="Attempted">Attempted</option> 
<option value="New opportunity">New opportunity</option> 
<option value="Contacted">Contacted</option>
<option value="Additional Contact">Additional Contact</option>

</select>

<br>
<label for="status"></label>
<label>
Comment:
</label>
<br><br>
<textarea name="comment" rows="5" cols="100" placeholder="Type in a comment..."></textarea>
<br><br><br>
<button type="submit" name='submit' class="btn btn-success" > Submit Client</button>
	<div id="loading" style="display: none">
		<center><img src="<?php echo base_url();?>assets/img/Ripple-0.7s-200px.gif" width="100px" alt=""/>
		</center>
	</div>
<div id="suc"></div>
</form>
	
	
	<script>
$( document ).ready( function () {
	$('#contact').submit(function(event){
		$('#loading').show();
		event.preventDefault();
		
				$.ajax( {
				type: 'POST',
				url: '<?php echo base_url() ?>customer/manual_reg',
				dataType: 'json',
				data: $("#contact").serialize(),
				success: function ( data ) {
					console.log( data );
					$('#suc').html(data.message);
					$('#loading').hide();
					fade();
					//$(".form-group input:checked").parent().remove();
				}
			} );
 
});

});
	function fade(){

	setTimeout( function () {
	
			$( '#success' ).fadeOut( "slow" );
			/*$('#success').fadeOut(500); */
		
	}, 1000 );

	}

</script>