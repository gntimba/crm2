

<fieldset>
<legend><h5 align="center"><font  color="navy" face="Segoe" size="+6">Customer Case Management </font></h5></legend>
        
        <form name ="seloption" action="CaseProgressBar.php"  method="POST">
         <div align="center" class="one-third">   
             <br><br><br>
            
            Select Case:&nbsp;&nbsp;&nbsp;
                <select id="cases" name="CaseStatement" >
            <option value="1">Open Case</option>
				<option value="2">Resolved Case</option>
			 </select>
            <br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;
            Select Course:
            <select id="allcourse" name="AllCourses">
            <?php
               foreach ( $products as $product ) {
              echo "<option value='".$product->Prod_ID."'>".$product->Prod_Name."</option>";
			   }
            ?>
            </select>
            <br><br><br>
           
			 <a id="redirect" style="width:20%" class="btn btn-primary btn-lg" role="button">View Case</a>
        </div>    
        </form>
</fieldset>   
	<script>
$(document).ready(function(){

	$('select').on('change', function() {
		var cases =$('#cases').val();
	var course=$('#allcourse').val();

	$("#redirect").attr("href", "<?php echo base_url().'customer/CaseProgress/'?>"+course+"/"+cases);

});

	var cases =$('#cases').val();
	var course=$('#allcourse').val();

	$("#redirect").attr("href", "<?php echo base_url().'customer/CaseProgress/'?>"+course+"/"+cases);


});
</script>