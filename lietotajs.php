<?php
    require ("header.php");
?>

<section class="saturs">
    <?php
        if(isset($_POST['izveidot'])){
            $vards = $_POST['vards'];
            $parole = $_POST['parole'];
            $parole2 = $_POST['parole2'];
            $epasts = $_POST['epasts'];
            $tips = $_POST['tips'];

            if(!empty($vards) && !empty($parole) && !empty($parole2) && !empty($epasts) && !empty($tips)){
                if($parole === $parole2){
                    $parole = password_hash($parole, PASSWORD_DEFAULT);
                    $sql = "CALL pievienot_lietotaju ('$vards', '$parole', '$epasts', '$tips')";
                    if(mysqli_query($savienojums, $sql)){
                        header("refresh: 1.5; url=lietotaji.php");
                        echo "
                            <div class='zinojums zals'>
                                Lietotājs veiksmīgi pievienots!
                                <i class='fas fa-check'></i>
                            </div>
                        ";
                    }else{
                        header("refresh: 1.5; url=lietotaji.php");
                        echo "
                            <div class='zinojums sarkans'>
                                Nekorekts vaicājums!
                                <i class='fas fa-times'></i>
                            </div>
                        ";
                    }
                }else{
                    header("refresh: 1.5; url=lietotaji.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Ievadītās paroles nesakrīt!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }else{
                header("refresh: 1.5; url=lietotaji.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nepietiekams informācijas daudzums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['saglabat'])){
            $id = $_POST['saglabat'];
            $vards = $_POST['vards'];
            $parole = $_POST['parole'];
            $parole2 = $_POST['parole2'];
            $epasts = $_POST['epasts'];
            $tips = $_POST['tips'];

            if(!empty($vards) && !empty($parole) && !empty($parole2) && !empty($epasts) && !empty($tips)){
                $sql = "SELECT * FROM lietotaji WHERE Lietotajs_id = $id";
                $rezultats = mysqli_query($savienojums, $sql);
                $vertiba;
                while($row = mysqli_fetch_assoc($rezultats)){
                    $vertiba = $row['Parole'];
                }
                if($parole == $parole2){
                    if($parole == $vertiba){
                        $sql = "UPDATE lietotaji SET Lietotajvards = '$vards', Epasts = '$epasts', Tips = '$tips' WHERE Lietotajs_id = $id";
                        if(mysqli_query($savienojums, $sql)){
                            header("refresh: 1.5; url=lietotaji.php");
                            echo "
                                <div class='zinojums zals'>
                                    Lietotāja informācija veiksmīgi atjaunota!
                                    <i class='fas fa-check'></i>
                                </div>
                            ";
                        }else{
                            header("refresh: 1.5; url=lietotaji.php");
                            echo "
                                <div class='zinojums sarkans'>
                                    Nekorekts vaicājums!
                                    <i class='fas fa-times'></i>
                                </div>
                            ";
                        }
                    }else{
                        $parole = password_hash($parole, PASSWORD_DEFAULT);
                        $sql = "UPDATE lietotaji SET Lietotajvards = '$vards', Parole = '$parole', Epasts = '$epasts', Tips = '$tips' WHERE Lietotajs_id = $id";
                        if(mysqli_query($savienojums, $sql)){
                            header("refresh: 1.5; url=lietotaji.php");
                            echo "
                                <div class='zinojums zals'>
                                    Lietotāja informācija veiksmīgi atjaunota!
                                    <i class='fas fa-check'></i>
                                </div>
                            ";
                        }else{
                            header("refresh: 1.5; url=lietotaji.php");
                            echo "
                                <div class='zinojums sarkans'>
                                    Nekorekts vaicājums!
                                    <i class='fas fa-times'></i>
                                </div>
                            ";
                        }
                    }
                }else{
                    header("refresh: 1.5; url=lietotaji.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Ievadītās paroles nesakrīt!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }else{
                header("refresh: 1.5; url=lietotaji.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nepietiekams informācijas daudzums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['dzest'])){
            $id = $_POST['dzest'];
            $sql = "DELETE FROM lietotaji WHERE Lietotajs_id = $id";

            if(mysqli_query($savienojums, $sql)){
                header("refresh: 1.5; url=lietotaji.php");
                echo "
                    <div class='zinojums zals'>
                        Lietotājs veiksmīgi dzēsts!
                        <i class='fas fa-check'></i>
                    </div>
                ";
            }else{
                header("refresh: 1.5; url=lietotaji.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nekorekts vaicājums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['apskatit'])){
            $id = $_POST['apskatit'];
            $sql = "SELECT * FROM lietotaji WHERE Lietotajs_id = $id";
            $rezultats = mysqli_query($savienojums, $sql);

            while($row = mysqli_fetch_assoc($rezultats)){
                $tips = $row['Tips'];
                $tipi = array("Lietotājs", "Administrātors", "Viesis");
                echo "
                    <h1>Pievienot jaunu lietotāju</h1><hr>
                    <form method='POST' class='dati'>
                        <table>
                            <tr class='row'>
                                <td>Lietotājvārds:</td>
                                <td><input type='text' name='vards' value='{$row['Lietotajvards']}' placeholder='Lietotājvārds*' maxlength='60' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Parole:</td>
                                <td><input type='password' name='parole' value='{$row['Parole']}' placeholder='Parole*' maxlength='250' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Parole atkārtoti:</td>
                                <td><input type='password' name='parole2' value='{$row['Parole']}' placeholder='Parole atkārtoti*' maxlength='250' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>E-pasts:</td>
                                <td><input type='text' name='epasts' value='{$row['Epasts']}' placeholder='E-pasts*' maxlength='80' class='box' required></td>
                            </tr>
                            <tr class='row'>
                                <td>Lietotāja tips:</td>
                                <td>
                                    <select name='tips' class='box'>
                                        <option value='{$tipi[0]}'"; echo ($tipi[0] == $tips ? "selected" : "").">{$tipi[0]}</option>
                                        <option value='{$tipi[1]}'"; echo ($tipi[1] == $tips ? "selected" : "").">{$tipi[1]}</option>
                                        <option value='{$tipi[2]}'"; echo ($tipi[2] == $tips ? "selected" : "").">{$tipi[2]}</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class='row'>
                                <td colspan='2'>
                                    <button type='submit' name='saglabat' value='{$row['Lietotajs_id']}' class='btn'>Saglabāt</button>
                                    <button type='submit' name='dzest' value='{$row['Lietotajs_id']}' class='btn'>Dzēst</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                ";
            }
        }else{
            echo "
                <script>aktivs2('lietotajs')</script>
                <h1>Pievienot jaunu lietotāju</h1><hr>
                <form method='POST' class='dati'>
                    <table>
                        <tr class='row'>
                            <td>Lietotājvārds:</td>
                            <td><input type='text' name='vards' placeholder='Lietotājvārds*' maxlength='60' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Parole:</td>
                            <td><input type='password' name='parole' placeholder='Parole*' maxlength='250' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Parole atkārtoti:</td>
                            <td><input type='password' name='parole2' placeholder='Parole atkārtoti*' maxlength='250' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>E-pasts:</td>
                            <td><input type='text' name='epasts' placeholder='E-pasts*' maxlength='80' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td>Lietotāja tips:</td>
                            <td>
                                <select name='tips' class='box'>
                                    <option value='Lietotājs' selected>Lietotājs</option>
                                    <option value='Administrātors'>Administrātors</option>
                                    <option value='Viesis'>Viesis</option>
                                </select>
                            </td>
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