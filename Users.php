<?php

$Server="50i50.org";
$Catalog="homeless";
$User="jesus";
$Password="ayala";

$mysqli = new mysqli($Server,$User,$Password,$Catalog);

if ($mysqli->errno) 
    printf("Unable to connect to the database:<br /> %s",$mysqli->error); 


require 'autoload.php';

function addDonor($username, $email, $password, $organization, $address, $phoneNumber, $type)
{
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
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$query = "SELECT `id`, `username`, `organization` FROM `donor` WHERE `username` = '$username AND `password` = '$password' LIMIT 1";
	$res = $mysqli->query($query);
	if (mysql_num_rows($res)) {
		return mysql_fetch_assoc($res);
	}
	return false;
}
function donorFindById($id)
{
	$query = "SELECT `id`, `username`, `organization` FROM `donor` WHERE `id` = '$id' LIMIT 1";
	$res = $mysqli->query($query);

	if (mysql_num_rows($res)) {
		return mysql_fetch_assoc($res);
	}

	return false;
}

function distributorLogin($username, $password)
{
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$query = "SELECT `id`, `username`, `organization` FROM `distributor` WHERE `username` = '$username AND `password` = '$password' LIMIT 1";
	$res = $mysqli->query($query);
	if (mysql_num_rows($res)) {
		return mysql_fetch_assoc($res);
	}
	return false;
}
function distributorFindById($id)
{
	$query = "SELECT `id`, `username`, `organization` FROM `distributor` WHERE `id` = '$id' LIMIT 1";
	$res = $mysqli->query($query);

	if (mysql_num_rows($res)) {
		return mysql_fetch_assoc($res);
	}

	return false;
}
function findDelivery($minLat, $maxLat, $minLon, $maxLon)
{
	//echo "success";
	$query = "SELECT * FROM `deliveries` WHERE `validated` = 0 AND $minLat < `latitude` AND $maxLat > `latitude` AND $minLon < `longitude` AND $maxLon > `longitude'";
	//echo "success";
	$res = $mysqli->query($query);
	//echo "success";
	if (mysql_num_rows($res)) {
		//echo "success";
		$info = mysqli_fetch_array($data);
		//echo "success";
		return $info;
	}
}
function findDistribution($minLat, $maxLat, $minLon, $maxLon)
{
	echo "success ";
	$query = "SELECT * FROM `distributions` WHERE `validated` = 0 AND $minLat < `latitude` AND $maxLat > `latitude` AND $minLon < `longitude` AND $maxLon > `longitude'";
	echo "success ";
	if ($mysqli->errno) 
    	echo "FAILED";
	
	$res = $mysqli->query($query);
	echo $res;
	echo "success ";
	if (mysql_num_rows($res)) {
		echo "success ";
		$info = mysqli_fetch_array($data);
		echo "success";
		return $info;
	}
}