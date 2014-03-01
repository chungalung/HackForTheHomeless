<?php
	//echo "BLAH";
	include "Users.php";
	//echo "BLAH";

	
	$north = (double) $_GET['north'];
	$south = (double) $_GET['south'];
	$east = (double)  $_GET['east'];
	$west = (double) $_GET['west'];
	
	/*
	echo $north;
	echo $south;
	echo $east;
	echo $west;
	*/
	
	$result = findDistribution( $south, $north, $west, $east );
	//var_dump( $result);
	
	$data = array( "events" => array() );	
	if( result != false ){	
		foreach( $result as $event ){
			$distro = distributorFindById($event[1]);
			$data["events"][] = array( "name" => $distro[1], "lat" => $event[2] , "lng" => $event[3],
						"address" => $event[4], "start" => $event[5], "end" => $event[6] );
		}
	}

	
	/*
	$data = array( "events" => array() );	
	$event = array( "name" => "feedThePoor", "lat" => 37.3184130 , "lng" => -121.8686210,
						"address" => "300-312 E Alma Ave San Jose, CA 95112", "start" => "2014-03-01 21:59:00", "end" => "2014-03-01 23:00:00" );
	$data["events"][] = $event;
	
	$event = array( "name" => "feedPoor", "lat" => 37.3229180 , "lng" => -121.8698220,
						"address" => "1131 S 9th St San Jose, CA 95112", "start" => "2014-03-01 16:00:00", "end" => "2014-03-01 20:00:00" );
	$data["events"][] = $event;
	*/
	echo json_encode( $data );	
	
?>