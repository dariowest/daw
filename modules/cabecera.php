<?php
if (isset($_SESSION['usu'])) {
    echo '
    <header>
        <nav>
            <img src="../img/small_logo.png" alt="logo" />
            <ul>
                <li>
                    <a href="../index.php"><i class="fas fa-home"></i> <span>Inicio</span></a>
                </li>
                <li>
                    <a href="form_busqueda.php"><i class="fas fa-search"></i> <span>Buscar</span></a>
                </li>
                <li>
                    <a href="perfil.php"><i class="fas fa-user"></i><span>'.$_SESSION['usu'].'</span></a>
                </li>
                <li>
                    <a href="anuncio_foto.php"><i class="fa-solid fa-image"></i><span>Añadir imagen</span></a>
                </li>
                <li>
                    <!--<a href="../index.php"><i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span></a>-->
                    <a href="../controller/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span></a>
                </li>
            </ul>
        </nav>
    </header>
    ';

} else {
    echo '
    <header>
        <nav>
            <img src="../img/small_logo.png" alt="logo" />
            <ul>
                <li>
                    <a href="../index.php"><i class="fas fa-home"></i> <span>Inicio</span></a>
                </li>
                <li>
                    <a href="form_busqueda.php"><i class="fas fa-search"></i> <span>Buscar</span></a>
                </li>
                <li>
                    <a href="login.php"><i class="fas fa-sign-in-alt"></i> <span>Inicio sesión</span></a>
                </li>
                <li>
                    <a href="registro.php"><i class="fas fa-user-plus"></i> <span>Registro</span></a>
                </li>
            </ul>
        </nav>
    </header>
    ';

}

?>