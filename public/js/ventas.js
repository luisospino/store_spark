$(document).ready(function(){
    var productos = [];
    var enumeracion = 0;
    var total = 0;
    var producto_actual = null;

    $('#cliente').autocomplete({
        minLength: 3,

        source: function(request, response) {
            $.ajax({
                method: 'GET',
                url: `http://localhost:8080/clientes/obtenerClientes/${request.term}`,

                success: function (datos) {
                    clientes = JSON.parse(datos);
                    var transformacion = $.map(clientes, function (cliente) {
                        return {
                            id: cliente.id,
                            value: cliente.nombre,
                        };
                    });
                    response(transformacion);
                },
                error: function () {
                    response([]);
                }
            });
        },

        select: function(e, ui){
            e.preventDefault();
            $('#message_venta').empty();
            $("#id_cliente").val(ui.item.id);
            $("#cliente").val(ui.item.value);
        }
    });

    $('#codigo_barra').autocomplete({
        minLength: 3,

        source: function(request, response) {
            $.ajax({
                method: 'GET',
                url: `http://localhost:8080/productos/obtenerProductos/${request.term}`,

                success: function (datos) {
                    productos_venta = JSON.parse(datos);
                    var transformacion = $.map(productos_venta, function (producto) {
                        producto.id = parseInt(producto.id);
                        producto.existencias = parseInt(producto.existencias);
                        producto.precio_venta = parseFloat(producto.precio_venta);
                        producto.cantidad = 1;
                        producto.subtotal = parseFloat(producto.precio_venta) * producto.cantidad;

                        return {
                            id: producto.id,
                            label: `${producto.codigo} - ${producto.nombre}`,
                            value: producto.codigo,
                            existencias: producto.existencias,
                            nombre: producto.nombre,
                            precio_venta: producto.precio_venta,
                            cantidad: producto.cantidad,
                            subtotal: producto.precio_venta * producto.cantidad
                        };
                    });
                    response(transformacion);
                },
                error: function () {
                    response([]);
                }
            });
        },

        select: function(e, ui){
            e.preventDefault();

            $('#message_venta').empty();
            $("#codigo_barra").val(ui.item.value);
            $("#nombre_venta").val(ui.item.nombre);
            $("#cantidad_venta").val(ui.item.cantidad);
            $("#precio_venta").val(ui.item.precio_venta.toFixed(2));
            $("#subtotal_venta").val(ui.item.subtotal.toFixed(2));
            $("#cantidad_venta").focus();

            producto_actual = ui.item;
        }
    });

    $("#cantidad_venta" ).keyup(function(e) {
        var cantidad = $("#cantidad_venta").val().trim();
        reg = RegExp('^[0-9]+$');

        if(reg.test(cantidad)){
            cantidad = parseInt(cantidad);
        }

        if(cantidad != "" && cantidad != 0 && typeof(cantidad) == 'number' &&  producto_actual != null){
            producto_actual.cantidad = parseInt(cantidad);
            producto_actual.subtotal = producto_actual.precio_venta * producto_actual.cantidad;
            $('#subtotal_venta').val(producto_actual.subtotal.toFixed(2));
        }
    });

    function existeProducto(id){
        for(let producto of productos) {
            if(producto.id == id){
                return true;
            }
        }
        return false;
    }

    function obtenerCantidadProducto(id){
        for(let producto of productos) {
            if(producto.id == id){
                return producto.cantidad;
            }
        }
    }

    function actualizarProducto(id){
        for(let producto of productos) {
            if(producto.id == id){
                producto.cantidad += producto_actual.cantidad;
                producto.subtotal += producto_actual.subtotal;
                total += producto_actual.subtotal;

                $('#cantidad_venta_'+id).text(producto.cantidad);
                $('#subtotal_venta_'+id).text("$" + producto.subtotal.toFixed(2));
                $("#total_venta").text("$" + total.toFixed(2));
            }
        }
    }

    $("#agregar_producto_venta" ).click(function(e){
        enumeracion++;
        
        if($("#id_cliente").val() == ''){
            var template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <li>El campo Cliente es obligatorio</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
            $('#message_venta').html(template);

        }else if(producto_actual != null){

            if(!existeProducto(producto_actual.id)){
                if(producto_actual.existencias < producto_actual.cantidad){
                    var template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <li>La cantidad excede las existencias del producto (${producto_actual.existencias} existencias)</li>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>`;
                    $('#message_venta').html(template);
                }else{                    
                    $('#message_venta').empty();
                    total =  parseFloat(total) + producto_actual.subtotal;
                    $("#total_venta").text("$" + total.toFixed(2));
                    productos.push(producto_actual);
    
                    let template = `<tr id = "producto_venta_${producto_actual.id}">
                                        <th scope="row">${enumeracion}</th>
                                        <td>${producto_actual.nombre}</td>
                                        <td>${producto_actual.precio_venta.toFixed(2)}</td>
                                        <td id = "cantidad_venta_${producto_actual.id}">${producto_actual.cantidad}</td>
                                        <td id = "subtotal_venta_${producto_actual.id}">$${producto_actual.subtotal.toFixed(2)}</td>
                                        <td class = "text-center"> <button id = ${producto_actual.id} class = "btn btn-sm btn-danger borrar_venta"><i class="fa fa-trash"></i></button> </td>
                                    </tr>`;
                    $('#tabla_productos_venta').append(template);
    
                    $("#cliente").prop( "disabled", true);
                    $("#id_metodo_pago").prop( "disabled", true);
                    $("#codigo_barra").val('');
                    $("#nombre_venta").val('');
                    $("#cantidad_venta").val('');
                    $("#precio_venta").val('');
                    $("#subtotal_venta").val('');                    
                    producto_actual = null; 
                }
            }else{
                if(producto_actual.existencias < (producto_actual.cantidad + obtenerCantidadProducto(producto_actual.id)) ){
                    var template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <li>La cantidad excede las existencias del producto (${producto_actual.existencias} existencias)</li>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>`;
                    $('#message_venta').html(template);
                }else{
                    $('#message_venta').empty();
                    actualizarProducto(producto_actual.id);          
                    $("#codigo_barra").val('');
                    $("#nombre_venta").val('');
                    $("#cantidad_venta").val('');
                    $("#precio_venta").val('');
                    $("#subtotal_venta").val('');              
                    producto_actual = null; 
                }
            }           
        }else{
            var template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <li>Debe buscar un producto por el código y seleccionarlo</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
            $('#message_venta').html(template);
        }
    });

    function eliminarProducto(id){
        for(let i = 0; i < productos.length; i++) {
            if(productos[i].id == id){
                total -= productos[i].subtotal;
                productos.splice(i, 1);

                $("#total_venta").text("$" + total.toFixed(2));
                $('#producto_venta_'+id).remove();
            }
        }
    }

    $(document).on('click','.borrar_venta',function(e){
        e.preventDefault();
        id = $(this)[0].id;
        eliminarProducto(id);

        if(productos.length == 0){
            $("#cliente").prop( "disabled", false);
            $("#id_metodo_pago").prop( "disabled", false);
        }
    });

    $("#boton_venta" ).click(function(e) {
        e.preventDefault();

        if(productos.length != 0){
            let venta = {
                total: total,
                id_cliente: parseInt($("#id_cliente").val()),
                id_metodo_pago: parseInt($("#id_metodo_pago").val())
            };
    
            $.ajax({
                url: `http://localhost:8080/ventas/completarVenta`,
                method: 'POST',
                data: {venta : venta, productos: productos},
                success: function(id_venta){
                    window.location.href = `http://localhost:8080/ventas/verVentaPdf/${id_venta}`;
                },
                error: function(){
                }
            });
        }else{
            let template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <li>No hay productos agregados</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
            $('#message_venta').html(template);
        }
    });
});