<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<?php  //Metodo que Recibe la descripcion y buscar el registro

if (isset($_POST['opciones'])){
    // Obtener el valor del select
    $Descripcion = $_POST['opciones'];
  
         require_once 'C:\XAMMP\htdocs\Controlador\NTarea.php';
         $Tareas=new NTarea();
          $Buscar= $Tareas->Buscar($Descripcion);  
          echo "<table id=tablaPersonas class=table table-striped table-sm>";
          echo "<tr><th>ID Tarea</th> <th>Titulo</th> <th>Descripcion</th> <th>Acciones</th></tr> <tbody>"; 
          
                 while ($fila=mysqli_fetch_assoc($Buscar)) {
                     echo "<tr>";
                     echo "<td>".$fila['idTarea']."</td>";
                     echo "<td>".$fila['Titulo']."</td>";
                     echo "<td>".$fila['Descripcion']."</td>"; 
                     echo "</tr>";
                 } 
                 echo "</tbody> </table>";
  
                }  
                
                
                
                ?>



<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="idtarea" class="col-form-label">ID Tarea:</label>
                <input type="text" class="form-control" id="idtarea">
                </div>
                <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo:</label>
                <input type="text" class="form-control" id="titulo">
                </div>                
                <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripcion:</label>
                <input type="number" class="form-control" id="descripcion">
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    


<link rel="stylesheet" type="text/css" href="../estilo.css"> 