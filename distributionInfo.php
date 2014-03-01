<?php
	$zoom = var_dump($_POST['zoom']);
	$lat = var_dump($_POST['lat']);
	$lng = var_dump($_POST['lng']);
	
	$data = array( "events" => array() );	
	
	$event = array( "name" => "TEST", "lat" => lat , "lng" => lng,
					"address" => "TEST", "date" => "DATE", "start" => "5", "end" => "6" );
	$data["events"][] = $event;
	echo json_encode( $data );	
?>