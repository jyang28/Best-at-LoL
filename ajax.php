<?php
require 'vendor/autoload.php';
use LeagueWrap\Api;

$myKey = '59492bcc-6875-4422-81a5-57e2ca069696';
$api = new Api($myKey);
$summoner = $api->summoner();
$wins = 0;
$kills = 0;
$deaths = 0;
$assists = 0;
$dealt = 0;
$taken = 0;
$array = array("kills"=>"0","deaths"=>"0","assists"=>"0","dealt"=>"0","taken"=>"0","wins"=>"0");

$data = $_GET['data'];

    $summ  = $summoner->info($data);
	$id = $summ->id;
	$matchHistory = $api->matchHistory();
	$matches = $matchHistory->history($id);
	foreach ($matches as $summary)
	{		
		$temp2 = $summary -> participants[0] -> stats -> kills;
		$kills = $kills + $temp2;
		
		$temp3 = $summary -> participants[0] -> stats -> deaths;
		$deaths = $deaths + $temp3;
		
		$temp4 = $summary -> participants[0] -> stats -> assists;
		$assists = $assists + $temp4;
		
		$temp5 = $summary -> participants[0] -> stats -> totalDamageDealt;
		$dealt = $dealt + $temp5;
		
		$temp6 = $summary -> participants[0] -> stats -> totalDamageTaken;
		$taken = $taken + $temp6;
		
		$temp1 = $summary -> participants[0] -> stats -> winner;
		if($temp1 == true){$wins++;}
	}
	$array["kills"]= $kills;
	$array["deaths"]= $deaths;
	$array["assists"]= $assists;
	$array["dealt"]= $dealt;
	$array["taken"]= $taken;
	$array["wins"]= $wins;

echo json_encode($array);

?>