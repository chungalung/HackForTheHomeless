<?php

	$result = findDistribution( 30,40,-150,0);
	echo $result;

function addDonor($username, $email, $password, $organization, $address, $phoneNumber, $type)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 
	
	require 'autoload.php';
	
	$geocoder = new \Geocoder\Geocoder();
	$adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
	$chain    = new \Geocoder\Provider\ChainProvider(array(
		new \Geocoder\Provider\GeocoderCaProvider($adapter),
		new \Geocoder\Provider\ArcGISOnlineProvider($adapter, 'USA', true),
		new \Geocoder\Provider\OpenStreetMapsProvider($adapter),
		new \Geocoder\Provider\GoogleMapsProvider($adapter, '', 'USA', true),
	));
	$geocoder->registerProvider($chain);

	$username = mysql_real_escape_string($username);
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	$organization = mysql_real_escape_string($organization);
	$address = mysql_real_escape_string($address);
	$phoneNumber = mysql_real_escape_string($phoneNumber);
	$type = mysql_real_escape_string($type);
	
	try
	{
		$geocode = $geocoder->geocode($address);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	$latitude = (float)$geocode->getLatitude();
	$longitude = (float)$geocode->getLongitude();
	
	$query = "INSERT INTO `donor` (`username`, `email`, `password`, `organization`, `address`, `phoneNumber`, `latitude`, `longitude`, `createDate`, `validated`, `type`)
VALUE('$username', '$email', '$password', '$organization', '$address', '$phoneNumber', '$latitude', '$longitude', NOW(), 0, $type)";
	$res = $mysqli->query($query);
	if ($res) {
		return mysql_insert_id();
	}
	return false;
}



function addDistributor($username, $email, $password, $organization, $address, $phoneNumber)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 

	require 'autoload.php';
	
	$geocoder = new \Geocoder\Geocoder();
	$adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
	$chain    = new \Geocoder\Provider\ChainProvider(array(
		new \Geocoder\Provider\GeocoderCaProvider($adapter),
		new \Geocoder\Provider\ArcGISOnlineProvider($adapter, 'USA', true),
		new \Geocoder\Provider\OpenStreetMapsProvider($adapter),
		new \Geocoder\Provider\GoogleMapsProvider($adapter, '', 'USA', true),
	));
	$geocoder->registerProvider($chain);

	$username = mysql_real_escape_string($username);
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	$organization = mysql_real_escape_string($organization);
	$address = mysql_real_escape_string($address);
	$phoneNumber = mysql_real_escape_string($phoneNumber);
	
	try
	{
		$geocode = $geocoder->geocode($address);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	$latitude = (float)$geocode->getLatitude();
	$longitude = (float)$geocode->getLongitude();
	
	$query = "INSERT INTO `donor` (`username`, `email`, `password`, `organization`, `address`, `phoneNumber`, `latitude`, `longitude`, `createDate`, `validated`)
VALUE('$username', '$email', '$password', '$organization', '$address', '$phoneNumber', '$latitude', '$longitude', NOW(), 0)";
	$res = $mysqli->query($query);
	if ($res) {
		return mysql_insert_id();
	}
	return false;
}

function donorLogin($username, $password)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 

	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$query = "SELECT `id`, `username`, `organization` FROM `donor` WHERE `username` = '$username AND `password` = '$password' LIMIT 1";
	$res = $mysqli->query($query);
	return mysqli_fetch_array($res);
}
function donorFindById($id)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 

	$query = "SELECT `id`, `username`, `organization` FROM `donor` WHERE `id` = '$id' LIMIT 1";
	$res = $mysqli->query($query);
	return mysqli_fetch_array($res);
}

function distributorLogin($username, $password)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 

	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$query = "SELECT `id`, `username`, `organization` FROM `distributor` WHERE `username` = '$username AND `password` = '$password' LIMIT 1";
	$res = $mysqli->query($query);
	return mysqli_fetch_array($res);
}
function distributorFindById($id)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 
	$query = "SELECT `id`, `username`, `organization` FROM `distributor` WHERE `id` = '$id' LIMIT 1";
	$res = $mysqli->query($query);
	return mysqli_fetch_array($res);
}
function findDelivery($minLat, $maxLat, $minLon, $maxLon)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error); 
		
	$query = "SELECT * FROM `deliveries` WHERE `validated` = 0 AND (`latitude` BETWEEN $minLat AND $maxLat) AND (`longitude` BETWEEN $minLon AND $maxLon)";
	//echo "success";
	$res = $mysqli->query($query);
	//echo "success";
	$info = mysqli_fetch_array($res);
	//echo "success";
	return $info;
}
function findDistribution($minLat, $maxLat, $minLon, $maxLon)
{
	$Server="50i50.org";
	$Catalog="homeless";
	$User="jesus";
	$Password="ayala";

	$mysqli = new mysqli($Server,$User,$Password,$Catalog);

	if ($mysqli->errno) 
		printf("Unable to connect to the database:<br /> %s",$mysqli->error);
		
	//echo "success ";
	$query = "SELECT * FROM `distributions` WHERE (`latitude` BETWEEN $minLat AND $maxLat) AND (`longitude` BETWEEN $minLon AND $maxLon) AND endTime > NOW()";
	//echo "success ";
	
	$res = $mysqli->query($query);

	$info = mysqli_fetch_array($res);
	//var_dump($info);
	return $info;
}
?>