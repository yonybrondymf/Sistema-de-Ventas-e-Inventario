
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="<?php echo base_url();?>movimientos/ordenes/store" method="POST">
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
                                    
                                </tbody>
                            </table>
                            <div class="form-group">
                                <label for="">Mesas</label>
                                <select name="mesas[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione mesas" style="width: 100%;" required="required">
                                  <?php foreach ($mesas as $mesa): ?>
                                      <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero;?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat btn-guardar" disabled="disabled">Guardar</button>
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
