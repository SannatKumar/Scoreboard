<?php

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
      	}
  	catch(PDOException $e) {
      		echo "Connection failed: " . $e->getMessage();
          }

	//Assign the value from the dashboard page to the database
	$gameid = 1;
	$firstTeam = $_POST['teama'];
	echo $firstTeam;

	$secondTeam = $_POST['teamb'];
	echo $secondTeam;

	//Executing the insert statement to store the data into the database

	//$userQueryString = "INSERT INTO `game`(`gameid`, `teama`, `teamb`) VALUES (?,?,?)";
	$userQueryString = "UPDATE `game` SET `gameid`= ?,`teama`= ?,`teamb`= ? WHERE gameid = 1";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->bindParam(1, $gameid);
	$queryHandle->bindParam(2, $firstTeam);
	$queryHandle->bindParam(3, $secondTeam);
	$queryHandle->execute();
	header("Location: displayscoreboard.php");

?>

