<div class="right_col" role="main">
    <div class="">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Modificar datos de Usuario</h2>
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
                                        foreach($infousuario->result() as $row)
                                        {

                                        
                                        echo form_open_multipart('usuarios/modificarbd');
                                    ?>
                                        <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

                                            <div class="item form-group">
                                                <input type="hidden" class="form-control" name="idusuario" value="<?php echo $row->idUsuario;?>"><!--se recupera los datos para editar NECESARIO--> 
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="first-name" required="required" class="form-control"  name="NAME" placeholder="ingrese categoria" value="<?php echo $row->nombre;?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Primer Apellido: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="last-name"  required="required" class="form-control" name="apellido1" placeholder="ingrese descripción" value="<?php echo $row->primerApellido;?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Segundo Apellido: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="last-name"  required="required" class="form-control" name="apellido2" placeholder="ingrese descripción" value="<?php echo $row->segundoApellido;?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Carnet de Identidad: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="last-name"  required="required" class="form-control" name="CI" placeholder="ingrese descripción" value="<?php echo $row->carnetIdentidad;?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Rol: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <select class="form-control" name="tipo" required>
                                                        <option value="" disabled selected >Seleccionar rol</option>
                                                        <option value="administrador" >administrador</option>
                                                        <option value="empleado">empleado</option>
                                                    </select>
                                                </div>
										    </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Dirección: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="last-name"  required="required" class="form-control" name="mapa" placeholder="ingrese descripción" value="<?php echo $row->direccion;?>">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Teléfono: <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <input type="text" id="last-name"  required="required" class="form-control" name="celular" placeholder="ingrese descripción" value="<?php echo $row->telefono;?>">
                                                </div>
                                            </div>

                                            
                                            <div class="ln_solid"></div>
                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <a href="<?php echo base_url();?>index.php/usuarios/listasUsers">
                                                        <button class="btn btn-outline-primary" type="button"><b>Cancelar</b></button>
                                                    </a>
                                                    <button type="submit" class="btn btn-outline-success"><b>Modificar Usuario</b></button>
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