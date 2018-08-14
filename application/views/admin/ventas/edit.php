s
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ventas
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        
                        <form action="<?php echo base_url();?>movimientos/ventas/update" method="POST" id="form-venta-update" class="form-horizontal">
                            <input type="hidden" name="estado" value="<?php echo $estado; ?>">

                            <input type="hidden" name="idventa" value="<?php echo $venta->id; ?>">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="">Comprobante:</label>
                                    <select name="comprobantes" id="comprobantes" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <?php foreach($tipocomprobantes as $tipocomprobante):?> 
                                            <?php $datacomprobante = $tipocomprobante->id."*".$tipocomprobante->cantidad."*".$tipocomprobante->iva."*".$tipocomprobante->serie;?>
                                            <option value="<?php echo $datacomprobante;?>" <?php echo $tipocomprobante->id == $venta->tipo_comprobante_id ? 'selected' : ''; ?>><?php echo $tipocomprobante->nombre?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <input type="hidden" id="idcomprobante" name="idcomprobante" value="<?php echo $venta->tipo_comprobante_id; ?>">
                                    <input type="hidden" id="iva" value="<?php echo $venta->porcentaje?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Serie:</label>
                                    <input type="text" class="form-control" id="serie" name="serie" value="<?php echo $venta->serie; ?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Numero:</label>
                                    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $venta->num_documento; ?>" readonly>
                                </div>
                                 
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Cliente:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $venta->cliente_id; ?>">
                                        <input type="text" class="form-control" disabled="disabled" id="cliente" value="<?php echo $venta->nombre; ?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div> 
                                <div class="col-md-3">
                                    <label for="">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" value="<?php echo $venta->fecha; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Producto:</label>
                                    <input type="text" class="form-control" id="producto">
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tbventas" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>

                                        <th>Precio</th>
                                        <th>Stock Max.</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <?php if ($this->session->userdata("rol") == "1"):?>
                                            <th></th>
                                        <?php endif;?>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($detalles as $detalle):?>
                                    <tr>
                                        <td>
                                            <input type='hidden' name='idproductos[]' value='<?php echo $detalle->producto_id;?>'><?php echo $detalle->codigo;?>
                                        </td>
                                        <td><?php echo $detalle->nombre;?></td>
                                        <td>
                                            <input type='hidden' name='precios[]' value='<?php echo $detalle->precio;?>'><?php echo $detalle->precio;?>
                                        </td>
                                        <?php if ($detalle->condicion == "1"): ?>
                                            <td><?php echo $detalle->stock;?></td>   
                                        <?php else:?>
                                            <td><?php echo "N/A";?></td>
                                        <?php endif ?>
                                        
                                        <td>
                                            <input type='text' name='cantidades[]' class='cantidades' value='<?php echo $detalle->cantidad;?>'>
                                        </td>
                                        <td>
                                            <input type='hidden' name='importes[]' value='<?php echo $detalle->importe;?>'>
                                            <p><?php echo $detalle->importe;?></p>
                                        </td>
                                        <?php if ($this->session->userdata("rol") == "1"):?>
                                        <td>

                                            <button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Subtotal:</span>
                                        <input type="text" class="form-control" placeholder="Username" name="subtotal" value="<?php echo $venta->subtotal; ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">iva:</span>
                                        <input type="text" class="form-control" placeholder="iva" name="iva" value="<?php echo $venta->igv; ?>"  readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Descuento:</span>
                                        <input type="text" class="form-control" placeholder="Descuento" name="descuento" id="descuento" value="<?php echo $venta->descuento; ?>" readonly="readonly">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" id="btn-descuento" type="button" data-toggle="modal" data-target="#modal-default2">
                                                Aplicar
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Total:</span>
                                        <input type="text" class="form-control" placeholder="Total" name="total" value="<?php echo $venta->total; ?>" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <button type="button" id="btn-pagar" class="btn btn-primary btn-flat" value="<?php echo $venta->id;?>">Pagar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Clientes</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($clientes)):?>
                            <?php foreach($clientes as $cliente):?>
                                <tr>
                                    <td><?php echo $cliente->id;?></td>
                                    <td><?php echo $cliente->nombre;?></td>
                                    <td><?php echo $cliente->num_documento;?></td>
                                    <?php $datacliente = $cliente->id."*".$cliente->nombre."*".$cliente->tipocliente."*".$cliente->tipodocumento."*".$cliente->num_documento."*".$cliente->telefono."*".$cliente->direccion;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente;?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del Administrador</h4>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="form-comprobar-password">
                    <div class="form-group">
                        <label for="">Introduzca Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña...">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Comprobar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
