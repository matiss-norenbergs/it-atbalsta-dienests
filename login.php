<?php session_start();?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizācija</title>
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login">
    <section class="login-forma">
        <div class="auth">
            <form method="POST">
                <h1>Autorizācija</h1>
                <p>IT atbalsta dienests</p>
                <input type="text" name="username" placeholder="Lietotājvārds" class="box" required>
                <input type="password" name="password" placeholder="Parole" class="box" required>
                <input type="submit" name="login" value="Ielogoties" class="btn">
                <?php
                    if(isset($_POST['login'])){
                        require ("connect.php");

                        $lietotajs = mysqli_real_escape_string($savienojums, $_POST['username']);
                        $parole = mysqli_real_escape_string($savienojums, $_POST['password']);
                        $lietotajsVaicajums = "SELECT * FROM lietotaji WHERE Lietotajvards = '$lietotajs'";
                        $rezultats = mysqli_query($savienojums, $lietotajsVaicajums);

                        if(!empty($lietotajs) && !empty($parole)){
                            if(mysqli_num_rows($rezultats) == 1){
                                while($row = mysqli_fetch_array($rezultats)){
                                    if(password_verify($parole, $row['Parole'])){
                                        $_SESSION['lietotajvards'] = $lietotajs;
                                        $_SESSION['lietotajs_id'] = $row['Lietotajs_id'];
                                        $_SESSION['lietotajs_tips'] = $row['Tips'];
                                        header("location: index.php");
                                    }else{
                                        echo "<span>Nepareizs lietotājvārds vai parole!</span>";
                                    }
                                }
                            }else{
                                echo "<span>Kļūda sistēmā!</span>";
                            }
                        }else{
                            echo "<span>Atrasts tukšs ievades lauks!</span>";
                        }
                    }
                ?>
            </form>
        </div>
    </section>
</body>
</html>