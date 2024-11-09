<?php
// Datos de los anuncios
$anuncios = [
    1 => [
        "titulo" => "Hermosa casa en Madrid",
        "precio" => "€1,200/mes",
        "ubicacion" => "Madrid",
        "descripcion" => "Este es el texto del anuncio. Aquí se describe la propiedad, las características principales, el estado del inmueble, etc.",
        "publicado" => "20/9/2024",
        "pais" => "España",
        "caracteristicas" => ["3 habitaciones", "2 baños", "120 m²", "Aire acondicionado", "Terraza"],
        "foto_principal" => ["src" => "../img/casa1.jpg", "descripcion" => "Foto principal de la casa en Madrid"],
        "fotos" => [
            ["src" => "../img/cocina1.jpg", "descripcion" => "Foto de la cocina"],
            ["src" => "../img/habitacion1.jpg", "descripcion" => "Foto de la habitación principal"],
            ["src" => "../img/aseo1.jpg", "descripcion" => "Foto del baño"]
        ]
    ],
    2 => [
        "titulo" => "Moderna casa en Alicante",
        "precio" => "€300,000",
        "ubicacion" => "Alicante",
        "descripcion" => "Esta moderna casa está ubicada en Alicante y cuenta con todas las comodidades para una vida confortable.",
        "publicado" => "11/9/2001",
        "pais" => "España",
        "caracteristicas" => ["4 habitaciones", "3 baños", "150 m²", "Piscina", "Garaje"],
        "foto_principal" => ["src" => "../img/casa2.jpg", "descripcion" => "Foto principal de la casa en Alicante"],
        "fotos" => [
            ["src" => "../img/cocina2.png", "descripcion" => "Foto de la cocina moderna"],
            ["src" => "../img/habitacion2.jpg", "descripcion" => "Foto de la habitación amplia"],
            ["src" => "../img/aseo2.jpg", "descripcion" => "Foto del baño principal"]
        ]
    ]
];
?>
