<?php
    require ("header.php");
    echo "<script>aktivs2('temati')</script>";
?>

<section class="saturs">
    <h1>Pieteikumu temati</h1><hr>

    <table>
        <tr>
            <th>Īss temata apraksts</th>
            <th></th>
        </tr>
        <?php
            if(isset($_POST['pievienot'])){
                $temats = $_POST['temats'];
                if(!empty($temats)){
                    $pievienot = "INSERT INTO pieteikuma_temati (Pieteikuma_temats) VALUES ('$temats')";
                    if(mysqli_query($savienojums, $pievienot)){
                        header("refresh: 1.5; url=temati.php");
                        echo "<span class='zina zals'>Temats veiksmīgi pievienots!</span>";
                    }else{
                        header("refresh: 1.5; url=temati.php");
                        echo "<span class='zina sarkans'>Nekorekts vaicājums!</span>";
                    }
                }else{
                    header("refresh: 1.5; url=temati.php");
                    echo "<span class='zina sarkans'>Tukšs ievades lauks!</span>";
                }
            }

            $sql = "SELECT * FROM pieteikuma_temati";
            $rezultats = mysqli_query($savienojums, $sql);

            while($row = mysqli_fetch_assoc($rezultats)){
                echo "
                    <tr>
                        <td>{$row['Pieteikuma_temats']}</td>
                        <td>
                            <form action='temats.php' method='POST'>
                                <button type='input' name='rediget' value='{$row['Pieteikuma_temata_id']}' class='btn small'>
                                    <i class='far fa-edit'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                ";
            }
        ?>
        <tr>
            <td colspan='2'>
                <form method="POST" class="temati">
                    <input type="text" name="temats" placeholder="Īss temata apraksts*" class="box" maxlength="60" required>
                    <input type="submit" name="pievienot" value="Pievienot" class="btn">
                </form>
            </td>
        </tr>
    </table>
</section>

<?php
    include ("footer.php");
?>