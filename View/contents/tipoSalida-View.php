<script>
$(document).ready(function() {
  $('#grid').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
</script>
<style type="text/css">
    .container2{  
     width:550px;
   }
</style>
  <h1 style="text-align: center; padding: 30px">Gestión Tipo Salida</h1>
  <main class="container">
    <section class="row">
      <article class="col-md-5">
        <div class="col-md-16">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label ><h4><b>Nuevo Tipo De Documento</b></h4></label>
          </div>
      <div class="panel-body"> 
            <form method="post" id="tipoSalida-form" class="ml-auto">
              <input type="hidden" id="id_tipoSalida">
              <div class="row">
             <div class="col-md-6">
                <label>Nombre Tipo Salida</label><br>
                 <input type="text" id="tipoSalida" class="form-control" required=""><br>
              </div>
              <div class="col-md-6">
                <label>Estado</label><br>
                <select name="estado" id="estado" class="custom-select form-control" required="" id="exampleFormControlSelect1">
                  <option value="true" selected disabled>Seleccione Estado</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select><br>
              </div>
              <div class="col-md-12 mb-3">
                <button type="submit" id="btnR" class="btn btn-primary mt-3 mb-3">Registrar</button>
                <input type="reset" value="Limpiar" class="btn btn-danger mt-3 mb-3 boton-limpiar" style="float: right;">
              </div>
            </form>
          </div>
          </div>        
        </div>
      </article>
      <article class="col-md-7">
      <div class="container2">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
          <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
            <tr>
              <td width="10%">Nombre Tipo Salida</td>
              <td width="10%">Estado</td>
              <td width="1%">Acciones</td>
            </tr>
          </thead>
          <tbody class="asdasdasd" id="tipoSalidas">
          
          </tbody>
        </table>
        </div>
      </article>
    </section>
  </main>
<script src="http://localhost:8080/SIR/ajax/tipoSalida.js"></script>