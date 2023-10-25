<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="right_col" role="main">
    <div class="">
        <div class="row">
        	<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
								<div class="x_title">
									<h2><b>Formulario de Registro De Ventas</b></h2>
								
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                                    <?php 
                                        echo form_open_multipart('venta/realizarTransaccionVenta')
                                    ?>
									<!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->

										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align" for="nombre">Cliente: <span class="required">*</span>
											</label>
											<div class="col-md-3 col-sm-3 ">
												<select class="form-control" name="cliente" id="cliente" required="required">
													<option value="" disabled selected>Listado de clientes</option>
													<?php
													foreach ($clientes->result() as $row) {
													?>

														<option value="<?php echo $row->idCliente; ?>">
															<?php echo $row->razonSocial; ?>
														</option>   

													<?php
													}
													?>
												</select>
											</div>

											<label class="col-form-label col-md-2 col-sm-2 label-align" for="nombre">Producto: <span class="required">*</span>
											</label>
											<div class="col-md-3 col-sm-3 ">
											<input type="hidden" name="detalle_data" id="detalle_data" value="">

												<select class="form-control" name="producto" id="producto" required="required">
													<option value="" disabled selected>Listado de productos</option>
													<?php
													foreach ($productos->result() as $row) {
													?>

														<option value="<?php echo $row->idProducto; ?>">
															<?php echo $row->nombre; ?>
														</option>

													<?php
													}
													?>
												</select>
											</div>
										</div>
										<!--<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">total venta: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name"  required="required" class="form-control" name="motivo">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Producto: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name"  required="required" class="form-control" name="motivo">
											</div>
										</div>
												-->
										
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-outline-primary" type="button"><b>Cancelar</b></button>
												<button class="btn btn-outline-primary" type="reset"><b>Resetear</b></button>
												<button type="button" id="btn-agregar" class="btn btn-success btn-agregar"><b>Agregar Venta</b></button>
											</div>
										</div>

									<!--</form>-->
                                    
                                    
									
								</div>
								<div class="x_panel">
                                    <div class="x_title">
                                        <h2>Tabla de ventas <small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div id="tabla-ventas">
                                            <table class="table table-striped" id="tabla-ventas">
                                                <thead>
                                                    <tr>
														<th>N°</th>
														<th></th><!--captura de idProducto-->
														<th>Producto</th>
														<th>Stock</th>
														<th>Precio unitario</th>
														<th>Cantidad</th>
														<th>Total</th>
														<th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list-product">
													<tr id="fila-ejemplo" style="display: none;">
														<td></td><!--indice-->
														<td><input type="hidden" class="producto-id" name="producto_id[]"></td>
														<td></td><!--producto-->
														<td></td><!--stock-->
														<td></td><!--precioUnitario-->
														<td><input style="width: 100px;" type="number" required="required" value="0" class="form-control cantidad" name="cantidad[]" id="cantidad" required></td><!--cantidad-->
														<td></td><!--total-->
														<td><button class="btn btn-danger btn-remove"><span class="glyphicon glyphicon-trash"></span></button></td>
													</tr>

                                                </tbody>
                                            </table>
                                        </div>
										<div class="row">
											<div class="col-md-2" style="text-align: center;">
												<input type="text" name="total" id="total" class="form-control" style="text-align: center;" readonly><strong><samp>TOTAL(Bs.)</samp></strong>
											</div>
											<div class="col-md-8"></div>
											<div class="col-md-2">
											</div>
										</div>
										<div class="row">
											<div class="col-md-2" style="text-align: center;">
											</div>
											<div class="col-md-8"></div>
											<div class="col-md-2">
												<button type="submit" class="btn btn-info btn-block" id="btn-guardar"><strong>Guardar</strong></button>
											</div>
										</div>
                                    <?php echo form_close(); ?>
                                
                                </div>
                            </div>
					</div>			
												
				</div>
			</div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

        var contadorFilas = 1;

        function calcularImporte(fila) {
            var cantidad = parseInt(fila.find("td:eq(5) input").val());
            var precioUnitario = parseFloat(fila.find("td:eq(4)").text());
            var importe = cantidad * precioUnitario;
            fila.find("td:eq(6)").text(importe);
            return importe;
        }

        function calcularTotal() {
            var total = 0;
            $(".added-row").each(function() {
                total += calcularImporte($(this));
            });
            $("#total").val(total);
        }

        $(document).on("input", ".cantidad", function() {
            var fila = $(this).closest("tr");
            calcularImporte(fila);

            calcularTotal();
        });

        $("#btn-agregar").on("click", function() {
            var producto_id = $("#producto").val();
            var cliente_id =  $("#cliente").val();

            if (producto_id && cliente_id) {

                var fila = $("#fila-ejemplo").clone().removeAttr("idProducto");

                $.getJSON('<?php echo base_url() ?>index.php/ajax/obtenerProductoPorId/' + producto_id, function(data) {
                    if (data) {

                        fila.find("td:eq(0)").text(contadorFilas);
                        fila.find("td:eq(1) input").val(producto_id);
                        fila.find("td:eq(2)").text(data[0].nombre);
                        fila.find("td:eq(3)").text(data[0].cantidad);
                        fila.find("td:eq(4)").text(data[0].precioUnitario);
                        fila.find("td:eq(5) input").val(1);
                        fila.find("td:eq(6)").text(data[0].precioUnitario);
                        

                        contadorFilas++;

                        fila.addClass("added-row");

                        fila.show();
                        $(".list-product").append(fila);

                        calcularImporte(fila);
                        calcularTotal();
                    } else {
                        alert("No se encontraron detalles del producto.");
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("Error en la solicitud AJAX: " + errorThrown);
                });
            } else {
                alert("Seleccione un Producto o un Cliente.");
            }
        });

        $(document).on("click", ".btn-remove", function() {
            var fila = $(this).closest("tr");
            fila.remove();

            calcularTotal();
        });

        calcularTotal();
    });


    $("#btn-guardar").on("click", function() {
        var datos = []; // Array para almacenar los datos de todas las filas

        // Recorre cada fila con la clase "added-row"
        $(".list-product .added-row").each(function() {
            var fila = $(this);
            var cantidad = parseInt(fila.find("td:eq(5) input").val());
            var precioUnitario = parseFloat(fila.find("td:eq(4)").text());
			var importe = parseFloat(fila.find("td:eq(6)").text());
           // var importe = cantidad * precioUnitario; // Calcula el importe

            var filaData = {
                idProducto: fila.find("td:eq(1) input").val(),
                precioUnitario: precioUnitario,
                cantidad: cantidad,
                importe: importe
            };
            datos.push(filaData);
        });

        // Muestra el contenido del array en un alert
        //alert(JSON.stringify(datos, null, 2));

        // Convierte el array a una cadena JSON
        var datosJSON = JSON.stringify(datos);

        // Asigna la cadena JSON al campo de entrada
        $("#detalle_data").val(datosJSON);
    });
</script>