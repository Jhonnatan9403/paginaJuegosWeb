<!DOCTYPE html>

<html lang="es">
    <head>

        <meta charset="utf-8">
        <title>Pagina juegos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
        <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
        <!-- Bootstrap style responsive -->	
        <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
        <!-- Google-code-prettify -->	
        <link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
        <!-- fav and touch icons -->
        <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
        <style type="text/css" id="enject"></style>
    </head>
    <body>

        <?php
        mysql_connect("localhost", "root", "");
        mysql_select_db("pjuegos");
        session_start();

        if (isset($_POST['enviar'])) {

            $duplicidad = 0;
            $query = 'SELECT * FROM usuarios';
            $resultado = mysql_query($query);
            if ($resultado) {
                while ($rows = mysql_fetch_array($resultado)) {
                    $cNick = $rows['nick'];
                    $cDocumento = $rows['documento'];
                    $cEmail = $rows['correo'];

                    if ($cNick == $_POST['nick'] || $cDocumento == $_POST['documento'] || $cEmail == $_POST['correo']) {
                        $duplicidad = 1;
                    } else {
                        $duplicidad = 0;
                    }
                }

                if ($duplicidad == 0) {
                    if ($_POST['password'] == $_POST['repassword']) {


                        $nick = $_POST['nick'];
                        $documento = $_POST['documento'];
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $correo = $_POST['correo'];
                        $password = $_POST['password'];


                        $foto = $_FILES["avatar"]["name"];
                        $t = explode(".", $foto);
                        $exten = $_POST['nick'] . "." . end($t);
                        $ruta = $_FILES["avatar"]["tmp_name"];
                        $destino = "avatares/" . $foto;
                        $destino2 = "avatares/" . $exten;
                        copy($ruta, $destino);
                        rename($destino, $destino2);



                        $sql = "INSERT INTO `usuarios`(`nick`, `documento`, `nombre`, `apellido`, `correo`, `password`, `avatar`) "
                                . "VALUES ('$nick','$documento','$nombre','$apellido','$correo','$password','$destino2')";
                        mysql_query($sql);
                        header("Location:index.php");
                        exit();
                    } else {
                        echo 'Las contraseñas no coinciden';
                    }
                } else {
                    echo 'Algunos de los campos ya han sido registrados anteriormente intente nuevamente';
                }
            }
        }


        if (!empty($_POST['login'])) {



            $sql = "SELECT * FROM usuarios WHERE nick='" . $_POST['nick'] . "' AND password='" . $_POST['password'] . "' ";
            $res = mysql_query($sql);
            $num = mysql_num_rows($res);

            if ($num > 0) {

                $row = mysql_fetch_array($res);
                $_SESSION['session'] = true;
                $_SESSION['user_num'] = $row['idUsuario'];
                $_SESSION['user_id'] = $row['nick'];
                $_SESSION['user_doc'] = $row['documento'];
                $_SESSION['user_nom'] = $row['nombre'];
                $_SESSION['user_ape'] = $row['apellido'];
                $_SESSION['user_ema'] = $row['correo'];
                $_SESSION['user_pass'] = $row['password'];
                $_SESSION['user_pic'] = $row['avatar'];

                header("Location:#");
                exit();
            } else {
                echo 'Usuario incorrecto';
            }
        }



        if (isset($_POST['logout'])) {
            $_SESSION['user_num'] = "";
            $_SESSION['user_id'] = "";
            $_SESSION['user_doc'] = "";
            $_SESSION['user_nom'] = "";
            $_SESSION['user_ape'] = "";
            $_SESSION['user_ema'] = "";
            $_SESSION['user_pass'] = "";
            $_SESSION['user_pic'] = "";
            ?>

            <?php
            session_destroy();
            header("Location:#");
        }

        if (isset($_POST['aniadirC'])) {

            $idPr = $_POST['aniadirC'];
            $idUs = $_SESSION['user_num'];

            $query = 'SELECT * FROM producto WHERE idProducto=' . $idPr;
            $resultado = mysql_query($query);
            $row = mysql_fetch_array($resultado);

            $nombrePr = $row['nombre'];
            $precioUni = $row['precio'];
            $cantPro = 1;
            $precioT = $cantPro * $precioUni;

            $sql = "INSERT INTO carrito (idProducto,idUsuario,nombreProducto,cantProducto,precioTotal) "
                    . "VALUES ('$idPr','$idUs','$nombrePr','$cantPro','$precioT')";
            mysql_query($sql);
            header("Location:#");
            exit();
        }
        ?>
        <div id="header">
            <div class="container">

                <!-- Navbar ================================================== -->
                <div id="logoArea" class="navbar">
                    <a href="index.php" target="_self">
                        <img src="Banner 15.jpg" alt="Inicio"/></a><br>
                    <div id="prueba" class="navbar-inner">

                        <form class="form-inline navbar-search" method="post" action="" >
                            <input id="srchFld" class="srchTxt span5" type="text"/>
                            <select class="srchTxt span2">
                                <option>All</option>
                                <?php
                                $query = 'SELECT * FROM categoria';
                                $resultado = mysql_query($query);
                                if ($resultado) {
                                    while ($renglon = mysql_fetch_array($resultado)) {
                                        $valor = $renglon['nombreCategoria'];
                                        ?>
                                        <option value="<?php echo $valor ?>"><?php echo $valor ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <select class="srchTxt span2" >
                                <option>All</option>
                                <?php
                                $query = 'SELECT * FROM plataforma';
                                $resultado = mysql_query($query);
                                if ($resultado) {
                                    while ($renglon = mysql_fetch_array($resultado)) {
                                        $valor = $renglon['nombrePlataforma'];
                                        ?>
                                        <option value="<?php echo $valor ?>"><?php echo $valor ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" id="submitButton" class="btn btn-success">Buscar</button>
                            <a href="#login2" id="registro" role="button" data-toggle="modal"><span class="btn btn-medium btn-success ">Registrate</span></a>
                            <a href="#login" id="ingreso" role="button" data-toggle="modal"><span class="btn btn-medium btn-success">Ingresar</span></a>
                        </form>
                        <ul id="topMenu" class="thumbnails">
                            <li class="">
                                <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3>Ingreso</h3>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal loginFrm" action="#" method="post">
                                            <div class="control-group">								
                                                <input type="text" name="nick" placeholder="Nick">
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="control-group">
                                                <div class="g-recaptcha" data-sitekey="6LfnYx8UAAAAAA8F15jyTICHwoEePAe4Dpn3Gb4C"></div>
                                            </div>
                                            <div class="control-group">
                                                <button name="login" id="loginProv" value="1" class="btn btn-large btn-success">Ingresar</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <div id="login2" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3>Registro</h3>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal loginFrm" action="#" method="post" enctype="multipart/form-data">
                                            <div class="control-group">								
                                                <input type="text" name="nick" placeholder="Nick" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="number" name="documento" min="0" placeholder="documento" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="text" name="nombre" placeholder="Nombre" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="text" name="apellido" placeholder="Apellido" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="email" name="correo" placeholder="Correo electronico" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="repassword" placeholder="Confirmar password" required>
                                            </div>
                                            <div class="control-group">
                                                Avatar  <input type="file" name="avatar" required><br>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit" name="enviar" class="btn btn-large btn-success" value="Registrarse">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="logoArea2" class="navbar">
                    <a href="index.php" target="_self">
                        <img src="Banner 15.jpg" alt="Inicio"/></a><br>
                    <div id="prueba" class="navbar-inner">

                        <form class="form-inline navbar-search" method="post" action="" >
                            <input id="srchFld" class="srchTxt span5" type="text"/>
                            <select class="srchTxt span2">
                                <option>All</option>
                                <?php
                                $query = 'SELECT * FROM categoria';
                                $resultado = mysql_query($query);
                                if ($resultado) {
                                    while ($renglon = mysql_fetch_array($resultado)) {
                                        $valor = $renglon['nombreCategoria'];
                                        ?>
                                        <option value="<?php echo $valor ?>"><?php echo $valor ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <select class="srchTxt span2" >
                                <option>All</option>
                                <?php
                                $query = 'SELECT * FROM plataforma';
                                $resultado = mysql_query($query);
                                if ($resultado) {
                                    while ($renglon = mysql_fetch_array($resultado)) {
                                        $valor = $renglon['nombrePlataforma'];
                                        ?>
                                        <option value="<?php echo $valor ?>"><?php echo $valor ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" id="submitButton" class="btn btn-success" >Buscar</button>
                            <button id="logout" name="logout" class="btn btn-medium btn-danger" >Desconectarse</button>
                            <a id="perfil" href="perfilUsuario.php?idUser=<?php echo $_SESSION['user_id'] ?>">
                                <img class = "img-circle" style="width: 4%" src = "<?php echo $_SESSION['user_pic'] ?>" alt=""/></a>
                        </form>
                        <ul id="topMenu" class="thumbnails">
                            <li class="">
                                <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3>Ingreso</h3>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal loginFrm" action="#" method="post">
                                            <div class="control-group">								
                                                <input type="text" name="nick" placeholder="Nick">
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="control-group">
                                                <div class="g-recaptcha" data-sitekey="6LfnYx8UAAAAAA8F15jyTICHwoEePAe4Dpn3Gb4C"></div>
                                            </div>
                                            <div class="control-group">
                                                <button name="login" id="loginProv" value="1" class="btn btn-large btn-success">Ingresar</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <div id="login2" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3>Registro</h3>
                                    </div>
                                    <div class="modal-body">


                                        <form class="form-horizontal loginFrm" action="#" method="post" enctype="multipart/form-data">
                                            <div class="control-group">								
                                                <input type="text" name="nick" placeholder="Nick" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="number" name="documento" min="0" placeholder="documento" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="text" name="nombre" placeholder="Nombre" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="text" name="apellido" placeholder="Apellido" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="email" name="correo" placeholder="Correo electronico" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="repassword" placeholder="Confirmar password" required>
                                            </div>
                                            <div class="control-group">
                                                Avatar  <input type="file" name="avatar" required><br>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit" name="enviar" class="btn btn-large btn-success" value="Registrarse">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Final Navbar ================================================== -->
            </div>
        </div>
        <!-- Header End====================================================================== -->

        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <ul class="thumbnails">
                            <?php
                            $query = 'SELECT * FROM producto';
                            $resultado = mysql_query($query);

                            while ($renglon = mysql_fetch_array($resultado)) {
                                $idPr = $renglon['idProducto'];
                                $nombrePr = $renglon['nombre'];
                                $precioPr = $renglon['precio'];
                                $plataformaPr = $renglon['plataforma'];
                                $categoriaPr = $renglon['categoria'];
                                $portada = $renglon['portada'];
                                ?>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a  href="productos.php?idPr=<?php echo $idPr ?>"><img  width="180" src="<?php echo $portada ?>"/></a>
                                        <div class="caption">
                                            <h5><?php echo $nombrePr; ?></h5>
                                            <form method="post" action="#">
                                                <h4 style="text-align:center">
                                                    <a class="btn" href="productos.php?idPr=<?php echo $idPr ?>">
                                                        <i class="icon-zoom-in"></i></a> 
                                                    <button name="precioProd" class="btn btn-success"><?php echo '$ ' . $precioPr ?></button>
                                                    <button name="aniadirC" type="submit" class="btn" value="<?php echo $idPr ?>">Add to<i class=" icon-shopping-cart"></i></button>
                                                </h4>
                                            </form>

                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer ================================================================== -->
        <div id="footerSection">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <h5>PROVEEDORES</h5>
                        <a href="ingresoProveedores.php" target="_self">INGRESO</a>
                    </div>

                </div>
                <p class="pull-right">&copy; Bootshop</p>
            </div><!-- Container End -->
        </div>
        <!-- Placed at the end of the document so the pages load faster ============================================= -->
        <script src="themes/js/jquery.js" type="text/javascript"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="themes/js/google-code-prettify/prettify.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="efecto.js"></script>
        <span id="themesBtn"></span>


        <?php
        if (isset($_SESSION['session'])) {
            ?> 
            <script type="text/javascript" src="bootstrap/js/ocultar.js">ocultar();</script>
            <?php
        } elseif (!isset($_SESSION['session'])) {
            ?> 
            <script type="text/javascript" src="bootstrap/js/mostrar.js">mostrar();</script>
            <?php
        }
        ?>
    </body>
</html>