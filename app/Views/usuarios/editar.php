<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h2 class="mt-4"> <?php echo $titulo ?> </h2>

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

            <form method = "POST" action="<?php echo base_url(); ?>/usuarios/actualizar" autocomplete = "off">

                <input type="hidden" name = "id" value = "<?php echo $usuario['id'] ?>">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" value = "<?=  old('nombre') == '' ? $usuario['nombre'] : old('nombre') ?>" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre de usuario</label>

                            <input type="text" id = "usuario" name = "usuario" value = "<?=  old('usuario') == '' ? $usuario['usuario'] : old('usuario') ?>" class="form-control" >
                        </div>
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Rol</label>
                            <select class = "form-control" id="id_rol" name = "id_rol">
                                <option value="">Seleccionar rol</option>
                                
                                <?php foreach($roles as $rol){?>     
                                    <option value="<?= $rol['id']?>"
                                        <?php
                                            if( $rol['id'] == old('id_rol') ){
                                                echo "selected";
                                            }else if( $rol['id'] == $usuario['id_rol'] && old('id_rol') == ''){
                                                echo "selected";
                                            }
                                        ?>>
                                        <?= $rol['nombre'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Caja</label>
                            <select class = "form-control" id="id_caja" name = "id_caja">
                                <option value="">Seleccionar caja</option>
                                
                                <?php foreach($cajas as $caja){?>     
                                    <option value="<?= $caja['id']?>"
                                        <?php
                                            if( $caja['id'] == old('id_caja') ){
                                                echo "selected";
                                            }else if( $caja['id'] == $usuario['id_caja'] && old('id_caja') == ''){
                                                echo "selected";
                                            }
                                        ?>>
                                        <?= $caja['nombre'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>                        
                    </div>    
                </div>

                <input type="hidden" id = "clave" name = "clave" value="<?= $usuario['clave'] ?>" class="form-control" >
                <input type="hidden" id = "clave_confirmacion" name = "clave_confirmacion" value="<?= $usuario['clave'] ?>" class="form-control" >

                <a href="<?php echo base_url();?>/usuarios" class = "btn btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-success">Guardar</button>
            </form>

        </div>
    </main>