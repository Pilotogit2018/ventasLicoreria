<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
  <!-- loader-->
  <link href="<?php echo base_url();?>gentella/login/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="<?php echo base_url();?>gentella/login/assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url();?>gentella/login/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url();?>gentella/login/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url();?>gentella/login/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url();?>gentella/login/assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="assets/images/logo-icon.png" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Licoreria "El Tabernero"</div>

          <?php
            echo form_open_multipart('usuarios/validarUsuario');
          ?>
		    <!--<form>-->
			  <div class="form-group">
			  <label for="exampleInputUsername" class="sr-only">Usuario:</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputUsername" class="form-control input-shadow" placeholder="ingresar nombre Usuario" name="login" require="ingrese usuario">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="sr-only">Contraseña:</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" class="form-control input-shadow" placeholder="Ingresar contraseña" name="password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			 <button type="submit" class="btn btn-light btn-block">Iniciar Sesión</button>
			  
			 
			<!-- </form>-->
            <?php
                echo form_close();
            ?>
		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">
      <ul class="switcher">
        <li id="theme2"></li>
      </ul>

      
     </div>
   </div>
  <!--end color switcher-->
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>gentella/login/assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>gentella/login/assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>gentella/login/assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="<?php echo base_url();?>gentella/login/assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="<?php echo base_url();?>gentella/login/assets/js/app-script.js"></script>
  
</body>
</html>
