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
	$scorerTeam = $_POST['teamName'];
	$playerName =strtolower( $_POST['scorer']);
	$score = $_POST['score'];

	//SQL query statement execution

	$userQueryString = "SELECT * FROM gamedetails";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->execute();
	$count = 0;
while ($row = $queryHandle->fetch()) {
	if($row['player'] == $playerName){
		$count ++ ;	
	}

}

if($count > 0){
	
	$updateString = "UPDATE gamedetails SET score = score + '$score' WHERE player = '$playerName'";
	$queryHandle = $connect->prepare($updateString);
	$queryHandle->execute();
}
else{
	$userQueryString = "INSERT INTO `gamedetails`(`team`, `player`, `score`) VALUES (?,?,?)";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->bindParam(1, $scorerTeam);
	$queryHandle->bindParam(2, $playerName);
	$queryHandle->bindParam(3, $score);
	$queryHandle->execute();
}
	
	header("Location: displayscoreboard.php");

?>

