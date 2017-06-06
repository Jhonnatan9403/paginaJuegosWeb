<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Zona proveedores</title>
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
        <!--Aqui va la imagen para volver al index-->
        <?php
        mysql_connect("localhost", "root", "");
        mysql_select_db("pjuegos");
        session_start();

        if (!empty($_POST['loginProv'])) {



            $sql = "SELECT * FROM proveedor WHERE documentoProveedor='" . $_POST['documentoProv'] . "' AND password='" . $_POST['passwordProv'] . "' ";
            $res = mysql_query($sql);
            $num = mysql_num_rows($res);

            if ($num > 0) {

                $row = mysql_fetch_array($res);
                $_SESSION['prov_id'] = $row['documentoProveedor'];
                header("Location:zonaProveedor.php");
            } else {
                echo 'Usuario incorrecto';
            }
        }
        ?>
        <!-- Header End====================================================================== -->
        <div id="mainBody">
            <div class="container">
                <div class="row">
                    <a href="index.php" target="_self">
                        <img src="Banner 15.jpg" alt="Inicio"/></a><br>
                    <div class="span12">
                        <hr class="soft"/>
                        <h3> ZONA PROVEEDORES</h3>	
                        <hr class="soft"/>
                        <div class="row">
                            <div class="span4">
                                <div class="well">
                                    <h5>INGRESAR</h5>
                                    <hr class="soft"/>
                                    <form  action="ingresoProveedores.php" method="post">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input class="span3" type="number" min="0" style="" name="documentoProv" placeholder="Documento">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <input class="span3" type="password" name="passwordProv" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="loginProv" id="loginProv" value="1" class="btn btn-large btn-success">Ingresar</button>
                                                <!--<input type="submit" name="loginProv" class="btn btn-large btn-success" value="Ingresar">-->
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>                          
                        </div>	
                    </div>
                </div></div>
        </div>
        <!-- MainBody End ============================= -->
        <!-- Footer ================================================================== -->

        <!-- Placed at the end of the document so the pages load faster ============================================= -->
        <script src="themes/js/jquery.js" type="text/javascript"></script>
        <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="themes/js/google-code-prettify/prettify.js"></script>

        <script src="themes/js/bootshop.js"></script>
        <script src="themes/js/jquery.lightbox-0.5.js"></script>

        <span id="themesBtn"></span>
    </body>
</html>