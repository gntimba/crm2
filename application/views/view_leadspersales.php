 <?php //var_dump($target);?>

 
  <link href="<?php echo base_url() ?>assets/css/table.css" rel="stylesheet" type="text/css">
<body>
  <div class="container">
    <h1></h1>
	<div class="progress">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	
	<form id="regiration_form" novalidate action=""  method="post">
	<fieldset>
		<font size="20"><strong><h1>View Leads Per Sale's Person</h1></font></strong>
        <hr><br>
        <font size="3">
        
        <div style="margin-left: 4%">
        Select Sales Rep: <select id='sales' name="Sales_name" style="width: 130px;" required>
<option value="" disabled selected>Select a name</option>

<?php

	
	              foreach ( $salesid as $sale ) {
              echo "<option value='".$sale->SalesID."'>".$sale->S_Name."</option>";
			   }

?>

</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Select Status of lead: <select id="status" name="lead_status" style="width: 140px;" required>
<option value="" disabled selected>Select lead type</option>

<?php

	
		              foreach ( $status as $statuses ) {
              echo "<option value='".$statuses->I_Status."'>".$statuses->I_Status."</option>";
			   }
	
?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Select the month: <select id="month" name="month" style="width: 130px;" required>
<option value="" disabled selected>Select duration</option>
<!-- <option value="Weekly" selected>Weekly</option> -->

<?php
	
			        foreach ( $months as $month ) {
              echo "<option value='".$month->date2."'>".$month->date2."</option>";
			   }
	
?>
</select>
</font>
</div>
<br> 
<br> 

<div style="margin-left: 45%">
  <font size="3"> <input id="submit" type="submit" name="submit" value="View leads"></font>
   </div>
    
<br>
   
     <div style="overflow-x:auto;">
      <br>
<!--table-->
<div id="forTable"></div>
    </div>
    <br>
    <td width='80' class='center'>
    <?php
	
echo "<font color=#E92326 size='4'><strong><center> NB: YOU CAN NOT VIEW THE GRAPH OR EXPORT DATA BEFORE YOU TABLE VIEW A SALES REPRESENTATIVE</center></font></strong>"

?>


</td>
<!--NEXT BUTTON-->
<input type="button" name="data[password]" class="next btn btn-info" value="Next" style="height: 40px; width: 80px;"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 


<!-- <button formaction="ExportleadsAgain.php" class="btn btn-primary">Export leads</button> -->
</fieldset>

<!-- chart -->
<fieldset>
		<font size="20"><strong><h1>Pie Chart</h1></font></strong>
        <hr>

    <div id="piechart" style="width: 1500px; height: 700px;"></div>
    
    <style type="text/css">
    .btn {
        background-color: #0FBEC7;
        cursor:pointer;
    }
</style>
    
    <!--PREVIOUS BUTTON-->
		<input type="button" name="previous" class="previous btn btn-default" value="Previous" style="height: 40px; width: 80px;"/>
	
    </fieldset>

    
	</form>
  </div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	var current = 1,current_step,next_step,steps;
	steps = $("fieldset").length;
	$(".next").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().next();
		next_step.show();
		current_step.hide();
		setProgressBar(++current);
	});
	$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
		percent = percent.toFixed();
		$(".progress-bar")
			.css("width",percent+"%")
			.html(percent+"%");		
	}
});
</script>
<!-- <div id="forTable"></div> -->
<script>

$(document).ready(function(){
  $("#submit").click(function(e){
	  e.preventDefault();
	  $("#forTable").empty();
	  var sales=$('#sales').val();
	 var status= $('#status').val();
	  var month=$('#month').val();
	  
    //disable the submit button
    //$(this).attr('disabled','true');$(this).css('cursor','progress');$(this).html('processing');
    $.ajax({
      url: 'http://localhost/crm2/customer/table?sales='+sales+'&status='+status+'&month='+month,
      success: function(data,status)
      {
		//  console.log(data);
        createTableByForLoop(data);
		piechart(data);
       // createTableByJqueryEach(data);
        //enable the submit button
       // $('#myBtn').css('cursor','pointer');$('#myBtn').html('Submit');$('#myBtn').removeAttr('disabled');
      },
      async:   true,
      dataType: 'json'
    }); 
  });
});
 
function createTableByForLoop(data)
{
  var eTable="<table  align='center' class='data-table' id='table'  border='1' style='cursor: pointer;'><thead><tr><th>Sale_ID</th><th>Customer_ID</th><th>Customer_Name</th><th>Customer_Surname</th><th>Cusstomer_Phone</th><th>Customer_Email</th><th>Course</th><th>Status</th><th>Date</th></tr></thead><tbody>";
  for(var i=0; i<data.table.length;i++)
  {
    eTable += "<tr>";
    eTable += "<td>"+data.table[i]['salesid']+"</td>";
	eTable += "<td>"+data.table[i]['custid']+"</td>";
	eTable += "<td>"+data.table[i]['name']+"</td>";
	eTable += "<td>"+data.table[i]['surname']+"</td>";
	eTable += "<td>"+data.table[i]['phone']+"</td>";
	eTable += "<td>"+data.table[i]['email']+"</td>";
	eTable += "<td>"+data.table[i]['product']+"</td>";
    eTable += "<td>"+data.table[i]['I_Status']+"</td>";
    eTable += "<td>"+data.table[i]['Date']+"</td>";
    eTable += "</tr>";
  }
  eTable +="</tbody></table>";
  $('#forTable').html(eTable);
}

function piechart(data)
{
 
       google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {  
        var data1 = google.visualization.arrayToDataTable([
         ['Months', 'Number of Leads per month'],
         ['Target', data.target],
         ['Leads', data.lead]

        ]);

        var options1 = {
			title: '',
			 'width':1500, 'height':700,
		is3D: true,
           };


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data1, options1);
		
      }
}
 
function createTableByJqueryEach(data)
{
 
 
  var eTable="<table><thead><tr><th colspan='3'>Created by Jquery each</th></tr><tr><th>Name</th><th>Title</th><th>Salary</th</tr></thead><tbody>"
  $.each(data,function(index, row){
    // eTable += "<tr>";
    // eTable += "<td>"+value['name']+"</td>";
    // eTable += "<td>"+value['title']+"</td>";
    // eTable += "<td>"+value['salary']+"</td>";
    // eTable += "</tr>";
 
    eTable += "<tr>";
    $.each(row,function(key,value){
      eTable += "<td>"+value+"</td>";
    });
    eTable += "</tr>";
  });
  eTable +="</tbody></table>";
  $('#eachTable').html(eTable);
}
</script>



