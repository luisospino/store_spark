<div id="layoutSidenav_content">
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

            <form method = "POST" action="<?= base_url(); ?>/productos/actualizar" autocomplete = "off">
                <input type="hidden" name = "id" value = "<?= $producto['id'] ?>">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Codigo</label>
                            <input type="text" id = "codigo" name = "codigo" class="form-control" value = "<?=  old('codigo') == '' ? $producto['codigo'] : old('codigo') ?>" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>
                            <input type="text" id = "nombre" name = "nombre" class="form-control" value = "<?=  old('nombre') == '' ? $producto['nombre'] : old('nombre') ?>" >
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
                                    <option value="<?= $unidad['id']?>"
                                        <?php
                                            if( $unidad['id'] == old('id_unidad') ){
                                                echo "selected";
                                            }else if( $unidad['id'] == $producto['id_unidad'] && old('id_unidad') == ''){
                                                echo "selected";
                                            }
                                        ?>>
                                        <?= $unidad['nombre'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Categoría</label>
                            <select class = "form-control" id="id_categoria" name = "id_categoria" >
                                <option value="">Seleccionar categoría</option>
                                <?php foreach($categorias as $categoria){?>
                                    <option value="<?= $categoria['id']?>"
                                        <?php
                                        if( $categoria['id'] == old('id_categoria') ){
                                            echo "selected";
                                        }else if( $categoria['id'] == $producto['id_categoria'] && old('id_categoria') == ''){
                                            echo "selected";
                                        }
                                        ?>>
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
                            <input type="text" id = "precio_venta" name = "precio_venta" class="form-control" value = "<?=  old('precio_venta') == '' ? $producto['precio_venta'] : old('precio_venta') ?>" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Precio de compra</label>
                            <input type="text" id = "precio_compra" name = "precio_compra" class="form-control" value = "<?=  old('precio_compra') == '' ? $producto['precio_compra'] : old('precio_compra') ?>" >
                        </div>                        
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Stock mínimo</label>
                            <input type="text" id = "stock_minimo" name = "stock_minimo" class="form-control" value = "<?=  old('stock_minimo') == '' ? $producto['stock_minimo'] : old('stock_minimo') ?>" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Es inventariable</label>
                            <select name="inventariable" id="inventariable" class = "form-control">                            
                                <option value = "1"
                                    <?php
                                    if(old('inventariable') == 1){
                                        echo "selected";
                                    }else if( $producto['inventariable'] == 1 && old('inventariable') == '' ){
                                        echo "selected";
                                    }
                                    ?>>
                                    Si
                                </option>

                                <option value = "0"
                                    <?php
                                    if( strcmp(old('inventariable'), 0) == 0){
                                        echo "selected";
                                    }else if( $producto['inventariable'] == 0 && old('inventariable') == '' ){
                                        echo "selected";
                                    }
                                    ?>>
                                    No
                                </option>
                            </select>
                        </div>                        
                    </div>    
                </div>
                
                <div class="text-center">
                    <a href="<?= base_url();?>/productos" class = "btn btn-sm btn-primary">Regresar</a>   
                    <button type="submit" class = "btn btn-sm btn-success">Guardar</button>                
                </div>
            </form>

        </div>
    </main>