<?php
    $serveravards = "localhost";
    #$serveravards = "localhost:3307";
    $lietotajsvards = "mndienests";
    $parole = "Parole1";
    $dbvards = "itatbalstadienests";

    $savienojums = mysqli_connect($serveravards, $lietotajsvards, $parole, $dbvards);

    if($savienojums){
        #echo 'Savienojums ar datu bāzi veiksmīgi izveidots!';
    }else{
        #echo 'Kļūda savienojumā!';
    }
?>