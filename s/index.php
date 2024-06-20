
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
  
  
    <form class="row" method="POST" action="./Vista/PTarea.php">
        
    <div class="col-md-6">
        <select class="form-select" aria-label="Default select example" id="opciones"  name="opciones">
            

            <?php
                //Buscar Registro desde el select
                require_once './Controlador/NTarea.php';
                $Tareas=new NTarea(); 
                $MostrarEnSelect=    $Tareas->Mostrar(); 
                    while ($fila=mysqli_fetch_assoc($MostrarEnSelect)) 
                        {
                            echo "<option data-value=".$fila['Descripcion'].">".$fila['Descripcion']."</option>"; 
                        }

                
            ?>
        </select>
    </div>
        <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Titulo">
        <input type="text" class="form-control" placeholder="Descripcion">
        <div class="input-group date">
      <input type="date" class="form-control" placeholder="Fecha">
      <div class="input-group-append">
      
 
        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
      </div>
      </div> </div>

  <div class="col-md-6">
        <input class="btn btn-primary" type="submit" value="Mostra Registro Seleccionado">
        <button id="btnNuevo" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"  data-bs-whatever="1">Nuevo</button>    
        </div>
    </form>

     <table  id="tablaPersonas" class="table table-striped table-sm">
    <?php   //Mostrar Registros

       require_once './Controlador/NTarea.php';
        $Tareas=new NTarea();

  
        $Buscar=$Tareas->Mostrar();  
        echo "<tr><th>ID Tarea</th> <th>Titulo</th> <th>Descripcion</th> <th>Acciones</th></tr>"; 
        echo "<tbody>";
               while ($fila=mysqli_fetch_assoc($Buscar)) {
                   echo "<tr>";
                   echo "<td>".$fila['idTarea']."</td>";
                   echo "<td>".$fila['Titulo']."</td>";
                   echo "<td>".$fila['Descripcion']."</td>";   ?>
                   
                   <td>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever=<?php echo $fila['idTarea'] ?>>Eliminar</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Actualizar</button>  
                   </td>
                   
                   <?php 
                   echo "</tr>";
               }
             

               
    ?>
     </tbody> 
    </table>
 


</body>

</html>


<!--Modal para CRUD-->
<div id="exampleModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-light" data-dismiss="modal" href="./index.php">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  


<script>

    const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}` 
    modalBodyInput.value = recipient
  })
}
</script>



<!--
<h1 class="visually-hidden">Sidebars examples</h1>

<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    <span class="fs-4">Sidebar</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="#" class="nav-link active" aria-current="page">
        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"/></svg>
        Home
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-white">
        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
        Dashboard
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-white">
        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
        Orders
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-white">
        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
        Products
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-white">
        <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
        Customers
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong>mdo</strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
      <li><a class="dropdown-item" href="#">New project...</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Sign out</a></li>
    </ul>
  </div>
</div>
-->