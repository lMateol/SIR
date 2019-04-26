$(document).ready(function(){
    let edit;
    listar();

    $('#tipoSalida-form').submit(function(e){
        const postData = {
            nombre : $('#tipoSalida').val(),
            estado : $('#estado').val(),
            id : $('#id_tipoSalida').val(),
            editando : edit
        }
        if ($('#estado').val()==null) {
            swal({title: "ERROR",    
            text: "DEBES INGRESAR UN ESTADO.", 
            type:"error", 
            confirmButtonText: "OK", 
            closeOnConfirm: true 
            }, 
            function(){ 
            });  
          e.preventDefault();
        } else {
            if (edit==null || edit==false) {
                $.post('http://localhost:8080/SIR/Controller/tipoSalidaController.php', postData, function(response){
                    listar();
                    $('#tipoSalida-form').trigger('reset');
                    console.log(response);
                    if (response==1) {
                        swal({title: "LISTO",    
                              text: "La tipoSalida ha sido registrada correctamente.", 
                              type:"success", 
                              confirmButtonText: "OK", 
                              closeOnConfirm: true 
                            }, 
                            function(){ 
                            });  
                    } else {
                    swal({title: "ERROR",    
                        text: "No se púdo registrar la tipoSalida. Intenta más tarde.", 
                        type:"error", 
                        confirmButtonText: "OK", 
                        closeOnConfirm: true 
                      }, 
                      function(){ 
                      });  
                    }
                });
            }else if (edit==true) {
                $.post('http://localhost:8080/SIR/Controller/tipoSalidaController.php', postData, function(response){
                    listar();
                    $('#tipoSalida-form').trigger('reset');
                    console.log(response);
                    if (response==1) {
                        swal({title: "LISTO",    
                              text: "La tipoSalida ha sido Actualizado correctamente.", 
                              type:"success", 
                              confirmButtonText: "OK", 
                              closeOnConfirm: true 
                            }, 
                            function(){ 
                            });  
                    } else {
                    swal({title: "ERROR",    
                        text: "No se púdo actualizar. Intenta más tarde.", 
                        type:"error", 
                        confirmButtonText: "OK", 
                        closeOnConfirm: true 
                      }, 
                      function(){ 
                      });  
                    }
                    edit=null;
                });
            }
            e.preventDefault();
        }
    }); 

    function listar(){
        if (edit==true) {
            $('#btnR').html("Registrar");
            }
        $.ajax({
            url : 'http://localhost:8080/SIR/Controller/tipoSalidaController.php',
            type : 'GET',
            success : function(response){
                // console.log(response);
                let tiposSalidas = JSON.parse(response);
                let template = '';
                tiposSalidas.forEach(tipoSalida => {
                    let estados="Inactivo";;
                    if (tipoSalida.estado==1) { estados = "Activo"; }
                    template += `
                        <tr tipo_salida="${tipoSalida.tipo_salida}" estado="${tipoSalida.estado}">
                        <td style="display: none"></td>
                        <td>${tipoSalida.nombre}</td>
                        <td>${estados}</td>
                        <td>
                        <button class="btn btn-success tipoSalida-edit text-center">Editar</button>
                        <button class="btn btn-danger tipoSalida-delete text-center"><i class="fas fa-sync-alt fa-spin
                        " aria-hidden="true" ></i></button>
                        </td>
                        </tr>
                    `;
                });
                $('#tipoDocumentos').html(template);
            } 
        });
    }

    $(document).on('click', '.tipoSalida-delete', function(){
        let element = $(this)[0].parentElement.parentElement;
        let estado = $(element).attr('estado');
        let id = $(element).attr('tipo_salida');
        const postData = {
            estado : estado,
            id : id,
        }
        swal({title: "LISTO",    
          text: "El estado ha sido editado correctamente.", 
          type:"success", 
          confirmButtonText: "OK", 
          closeOnConfirm: true 
        }, 
        function(){ 
            $.post('http://localhost:8080/SIR/Controller/tipoSalidaController.php', postData, function(response) {
                console.log(response);
                listar();
            });
        });  
    });

    $(document).on('click', '.tipoSalida-edit', function(){
        $('#btnR').html("Actualizar");
        let element = $(this)[0].parentElement.parentElement;
        let consul = $(element).attr('tipo_salida');
        $.post('http://localhost:8080/SIR/Controller/tipoDocumentoController.php', {consul}, function(response) {
            console.log(response);
            let categor = JSON.parse(response);
            $('#tipoSalida').val(categor[0].nombre);
            $('#estado').val(categor[0].estado);
            $('#id_tipoSalida').val(categor[0].tipo_salida);
            edit = true;
        });
    });

    $(document).on('click', '.boton-limpiar', function(){
        $('#btnR').html("Registrar");
        console.log(edit);
        edit = null;
    });
});