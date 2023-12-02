<?php
    $lapa = "lietotaji";
    require ("header.php");
    echo "<script>aktivs('lietotaji')</script>";
?>

<section class="saturs">
    <h1>Pārvaldības sistēmas lietotāji</h1><hr>
    <table>
        <tr>
            <th>Nr. p. k.</th>
            <th>Lietotājvārds</th>
            <th>Parole</th>
            <th>E-pasts</th>
            <th>Tips</th>
            <th></th>
        </tr>
        <?php
            $sql = "SELECT * FROM lietotaji";
            $rezultats = mysqli_query($savienojums, $sql);
            $nrpk = mysqli_num_rows($rezultats);

            while($row = mysqli_fetch_assoc($rezultats)){
                echo "
                    <tr>
                        <td>{$nrpk}.</td>
                        <td>{$row['Lietotajvards']}</td>
                        <td>**********</td>
                        <td>{$row['Epasts']}</td>
                        <td>{$row['Tips']}</td>
                        <td>
                            <form action='lietotajs.php' method='POST'>
                                <button type='input' name='apskatit' value='{$row['Lietotajs_id']}' class='btn small'>
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