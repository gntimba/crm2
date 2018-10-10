<div class="row">


	<div class="col-md-5">
		<div class="card">
			<div class="header">
				<h4 class="title">MonthlyReports</h4>
				<p class="category">Last Campaign Performance</p>
			</div>


			<div id="piechart"></div>

			<hr>
			<div class="stats">
				<i class="fa fa-history"></i><!-- Updated 3 minutes ago-->
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="header">
				<h4 class="title">Area chart</h4>

			</div>

			<div class="content">
				<div id="chart_div" style=" height: 250px;">
					<hr>
					<div class="stats">
						<i class="fa fa-clock-o"></i> <!--Campaign sent 2 days ago-->
					</div>
				</div>
			</div>
		</div>
	</div>






</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="header">
				<h4 class="title">MonthlyReports</h4>
				<p class="category">Last Campaign Performance</p>
			</div>
			<div class="content">

				<hr>
				<div id="piechart1" class="ct-chart ct-perfect-fourth"></div>
				<div class="stats">
					<i class="fa fa-clock-o"></i><!-- Campaign sent 2 days ago-->
				</div>
			</div>
		</div>
	</div>
</div>


<script type="application/javascript">
	$( document ).ready( function () {
		//disable the submit button
		//$(this).attr('disabled','true');$(this).css('cursor','progress');$(this).html('processing');

		$.ajax( {
			url: '<?php echo base_url()?>customer/dashjson',
			success: function ( data ) {
				//console.log( data );
				piechart( data );
				areaChart( data );
				bargraph();

				// createTableByJqueryEach(data);
				//enable the submit button
				// $('#myBtn').css('cursor','pointer');$('#myBtn').html('Submit');$('#myBtn').removeAttr('disabled');
			},
			async: true,
			dataType: 'json'
		} );


		//Area chart
		function areaChart( data ) {
			google.charts.load( 'current', {
				'packages': [ 'corechart' ]
			} );
			google.charts.setOnLoadCallback( drawChart );

			function drawChart() {
				var data1 = google.visualization.arrayToDataTable( [
					[ 'Status', 'Number of Customer Per Status' ],
					[ 'New Opportunity', data.newopportunity ],
					[ 'Not Attempted', data.notattempted ],
					[ 'Disqualified', data.disqualified ]
				] );

				var options = {
					title: 'Company Performance',
					hAxis: {
						title: 'Status',
						titleTextStyle: {
							color: '#000000'
							,
                     'width':400
						}
					},
					vAxis: {
						minValue: 0
					}
				};

				var chart = new google.visualization.AreaChart( document.getElementById( 'chart_div' ) );
				chart.draw( data1, options );
			}
		}

		//bargraph
		function bargraph() {
			var fullDate = new Date();
	
			google.charts.load( 'current', {
				'packages': [ 'bar' ]
			} );
			google.charts.setOnLoadCallback( drawChart );

			function drawChart() {

				var jsonData = $.ajax( {
					url: "<?php echo base_url()?>customer/dashtable",
					dataType: "json",
					async: false
				} ).responseText;

				var data = new google.visualization.DataTable( jsonData );

				var options = {
					chart: {
						title: 'Customer Leads',
						subtitle: fullDate.getFullYear()
					}

				};

				var chart = new google.charts.Bar( document.getElementById( 'piechart1' ) );

				chart.draw( data, google.charts.Bar.convertOptions( options ) );


			}
		}

		//Pie chart
		function piechart( data ) {

			google.charts.load( 'current', {
				'packages': [ 'corechart' ]
			} );
			google.charts.setOnLoadCallback( drawChart1 );

			function drawChart1() {
				var data1 = google.visualization.arrayToDataTable( [
					[ 'Status', 'Number of Customer Per Status' ],
					[ 'New Opportunity', data.newopportunity ],
					[ 'Not Attempted', data.notattempted ],
					[ 'Disqualified', data.disqualified ]

				] );

				var options1 = {
					title: '',

					is3D: true
				};


				var chart = new google.visualization.PieChart( document.getElementById( 'piechart' ) );

				chart.draw( data1, options1 );

			}
		}
	} );
</script>