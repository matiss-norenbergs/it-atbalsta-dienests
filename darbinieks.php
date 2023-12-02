<?php
    require ("header.php");
?>

<section class="saturs">
    <?php
        $now = date('Y-m-d', time());
        $min = date('Y-m-d', strtotime('-18 year'));
        
        if(isset($_POST['izveidot'])){
            $vards = $_POST['vards'];
            $uzvards = $_POST['uzvards'];
            $talrunis = $_POST['talrunis'];
            $epasts = $_POST['epasts'];
            $dzimis = $_POST['dzimis'];
            $maksa = $_POST['maksa'];
            $strada = $_POST['stradaNo'];

            if(!empty($vards) && !empty($uzvards) && !empty($talrunis) && !empty($epasts) && !empty($dzimis) && !empty($maksa) && !empty($strada)){
                $sql = "INSERT INTO darbinieki (Vards, Uzvards, Talrunis, Epasts, Dzimsanas_datums, Maksa_stunda, Darba_uzsaksanas_datums) VALUES ('$vards', '$uzvards', '$talrunis', '$epasts', '$dzimis', '$maksa', '$strada')";

                if(mysqli_query($savienojums, $sql)){
                    header("refresh: 1.5; url=darbinieki.php");
                    echo "
                        <div class='zinojums zals'>
                            Darbinieks veiksmīgi pievienots!
                            <i class='fas fa-check'></i>
                        </div>
                    ";
                }else{
                    header("refresh: 1.5; url=darbinieki.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nekorekts vaicājums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }else{
                header("refresh: 1.5; url=darbinieki.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nepietiekams informācijas daudzums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['saglabat'])){
            $darbinieksId = $_POST['saglabat'];
            $vards = $_POST['vards'];
            $uzvards = $_POST['uzvards'];
            $talrunis = $_POST['talrunis'];
            $epasts = $_POST['epasts'];
            $dzimis = $_POST['dzimis'];
            $maksa = $_POST['maksa'];
            $uzsacis = $_POST['stradaNo'];
            $aizgajis = $_POST['aizgajis'];

            if(!empty($darbinieksId) && !empty($vards) && !empty($uzvards) && !empty($talrunis) && !empty($epasts) && !empty($dzimis) && !empty($maksa) && !empty($uzsacis)){
                $sql = "UPDATE darbinieki SET Vards = '$vards', Uzvards = '$uzvards', Talrunis = '$talrunis', Epasts = '$epasts', Dzimsanas_datums = '$dzimis', Maksa_stunda = $maksa, Darba_uzsaksanas_datums = '$uzsacis', Darba_aiziesanas_datums = '$aizgajis' WHERE Darbinieks_id = $darbinieksId";

                if(mysqli_query($savienojums, $sql)){
                    header("refresh: 1.5; url=darbinieki.php");
                    echo "
                        <div class='zinojums zals'>
                            Darbinieka informācija veiksmīgi atjaunota!
                            <i class='fas fa-check'></i>
                        </div>
                    ";
                }else{
                    header("refresh: 1.5; url=darbinieki.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nekorekts vaicājums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }else{
                header("refresh: 1.5; url=darbinieki.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nepietiekams informācijas daudzums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['dzest'])){
            $darbinieksId = $_POST['dzest'];
            $sql = "DELETE FROM darbinieki WHERE Darbinieks_id = $darbinieksId";

            if(mysqli_query($savienojums, $sql)){
                header("refresh: 1.5; url=darbinieki.php");
                echo "
                    <div class='zinojums zals'>
                        Darbinieks veiksmīgi dzēsts!
                        <i class='fas fa-check'></i>
                    </div>
                ";
            }else{
                header("refresh: 1.5; url=darbinieki.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nekorekts vaicājums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['apskatit'])){
            $id = $_POST['apskatit'];
            $sql = "SELECT * FROM darbinieki WHERE Darbinieks_id = $id";
            $rezultats = mysqli_query($savienojums, $sql);
            
            while($row = mysqli_fetch_assoc($rezultats)){
                echo "
                    <h1>Informācija par darbinieku</h1><hr>
                    <form method='POST' class='dati'>
                        <table>
                            <tr class='row'>
                                <td>Darbinieka vārds:</td>
                                <td><input type='text' name='vards' value='{$row['Vards']}' maxlength='60' placeholder='Vārds*' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Darbinieka uzvārds:</td>
                                <td><input type='text' name='uzvards' value='{$row['Uzvards']}' maxlength='60' placeholder='Uzvārds*' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Darbinieka tālrunis:</td>
                                <td><input type='text' name='talrunis' value='{$row['Talrunis']}' minlength='8' maxlength='11' placeholder='Tālrunis*' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Darbinieka e-pasts:</td>
                                <td><input type='text' name='epasts' value='{$row['Epasts']}' maxlength='80' placeholder='E-pasts*' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Dzimšanas dati:</td>
                                <td><input type='date' name='dzimis' value='{$row['Dzimsanas_datums']}' max='{$min}' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Maksa/h:</td>
                                <td><input type='number' step='0.01' name='maksa' value='{$row['Maksa_stunda']}' placeholder='Maksa stundā*' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Darba uzsākšanas datums:</td>
                                <td><input type='date' name='stradaNo' value='{$row['Darba_uzsaksanas_datums']}' max='{$now}' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Aiziešanas datums:</td>
                                <td><input type='date' name='aizgajis' value='{$row['Darba_aiziesanas_datums']}' class='box'></td>
                            </tr>
                            <tr class='row'>
                                <td colspan='2'>
                                    <button type='submit' name='saglabat' value='{$row['Darbinieks_id']}' class='btn'>Saglabāt</button>
                                    <button type='submit' name='dzest' value='{$row['Darbinieks_id']}' class='btn'>Dzēst</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                ";
            }
        }else{
            echo "
                <script>aktivs2('darbinieks')</script>
                <h1>Pievienot jaunu darbinieku</h1><hr>
                <form method='POST' class='dati'>
                    <table>
                        <tr class='row'>
                            <td>Vārds:</td>
                            <td><input type='text' name='vards' maxlength='60' placeholder='Darbinieka vārds*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Uzvārds:</td>
                            <td><input type='text' name='uzvards' maxlength='60' placeholder='Darbinieka uzvārds*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Tālrunis:</td>
                            <td><input type='text' name='talrunis' minlength='8' maxlength='11' placeholder='Darbinieka tālrunis*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>E-pasts:</td>
                            <td><input type='text' name='epasts' maxlength='80' placeholder='Darbinieka e-pasts*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Dzimšanas dati:</td>
                            <td><input type='date' name='dzimis' max='{$min}' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Maksa/h:</td>
                            <td><input type='number' step='0.01' name='maksa' placeholder='Maksa stundā*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Pieņemšanas datums:</td>
                            <td><input type='date' name='stradaNo' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td colspan='2'><input type='submit' name='izveidot' value='Pievienot' class='btn'></td>
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