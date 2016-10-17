<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Client Reports</title>
		<base href="<?php echo site_url() ?>"/>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		

		<div class="container">

			<div class="row">
				<form class="form-horizontal" id="filter-form" action="">
					<fieldset>

					<!-- Form Name -->
					<legend>Filter</legend>

					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="client">Select Client</label>
					  <div class="col-md-4">
					    <select id="clients" name="client_id" class="form-control">
					      	<option value="">Select Client</option>
					      	<?php foreach ($clients as $client): ?>
					      		<option value="<?php echo $client->client_id ?>"><?php echo $client->client_name ?></option>
					      	<?php endforeach ?>
					    </select>
					  </div>
					</div>

					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="product">Select Product</label>
					  <div class="col-md-4">
					    <select id="products" name="product_id" class="form-control">
					      	<option value="">Select Product</option>
					      	<?php foreach ($products as $product): ?>
					      		<option value="<?php echo $product->product_id ?>"><?php echo $product->product_description ?></option>
					      	<?php endforeach ?>
					    </select>
					  </div>
					</div>

					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="date">Select Date</label>
					  <div class="col-md-4">
					    <select id="date" name="date" class="form-control">
					      	
					      	<option value="0">Select Relative Date</option>
					      	<option value="1">Last Month To date</option>
					      	<option value="2">This Month</option>
					      	<option value="3">This Year</option>
					      	<option value="4">Last Year</option>

					    </select>
					  </div>
					</div>

					<div class="form-group">
					  <label class="col-md-4 control-label" for="singlebutton"></label>
					  <div class="col-md-4">
					    <button id="filter" name="filter" class="btn btn-primary">Filter</button>
					  </div>
					</div>

					</fieldset>


				</form>

			</div>
			<table class="table table-bordered">
			    <thead>
			      <tr>
			        <th>Invoice Number</th>
			        <th>Invoice Date</th>
			        <th>Product </th>
			        <th>Qty </th>
			        <th>Price </th>
					<th>Total </th>
								        
			      </tr>
			    </thead>
			    <tbody id="report-data">
			    	<?php foreach ($report as $re): ?>
			       <tr>
			        <td><?php echo $re->invoice_num ?></td>
			        <td><?php echo $re->invoice_date ?></td>
			        <td><?php echo $re->product_description ?> </td>
			        <td><?php echo $re->qty ?> </td>
			        <td><?php echo $re->price ?> </td>
					<td><?php echo $re->total ?> </td>
			      </tr>
			      <?php endforeach; ?>
			      <div class="row">
			        <div class="col-md-12 text-center" id="pagination">
			            <?php echo $pagination; ?>
			        </div>
			    </div>
			    </tbody>

			  </table>

		</div>  





		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>