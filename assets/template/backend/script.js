$(document).ready(function () {
    $('.select2').select2();

    $(".btn-info-pedido").on("click", function(){
        idpedido = $(this).val();
        $.ajax({
            url:base_url + "movimientos/ordenes/view",
            type: "POST",
            data: {idpedido:idpedido},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
            }
        });
    });

    $(document).on("click",".btn-cerrar", function(){
        if ($("#estadoPedido").val() == "1") {
            window.location.href = base_url + "movimientos/ordenes";
        }else{
            location.reload();
        }
    });

    $("#comprobante").on("change", function(){
        id = $(this).val();

        $.ajax({
            url: base_url + "movimientos/ordenes/infoComprobante",
            type: "POST", 
            data:{idcomprobante:id},
            dataType:"json",
            success:function(resp){
                $("#serie").val(resp.serie);
                $("#idComprobante").val(resp.id);
                $("#igv").val(resp.igv);
                numero = Number(resp.cantidad) + 1;
                $("#numero").val(pad(numero,6));

                sumar();

            }

        });

    });
    $(".btn-procesar").on("click", function(){
        $("#tbpago tbody").html("");
        $("#tborden input[type=checkbox]").each(function(){
            data = $(this).val();
            info = data.split("*");
            html="";
            if($(this).is(":checked") && !$(this).is('[disabled]')) {
                html = "<tr>";
                html += "<td><input type='hidden' name='pedidoproductos[]' value='"+info[4]+"'><input type='hidden' name='productos[]' value='"+info[0]+"'>"+info[1]+"</td>";
                html += "<td><input type='hidden' name='precios[]' value='"+info[2]+"'>"+info[2]+"</td>";
                html += "<td><input type='hidden' name='cantidades[]' value='"+info[3]+"'>"+info[3]+"</td>";
                importe = info[2] * info[3];
                html += "<td><input type='hidden' name='importes[]' value='"+importe.toFixed(2)+"'>"+importe.toFixed(2)+"</td>";
                html += "</tr>";

                $("#tbpago tbody").append(html);

            }
        });

        sumar();
    });

    $("#check-all").on("change",function(){
        if($(this).is(':checked'))
        {
            $("#tborden tbody").find("input[type=checkbox]").attr("checked","checked");
            comprobar();
        }
    });

    $(document).on("change", "#tborden input[type=checkbox]",function(){
        /*if($(this).is(':checked'))
        {
            $("#tborden tbody").find("input[type=checkbox]").attr("checked","checked");
        }*/
        comprobar();
    })

    $(document).on("click", ".btn-selected", function(){
        valorBtn = $(this).val();
        infoBtn = valorBtn.split("*");

        if (infoBtn[4] == "N/A") {
            max = "";
        }else{
            max = infoBtn[4];
        }
        html = "<tr>";
        html += "<td><input type='hidden' name='productos[]' value='"+infoBtn[0]+"'>"+infoBtn[2]+"</td>";
        html += "<td>"+infoBtn[4]+"</td>";
        html += "<td>";
        html += '<div class="input-group">';
        html +='<span class="input-group-btn">'
        html +='<button class="btn btn-danger btn-menos" type="button"><span class="fa fa-minus"></span></button></span>';
        html +='<input type="number" name="cantidades[]" class="form-control" readonly="readonly" style="font-weight: bold;" value="1" min="1" max="'+max+'">';
        html +='<span class="input-group-btn">'
        html +='<button class="btn btn-primary btn-mas" type="button"><span class="fa fa-plus"></span></button></span></div><td>';
        html += "</tr>";

        $("#tborden tbody").append(html);
        $(".btn-guardar").removeAttr("disabled");
    });

    $("#categoria").on("change", function(){
        id = $(this).val(); 
        $.ajax({
            url: base_url + "movimientos/ordenes/getProductosByCategoria",
            type: "POST", 
            data:{idcategoria:id},
            dataType:"json",
            success:function(resp){
                html = "";
                $.each(resp,function(key, value){

                    if (value.condicion == "1") {
                        stock = value.stock;
                    }
                    else{
                        stock = "N/A";
                    }
                    data = value.id + "*"+ value.codigo+ "*"+ value.nombre+ "*"+ value.precio+ "*"+ stock;
                    html += "<tr>";
                    html += "<td>"+value.nombre+"</td>";
                    html += "<td><button type='button' class='btn btn-success btn-flat btn-selected' value='"+data+"'><span class='fa fa-check'></span></button></td>";
                    html += "</tr>";
                });

                $("#tbproductos tbody").html(html);
            }

        });
    });

    
    $(document).on("click", ".btn-menos", function(){
        input = $(this).closest(".input-group").find("input");
        valorAct = Number(input.val());
        resto = Number(valorAct - 1);
        if (resto == 0) {
            alert("Ud. no puede reducir la cantidad menor a 1");
        }else{
            input.val(resto);
        }


        
        /*cantidad = Number(input.val());
        input.val(cantidad + 1);
*/

    });

    $(document).on("click", ".btn-mas", function(){
        input = $(this).closest(".input-group").find("input");
        valorAct = Number(input.val());
        aumento = Number(valorAct + 1);
        valorMax = input.attr("max");


        if (valorMax=="") {
            input.val(aumento);
        }else{
            if (aumento > Number(valorMax) ) {
                alert("Ud. no puede sobrepasar el stock del producto");
            }else{
                input.val(aumento);
            }
        }
        
        /*cantidad = Number(input.val());
        input.val(cantidad + 1);
*/

    });

    $("#monto_efectivo").on("keyup", function(){
        valor  = Number($(this).val());
        ventas = Number($("#monto_ventas").val());
        apertura = Number($("#monto_apertura").val());
        monto = ventas + apertura;
        if (valor == monto) {
            $("#observacion").val("Cuadre de Caja conforme");
        }else{
            $("#observacion").val("Cuadre de Caja no conforme");
        }
    });

    $("#btn-ver").on("click",function(){
        $.ajax({
        url : base_url + "movimientos/ventas/verStock",
        type: "POST",
        data: {},
        success: function(resp){
            alert(resp);
        }

    });
    });

    var timeout; 
    document.onmousemove = function(){ 
        clearTimeout(timeout); 
        timeout = setTimeout(function(){
            swal({
              title: "Tu sesión ha expirado",
              text: "Si deseas continuar trabajando hace clic en el boton Cancel o en el boton Ok para terminar la sesión",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Ok",
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url: base_url + "auth/logout",
                        type: "POST",
                        success:function(resp){
                            window.location.href= base_url;
                        }

                    });
                }else{
                    location.reload();
                }
              
            });
        }, 300000); 
    } 

    $("#btnActualizarApertura").on("click", function(){
        $("#panelApertura").hide();
        $("#formActualizarApertura").show();
    });

    $(".menu-notificaciones li").on("click", function(){
        return false;
    })

    $(".remove-notificacion").on("click", function(e){
        e.preventDefault();
        id = $(this).attr("href");
        $(this).parent().parent().remove();
        $.ajax({
            url: base_url + "notificaciones/delete",
            data: {id:id},
            type: "POST",
            success:function(resp){
                if (resp > 0 ) {
                    $(".notifications-menu a span").text(resp);
                    $(".notifications-menu ul li.header").text("Tienes "+resp+" notificaciones");
                }else{
                    $(".notifications-menu a span").remove();
                    $(".notifications-menu ul li.header").text("Tienes 0 notificaciones");
                    $(".notifications-menu ul li.footer").remove();
                }
            }
        });


        return false;
    });

    $("input[name=condicion]").click(function() {
        condicion = $(this).val();
        if (condicion == "0") {
            $("input[name=stock]").attr("disabled","disabled");
            $("input[name=stockminimo]").attr("disabled","disabled");
            $("input[name=stock]").val(null);
            $("input[name=stockminimo]").val(null);
        }else{
            $("input[name=stock]").removeAttr("disabled");
            $("input[name=stockminimo]").removeAttr("disabled");
        }
    });

    $("#descuento").on("keyup",function(){
        sumar();
    });
    $("#form-comprobar-password").submit(function(e){
        e.preventDefault();
        montoDescuento = $("#montoDescuento").val();
        data = $(this).serialize();
        $.ajax({
            url: base_url + "movimientos/ventas/comprobarPassword",
            type:"POST",
            data: data,
            //dataType: "json",
            success:function(resp){
                if (resp == "1") {
                    $('#modal-default2').modal('hide');
                    alertify.success("La contraseña es correcta");
                    $("#descuento").val(montoDescuento);
                    sumar();
                    
                    
                } else {
                    alertify.error("La contraseña no es válida");
                }      
            }
        });
    });

    $("#btn-pagar").on("click", function(){
        idventa = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/pagar",
            type:"POST",
            data: {id:idventa},
            //dataType: "json",
            success:function(resp){
                window.location.href = base_url + resp;         
            }
        });
    });
    $("#form-venta").submit(function(e){
        e.preventDefault();

        cantidadProductos = $("#tbpago tbody tr").length;

        if (cantidadProductos < 1) {
            alertify.error("Agregue productos a pagar");
        }else{
            data = $(this).serialize();
            ruta = $(this).attr("action");
            $.ajax({
                url: ruta,
                type:"POST",
                data: data,
                //dataType: "json",
                success:function(resp){
                    if (resp != "0") {
                        alertify.success("La informacion de la venta fue actualizada");
                        $("#modal-venta").modal({backdrop: 'static', keyboard: false});
                        $("#modal-venta .modal-body").html(resp);
                    }else{
                        alertify.error("No se pudo actualizar la informacion de la venta");
                    }            
                }
            });
        }

        
    });
    $("#form-cierre").submit(function(e){
        e.preventDefault();

        data = $(this).serialize();
        ruta = $(this).attr("action");
        if ($("#monto_apertura").val() == "") {
            alertify.error("Es necesario establece una apertura de caja.");
        }else{
            alertify.confirm("¿Estas seguro de cerrar la caja?", function(e){
                if (e) 
                {
                    $.ajax({
                        url: ruta,
                        type:"POST",
                        data: data,
                        success:function(resp){
                            
                            window.location.href = base_url + resp;
                            
                        }
                    });

                }
            });
        }
        
    });
    $("#form-cliente").submit(function(e){
        e.preventDefault();
        data = $(this).serialize();
        ruta = $(this).attr("action");
        $.ajax({
            url: ruta,
            type:"POST",
            data: data,
            dataType: "json",
            success:function(resp){
                
                alertify.success("El cliente se registro correctamente");
                $('#modal-default').modal('hide');
              
                $("#cliente").val(resp.nombres);
                $("#idcliente").val(resp.id);
                
            }
        });

    });

    var year = (new Date).getFullYear();
    datagrafico(base_url);
    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
    $(".btn-remove").on("click", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });

     $(".btn-view-producto").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/productos/view/" + id,
            type:"POST",
            success:function(resp){
                $(".modal-title").text("Informacion del Producto");
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
  
    $(".btn-view-cliente").on("click", function(){
        var cliente = $(this).val(); 
        //alert(cliente);
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Cliente:</strong>"+infocliente[2]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[6]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
    $(".btn-view").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/categorias/view/" + id,
            type:"POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type:"POST",
            data:{idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5,6,7 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5,6,7 ]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('#inventario').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Inventario",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Inventario",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
 
	$('#example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    $('.example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

	$('.sidebar-menu').tree();

    $("#comprobantes").on("change",function(){
        option = $(this).val();

        if (option != "") {
            infocomprobante = option.split("*");

            $("#idcomprobante").val(infocomprobante[0]);
            $("#iva").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);
            $("#numero").val(generarnumero(infocomprobante[1]));
        }
        else{
            $("#idcomprobante").val(null);
            $("#iva").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumar();
    })

    $(document).on("click",".btn-check",function(){
        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");
    });
    $("#producto").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getproductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){

            if (ui.item.condicion == "1") {
                stock = ui.item.stock;
            }
            else{
                stock = "N/A";
            }
            data = ui.item.id + "*"+ ui.item.codigo+ "*"+ ui.item.label+ "*"+ ui.item.precio+ "*"+ stock + "*" + ui.item.asociado;
            $("#btn-agregar").val(data);
        },
    });
    //autcompletador para productos asociados
    $("#productosA").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getproductosA",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){

            html =  '<tr>'+
                        '<td><input type="hidden" name="idproductosA[]" value="'+ ui.item.id +'">'+ ui.item.codigo +'</td>'+
                        '<td>'+ ui.item.label +'</td>'+
                        '<td><input type="number" name="cantidadA[]" class="form-control"  value="1" min="1"></td>'+
                        '<td><button type="button" class="btn btn-danger btn-quitarAsociado"><i class="fa fa-times"></i></button></td>'+
                    '</tr>';
            $("#tbAsociados tbody").append(html);
        },
    });

    $(document).on("click",".btn-quitarAsociado", function(){
        $(this).closest("tr").remove();
    });
    $("#btn-agregar").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
            html += "<td>"+infoproducto[4]+"</td>";
            html += "<td><input type='number' min='0' name='cantidades[]' value='1' class='cantidades'></td>";
            html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $("#btn-agregar").val(null);
            $("#producto").val(null);

        }else{
            alertify.error("Seleccione un producto...");
        }
    });

    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });
    $(document).on("keyup mouseup","#tbventas input.cantidades", function(){
        cantidad = Number($(this).val());
        precio = Number($(this).closest("tr").find("td:eq(2)").text());
        stock = Number($(this).closest("tr").find("td:eq(3)").text());

        if (cantidad > stock) {
            $(this).val(stock);
            alertify.error("La cantidad ingresada no debe sobrepasar el stock del producto");
            importe = stock * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        }
        else{
           
            importe = cantidad * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        }
    });
    $(document).on("click",".btn-view-venta",function(){
        valor_id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-venta .modal-body").html(data);
            }
        });
    });
    $(document).on("click",".btn-print-pedido",function(){
        $(".contenido-pedido").addClass("impresion");
        $(".contenido-pedido").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });

    $(document).on("click",".btn-print",function(){
        $(".contenido").addClass("impresion");
        $(".contenido").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });
    $(document).on("click",".btn-print-cierre",function(){
        $(".contenido-cierre").addClass("impresion");
        $(".contenido-cierre").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });


    });
})

function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 9999 && numero< 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 999 && numero< 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "00000" + (Number(numero)+1);
    }
}



function sumar(){
    subtotal = 0;
    $("#tbpago tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(3)").text());
    });

    $("input[name=subtotal]").val(subtotal.toFixed(2));
    porcentaje = Number($("#igv").val());
    igv = subtotal * (porcentaje/100);
    $("input[name=iva]").val(igv.toFixed(2));
    descuento = Number($("input[name=descuento]").val());
    total = subtotal + igv - descuento;
    $("input[name=total]").val(total.toFixed(2));

    $(".subtotal").text(subtotal.toFixed(2));
    $(".iva").text(igv.toFixed(2));
    $(".descuento").text(descuento.toFixed(2));
    $(".total").text(total.toFixed(2));

}
function datagrafico(base_url){
    /*namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];*/
    $.ajax({
        url: base_url + "Grafico/getData",
        type:"POST",
        dataType:"json",
        success:function(data){
            var dias = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                dias.push(value.fecha);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar(dias,montos);
        }
    });
}

function graficar(dias,montos){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado por ventas diarias'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: dias,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (Quetzales)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} Quetzales</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Dias',
        data: montos

    }]
});
}

function descontarStock(id,stock,asociado){
    alert(id + " " +stock + " "+asociado);

    $.ajax({
        url : base_url + "movimientos/ventas/descontarStock",
        type: "POST",
        data: {idproducto:id,stock:stock,asociado:asociado},
        success: function(resp){
            alert(resp);
        }

    });
}

function comprobar(){
    var contador=0;
 
    // Recorremos todos los checkbox para contar los que estan seleccionados
    $("#tborden input[type=checkbox]").each(function(){
        if($(this).is(":checked"))
            contador++;
    });
    totalfilas = $("#tborden tbody tr").length;

    if (totalfilas == contador) {
        $("#estadoPedido").val("1");
    }else{
        $("#estadoPedido").val("0");
    }

} 


function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}