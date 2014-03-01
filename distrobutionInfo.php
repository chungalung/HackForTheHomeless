<?php
	$zoom = var_dump($_POST['zoom']);
	$lat = var_dump($_POST['lat']);
	$lng = var_dump($_POST['lng']);
	
	$data = array( "events" => array() );
	
					events[i][0] = data["events"][i]["name"];
					events[i][1] = data["events"][i]["lat"];
					events[i][2] = data["events"][i]["lng"];
					events[i][3] = data["events"][i]["address"];
					events[i][4] = data["events"][i]["date"];
					events[i][5] = data["events"][i]["start"];
					events[i][6] = data["events"][i]["end"];
	
	
	$event = array( "name" => "TEST", "lat" => lat , "lng" => lng,
					"address" => "TEST", "date" => "DATE", "start" => "5", "end" => "6" );
	$data["events"][] = $event;
	echo json_encode( $data );	
?>