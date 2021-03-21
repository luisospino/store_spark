<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">

            <div id = "message_venta"></div>

            <form  method = "POST" action="<?= base_url(); ?>/ventas/insertar" autocomplete = "off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="ui-widget">
                                <label>Cliente</label>
                                <input type="text" id = "cliente" name = "cliente" class="form-control" placeholder = "Nombre del cliente">
                                <input type="hidden" id = "id_cliente" name = "id_cliente">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Método de pago</label>
                            <select class = "form-control" id="id_metodo_pago" name = "id_metodo_pago">
                                <?php foreach($metodos_pagos as $metodo){?>
                                    <option value = "<?= $metodo['id']?>">
                                        <?= $metodo['nombre']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-12 col-sm-4">
							<label>Código de barras</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><span class="fas fa-fw fa-barcode"></span></div>
								</div>
                                <input type="text" id = "codigo_barra" name = "codigo_barra" class="form-control" >								
							</div>
						</div>

                        <div class="col-12 col-sm-4">
                            <label>Nombre del producto</label>

                            <input type="text" id = "nombre_venta" name = "nombre_venta" class="form-control" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Cantidad</label>

                            <input type="text" id = "cantidad_venta" name = "cantidad_venta" class="form-control" >
                        </div>
                    </div>   
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label>Precio de venta</label>

                                <input type="text" id = "precio_venta" name = "precio_venta" class="form-control" disabled>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Subtotal</label>

                                <input type="text" id = "subtotal_venta" name = "subtotal_venta" class="form-control" disabled>
                            </div>

                            <div class="col-12 col-sm-4 mt-4">
                                <button class = "btn btn-sm btn-primary" type = "button" id = "agregar_producto_venta" name = "agregar_producto_venta">
                                    Agregar producto
                                </button>
                            </div>
                        </div>    
                    </div> 
                    
                </div>

                <table class="table table-sm table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>

                        <tbody id = "tabla_productos_venta">
                        </tbody>
                    </table>

                    <div class="row d-flex justify-content-end">
                        <div class="col-12 col-md-1 mt-1">
                            <h1>Total:</h1>
                        </div>
                        <div class="col-12 col-md-3 ml-2">
                            <h1><span id = "total_venta" class="badge badge-dark">$0.00</span></h1>
                            <button id = "boton_venta" type="submit" class = "btn btn-sm btn-success">Completar venta</button>
                        </div>
                    </div>
            </form>
        </div>
    </main>