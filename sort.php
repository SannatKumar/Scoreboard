<?php
//include 'process.php';
//sorting the teamA ascending and descending
$teamAsort = array(
    $teamAplayer,
    $teamAscore
   );
array_multisort($teamAsort[1], SORT_NUMERIC, SORT_ASC,
                $teamAsort[0]);
//storing the ascended sorted score for team A 
$ascascore = array($teamAsort[0]);
$ascaplayer = array($teamAsort[1]);

//only sorting in descending order 
array_multisort($teamAsort[1], SORT_NUMERIC, SORT_DESC,
                $teamAsort[0]);

//storing the descended sorted score for team A
$dscascore = array($teamAsort[0]);
$dscaplayer = array($teamAsort[1]);

//sorting the teamB ascending and descending
$teamBsort= array(
    $teamBplayer,
    $teamBscore
   );
array_multisort($teamBsort[1], SORT_NUMERIC, SORT_ASC,
                $teamBsort[0]);
//storing the ascended sorted score for team A 
$ascbscore = array($teamBsort[0]);
$ascbplayer = array($teamBsort[1]);

//sorting the teamA ascending and descending
$teamAsortasc = array(
    $teamAplayer,
    $teamAscore
   );
array_multisort($teamBsort[1], SORT_NUMERIC, SORT_DESC,
                $teamBsort[0]);
//storing the ascended sorted score for team A 
$dscbscore = array($teamBsort[0]);
$dscbplayer = array($teamBsort[1]);

var_dump($ascascore);
var_dump($ascaplayer);
var_dump($dscascore);
var_dump($dscaplayer);

echo '<br>';

var_dump($ascbscore);
var_dump($ascbplayer);
var_dump($dscbscore);
var_dump($dscbplayer);



?>

