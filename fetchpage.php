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
    

    $gameQuery = "SELECT * FROM game";
    $queryHandle = $connect->prepare($gameQuery);
    $queryHandle->execute();
    $row = $queryHandle->fetch();
    $teamA = $row['teama'];
	$teamB = $row['teamb'];
    


    $userQueryString = "SELECT * FROM gamedetails";
	$queryHandle = $connect->prepare($userQueryString);
    $queryHandle->execute();
    $teamAtotalscore = 0;
    $teamBtotalscore = 0;
    $teamAplayer = array();
    $teamBplayer = array();
    $teamAscore = array();
    $teamBscore = array();
    while($row = $queryHandle->fetch())
    {
        $teamName = $row['team'];
        

        if($teamName == $teamA)
        {
            $teamAtotalscore ++ ;
            $teamAplayer []= $row['player'];
            $teamAscore[] = $row['score'];
        }elseif(($teamName == $teamB)){
            $teamBtotalscore ++ ;
            $teamBplayer []= $row['player'];
            $teamBscore[] = $row['score'];
        }
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      #header {
        text-align: center;
        background: skyblue;
        height: 250px;
      }
      h1 {
        text-align: center;
      }
      body {
        background-color: tomato;
      }
      .container {
        background-color: grey;
      }
      .container .box {
        width: 1520px;
        display: table;
      }
      .container .box .box-row {
        display: table-row;
      }
      .container .box .box-cell {
        display: table-cell;
        border: 1px solid black;
        width: 50%;
        padding: 10px;
      }
    </style>
  </head>
  <body>
    <header id="header">
      <h1 style="text-align: center;">Scoreboard</h1>
      <div class="container">
      <div class="box">
        <div class="box-row">
      <div class="box-cell box1">
      <?php echo htmlspecialchars($teamA); ?>
      <h1>
          <?php
          
           echo $teamAtotalscore;
      
             ?></h1>

        </div>
          <div class="box-cell box2">
          <?php echo htmlspecialchars($teamB); ?>
          <h1>
          <?php
          
    echo $teamBtotalscore;
           ?>
          </h1>
    </div>
    </div>
          </div>
    </header>


    <div class="container">
      <div class="box">
        <div class="box-row">
          <div class="box-cell box1">
         <h4>Scorer:</h4><br>
         <h4> 
         <?php
            foreach($teamAplayer as $player){
                echo $player;
            }
          ?>
    </h4>


         
          </div>
          <div class="box-cell box2">
          <h4>Scorer:</h4>
          <h4>
          <?php
            foreach($teamBplayer as $player){
                echo $player;
            }
          ?>

    </h4>

          </div>
        </div>
      </div>
    </div>


  </body>
</html>

