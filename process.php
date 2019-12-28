<?php
include 'action_page.php';

//Database credentials
$servername = "localhost";
$dusername = "root";
$dpassword = "";
$dbname = "scoreboard";

try {
    $connect = new PDO("mysql:host=$servername; dbname=$dbname", $dusername, $dpassword);
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
//Data Fetch from game table
$gameQuery = "SELECT * FROM game";
$queryHandle = $connect->prepare($gameQuery);
$queryHandle->execute();
$row = $queryHandle->fetch();

//fetched data Inerted into variables
$teamA = $row['teama'];
$teamB = $row['teamb'];

//Another Query string to fetch data from gamedetails table in an ascending order by score value 
$userQueryString = "SELECT * FROM gamedetails ORDER BY score DESC";
$queryHandle = $connect->prepare($userQueryString);
$queryHandle->execute();



//php variables and array initialization 
$teamAtotalscore = 0;
$teamBtotalscore = 0;
$avalue = 0;
$bvalue = 0;
$scorea=0;
$scoreb=0;
$teamAplayer = array();
$teamBplayer = array();
$teamAscore = array();
$teamBscore = array();
$mergeteamA = array();
$mergeteamB = array();
$ascendingAscore = array();
$descendingAscore = array();
$ascendingAscore = array();
$descendingBscore = array();
//loop to fetch all the rows available
while ($row = $queryHandle->fetch()) {
    $teamName = $row['team'];

    //compare name in the same ground ie. lowercase 
    if ((strtolower($teamName)) == (strtolower($teamA))) {
        $teamAtotalscore++;
        $teamAplayer[] = $row['player'];
        $teamAscore[] = $row['score'];
    } elseif ((strtolower($teamName)) == (strtolower($teamB))) {
        $teamBtotalscore++;

        $teamBplayer[] = $row['player'];
        $teamBscore[] = $row['score'];
        $mergeteamB = array_combine($teamBplayer, $teamBscore);
    }
    $scorea = 0 + array_sum($teamAscore);
    $scoreb = 0 + array_sum($teamBscore);
    $teamAplayercount = count($teamAplayer);
}

header("Location: displayscoreboard.php");


?>