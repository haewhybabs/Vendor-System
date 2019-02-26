<!DOCTYPE html>
<html>
 

<head>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
		.border_line {
		  border-bottom: double;

		}
		.headline{
			font-size: 17px;
			
		}
		.head_section{
			margin-top: 25px;
			text-align: left;
		}
		.test{
			text-align: center;
		}
		.margin_control{
			margin-top: 70px;
		}

	</style>
</head>

<body>
	<?php if($comments==false):?>
		<div class="well">No History Yet</div>
	<?php else:?>
	<?php foreach($requisition as $ri){

	}?>
	<div class="general">
		<div class="container">
			
		
			<div class="text-center">
				<div id="company">
			       <img src="http://e-procure.lfcww.org/assets/global/images/logo/new_logo.jpg" alt="LFC logo" >
			    </div>

				<h2>
					FAITH TABERNACLE, CANAANLAND, OTA
				</h2>
				<p style="font-size: 20px;"><?=$ri->dept_name;?> Department</p>
				
			</div>
			<div class="border_line"></div>

			<!-- Headline Section -->
			<div class="head_section">

				<h4><strong>To</strong> : <span class="headline">Church Administrator</span></h3>
				<h4><strong>Through</strong> : <span class="headline">Head Of Department</span></h3>
				<h4><strong>From</strong> : <span class="headline"><?=$ri->firstname;?> <?=$ri->lastname;?></span></h3>
				<?php 
				$d=strtotime("now");?>
					
				<h4><strong>Date</strong> : <span class="headline"><?=$ri->entry_date;?></span></h3>

				<h4><strong>Subject</strong> : <span class="headline"><?=$ri->purpose;?></span></h3>
				<?php if($budget==false):?>
				<?php else:?>

				<h4><strong>Budget Reference</strong> : <span class="headline"><?=$budget;?></span></h3>
				<?php endif;?>

				
				


			</div>
			<div class="border_line"></div><br>
			
			<h2>Requisition Details</h2>
			<p>The Requisition was requested by <?=$ri->firstname;?> <?=$ri->lastname;?> in <?=$ri->dept_name;?> Department</p>

			<table class="table">
			    <thead>
				    <tr>
				        <th>Product Name</th>
				        <th>Specification</th>
				        <th>Quantity</th>
				    </tr>
			    </thead>
			    <tbody>
			    	<?php foreach($requisition as $req):?>
				    <tr>
				        <td><?=$req->name;?></td>
				        <td><?=$req->product_specification;?></td>
				        <td><?=$req->quantity;?></td>
				    </tr>
					<?php endforeach;?>
			      
			    </tbody>
			</table>

			<h2>Requisition History</h2>
			<p>The Requisition was commented by the head of each Department</p>

			<table class="table">
			    <thead>
				    <tr>
				        <th>Comment From</th>
				        <th>Comment</th>
				        <th>Response</th>
				        
				       
				    </tr>
			    </thead>
			    <tbody>
			    	<?php foreach($comments as $com):?>
			    		<?php
                                                     if ($com->req_status_check_ID==1):
                                                      $x="Rejected By HOD";
                                                     elseif ($com->req_status_check_ID==2):
                                                         $x="HOD";
                                                     elseif ($com->req_status_check_ID==3):
                                                        $x= "Technical Review";
                                                      elseif ($com->req_status_check_ID==4):
                                                        $x= "Store";
                                                      elseif ($com->req_status_check_ID==5):
                                                        $x= "Church Administrator";
                                                      elseif ($com->req_status_check_ID==6):
                                                        $x= "Budget Control";
                                                      elseif ($com->req_status_check_ID==7):
                                                        $x= "Procurement Committee";
                                                      elseif ($com->req_status_check_ID==8):
                                                        $x= "Forensic ";

                                                       elseif ($com->req_status_check_ID==9):
                                                        $x= "Sap";
                                                        elseif ($com->req_status_check_ID==10):
                                                        $x= "Final Approval";
                                                    
                                                   ?>
                                       <?php endif;?>
				    <tr>
				        <td><?=$x;?></td>
				        <td>

				        	<?php if($com->comments==false){
				        		echo 'No Comment';
				        	}
				        	else{
				        		echo $com->comments;
				        	}
				        	
				        	?></td>
				        <td>
				        	 <?php if($com->response==1):
                                    echo "Concurred";
                                  ?>
                                <?php else:
                                  echo "Rejected";
                                endif;?>
				        </td>
				        
				    </tr>
					<?php endforeach;?>
			      
			    </tbody>
			</table>
			
		</div>
		

	</div>
		
		
	
<?php endif;?>
</body>
</html>