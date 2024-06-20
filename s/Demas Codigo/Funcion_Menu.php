<?php
function Mostrar_Menu($Usuario){
    if ($Usuario==1){
      include ("Usuario1.html");
    
    }
    if ($Usuario==2){

        
      include ("Usuario2.html");
        echo "<ul>  
        <li> <a href=Inicio.html> Usuario 2 </a></li> 
        <li> <a href=Inicio.html> Usuario 2 </a></li> 
        <li> <a href=Inicio.html> Usuario 2 </a></li> 
        
        
        </ul>";
    
    }

}

?>