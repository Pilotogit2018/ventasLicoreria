<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url()?>gentella/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  
                    <li><a href="<?php echo base_url();?>index.php/inicio/index"><i class="fa fa-home"></i>Inicio</a></li>

                    <li><a><i class="fa fa-edit"></i> Productos <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">   
                            <li><a href="<?php echo base_url()?>index.php/productos/lista">Lista de Productos</a></li>
                            <li><a href="<?php echo base_url()?>index.php/categoria/index">Categorias</a></li>
                            <li><a href="<?php echo base_url()?>index.php/marca/lista">Marcas</a></li>
                        </ul>
                    </li>

                    <li><a href="<?php echo base_url();?>index.php/usuarios/listasUsers"><i class="fa fa-desktop"></i> Usuarios </a></li>

                    <li><a  href="<?php echo base_url();?>index.php/proveedor/lista"><i class="fa fa-table"></i> Proveedores</a></li>

                    <li><a href="<?php echo base_url();?>index.php/cliente/lista"><i class="fa fa-bar-chart-o"></i>Clientes</a></li>

                    <li><a href="<?php echo base_url();?>index.php/venta/lista"><i class="fa fa-clone"></i>ventas</a></li>

                    <li><a href="<?php echo base_url();?>index.php/reportes/lista"><i class="fa fa-clone"></i>Reportes</a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
             
              <a data-toggle="tooltip" data-placement="top" title="Cerrar sesión" href="<?php echo base_url();?>index.php/usuarios/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>