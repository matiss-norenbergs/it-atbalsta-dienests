<?php
    require ("header.php");
    echo "<script>aktivs2('temati')</script>";
?>

<section class="saturs">
    <?php
        if(isset($_POST['saglabat'])){
            $id = $_POST['saglabat'];
            $temats = $_POST['temats'];
            if(!empty($temats)){
                $sql = "UPDATE pieteikuma_temati SET Pieteikuma_temats = '$temats' WHERE Pieteikuma_temata_id = $id";

                if(mysqli_query($savienojums, $sql)){
                    header("refresh: 1.5; url=temati.php");
                    echo "
                        <div class='zinojums zals'>
                            Temats veiksmīgi atjaunots!
                            <i class='fas fa-check'></i>
                        </div>
                    ";
                }else{
                    header("refresh: 1.5; url=temati.php");
                    echo "
                        <div class='zinojums sarkans'>
                            Nekorekts vaicājums!
                            <i class='fas fa-times'></i>
                        </div>
                    ";
                }
            }else{
                header("refresh: 1.5; url=temati.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nepietiekams informācijas daudzums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['dzest'])){
            $id = $_POST['dzest'];
            $sql = "DELETE FROM pieteikuma_temati WHERE Pieteikuma_temata_id = $id";

            if(mysqli_query($savienojums, $sql)){
                header("refresh: 1.5; url=temati.php");
                echo "
                    <div class='zinojums zals'>
                        Temats veiksmīgi dzēsts!
                        <i class='fas fa-check'></i>
                    </div>
                ";
            }else{
                header("refresh: 1.5; url=temati.php");
                echo "
                    <div class='zinojums sarkans'>
                        Nekorekts vaicājums!
                        <i class='fas fa-times'></i>
                    </div>
                ";
            }
        }else if(isset($_POST['rediget'])){
            $id = $_POST['rediget'];
            $sql = "SELECT * FROM pieteikuma_temati WHERE Pieteikuma_temata_id = $id";
            $rezultats = mysqli_query($savienojums, $sql);

            while($row = mysqli_fetch_assoc($rezultats)){
                echo "
                <h1>Pieteikuma temats</h1><hr>
                <form method='POST' class='dati'>
                    <table>
                        <tr class='row'>
                            <td>Temats:</td>
                            <td><input type='text' name='temats' value='{$row['Pieteikuma_temats']}' maxlength='60' placeholder='Īss temata apraksts*' class='box' required></td>
                        </tr>
                        <tr class='row'>
                            <td colspan='2'>
                                <button type='submit' name='saglabat' value='{$row['Pieteikuma_temata_id']}' class='btn'>Saglabāt</button>
                                <button type='submit' name='dzest' value='{$row['Pieteikuma_temata_id']}' class='btn'>Dzēst</button>
                            </td>
                        </tr>
                    </table>
                </form>
            ";
            }
        }else{
            header("refresh: 1.5; url=temati.php");
            echo "
                <div class='zinojums sarkans'>
                    Neatļauta piekļuve!
                    <i class='fas fa-times'></i>
                </div>
            ";
        }
    ?>
</section>

<?php
    include ("footer.php");
?>