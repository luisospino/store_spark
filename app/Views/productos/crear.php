<?= $this->extend('plantillas\base') ?>

<?= $this->section('content') ?>

    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?= $titulo ?> </h2>

            <?php if(count($errors)){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>            
            <?php 
            }
            ?>

            <form method = "POST" action="<?= route_to('productos.insertar') ?>" autocomplete = "off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Codigo</label>
                            <input type="text" id = "codigo" name = "codigo" value="<?= old('codigo') ?>" class="form-control">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>
                            <input type="text" id = "nombre" name = "nombre" value="<?= old('nombre') ?>" class="form-control">
                        </div>                        
                    </div>    
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Unidad</label>
                            <select class = "form-control" id="id_unidad" name = "id_unidad">
                                <option value="">Seleccionar unidad</option>
                                <?php foreach($unidades as $unidad){?>
                                    <option value="<?= $unidad['id']?>" <?= $unidad['id'] == old('id_unidad') ? "selected" : "" ?>>
                                        <?= $unidad['nombre']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Categoría</label>
                            <select class = "form-control" id="id_categoria" name = "id_categoria">
                                <option value="">Seleccionar categoría</option>
                                <?php foreach($categorias as $categoria){?>
                                    <option value="<?= $categoria['id']?>" <?= $categoria['id'] == old('id_categoria') ? "selected" : "" ?>>
                                        <?= $categoria['nombre']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>                        
                    </div>    
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Precio de venta</label>
                            <input type="text" id = "precio_venta" name = "precio_venta" value="<?= old('precio_venta') ?>" class="form-control">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Precio de compra</label>
                            <input type="text" id = "precio_compra" name = "precio_compra" value="<?= old('precio_compra') ?>" class="form-control">
                        </div>                        
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Stock mínimo</label>
                            <input type="text" id = "stock_minimo" name = "stock_minimo" value="<?= old('stock_minimo') ?>" class="form-control">
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Es inventariable</label>
                            <select name="inventariable" id="inventariable" class = "form-control">
                                <option value="1" <?= old('inventariable') == 1 ? "selected" : "" ?> >Si</option>
                                <option value="0" <?= strcmp(old('inventariable'), 0) == 0 ? "selected" : "" ?> >No</option>
                            </select>
                        </div>                        
                    </div>    
                </div>
                
                <div class = "text-center">
                    <a href="<?= route_to('productos.inicio') ?>" class = "btn btn-sm btn-primary">Regresar</a>   
                    <button type="submit" class = "btn btn-sm btn-success">Guardar</button>
                </div>

            </form>

        </div>
    </main>

<?= $this->endSection() ?>