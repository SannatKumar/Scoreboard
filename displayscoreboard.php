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
$avalue = 0;
$bvalue = 0;
$teamAplayer = array();
$teamBplayer = array();
$teamAscore = array();
$teamBscore = array();
while ($row = $queryHandle->fetch()) {
    $teamName = $row['team'];


    if ((strtolower($teamName)) == (strtolower($teamA))) {
        $teamAtotalscore++;
        $teamAplayer[] = $row['player'];
        $teamAscore[] = $row['score'];
    } elseif ((strtolower($teamName)) == (strtolower($teamB))) {
        $teamBtotalscore++;
        $teamBplayer[] = $row['player'];
        $teamBscore[] = $row['score'];
    }
    $scorea = 0;
    $scorea = array_sum($teamAscore);
    $scoreb = 0;
    $scoreb = array_sum($teamBscore);
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

        .form-group {
            width: 100%;
            padding-left: 5%;
            padding-right: 5%;
        }

        .form-control {
            float: left;
            width: 20%;
        }

        .form-group btn btn-primary {
            margin-top: 5%;
        }

        #exampleFormControlInputp {
            width: 400px;
        }

        #submitbutton {
            width: 50%;
            margin-left: 25%;
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
                            echo $scorea;
                            ?>
                        </h1>
                    </div>
                    <div class="box-cell box2">
                        <?php
                        echo htmlspecialchars($teamB);
                        ?>
                        <h1>
                            <?php
                            echo $scoreb;
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
    </header>
    <div class="container px-lg-5">
        <div class="row mx-lg-n5">
            <div class="col py-3 px-lg-5 border bg-light">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Team Name</th>
                            <th scope="col">Player name</th>
                            <th scope="col">Score <i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $Snvalue = 1;
                        foreach ($teamAplayer as $player) {
                            echo '<tr>';
                            echo
                                '<th scope="row">' . $Snvalue . '</th>';
                            echo '<td>' . $teamA . '</td>';
                            echo '<td>' . $player . '</td>';
                            echo '<td>' . $teamAscore[$avalue] . '</td>';
                            echo '</tr>';
                            $avalue++;
                            $Snvalue++;
                        }
                        ?>


                    </tbody>
                </table>
            </div>
            <div class="col py-3 px-lg-5 border bg-light">
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
                        <?php
                        $bsnvalue = 1;
                        foreach ($teamBplayer as $player) {


                            echo '<tr>';
                            echo '<th scope="row">' . $bsnvalue . '</th>';
                            echo '<td>' . $teamB . '</td>';
                            echo '<td>' . $player . '</td>';
                            echo '<td>' . $teamBscore[$bvalue] . '</td>';
                            echo '</tr>';
                            $bvalue++;
                            $bsnvalue++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <form action="action_page.php" method="post">
        <div class="form-group">
            <div class="container px-lg-5">
                <div class="row mx-lg-n5">
                    <div class="col py-3 px-lg-5 border bg-light">
                        <div>
                            <input type="radio" name="teamName" value="<?php echo htmlspecialchars($teamA); ?>" class="form-control" id="exampleFormControlInputr1" checked><?php echo htmlspecialchars($teamA); ?><br />
                        </div>
                    </div>
                    <div class="col py-3 px-lg-5 border bg-light">
                        <div>
                            <input type="radio" name="teamName" value="<?php echo htmlspecialchars($teamB); ?>" class="form-control" id="exampleFormControlInputr2"><?php echo htmlspecialchars($teamB); ?><br>
                        </div>
                    </div>
                </div>
            </div>


            <br>


            <div class="container px-lg-5">
                <div class="row mx-lg-n5">
                    <div class="col py-3 px-lg-5 border bg-light"><input type="text" name="scorer" class="form-control" id="exampleFormControlInputp" placeholder="Player Name"></div>
                    <div class="col py-3 px-lg-5 border bg-light"><input type="number" name="score"  placeholder="Score"><br /><br /></div>
                </div>
            </div>
            <br /><br />
            <br />
            <div class="container">
                <div class="row">
                    <div class="col">

                        <button type="submit" value="Submit" class="btn btn-primary" id="submitbutton">Submit</button>
                    </div>
                </div>



            </div>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>