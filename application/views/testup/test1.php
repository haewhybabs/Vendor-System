<!DOCTYPE html>
<html>
 

<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
	  .coverpage{
	  	background: url("<?=base_url('assets/pdf_gen/CoverPage.jpg');?>");
	  	height: 100%; 
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: contain;
	  }
	  body, html {
		  height: 100%;
	  }
	  .page1{
	  	background: url("<?=base_url('assets/pdf_gen/InnerLeft.jpg');?>");
	  	height: 100%; 
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size:  contain;

	  }

	  .page2{
	  	background: url("<?=base_url('assets/pdf_gen/innerRight.jpg');?>");
	  	height: 100%; 
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: contain;

	  }
	  .backpage{

	  	background: url("<?=base_url('assets/pdf_gen/BackPage.jpg');?>");
	  	height: 100%; 
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: contain;

	  }
	  .page1_settings{
	  	text-align: right;
	  	padding-top: 180px;

	  }
	  .page2_settings{
	  	text-align: left;
	  	padding-top: 180px;

	  }

	  .table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
}
.name1{
	color: #749841;
	font-size: 15px;
	font-weight: bold;

}
.name2{
	color:  #6C4174;
	font-size: 15px;
	font-weight: bold;
}


	</style>
</head>

	<body>
		<div class="coverpage">
			
		</div>

		<!-- Bring up your first loop man -->
    
		<div class="page1" style="page-break-before: always;">
			<div class="page1_settings">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">

							
						</div>

						<div class="col-sm-6">

							<table class="table table-borderless">
								<tbody>
									<?php $i=1;?>
									<?php while($i<15):?>
									<tr>
										<td class="name1"><?=$i;?></td>
										<td class="name1">Ayobami BABALOLA</td>
										<td class="name2">Xown Solutions Ltd</td>
									</tr>
									<?php $i++;?>
									<?php endwhile;?>

									
								</tbody>
							</table>
							
						</div>
						
					</div>
					
				</div>

				
				
			</div>
				
			
		</div>

	

		<div class="page2" style="page-break-before: always;">
			<div class="page2_settings">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<table class="table table-borderless">
								<tbody>
									<?php $i=1;?>
									<?php while($i<15):?>
									<tr>
										<td class="name1"><?=$i;?></td>
										<td class="name1">Ayobami BABALOLA</td>
										<td class="name2">Xown Solutions Ltd</td>
									</tr>
									<?php $i++;?>
									<?php endwhile;?>

									
								</tbody>
							</table>

							
						</div>

						<div class="col-sm-6">

							
							
						</div>
						
					</div>
					
				</div>

				
				
			</div>
			
		</div>

		<!-- And this is the end of the loop boss-->

		<div class="backpage" style="page-break-before: always;">
			
		</div>
		


	</body>
</html>
