<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="right_col" role="main">
    <div class="">
        <div class="row">
        <div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Formulario de registro de productos</h2>
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
                                        echo form_open_multipart('productos/incribirInnerbd');
                                    ?>
									<!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">nombre: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" id="nombre" name="NAME" placeholder="nombre de proveedor o empresa" >
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">descripcion: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name"  required="required" class="form-control" name="DESCRIPCION" placeholder="ingrese dirección">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">cantidad: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name"  required="required" class="form-control" name="stock" placeholder="ingrese teléfono">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Precio unitario: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name"  required="required" class="form-control" name="unidadPrecio" placeholder="ingrese teléfono">
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Marca: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="idMarca" class="form-control form-select form-select-lg">
                                                <option value="" disable selected>Seleccionar Marca</option>
                                                <?php
                                                    foreach($info1->result() as $row)
                                                    {
                                                ?>  
                                                <option value="<?php echo $row->idMarca;?>">
                                                    <?php echo $row->nombre;?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>

                                            </select>
											</div>
										</div>

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Proveedor: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="idProveedor" class="form-control form-select form-select-lg">
                                                <option value="" disable selected>Seleccionar Proveedor</option>
                                                <?php
                                                    foreach($info2->result() as $row)
                                                    {
                                                ?>  
                                                <option value="<?php echo $row->idProveedor;?>">
                                                    <?php echo $row->nombre;?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>

                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Categoria: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="idCategoria" class="form-control form-select form-select-lg">
                                                <option value="" disable selected>Seleccionar Categoria</option>
                                                <?php
                                                    foreach($info3->result() as $row)
                                                    {
                                                ?>  
                                                <option value="<?php echo $row->idCategoria;?>">
                                                    <?php echo $row->nombre;?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>

                                            </select>
											</div>
										</div>
                                        

										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-outline-primary" type="button"><b>Cancelar</b></button>
												<button class="btn btn-outline-primary" type="reset"><b>Resetear</b></button>
												<button type="submit" class="btn btn-outline-success"><b>agregar Producto</b></button>
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



