<div class="right_col" role="main">
    <div class="">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de Usuarios</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url();?>index.php/usuarios/agregarUserLte">Agregar Usuarios</a>
                            <a class="dropdown-item" href="<?php echo base_url();?>index.php/usuarios/deshabilitados">deshabilitados</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                            <th>n°</th>
                            <th>Nombre completo</th>
                            <th>carnetIdentidad</th>
                            <th>rol</th>
                            <th>direccion</th>
                            <th>telefono</th>
                            <th>modificar</th>
                            <th>Eliminar</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php
                        $indice=1;
                            foreach($usuario->result() as $row)//la variable categoria tiene que se igual al controlador categoria linea 9
                            {
                        ?>
                        <tr>
                            <td><?php echo $indice ?></td>
                            <td><?php echo $row->nombre." ". $row->primerApellido." ".$row->segundoApellido;;?></td>
                            <td><?php echo $row->carnetIdentidad; ?></td>
                            <td><?php echo $row->rol; ?></td>
                            <td><?php echo $row->direccion; ?></td>
                            <td><?php echo $row->telefono;?></td>
                            
                            <!--COLUMNA MODIFICAR-->
                            <td>
                                    <?php
                                        echo form_open_multipart('usuarios/modificar');//manda al controlador categoria metoodo eliminarbd
                                    ?>
                                        <input type="hidden" name="idusuario" value="<?php echo $row->idUsuario;?>">
                                        <button type="submit" class="btn btn-outline-warning">modificar</button>
                                    <?php
                                        echo form_close();
                                    ?>
                            </td>
                            <!--COLUMNA ELIMINAR SOFTDELETE-->
                            <td>
                                    <?php
                                        echo form_open_multipart('usuarios/deshabilitarbd');//manda al controlador categoria metoodo deshabilitarbd
                                    ?>
                                        <input type="hidden" name="idusuario" value="<?php echo $row->idUsuario;?>">
                                        <button type="submit" class="btn btn-outline-success">ELIMINAR</button>
                                    <?php
                                        echo form_close();
                                    ?>
                            </td>
                        </tr>
                        
                        <?php
                                $indice++;
                            }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
                </div>
              </div>
        </div>
    </div>
</div>