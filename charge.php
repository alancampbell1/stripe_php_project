<?php
	require_once('vendor/autoload.php');
	require_once('config/db.php');
	require_once('lib/pdo_db.php');
	require_once('models/Customer.php');
	require_once('models/Transaction.php');


	//my api key linked in
	\Stripe\Stripe::setApiKey('sk_test_7tHft9msBbZ99j9OVCSbh0q8');


	//we now want to get the form data that is being submitted

	//sanitize POST ARRAY as a String to avoid harmful code

	$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	$first_name = $POST['first_name'];
	$last_name = $POST['last_name'];
	$email = $POST['email'];
	$token = $POST['stripeToken'];	//This means the credit card put in was valid

	//Create Customer in Stripe
	$customer = \Stripe\Customer::create(array(
	"email" => $email,
	"source" => $token
));
	
	//Charge the customer
	$charge = \Stripe\Charge::create(array(
		"amount" => 5000,
		"currency" => "usd",
		"description" => "Intro to React Course",
		"customer" => $customer->id
));

	//print_r($charge);

	//customer data
	$customerData = [
		'id' => $charge->customer,
		'first_name' => $first_name,
		'last_name' => $last_name,
		'email' => $email
	];

	//Instantiate Customer
	$customer = new Customer();

	//Add Customer To DB
	$customer->addCustomer($customerData);


	//transaction data
	$transactionData = [
		'id' => $charge->id,
		'customer_id' => $charge->customer,
		'product' => $charge->description,
		'amount' => $charge->amount,
		'currency' => $charge->currency,
		'status' => $charge->status,
	];

	//Instantiate transaction
	$transaction = new Transaction();

	//Add transaction To DB
	$transaction->addTransaction($transactionData);

	//Redirect to Sucess
	header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);

?>