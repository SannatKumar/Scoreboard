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
//Data Fetch from game table
$gameQuery = "SELECT * FROM game";
$queryHandle = $connect->prepare($gameQuery);
$queryHandle->execute();
$row = $queryHandle->fetch();

//fetched data Inerted into variables
$teamA = $row['teama'];
$teamB = $row['teamb'];


//Another Query string to fetch data from gamedetails table in an ascending order by score value 
$userQueryString = "SELECT * FROM gamedetails ORDER BY score ASC";
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
            width: 25%;
            margin-left: 35%;
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
    <!--<form action="displayscoreboard.php" method="post">
    <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="submit"  value="asc" name ="asc"  class="btn btn-primary" id="asc">Ascending</button>
                    </div>
                    <div class="col">
                        <button type="submit" value="desc" name = "desc" class="btn btn-primary" id="desc">Descending</button>
                    </div>
                </div>
                    </div>
    </form>-->
    <div class="container px-lg-5">
        <div class="row mx-lg-n5">
            <div class="col py-3 px-lg-5 border bg-light">
                <table id="example" class="table table-striped table-bordered table-hover dataTable no-footer"cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                <thead>
              <tr role="row">
                <th
                  class="sorting"
                  tabindex="0"
                  aria-controls="example"
                  rowspan="1"
                  colspan="1"
                  aria-label="Team Name: activate to sort column ascending"
                  style="width: 77px;"
                >
                  Team Name
                </th>
                <th
                  class="sorting"
                  tabindex="0"
                  aria-controls="example"
                  rowspan="1"
                  colspan="1"
                  aria-label="Player Name: activate to sort column ascending"
                  style="width: 41px;"
                >
                  Player Name
                </th>
                <th
                  class="sorting"
                  tabindex="0"
                  aria-controls="example"
                  rowspan="1"
                  colspan="1"
                  aria-label="Score: activate to sort column ascending"
                  style="width: 49px;"
                >
                  Score
                  <i class="fa fa-camera-retro"></i>
                </th>
              </tr>
    </thead>
                    <tbody>
                        <!-- fixing.php-->
                        <?php
                              $Snvalue = 1;
                                foreach ($teamAplayer as $player) {
                                    echo '<tr>';
                                    echo '<td>' . $teamA . '</td>';
                                    echo '<td>' . $player . '</td>';
                                    echo '<td>' . $teamAscore[$avalue] . '</td>';
                                    echo '</tr>';
                                    $avalue++;
                                    $Snvalue++;
                                }
                                ?>

                        <!-- fixing.php-->


                    </tbody>
                </table>
            </div>
            <div class="col py-3 px-lg-5 border bg-light">
            <table id="example" class="table table-striped table-bordered table-hover dataTable no-footer"cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                <thead>
         
                <th
                  class="sorting"
                  tabindex="0"
                  aria-controls="example"
                  rowspan="1"
                  colspan="1"
                  aria-label="Team Name: activate to sort column ascending"
                  style="width: 77px;"
                >
                  Team Name
                </th>
                <th
                  class="sorting"
                  tabindex="0"
                  aria-controls="example"
                  rowspan="1"
                  colspan="1"
                  aria-label="Player Name: activate to sort column ascending"
                  style="width: 41px;"
                >
                  Player Name
                </th>
                <th
                  class="sorting"
                  tabindex="0"
                  aria-controls="example"
                  rowspan="1"
                  colspan="1"
                  aria-label="Score: activate to sort column ascending"
                  style="width: 49px;"
                >
                  Score
                </th>
              </tr>
    </thead>
                    <tbody>
                        <?php
                        $bsnvalue = 1;
                        foreach ($teamBplayer as $player) {


                            echo '<tr>';
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
                    <div class="col py-3 px-lg-5 border bg-light"><input type="text" name="scorer" class="form-control" id="exampleFormControlInputp" placeholder="Player Name" required></div>
                    <div class="col py-3 px-lg-5 border bg-light"><input type="number" name="score" class="form-control" placeholder="Score" min="1" required><br /><br /></div>
                </div>
            </div>
            <br /><br /><br /> <br />
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="submit" value="submit" class="btn btn-primary" id="submitbutton">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/dataTables.bootstrap4.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#example").DataTable();
        });
      </script>
      <link
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css"
        rel="stylesheet"
      /><link
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap4.min.css"
        rel="stylesheet"
      />

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
