<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><i class="fa fa-file-text"></i> REPORTES</h3>
      </div>
    </div>

    <div class="clearfix"></div>

      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-file-text"></i> Lista de Reportes</h2>
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
                <!-- REPORTES -->  
                <!-- Cantidad Ventas -->
                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="card bg-lcv1 shadow h-100">
                        <div class="card-body bg-png font-weight-bold">    
                            <div class="h2 mb-0 font-weight-bold"><h3 class="fa fa-file-text x2 text-light"> Reporte de venta General</h3></div>
                        </div>
                        <div class="card-footer bg-png font-weight-bold">
                            <?php echo form_open_multipart('reporte/general');?>
                            <button type="submit" class="btn btn-round btn-danger text-white"><i class="glyphicon glyphicon-arrow-right"></i> Ir a Reporte</button>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>

                <!-- Cantidad Productos -->
                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="card border-png shadow h-100">
                        <div class="card-body bg-lcv1 font-weight-bold">    
                            <div class="h2 mb-0 font-weight-bold"><h3 class="fa fa-file-text x2 text-light"> Productos mas vendidos</h3></div>
                        </div>
                        <div class="card-footer bg-lcv1 font-weight-bold">
                            <?php echo form_open_multipart('reporte/producto');?>
                            <button type="submit" class="btn btn-round btn-danger"><i class="glyphicon glyphicon-arrow-right"></i> Ir a Reporte</button>
                            <?php echo form_close();?>
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
<!-- /page content -->
