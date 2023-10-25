<div class="right_col" role="main">
    <div class="">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Formulario de modificación de marcas</h2>
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
                                        foreach($infoMarca->result() as $row)
                                        {

                                        
                                        echo form_open_multipart('marca/modificarbd')
                                    ?>
                                        <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

                                            <div class="item form-group">
                                                <input type="hidden" class="form-control" name="idmarca" value="<?php echo $row->idMarca;?>"><!--se recupera los datos para editar NECESARIO--> 
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Marca: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="first-name" required="required" class="form-control"  name="NAME" placeholder="ingrese la marca" value="<?php echo $row->nombre;?>">
                                                </div>
                                            </div>

                                            
                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <button class="btn btn-outline-primary" type="button"><b>Cancelar</b></button>
                                                    <button class="btn btn-outline-primary" type="reset"><b>resetear</b></button>
                                                    <button type="submit" class="btn btn-outline-success"><b>Modificar categoria</b></button>
                                                </div>
                                            </div>

                                        <!--</form>-->
                                    
                                    <?php
                                        echo form_close();
                                        }
                                    ?>
								</div>
							</div>
						</div>
        </div>
    </div>
</div>