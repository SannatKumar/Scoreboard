<?php

// this script takes the team name to the database and redirects the page
	require 'config.php';
	//Assign the value from the dashboard page to the database
	$gameid = 1;
	$firstTeam = $_POST['teama'];
	$secondTeam = $_POST['teamb'];

	//Executing the insert statement to store the data into the database

	//$userQueryString = "INSERT INTO `game`(`gameid`, `teama`, `teamb`) VALUES (?,?,?)";
	$userQueryString = "UPDATE `game` SET `gameid`= ?,`teama`= ?,`teamb`= ? WHERE gameid = 1";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->bindParam(1, $gameid);
	$queryHandle->bindParam(2, $firstTeam);
	$queryHandle->bindParam(3, $secondTeam);
	$queryHandle->execute();

	// redirect the page to displauyscoreboard
	header("Location: displayscoreboard.php");

?>

