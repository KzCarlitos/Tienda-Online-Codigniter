  <body class="letra">
  <div class="brand" id="banner">Mi Tienda Online</div>
    <div class="address-bar" id="banner">
    <?php if(isset($_SESSION['Usuario_Valido']) && $_SESSION['Usuario_Valido']==TRUE)
            { 
                //echo "Bienvenido ".$_SESSION['Datos_Usuario'][0]['Nombre'];
                foreach ($_SESSION['Datos_Usuario'] as  $value) {
                    echo "Bienvenido ". $value->Nombre;
                }
            }
            else
            {
                echo("Bienvenido a mi tienda online");
            }

                                        ?>

    <div align="center">
    <br>
    <?php        
         if(isset($_SESSION['Usuario_Valido']) && $_SESSION['Usuario_Valido']==TRUE)
            { 
                echo anchor("Inicio/Pedidos","Mis Pedidos",array("class"=>"btn btn-danger"));
                echo"   ";
                 echo anchor("Inicio/Modificar","Mis Datos",array("class"=>"btn btn-success"));

            }
    ?>

    </div>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="pull-left">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse" >
                  <ul class="nav navbar-nav">
                    
                     <li>
                       <?=anchor("Inicio","Inicio")?>
                    </li>
                      
                    <li>
                        <?=anchor("Inicio/Destacados","Destacados")?>
                    </li>
                    <li>
                        <?=anchor("Inicio/Categoria","Categoria")?>
                    </li>

                    <li style="position: absolute;right: 10%;">
                        <?php if(isset($_SESSION['Usuario_Valido'])&& $_SESSION['Usuario_Valido']==TRUE){echo anchor("Inicio/Salir","Salir");}else{
                       echo anchor("Inicio/Loguearse","Acceder");}?>
                    </li>

                    <li style="position: absolute;right: 20%;">
                        <?php if(!isset($_SESSION['Usuario_Valido'])  ||$_SESSION['Usuario_Valido']==false)
                            echo anchor('Inicio/Registro','Registrarse');?>
                    </li>
                    <li style="position: absolute;right: 1%;">
                        <?php echo anchor("Inicio/Carrito"," ","class='glyphicon glyphicon-shopping-cart'"); ?>
                    </li>
                   
                </ul>

            </div>
            <!-- /.navbar-collapse -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>