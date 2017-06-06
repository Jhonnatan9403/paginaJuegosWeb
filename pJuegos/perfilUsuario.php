<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Pagina juegos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--Less styles -->
        <!-- Other Less css file //different less files has different color scheam
             <link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
             <link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
             <link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
        -->
        <!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
        <script src="themes/js/less.js" type="text/javascript"></script> -->

        <!-- Bootstrap style --> 
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
            $_SESSION['user_num'] = "";
            $_SESSION['user_id'] = "";
            $_SESSION['user_doc'] = "";
            $_SESSION['user_nom'] = "";
            $_SESSION['user_ape'] = "";
            $_SESSION['user_ema'] = "";
            $_SESSION['user_pass'] = "";
            $_SESSION['user_pic'] = "";
            session_destroy();
            header("Location:index.php");
        }

        if (isset($_POST['borrarItem'])) {

            $sql = "DELETE FROM carrito WHERE idCarrito=" . $_POST['borrarItem'];
            mysql_query($sql);
        }

        if (isset($_POST['comprarItem'])) {
            date_default_timezone_set("America/Mexico_City");

            $query = 'SELECT * FROM carrito WHERE idCarrito=' . $_POST['comprarItem'];
            $resultado = mysql_query($query);
            $row = mysql_fetch_array($resultado);

            $idPrd = $row['idProducto'];
            $idUs = $_SESSION['user_num'];
            $nombrePr = $row['nombreProducto'];
            $cantPro = $row['cantProducto'];
            $precioT = $row['precioTotal'];
            $fecha = date("F j, Y, g:i a");

            $sql = "INSERT INTO factura (idProducto,idUsuario,nombreProducto,cantProducto,precioTotal,fechaCompra) "
                    . "VALUES ('$idPrd','$idUs','$nombrePr','$cantPro','$precioT','$fecha')";
            mysql_query($sql);
            $sql = "DELETE FROM carrito WHERE idCarrito=" . $_POST['comprarItem'];
            mysql_query($sql);
            header("Location:#");
            exit();
        }

        if (isset($_POST['editarInfo'])) {

            if ($_POST['newPassword'] == $_POST['reNewPassword']) {

                $eNick = $_POST['nick'];
                $eDocumento = $_POST['documento'];
                $eNombre = $_POST['nombre'];
                $eApellido = $_POST['apellido'];
                $eCorreo = $_POST['correo'];
                $ePassword = $_POST['oldPassword'];
                $eNewPassword = $_POST['newPassword'];

                $foto = $_FILES["avatar"]["name"];
                $t = explode(".", $foto);
                $exten = $_POST['nick'] . "." . end($t);
                $ruta = $_FILES["avatar"]["tmp_name"];
                $destino = "avatares/" . $foto;
                $destino2 = "avatares/" . $exten;
                copy($ruta, $destino);
                rename($destino, $destino2);


                $sql = "UPDATE usuarios SET nick='$eNick',documento='$eDocumento',nombre='$eNombre',"
                        . "apellido='$eApellido',correo='$eCorreo',password='$eNewPassword',"
                        . "avatar='$destino2' WHERE idUsuario=" . $_SESSION['user_num'];
                mysql_query($sql);


                header("Location:#");
                exit();
            }
        }

        if (isset($_POST['borrarUser'])) {

            $sql = "DELETE FROM usuarios WHERE idUsuario=" . $_POST['borrarUser'];
            mysql_query($sql);
            $_SESSION['user_num'] = "";
            $_SESSION['user_id'] = "";
            $_SESSION['user_doc'] = "";
            $_SESSION['user_nom'] = "";
            $_SESSION['user_ape'] = "";
            $_SESSION['user_ema'] = "";
            $_SESSION['user_pass'] = "";
            $_SESSION['user_pic'] = "";
            session_destroy();
            header("Location:index.php");
        }
        ?>
        <div id="header">
            <div class="container">

                <!-- Navbar ================================================== -->
                <div id="logoArea" class="navbar">
                    <a href="index.php" target="_self">
                        <img src="Banner 15.jpg" alt="Inicio"/></a><br>
                </div>
                <!-- Final Navbar ================================================== -->
            </div>
        </div>
        <!-- Header End====================================================================== -->

        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="row">	  
                            <div  class="span3">
                                <div class="thumbnail">
                                    <a><img  width="180" src="<?php echo $_SESSION['user_pic'] ?>" alt=""/></a>
                                    <div class="caption">
                                        <form method="post" action="#">
                                            <h5><?php echo "Nick: " . $_SESSION['user_id']; ?></h5>
                                            <h5><?php echo "Documento: " . $_SESSION['user_doc']; ?></h5>
                                            <h5><?php echo "Nombre: " . $_SESSION['user_nom']; ?></h5>
                                            <h5><?php echo "Apellido: " . $_SESSION['user_ape']; ?></h5>
                                            <h5><?php echo "Correo: " . $_SESSION['user_ema']; ?></h5>
                                            <h5><button class="btn btn-danger btn-large" name="borrarUser" value="<?php echo $_SESSION['user_num']; ?>">
                                                    <i class="icon-trash"></i></button></h5>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="span9">
                                <ul id="productDetail" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Carrito de compras</a></li>
                                    <li><a href="#comments" data-toggle="tab">Historial de compras</a></li>
                                    <li><a href="#profile" data-toggle="tab">Editar Perfil</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="home">
                                        <h4>CARRITO DE COMPRAS</h4>
                                        <form method="post" action="#">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Compra #</th>
                                                        <th>Nombre Producto</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio a pagar</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = 'SELECT * FROM carrito WHERE idUsuario=' . $_SESSION['user_num'];
                                                    $resultado = mysql_query($query);
                                                    if ($resultado) {
                                                        while ($renglon = mysql_fetch_array($resultado)) {
                                                            $carritoNum = $renglon['idCarrito'];
                                                            $productoNom = $renglon['nombreProducto'];
                                                            $cantiProd = $renglon['cantProducto'];
                                                            $precioTo = $renglon['precioTotal'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $carritoNum ?></td>
                                                                <td><?php echo $productoNom ?></td>
                                                                <td><?php echo $cantiProd ?></td>
                                                                <td><?php echo $precioTo ?></td>
                                                                <td><button class="btn" name="borrarItem" value="<?php echo $carritoNum; ?>">
                                                                        <i class="icon-trash"></i></button> 
                                                                    <button class="btn" name="comprarItem" value="<?php echo $carritoNum; ?>">
                                                                        <i class="icon-shopping-cart"></i></button> </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="comments">
                                        <h4>HISTORIAL DE COMPRA</h4>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Factura</th>
                                                    <th>Nombre Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio total</th>
                                                    <th>Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = 'SELECT * FROM factura WHERE idUsuario=' . $_SESSION['user_num'];
                                                $resultado = mysql_query($query);
                                                if ($resultado) {
                                                    while ($renglon = mysql_fetch_array($resultado)) {
                                                        $facturaNum = $renglon['idFactura'];
                                                        $productoNom = $renglon['nombreProducto'];
                                                        $cantiProd = $renglon['cantProducto'];
                                                        $precioTo = $renglon['precioTotal'];
                                                        $dateBuy = $renglon['fechaCompra'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $facturaNum ?></td>
                                                            <td><?php echo $productoNom ?></td>
                                                            <td><?php echo $cantiProd ?></td>
                                                            <td><?php echo $precioTo ?></td>
                                                            <td><?php echo $dateBuy ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class = "tab-pane fade" id = "profile">
                                        <h4>EDITAR DATOS DEL PERFIL</h4>
                                        <form class="form-inline loginFrm" action="#" method="post" enctype="multipart/form-data">
                                            <div class="control-group">								
                                                <input type="text" name="nick" placeholder="Nick" value="<?php echo $_SESSION['user_id'] ?>" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="number" name="documento" min="0" placeholder="documento"  value="<?php echo $_SESSION['user_doc'] ?>" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $_SESSION['user_nom'] ?>" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="text" name="apellido" placeholder="Apellido" value="<?php echo $_SESSION['user_ape'] ?>" required>
                                            </div>
                                            <div class="control-group">								
                                                <input type="email" name="correo" placeholder="Correo electronico" value="<?php echo $_SESSION['user_ema'] ?>" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="oldPassword" placeholder="Antiguo Password" value="<?php echo $_SESSION['user_pass'] ?>" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="newPassword" placeholder="Nuevo Password" required>
                                            </div>
                                            <div class="control-group">
                                                <input type="password" name="reNewPassword" placeholder="Confirmar password" required>
                                            </div><br/>
                                            <div class="control-group">
                                                Avatar  <input type="file" name="avatar" required value="<?php echo $_SESSION['user_pic'] ?>"><br>
                                            </div>
                                            <div class="control-group">
                                                <label>*Los cambios se veran reflejados luego de iniciar session nuevamente*</label>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit" name="editarInfo" class="btn btn-large btn-warning" value="Editar informacion">
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer ================================================================== -->
        <div id="footerSection">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <form method="post" action="#">
                            <button id="logout" name="logout" class="btn btn-medium btn-danger">Desconectarse</button>
                        </form>
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


        <span id="themesBtn"></span>
    </body>
</html>