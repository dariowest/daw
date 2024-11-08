<?php
$tipoAnuncio = !empty($_POST['tipoAnuncio']) ? $_POST['tipoAnuncio'] : 'Anuncio por defecto';
$tipoVivienda = !empty($_POST['tipo-vivienda']) ? $_POST['tipo-vivienda'] : 'Vivienda por defecto';
$ciudad = !empty($_POST['ciudad']) ? $_POST['ciudad'] : 'Ciudad por defecto';
$pais = !empty($_POST['pais']) ? $_POST['pais'] : 'País por defecto';
$precMin = !empty($_POST['precMin']) ? $_POST['precMin'] : '1000';
$precMax = !empty($_POST['precMax']) ? $_POST['precMax'] : '2000';
$fechaInicio = !empty($_POST['fechaInicio']) ? $_POST['fechaInicio'] : '01/01/2000';
$fechaFin = !empty($_POST['fechaFin']) ? $_POST['fechaFin'] : '31/12/2020';
