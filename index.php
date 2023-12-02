<?php
    $lapa = "sakums";
    require ("header.php");
    echo "<script>aktivs('sakums')</script>";
?>

<section class="saturs">
    <h1>Uzņēmuma kopsavilkums</h1><hr>
    <div class="box-container">
        <div class="box">
            <h2>Reģistrēto klientu skaits: 
                <label>
                    <?php
                        $liet = "SELECT COUNT(Klients_id) FROM klienti";

                        $lietRezultats = mysqli_query($savienojums, $liet);

                        while($row = mysqli_fetch_assoc($lietRezultats)){
                            echo "{$row['COUNT(Klients_id)']}";
                        }
                    ?>
                </label>
            </h2>
        </div>
        <div class="box">
            <h2>Kopējais pieteikumu skaits: 
                <label>
                    <?php
                        require ("connect.php");

                        $liet = "SELECT COUNT(Pieteikums_id) FROM problempieteikumi";

                        $lietRezultats = mysqli_query($savienojums, $liet);

                        while($row = mysqli_fetch_assoc($lietRezultats)){
                            echo "{$row['COUNT(Pieteikums_id)']}";
                        }
                    ?>
                </label>
            </h2>
        </div>
        <div class="box">
            <h2>Noslēgti pieteikumi: 
                <label>
                    <?php
                        $liet = "SELECT COUNT(Pieteikums_id) FROM problempieteikumi WHERE Id_statuss BETWEEN 4 AND 7";

                        $lietRezultats = mysqli_query($savienojums, $liet);

                        while($row = mysqli_fetch_assoc($lietRezultats)){
                            echo "{$row['COUNT(Pieteikums_id)']}";
                        }
                    ?>
                </label>
            </h2>
        </div>
        <div class="box">
            <h2>Pieteikumi pēdējās 24h: 
                <label>
                    <?php
                        $liet = "SELECT COUNT(Pieteikums_id) FROM problempieteikumi WHERE Iesniegsanas_datums > DATE_SUB(CURDATE(), INTERVAL 1 DAY)";

                        $lietRezultats = mysqli_query($savienojums, $liet);

                        while($row = mysqli_fetch_assoc($lietRezultats)){
                            echo "{$row['COUNT(Pieteikums_id)']}";
                        }
                    ?>
                </label>
            </h2>
        </div>
    </div>
    <h1>Jaunākie pieteikumi</h1>
    <table>
        <tr>
            <th>Administrējis</th>
            <th>Darbinieks</th>
            <th>Klients</th>
            <th>Temats</th>
            <th>Darbinieka piezīme</th>
            <th>Izveidots</th>
            <th>Izmaiņas</th>
            <th>Pabeigts</th>
            <th>Statuss</th>
        </tr>

        <?php
            $sql = "SELECT * FROM pieteikumu_informacija LIMIT 10";
            $rezultats = mysqli_query($savienojums, $sql);

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
                        <td>{$row['Pēdējais administrētājs']}</td>
                        <td>{$row['Atbildīgais darbinieks']}</td>
                        <td>{$row['Klients']}</td>
                        <td>{$row['Pieteikuma temats']}</td>
                        <td>{$piezime}</td>
                        <td>{$row['Problēmas iesniegšanas datums']}</td>
                        <td>{$izmainas}</td>
                        <td>{$atrisinats}</td>
                        <td>{$row['Pieteikuma statuss']}</td>
                    </tr>
                ";
            }
        ?>

    </table>
</section>

<?php
    include ("footer.php");
?>