<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';

function getParams(&$kwota,&$lat,&$procent){
	$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$lat = isset($_REQUEST['lat']) ? $_REQUEST['lat'] : null;
	$procent = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;
}

function validate(&$kwota,&$lat,&$procent,&$messages){

	if ( ! (isset($kwota) && isset($lat) && isset($procent))) {
		return false;
	}

	if ( $kwota == "") {
		$messages [] = 'Nie podano kwoty kredytu';
	}
	if ( $lat == "") {
		$messages [] = 'Nie podano okresu kredytowania';
	}
	if ( $procent == "") {
		$messages [] = 'Nie podano oprocentowania';
	}

	if (count($messages) != 0) return false;

	if (! is_numeric($kwota)) {
		$messages [] = 'Kwota kredytu nie jest liczbą';
	}

	if (! is_numeric($lat)) {
		$messages [] = 'Okres kredytowania nie jest liczbą';
	}

	if (! is_numeric($procent)) {
		$messages [] = 'Oprocentowanie nie jest liczbą';
	}

	if (count($messages) != 0) return false;
	else return true;
}

function process(&$kwota,&$lat,&$procent,&$messages,&$rata){

	$n = $lat * 12;
	$r = ($procent / 100);
	$kwota_do_splaty = $kwota + ($kwota * $r * $lat);
	$rata = $kwota_do_splaty / $n;
	$rata = round($rata, 2);
}

$kwota = null;
$lat = null;
$procent = null;
$rata = null;
$messages = array();

getParams($kwota,$lat,$procent);
if (validate($kwota,$lat,$procent,$messages)) {
	process($kwota,$lat,$procent,$messages,$rata);
}
include 'calc_view.php';
?>