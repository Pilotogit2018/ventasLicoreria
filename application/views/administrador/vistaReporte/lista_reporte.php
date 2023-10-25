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
                    <div class="card border-dark mb-3 " style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte General</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                    
                                </div>
                                <div class="card-footer bg-lcv1 font-weight-bold text-center">
                                    <?php echo form_open_multipart('reportes/reporteGeneral');?>
                                    <button type="submit" class="btn btn-round btn-outline-dark d-grid gap-2"> Ver Reporte  <i class="glyphicon glyphicon-arrow-right"></i></button>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cantidad Productos -->
                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="card border-dark mb-3 " style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte General</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    
                                </div>
                                <div class="card-footer bg-lcv1 font-weight-bold text-center">
                                    <?php echo form_open_multipart('reporte/producto');?>
                                    <button type="submit" class="btn btn-round btn-outline-dark d-grid gap-2"> Ver Reporte  <i class="glyphicon glyphicon-arrow-right"></i></button>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="card border-dark mb-3 " style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Reporte General</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    
                                </div>
                                <div class="card-footer bg-lcv1 font-weight-bold text-center">
                                    <?php echo form_open_multipart('reporte/producto');?>
                                    <button type="submit" class="btn btn-round btn-outline-dark d-grid gap-2"> Ver Reporte  <i class="glyphicon glyphicon-arrow-right"></i></button>
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
  </div>
</div>  
<!-- /page content -->
