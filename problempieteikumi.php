<?php
    $lapa = "pieteikumi";
    require ("header.php");
    echo "<script>aktivs('problempieteikumi')</script>";
?>

<section class="saturs">
    <h1>Reģistrētie pieteikumi</h1><hr>
    <?php
        if(isset($_POST['kartot'])){
            $kartoPec = $_POST['filtrs'];
        }
    ?>
    <table>
        <tr>
            <td colspan="11">
                <div class="filtri">
                    <a href="problempieteikumi.php" title="Notīrīt filtrus" class="btn">Notīrīt</a>
                    <form method="POST" class="kartosana">
                        <label for="filtrs">Kārtot pēc: </label>
                        <select name="filtrs">
                            <?php
                                if($kartoPec == "vecs"){
                                    echo "
                                        <option value='jauns'>Jaunākais</option>
                                        <option value='vecs' selected>Vecākais</option>
                                        <option value='atrisinats'>Atrisinātie</option>
                                        <option value='noslegts'>Noslēgtie</option>
                                        <option value='nepabeigts'>Nepabeigtie</option>
                                    ";
                                }else if($kartoPec == "atrisinats"){
                                    echo "
                                        <option value='jauns'>Jaunākais</option>
                                        <option value='vecs'>Vecākais</option>
                                        <option value='atrisinats' selected>Atrisinātie</option>
                                        <option value='noslegts'>Noslēgtie</option>
                                        <option value='nepabeigts'>Nepabeigtie</option>
                                    ";
                                }else if($kartoPec == "noslegts"){
                                    echo "
                                        <option value='jauns'>Jaunākais</option>
                                        <option value='vecs'>Vecākais</option>
                                        <option value='atrisinats'>Atrisinātie</option>
                                        <option value='noslegts' selected>Noslēgtie</option>
                                        <option value='nepabeigts'>Nepabeigtie</option>
                                    ";
                                }else if($kartoPec == "nepabeigts"){
                                    echo "
                                        <option value='jauns'>Jaunākais</option>
                                        <option value='vecs'>Vecākais</option>
                                        <option value='atrisinats'>Atrisinātie</option>
                                        <option value='noslegts'>Noslēgtie</option>
                                        <option value='nepabeigts' selected>Nepabeigtie</option>
                                    ";
                                }else{
                                    echo "
                                        <option value='jauns' selected>Jaunākais</option>
                                        <option value='vecs'>Vecākais</option>
                                        <option value='atrisinats'>Atrisinātie</option>
                                        <option value='noslegts'>Noslēgtie</option>
                                        <option value='nepabeigts'>Nepabeigtie</option>
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
            <th>Administrējis</th>
            <th>Darbinieks</th>
            <th>Klients</th>
            <th>Temats</th>
            <th>Darbinieka piezīme</th>
            <th>Izveidots</th>
            <th>Izmaiņas</th>
            <th>Pabeigts</th>
            <th>Statuss</th>
            <th></th>
        </tr>

        <?php
            require ("connect.php");

            if(isset($_POST['kartot'])){
                $kartoPec = $_POST['filtrs'];

                if($kartoPec == "jauns"){
                    $sql = "SELECT * FROM pieteikumu_informacija";
                }else if($kartoPec == "vecs"){
                    $sql = "SELECT * FROM pieteikumu_informacija_vecakie";
                }else if($kartoPec == "atrisinats"){
                    $sql = "SELECT * FROM atrisinati_problempieteikumi";
                }else if($kartoPec == "noslegts"){
                    $sql = "SELECT * FROM noslegti_problempieteikumi";
                }else{
                    $sql = "SELECT * FROM neatrisinati_problempieteikumi";
                }
            }else{
                $sql = "SELECT * FROM pieteikumu_informacija";
            }

            $rezultats = mysqli_query($savienojums, $sql);
            $nrpk = mysqli_num_rows($rezultats);

            while($row = mysqli_fetch_assoc($rezultats)){
                if($row['Darbinieka piezīme'] != NULL){
                    $piezime = "<label class='simbols zals'><i class='fas fa-check'></i></label>";
                }else{
                    $piezime = "<label class='simbols sarkans'><i class='fas fa-times'></i></label>";
                }
                if($row['Pēdējās pieteikuma izmaiņas veiktas'] != NULL){
                    $izmainas = "<label class='simbols zals'><i class='fas fa-check'></i></label>";
                }else{
                    $izmainas = "<label class='simbols sarkans'><i class='fas fa-times'></i></label>";
                }
                if($row['Problēmas atrisināšanas datums'] != NULL && $row['Problēmas atrisināšanas datums'] != "0000-00-00 00:00:00"){
                    $atrisinats = "<label class='simbols zals'><i class='fas fa-check'></i></label>";
                }else{
                    $atrisinats = "<label class='simbols sarkans'><i class='fas fa-times'></i></label>";
                }

                echo "
                    <tr>
                        <td>{$nrpk}.</td>
                        <td>{$row['Pēdējais administrētājs']}</td>
                        <td>{$row['Atbildīgais darbinieks']}</td>
                        <td>{$row['Klients']}</td>
                        <td>{$row['Pieteikuma temats']}</td>
                        <td>{$piezime}</td>
                        <td>{$row['Problēmas iesniegšanas datums']}</td>
                        <td>{$izmainas}</td>
                        <td>{$atrisinats}</td>
                        <td>{$row['Pieteikuma statuss']}</td>
                        <td>
                            <form action='problempieteikums.php' method='POST'>
                                <button type='input' name='apskatit' value='{$row['Pieteikums_id']}' class='btn small'>
                                    <i class='far fa-newspaper'></i>
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