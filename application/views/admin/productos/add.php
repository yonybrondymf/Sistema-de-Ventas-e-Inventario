
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                
                <form action="<?php echo base_url();?>mantenimiento/productos/store" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if($this->session->flashdata("error")):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                    
                                 </div>
                            <?php endif;?>
                            
                                <div class="form-group">
                                    <label for="categoria">Categoria:</label>
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        <?php foreach($categorias as $categoria):?>
                                            <option value="<?php echo $categoria->id?>"><?php echo $categoria->nombre;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group <?php echo !empty(form_error('codigo')) ? 'has-error':'';?>">
                                    <label for="codigo">Codigo:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo set_value('codigo');?>" required>
                                    <?php echo form_error("codigo","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="form-group <?php echo !empty(form_error('nombre')) ? 'has-error':'';?>">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo set_value('nombre');?>">
                                    <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="form-group ">
                                    <label for="descripcion">Descripcion:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                </div>
                                <div class="form-group <?php echo !empty(form_error('precio')) ? 'has-error':'';?>">
                                    <label for="precio">Precio:</label>
                                    <input type="text" class="form-control" id="precio" name="precio" required value="<?php echo set_value('precio');?>">
                                    <?php echo form_error("precio","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="form-group">
                                    <label class="radio-inline">
                                      <input type="radio" name="condicion" value="1" checked="checked">Considerar Stock
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="condicion" value="0">No Considerar Stock
                                    </label>
                                </div>
                                
                                <div class="form-group ">
                                    <label for="stockminimo">Stock Minimo:</label>
                                    <input type="text" class="form-control" id="stockminimo" name="stockminimo">
                                </div>
                                <div class="form-group <?php echo !empty(form_error('stock')) ? 'has-error':'';?>">
                                    <label for="stock">Stock:</label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo set_value('stock');?>">
                                    <?php echo form_error("stock","<span class='help-block'>","</span>");?>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Productos a Asociar</label>
                                <input type="text" id="productosA" class="form-control">
                            </div>
                            <table class="table table-bordered" id="tbAsociados">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th style="width:20%;">Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
