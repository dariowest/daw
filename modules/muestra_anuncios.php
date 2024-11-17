<section>
<?php
// Si `$ciudad` no está definida, la establecemos como vacía para evitar errores.
if (!isset($ciudad)) {
    $ciudad = ''; // Valor por defecto si se usa en otro contexto
}

// Definición de anuncios (puedes reemplazar esto por una consulta a la base de datos)
$anuncios = [
    [
        "id" => 1,
        "titulo" => "Hermosa casa en Madrid",
        "ciudad" => "Madrid",
        "pais" => "España",
        "precio" => "€1,200/mes",
        "tipoVivienda" => "Piso",
        "tipoAnuncio" => "Alquiler",
        "fecha" => "20/9/2024",
        "imagen" => "../img/casa1.jpg"
    ],
    [
        "id" => 2,
        "titulo" => "Moderna casa en Alicante",
        "ciudad" => "Alicante",
        "pais" => "España",
        "precio" => "€300,000",
        "tipoVivienda" => "Casa",
        "tipoAnuncio" => "Venta",
        "fecha" => "11/9/2001",
        "imagen" => "../img/casa2.jpg"
    ],
    // Agrega más anuncios aquí
];


// Mostrar anuncios con filtrado por ciudad
foreach ($anuncios as $anuncio) {
    // Condición para mostrar el anuncio: si `$ciudad` está vacía o coincide con el anuncio
    if ($ciudad === '' || strcasecmp($anuncio['ciudad'], $ciudad) == 0) {
        ?>
        <article id="anuncio<?= $anuncio['id'] ?>">
            <figure>
                <img src="<?= $anuncio['imagen'] ?>" alt="Foto del anuncio <?= $anuncio['id'] ?>" width="200" />
            </figure>
            <aside>
                <h2><a href="anuncio.php?id=<?= $anuncio['id'] ?>"><?= $anuncio['titulo'] ?></a></h2>
                <p><?= $anuncio['pais'] ?></p>
                <p><?= $anuncio['ciudad'] ?></p>
                <p><?= $anuncio['precio'] ?></p>
                <p><?= $anuncio['tipoVivienda'] ?></p>
                <p><?= $anuncio['tipoAnuncio'] ?></p>
                <p><?= $anuncio['fecha'] ?></p>
            </aside>
        </article>
        <?php
    }
}
?>
</section>
