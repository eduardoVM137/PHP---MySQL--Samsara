<?php 

require_once "./vistas/parte_superior.php";



?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>
    
    
    

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" name="accion" type="button" value="insertar" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>   
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        

                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            
                            <tr>
                                <th>ID Tarea</th>
                                <th>Titulo</th>
                                <th>Descripcion</th>                                
                                <th>Fecha</th>  
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php     
                                require_once './Controlador/NTarea.php';
                                $Tareas=new NTarea();
                        
                        
                                $MiMostrar=$Tareas->Mostrar();                          
                                while ($fila=mysqli_fetch_assoc($MiMostrar))  {                                                        
                            ?>
                            <tr>
                                <td><?php echo $fila['idTarea'] ?></td>
                                <td><?php echo $fila['Titulo'] ?></td>
                                <td><?php echo $fila['Descripcion'] ?></td>
                                <td><?php echo $fila['Fecha'] ?></td>    
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                    </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPersonas" method="post" action="Recivir.php" >
            <div class="modal-body">
            <div class="form-group">
                <label for="idtarea" class="col-form-label">ID:</label>
                <input type="text" class="form-control" id="idtarea" name="idtarea">
                </div> 
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" id="titulo">
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion">
                </div>                
                 <div class="form-group">
                <label for="fecha" class="col-form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha">
                </div>             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit"  name ="Guardar" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

          
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUDInsertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelInsertar"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPersonasInsertar" method="post" action="Recivir.php" >
            <div class="modal-body">
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" id="tituloInsertar">
                </div>
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcionInsertar">
                </div>                
                 <div class="form-group">
                <label for="fecha" class="col-form-label">Fecha:</label>
                <input type="date" class="form-control" id="fechaInsertar">
                </div>             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit"  name ="Guardar" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

</div>
<!--FIN del cont principal-->
<?php require_once 'C:\XAMPP\htdocs\dashboard\vistas\parte_inferior.php'?>















