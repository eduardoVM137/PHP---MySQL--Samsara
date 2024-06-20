function enviar(){
titulo=$('#titulo'.val());
$.post(Recivir.php,{titulo:titulo},function(data){
    if(data!=null){
alert("datos enviados");
    }else{
        alert("datos no enviados");
    }


});
}