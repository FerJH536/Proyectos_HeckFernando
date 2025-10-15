<?php
extract($_REQUEST);

function nacimiento($year){
    
    $ano_actual=(new datetime ()) -> format ("Y");
    $edad=$ano_actual-$year;

    return $edad;
}

function edad($year){

    $color="white";

    if (nacimiento($year) >= 1 && nacimiento($year) < 20){
        $color="lightgreen";
    }
    elseif (nacimiento($year) >= 20 && nacimiento($year) < 40){
        $color="yellow";
    }
    elseif (nacimiento($year) >= 40 && nacimiento($year) < 60){
        $color="red";
    }
    return $color;
}

function descuento($year){
    
    $off=0;
    $precio=200;
    
    if (nacimiento($year) < 20){
        $off=$precio*(20/100);
        $precio=$precio-$off;
    }   
    elseif(nacimiento($year) > 50){
        $off=$precio*(5/100);
        $precio=$precio-$off;
    }
    return $precio;
}

$preciodes=descuento($year);
$anios=nacimiento($year);

?>

<html>
    <head>
    <link rel="stylesheet" href="estilos.css">
        <title>
            Edad
        </title>
    </head>
        <body bgcolor=<?=edad($year)?>>
            <?php
            echo ("Tu Nombre es $nombre");
            ?>
            <br></br>
            <?php
            echo ("Tu Edad es de $anios");
            ?>
            <br></br>
            <?php
            echo ("El Precio de tu entrada por tu edad de $anios es $preciodes");
            ?>
        </body>
</html>