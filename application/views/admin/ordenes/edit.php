
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="<?php echo base_url();?>movimientos/ordenes/update" method="POST">
                            <input type="hidden" name="idPedido" value="<?php echo $orden->id;?>">
                            <h4>Productos Agregado a la Orden</h4>
                            <table class="table table-hover table-bordered" id="tborden">
                                <thead>
                                    <tr>
                                        <th style="width:50%;">Producto</th>
                                        <th style="width:25%;">Stock Max</th>
                                        <th style="width:25%;">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productos as $producto): ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="productos[]" value="<?php echo $producto->producto_id?>">
                                                <?php echo $producto->nombre;?>
                                                    
                                            </td>
                                            <?php 
                                                $stock = "N/A";
                                                if ($producto->condicion == 1){
                                                    $stock = $producto->stock;
                                                }
                                                
                                            ?>
                                            <td><?php echo $stock;?></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-danger btn-menos" type="button" disabled="disabled"><span class="fa fa-minus"></span></button></span>
                                                    <input type="number" name="cantidades[]" class="form-control" readonly="readonly" style="font-weight: bold;" value="<?php echo $producto->cantidad;?>" min="1" max="">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-primary btn-mas" type="button" disabled="disabled"><span class="fa fa-plus"></span></button></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <?php 
                                $mesasActual = "";
                                foreach ($pedidomesas as $pedidomesa){
                                    $mesasActual .= $pedidomesa->numero.",";
                                }
                            ?>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-6">
                                   <label for="">Mesa Actual</label>
                                   <input type="text" class="form-control" disabled="disabled" value="<?php echo $mesasActual; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Unir mesa con:</label>
                                    <select name="mesa" id="mesa" class="form-control">
                                       <option value="">Seleccione Mesa</option>
                                       <?php foreach ($mesas as $mesa): ?>
                                           <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero;?></option>
                                       <?php endforeach ?>
                                   </select>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <a href="<?php echo base_url();?>movimientos/ordenes" class="btn btn-danger">Volver</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h4>Seleccion de Productos</h4>
                        <div class="form-group">
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Seleccione Categoria</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <table class="table table-bordered table-hover" id="tbproductos">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            
                        </table>

                        
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
