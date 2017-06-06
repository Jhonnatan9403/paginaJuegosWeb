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

        if (isset($_POST['logout'])) {
            $_SESSION['prov_id'] = "";
            $_SESSION['prov_pass'] = "";

            session_destroy();
            header("Location:ingresoProveedores.php");
        }

//if (empty($_SESSION['prov_id'])) {
//    header("Location:ingresoProveedores.php");
//}



        if (isset($_POST['enviarProducto'])) {

            $idProv = $_SESSION['prov_id'];
            $nombreProve = $_POST['nombreProveedor'];
            $nombreProducto = $_POST['nombreProducto'];
            $precioProducto = $_POST['precioProducto'];
            $plataformaP = $_POST['plataformaProducto'];
            $categoriaP = $_POST['categoriaProducto'];
            $sipnosisP = $_POST['sipnosisProducto'];


            $foto = $_FILES["portadaProducto"]["name"];
            $t = explode(".", $foto);
            $exten = $_POST['nombreProducto'] . "." . end($t);
            $ruta = $_FILES["portadaProducto"]["tmp_name"];
            $destino = "portadas/" . $foto;
            $destino2 = "portadas/" . $exten;
            copy($ruta, $destino);
            rename($destino, $destino2);

            $sql = "INSERT INTO producto (idProveedor,nombreProveedor,nombre,precio,plataforma,categoria,portada,sinopsis) "
                    . "VALUES ('$idProv','$nombreProve','$nombreProducto','$precioProducto','$plataformaP','$categoriaP','$destino2','$sipnosisP')";
            mysql_query($sql);
            header("Location:#");
            exit();
        }

        if (isset($_POST['eliminar'])) {

            $sql = "DELETE FROM producto WHERE idProducto=" . $_POST['eliminar'];
            mysql_query($sql);
        }
        ?>
        <div id="header">
            <div class="container">

                <!-- Navbar ================================================== -->
                <div id="logoArea" class="navbar">

                </div>
            </div>
        </div>
        <!-- Header End====================================================================== -->
        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="span12">
                            <ul id="productDetail" class="nav nav-tabs">
                                <li ><a href="#registrarProducto" data-toggle="tab">Registrar producto</a></li>
                                <li class="active"><a href="#productos" data-toggle="tab">Mis productos</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade" id="registrarProducto">
                                    <h3> Registro de productos</h3>	
                                    <div class="well">
                                        <form class="form-horizontal loginFrm" method="post" action="#" enctype="multipart/form-data">


                                            <label class="control-label">Proveedor <sup>*</sup></label>
                                            <div class="controls">
                                                <select class="srchTxt" name="nombreProveedor">
                                                    <?php
                                                    include_once './conexion.php';
                                                    $query = 'SELECT * FROM proveedor WHERE idProveedor=' . $_SESSION['prov_id'];
                                                    $resultado = mysql_query($query);
                                                    if ($resultado) {
                                                        while ($renglon = mysql_fetch_array($resultado)) {
                                                            $valor = $renglon['nombreProveedor'];
                                                            ?>
                                                            <option value="<?php echo $valor ?>"><?php echo $valor ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div><br>

                                            <label class="control-label">Nombre del producto <sup>*</sup></label>
                                            <div class="controls">
                                                <input type="text" name="nombreProducto" placeholder="Nombre Producto" required>
                                            </div><br>

                                            <label class="control-label">Precio <sup>*</sup></label>
                                            <div class="controls">
                                                <input type="number" min="0" name="precioProducto" placeholder="Precio" required>
                                            </div><br>

                                            <label class="control-label">Plataforma <sup>*</sup></label>
                                            <div class="controls">
                                                <select class="srchTxt" name="plataformaProducto">
                                                    <option >Seleccione la plataforma</option>
                                                    <?php
                                                    include_once './conexion.php';
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
                                            </div><br>

                                            <label class="control-label">Categoria <sup>*</sup></label>
                                            <div class="controls">
                                                <select class="srchTxt" name="categoriaProducto">
                                                    <option >Seleccione la categoria</option>
                                                    <?php
                                                    include_once './conexion.php';
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
                                            </div><br>

                                            <label class="control-label">Sinopsis <sup>*</sup></label>
                                            <div class="controls">
                                                <textarea name="sipnosisProducto" placeholder="Sipnosis del juego" maxlength="499"></textarea>
                                            </div><br>

                                            <label class="control-label">Portada <sup>*</sup></label>
                                            <div class="controls">
                                                <input type="file" name="portadaProducto" required>
                                            </div><br>

                                            <div class="control-group">
                                                <input type="submit" name="enviarProducto" class="btn btn-large btn-success" value="Registrar Producto">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade active in" id="productos">
                                    <div id="mainBody">
                                        <div class="container">
                                            <div class="row">
                                                <div class="span12">

                                                    <h4>Productos </h4>

                                                    <ul class="thumbnails">
                                                        <?php
                                                        $query = 'SELECT * FROM producto WHERE idProveedor=' . $_SESSION['prov_id'];
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
                                                                    <a  href="productos.php?idPr=<?php echo $idPr ?>"><img width="160" src="<?php echo $portada ?>" alt=""/></a>
                                                                    <div class="caption">
                                                                        <h5><?php echo $nombrePr; ?></h5>
                                                                        <form method="post" action="">
                                                                            <h4 style="text-align:center">
                                                                                <a class="btn btn-large" href="">
                                                                                    <i class="icon-edit"></i></a>
                                                                                <button class="btn btn-danger btn-large" name="eliminar" value="<?php echo $idPr; ?>">
                                                                                    <i class="icon-trash"></i></button>
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
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <!-- MainBody End ============================= -->
        <!-- Footer ================================================================== -->
        <div id="footerSection">
            <div class="container">
                <form  method="post" action="" >
                    <button name="logout" class="btn btn-medium btn-danger">Desconectarse</button>
                </form>
                <p class="pull-right">&copy; Bootshop</p>
            </div><!-- Container End -->
        </div>
        <!-- Placed at the end of the document so the pages load faster ============================================= -->
        <script src="themes/js/jquery.js" type="text/javascript"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="themes/js/google-code-prettify/prettify.js"></script>

        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>

        <span id="themesBtn"></span>
    </body>
</html>