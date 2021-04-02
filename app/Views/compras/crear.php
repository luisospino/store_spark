<?= $this->extend('plantillas\base') ?>

<?= $this->section('content') ?>

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?= $titulo ?> </h2>

            <div id = "message"></div>

            <form method = "POST" action="<?= route_to('compras.insertar') ?>" autocomplete = "off">
                <div class="form-group">
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <label>Código</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fas fa-fw fa-barcode"></span></div>
                                </div>
                                <input type="text" id = "codigo_compra" name = "codigo_compra" class="form-control" >								
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Nombre del producto</label>

                            <input type="text" id = "nombre" name = "nombre" class="form-control" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Cantidad</label>

                            <input type="text" id = "cantidad" name = "cantidad" class="form-control" >
                        </div>
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label>Precio de compra</label>

                            <input type="text" id = "precio_compra" name = "precio_compra" class="form-control" disabled>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Subtotal</label>

                            <input type="text" id = "subtotal" name = "subtotal" class="form-control" disabled>
                        </div>

                        <div class="col-12 col-sm-4 mt-4">                            
                            <button class = "btn btn-sm btn-primary" type = "button" id = "agregar_producto" name = "agregar_producto">
                                Agregar producto
                            </button>
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

                    <tbody id = "tabla_productos">
                    </tbody>
                </table>

                <div class="row d-flex justify-content-end">
                    <div class="col-12 col-md-1 mt-1">
                        <h1>Total:</h1>
                    </div>
                    <div class="col-12 col-md-3 ml-2">
                        <h1><span id = "total" class="badge badge-dark">$0.00</span></h1>
                        <button id = "boton_comprar" type="submit" class = "btn btn-sm btn-success">Completar compra</button>
                    </div>
                </div>
            </form>

        </div>
    </main>

<?= $this->endSection() ?>

<?= $this->section('aditional-js') ?>

    <script src="<?= base_url();?>/js/compras.js"></script>
    
<?= $this->endSection() ?>