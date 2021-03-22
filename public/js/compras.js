$(document).ready(function(){
    var productos = [];
    var enumeracion = 0;
    var total = 0;
    var producto_actual = null;

    $('#codigo_compra').autocomplete({
        minLength: 3,

        source: function(request, response) {
            $.ajax({
                method: 'GET',
                url: `http://localhost:8080/productos/obtenerProductos/${request.term}`,
                
                success: function (datos) {
                    productos_compra = JSON.parse(datos);
                    var transformacion = $.map(productos_compra, function (producto) {
                        producto.id = parseInt(producto.id);
                        producto.precio_compra = parseFloat(producto.precio_compra);
                        producto.cantidad = 1;
                        producto.subtotal = parseFloat(producto.precio_compra) * producto.cantidad;

                        return {
                            id: producto.id,
                            label: `${producto.codigo} - ${producto.nombre}`,
                            value: producto.codigo,
                            nombre: producto.nombre,
                            precio_compra: producto.precio_compra,
                            cantidad: producto.cantidad,
                            subtotal: producto.precio_compra * producto.cantidad
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
            $('#message').empty();
            $("#codigo_compra").val(ui.item.value);
            $("#nombre").val(ui.item.nombre);
            $("#cantidad").val(ui.item.cantidad);
            $("#precio_compra").val(ui.item.precio_compra.toFixed(2));
            $("#subtotal").val(ui.item.subtotal.toFixed(2));
            $("#cantidad").focus();

            producto_actual = ui.item;
            //console.log(producto_actual);
        }
    });

    $("#cantidad" ).keyup(function(e) {
        var cantidad = $("#cantidad").val().trim();
        reg = RegExp('^[0-9]+$');

        if(reg.test(cantidad)){
            cantidad = parseInt(cantidad);
        }

        if( cantidad != "" && cantidad != 0 && typeof(cantidad) == 'number' &&  producto_actual != null){
            producto_actual.cantidad = parseInt(cantidad);
            producto_actual.subtotal = producto_actual.precio_compra * producto_actual.cantidad;
            $('#subtotal').val(producto_actual.subtotal.toFixed(2));
            //console.log("producto ACTUAL: ", producto_actual);
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

    function actualizarProducto(id){
        for(let producto of productos) {
            if(producto.id == id){
                producto.cantidad += producto_actual.cantidad;
                producto.subtotal += producto_actual.subtotal;
                total += producto_actual.subtotal;

                $('#cantidad_'+id).text(producto.cantidad);
                $('#subtotal_'+id).text("$" + producto.subtotal.toFixed(2));
                $("#total").text("$" + total.toFixed(2));
                //console.log("producto agregado: ", producto);
            }
        }
    }

    function eliminarProducto(id){
        for(let i = 0; i < productos.length; i++) {
            if(productos[i].id == id){
                total -= productos[i].subtotal;
                productos.splice(i, 1);

                $("#total").text("$" + total.toFixed(2));
                $('#producto_'+id).remove();
            }
        }
    }

    $("#agregar_producto" ).click(function(e) {
        if(producto_actual != null){
            enumeracion++;

            if(!existeProducto(producto_actual.id)){
                total =  parseFloat(total) + producto_actual.subtotal;
                $("#total").text("$" + total.toFixed(2));
                productos.push(producto_actual);

                let template = `<tr id = "producto_${producto_actual.id}">
                                    <th scope="row">${enumeracion}</th>
                                    <td>${producto_actual.nombre}</td>
                                    <td>${producto_actual.precio_compra.toFixed(2)}</td>
                                    <td id = "cantidad_${producto_actual.id}">${producto_actual.cantidad}</td>
                                    <td id = "subtotal_${producto_actual.id}">$${producto_actual.subtotal.toFixed(2)}</td>
                                    <td class = "text-center"> <button id = ${producto_actual.id} class = "btn btn-sm btn-danger borrar"><i class="fa fa-trash"></i></button> </td>
                                </tr>`;
                $('#tabla_productos').append(template);
    
                $("#codigo_compra").val('');
                $("#nombre").val('');
                $("#cantidad").val('');
                $("#precio_compra").val('');
                $("#subtotal").val('');
            }else{
                actualizarProducto(producto_actual.id);

                $("#codigo_compra").val('');
                $("#nombre").val('');
                $("#cantidad").val('');
                $("#precio_compra").val('');
                $("#subtotal").val('');                
            }
            producto_actual = null;
        }else{
            var template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <li>Debe buscar un producto por el código y seleccionarlo</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
            $('#message').html(template);
        }
        //console.log(productos);
    });
    
    $(document).on('click','.borrar',function(e){
        e.preventDefault();
        id = $(this)[0].id;
        eliminarProducto(id);
        //console.log("productos", productos);
    });
    
    $("#boton_comprar" ).click(function(e) {
        e.preventDefault();

        if(productos.length != 0){
            let compra = {
                total: total
            };
    
            $.ajax({
                url: `http://localhost:8080/compras/completarCompra`,
                method: 'POST',
                data: {compra : compra, productos: productos},
                success: function(id_compra){
                    window.location.href = `http://localhost:8080/compras/verCompraPdf/${id_compra}`;
                },
                error: function(){
                    console.log("Manipular error");
                }
            });
        }else{
            let template = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <li>No hay productos agregados</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
            $('#message').html(template);
        }
    });
});