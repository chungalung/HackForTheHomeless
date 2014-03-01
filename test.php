<?php
	//echo "BLAH";
	include "Users.php";
	//echo "BLAH";

	
	$result = findDistribution( -150, 150, 30, 40);
	echo $result;
	/*
	$data = array( "events" => array() );	
	if( result != false ){
		$event = array( "name" => "TEST", "lat" => ($north+$south)/2.0 , "lng" => ($east+$west)/2.0,
						"address" => "TEST", "date" => "DATE", "start" => "5", "end" => "6" );
		$data["events"][] = $event;
	}
	
	$data = array( "events" => array() );	
	$event = array( "name" => "feedThePoor", "lat" => 37.3184130 , "lng" => -121.8686210,
						"address" => "300-312 E Alma Ave San Jose, CA 95112", "start" => "2014-03-01 21:59:00", "end" => "2014-03-01 23:00:00" );
	$data["events"][] = $event;
	
	$event = array( "name" => "feedPoor", "lat" => 37.3229180 , "lng" => -121.8698220,
						"address" => "1131 S 9th St San Jose, CA 95112", "start" => "2014-03-01 16:00:00", "end" => "2014-03-01 20:00:00" );
	$data["events"][] = $event;
	
	echo json_encode( $data );	
	*/
?>