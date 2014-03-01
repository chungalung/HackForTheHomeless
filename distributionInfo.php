<?php
	/*
	$north = var_dump($_POST['north']);
	$south = var_dump($_POST['south']);
	$east = var_dump($_POST['east']);
	$west = var_dump($_POST['west']);
	*/
	
	$north = $_GET['north'];
	$south = $_GET['south'];
	$east = $_GET['east'];
	$west = $_GET['west'];
	
	//echo $north;
	
	
	$data = array( "events" => array() );	
	$event = array( "name" => "TEST", "lat" => ($north+$south)/2.0 , "lng" => ($east+$west)/2.0,
					"address" => "TEST", "date" => "DATE", "start" => "5", "end" => "6" );
	$data["events"][] = $event;
	echo json_encode( $data );	
	
?>