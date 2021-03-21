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
<script src="<?= base_url();?>/js/jquery-ui/external/jquery/jquery.js"></script>
<script src="<?= base_url();?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>/js/scripts.js"></script>
<script src="<?= base_url();?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>/js/jquery-ui/jquery-ui.min.js"></script>

<!--SCRIPTS QUE REQUIEREN DE JQUERY Y JQUERY-UI (POR ESO ESTÁN DESPUÉS DE JQUERY)-->
<script src="<?= base_url();?>/js/compras.js"></script>
<script src="<?= base_url();?>/js/ventas.js"></script>

<script>
    $("#modal-confirma").on("show.bs.modal", function(e){
        $("#btn-ok").attr('href', $(e.relatedTarget).data('href'));
    });

    $(document).ready(function(){
        $(".message").fadeOut(3000);
        $('#dataTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            order: [0, 'asc']
        });
    });
</script>

</body>

</html>