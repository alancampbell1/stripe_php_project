<?php
	if(!empty($_GET['tid'] && !empty($_GET[ 'product']))){
		$GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

		$tid = $GET['tid'];
		$product = $GET['product'];
	} else{
		header('Location: index.php');

	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Thank you</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
	<div class="container mt-4">
		<h2>Thank you for purchasing <?php echo $product; ?></h2>
		<hr>
			<p>Your transaction ID is <?php echo $tid; ?></p>
			<p>Check your email for more information</p>
			<p><a href="index.php" class="btn btn-light mt-2">Go Back</a></p>
		</hr>
	</div>


</body>
</html>