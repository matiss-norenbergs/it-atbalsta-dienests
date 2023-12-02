<?php
    $lapa = "klienti";
    require ("header.php");
    echo "<script>aktivs('klienti')</script>";
?>

<section class="saturs">
    <h1>Reģistrētie klienti</h1><hr>
    <?php
        if(isset($_POST['kartot'])){
            $filtrs = $_POST['filtrs'];
        }else if(isset($_POST['mekletKlientu'])){
            $atrast = $_POST['meklet'];
        }
    ?>
    <table>
        <tr>
            <td colspan="8">
                <div class="filtri">
                    <a href="klienti.php" title="Notīrīt filtrus" class="btn">Notīrīt</a>
                    <form method="POST" class="meklesana">
                        <label for="meklet">Meklēt pēc vārda vai uzvārda: </label>
                        <input type="text" name="meklet" placeholder="Vārds / uzvārds..">
                        <input type="submit" name="mekletKlientu" value="Meklēt" class="btn">
                    </form>
                    <form method="POST" class="kartosana">
                        <label for="filtrs">Kārtot pēc: </label>
                        <select name="filtrs">
                            <?php
                                if($filtrs == "vecs"){
                                    echo "
                                        <option value='jauns'>Jaunākais vispirms</option>
                                        <option value='vecs' selected>Vecākais vispirms</option>
                                        <option value='vards'>Vārda</option>
                                        <option value='uzvards'>Uzvārda</option>
                                    ";
                                }else if($filtrs == "vards"){
                                    echo "
                                        <option value='jauns'>Jaunākais vispirms</option>
                                        <option value='vecs'>Vecākais vispirms</option>
                                        <option value='vards' selected>Vārda</option>
                                        <option value='uzvards'>Uzvārda</option>
                                    ";
                                }else if($filtrs == "uzvards"){
                                    echo "
                                        <option value='jauns'>Jaunākais vispirms</option>
                                        <option value='vecs'>Vecākais vispirms</option>
                                        <option value='vards'>Vārda</option>
                                        <option value='uzvards' selected>Uzvārda</option>
                                    ";
                                }else{
                                    echo "
                                        <option value='jauns' selected>Jaunākais vispirms</option>
                                        <option value='vecs'>Vecākais vispirms</option>
                                        <option value='vards'>Vārda</option>
                                        <option value='uzvards'>Uzvārda</option>
                                    ";
                                }
                            ?>
                        </select>
                        <input type="submit" name="kartot" value="Kārtot" class="btn">
                    </form>
                </div>
            </td>
        </tr>
        <tr>
            <th title="Numurs pēc kārtas">Nr. p. k.</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Tālrunis</th>
            <th>E-pasts</th>
            <th>Adrese</th>
            <th>Reģistrēšanas datums</th>
            <th></th>
        </tr>
        <?php
            if(isset($_POST['kartot']) || isset($_POST['mekletKlientu'])){
                if(isset($_POST['kartot'])){
                    $filtrs = $_POST['filtrs'];
                    
                    if($filtrs == "jauns"){
                        $sql = "SELECT * FROM jaunakie_klienti";
                    }else if($filtrs == "vecs"){
                        $sql = "SELECT * FROM vecakie_klienti";
                    }else if($filtrs == "vards"){
                        $sql = "SELECT * FROM kartot_klienti_vards";
                    }else{
                        $sql = "SELECT * FROM kartot_klienti_uzvards";
                    }
                }

                if(isset($_POST['mekletKlientu'])){
                    $filtrs = $_POST['meklet'];
                    $sql = "CALL atrast_klientu('$filtrs')";
                }
            }else{
                $sql = "SELECT * FROM jaunakie_klienti";
            }
            $rezultats = mysqli_query($savienojums, $sql);
            $nrpk = mysqli_num_rows($rezultats);

            while($row = mysqli_fetch_assoc($rezultats)){
                echo "
                    <tr>
                        <td>{$nrpk}.</td>
                        <td>{$row['Vards']}</td>
                        <td>{$row['Uzvards']}</td>
                        <td>{$row['Talrunis']}</td>
                        <td>{$row['Epasts']}</td>
                        <td>{$row['Adrese']}</td>
                        <td>{$row['Pirmais_pieteikums']}</td>
                        <td>
                            <form action='klients.php' method='POST'>
                                <button type='input' name='klientsApskats' value='{$row['Klients_id']}' class='btn small'>
                                    <i class='far fa-edit'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                ";
                $nrpk--;
            }
        ?>
    </table>
</section>

<?php
    include ("footer.php");
?>