<link href="<?php echo base_url(); ?>assets/css/table.css" rel="stylesheet" type="text/css">
<legend><h5 align="center"><font  color="Green" face="Segoe" size="+6"> Case Member Management </font></h5></legend>


<form action="CaseProgress.php" method="POST">

        <label style="visibility:hidden"><b>Clicked_SalesID:&nbsp; &nbsp;</b></label>
        <input type="text" name="fname" id="fname" style="visibility:hidden"  readonly><br>
    <div align="center" class="one-third">
    <br>
    <label><font size="4">Search by:&nbsp;</font></label>
       SalesID:
    <input type="text"  name="Sales_ID" value="Search with SalesID"
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Sales_ID" onblur="TBlur(this.id);">
       &nbsp;
        Search Name:
    <input type="text"  name="Name_Text" value="Search with Name"
            onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Name_Text" onblur="TBlur(this.id);">
        &nbsp;
        Search Surname:
    <input type="text" name="Surname_Text"  value="Search with Surname"
           onkeyup="myFunction(this.id)" onclick="TClear(this.id)" id="Surname_Text" onblur="TBlur(this.id);">
        <br><br>
      
        <label name="lblviewname" id="lblviewname"><font size="4"></label>
        <input name="lblname" id="lblname" style="visibility:hidden">
        <input name="lblsurname" id="lblsurname" style="visibility:hidden">
        <input name="txtEmail" id="txtEmail" style="visibility:hidden">
        <input name="txtPhone" id="txtPhone" style="visibility:hidden">
        <input name="txtCompany" id="txtCompany" style="visibility:hidden">
        <input name="txtDesignation" id="txtDesignation" style="visibility:hidden">
        <input name="txtI_Status" id="txtI_Status" style="visibility:hidden">
        <input name="txtProd_Name" id="txtProd_Name" style="visibility:hidden">
        <input name="txtProd_Duration" id="txtProd_Duration" style="visibility:hidden">
        <input name="txtProd_Price" id="txtProd_Price" style="visibility:hidden">
    </div>
    </form>

        <form action="<?php echo "$_SERVER[PHP_SELF]"; ?>" method="POST">
			<div class="content table-responsive table-full-width" style="overflow:auto; height:350px;width:100%">

	<table class="data-table" align="center" id="table" border="1" style="cursor: pointer;">

		<thead>
				<th>Name</th>
				<th>Surname</th>
                                <th>Email</th>
				<th>Phone</th>
				<th>Company</th>
                                <th>Designation</th>
				<th>I_Status</th>
				<th>Prod_Name</th>
                                <th>Prod_Duration</th>
				<th>Prod_Price</th>
			</tr>
		</thead>
		<tbody>


                <?php
			foreach($cases as $case){
                   echo '<tr>
					<td>'.$case->Name.'</td>
					<td>'.$case->Surname.'</td>
					<td>'.$case->Email.'</td>
					<td>'.$case->Phone.'</td>
					<td>'.$case->Company.'</td>
					<td>'.$case->Designation.'</td>
					<td>'.$case->I_Status.'</td>
					<td>'.$case->Prod_Name.'</td>
					<td>'.$case->Prod_Duration.'</td>
					<td>'.$case->Prod_Price.'</td>

				</tr>';
			}
                 ?>
		</tbody>
	</table>
			</div>


           <script>

            function TClear(str)
            {
                document.getElementById(str).value= "";

                if(str == "Sales_ID")
                    {
                        document.getElementById('Name_Text').value= "Search with Name";
                        document.getElementById('Surname_Text').value= "Search with Surname";
                    }
                if(str == "Name_Text")
                    {
                        document.getElementById('Surname_Text').value= "Search with Surname";
                        document.getElementById('Sales_ID').value= "Search with Email";
                    }
                if(str == "Surname_Text")
                    {
                        document.getElementById('Name_Text').value= "Search with Name";
                        document.getElementById('Sales_ID').value= "Search with Email";
                    }

            }

         </Script>

           <script>

            function myFunction(str)
            {
                var input, filter, table, tr, td, i;
                input = document.getElementById(str);
                filter = input.value.toUpperCase();
                table = document.getElementById("table");
                tr = table.getElementsByTagName("tr");

                if(str == "Sales_ID")
                    {
                    var indx = 0;
                    for (i = 0; i < tr.length; i++)
                        {
                            td = tr[i].getElementsByTagName("td")[indx];

                            if (td)
                            {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
                                {
                                    tr[i].style.display = "";
                                }
                                else
                                {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }
                if(str == "Name_Text")
                    {
                    var indx = 1;
                    for (i = 0; i < tr.length; i++)
                        {
                            td = tr[i].getElementsByTagName("td")[indx];

                            if (td)
                            {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
                                {
                                    tr[i].style.display = "";
                                }
                                else
                                {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }
                if(str == "Surname_Text")
                    {
                    var indx = 2;
                    for (i = 0; i < tr.length; i++)
                        {
                            td = tr[i].getElementsByTagName("td")[indx];

                            if (td)
                            {
                                if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
                                {
                                    tr[i].style.display = "";
                                }
                                else
                                {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }

            }

         </Script>

        </form>


</fieldset>
