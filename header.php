<?php
    session_start();
    if(empty($_SESSION['lietotajvards'])){
        header("location: login.php");
    }
    require ("connect.php");
    $aktivsLietotajs = $_SESSION['lietotajs_id'];
    $lietotajsSql = "SELECT * FROM lietotaji WHERE Lietotajs_id = $aktivsLietotajs";
    $lietotajsRezultats = mysqli_query($savienojums, $lietotajsSql);
    if(mysqli_num_rows($lietotajsRezultats) !== 1){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atblasta dienests</title>
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scriptAktivs.js"></script>
</head>
<body>
    <header>
        <h1><a href="index.php">IT atbalsta dienests</a></h1>
        <nav>
            <ul>
                <li>
                    <a href="index.php" id="sakums" class="">Sākums</a>
                </li>
                <li>
                    <a href="klienti.php" id="klienti" class="">Klienti</a>
                    <div class="dropdown">
                        <form action="klients.php">
                            <button type="submit" id="klients" class="">Pievienot</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a href="problempieteikumi.php" id="problempieteikumi" class="">Problēmpieteikumi</a>
                    <div class="dropdown">
                        <form action="problempieteikums.php">
                            <button type="submit" id="problempieteikums" class="">Pievienot</button>
                        </form>
                        <form action="temati.php">
                            <button type="submit" id="temati" class="">Temati</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a href="darbinieki.php" id="darbinieki" class="">Darbinieki</a>
                    <div class="dropdown">
                        <form action="darbinieks.php">
                            <button type="submit" id="darbinieks" class="">Pievienot</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a href="lietotaji.php" id="lietotaji" class="">Lietotāji</a>
                    <div class="dropdown">
                        <form action="lietotajs.php">
                            <button type="submit" id="lietotajs" class="">Pievienot</button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="btns">
            <?php
                $lietotajs = $_SESSION['lietotajvards'];
                echo "<label class='lietotajs'>Lietotājs: <span>$lietotajs</span></label>";

                if(isset($_POST['exit'])){
                    require ("logout.php");
                }
            ?>
            <div id="krasas-contents" class="sadala">
                <button id="krasas-btn" class="btn hover"><i class="fas fa-fill-drip"></i></button>
                <div id="krasas-dropdown" style="display: none;">
                    <h2>Pamatkrāsas:</h2><hr>
                    <div class="krasas">
                        <button id="balts" onclick="balts()"><i class="fas fa-tint"></i></button>
                        <button id="melns" onclick="melns()"><i class="fas fa-tint"></i></button>
                        <button id="dzeltens" onclick="dzeltens()"><i class="fas fa-tint"></i></button>
                        <button id="zils" onclick="zils()"><i class="fas fa-tint"></i></button>
                    </div>
                </div>
            </div>
            <form method="POST" class="sadala">
                <button type="submit" name="exit" class="btn hover"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </div>
    </header>