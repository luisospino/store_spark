<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Store - Login</title>
        <link href="<?= base_url();?>/css/styles.css" rel="stylesheet" />
        <link href="<?= base_url();?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <script src="<?= base_url();?>/js/all.min.js"></script>
    </head>
    <body class="bg-primary">


        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                    
                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-lg-7">
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

                                <?php if(session()->has('error')){?>
                                    <div class="message alert alert-danger alert-dismissible fade show" role="alert">
                                        <li> <?= session()->get('error') ?> </li>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }?>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar sesión</h3></div>
                                    <div class="card-body">

                                        <form method = "POST" action = "<?= base_url(); ?>/usuarios/validar">
                                            <div class="form-group">
                                                <label class="small mb-1" for="usuario">Usuario:</label>
                                                <input class="form-control py-4" id="usuario" name = "usuario" value="<?= old('usuario') ?>" type="text"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="clave">Contraseña:</label>
                                                <input class="form-control py-4" id="clave" name = "clave" type="password"/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type = "submit" >Login</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; GitHub: luisospino <?= date('Y'); ?></div>
                            <div>
                                <a href="https://github.com/luisospino/" target="_blank">GitHub</a>
                                &middot;
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?= base_url();?>/js/jquery-3.5.1.js"></script>
        <script src="<?= base_url();?>/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url();?>/js/scripts.js"></script>
    </body>
</html>
