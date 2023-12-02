<?php
    require ("header.php");
?>

<section class="saturs">
    <?php
        if(isset($_POST['izveidot'])){
            $lietotajs = $_SESSION['lietotajs_id'];
            $darbinieks = $_POST['darbinieks'];
            $klients = $_POST['klients'];
            $temats = $_POST['temats'];
            $problema = $_POST['problema'];

            if(!empty($lietotajs) && !empty($darbinieks) && !empty($klients) && !empty($temats) && !empty($problema)){

                $sql = "INSERT INTO problempieteikumi(Id_lietotajs, Id_darbinieks, Id_klients, Id_pieteikuma_temats, Problema)
                VALUES ('$lietotajs', '$darbinieks', '$klients', '$temats', '$problema')";

                if(mysqli_query($savienojums, $sql)){
                    header("refresh: 1.5; url=problempieteikumi.php");
                    echo "
                        <div class='zinojums zals'>
                            Pieteikums veiksmīgi reģistrēts!
                            <i class='fas fa-check'></i>
                        </div>
                    ";
                }else{
                    header("refresh: 1.5; url=problempieteikumi.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nekorekts vaicājums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }else{
                header("refresh: 1.5; url=problempieteikumi.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nepietiekams informācijas daudzums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['saglabat'])){
            $pieteikums = $_POST['saglabat'];
            $lietotajs = $_SESSION['lietotajs_id'];
            $darbinieks = $_POST['darbinieks'];
            $klients = $_POST['klients'];
            $statuss = $_POST['statuss'];
            $temats = $_POST['temats'];
            $piezimeId = $_POST['saglabat'];
            $piezime = $_POST['piezime'];
            $problema = $_POST['problema'];
            date_default_timezone_set('Europe/Riga');
            $izmainas = date('Y-m-d H:i:s', time());
            
            if($statuss >= 4){
                $pabeigts = $izmainas;
            }else{
                $pabeigts = "NULL";
            }

            $sqlPiezimes = "SELECT * FROM piezimes WHERE Piezime_id = $piezimeId";
            $piezimesRezultats = mysqli_query($savienojums, $sqlPiezimes);

            if(!empty($pieteikums) && !empty($lietotajs) && !empty($darbinieks) && !empty($klients) && !empty($statuss) && !empty($temats) && !empty($problema)){
                if(!empty($piezime) && mysqli_num_rows($piezimesRezultats) == 0){
                    $sqlPiezimePievienot = "INSERT INTO piezimes (Piezime_id, Piezime) VALUES ($piezimeId, '$piezime')";
                    if(mysqli_query($savienojums, $sqlPiezimePievienot)){
                        $sqlPieteikums = "UPDATE problempieteikumi SET Id_lietotajs = $lietotajs, Id_darbinieks = $darbinieks, Id_klients = $klients, Id_statuss = $statuss, Id_pieteikuma_temats = $temats, Id_piezime = $piezimeId,  Problema = '$problema', Apskatisanas_datums = '$izmainas', Pabeigsanas_datums = '$pabeigts' WHERE Pieteikums_id = $pieteikums";
                        if(mysqli_query($savienojums, $sqlPieteikums)){
                            header("refresh: 1.5; url=problempieteikumi.php");
                            echo "
                                <div class='zinojums zals'>
                                    Pieteikums veiksmīgi atjaunots!
                                    <i class='fas fa-check'></i>
                                </div>
                            ";
                        }else{
                            header("refresh: 1.5; url=problempieteikumi.php");
                            echo "
                                <div class='zinojums sarkans'>
                                    Neizdevās saglabāt pieteikumu!
                                    <i class='fas fa-times'></i><br>
                                </div>
                            ";
                        }
                    }else{
                        header("refresh: 1.5; url=problempieteikumi.php");
                        echo "
                            <div class='zinojums sarkans'>
                                Neizdevās pievienot darbinieka piezīmi!
                                <i class='fas fa-times'></i>
                            </div>
                        ";
                    }
                }else{
                    $sqlPiezimeAtjaunot = "UPDATE piezimes SET Piezime = '$piezime' WHERE Piezime_id = $piezimeId";
                    if(mysqli_query($savienojums, $sqlPiezimeAtjaunot)){
                        $sqlPieteikums = "UPDATE problempieteikumi SET Id_lietotajs = $lietotajs, Id_darbinieks = $darbinieks, Id_klients = $klients, Id_statuss = $statuss, Id_pieteikuma_temats = $temats, Problema = '$problema', Apskatisanas_datums = '$izmainas', Pabeigsanas_datums = '$pabeigts' WHERE Pieteikums_id = $pieteikums";
                        if(mysqli_query($savienojums, $sqlPieteikums)){
                            header("refresh: 1.5; url=problempieteikumi.php");
                            echo "
                                <div class='zinojums zals'>
                                    Pieteikums veiksmīgi atjaunots!
                                    <i class='fas fa-check'></i>
                                </div>
                            ";
                        }else{
                            header("refresh: 1.5; url=problempieteikumi.php");
                            echo "
                                <div class='zinojums sarkans'>
                                    Neizdevās saglabāt pieteikumu!
                                    <i class='fas fa-times'></i><br>
                                </div>
                            ";
                        }
                    }else{
                        header("refresh: 1.5; url=problempieteikumi.php");
                        echo "
                            <div class='zinojums sarkans'>
                                Neizdevās atjaunot darbinieka piezīmi!
                                <i class='fas fa-times'></i>
                            </div>
                        ";
                    }
                }
            }
        }else if(isset($_POST['dzest'])){
            $pieteikums = $_POST['dzest'];

            $dzest1 = "CALL dzest_pieteikumu ($pieteikums)";
            $dzest2 = "CALL dzest_piezimi ($pieteikums)";

            if(mysqli_query($savienojums, $dzest1) && mysqli_query($savienojums, $dzest2)){
                header("refresh: 1.5; url=problempieteikumi.php");
                echo "
                    <div class='zinojums zals'>
                        Pieteikums veiksmīgi dzēsts!
                        <i class='fas fa-check'></i>
                    </div>
                ";
            }else{
                header("refresh: 1.5; url=problempieteikumi.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nekorekts vaicājums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }

        }else if(isset($_POST['apskatit'])){
            $pieteikumsId = $_POST['apskatit'];

            $sql = "SELECT * FROM pieteikumu_informacija WHERE Pieteikums_id = $pieteikumsId";
            $rezultats = mysqli_query($savienojums, $sql);

            while($row = mysqli_fetch_assoc($rezultats)){
                $sakDarbinieks = $row['Darbinieks_id'];
                $sqlDarbinieki = "SELECT * FROM darbinieki WHERE Darbinieks_id <> $sakDarbinieks";
                $darbiniekiRezultats = mysqli_query($savienojums, $sqlDarbinieki);

                $sakKlients = $row['Klients_id'];
                $sqlKlienti = "SELECT * FROM klienti WHERE Klients_id <> $sakKlients";
                $klientiRezultats = mysqli_query($savienojums, $sqlKlienti);

                $sakTemats = $row['Pieteikuma_temata_id'];
                $sqlTemati = "SELECT * FROM pieteikuma_temati WHERE Pieteikuma_temata_id <> $sakTemats";
                $tematiRezultats = mysqli_query($savienojums, $sqlTemati);

                $sakStatuss = $row['Statuss_id'];
                $sqlStatusi = "SELECT * FROM statusi WHERE Statuss_id <> $sakStatuss";
                $statusiRezultats = mysqli_query($savienojums, $sqlStatusi);

                echo "
                    <h1>Problempieteikuma apskats</h1><hr>
                    <form method='POST' class='dati'>
                        <table>
                            <tr class='row'>
                                <td>Pēdējais administrētājs:</td>
                                <td><input type='text' value='{$row['Pēdējais administrētājs']}' class='box set' readonly='readonly'></td>
                            </tr>
                            <tr class='row'>
                                <td>Atbildīgais darbinieks:</td>
                                <td>
                                    <select name='darbinieks' class='box'>
                                        <option value='{$row['Darbinieks_id']}' selected>{$row['Atbildīgais darbinieks']}</option>";
                                        while($rowDarbinieks = mysqli_fetch_assoc($darbiniekiRezultats)){
                                            echo "
                                                <option value='{$rowDarbinieks['Darbinieks_id']}'>{$rowDarbinieks['Vards']} {$rowDarbinieks['Uzvards']}</option>
                                            ";
                                    }
                                echo "</select>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td>Klienta vārds, uzvārds:</td>
                                <td>
                                    <select name='klients' class='box'>
                                        <option value='{$row['Klients_id']}' selected>{$row['Klients']}</option>";
                                        while($rowKlients = mysqli_fetch_assoc($klientiRezultats)){
                                            echo "
                                                <option value='{$rowKlients['Klients_id']}'>{$rowKlients['Vards']} {$rowKlients['Uzvards']}</option>
                                            ";
                                        }
                                    echo "
                                    </select>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td>Pieteikuma temats:</td>
                                <td>
                                    <select name='temats' class='box'>
                                    <option value='{$row['Pieteikuma_temata_id']}' selected>{$row['Pieteikuma temats']}</option>";
                                    while($rowTemats = mysqli_fetch_assoc($tematiRezultats)){
                                        echo "
                                            <option value='{$rowTemats['Pieteikuma_temata_id']}'>{$rowTemats['Pieteikuma_temats']}</option>
                                        ";
                                    }
                                    echo "
                                    </select>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td>Problēmas apraksts:</td>
                                <td>
                                    <textarea name='problema' maxlength='1000' class='box' required>{$row['Problēmas apraksts']}</textarea>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td>Darbinieka piezīme:</td>
                                <td>
                                    <textarea name='piezime' maxlength='1000' class='box'>{$row['Darbinieka piezīme']}</textarea>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td>Iesniegšanas datums:</td>
                                <td><input type='text' value='{$row['Problēmas iesniegšanas datums']}' class='box set'  readonly='readonly'></td>
                            </tr>
                            <tr class='row'>
                                <td>Pēdējās izmaiņas:</td>
                                <td><input type='text' value='{$row['Pēdējās pieteikuma izmaiņas veiktas']}' class='box set'  readonly='readonly'></td>
                            </tr>
                            <tr class='row'>
                                <td>Atrisināšanas datums:</td>
                                <td><input type='text' value='{$row['Problēmas atrisināšanas datums']}' class='box set'  readonly='readonly'></td>
                            </tr>
                            <tr class='row'>
                                <td>Statuss:</td>
                                <td>
                                    <select name='statuss' class='box'>
                                        <option value='{$row['Statuss_id']}' selected>{$row['Pieteikuma statuss']}</option>";
                                        while($rowStatuss = mysqli_fetch_assoc($statusiRezultats)){
                                            echo "
                                                <option value='{$rowStatuss['Statuss_id']}'>{$rowStatuss['Statusa_nosaukums']}</option>
                                            ";
                                        }
                                    echo "
                                    </select>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td colspan='2'>
                                    <button type='submit' name='saglabat' value='{$row['Pieteikums_id']}' class='btn'>Saglabāt izmaiņas</button>
                                    <button type='submit' name='dzest' value='{$row['Pieteikums_id']}' class='btn'>Dzēst</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                ";
            }
        }else{
            $sqlDarbinieki = "SELECT * FROM darbinieki";
            $darbiniekiRezultats = mysqli_query($savienojums, $sqlDarbinieki);

            $sqlKlienti = "SELECT * FROM klienti ORDER BY Pirmais_pieteikums DESC, Klients_id DESC";
            $klientiRezultats = mysqli_query($savienojums, $sqlKlienti);

            $sqlTemati = "SELECT * FROM pieteikuma_temati";
            $tematiRezultats = mysqli_query($savienojums, $sqlTemati);

            echo "
                <script>aktivs2('problempieteikums')</script>
                <h1>Izveidot jaunu pieteikumu</h1><hr>
                <form method='POST' class='dati'>
                    <table>
                        <tr class='row'>
                            <td>Darbinieks:</td>
                            <td>
                                <select name='darbinieks' class='box'>
                                    <option selected>Atbildīgais darbinieks*</option>";
                                    while($row = mysqli_fetch_assoc($darbiniekiRezultats)){
                                        echo "
                                            <option value='{$row['Darbinieks_id']}'>{$row['Vards']} {$row['Uzvards']}</option>
                                        ";
                                    }
                                echo "</select>
                            </td>
                        </tr>
                        <tr class='row'>
                            <td>Klients:</td>
                            <td>
                                <select name='klients' class='box'>
                                    <option selected>Klients*</option>
                                    <optgroup label='Reģistrētie klienti:'>";
                                    while($row = mysqli_fetch_assoc($klientiRezultats)){
                                        echo "
                                            <option value='{$row['Klients_id']}'>{$row['Vards']} {$row['Uzvards']}</option>
                                        ";
                                    }
                                echo "
                                    </optgroup>
                                </select>
                            </td>       
                        </tr>
                        <tr class='row'>
                            <td>Temats:</td>
                            <td>
                                <select name='temats' class='box'>
                                    <option selected>Pieteikuma temats*</option>";
                                    while($row = mysqli_fetch_assoc($tematiRezultats)){
                                        echo "
                                            <option value='{$row['Pieteikuma_temata_id']}'>{$row['Pieteikuma_temats']}</option>
                                        ";
                                    }
                                echo "</select>
                            </td>
                        </tr>
                        <tr class='row'>
                            <td>Problēma:</td>
                            <td>
                                <textarea name='problema' placeholder='Pieteikuma problēmas apraksts*' maxlength='1000' class='box' required></textarea>
                            </td>
                        </tr>
                        <tr class='row'>
                            <td colspan='2'>
                                <input type='submit' name='izveidot' value='Reģistrēt' class='btn'>
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