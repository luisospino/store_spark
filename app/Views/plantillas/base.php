<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Store</title>
    <link href="<?= base_url();?>/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url();?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="<?= base_url();?>/js/all.min.js"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Header -->
    <?= $this->include('plantillas\header') ?>
    <!-- Fin Header -->

    <div id="layoutSidenav">

        <!-- Barra lateral -->
        <?= $this->include('plantillas\barra-lateral') ?>
        <!-- Fin Barra lateral -->

        <div id="layoutSidenav_content">

            <!-- Contenido -->
            <?= $this->renderSection('content') ?>
            <!-- Fin contenido -->

            <!-- Footer -->
            <?= $this->include('plantillas\footer') ?>
            <!-- Fin Footer -->

        </div>
        
    </div>

    <script src="<?= base_url();?>/js/jquery-3.5.1.js"></script>
    <script src="<?= base_url();?>/js/jquery-ui/external/jquery/jquery.js"></script>
    <script src="<?= base_url();?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url();?>/js/scripts.js"></script>
    <script src="<?= base_url();?>/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url();?>/js/jquery-ui/jquery-ui.min.js"></script>

    <!--SCRIPTS QUE REQUIEREN DE JQUERY Y JQUERY-UI (POR ESO ESTÁN DESPUÉS DE JQUERY)-->

    <!-- JS Adicional -->
    <?= $this->renderSection('aditional-js') ?>
    <!-- Fin JS Adicional -->

</body>

</html>