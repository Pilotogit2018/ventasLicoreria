<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      </div>
    </div>

    <div class="clearfix"></div>

      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-file-text"></i>  REPORTE GENERAL POR FECHAS </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
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
                <!-- Inicio Div col-sm-12 2 -->
                <div class="card-box table-responsive">
                    <?php
                        echo form_open_multipart('reporte/index');
                        ?>
                        <button type="submit" class="btn btn-round  btn-success">
                            <i class="glyphicon glyphicon-arrow-left"></i> Regresar Reportes
                        </button>
                        <?php
                        echo form_close();
                        ?>
                        <br><br>
                    <!-- Inicio Div card-box table-responsive -->
                    <?php echo form_open_multipart('reportes/general_filtrar'); ?>
                    <form  method="POST">
                        <div class="item form-group has-feedback">
                            <label class="col-form-label col-md-1 label-align">Fecha Inicio: </label>
                            <div class="col-md-3">
                                <input type="date" value="<?php echo date('Y-m-d'); ?>" name="inicio" id="inicio" class="form-control"></input>
                            </div>
                            <label class="col-form-label col-md-1 label-align">Fecha Final: </label>
                            <div class="col-md-3">
                                <input type="date" value="<?php echo date('Y-m-d'); ?>" name="fin" id="fin" class="form-control"></input>
                            </div>
                            <div class="col-md-4">
                                <label for="">&nbsp;</label>
                                <button type="submit" class="btn btn-info" >
                                    <span class="fa fa-search"></span> Buscar</button>
                            </div>
                        </div><br>
                    </form>
                    <?php echo form_close(); ?>
                    <div class="item form-group has-feedback">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <?php echo form_open_multipart('reportes/listapdf'); ?>
                            <button type="submit" class="btn btn-danger" name="enviar" formtarget="_blank"><i class="fa fa-file-pdf-o"></i>  REPORTE PDF</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <br>
                    <!-- la tabla de abajo tenia un id por defecto que ordenaba los tr el id se llama  datatable-buttons-->
                    <table id="datatable" class="table table-striped table-bordered jambo_table bulk_action" style="width:100%">
                        <thead>
                            <tr class="headings">
                                <th>Cliente</th>
                                <th>Detalle Producto</th>
                                <th>Total (Bs.)</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($fecha->result() as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row->razonSocial; ?></td>
                                    <td><?php echo $row->nombrem.' - '.$row->nombre; ?></td>
                                    <td> <?php echo 'Bs. '.$row->totalVenta  ?></td>                                                
                                    <td><?php echo $row->fechaRegistro; ?></td>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="item form-group has-feedback">

                    </div>
                </div><!-- Inicio Div card-box table-responsive -->
              </div><!-- Fin Div col-sm-12 2 -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- /page content -->
