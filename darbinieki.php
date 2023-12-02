<?php
    $lapa = "darbinieki";
    require("header.php");
    echo "<script>aktivs('darbinieki')</script>";
?>

<section class="saturs">
    <h1>Darbinieku saraksts</h1><hr>
    <?php
        if(isset($_POST['kartot'])){
            $kartoPec = $_POST['filtrs'];
        }
    ?>
    <table>
        <tr>
            <td colspan='10'>
                <div class="filtri">
                    <a href="darbinieki.php" title="Notīrīt filtrus" class="btn">Notīrīt</a>
                    <form method="POST" class="kartosana">
                        <label for="filtrs">Kārtot pēc: </label>
                        <select name="filtrs">
                            <?php
                                if($kartoPec == "stradajosie"){
                                    echo "
                                        <option value='visi'>Visi</option>
                                        <option value='stradajosie' selected>Strādājošie</option>
                                        <option value='atlaistie'>Atlaistie</option>
                                    ";
                                }else if($kartoPec == "atlaistie"){
                                    echo "
                                        <option value='visi'>Visi</option>
                                        <option value='stradajosie'>Strādājošie</option>
                                        <option value='atlaistie' selected>Atlaistie</option>
                                    ";
                                }else{
                                    echo "
                                        <option value='visi' selected>Visi</option>
                                        <option value='stradajosie'>Strādājošie</option>
                                        <option value='atlaistie'>Atlaistie</option>
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
            <th>Nr. p. k.</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Tālrunis</th>
            <th>E-pasts</th>
            <th>Dzimis</th>
            <th>Maksa/h</th>
            <th>Pieņemts</th>
            <th>Aizgājis</th>
            <th></th>
        </tr>
        <?php
            if(isset($_POST['kartot'])){
                $kartoPec = $_POST['filtrs'];

                if($kartoPec == "stradajosie"){
                    $sql = "SELECT * FROM stradajosie_darbinieki";
                }else if($kartoPec == "atlaistie"){
                    $sql = "SELECT * FROM atlaistie_darbinieki";
                }else{
                    $sql = "SELECT * FROM darbinieki ORDER BY Darba_uzsaksanas_datums DESC";
                }
            }else{
                $sql = "SELECT * FROM darbinieki ORDER BY Darba_uzsaksanas_datums DESC";
            }

            $rezultats = mysqli_query($savienojums, $sql);
            $nrpk = mysqli_num_rows($rezultats);

            while($row = mysqli_fetch_assoc($rezultats)){
                if($row['Darba_aiziesanas_datums'] == NULL || $row['Darba_aiziesanas_datums'] == "0000-00-00"){
                    $aizgajis = "<label class='simbols sarkans'><i class='fas fa-times'></i></label>";
                }else{
                    $aizgajis = $row['Darba_aiziesanas_datums'];
                }
                echo "
                    <tr>
                        <td>{$nrpk}.</td>
                        <td>{$row['Vards']}</td>
                        <td>{$row['Uzvards']}</td>
                        <td>{$row['Talrunis']}</td>
                        <td>{$row['Epasts']}</td>
                        <td>{$row['Dzimsanas_datums']}</td>
                        <td>{$row['Maksa_stunda']}</td>
                        <td>{$row['Darba_uzsaksanas_datums']}</td>
                        <td>{$aizgajis}</td>
                        <td>
                            <form action='darbinieks.php' method='POST'>
                                <button type='input' name='apskatit' value='{$row['Darbinieks_id']}' class='btn small'>
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
    include("footer.php");
?>