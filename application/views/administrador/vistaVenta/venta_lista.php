

<div class="right_col" role="main">
    <div class="">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de las Ventas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><b>OPCIONES</b></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url();?>index.php/venta/agregarFormulario">Agregar Venta</a>
                            <a class="dropdown-item" href="<?php echo base_url();?>index.php/venta/deshabilitados">deshabilitados</a>
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
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                            <th>N°</th>
                            <th>fecha</th>
                            <th>venta total</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
                            $indice=1;
                                foreach($venta->result() as $row)//la variable categoria tiene que se igual al controlador categoria linea 9
                                {
                            ?>
                            <tr>
                                <td><?php echo $indice?></td>
                                <td><?php echo $row->fecha; ?></td>
                                <td><?php echo $row->totalVenta; ?></td>
                                <!--COLUMNA MODIFICAR-->
                                <td class="text-center">
                                        <?php
                                            echo form_open_multipart('venta/modificar');//manda al controlador categoria metoodo eliminarbd
                                        ?>
                                            <input type="hidden" name="idventa" value="<?php echo $row->idVenta;?>">
                                            <button type="submit" class="btn btn-outline-warning">modificar</button>
                                        <?php
                                            echo form_close();
                                        ?>
                                </td>
                                <!--COLUMNA ELIMINAR SOFTDELETE-->
                                <td class="text-center">
                                        <?php
                                            echo form_open_multipart('venta/deshabilitarbd');//manda al controlador categoria metoodo deshabilitarbd
                                        ?>
                                            <input type="hidden" name="idventa" value="<?php echo $row->idVenta;?>">
                                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
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