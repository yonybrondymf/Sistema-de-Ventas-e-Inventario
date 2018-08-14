
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes del Dia
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                      
                        <a href="<?php echo base_url();?>movimientos/ordenes/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Orden</a>
                        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Mesas</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($ordenes)):?>
                                    <?php foreach($ordenes as $orden):?>
                                        <tr>
                                            <td><?php echo $orden->id;?></td>
                                            <td><?php echo $orden->fecha;?></td>

                                            <?php 
                                            $mesas = "";
                                            foreach ($orden->mesas as $mesa){
                                                $mesas .= $mesa->numero.","; 
                                            } 

                                            ?>
                                            <td><?php echo substr($mesas, 0, -1);?> <!-- <button type="button" class="btn btn-link btn-mesa">Cambiar o Unir Mesas</button></td> -->
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-info-pedido" data-toggle="modal" data-target="#modal-default" value="<?php echo $orden->id;?>"><span class="fa fa-search"></span></button>
                                                    <a href="<?php echo base_url()?>movimientos/ordenes/edit/<?php echo $orden->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    
                                                    <a href="<?php echo base_url();?>movimientos/ordenes/pay/<?php echo $orden->id;?>" class="btn btn-danger"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                                                   
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la orden</h4>
      </div>
      <div class="modal-body contenido-pedido">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-flat btn-print-pedido"><span class="fa fa-print"></span> Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
