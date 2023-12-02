<?php
    require ("header.php");
?>

<section class="saturs">
    <?php
        if(isset($_POST['klientsApskats'])){
            if(isset($_POST['klientsApskats'])){
                $id = $_POST['klientsApskats'];
                $sql = "SELECT * FROM klienti WHERE Klients_id = $id";
                $rezultats = mysqli_query($savienojums, $sql);

                while($row = mysqli_fetch_assoc($rezultats)){
                    echo "
                        <h1>Informācija par klientu</h1><hr>
                        <form method='POST' class='dati'>
                            <table>
                                <tr class='row'>
                                    <td>Vārds:</td>
                                    <td><input type='text' name='vards' value='{$row['Vards']}' maxlength='60' placeholder='Klienta vārds' class='box'></td>
                                </tr>
                                <tr class='row'>
                                    <td>Uzvārds:</td>
                                    <td><input type='text' name='uzvards' value='{$row['Uzvards']}' maxlength='60' placeholder='Klienta uzvārds*' class='box' required></td>
                                </tr>
                                <tr class='row'>
                                    <td>Tālrunis:</td>
                                    <td><input type='text' name='talrunis' value='{$row['Talrunis']}' maxlength='11' min='8' placeholder='Klienta tālrunis*' class='box' required></td>
                                </tr>
                                <tr class='row'>
                                    <td>E-pasts:</td>
                                    <td><input type='text' name='epasts' value='{$row['Epasts']}' maxlength='80' placeholder='Klienta e-pasts*' class='box'></td>
                                </tr>
                                <tr class='row'>
                                    <td>Adrese:</td>
                                    <td><input type='text' name='adrese' value='{$row['Adrese']}' maxlength='100' placeholder='Klienta adrese*' class='box' required></td>
                                </tr>
                                <tr class='row'>
                                    <td>Reģ. datums:</td>
                                    <td><input type='text' value='{$row['Pirmais_pieteikums']}' placeholder='Klienta adrese*' class='box set' readonly='readonly'></td>
                                </tr>
                                <tr class='row'>
                                    <td colspan='2'>
                                        <button type='submit' name='saglabat' value='{$row['Klients_id']}' class='btn'>Saglabāt</button>
                                        <button type='submit' name='dzest' value='{$row['Klients_id']}' class='btn'>Dzēst</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    ";
                }
            }
        }else if(isset($_POST['pievienotKlientu']) || isset($_POST['saglabat']) || isset($_POST['dzest'])){
            if(isset($_POST['pievienotKlientu'])){
                $vards = $_POST['vards'];
                $uzvards = $_POST['uzvards'];
                $talrunis = $_POST['talrunis'];
                $epasts = $_POST['epasts'];
                $adrese = $_POST['adrese'];

                if(!empty($uzvards) && !empty($talrunis) && !empty($adrese)){
                    if(empty($vards)){
                        $sql = "INSERT INTO klienti (Uzvards, Talrunis, Epasts, Adrese) VALUES ('$uzvards', '$talrunis', '$epasts', '$adrese')";
                    }else{
                        $sql = "INSERT INTO klienti (Vards, Uzvards, Talrunis, Epasts, Adrese) VALUES ('$vards', '$uzvards', '$talrunis', '$epasts', '$adrese')";
                    }

                    if(mysqli_query($savienojums, $sql)){
                        header("refresh: 1.5; url=klienti.php");
                        echo "
                            <div class='zinojums zals'>
                                Klients ir veiksmīgi pievienots!
                                <i class='fas fa-check'></i>
                            </div>
                        ";
                    }else{
                        header("refresh: 1.5; url=klienti.php");
                        echo "
                            <div class='zinojums sarkans'>
                                Nekorekts vaicājums!
                                <i class='fas fa-times'></i>
                            </div>
                        ";
                    }
                }else{
                    header("refresh: 1.5; url=klienti.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nepietiekams informācijas daudzums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }
            if(isset($_POST['saglabat'])){
                $id = $_POST['saglabat'];
                $vards = $_POST['vards'];
                $uzvards = $_POST['uzvards'];
                $talrunis = $_POST['talrunis'];
                $epasts = $_POST['epasts'];
                $adrese = $_POST['adrese'];

                if(!empty($uzvards) && !empty($talrunis) && !empty($adrese)){
                    $sql = "UPDATE klienti SET Vards = '$vards', Uzvards = '$uzvards', Talrunis = '$talrunis', Epasts = '$epasts', Adrese = '$adrese' WHERE Klients_id = $id";

                    if(mysqli_query($savienojums, $sql)){
                        header("refresh: 1.5; url=klienti.php");
                        echo "
                            <div class='zinojums zals'>
                                Klienta informācija veiksmīgi atjaunota!
                                <i class='fas fa-check'></i>
                            </div>
                        ";
                    }else{
                        header("refresh: 1.5; url=klienti.php");
                        echo "
                            <div class='zinojums sarkans'>
                                Nekorekts vaicājums!
                                <i class='fas fa-times'></i>
                            </div>
                        ";
                    }
                }else{
                    header("refresh: 1.5; url=klienti.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nepietiekams informācijas daudzums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }
            if(isset($_POST['dzest'])){
                $id = $_POST['dzest'];
                $sql = "CALL dzest_klientu ($id)";

                if(mysqli_query($savienojums, $sql)){
                    header("refresh: 1.5; url=klienti.php");
                    echo "
                        <div class='zinojums zals'>
                            Klients veiksmīgi dzēsts!
                            <i class='fas fa-check'></i>
                        </div>
                    ";
                }else{
                    header("refresh: 1.5; url=klienti.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nekorekts vaicājums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }
        }else{
            echo "
                <script>aktivs2('klients')</script>
                <h1>Pievienot jaunu klientu</h1><hr>
                <form method='POST' class='dati'>
                    <table>
                        <tr class='row'>
                            <td>Vārds:</td>
                            <td><input type='text' name='vards' maxlength='60' placeholder='Klienta vārds' class='box'></td>
                        </tr>
                        <tr class='row'>
                            <td>Uzvārds:</td>
                            <td><input type='text' name='uzvards' maxlength='60' placeholder='Klienta uzvārds*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Tālrunis:</td>
                            <td><input type='text' name='talrunis' maxlength='11' minlength='8' placeholder='Klienta tālrunis*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>E-pasts:</td>
                            <td><input type='text' name='epasts' maxlength='80' placeholder='Klienta e-pasts' class='box'></td>
                        </tr>
                        <tr class='row'>
                            <td>Adrese:</td>
                            <td><input type='text' name='adrese' maxlength='100' placeholder='Klienta adrese*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td colspan='2'>
                                <button type='submit' name='pievienotKlientu' class='btn'>Pievienot</button>
                            </td>
                        </tr>
                    </table>
                </form>
            ";
        }
    ?>
</section>

<?php
    include ("footer.php");
?>