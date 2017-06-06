<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tienda juegos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
        <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
        <!-- Bootstrap style responsive -->	
        <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/comentarios.css" rel="stylesheet" type="text/css">
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

        if (isset($_POST['enviarComentario'])) {


            $nickU = $_SESSION['user_id'];
            $picU = $_SESSION['user_pic'];
            $idProd = $_GET['idPr'];
            $comentario = $_POST['comentario'];

            $sql = "INSERT INTO comentarios (nick,avatarU,idProducto,comentario) "
                    . "VALUES ('$nickU','$picU','$idProd','$comentario')";
            mysql_query($sql);
            header("Location:#");
            exit();
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

        if (isset($_POST['comprar'])) {
            date_default_timezone_set("America/Mexico_City");

            $idPr = $_GET['idPr'];
            $idUs = $_SESSION['user_num'];

            $query = 'SELECT * FROM producto WHERE idProducto=' . $idPr;
            $resultado = mysql_query($query);
            $row = mysql_fetch_array($resultado);

            $nombrePr = $row['nombre'];
            $precioUni = $_POST['comprar'];
            $cantPro = $_POST['cantidad'];
            $precioT = $cantPro * $precioUni;
            $fecha = date("F j, Y, g:i a");

            $sql = "INSERT INTO factura (idProducto,idUsuario,nombreProducto,cantProducto,precioTotal,fechaCompra) "
                    . "VALUES ('$idPr','$idUs','$nombrePr','$cantPro','$precioT','$fecha')";
            mysql_query($sql);
            echo 'Felicidades por su compra :D';
            header("Location:#");
            exit();
        }
        
        if (isset($_POST['aniadirC'])) {

            $idPr = $_GET['idPr'];
            $idUs = $_SESSION['user_num'];

            $query = 'SELECT * FROM producto WHERE idProducto=' . $idPr;
            $resultado = mysql_query($query);
            $row = mysql_fetch_array($resultado);

            $nombrePr = $row['nombre'];
            $precioUni = $_POST['aniadirC'];
            $cantPro = $_POST['cantidad'];
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
                            <button type="submit" id="submitButton" class="btn btn-success" style="width: 10%" >Buscar</button>
                            <button id="logout" name="logout" class="btn btn-medium btn-danger" style="width: 12%" >Desconectarse</button>
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

                        <?php
                        $idProducto = $_GET['idPr'];
                        $query = 'SELECT * FROM producto WHERE idProducto=' . $idProducto;
                        $resultado = mysql_query($query);
                        $row = mysql_fetch_array($resultado);

                        $idProveP = $row['idProveedor'];
                        $nombreProveP = $row['nombreProveedor'];
                        $nombreP = $row['nombre'];
                        $precioP = $row['precio'];
                        $plataP = $row['plataforma'];
                        $cateP = $row['categoria'];
                        $portadaP = $row['portada'];
                        $sipnosisP = $row['sinopsis'];
                        ?>
                        <div class="row">	  
                            <div id="gallery" class="span3">

                                <div id="differentview" class="moreOptopm carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">

                                            <a href="<?php echo $portadaP ?>" title="<?php echo $nombreP ?>">
                                                <img src="<?php echo $portadaP ?>" style="width:100%" alt="<?php echo $nombreP ?>"/>
                                            </a>
                                        </div>
                                        <div class="item">
                                            <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                                            <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                                            <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span9">
                                <?php $mensaje = "<xml><cc>" . $_SESSION['user_doc'] . "</cc><nombre>" . $_SESSION['user_nom'] . "</nombre></xml>" ?>

                                <h3><?php echo $nombreP ?></h3>
                                <hr class="soft"/>
                                <form class="form-horizontal qtyFrm" method="post" action="#">
                                    <label class="control-label" ><span><?php echo 'Precio $ ' . $precioP; ?></span></label>
                                    <div class="control-group">
                                        <div class="controls">
                                            <label>Cantidad</label>
                                            <input name="cantidad" type="number" class="span2" placeholder="Cantidad" value="1"/>
                                            <button name="comprar" type="submit" class="btn btn-large btn-warning pull-right span3" value="<?php echo $precioP ?>">Comprar <i class=" icon-shopping-cart"></i></button><br/><br/>
                                            <button name="aniadirC" type="submit" class="btn btn-large btn-success pull-right span3" value="<?php echo $precioP ?>">Añadir el carrito <i class=" icon-shopping-cart"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <hr class="soft clr"/>
                                <h2>Sinopsis</h2>
                                <p>
                                    <?php echo $sipnosisP ?>
                                </p>
                                <a class="btn btn-medium btn-info pull-right" href="#detail">Caracteristicas</a><br/><br/>
                                <br class="clr"/>
                                <a href="#" name="detail"></a>
                            </div>

                            <div class="span12">
                                <ul id="productDetail" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Producto</a></li>
                                    <li><a href="#comments" data-toggle="tab">Comentarios</a></li>
                                    <li><a href="#profile" data-toggle="tab">Productos relacionados</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="home">
                                        <h4>Informacion del producto</h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr class="techSpecRow"><td class="techSpecTD1">Marca: </td><td class="techSpecTD2"><?php echo $nombreProveP ?></td></tr>
                                                <tr class="techSpecRow"><td class="techSpecTD1">Plataforma:</td><td class="techSpecTD2"><?php echo $plataP ?></td></tr>
                                                <tr class="techSpecRow"><td class="techSpecTD1">Genero:</td><td class="techSpecTD2"><?php echo $cateP ?></td></tr>
                                                <tr class="techSpecRow"><td class="techSpecTD1">Precio:</td><td class="techSpecTD2"><?php echo '$ ' . $precioP ?></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="comments">
                                        <div class="span10">
                                            <div class="" id="comments-logout">                
                                                <ul class="media-list">
                                                    <?php
                                                    $query = 'SELECT * FROM comentarios WHERE idProducto =' . $_GET['idPr'];
                                                    $resultado = mysql_query($query);

                                                    while ($renglon = mysql_fetch_array($resultado)) {
                                                        $coment = $renglon['comentario'];
                                                        $idPersona = $renglon['nick'];
                                                        $idProdu = $renglon['idProducto'];
                                                        $avtU = $renglon['avatarU'];
                                                        ?>

                                                        <li class = "media">

                                                            <div class = "media-body">
                                                                <div class = "well well-lg">

                                                                    <a class = "pull-left">
                                                                        <img class = "media-object img-circle" src = "<?php echo $avtU ?>" alt="fotoU"/></a><br>
                                                                    <br><br>
                                                                    <h4 class = "media-heading text-uppercase reviews"><?php echo $idPersona ?></h4>
                                                                    <p class = "media-comment">
                                                                        <?php echo $coment ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class = "" id = "add-comment">
                                                <form action = "#" method = "post" class = "form-horizontal">
                                                    <div class = "control-group">
                                                        <textarea class = "form-control span10" name = "comentario" id = "addComment" rows = "4" maxlength = "499"></textarea>
                                                    </div>
                                                    <div class = "control-group">
                                                        <button class = "btn btn-success text-uppercase" name = "enviarComentario" value = "<?php echo $idProducto ?>"><span class = "glyphicon glyphicon-send"></span> Enviar comentario</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "tab-pane fade" id = "profile">
                                        <div class = "span11">

                                            <ul class = "thumbnails">
                                                <?php
                                                $query = 'SELECT * FROM producto WHERE idProveedor =' . $idProveP . ' AND idProducto !=' . $_GET['idPr'];
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
                                                            <a  href="productos.php?idPr=<?php echo $idPr ?>"><img  width="180" src="<?php echo $portada ?>" alt=""/></a>
                                                            <div class="caption">
                                                                <h5><?php echo $nombrePr; ?></h5>
                                                                <h4 style="text-align:center">
                                                                    <a class="btn" href="productos.php?idPr=<?php echo $idPr ?>">
                                                                        <i class="icon-zoom-in"></i></a> 
                                                                    <a class="btn btn-success"><?php echo '$ ' . $precioPr ?></a>
                                                                    <a class="btn" href="#">
                                                                        A&ntildeadir al <i class="icon-shopping-cart"></i></a></h4>
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
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- MainBody End ============================= -->
        <!-- Footer ================================================================== -->
        <div  id="footerSection">
            <div class="container">
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

        <!-- Themes switcher section ============================================================================================= -->
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