<section>
    <?php if (!empty($anuncios)) : ?>
        <?php foreach ($anuncios as $anuncio) : ?>
            <article>
                <figure>
                    <img src="img/<?php echo htmlspecialchars($anuncio['Foto']); ?>" 
                         alt="Foto del anuncio <?php echo htmlspecialchars($anuncio['Titulo']); ?>" width="200" />
                </figure>
                <aside>
                    <h2><a href="views/anuncio.php?id=<?php echo $anuncio['IdAnuncio']; ?>">
                        <?php echo htmlspecialchars($anuncio['Titulo']); ?>
                    </a></h2>
                    <p><?php echo htmlspecialchars($anuncio['Ciudad']); ?></p>
                    <p>€<?php echo number_format($anuncio['Precio'], 2); ?></p>
                    <p><?php echo htmlspecialchars($anuncio['TipoVivienda']); ?></p>
                    <p><?php echo htmlspecialchars($anuncio['TipoAnuncio']); ?></p>
                    <p><?php echo htmlspecialchars($anuncio['FRegistro']); ?></p>
                </aside>
            </article>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hay anuncios disponibles.</p>
    <?php endif; ?>
</section>
