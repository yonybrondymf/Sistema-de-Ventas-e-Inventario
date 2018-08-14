
<div class="row">
	<div class="col-xs-12 text-center">
		<b>Quicheladas</b><br>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco <br>
		Santa Cruz del Quiche <br>
		
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-6">	
		<b>Estado: </b><?php if ($venta->estado == "1") {
                                                    echo '<span class="label label-success">Pagado</span>';
                                                }else if($venta->estado == "2"){
                                                    echo '<span class="label label-warning">Pendiente</span>';
                                                }else{
                                                    echo '<span class="label label-danger">Anulado</span>';
                                                } ?>
                                            <br>
		<b>Cliente: </b><br>
		<b>Nombre: </b> <?php echo $venta->nombre;?> <br>
		<b>No. Documento:</b> <?php echo $venta->documento;?><br>
		<b>Telefono:</b> <?php echo $venta->telefono;?> <br>
		<b>Direccion</b> <?php echo $venta->direccion;?><br>
	</div>	
	<div class="col-xs-6">	
		<b>COMPROBANTE</b> <br>
		<b>Tipo de Comprobante:</b> <?php echo $venta->tipocomprobante;?><br>
		<b>Serie:</b> <?php echo $venta->serie;?><br>
		<b>No. de Comprobante:</b><?php echo $venta->num_documento;?><br>
		<b>Fecha</b> <?php echo $venta->fecha;?>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<tr>
					<td><?php echo $detalle->codigo;?></td>
					<td><?php echo $detalle->nombre;?></td>
					<td><?php echo $detalle->precio;?></td>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->importe;?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
					<td><?php echo $venta->subtotal;?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>iva:</strong></td>
					<td><?php echo $venta->iva;?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Descuento:</strong></td>
					<td><?php echo $venta->descuento;?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><?php echo $venta->total;?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>