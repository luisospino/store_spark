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

            <form method = "POST" action="<?= route_to('usuarios.insertar') ?>" autocomplete = "off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Nombre</label>

                            <input type="text" id = "nombre" name = "nombre" value="<?= old('nombre') ?>" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Nombre de usuario</label>

                            <input type="text" id = "usuario" name = "usuario" value="<?= old('usuario') ?>" class="form-control" >
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
                                    <option value="<?= $rol['id']?>" <?= $rol['id'] == old('id_rol') ? "selected" : "" ?>>
                                        <?= $rol['nombre']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Caja</label>
                            <select class = "form-control" id="id_caja" name = "id_caja">
                                <option value="">Seleccionar caja</option>
                                <?php foreach($cajas as $caja){?>
                                    <option value="<?= $caja['id']?>" <?= $caja['id'] == old('id_caja') ? "selected" : "" ?>>
                                        <?= $caja['nombre']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>                        
                    </div>    
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Contraseña</label>

                            <input type="password" id = "clave" name = "clave" class="form-control" >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Confirmación</label>

                            <input type="password" id = "clave_confirmacion" name = "clave_confirmacion" class="form-control" >
                        </div>
                    </div>    
                </div>

                <a href="<?= route_to('usuarios.inicio') ?>" class = "btn btn-primary">Regresar</a>   
                <button type="submit" class = "btn btn-success">Guardar</button>
            </form>

        </div>
    </main>