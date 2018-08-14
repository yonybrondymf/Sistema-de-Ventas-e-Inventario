<?php 
    $nummesas = "";
    foreach ($mesas as $mesa){
        $nummesas .= $mesa->numero.","; 
    } 

?>
<p><strong>Mesas: </strong> <?php echo substr($nummesas, 0, -1); ?></p>
<table class="table table-hover table-bordered" id="tborden">
    <thead>
        <tr>
            
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Importe</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0;?>
        <?php foreach ($productos as $producto): ?>
            <tr>
                
                <td>
                    <?php echo $producto->nombre;?>
                        
                </td>
                <td><?php echo $producto->cantidad;?>
                </td>
                <td>
                    <?php echo number_format($producto->precio, 2, '.', '');?>
                </td>
                <td>
                    <?php echo number_format($producto->cantidad * $producto->precio, 2, '.', ''); ?>
                </td>
                <?php $total = $total + ($producto->cantidad * $producto->precio);?>

            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td class="text-center" colspan="3" style="font-weight: bold;font-size: 16px;">Total</td>
            <td style="font-weight: bold;font-size: 16px;"><?php echo number_format($total, 2, '.', '');?></td>
        </tr>
    </tfoot>
</table>