<div class="right_col" role="main">
    <div class="">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2><b>Formulario de registro de Clientes</b></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                                    <?php 
                                        echo form_open_multipart('cliente/agregarbd', array('id'=>'formulario'))
                                    ?>
									<!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">CI Y/O NIT: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" id="nombre" name="nit" placeholder="ingrese CI">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Razón Social: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name"  required="required" class="form-control" name="motivo" placeholder="ingrese Razón social">
											</div>
										</div>

										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-outline-primary" type="button"><b>Cancelar</b></button>
												<button class="btn btn-outline-primary" type="reset"><b>resetear</b></button>
												<button type="submit" class="btn btn-outline-success"><b>agregar cliente</b></button>
											</div>
										</div>

									<!--</form>-->
                                    
                                    <?php
                                        echo form_close();
                                    ?>
								</div>
							</div>
						</div>
        </div>
    </div>
</div>