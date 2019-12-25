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
?>
<?php
	$teamaName = $_POST['teamname'];
	$playerName = $_POST['playername'];
	$score = $_POST['score'];
	
	$userQueryString = "INSERT INTO `gamedetails`(`team`, `player`, `score`) VALUES (?,?,?)";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->bindParam(1, $teamaName);
	$queryHandle->bindParam(2, $playerName);
	$queryHandle->bindParam(3, $score);
	$queryHandle->execute();
    
?>

