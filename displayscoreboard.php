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
} catch (PDOException $e) {
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
while ($row = $queryHandle->fetch()) {
    $teamName = $row['team'];


    if ($teamName == $teamA) {
        $teamAtotalscore++;
        $teamAplayer[] = $row['player'];
        $teamAscore[] = $row['score'];
    } elseif (($teamName == $teamB)) {
        $teamBtotalscore++;
        $teamBplayer[] = $row['player'];
        $teamBscore[] = $row['score'];
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>scoreboard</title>
    <style>
        #header {
            text-align: center;
            background: skyblue;
            height: 150px;
        }
        .container .box {
            width: 1024px;
            display: table;
        }
        .container .box .box-row {
            display: table-row;
            }
        .container .box .box-cell {
            display: table-cell;
            width: 50%;
            padding: 10px;
        }
        
        .form-group{
            width: 100%;
            padding-bottom: 10%;
            padding-left: 5%;
            padding-right: 5%;
        }
        .form-control{
            float:left;
            width: 32%;
        }
        .form-group btn btn-primary{
            margin-top: 5%;
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
                            ?>
                        </h1>
                    </div>
                    <div class="box-cell box2">
                        <?php
                        echo htmlspecialchars($teamB);
                        ?>
                        <h1>
                            <?php
                            echo $teamBtotalscore;
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
    </header>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Team Name</th>
                <th scope="col">Player name</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Team Name</th>
                <th scope="col">Player Name</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
    <form action = "insertteam.php" method = "post">
        <div class="form-group">
        <input type="text" name = "teamName" class="form-control column" id="exampleFormControlInput1" placeholder="Team Name">
        <input type="text" name = "scorer" class="form-control" id="exampleFormControlInput1" placeholder="Player Name">
        <input type="number" name = "score" class="form-control" id="exampleFormControlInput1" placeholder="Score"><br /><br />
        <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>