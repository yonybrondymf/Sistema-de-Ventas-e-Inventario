<p><strong>Codigo:</strong> <?php echo $producto->codigo;?></p>
<p><strong>Nombre:</strong> <?php echo $producto->nombre;?></p>
<p><strong>Descripcion:</strong> <?php echo $producto->descripcion;?></p>
<p><strong>Precio:</strong> <?php echo $producto->precio;?></p>
<?php if ($producto->condicion == 0) { ?>
    <p><strong>Stock Minimo:</strong> N/A</p>
    <p><strong>Stock:</strong> N/A</p>
<?php }else{ ?>
    <p><strong>Stock Minimo:</strong> <?php echo $producto->stock_minimo;?></p>
    <p><strong>Stock:</strong> <?php echo $producto->stock;?></p>
<?php } ?>

<p><strong>Categoria:</strong> <?php echo $producto->categoria;?></p>

<?php if (!empty($productosA)): ?>
	
	<table class="table table-bordered">
		<caption class="text-center"><strong>Productos Asociados</strong></caption>
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Catnidad</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($productosA as $productoA): ?>
				<tr>
					<td><?php echo $productoA->codigo;?></td>
					<td><?php echo $productoA->nombre;?></td>
					<td><?php echo $productoA->cantidad;?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>
<?php endif ?>